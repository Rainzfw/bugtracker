<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class FrontendAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/frontend/back.css'
    ];
    public $js = [
        //'js/test.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public static function addScript($view, $jsfile) {
        $view->registerJsFile($jsfile, [BackAsset::className(), 'depends' => 'frontend\assets\FrontendAsset']);
    }
    public static function addCss($view, $cssfile) {
        $view->registerCssFile($cssfile, [BackAsset::className(), 'depends' => 'frontend\assets\FrontendAsset']);
    }
}
