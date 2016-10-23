<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Log;
use backend\models\Pay;
use backend\models\Gold;
use backend\models\Fund;

/**
 * ���Ͼ۱���� (֧��������б�, �ƽ�����б�, ָ������б�)
 * ����: caopeng
 * ʱ��: 2016-09-24
 * 
 * �޸ļ�¼
 * 2016/10/23 �޸Ļƽ����(�������һ����¼����У��)
 */
class AntController extends Controller
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
	public function actionPay() {
		$info = Pay::find()->select('id,uid,amount,addtime,total_revenue')->orderBy(['id' => SORT_DESC])->asArray()->all(); 
		Log::log("ant,action:pay,֧��������б�"); // ��¼��־
		return $this->render('pay', [
		    'info' => $info,
		]);
	}
	
	// ���֧��������
	public function actionPayAdd() {
		$data = Yii::$app->request->post();
		if ($data) {
			Log::log("ant,action:pay-add,���������浥��������水ť"); // ��¼��־
			Pay::add($data);
		} else {
			Log::log("ant,action:pay-add,֧��������б���������水ť"); // ��¼��־
		}
		return $this->render('pay-add');
	}
	
	// ֧������������
	public function actionPayDetail() {
		Log::log("ant,action:pay-detail,֧��������б�������"); // ��¼��־
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Pay::find()->where(['id' => $id])->asArray()->one();
		return $this->render('pay-detail', [
		    'info' => $info,
		]);
	}
	
	// �ƽ�(���)�����б�
	public function actionGold() {
		$info = Gold::find()->select('id,uid,amount,addtime,total_revenue')->orderBy(['id' => SORT_DESC])->asArray()->all(); 
		Log::log("ant,action:gold,�ƽ������б�"); // ��¼��־
		return $this->render('gold', [
		    'info' => $info,
		]);
	}
	
	// ��ӻƽ�����
	public function actionGoldAdd() {
		$data = Yii::$app->request->post();
		if ($data) {
			Log::log("ant,action:gold-add,���������浥��������水ť"); // ��¼��־
			Gold::add($data);
		} else {
			Log::log("ant,action:gold-add,�ƽ������б���������水ť"); // ��¼��־
		}
		return $this->render('gold-add');
	}
	
	// �޸Ļƽ�����
	public function actionGoldEdit() {
		$get = Yii::$app->request->get();
		if ($get) {
			$id = $get['id'];
		    $info = Gold::find()->select("id,amount,total_revenue,current_price")->where(['id' => $id])->one();
		}
		
		$data = Yii::$app->request->post();
		if ($data) {
			Log::log("ant,action:gold-edit,�޸Ļƽ������б����޸����水ť"); // ��¼��־
			Gold::edit($data);
			return Yii::$app->getResponse()->redirect('/index.php?r=ant/gold');
		} else {
			Log::log("ant,action:gold-add,�ƽ������б����޸����水ť"); // ��¼��־
			return $this->render('gold-edit', [
				'info' => $info,
			]);
		}
	}
	
    // �ƽ���������
	public function actionGoldDetail() {
		Log::log("ant,action:gold-detail,�ƽ������б�������"); // ��¼��־
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Gold::find()->where(['id' => $id])->asArray()->one();
		return $this->render('gold-detail', [
		    'info' => $info,
		]);
	}
	
	// ָ�������б�
	public function actionIndexFund() {
		$info = Fund::find()->select('id,amount,revenue,addtime,total_revenue')->orderBy(['id' => SORT_DESC])->asArray()->all(); 
		Log::log("ant,action:index-fund,ָ�������б�"); // ��¼��־
		return $this->render('index-fund', [
		    'info' => $info,
		]);
	}
	
	// ���ָ������
	public function actionIndexFundAdd() {
		$data = Yii::$app->request->post();
		if ($data) {
			Log::log("ant,action:index-fund-add,���������浥��������水ť"); // ��¼��־
			Fund::add($data);
		} else {
			Log::log("ant,action:index-fund-add,ָ�������б���������水ť"); // ��¼��־
		}
		return $this->render('index-fund-add');
	}
	
	// ָ����������
	public function actionIndexFundDetail() {
		Log::log("ant,action:index-fund-detail,ָ�������б�������"); // ��¼��־
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Fund::find()->where(['id' => $id])->asArray()->one();
		return $this->render('index-fund-detail', [
		    'info' => $info,
		]);
	}
}