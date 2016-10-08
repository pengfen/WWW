<?php
namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;

// 股票账号收益表 2016-10-08
class ShareAccount extends ActiveRecord {
	
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
}