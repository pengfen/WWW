<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Manager;
use backend\models\Role;
use backend\models\Log;

/**
 * ����Ա (����Ա�б�, ��ӹ���Ա, �޸Ĺ���Ա, ɾ������Ա, ����Ա���� --- ��������, У������)
 * ����: caopeng
 * ʱ��: 2016-09-15
*/
class ManagerController extends Controller
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
	
	// ����Ա�б�
	public function actionIndex()
	{
		Log::log("manager,action:index,����Ա�б�"); // ��¼��־
		$info = Manager::getinfo();
		return $this->render('index', [
		    'info' => $info,
		]);
	}
	/** tp���ʵ��
	public function index(){
		$manager = D('Manager');
		$search = I('get.search'); // ƴ����������
		// ���÷�ҳ������ʵ����ҳ����(ע��д����ֶκ����ݿ��е��ֶα���һ��)
		$page = new PageController();
		$count = $page -> getCount('username', $search, $manager);
		$show = $page -> show($count);
		$info = $page -> page('username', $search, $manager);
		$this -> assign('count', $count);
	    $this -> assign('page', $show);  
	    
	    // ��ȡ����Ա�еĽ�ɫid
	    $rids = '';
	    foreach ($info as $k => $v) {
	    	$rids .= $v['rid'].',';
	    }
	    $rids = rtrim($rids, ',');
	    if ($rids) {
	    	$map = "id in ({$rids})";
	    	// ��ѯ��ɫ��
	        $data = D('Role') -> where($map) -> getField('id,name', true);
	        // ����ְλ(һ�������Ӳ�ѯ ��ʹ��˫ѭ��)
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
		$this -> assign('title','����Ա�б�');
		$this -> display();
	}*/
	
	// ��ӹ����û�
	public function actionAdd()
	{
		$post = Yii::$app->request->post();
		if ($post) {
			Log::log("manager,action:add,��ӹ���Ա���浥����ӹ���Ա"); // ��¼��־
			Manager::add($post);
			return Yii::$app->getResponse()->redirect('/index.php?r=manager/index');
		} else {
			Log::log("manager,action:add,����Ա�б�����ӹ���Ա"); // ��¼��־
			$info = Role::getinfo();
			return $this->render('add', [
			    'info' => $info,
			]);
		}
	}
	/** tp���ʵ��
	// ��ӽ���
	public function add(){
		$manager = D('Role');
		$info = $manager -> getField('id,name', true);
		$this -> assign('data', $info);
		$this -> display();
	}
	// �������
	public function insert(){
		$manager = D('Manager');
		$manager -> create();
		//�ռ�����
		if(!$manager -> create()){
			$this -> error($manager -> getError());
		}
		//ִ�����
		if($manager -> add() > 0){
			$this -> success('��ӳɹ���',U('Manager/index'));
		}else{
			$this -> error('���ʧ�ܣ�');
		}	
	}
	*/
	
	// �޸Ĺ����û�
	public function actionEdit() {
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$data = Manager::getinfo($id);
		$post = Yii::$app->request->post();
		if ($post) {
			Log::log("auth,action:edit,�޸Ĺ���Ա���浥���޸Ĺ���Ա"); // ��¼��־
			Manager::edit($post);
			return Yii::$app->getResponse()->redirect('/index.php?r=manager/index');
		} else {
			Log::log("auth,action
			:edit,����Ա�б����޸Ĺ���Ա"); // ��¼��־
			$info = Role::getinfo();
			return $this->render('edit', [
			    'info' => $info,
				'data' => $data,
			]);
		}
	}
	/** tp���ʵ��
	// �޸Ľ���
	public function edit(){
		$manager = D('Manager');
		$id = I('get.id');
		$info = $manager -> where(array('id'=>$id)) -> find();	
		$this -> assign('info', $info);
		// ��ȡְλ
		$data = D('Role') -> getField('id, name', true);
		$this -> assign('data', $data);
		$this -> display();
	}

	// �޸�����
	public function update(){
		$manager = D('Manager');
		$manager -> create();
		$res = $manager -> where(array('id'=>$_POST['id'])) -> save();
		$mess = new MessController();
		$mess -> message($res, '�޸ĳɹ�', '�޸�ʧ��', U('Manager/index', array('mess'=>'�޸ĳɹ�')));
	}
	*/
	
	// ɾ���û�
	public function actionDel() {
		Log::log("auth,action:del,����Ա�б���ɾ��"); // ��¼��־
		$get = Yii::$app->request->get();
		$id = $get['id'];
		Manager::del($id);
		return Yii::$app->getResponse()->redirect('/index.php?r=manager/index');
	}

	/** ɾ������Ա
	public function delete(){
		$manager = D('Manager');
		$id = I('get.id');
		$res = $manager -> delete($id);
		$mess = new MessController();
		$mess -> message($res, 'ɾ���ɹ�', 'ɾ��ʧ��', U('Manager/index', array('mess'=>'ɾ���ɹ�')));
	}
	*/
	
	// ����Ա����
	public function actionDetail() {
		Log::log("auth,action:detail,����Ա�б�������"); // ��¼��־
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
	
	/**���ʱ��֤����
	public function checkEmail(){
		//$model = D('Manager');
		//����jequery.post������������
		$email = I('get.data');
		//echo $email;
		$res = D('Manager') -> where(array('email'=>$email)) -> find();
		if (!$res) {
			echo '�������ע��';
		} else {
			echo '�����Ѿ�ע��';
		}
	}*/
	
}