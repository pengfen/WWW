<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Log;
use backend\models\Pay;
use backend\models\Gold;

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
			Log::log("ant,action:pay-add,添加收益界面单击添加收益按钮"); // 记录日志
			Pay::add($data);
		} else {
			Log::log("ant,action:pay-add,支付宝理财列表单击添加收益按钮"); // 记录日志
		}
		return $this->render('pay-add');
	}
	
	// 支付宝收益详情
	public function actionPayDetail() {
		Log::log("ant,action:pay-detail,支付宝理财列表单击详情"); // 记录日志
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Pay::find()->where(['id' => $id])->asArray()->one();
		return $this->render('pay-detail', [
		    'info' => $info,
		]);
	}
	
	// 黄金(存金宝)收益列表
	public function actionGold() {
		$info = Gold::find()->select('id,uid,amount,addtime,total_revenue')->asArray()->all(); 
		Log::log("ant,action:gold,黄金收益列表"); // 记录日志
		return $this->render('gold', [
		    'info' => $info,
		]);
	}
	
	// 添加黄金收益
	public function actionGoldAdd() {
		$data = Yii::$app->request->post();
		if ($data) {
			Log::log("ant,action:gold-add,添加收益界面单击添加收益按钮"); // 记录日志
			Gold::add($data);
		} else {
			Log::log("ant,action:gold-add,黄金收益列表单击添加收益按钮"); // 记录日志
		}
		return $this->render('gold-add');
	}
	
    // 黄金收益详情
	public function actionGoldDetail() {
		Log::log("ant,action:gold-detail,黄金收益列表单击详情"); // 记录日志
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Gold::find()->where(['id' => $id])->asArray()->one();
		return $this->render('gold-detail', [
		    'info' => $info,
		]);
	}
}