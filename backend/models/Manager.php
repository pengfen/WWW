<?php
namespace backend\models;

use yii\db\ActiveRecord;

// 管理员表
class Manager extends ActiveRecord {
	
	// 定义对应的表名
	public static function tableName() {
		return '{{%manager}}';
	}
	
}