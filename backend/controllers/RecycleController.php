<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Recycle;

/**
 * ���� (�����б� �������� ����ɾ��)
 * ����: caopeng
 * ʱ��: 2016-09-15
*/
class RecycleController extends Controller
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
	
	// �����б�
	public function actionIndex()
	{
		$info = Recycle::getinfo();
		return $this->render('index', [
		    'info' => $info,
		]);
	}
	/** tp���ʵ��
	public function index(){
		$info = D('ImageRecycle') -> select();
		$this -> assign('info', $info);
		$this -> display();
	}*/
	
	// ��������
	public function actionDetail()
	{
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Recycle::getinfo($id);
		return $this->render('detail', [
		    'info' => $info,
		]);
	}
	/** tp���ʵ�� 
	public function detail(){
		$id = I('get.id');
		$info = D('ImageRecycle') -> find($id);
		$this -> assign('info', $info);
		$this -> display();
	}*/
	
	// ɾ��ͼƬ
	public function actionDel()
	{
		$get = Yii::$app->request->get();
		$id = $get['id'];
		Recycle::del($id);
		return Yii::$app->getResponse()->redirect('/index.php?r=recycle/index');
	}
	/** tp���ʵ��
	public function delete(){
		$id = I('get.id');
		$res = D('ImageRecycle') -> delete($id);
		if ($res) {
			// IO ��ɾ���ļ����е���ʵ��ͼƬ
		}
		$mess = new MessController();
		$mess -> message($res, 'ɾ���ɹ�', 'ɾ��ʧ��', U('ImageRecycle/index', array('mess'=>'ɾ���ɹ�')));
	}*/
}