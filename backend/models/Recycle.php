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
	
	// 列表数据
	public static function getinfo($id = '') {
		$recycle = new self;
		if ($id) {
			$info = $recycle::find()->select('id, uid, image, addtime')->where(['id' => $id])->asArray()->one();
		} else {
			$info = $recycle::find()->select('id, uid, image, addtime')->asArray()->all();
		}
		return $info;
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
	
	// 删除
	public static function del($id) {
		$info = static::findOne($id);
		$img = $info->image;
		$res = $info->delete(); // 删除数据库中删除
		if ($res) {
			if (is_file($img)) {
				unlink($img); // 删除主机物理图片
			}
		}
	}
}