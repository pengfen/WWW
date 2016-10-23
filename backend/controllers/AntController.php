<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Log;
use backend\models\Pay;
use backend\models\Gold;
use backend\models\Fund;

/**
 * 蚂蚁聚宝理财 (支付宝理财列表, 黄金理财列表, 指基理财列表)
 * 作者: caopeng
 * 时间: 2016-09-24
 * 
 * 修改记录
 * 2016/10/23 修改黄金理财(针对最新一条记录进行校正)
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
		$info = Pay::find()->select('id,uid,amount,addtime,total_revenue')->orderBy(['id' => SORT_DESC])->asArray()->all(); 
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
		$info = Gold::find()->select('id,uid,amount,addtime,total_revenue')->orderBy(['id' => SORT_DESC])->asArray()->all(); 
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
	
	// 修改黄金收益
	public function actionGoldEdit() {
		$get = Yii::$app->request->get();
		if ($get) {
			$id = $get['id'];
		    $info = Gold::find()->select("id,amount,total_revenue,current_price")->where(['id' => $id])->one();
		}
		
		$data = Yii::$app->request->post();
		if ($data) {
			Log::log("ant,action:gold-edit,修改黄金收益列表单击修改收益按钮"); // 记录日志
			Gold::edit($data);
			return Yii::$app->getResponse()->redirect('/index.php?r=ant/gold');
		} else {
			Log::log("ant,action:gold-add,黄金收益列表单击修改收益按钮"); // 记录日志
			return $this->render('gold-edit', [
				'info' => $info,
			]);
		}
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
	
	// 指数基金列表
	public function actionIndexFund() {
		$info = Fund::find()->select('id,amount,revenue,addtime,total_revenue')->orderBy(['id' => SORT_DESC])->asArray()->all(); 
		Log::log("ant,action:index-fund,指数基金列表"); // 记录日志
		return $this->render('index-fund', [
		    'info' => $info,
		]);
	}
	
	// 添加指数基金
	public function actionIndexFundAdd() {
		$data = Yii::$app->request->post();
		if ($data) {
			Log::log("ant,action:index-fund-add,添加收益界面单击添加收益按钮"); // 记录日志
			Fund::add($data);
		} else {
			Log::log("ant,action:index-fund-add,指基收益列表单击添加收益按钮"); // 记录日志
		}
		return $this->render('index-fund-add');
	}
	
	// 指基收益详情
	public function actionIndexFundDetail() {
		Log::log("ant,action:index-fund-detail,指基收益列表单击详情"); // 记录日志
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Fund::find()->where(['id' => $id])->asArray()->one();
		return $this->render('index-fund-detail', [
		    'info' => $info,
		]);
	}
}