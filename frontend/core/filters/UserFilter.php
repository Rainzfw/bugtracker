<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/21
 * Time: 9:19
 */

namespace frontend\core\filters;


use common\helper\Helper;
use yii\base\ActionFilter;
use yii\web\BadRequestHttpException;

class UserFilter extends ActionFilter
{
    public $controller;
    public $actions;
    public $ignoreActions;
    public function beforeAction($action){
        if(in_array($action->id,$this->ignoreActions[$this->controller->id])){
            return parent::beforeAction($action);
        }
        //验证是否登录
        if(in_array($action->id,$this->actions[$this->controller->id])){
            $userInfo = Helper::getSess('userInfo');
            if(empty($userInfo)){
                header('Location:/login/index.html');
                exit;
            }
        }
        //其他的验证逻辑 验证问题归属
        if($this->controller->id == 'question-set' && in_array($action->id,['edit','delete'])){
            $rst = Helper::getService('Question')->getRow(['id'=>\Yii::$app->request->getQueryParam('id','')]);
            if($rst['user_id'] == Helper::getSess('userInfo')->id){
                return parent::beforeAction($action);
            }
            throw new BadRequestHttpException('不正确的操作,禁止访问',404);exit;
        }
        return parent::beforeAction($action);
    }

}