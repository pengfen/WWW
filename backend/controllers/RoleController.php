<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Role;

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
		$info = Role::getinfo();
		return $this->render('index', [
		    'info' => $info,
		]);
	}
	
	// 添加角色
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