<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id'            => 'basic',
    'name'          => 'SILAB IONIC',
    'basePath'      => dirname(__DIR__),
    'bootstrap'     => ['log'],
    'components'    => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'y_E3Lk1sbGa9lpCOHzfD7TftP4_NDNhn',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass'     => 'app\modules\admin\models\Usuario',
            'enableAutoLogin'   => true,
            'enableSession'     => true
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class'         => 'Swift_SmtpTransport',
                'host'          => 'smtp.gmail.com',
                'username'      => 'jeancaseven@gmail.com',
                'password'      => 'jeancarlo',
                'port'          => '587',
                'encryption'    => 'tls',
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
        'db' => require(__DIR__ . '/db.php'),
        
        'urlManager' => [
            'enablePrettyUrl'   => true,
            'showScriptName'    => false,
            'rules' => [
                'admin/manager/index'                           =>  'admin/manager/index',
                'admin/manager/<action:(?!index$)[\w\s]+>'      =>  'admin/manager/redirect',
                'laboratorio/manager/<alias:[a-zA-Z\-]+>/'      =>  'laboratorio/manager',
                'laboratorio/manager/<id:\d+>/'                 =>  'laboratorio/manager',
                'laboratorio/<alias:[a-zA-Z\-]+>/inventarios'   =>  'laboratorio/get-inventarios',
                'laboratorio/<id:\d+>/inventarios'              =>  'laboratorio/get-inventarios'
            ],
        ],
        
    ],
    'params'    => $params,
    'modules'   => [
        'admin' => [
            'class'     => 'app\modules\admin\Admin',
            'basePath'  => '@app/modules/admin'
        ],
        'inventario' => [
            'class' => 'app\modules\inventario\Inventario',
            'basePath'  => '@app/modules/inventario'            
        ],
        'notifications' => [
            'class' => 'machour\yii2\notifications\NotificationsModule',
            // Point this to your own Notification class
            // See the "Declaring your notifications" section below
            'notificationClass' => 'app\components\Notification',
            // Allow to have notification with same (user_id, key, key_id)
            // Default to FALSE
            'allowDuplicate' => true,
            // This callable should return your logged in user Id
            'userId' => function() {
                return \Yii::$app->user->id;
            }
        ],
        'gridview' => [ 'class' => '\kartik\grid\Module' ]
    ],
];

if (YII_ENV_DEV) 
{
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][]      = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][]      = 'gii';
    $config['modules']['gii']   = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
