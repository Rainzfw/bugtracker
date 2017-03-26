<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    //设置静态页面的布局
    //'layout'=>'new.php',
    //设置语言
    'language'=>'zh-cn'
];
