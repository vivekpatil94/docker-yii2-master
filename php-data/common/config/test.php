<?php
return [
    'id' => 'app-common-tests',
    'basePath' => dirname(__DIR__),
    'components' => [
        'db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=172.22.0.1;dbname=yii2advanced',
        'username' => 'yii2advanced',
        'password' => 'yii2advanced',
        'charset' => 'utf8',
        ],
        'user' => [
            'class' => \yii\web\User::class,
            'identityClass' => 'common\models\User',
        ],
    ],
];
