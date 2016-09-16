<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Role;

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
		$info = Role::getinfo();
		return $this->render('index', [
		    'info' => $info,
		]);
	}
	
	// ��ӽ�ɫ
	public function actionAdd()
	{
		$post = Yii::$app->request->post();
		if ($post) {
			Manager::add($post);
			return Yii::$app->getResponse()->redirect('/index.php?r=role/index');
		} else {
			return $this->render('add');
		}
	}
}