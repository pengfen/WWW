<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Log;
use backend\models\P2p;

/**
 * P2P理财 (P2P理财列表)
 * 作者: caopeng
 * 时间: 2016-10-03
 */
class P2pController extends Controller
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
	public function actionAccount() {
		//$info = Pay::find()->select('id,uid,amount,addtime,total_revenue')->orderBy(['id' => SORT_DESC])->asArray()->all(); 
		$info = P2p::getAccount();
		Log::log("p2p,action:account,支付宝理财列表"); // 记录日志
		return $this->render('account', [
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
	
}