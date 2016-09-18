<?php
namespace backend\models;

use yii\db\ActiveRecord;

// 用户表 2016-09-15
class User extends ActiveRecord {
	
	// 定义对应的表名
	public static function tableName() {
		return '{{%manager}}';
	}
	
}