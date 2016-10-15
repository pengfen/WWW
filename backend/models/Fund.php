<?php
namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

// 指数基金表 2016-09-28
class Fund extends ActiveRecord {
	
	// 定义对应的表名
	public static function tableName() {
		return '{{%index_fund}}';
	}
	
	// 校验规则
	public function rules() {
		return [
		    //['revenue', 'required', 'message'=>'昨日收益不能为空'],
		];
	}
	
	// 添加数据
	public function add($data) {
		/**
		 * 2016-10-15 新需求 (只针对一个指基进行操作)
		 * 1 添加最新净值 计算持有份额 总收益 账户总收益
		 * 2 添加买卖记录
		*/
		$fund = new self;
		$info = $fund::find()->select('name,amount,total_revenue,account_revenue,now_worth')->orderBy(['id' => SORT_DESC])->one();
		if (isset($data['flag']) && $data['flag'] == 1) {
			$revenue = $data['revenue'];
			$fund->name = $data['name'];
			$fund->revenue = $revenue;
			$fund->amount = $data['amount'];
			if ($info) {
				// 处理总收益
			    $fund->total_revenue = $info['total_revenue'] + $revenue;
				$fund->account_revenue = $info['account_revenue'] + $revenue;
			} else {
				$fund->total_revenue = $revenue;
				$fund->account_revenue = $revenue;
			}
			$fund->now_worth = $data['now_worth'];
			$fund->hold_lot = round($fund->amount / $data['now_worth'], 2);
		} else {
			// 原数据
			$fund->name = $info['name'];
			$fund->total_revenue = $info['total_revenue'];
			$fund->account_revenue = $info['account_revenue'];
			$fund->now_worth = $info['now_worth'];
			$fund->type = $data['type'];
			
			// 计算得出 总金额 持有份额
			$money = $data['money']?$data['money']:0;
			$amount = $info['amount'];
			// 0 转入 1 转出
			if ($data['type'] == 1) {
				$fund->amount = $amount - $money;
			} else {
				$fund->amount = $amount + $money;
			}
			$fund->money = $money;
			$fund->note = $data['note'];
		    $fund->hold_lot = round($fund->amount / $info['now_worth'], 2);
		}
		
		
		$fund->addtime = time();
		// 获取当前管理员 id
		$manager = Yii::$app->session->get('manager');
		$fund->uid = $manager['id'];
		return $fund->save();
	}
}