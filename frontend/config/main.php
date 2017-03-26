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
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    //这里是web目录的主键
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        //这里是user用户组件 可利用用于认证
        'user' => [
            //指定登录认证的类
            'identityClass' => '\frontend\models\Admin',
            //'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            'loginUrl' =>  ['back-login/login']
        ],
        //这里是session组件 可以定义自己指定类作为session组件
        'session' => [
            //'autoStart'=>true,
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
            //自己定义一个session组件
            'class'=>\frontend\components\MySession::className(),
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
            'suffix'=>'.html',
            'rules' => [
            ],
        ],
        //设置时间格式组件
        'formatter' => [
            'dateFormat' => 'yyyy-MM-dd',
            'datetimeFormat' => 'yyyy-MM-dd HH:mm:ss',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'CNY',
        ],

    ],
    'params' => $params,
    //设置默认路由
    'defaultRoute'=>'home',
    //设置模块
    'modules'=>[
        'admin'=>[
            'class'=>\frontend\modules\admin\Module::className(),
        ],
    ],

];
