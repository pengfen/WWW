<?php
namespace backend\models;

use yii\db\ActiveRecord;

// �������±� 2016-09-15
class Technarticle extends ActiveRecord {
	
	// �����Ӧ�ı���
	public static function tableName() {
		return '{{%techn_article}}';
	}
	
	// У�����
	public function rules() {
		return [
		    ['title', 'required', 'message'=>'���ⲻ��Ϊ��'],
			['content', 'required', 'message'=>'���ݲ���Ϊ��'],
		];
	}
	
}