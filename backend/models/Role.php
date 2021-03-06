<?php
namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

// 角色表 2016-09-15
class Role extends ActiveRecord {
	
	// 定义对应的表名
	public static function tableName() {
		return '{{%role}}';
	}
	
	// 列表数据
	public static function getinfo($id = '') {
		$manager = new self;
		if ($id) {
			$info = $manager::find()->select('id, name, addtime')->where(['id' => $id])->asArray()->one();
		} else {
			$info = $manager::find()->select('id, name, addtime')->asArray()->all();
		}
		return $info;
	}
	
	// 添加数据
	public static function add($data) {
		$role = new self;
		$role->name = $data['name'];
		// 获取当前管理员 id
		$manager = Yii::$app->session->get('manager');
		$role->uid = $manager['id'];
		$role->addtime = time();
		$role->save();
	}
}