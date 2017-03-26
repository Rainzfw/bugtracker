<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/10
 * Time: 18:11
 */

namespace frontend\controllers;


use kucha\ueditor\UEditorAction;
use yii\web\Controller;

class UeditorController extends Controller
{
    public function actions()
    {
        return [
            'upload' => [
                'class' => UEditorAction::className(),
                'config' => [
                    "imageUrlPrefix"  => "http://www.baidu.com",//图片访问路径前缀
                    "imagePathFormat" => "/upload/image/{yyyy}{mm}{dd}/{time}{rand:6}", //上传保存路径
                    "imageRoot" => \Yii::getAlias("@webroot"),
                ],
            ]
        ];
    }

}