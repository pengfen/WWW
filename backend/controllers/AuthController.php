<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\Pagination;
use backend\models\Auth;
use backend\models\Manager;
use backend\models\Upload;
use backend\models\Recycle;
use backend\models\Log;

/**
 * 权限控制器 (权限列表 添加权限 修改权限 删除权限)
 * 作者: caopeng
 * 时间: 2016-09-11
*/
class AuthController extends Controller
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

    /**
     * 列表显示
     *
     * @return string
     */
    public function actionIndex()
    {
		Log::log("auth,action:index,权限列表"); // 记录日志
		/* tp框架实现
		$info = $this -> getinfo(true); // 获取所有权限信息
		// 向模板中分配数据及显示模板
		$this -> assign('title', '权限列表');
		//$this -> assign('link', U('Auth/index'));
		$this -> assign('info', $info);
		$this -> display(); */
		$info = $this -> getinfo(true); // 获取所有权限信息
		return $this->render('index',[
		    'auth' => $info['model'],
		    'pages' => $info['pages'],
		]);
    }
	
	/**
	 * 添加界面
	*/
	public function actionAdd()
	{
		Log::log("auth,action:add,权限列表单击添加权限"); // 记录日志
		/* tp框架实现
		$info = $this -> getinfo(); // 获取顶级,次顶级权限
		$this -> assign('info', $info);
		$this -> display();*/
		$info = $this -> getinfo(); // 获取顶级,次顶级权限 针对页面中的权限父级
		return $this->render('add', [
			'info' => $info['model'],
		]);
	}

	public function actionInsert() {
		Log::log("auth,action:add,添加权限界面单击添加权限"); // 记录日志
		// 获取表单数据
		$request = Yii::$app->request;
        $postData = $request->post();

        // 实例化数据表
		$auth = new Auth();
		$auth->name = $postData['name'];
		$auth->pid = $postData['pid'];
		$auth->controller = $postData['controller'];
		$auth->action = $postData['action'];
		// 获取当前管理员 id
		$manager = Yii::$app->session->get('manager');
		$auth->uid = $manager['id'];
		$auth->addtime = time();

		if (!empty($_FILES)) {
			$newdir = 'upload/'.date('Y-m-d', time()).'/';
			$dir = Yii::$app->basePath.'/web/'.$newdir;
			$files = $_FILES['img'];
			$info = Upload::upload($files, $dir, $newdir, 2000000, array('image/png', 'image/gif', 'image/jpeg'));
			//判断是否上传成功
			if ($info['success']){
				$auth->image = $info['info'];
			}
		}

		// 校验 校验通过跳转到列表页 不通过跳转到添加页
		if ($auth->validate()) {
			$auth->save();
			// 获取当前添加数据记录的ID
			$id = Yii::$app->db->getLastInsertId();
			$path = $this->getPath($postData['pid'], $id);
			// level 全路径里边中划线的个数
		    $level = count(explode('-', $path)) - 1;
		    $auth->id = $id;
		    $auth->path = $path;
		    $auth->level = $level;
		    $auth->save();
            return Yii::$app->getResponse()->redirect('/index.php?r=auth/index');
		} else {
		    $info = $this -> getinfo(); // 获取顶级,次顶级权限 针对页面中的权限父级
			return $this->render('add', [
			    'errors'=>$auth->getErrors(),
				'info' => $info['model'],
			]);
		}
	}

	/**
	 * 修改界面
	 */
	public function actionEdit() 
	{
		Log::log("auth,action:edit,权限列表单击修改"); // 记录日志
		$request = Yii::$app->request->get();
		$id = $request['id'];
		$data = Auth::find()->select("id, pid, name, controller, action, isShow, addtime")->where(['id' => $id])->asArray()->one();
		// find($id) 查询是总是第一条
		// $data = Auth::find($id)->select("id, name, controller, action, addtime")->asArray()->one();
		//$uidArr = (new Query())->select('uid')->from(self::UIBTB)->where('username = :username', [':username' => $username])->one();
		$info = $this -> getinfo(); // 获取顶级,次顶级权限 针对页面中的权限父级
		return $this->render('edit', [
			'info' => $info['model'],
			'data' => $data,
		]);
	}

	/**
	 * 修改数据
	*/
	public function actionUpd()
	{
		Log::log("auth,action:edit,修改权限界面单击修改权限"); // 记录日志
		// 获取表单数据
		$request = Yii::$app->request;
        $postData = $request->post();

        // 实例化数据表
		//$auth = new Auth();
		$id = $postData['id'];
		$auth = Auth::findOne($id);
		$auth->name = $postData['name'];
		$auth->pid = $postData['pid'];
		$auth->controller = $postData['controller'];
		$auth->action = $postData['action'];
		$auth->isShow = $postData['isShow'];
		// 获取当前管理员 id
		$manager = Yii::$app->session->get('manager');
		$auth->mid = $manager['id'];
		$auth->updatetime = time();
		$path = $this->getPath($postData['pid'], $postData['id']);
		// level 全路径里边中划线的个数
		$level = count(explode('-', $path)) - 1;
		$auth->path = $path;
		$auth->level = $level;
		if ($auth->validate()) {
			$auth->save();
            return Yii::$app->getResponse()->redirect('/index.php?r=auth/index');
		} else {
			return $this->render('add', [
			    'errors'=>$auth->getErrors(),
			]);
		}    
	}
	
	/**
	 * 修改关联图界面
	*/
	public function actionEditimg()
	{
		Log::log("auth,action:editimg,权限列表单击修改关联图"); // 记录日志
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Auth::findOne($id);
		return $this->render('editimg', [
		    'info' => $info,
		]);
	}
	/**
	 * tp框架实现
	public function editImg(){
		$id = I('get.id');
		$info = D('Auth') -> find($id);
		$this -> assign('info', $info);
		$this -> display();
	}*/
	
	/**
	 * 修改关联图
	*/
	public function actionUpdimg()
	{
				Log::log("auth,action:editimg,修改关联图界面单击修改权限关联图"); // 记录日志
		// 获取表单数据
		$post = Yii::$app->request->post();

        // 实例化数据表
		//$auth = new Auth();
		$id = $post['id'];
		$auth = Auth::findOne($id);
		
		// 获取当前管理员 id
		$manager = Yii::$app->session->get('manager');
		$auth->mid = $manager['id'];
		$auth->updatetime = time();
		
		if (!empty($_FILES)) {
			$newdir = 'upload/'.date('Y-m-d', time()).'/';
			$dir = Yii::$app->basePath.'/web/'.$newdir;
			$files = $_FILES['img'];
			$info = Upload::upload($files, $dir, $newdir, 2000000, array('image/png', 'image/gif', 'image/jpeg'));
			//判断是否上传成功
			if ($info['success']){
				$auth->image = $info['info'];
				$auth->save();
				return Yii::$app->getResponse()->redirect('/index.php?r=auth/index');
			}
		}
		
		$info = Auth::findOne($id);
		return $this->render('editimg', [
		    'info' => $info,
		]);
	}
	
	/**
	 * 权限详情
	*/
	public function actionDetail()
	{
		Log::log("auth,action:detail,权限列表单击详情"); // 记录日志
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Auth::findOne($id);
		$uid = $info['uid'];
		$username = Manager::find()->select("display_name")->where(['id' => $uid])->asArray()->one();
		if ($username) {
			$info['uid'] = $username['display_name'];
		}
		return $this->render('detail', [
		    'info' => $info,
		]);
	}
	/* tp框架实现
	public function detail(){
		$id = I('get.id');
		$info = D('Auth') -> find($id);
		$this -> assign('info', $info);
		$this -> display();
	}*/
	
	/**
	 * 删除权限
	*/
	public function actionDel()
	{
		Log::log("auth,action:del,权限列表单击删除"); // 记录日志
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Auth::findOne($id);
		$data['image'] = $info->image; // 获取图片地址
		$res = $info->delete();
		if ($res) {
			// 图片回收
			Recycle::add($data);
			return Yii::$app->getResponse()->redirect('/index.php?r=auth/index');
		} else {
			echo '删除失败';
		}
	}
	/** tp框架实现
	public function delete(){
		$id = I('get.id');
		$img = D('Auth') -> where(array('id'=>$id)) -> getField('image');
		$res = D('Auth') -> delete($id);
		if ($res) {
			$recycle = new ImageUploadController();
			$recycle -> recycle($img);
		}
		$mess = new MessController();
		$mess -> message($res, '删除成功', '删除失败', U('Auth/index', array('mess'=>'删除成功')));
	}*/
	
	/**
	  * 获取权限信息 
	  * @param $flag true 只查询顶级,次顶级权限 false 查询所有权限
	*/
	private function getinfo($flag = false){
		if ($flag == true) { // 只针对列表页进行分页显示
			$info = Auth::find()
			->select('id, name, controller, action, addtime, level')
			->where(['<', 'level', 2])
			->orderBy(['path' => SORT_ASC]);
			$pages = new Pagination(['totalCount' =>$info->count(), 'pageSize' => '10']);
            $model = $info->offset($pages->offset)->limit($pages->limit)->asArray()->all();
            $data['pages'] = $pages;
		} else {
			$model = Auth::find()
			->select('id, name, controller, action, addtime, level')
			->orderBy(['path' => SORT_ASC])->asArray()->all();
		}
		
		/* tp框架实现
		$auth = D('Auth');
		if ($flag == true){
			$map = array();
			$map['level'] = array('lt', 2);
			$info = $auth -> where($map) -> order('path asc') -> select();
		} else {
			$info = $auth -> order('path asc') -> select();
		}*/
		// 处理缩进关系(根据级别缩进)
		foreach ($model as $k => $v) {
			// echo $k.' : '.$v['level']; 0 : 0 1 : 1 2 : 1 3 : 0 4 : 1
			$model[$k]['name'] = str_repeat("&nbsp;&nbsp;", $v['level']).$model[$k]['name'];
		}
		$data['model'] = $model;
		return $data;
	}

	/**
	  * 获取全路径
	  * $pid 权限父id
	  * $id 记录id 
	*/
	private function getPath($pid, $id){
		// path 父级全路径与本身id 的连接信息 如 1-3 (顶级权限则为id本身)
		if ($pid == 0) {
			$path = $id; // 顶级权限
		} else { // 1-3 ...
			/* tp框架查找
			$pinfo = $this -> find($pid);
			$p_path = $pinfo['path']; */
			$pinfo = Auth::find()->select('path')->where(['id' => $pid])->asArray()->one();
			$p_path = $pinfo['path'];
			$path = $p_path.'-'.$id;
		}
		return $path;
	}
}
