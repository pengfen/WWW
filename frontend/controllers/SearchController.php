<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\EAuth;
use frontend\models\Auth;
use yii\helpers\ArrayHelper;

class SearchController extends Controller
{
	// 添加数据
	public function actionAdd() 
	{
		$info = Auth::find()->select("id, name, pid, controller, action")->asArray()->all();
		$auth = new EAuth();
		foreach ($info as $key => $value) {
			$auth->primaryKey = $value['id'];
			$auth->name = $value['name'];
			$auth->pid = $value['pid'];
			$auth->controller = $value['controller'];
			$auth->action = $value['action'];
			$res = $auth->save();
		}
	}

	// 查询
	public function actionIndex()
	{
		$auth = EAuth::findOne(1);
		$data = ArrayHelper::toArray($auth);
		var_dump($data);

		// 获取索引 _index
		$index = EAuth::index();
		echo '当前索引是 : '.$index;

		// 获取类型 _type
		$type = EAuth::type();
		echo '当前类型是 : '.$type;

		// 查询所有记录
		$auths = EAuth::find()->all();
		echo '所有记录 : ';
		var_dump($auths);

		// 通过映射字段查询一条记录
		$auth = EAuth::find()->query(['match' => ['name' => '权'] ])->asArray()->one();
		var_dump($auth);
	}

	// 更新数据
	public function actionUpdate()
	{
		$id = 1;
		$name = "测试更新";
		$auth = EAuth::findOne($id);
		if (empty($auth)) {
			exit;
		}
		$auth->name = $name;
		if ($auth->update() == false) {
			echo '更新失败';
		} else {
			echo '更新成功';
		}

		// 更新所有数据
		// $auth::updateAll(['name' => ''], ['name' => '']);
	}

	// 删除数据
	public function actionIndex()
	{
		$auth = EAuth::findOne(1);
		if (empty($auth)) {
			exit;
		}
		$auth->delete();

		// 批量删除
		// $auth::deleteAll(['address' => '']);
	}
}