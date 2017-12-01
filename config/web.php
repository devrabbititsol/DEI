<?php

$params = require(__DIR__ . '/params.php');
#$db = require(__DIR__ . '/db.php');
$functions = require(__DIR__ . '/functions.php');



$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'home/index',
    'timeZone' => 'Asia/Calcutta',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'HcaQILD9OchswVYbhCf4Jrlue8gBORzw',
            'enableCookieValidation' => false, 
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'dei/errorexception',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@app/mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'eshwar.allaka@gmail.com',
                'password' => 'pasbpcykgaoycjna',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => [
                    'class' => 'yii\db\Connection',
                    'dsn' => 'mysql:host=localhost;dbname=dei_db',
                    'username' => 'bei_admin',
                    'password' => 'ka1La5a$',
                    'charset' => 'utf8',
                ],
        //disable jquery loading form yii
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js'=>[]
                ],
            ],
        ],
        
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'admin/<action:\w+>/<id:\d+>' => 'admin/<action>',
                'admin' => 'admin/index',
                'admin/<action:(.*)>' => 'admin/<action>',
                'admin/<action:(.*)/<id:\d+>'=>'admin/<action>',
                '<action:(.*)>' => 'dei/<action>',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
