<?php
namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

// 支付宝收益表 2016-09-24
class Pay extends ActiveRecord {
	
	// 定义对应的表名
	public static function tableName() {
		return '{{%pay}}';
	}
	
	// 校验规则
	public function rules() {
		return [
		    //['revenue', 'required', 'message'=>'昨日收益不能为空'],
		];
	}
	
	// 添加数据
	public function add($data) {
		$pay = new self;
		
				// 查询上次记录总金额 总收益
		$info = $pay::find()->select('amount, total_revenue')->orderBy(['id' => SORT_DESC])->one();
		$amount = 0;
		$total = 0;
		// 查询上一次总收益,总金额
		if ($info) {
			$amount = $info['amount'];
			$total = $info['total_revenue'];
		}
		
		// 处理添加收益
		if ($data['flag'] == 1) {
			$revenue = $data['revenue'];
			// 处理总金额
			if ($data['amount']) {
				$pay->amount = $data['amount'];
			} else {
				$pay->amount = $amount + $revenue;
			}
			$pay->note = "支付宝收益";
			$pay->revenue = $revenue;
			// 处理总收益
		    $pay->total_revenue = $total + $revenue;
		} else {
			$pay->type = $data['type'];
			$money = $data['money']?$data['money']:0;
			echo $data['type'];
			echo 'money : '.$money;
			// 0 转入 1 转出
			if ($data['type'] == 1) {
				$pay->amount = $amount - $money;
			} else {
				$pay->amount = $amount + $money;
			}
			echo $pay->amount;
			$pay->money = $money;
			$pay->note = $data['note'];
			// 处理总收益
		    $pay->total_revenue = $total;
		}
		
		$pay->addtime = time();
		// 获取当前管理员 id
		$manager = Yii::$app->session->get('manager');
		$pay->uid = $manager['id'];
		return $pay->save();
	}
}