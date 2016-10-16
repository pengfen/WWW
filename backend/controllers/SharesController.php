<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Log;
use backend\models\Shares;
use backend\models\ShareRevenue;
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
	
	// 下载板块
	public function actionIndex() {
		$text=file_get_contents("http://quote.eastmoney.com/center/BKList.html#trade_0_0?sortRule=0"); //将url地址上页面内容保存进$text

		preg_match('/<div([^<>]*)>([^<>]*)<\/div>/', $text, $title); 
        //因为正文中的商品名称标签没有特殊class或id正则不好抓取，就抓<title>标签中的内容了，一般来说title中内容就是商品名称了（实际有些出入），$title[0]整个title标签 $title[1]标签中内容；
		//$title=iconv('GBK','UTF-8',$title);
		var_dump($title);
		exit;
		
		$url = "http://quote.eastmoney.com/center/BKList.html#trade_0_0?sortRule=0";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);		// 设置访问网页的URL
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);			// 执行之后不直接打印出来
		$content = curl_exec($curl);
		curl_close($curl);
		// 对内容进行匹配
		//echo $content;
		$content = iconv("gbk", "UTF-8", $content); // 对内容进行处理
		echo '-------------------------------------------<br/>';
		$pattern = "#<table.+?>(.+?)</table>#";
		preg_match_all($pattern, $content, $matches);
		print_r($matches);
		//echo iconv("gb2312", "UTF-8", $content); // 对内容进行处理
		exit;
	}
	
	// 下载股票数据
	
	// 股票账户列表
	public function actionAccount() {
		$info = Account::find()->select('id,uid,amount,addtime,total_revenue')->orderBy(['id' => SORT_DESC])->asArray()->all(); 
		Log::log("shares,action:account,股票账号列表"); // 记录日志
		return $this->render('account', [
		    'info' => $info,
		]);
	}
	
	// 添加股票账户收益
	public function actionAccountAdd() {
		$data = Yii::$app->request->post();
		if ($data) {
			Log::log("shares,action:account-add,添加收益界面单击添加收益按钮"); // 记录日志
			Shares::addAccount($data);
		} else {
			Log::log("shares,action:account-add,股票账号列表单击添加收益按钮"); // 记录日志
		}
		return $this->render('account-add');
	}
	
	// 股票账户收益详情
	public function actionAccountDetail() {
		Log::log("shares,action:account-detail,股票账号列表单击详情"); // 记录日志
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Account::find()->where(['id' => $id])->asArray()->one();
		return $this->render('account-detail', [
		    'info' => $info,
		]);
	}
	
	// 股票列表
	public function actionShare() {
		$info = Shares::find()->select('id,uid,name,share_code,addtime')->orderBy(['id' => SORT_DESC])->asArray()->all(); 
		Log::log("shares,action:share,股票列表"); // 记录日志
		return $this->render('share', [
		    'info' => $info,
		]);
	}
	
	// 添加股票
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
	
	// 股票详情
	public function actionShareDetail() {
		Log::log("shares,action:share-detail,股票账号列表单击详情"); // 记录日志
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = Shares::find()->where(['id' => $id])->asArray()->one();
		return $this->render('share-detail', [
		    'info' => $info,
		]);
	}
	
	// 股票收益列表
	public function actionRevenue() {
		$info = Shares::getRevenue();
		//$info = Shares::find()->select('id,uid,name,share_code,addtime')->orderBy(['id' => SORT_DESC])->asArray()->all(); 
		Log::log("shares,action:share,股票账号列表"); // 记录日志
		return $this->render('revenue', [
		    'info' => $info,
		]);
	}
	
	// 添加股票收益
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
	
	// 股票收益详情
	public function actionRevenueDetail() {
		Log::log("shares,action:revenue-detail,股票账号列表单击详情"); // 记录日志
		$get = Yii::$app->request->get();
		$id = $get['id'];
		$info = ShareRevenue::find()->where(['id' => $id])->asArray()->one();
		return $this->render('revenue-detail', [
		    'info' => $info,
		]);
	}
	
}