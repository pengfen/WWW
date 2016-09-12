<?php
namespace backend\filters;

use Yii;
use yii\base\ActionFilter;

/**
 * ��������ǰ׺����
 * ����: ����Ȩ��
 * ����: caopeng
 * ʱ��: 2016-09-11
*/
class AccessFilter extends ActionFilter {
	
	public function beforeAction($action) {
		$method = $action->id; // ��ȡ����������
		$controller = $action->controller->id; // ��ȡ��������
		if ($method != 'login') { // �ų���¼
			// ��ȡ��ǰ������ ��\Manager\index --- CONTROLLER_NAME ---> Manager ACTION_NAME ---> index
			$now_ac = $controller.'-'.$method;
			
			$manager = Yii::$app->session->get('manager');
			if ($manager) {
				// ��ȡ����Ȩ��
				$id = $manager['id'];
				$prefix = Yii::$app->db->tablePrefix;
				$sql = "select aac from ".$prefix."manager a left join ".$prefix."role b on a.rid = b.id where a.id='{$id}'";
				$data = \Yii::$app->db->createCommand($sql)->queryAll();
				$aac = $data[0];
				$allow_ac = array('Index-index');

				// �ж�Ȩ��
				if (!in_array($now_ac, $allow_ac) && $id != 1 && strpos($aac, $now_ac) === false) {
					return Yii::$app->getResponse()->redirect('/index.php?r=site/login');
				}
			} else {
				return Yii::$app->getResponse()->redirect('/index.php?r=site/login');
			}
		}
		
		return parent::beforeAction($action);
	}
	
	/** tp ���ʵ��Ȩ�޿��� (ʹ�û��࣬Ȼ�����п������̳л���)
	  * ���������� 
	  * ����: ����Ȩ��
	  * ����: apeng
	  * ʱ��: 2015-07-31
	  
	class BaseController extends Controller{
		function __construct(){
			parent::__construct();

			// ��ȡ��ǰ������ ��\Manager\index --- CONTROLLER_NAME ---> Manager ACTION_NAME ---> index
			$now_ac = CONTROLLER_NAME.'-'.ACTION_NAME;
			//dump($now_ac);
			// ��ȡ��ǰ��ɫ��ӵ�е�����Ȩ��
			$id = $_SESSION['manager']['id'];
			if ($id) {
				$sql = "select aac from resource_manager a left join resource_role b on a.rid = b.id where a.id='{$id}'";
				$aac = D() -> query($sql);
				$allow_ac = array('Index-index');
				if (!in_array($now_ac, $allow_ac) && $_SESSION['manager']['id'] != 1 && strpos($aac, $now_ac) === false) {
					$this -> error('��û��Ȩ�޷���', U('Login/login'));
				}
			} else {
				//$this -> error('��û��Ȩ�޷���', U('Login/login'));
				$this -> redirect('Login/login');
			}
		}
	}
	*/
}