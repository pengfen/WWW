<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Role;
use backend\models\Log;

/**
 * ��ɫ (��ɫ�б�)
 * ����: caopeng
 * ʱ��: 2016-09-15
*/
class RoleController extends Controller
{
	/**
	 * ʹ���Զ�������actionǰ�ù���
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
	
	// ��ɫ�б�
	public function actionIndex()
	{
		Log::log("role,action:index,��ɫ�б�"); // ��¼��־
		$info = Role::getinfo();
		return $this->render('index', [
		    'info' => $info,
		]);
	}
	/** tp���ʵ��
	public function index(){
		$data = D('Role') -> select();
		// ��ģ���з������ݼ���ʾģ��
		$this -> assign('title', '��ɫ�б�');
		$this -> assign('info', $data);
		$this -> display();
	}*/
	
	// ��ӽ�ɫ
	public function actionAdd()
	{
		$post = Yii::$app->request->post();
		if ($post) {
			Log::log("role,action:add,��ӽ�ɫ���浥����ӽ�ɫ"); // ��¼��־
			Role::add($post);
			return Yii::$app->getResponse()->redirect('/index.php?r=role/index');
		} else {
			Log::log("role,action:add,��ɫ�б���浥�����Ȩ��"); // ��¼��־
			return $this->render('add');
		}
	}
	/** tp���ʵ�� 
	// ��ӽ���
	public function add(){
		$this -> display();
	}
	// �������
	public function insert(){
		$data = M('Role');
		$data -> create();
		$res = $data -> add();
		$mess = new MessController();
		$mess -> message($res, '��ӳɹ�', '���ʧ��', U('Role/index', array('mess'=>'��ӳɹ�')));
	}*/
	
	/** tp���ʵ��
	//����Ȩ�޽���
	public function distribute(){
		// ����id ��ȡ��ɫ�� �����е�Ȩ��ids
		$id = I('get.id'); // I() Ĭ����htmlspecialchars I('get.') �������е�$_GET[] ����
		$rinfo = D('Role') -> find($id);
		$this -> assign('id', $id);
		$this -> assign('name', $rinfo['name']);
		$auth_ids = explode(',', $rinfo['aids']);
		$this -> assign('aids', $auth_ids);
		// $name = D('Role') -> where(array('id'=>$id)) -> getField('name');
		// $this -> assign('name', $name);

		// ��ȡ���е�Ȩ����Ϣ
		$pinfo = D('Auth') -> where(array('level'=>'0')) -> select();
		$this -> assign('pinfo', $pinfo);
		$sinfo = D('Auth') -> where(array('level'=>'1')) -> select();
		$this -> assign('sinfo', $sinfo);
		$tinfo = D('Auth') -> where(array('level'=>'2')) -> select();
		$this -> assign('tinfo', $tinfo);
		$this -> display();
	} */

	/** tp���ʵ��
	//�޸�Ȩ������
	public function updDist(){
		$id = I('post.id');
		$res = D('Role') -> saveAuth($_POST['authname'], $id);
		$mess = new MessController();
		$mess -> message($res, '����Ȩ�޳ɹ�', '����Ȩ��ʧ��', U('Role/index', array('mess'=>'����Ȩ�޳ɹ�')));
	} */

	/** tp���ʵ��
	ɾ��
	public function delete(){
		$id = I('get.id');
		$res = D('Role') -> delete($id);
		$mess = new MessController();
		$mess -> message($res, 'ɾ���ɹ�', 'ɾ��ʧ��', U('Role/index', array('mess'=>'ɾ���ɹ�')));
	} */

	/** tp���ʵ��
	// 09-20 �鿴��ǰ��ɫ��Ȩ��
	public function detail(){
		// ����id ��ȡ��ɫ�� �����е�Ȩ��ids
		$id = I('get.id'); // I() Ĭ����htmlspecialchars I('get.') 
		$info = D('Role') -> find($id);
		$id = "id in (".$info['aids'].")";
		$names = D('Auth') -> where($id) -> getField('name', true);
		$this -> assign('names', $names);
		$this -> assign('name', $info['name']);
		$this -> display();
	}*/
}