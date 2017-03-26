<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/21
 * Time: 10:43
 */
namespace frontend\assets;
use yii\web\AssetBundle;

class BackAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'backend/css/bootstrap.css',
        'backend/css/style.css',
        'backend/css/font-awesome.css',
        'backend/css/animate.css',
        'backend/css/clndr.css',
        'backend/css/custom.css',
        'backend/css/jqvmap.css'
    ];
    public $js = [
        //这个地方会造成多个错误去掉之后
        //使用依赖解决这个问题
        //'assets/back/js/jquery-1.11.1.min.js',
       //'backend/js/modernizr.custom.js',
        //这是特效首页点击
        'backend/js/wow.min.js',
        'backend/js/Chart.js',
        //'backend/js/underscore-min.js',
        //后面的两个js依赖于此js
        //'backend/js/moment-2.2.1.js',
        //'backend/js/clndr.js',
        //'backend/js/site.js',
        //后面的一个js依赖此js 这是侧面导航的js特效
        'backend/js/metisMenu.min.js',
        'backend/js/custom.js',
        //jquery.vmap.world.js 依赖此js
        'backend/js/jquery.vmap.js',
        'backend/js/jquery.vmap.sampledata.js',
        'backend/js/jquery.vmap.world.js',
        //后面的一个js依赖此js 这是侧面导航的js特效
        'backend/js/classie.js',
        //'backend/js/scripts.js'依赖此js
        //'backend/js/jquery.nicescroll.js',
        //'backend/js/scripts.js',
        'backend/js/bootstrap.js',
        'backend/js/backLayouts.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public static function addScript($view, $jsfile) {
        $view->registerJsFile($jsfile, [BackAsset::className(), 'depends' => 'frontend\assets\BackAsset']);
    }
    public static function addCss($view, $cssfile) {
        $view->registerCssFile($cssfile, [BackAsset::className(), 'depends' => 'frontend\assets\BackAsset']);
    }

}