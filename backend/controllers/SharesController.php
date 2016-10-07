<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Log;
use backend\models\Shares;
use backend\models\Account;

/**
 * 股票理财 (股票账号列表)
 * 作者: caopeng
 * 时间: 2016-09-24
 */
class SharesController extends Controller
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
		$info = Account::find()->select('id,uid,amount,addtime,total_revenue')->orderBy(['id' => SORT_DESC])->asArray()->all(); 
		Log::log("shares,action:account,股票账号列表"); // 记录日志
		return $this->render('account', [
		    'info' => $info,
		]);
	}
	
	// 添加支付宝收益
	public function actionAccountAdd() {
		$data = Yii::$app->request->post();
		if ($data) {
			Log::log("shares,action:account-add,添加收益界面单击添加收益按钮"); // 记录日志
			Account::add($data);
		} else {
			Log::log("shares,action:account-add,股票账号列表单击添加收益按钮"); // 记录日志
		}
		return $this->render('account-add');
	}
	
	// 支付宝收益详情
	public function actionAccountDetail() {
		Log::log("shares,action:account-detail,股票账号列表单击详情"); // 记录日志
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Account::find()->where(['id' => $id])->asArray()->one();
		return $this->render('account-detail', [
		    'info' => $info,
		]);
	}
	
	// 支付宝理财列表
	public function actionShare() {
		$info = Shares::find()->select('id,uid,name,share_code,addtime')->orderBy(['id' => SORT_DESC])->asArray()->all(); 
		Log::log("shares,action:share,股票账号列表"); // 记录日志
		return $this->render('share', [
		    'info' => $info,
		]);
	}
	
	// 添加支付宝收益
	public function actionShareAdd() {
		$data = Yii::$app->request->post();
		if ($data) {
			Log::log("shares,action:share-add,添加收益界面单击添加收益按钮"); // 记录日志
			Shares::add($data);
		} else {
			Log::log("shares,action:share-add,股票账号列表单击添加收益按钮"); // 记录日志
		}
		return $this->render('share-add');
	}
	
	// 支付宝收益详情
	public function actionShareDetail() {
		Log::log("shares,action:share-detail,股票账号列表单击详情"); // 记录日志
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Shares::find()->where(['id' => $id])->asArray()->one();
		return $this->render('share-detail', [
		    'info' => $info,
		]);
	}
	
	// 支付宝理财列表
	public function actionRevenue() {
		$info = Shares::getRevenue();
		//$info = Shares::find()->select('id,uid,name,share_code,addtime')->orderBy(['id' => SORT_DESC])->asArray()->all(); 
		Log::log("shares,action:share,股票账号列表"); // 记录日志
		return $this->render('revenue', [
		    'info' => $info,
		]);
	}
	
	// 添加支付宝收益
	public function actionRevenueAdd() {
		$info = Shares::find('id,name')->asArray()->all();
		$data = Yii::$app->request->post();
		if ($data) {
			Log::log("shares,action:revenue-add,添加收益界面单击添加收益按钮"); // 记录日志
			Shares::addRevenue($data);
		} else {
			Log::log("shares,action:revenue-add,股票账号列表单击添加收益按钮"); // 记录日志
		}
		return $this->render('revenue-add', [
		    'info' => $info,
		]);
	}
	
	// 支付宝收益详情
	public function actionRevenueDetail() {
		Log::log("shares,action:revenue-detail,股票账号列表单击详情"); // 记录日志
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Shares::find()->where(['id' => $id])->asArray()->one();
		return $this->render('revenue-detail', [
		    'info' => $info,
		]);
	}
	
}