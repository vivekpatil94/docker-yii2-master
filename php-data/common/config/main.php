<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=db;dbname=yii2advanced',
        'username' => 'yii2advanced',
        'password' => 'yii2advanced',
        'charset' => 'utf8',
        ],
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
    ],
];
