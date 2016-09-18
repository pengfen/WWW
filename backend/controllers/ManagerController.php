<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Manager;
use backend\models\Role;
use backend\models\Log;

/**
 * 管理员 (管理员列表, 添加管理员, 修改管理员, 删除管理员, 管理员详情 --- 个人中心, 校验邮箱)
 * 作者: caopeng
 * 时间: 2016-09-15
*/
class ManagerController extends Controller
{
	/**
	 * 使用自定义类做action前置过滤
	 *
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => 'backend\filters\AccessFilter',
            ],
        ];
    }
	
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
	
	// 管理员列表
	public function actionIndex()
	{
		Log::log("manager,action:index,管理员列表"); // 记录日志
		$info = Manager::getinfo();
		return $this->render('index', [
		    'info' => $info,
		]);
	}
	/** tp框架实现
	public function index(){
		$manager = D('Manager');
		$search = I('get.search'); // 拼接搜索条件
		// 调用分页控制器实例分页功能(注意写入的字段和数据库中的字段必须一致)
		$page = new PageController();
		$count = $page -> getCount('username', $search, $manager);
		$show = $page -> show($count);
		$info = $page -> page('username', $search, $manager);
		$this -> assign('count', $count);
	    $this -> assign('page', $show);  
	    
	    // 获取管理员中的角色id
	    $rids = '';
	    foreach ($info as $k => $v) {
	    	$rids .= $v['rid'].',';
	    }
	    $rids = rtrim($rids, ',');
	    if ($rids) {
	    	$map = "id in ({$rids})";
	    	// 查询角色表
	        $data = D('Role') -> where($map) -> getField('id,name', true);
	        // 处理职位(一利用连接查询 二使用双循环)
		    foreach ($info as $k => $v) {
		    	foreach ($data as $key => $value) {
		    		if ($v['rid'] == $key) {
		    			$info[$k]['rid'] = $value;
		    			break;
		    		}
		    	}
		    }
	    }
	    $this -> assign('info', $info);
		$this -> assign('title','管理员列表');
		$this -> display();
	}*/
	
	// 添加管理用户
	public function actionAdd()
	{
		$post = Yii::$app->request->post();
		if ($post) {
			Log::log("manager,action:add,添加管理员界面单击添加管理员"); // 记录日志
			Manager::add($post);
			return Yii::$app->getResponse()->redirect('/index.php?r=manager/index');
		} else {
			Log::log("manager,action:add,管理员列表单击添加管理员"); // 记录日志
			$info = Role::getinfo();
			return $this->render('add', [
			    'info' => $info,
			]);
		}
	}
	/** tp框架实现
	// 添加界面
	public function add(){
		$manager = D('Role');
		$info = $manager -> getField('id,name', true);
		$this -> assign('data', $info);
		$this -> display();
	}
	// 添加数据
	public function insert(){
		$manager = D('Manager');
		$manager -> create();
		//收集数据
		if(!$manager -> create()){
			$this -> error($manager -> getError());
		}
		//执行添加
		if($manager -> add() > 0){
			$this -> success('添加成功！',U('Manager/index'));
		}else{
			$this -> error('添加失败！');
		}	
	}
	*/
	
	// 修改管理用户
	public function actionEdit() {
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$data = Manager::getinfo($id);
		$post = Yii::$app->request->post();
		if ($post) {
			Log::log("auth,action:edit,修改管理员界面单击修改管理员"); // 记录日志
			Manager::edit($post);
			return Yii::$app->getResponse()->redirect('/index.php?r=manager/index');
		} else {
			Log::log("auth,action
			:edit,管理员列表单击修改管理员"); // 记录日志
			$info = Role::getinfo();
			return $this->render('edit', [
			    'info' => $info,
				'data' => $data,
			]);
		}
	}
	/** tp框架实现
	// 修改界面
	public function edit(){
		$manager = D('Manager');
		$id = I('get.id');
		$info = $manager -> where(array('id'=>$id)) -> find();	
		$this -> assign('info', $info);
		// 获取职位
		$data = D('Role') -> getField('id, name', true);
		$this -> assign('data', $data);
		$this -> display();
	}

	// 修改数据
	public function update(){
		$manager = D('Manager');
		$manager -> create();
		$res = $manager -> where(array('id'=>$_POST['id'])) -> save();
		$mess = new MessController();
		$mess -> message($res, '修改成功', '修改失败', U('Manager/index', array('mess'=>'修改成功')));
	}
	*/
	
	// 删除用户
	public function actionDel() {
		Log::log("auth,action:del,管理员列表单击删除"); // 记录日志
		$get = Yii::$app->request->get();
		$id = $get['id'];
		Manager::del($id);
		return Yii::$app->getResponse()->redirect('/index.php?r=manager/index');
	}

	/** 删除管理员
	public function delete(){
		$manager = D('Manager');
		$id = I('get.id');
		$res = $manager -> delete($id);
		$mess = new MessController();
		$mess -> message($res, '删除成功', '删除失败', U('Manager/index', array('mess'=>'删除成功')));
	}
	*/
	
	// 管理员详情
	public function actionDetail() {
		Log::log("auth,action:detail,管理员列表单击详情"); // 记录日志
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Manager::getinfo($id);
		$rid = $info['rid'];
		$name = Role::find()->select('name')->where(['id' => $rid])->asArray()->one();
		if ($name) {
			$info['rid'] = $name;
		}
		return $this->render('detail', [
		    'info' => $info,
		]);
	}
	
	/**添加时验证邮箱
	public function checkEmail(){
		//$model = D('Manager');
		//接收jequery.post传过来的数据
		$email = I('get.data');
		//echo $email;
		$res = D('Manager') -> where(array('email'=>$email)) -> find();
		if (!$res) {
			echo '邮箱可以注册';
		} else {
			echo '邮箱已经注册';
		}
	}*/
	
}