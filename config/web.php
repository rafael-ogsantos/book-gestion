<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$laravelContainer = require __DIR__ . '/laravel.php';

return [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
        'client' => [
            'class' => 'app\modules\client\Module',
        ],
        'book' => [
            'class' => 'app\modules\book\Module',
        ],
        'auth' => [
            'class' => 'app\modules\auth\Module',
        ],
    ],
    'components' => [
        'cors' => [
            'class' => \yii\filters\Cors::class,
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'XNa77ip_D1Lshg_-MYHhhC85sh-tfOxa',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'response' => [
            'format' => \yii\web\Response::FORMAT_JSON,
            'charset' => 'UTF-8',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'enableSession' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
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
            'enableStrictParsing' => false,
            'rules' => [
                'GET api/clients' => 'client/client/index',
                'POST api/clients' => 'client/client/create',

                'GET api/books' => 'book/book/index',
                'POST api/books' => 'book/book/create',

                'GET api/users' => 'user/user/index',
                'POST api/users' => 'user/user/create',

                'POST api/auth/login' => 'auth/auth/login',
            ],
        ],
        'laravelContainer' => $laravelContainer,
    ],
    'container' => [
        'definitions' => [
            'app\application\services\BookService' => [
                'class' => 'app\modules\book\BookService',
                'constructor' => [
                    'externalApiClient' => 'app\api\ExternalApiClient',
                ],
            ],
            'app\api\ExternalApiClient' => [
                'class' => 'app\api\ExternalApiClient',
            ],
            'app\application\services\AuthService' => [
                'class' => 'app\modules\auth\AuthService',
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}