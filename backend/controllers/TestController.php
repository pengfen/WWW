<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Se_auth;

/**
 * 测试控制器
 * 作者: caopeng
 * 时间: 2016-09-18
*/
class TestController extends Controller
{
	// 测试
	public function actionIndex()
	{
		$model = new Se_auth();
		var_dump($model);
		exit;
	}
}