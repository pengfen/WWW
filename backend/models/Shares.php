<?php
namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;

// 股票 2016-10-07
class Shares extends ActiveRecord {
	
	const ACCOUNT = '{{%share_account}}'; // 股票账号收益表
	const REVENUE = '{{%share_revenue}}'; // 股票平台收益表
	
	// 定义对应的表名
	public static function tableName() {
		return '{{%share}}';
	}
	
	// 校验规则
	public function rules() {
		return [
		    //['revenue', 'required', 'message'=>'昨日收益不能为空'],
		];
	}
	
	// 获取收益列表数据
	public function getRevenue() {
		$query = new Query();
		$data = $query->select("id,uid,market_value,daily_pl,addtime")->from(self::REVENUE)->all();
		return $data;
	}
	
    // 添加股票数据
	public function add($data) {
		$share = new self;
		
		// 处理添加股票数据
		$share->name = $data['name'];
		$share->share_code = $data['share_code'];
		$share->addtime = time();
		// 获取当前管理员 id
		$manager = Yii::$app->session->get('manager');
		$share->uid = $manager['id'];
		return $share->save();
	}
	
	// 添加股票收益
	public function addRevenue($data) {
		$revenue = new ShareRevenue();
		
		// 处理添加收益
		if (isset($data['flag']) && $data['flag'] == 1) {
			$revenue->sid = $data['sid'];
			$revenue->current_rate = $data['current_rate'];
			$revenue->volume = $data['volume'];
			$revenue->market_value = round($data['current_rate'] * $data['volume'], 2);
			$revenue->type = $data['type'];
			$revenue->money = $data['money'];
			$revenue->addtime = time();
			// 获取当前管理员 id
			$manager = Yii::$app->session->get('manager');
			$revenue->uid = $manager['id'];
			return $revenue->save();
		} else {
			$sid = $data['sid'];
			$info = $revenue::find()->select('current_rate,volume,type,money')->where(['sid' => $sid])->orderBy(['id' => SORT_DESC])->one();
			$revenue->current_rate = $info['current_rate'];
			$revenue->volume = $info['volume'];
			$revenue->type = $info['type'];
			$revenue->money = $info['money'];
			$revenue->sid = $data['sid'];
			$revenue->market_value = $data['market_value'];
			$revenue->daily_pl = $data['daily_pl'];
			$revenue->current_price = $data['current_price'];
			$revenue->addtime = time();
			// 获取当前管理员 id
			$manager = Yii::$app->session->get('manager');
			$revenue->uid = $manager['id'];
			return $revenue->save();
		}
	}
	
	// 添加数据
	public function addAccount($data) {
		$account = new self;
		
		// 处理添加收益
		if (isset($data['flag']) && $data['flag'] == 1) {
			$account->amount = $data['amount'];
			$account->total_market_value = $data['total_market_value'];
			$account->float_pl = $data['float_pl'];
			$account->daily_pl = $data['daily_pl'];
			$account->advisable = $data['advisable'];
			$account->available = $data['available'];
		    $account->total_revenue = $data['total_revenue'];
		} else {
			// 查询上次记录总金额 总收益
			$info = $account::find()->select('amount,total_market_value,float_pl,daily_pl,advisable,available,total_revenue')->orderBy(['id' => SORT_DESC])->one();
			$amount = 0;
			$total = 0;
			// 查询上一次总收益,总金额
			if ($info) {
				$amount = $info['amount'];
				$account->type = $data['type'];
				$money = $data['money'];
				if (!$money) {
					return '';
				}
				// 0 转入 1 转出
				if ($data['type'] == 1) {
					$account->amount = $amount - $money;
				} else {
					$account->amount = $amount + $money;
				}
				$account->total_market_value = $info['total_market_value'];
				$account->float_pl = $info['float_pl'];
				$account->daily_pl = $info['daily_pl'];
				$account->advisable = $info['advisable'];
				$account->available = $info['available'];
				$account->total_revenue = $info['total_revenue'];
				$account->money = $money;
			} 
		}
		
		$account->addtime = time();
		// 获取当前管理员 id
		$manager = Yii::$app->session->get('manager');
		$account->uid = $manager['id'];
		return $account->save();
	}
}