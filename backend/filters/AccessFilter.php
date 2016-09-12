<?php
namespace backend\filters;

use Yii;
use yii\base\ActionFilter;

/**
 * 操作方法前缀过滤
 * 功能: 拦截权限
 * 作者: caopeng
 * 时间: 2016-09-11
*/
class AccessFilter extends ActionFilter {
	
	public function beforeAction($action) {
		$method = $action->id; // 获取操作方法名
		$controller = $action->controller->id; // 获取控制器名
		if ($method != 'login') { // 排除登录
			// 获取当前的请求 如\Manager\index --- CONTROLLER_NAME ---> Manager ACTION_NAME ---> index
			$now_ac = $controller.'-'.$method;
			
			$manager = Yii::$app->session->get('manager');
			if ($manager) {
				// 获取所以权限
				$id = $manager['id'];
				$prefix = Yii::$app->db->tablePrefix;
				$sql = "select aac from ".$prefix."manager a left join ".$prefix."role b on a.rid = b.id where a.id='{$id}'";
				$data = \Yii::$app->db->createCommand($sql)->queryAll();
				$aac = $data[0];
				$allow_ac = array('Index-index');

				// 判断权限
				if (!in_array($now_ac, $allow_ac) && $id != 1 && strpos($aac, $now_ac) === false) {
					return Yii::$app->getResponse()->redirect('/index.php?r=site/login');
				}
			} else {
				return Yii::$app->getResponse()->redirect('/index.php?r=site/login');
			}
		}
		
		return parent::beforeAction($action);
	}
	
	/** tp 框架实现权限控制 (使用基类，然后所有控制器继承基类)
	  * 控制器基类 
	  * 功能: 拦截权限
	  * 作者: apeng
	  * 时间: 2015-07-31
	  
	class BaseController extends Controller{
		function __construct(){
			parent::__construct();

			// 获取当前的请求 如\Manager\index --- CONTROLLER_NAME ---> Manager ACTION_NAME ---> index
			$now_ac = CONTROLLER_NAME.'-'.ACTION_NAME;
			//dump($now_ac);
			// 获取当前角色所拥有的所有权限
			$id = $_SESSION['manager']['id'];
			if ($id) {
				$sql = "select aac from resource_manager a left join resource_role b on a.rid = b.id where a.id='{$id}'";
				$aac = D() -> query($sql);
				$allow_ac = array('Index-index');
				if (!in_array($now_ac, $allow_ac) && $_SESSION['manager']['id'] != 1 && strpos($aac, $now_ac) === false) {
					$this -> error('你没有权限访问', U('Login/login'));
				}
			} else {
				//$this -> error('你没有权限访问', U('Login/login'));
				$this -> redirect('Login/login');
			}
		}
	}
	*/
}