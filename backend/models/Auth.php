<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Auth extends ActiveRecord {
	
	public static function tableName() {
		return '{{%auth}}';
	}
	
	
}