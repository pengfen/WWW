<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Log;
use backend\models\Pay;

/**
 * ���Ͼ۱���� (֧��������б�)
 * ����: caopeng
 * ʱ��: 2016-09-24
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
		$info = Pay::find()->select('id,uid,amount,addtime,total_revenue')->asArray()->all(); 
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
		Log::log("auth,action:pay-detail,֧��������б�������"); // ��¼��־
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Pay::find()->where(['id' => $id])->asArray()->one();
		return $this->render('pay-detail', [
		    'info' => $info,
		]);
	}
}