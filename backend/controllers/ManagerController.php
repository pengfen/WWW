<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Manager;

/**
 * ����Ա (����Ա�б�)
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
		$info = Manager::getinfo();
		return $this->render('index', [
		    'info' => $info,
		]);
	}
	
	// ��ӹ����û�
	public function actionAdd()
	{
		$post = Yii::$app->request->post();
		if ($post) {
			Manager::add($post);
			return Yii::$app->getResponse()->redirect('/index.php?r=manager/index');
		} else {
			return $this->render('add');
		}
	}
	
	// �޸Ĺ����û�
	public function actionEdit() {
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Manager::getinfo($id);
		$post = Yii::$app->request->post();
		if ($post) {
			Manager::edit($post);
			return Yii::$app->getResponse()->redirect('/index.php?r=manager/index');
		} else {
			return $this->render('edit', [
			    'info' => $info,
			]);
		}
	}
	
	// ɾ���û�
	public function actionDel() {
		$get = Yii::$app->request->get();
		$id = $get['id'];
		Manager::del($id);
		return Yii::$app->getResponse()->redirect('/index.php?r=manager/index');
	}
}