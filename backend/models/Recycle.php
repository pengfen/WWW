<?php

namespace backend\models;

use yii\db\ActiveRecord;
use Yii;

// 回收表 2016-09-15
class Recycle extends ActiveRecord {
	
	// 定义对应的表名
	public static function tableName() {
		return '{{%recycle}}';
	}
	
	// 添加
	public static function add($data) {
		$recycle = new self;
		// 获取当前管理员 id
		$manager = Yii::$app->session->get('manager');
		$recycle->uid = $manager['id'];
		$recycle->image = $data['image'];
		$recycle->addtime = time();
		return $recycle->save();
	}
}