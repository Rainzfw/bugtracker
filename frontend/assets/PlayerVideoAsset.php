<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/26
 * Time: 15:53
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class PlayerVideoAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/ext/playeryouku.js',
        'js/playervideo.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}