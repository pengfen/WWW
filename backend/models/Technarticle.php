<?php
namespace backend\models;

use yii\db\ActiveRecord;

// 技术文章表
class Technarticle extends ActiveRecord {
	
	// 定义对应的表名
	public static function tableName() {
		return '{{%techn_article}}';
	}
	
	// 校验规则
	public function rules() {
		return [
		    ['title', 'required', 'message'=>'标题不能为空'],
			['content', 'required', 'message'=>'内容不能为空'],
		];
	}
	
}