<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/28
 * Time: 14:09
 * 后台管理员登录页面
 */

namespace frontend\controllers;


use common\core\base\Controller;
use frontend\models\Admin;
use frontend\models\BackLoginForm;
use yii\captcha\CaptchaAction;

class BackLoginController extends Controller
{
    public $layout = '@app/views/layouts/back.php';
    //登录页面展示
    public function actionLogin(){
        $model = new BackLoginForm();
        return $this->render('login',['model'=>$model]);
    }
    //用户验证
    public function actionCheck(){
        $model = new BackLoginForm();
        $model->setScenario('login');
        $postData = \Yii::$app->request->post('BackLoginForm',[]);
        $error = '缺少登录参数!';
        if($postData){
            if($model->load(\Yii::$app->request->post()) && $model->login($postData)){
                return $this->msg(['back/index'],'登录成功!');
            }
            $error = '登录失败!员工离职或者密码和账号不存在';
        }
        \Yii::$app->session->setFlash('error',$error);
        return $this->render('login',['model'=>$model]);
    }
    //后台用户注册页面
    public function actionRegister(){
        $model = new BackLoginForm();
        $model->setScenario('register');
        if(\Yii::$app->request->isPost){
            if($model->load(\Yii::$app->request->post()) && $model->register()){
                return $this->msg(['home/index'],'注册成功!');
            }
            \Yii::$app->session->setFlash('error','注册失败!员工离职或者不存在或者已注册');
        }
        return $this->render('register',['model'=>$model]);
    }
    //退出登录
    public function actionLogout(){
        \Yii::$app->user->logout();
        //跳转到登录页
        return $this->redirect(['login']);
    }
    //验证码调用的函数
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