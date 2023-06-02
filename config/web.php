<?php

use yii\symfonymailer\Mailer;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id'         => 'basic',
    'basePath'   => dirname(__DIR__),
    'bootstrap'  => ['log'],
    'aliases'    => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request'      => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'aYov1wK2kdYLwGpapu3z9bq0hh_M4s1h',
            'parsers'             => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        'user'         => [
            'identityClass'   => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer'       => [
            'class'            => Mailer::class,
            'viewPath'         => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db'           => $db,
        'urlManager'   => [
            'enablePrettyUrl'     => true,
            'enableStrictParsing' => false,
            'showScriptName'      => false,
            'rules'               => [
                // Admin routes
                'admin/books'                   => 'admin/books/index',
                'admin/books/<id:\d+>'          => 'admin/books/update',
                'admin/books/create'            => 'admin/books/update',
                'admin/books/delete/<id:\d+>'   => 'admin/books/delete',
                'admin/authors'                 => 'admin/authors/index',
                'admin/authors/<id:\d+>'        => 'admin/authors/update',
                'admin/authors/create'          => 'admin/authors/update',
                'admin/authors/delete/<id:\d+>' => 'admin/authors/delete',

                // Public routes
                'books'                         => 'books/index',
                'authors'                       => 'authors/index',

                // API routes
                [
                    'class'         => 'yii\rest\UrlRule',
                    'pluralize'     => false,
                    'controller'    => ['api/v1/books' => 'api/book-api'],
                    'extraPatterns' => [
                        'GET list'           => 'list',
                        'GET by-id/<id:\d+>' => 'by-id',
                        'POST update'        => 'update',
                        'DELETE <id:\d+>'    => 'delete',
                    ],
                ],
            ],
        ],
    ],
    'params'     => $params,
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
        'class'      => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '*'],
    ];
}

return $config;
