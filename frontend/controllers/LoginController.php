<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/16
 * Time: 20:13
 */

namespace frontend\controllers;


use common\core\base\Controller;
use frontend\models\LoginForm;
use yii\captcha\CaptchaAction;

class LoginController extends Controller
{
    //登录
    public function actionLogin(){
        $model = new LoginForm();
        if($model->load(\Yii::$app->request->post()) && $model->login($model->username,$model->password)){
            return $this->msg(['home/index'],'登录成功!');
        }
        return $this->msg(['index'],$this->getErrors($model));
    }
    //登录页面
    public function actionIndex(){
        $model = new LoginForm();
        return $this->render('index',['model'=>$model]);
    }
    //退出登录页面
    public function actionlogout(){
        \Yii::$app->session->removeAll();
        \Yii::$app->session->destroy();
        return $this->redirect(['home/index']);
    }
    public function actions(){
        return [
            'captcha' => [
                'class' => CaptchaAction::className(),
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'maxLength' => 6, //最大显示个数
                'minLength' => 5,//最少显示个数
                'padding' => 5,//间距
                'height'=>40,//高度
                'width' => 130,  //宽度
                'foreColor'=>'#000',     //字体颜色
                 'offset'=>4,        //设置字符偏移量 有效果
            ],
        ];
    }
}