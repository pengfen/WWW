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
		    ['revenue', 'required', 'message'=>'昨日收益不能为空'],
		];
	}
	
	// 添加数据
	public function add($data) {
		$pay = new self;
		
		// 查询上次记录总金额 总收益
		$info = $pay::find()->select('amount, total_revenue')->orderBy(['id' => SORT_DESC])->one();
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
			$pay->amount = $data['amount'];
		} else {
			$pay->amount = $amount + $money + $revenue;
		}
		
		$pay->revenue = $revenue;
		$pay->money = $money;
		$pay->addtime = time();
		// 获取当前管理员 id
		$manager = Yii::$app->session->get('manager');
		$pay->uid = $manager['id'];
		$pay->type = $data['type'];
		$pay->note = $data['note'];
		
		// 处理总收益
		$pay->total_revenue = $total + $revenue;
		
		return $pay->save();
	}
}