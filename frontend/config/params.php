<?php
return [
    'adminEmail' => 'admin@example.com',
    'name'=>'yiiName',
    'pageSize'=>\common\helper\ConstHelper::SIZE_TEN,
    'pagerConfigs'=>[
        'nextPageLabel'=>'Next',
        'prevPageLabel'=>'Prev',
        'hideOnSinglePage'=>false
    ],
    'backPageSize'=>\common\helper\ConstHelper::BACK_SIZE,
    //设置七牛云储存空间参数配置
    'qiniuyun'=>[
        'bucket'=>'bugtracker',
        'domain'=>'http://oml69zlsx.bkt.clouddn.com',
        'ak'=>'xgc9EWCl7QkjHYpZqiegX7gIAkiVOT0llFU0FwdH',
        'sk'=>'IVWfkg5dOaqKDx9GaStnbrPOqvbpupexlSwfA7XK'
    ],

];
