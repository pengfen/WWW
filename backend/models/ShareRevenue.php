<?php
namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;

// 股票收益表 2016-10-08
class ShareRevenue extends ActiveRecord {
	
	// 定义对应的表名
	public static function tableName() {
		return '{{%share_revenue}}';
	}
	
	// 校验规则
	public function rules() {
		return [
		    //['revenue', 'required', 'message'=>'昨日收益不能为空'],
		];
	}
}