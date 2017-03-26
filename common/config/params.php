<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    //用户登录的token有效期
    'user.passwordResetTokenExpire' => 3600,
    'upload_message' => [
        //工厂方法调用的类.
        'upload_class' => '\common\helper\UpYunHelper',
        //上传图片返回的地址前缀.
        'visit_url' => 'http://bigqipa.b0.upaiyun.com/',
        //空间名称.
        'upyun_bucket_name' => 'bigqipa',
        //操作人员.
        'upyun_operator_name' => 'haoyoufaner',
        //操作密码.
        'upyun_operator_pwd' => 'haoyoufaner',
    ],
    'upload_image_limit'=>[
        'allow_types'=>["image/jpeg","image/png","image/gif","image/bmp"],
        'max_size'=>1024*1024*2,
    ],
    'coreseek'=>[
        'host'=>'127.0.0.1',
        'port'=>9312,
        'searchtime'=>30,
        'indexs'=>'mysql'
    ]
];
