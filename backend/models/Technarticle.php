<?php
namespace backend\models;

use yii\db\ActiveRecord;

// �������±�
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