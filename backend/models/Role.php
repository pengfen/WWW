<?php
namespace backend\models;

use yii\db\ActiveRecord;

// ��ɫ�� 2016-09-15
class Role extends ActiveRecord {
	
	// �����Ӧ�ı���
	public static function tableName() {
		return '{{%role}}';
	}
	
	// �б�����
	public static function getinfo($id = '') {
		$manager = new self;
		if ($id) {
			$info = $manager::find()->select('id, name, addtime')->where(['id' => $id])->asArray()->one();
		} else {
			$info = $manager::find()->select('id, name, addtime')->asArray()->all();
		}
		return $info;
	}
	
	// �������
	public static function add($data) {
		$manager = new self;
		$manager->name = $data['name'];
		$manager->addtime = time();
		$manager->save();
	}
}