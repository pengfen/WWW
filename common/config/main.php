<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
	    'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=192.168.179.129;dbname=resource',
            'username' => 'caopeng',
            'password' => '1234560.',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
