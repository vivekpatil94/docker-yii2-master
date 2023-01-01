<?php

return [
    'components' => [
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=db;port=3306;dbname=yii2advanced',
            'username' => 'yii2advanced',
            'password' => 'secret',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@common/mail',
        ],
    ],
];
