<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Log;

/**
 * 操作日志记录
 * 作者: caopeng
 * 时间: 2016-09-16
*/
class LogController extends Controller
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
		$info = Log::getinfo();
		return $this->render('index', [
		    'info' => $info,
		]);
	}
	
	public function actionDetail()
	{
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Log::getinfo($id);
		return $this->render('detail', [
		    'info' => $info,
		]);
	}
}