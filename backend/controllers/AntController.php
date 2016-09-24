<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Log;
use backend\models\Pay;

/**
 * 蚂蚁聚宝理财 (支付宝理财列表)
 * 作者: caopeng
 * 时间: 2016-09-24
 */
class AntController extends Controller
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
	
	// 支付宝理财列表
	public function actionPay() {
		$info = Pay::find()->select('id,uid,amount,addtime,total_revenue')->asArray()->all(); 
		Log::log("ant,action:pay,支付宝理财列表"); // 记录日志
		return $this->render('pay', [
		    'info' => $info,
		]);
	}
	
	// 添加支付宝收益
	public function actionPayAdd() {
		$data = Yii::$app->request->post();
		if ($data) {
			Pay::add($data);
		}
		return $this->render('pay-add');
	}
}