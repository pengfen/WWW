<?php
namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

// 支付宝收益表 2016-09-24
class Account extends ActiveRecord {
	
	// 定义对应的表名
	public static function tableName() {
		return '{{%share_account}}';
	}
	
	// 校验规则
	public function rules() {
		return [
		    //['revenue', 'required', 'message'=>'昨日收益不能为空'],
		];
	}
	
	// 添加数据
	public function add($data) {
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