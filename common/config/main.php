<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
	    'request' => [
		    'cookieValidationKey' => 'resource',
			'enableCsrfValidation' => false,
		],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
