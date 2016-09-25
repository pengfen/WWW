<?php
namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

// 支付宝收益表 2016-09-25
class Gold extends ActiveRecord {
	
	// 定义对应的表名
	public static function tableName() {
		return '{{%gold}}';
	}
	
	// 校验规则
	public function rules() {
		return [
		    ['revenue', 'required', 'message'=>'昨日收益不能为空'],
		];
	}
	
	// 添加数据
	public function add($data) {
		$gold = new self;
		
		// 查询上次记录总金额 总收益
		$info = $gold::find()->select('amount, total_revenue')->orderBy(['id' => SORT_DESC])->one();
		$amount = 0;
		$total = 0;
		if ($info) {
			$amount = $info['amount'];
			$total = $info['total_revenue'];
		}
		
		$revenue = $data['revenue'];
		$money = $data['money']?$data['money']:0;
		
		// 处理总金额
		if ($data['amount']) {
			$gold->amount = $data['amount'];
		} else {
			$gold->amount = $amount + $money + $revenue;
		}
		
		$gold->revenue = $revenue;
		$gold->money = $money;
		$gold->addtime = time();
		// 获取当前管理员 id
		$manager = Yii::$app->session->get('manager');
		$gold->uid = $manager['id'];
		$gold->type = $data['type'];
		$gold->note = $data['note'];
		$gold->current_price = $data['current_price'];
		
		// 计算黄金持有克数 总价/现价 保留四位小数
		$gold->hold_gold = round($gold->amount / $data['current_price'], 4);
		
		// 处理总收益
		$gold->total_revenue = $total + $revenue;
		
		return $gold->save();
	}
}