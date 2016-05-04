<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
            // 'suffix' => '.html',
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
            ],
        ],
        'assetManager' => [
            // 当某个资源名等于key时，自动将它换成这个value
            // 'assetMap' => [
                // 'jquery.js' => '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js',
            // ],
            'linkAssets' => true, //开启动态链接来引用资源，并不一定要在web目录
            'appendTimestamp' => true,
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-red',
                ],
            ],
        ],
        // 'view' => [
            // 'theme' => [
                // 'pathMap' => [
                // '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                // // '@app/views' => '@vendor/p2made/yii2-sb-admin-theme/views/sb-admin-2',
                // ],
            // ],
        // ],
        
    ],
    'params' => $params,
];
