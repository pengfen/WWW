<?php

namespace frontend\models;

use yii\elasticsearch\ActiveRecord;

class EAuth extends ActiveRecord
{
	// 属性列表
	public function attributes()
	{
		return ['id', 'name', 'pid', 'controller', 'action'];
	}

	// mapping
	// public static function mapping()
	// {
	// 	return [
	// 	    static::type() => [
	// 	        'properties' => [
	// 	            'id'         => ['type' => 'long'],
	// 	            'name'       => ['type' => 'string'],
	// 	            'pid'        => ['type' => 'long'],
	// 	            'controller' => ['type' => 'string'],
	// 	            'action'     => ['type' => 'string'],
	// 	            'created_at' => ['type' => 'long'],
	// 	        ]
	// 	    ],
	// 	];
	// }

	// //
	// public static function createIndex() 
	// {
	// 	$db = static::getDb();
	// 	$command = $db->createCommand();
	// 	$command->createIndex(static::index(), [])
	// }
}