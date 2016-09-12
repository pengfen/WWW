<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Auth extends ActiveRecord {
	
	public static function tableName() {
		return '{{%auth}}';
	}
	
	// 校验规则
	public function rules() {
		return [
		    ['name', 'required', 'message'=>'权限名不能为空'],
			['controller', 'required', 'message'=>'控制器名不能为空'],
			['action', 'required', 'message'=>'操作方法不能为空']
		];
	}
}