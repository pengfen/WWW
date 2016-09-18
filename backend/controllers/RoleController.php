<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Role;
use backend\models\Log;

/**
 * 角色 (角色列表)
 * 作者: caopeng
 * 时间: 2016-09-15
*/
class RoleController extends Controller
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
	
	// 角色列表
	public function actionIndex()
	{
		Log::log("role,action:index,角色列表"); // 记录日志
		$info = Role::getinfo();
		return $this->render('index', [
		    'info' => $info,
		]);
	}
	/** tp框架实现
	public function index(){
		$data = D('Role') -> select();
		// 向模板中分配数据及显示模板
		$this -> assign('title', '角色列表');
		$this -> assign('info', $data);
		$this -> display();
	}*/
	
	// 添加角色
	public function actionAdd()
	{
		$post = Yii::$app->request->post();
		if ($post) {
			Log::log("role,action:add,添加角色界面单击添加角色"); // 记录日志
			Role::add($post);
			return Yii::$app->getResponse()->redirect('/index.php?r=role/index');
		} else {
			Log::log("role,action:add,角色列表界面单击添加权限"); // 记录日志
			return $this->render('add');
		}
	}
	/** tp框架实现 
	// 添加界面
	public function add(){
		$this -> display();
	}
	// 添加数据
	public function insert(){
		$data = M('Role');
		$data -> create();
		$res = $data -> add();
		$mess = new MessController();
		$mess -> message($res, '添加成功', '添加失败', U('Role/index', array('mess'=>'添加成功')));
	}*/
	
	/** tp框架实现
	//分配权限界面
	public function distribute(){
		// 根据id 获取角色名 及所有的权限ids
		$id = I('get.id'); // I() 默认是htmlspecialchars I('get.') 过滤所有的$_GET[] 数组
		$rinfo = D('Role') -> find($id);
		$this -> assign('id', $id);
		$this -> assign('name', $rinfo['name']);
		$auth_ids = explode(',', $rinfo['aids']);
		$this -> assign('aids', $auth_ids);
		// $name = D('Role') -> where(array('id'=>$id)) -> getField('name');
		// $this -> assign('name', $name);

		// 获取所有的权限信息
		$pinfo = D('Auth') -> where(array('level'=>'0')) -> select();
		$this -> assign('pinfo', $pinfo);
		$sinfo = D('Auth') -> where(array('level'=>'1')) -> select();
		$this -> assign('sinfo', $sinfo);
		$tinfo = D('Auth') -> where(array('level'=>'2')) -> select();
		$this -> assign('tinfo', $tinfo);
		$this -> display();
	} */

	/** tp框架实现
	//修改权限数据
	public function updDist(){
		$id = I('post.id');
		$res = D('Role') -> saveAuth($_POST['authname'], $id);
		$mess = new MessController();
		$mess -> message($res, '分配权限成功', '分配权限失败', U('Role/index', array('mess'=>'分配权限成功')));
	} */

	/** tp框架实现
	删除
	public function delete(){
		$id = I('get.id');
		$res = D('Role') -> delete($id);
		$mess = new MessController();
		$mess -> message($res, '删除成功', '删除失败', U('Role/index', array('mess'=>'删除成功')));
	} */

	/** tp框架实现
	// 09-20 查看当前角色的权限
	public function detail(){
		// 根据id 获取角色名 及所有的权限ids
		$id = I('get.id'); // I() 默认是htmlspecialchars I('get.') 
		$info = D('Role') -> find($id);
		$id = "id in (".$info['aids'].")";
		$names = D('Auth') -> where($id) -> getField('name', true);
		$this -> assign('names', $names);
		$this -> assign('name', $info['name']);
		$this -> display();
	}*/
}