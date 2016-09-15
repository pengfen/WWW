<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Manager;

/**
 * 管理员 (管理员列表)
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
		$info = Manager::getinfo();
		return $this->render('index', [
		    'info' => $info,
		]);
	}
	
	// 添加管理用户
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
	
	// 修改管理用户
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
	
	// 删除用户
	public function actionDel() {
		$get = Yii::$app->request->get();
		$id = $get['id'];
		Manager::del($id);
		return Yii::$app->getResponse()->redirect('/index.php?r=manager/index');
	}
}