<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/21
 * Time: 9:18
 */

namespace frontend\core\filters;


use common\helper\Helper;
use yii\base\ActionFilter;
use yii\web\HttpException;

class AdminFilter extends ActionFilter
{
    public $controller;
    public $nocsrfActions;//关闭post请求的csrf验证
    public function beforeAction($action){
        //1.验证用户是否登录
        if(\Yii::$app->user->isGuest){
            return $action->controller->redirect(\Yii::$app->user->loginUrl);
        }
        //2.验证用户是否有权限操作
        if(!\Yii::$app->user->can($action->uniqueId)){
            throw new HttpException(403,'对不起，没有权限执行该操作');
        }
        //3.关闭post请求的csrf验证
        if(in_array($action->id,$this->nocsrfActions[$this->controller->id])){
            $this->controller->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
}