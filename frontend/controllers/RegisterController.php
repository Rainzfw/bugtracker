<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/15
 * Time: 22:17
 */

namespace frontend\controllers;


use common\core\base\Controller;
use frontend\models\UserRegisterForm;

class RegisterController extends Controller
{
    //用户注册信息
    public function actionRegister(){
        $params = \Yii::$app->request->getBodyParams();
        $model = new UserRegisterForm();
        if($model->load(\Yii::$app->request->post()) && $model->register(\Yii::$app->request->post('UserRegisterForm'))){
            return $this->msg(['home/index'],'注册成功,欢迎加入源码大课堂!');
        }
        return $this->msg(['index'],$this->getErrors($model));
    }
    //注册页面的展示
    public function actionIndex(){
        $model = new UserRegisterForm();
        return $this->render('index',['model'=>$model]);
    }
}