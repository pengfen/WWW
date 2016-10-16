<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Log;
use backend\models\Shares;
use backend\models\ShareRevenue;
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
	
	// ���ذ��
	public function actionIndex() {
		$text=file_get_contents("http://quote.eastmoney.com/center/BKList.html#trade_0_0?sortRule=0"); //��url��ַ��ҳ�����ݱ����$text

		preg_match('/<div([^<>]*)>([^<>]*)<\/div>/', $text, $title); 
        //��Ϊ�����е���Ʒ���Ʊ�ǩû������class��id���򲻺�ץȡ����ץ<title>��ǩ�е������ˣ�һ����˵title�����ݾ�����Ʒ�����ˣ�ʵ����Щ���룩��$title[0]����title��ǩ $title[1]��ǩ�����ݣ�
		//$title=iconv('GBK','UTF-8',$title);
		var_dump($title);
		exit;
		
		$url = "http://quote.eastmoney.com/center/BKList.html#trade_0_0?sortRule=0";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);		// ���÷�����ҳ��URL
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);			// ִ��֮��ֱ�Ӵ�ӡ����
		$content = curl_exec($curl);
		curl_close($curl);
		// �����ݽ���ƥ��
		//echo $content;
		$content = iconv("gbk", "UTF-8", $content); // �����ݽ��д���
		echo '-------------------------------------------<br/>';
		$pattern = "#<table.+?>(.+?)</table>#";
		preg_match_all($pattern, $content, $matches);
		print_r($matches);
		//echo iconv("gb2312", "UTF-8", $content); // �����ݽ��д���
		exit;
	}
	
	// ���ع�Ʊ����
	
	// ��Ʊ�˻��б�
	public function actionAccount() {
		$info = Account::find()->select('id,uid,amount,addtime,total_revenue')->orderBy(['id' => SORT_DESC])->asArray()->all(); 
		Log::log("shares,action:account,��Ʊ�˺��б�"); // ��¼��־
		return $this->render('account', [
		    'info' => $info,
		]);
	}
	
	// ��ӹ�Ʊ�˻�����
	public function actionAccountAdd() {
		$data = Yii::$app->request->post();
		if ($data) {
			Log::log("shares,action:account-add,���������浥��������水ť"); // ��¼��־
			Shares::addAccount($data);
		} else {
			Log::log("shares,action:account-add,��Ʊ�˺��б���������水ť"); // ��¼��־
		}
		return $this->render('account-add');
	}
	
	// ��Ʊ�˻���������
	public function actionAccountDetail() {
		Log::log("shares,action:account-detail,��Ʊ�˺��б�������"); // ��¼��־
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Account::find()->where(['id' => $id])->asArray()->one();
		return $this->render('account-detail', [
		    'info' => $info,
		]);
	}
	
	// ��Ʊ�б�
	public function actionShare() {
		$info = Shares::find()->select('id,uid,name,share_code,addtime')->orderBy(['id' => SORT_DESC])->asArray()->all(); 
		Log::log("shares,action:share,��Ʊ�б�"); // ��¼��־
		return $this->render('share', [
		    'info' => $info,
		]);
	}
	
	// ��ӹ�Ʊ
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
	
	// ��Ʊ����
	public function actionShareDetail() {
		Log::log("shares,action:share-detail,��Ʊ�˺��б�������"); // ��¼��־
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Shares::find()->where(['id' => $id])->asArray()->one();
		return $this->render('share-detail', [
		    'info' => $info,
		]);
	}
	
	// ��Ʊ�����б�
	public function actionRevenue() {
		$info = Shares::getRevenue();
		//$info = Shares::find()->select('id,uid,name,share_code,addtime')->orderBy(['id' => SORT_DESC])->asArray()->all(); 
		Log::log("shares,action:share,��Ʊ�˺��б�"); // ��¼��־
		return $this->render('revenue', [
		    'info' => $info,
		]);
	}
	
	// ��ӹ�Ʊ����
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
	
	// ��Ʊ��������
	public function actionRevenueDetail() {
		Log::log("shares,action:revenue-detail,��Ʊ�˺��б�������"); // ��¼��־
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = ShareRevenue::find()->where(['id' => $id])->asArray()->one();
		return $this->render('revenue-detail', [
		    'info' => $info,
		]);
	}
	
}