<?php

namespace backend\models;
use yii\db\ActiveRecord;

use Yii;

// 操作日志 2016-09-16
class Log extends ActiveRecord {
	
	// 定义对应的表名
	public static function tableName() {
		return '{{%log}}';
	}
	
	// 列表数据
	public static function getinfo($id = '') {
		$log = new self;
		if ($id) {
			$info = $log::find()->select('id, content, uid, rectime')->where(['id' => $id])->asArray()->one();
		} else {
			$info = $log::find()->select('id, content, uid, rectime')->asArray()->all();
		}
		return $info;
	}
	
	// 记录操作日志
	public function log($msg) {
		// 获取当前管理员 id
		$manager = Yii::$app->session->get('manager');
		$mid = $manager['id'];
		$time = date("Y-m-d H:i:s", time());
		\Yii::error("<time>{$time}</time><text>id:{$mid},controller:{$msg}</text>", 'catalog');
	}
}