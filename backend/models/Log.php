<?php

namespace backend\models;
use yii\db\ActiveRecord;

use Yii;

// ������־ 2016-09-16
class Log extends ActiveRecord {
	
	// �����Ӧ�ı���
	public static function tableName() {
		return '{{%log}}';
	}
	
	// �б�����
	public static function getinfo($id = '') {
		$log = new self;
		if ($id) {
			$info = $log::find()->select('id, content, uid, rectime')->where(['id' => $id])->asArray()->one();
		} else {
			$info = $log::find()->select('id, content, uid, rectime')->asArray()->all();
		}
		return $info;
	}
	
	// ��¼������־
	public function log($msg) {
		// ��ȡ��ǰ����Ա id
		$manager = Yii::$app->session->get('manager');
		$mid = $manager['id'];
		$time = date("Y-m-d H:i:s", time());
		\Yii::error("<time>{$time}</time><text>id:{$mid},controller:{$msg}</text>", 'catalog');
	}
}