<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'jwt' => [
            'class' => \sizeg\jwt\Jwt::class,
            'key' => 'AIDKbalkrqT1cyzv',
            'jwtValidationData' => \app\components\JwtValidationData::class,
        ],
        'request' => [
            'cookieValidationKey' => 'AIDKbalkrqT1cyzvCpf3Ew6OxxNvvedi',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'baseUrl'=> '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
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
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/login' => '/rest/login',
                '/registration/expert' => '/rest/expert',
                '/registration/moderator' => '/rest/moderator',
                '/expert/<id:\d+>' => '/expert/index',
               '/expert/list/<id:\d+>/yes' => '/expert/yes',
                '/expert/list/<id:\d+>/no' => '/expert/no',
                '/estimation' => '/estimation/index',
                '/decisions' => '/decisions/decision',
                '/decisions/<id:\d+>' => '/decisions/index',
                '/estimation/<id:\d+>' => '/estimation/upload',
              //  '<controller>/<action>/<id:\d+>' => '<controller>/<action>',
                '<controller>/<action>/<page:\d+>' => '<controller>/<action>',
                ['class' => 'yii\rest\UrlRule', 'controller' => 'rest'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'expert'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'applications'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'estimation'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'decisions'],
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
