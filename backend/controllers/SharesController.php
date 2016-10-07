<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Log;
use backend\models\Shares;
use backend\models\Account;

/**
 * ��Ʊ��� (��Ʊ�˺��б�)
 * ����: caopeng
 * ʱ��: 2016-09-24
 */
class SharesController extends Controller
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
	
	// ֧��������б�
	public function actionAccount() {
		$info = Account::find()->select('id,uid,amount,addtime,total_revenue')->orderBy(['id' => SORT_DESC])->asArray()->all(); 
		Log::log("shares,action:account,��Ʊ�˺��б�"); // ��¼��־
		return $this->render('account', [
		    'info' => $info,
		]);
	}
	
	// ���֧��������
	public function actionAccountAdd() {
		$data = Yii::$app->request->post();
		if ($data) {
			Log::log("shares,action:account-add,���������浥��������水ť"); // ��¼��־
			Account::add($data);
		} else {
			Log::log("shares,action:account-add,��Ʊ�˺��б���������水ť"); // ��¼��־
		}
		return $this->render('account-add');
	}
	
	// ֧������������
	public function actionAccountDetail() {
		Log::log("shares,action:account-detail,��Ʊ�˺��б�������"); // ��¼��־
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Account::find()->where(['id' => $id])->asArray()->one();
		return $this->render('account-detail', [
		    'info' => $info,
		]);
	}
	
	// ֧��������б�
	public function actionShare() {
		$info = Shares::find()->select('id,uid,name,share_code,addtime')->orderBy(['id' => SORT_DESC])->asArray()->all(); 
		Log::log("shares,action:share,��Ʊ�˺��б�"); // ��¼��־
		return $this->render('share', [
		    'info' => $info,
		]);
	}
	
	// ���֧��������
	public function actionShareAdd() {
		$data = Yii::$app->request->post();
		if ($data) {
			Log::log("shares,action:share-add,���������浥��������水ť"); // ��¼��־
			Shares::add($data);
		} else {
			Log::log("shares,action:share-add,��Ʊ�˺��б���������水ť"); // ��¼��־
		}
		return $this->render('share-add');
	}
	
	// ֧������������
	public function actionShareDetail() {
		Log::log("shares,action:share-detail,��Ʊ�˺��б�������"); // ��¼��־
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Shares::find()->where(['id' => $id])->asArray()->one();
		return $this->render('share-detail', [
		    'info' => $info,
		]);
	}
	
	// ֧��������б�
	public function actionRevenue() {
		$info = Shares::getRevenue();
		//$info = Shares::find()->select('id,uid,name,share_code,addtime')->orderBy(['id' => SORT_DESC])->asArray()->all(); 
		Log::log("shares,action:share,��Ʊ�˺��б�"); // ��¼��־
		return $this->render('revenue', [
		    'info' => $info,
		]);
	}
	
	// ���֧��������
	public function actionRevenueAdd() {
		$info = Shares::find('id,name')->asArray()->all();
		$data = Yii::$app->request->post();
		if ($data) {
			Log::log("shares,action:revenue-add,���������浥��������水ť"); // ��¼��־
			Shares::addRevenue($data);
		} else {
			Log::log("shares,action:revenue-add,��Ʊ�˺��б���������水ť"); // ��¼��־
		}
		return $this->render('revenue-add', [
		    'info' => $info,
		]);
	}
	
	// ֧������������
	public function actionRevenueDetail() {
		Log::log("shares,action:revenue-detail,��Ʊ�˺��б�������"); // ��¼��־
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Shares::find()->where(['id' => $id])->asArray()->one();
		return $this->render('revenue-detail', [
		    'info' => $info,
		]);
	}
	
}