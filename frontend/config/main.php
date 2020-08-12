<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'debug'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'debug' => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['1.2.3.4', '127.0.0.1', '::1']
        ],
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'] // регулируйте в соответствии со своими нуждами
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'enableCsrfValidation' => false,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'residentname/main-page',
<<<<<<< HEAD

                'countries' => 'residentname/countries-list',
                'cities' => 'residentname/cities-list',
=======
                'countries' => 'residentname/countries-list',
                'cities' => 'residentname/cities-list',
                'sitemap.xml' => 'residentname/sitemap-xml',

>>>>>>> 9195b6c481c31042c3de54aec93d97fba0b124f4
                [
                    'class' => 'frontend\modules\url\components\SearchCityUrlRule',
                ],
                [
                    'class' => 'frontend\modules\url\components\CountryUrlRule',
                ],

            ],

        ],


    ],
    'params' => $params,
];


