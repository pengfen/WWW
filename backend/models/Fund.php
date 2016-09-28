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
		    ['revenue', 'required', 'message'=>'昨日收益不能为空'],
		];
	}
	
	// 添加数据
	public function add($data) {
		$fund = new self;
		$fund->name = $data['name'];
		$fund->revenue = $data['revenue'];
		$fund->amount = $data['amount'];
		// 处理总收益
		$fund->total_revenue = $data['total_revenue'];
		
		$fund->addtime = time();
		// 获取当前管理员 id
		$manager = Yii::$app->session->get('manager');
		$fund->uid = $manager['id'];
		return $fund->save();
	}
}