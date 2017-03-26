<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/11
 * Time: 11:06
 */

namespace frontend\models;


use common\helper\Helper;
use yii\base\Model;

class BackLoginForm extends Model
{
    public $captchaCode;
    public $username;
    public $password;
    //是否记住密码
    public $remeber_me=1;
    public function rules(){
        return [
            [['username','password'],'required','message'=>'不能为空!','on'=>['login','register']],
            //只有在职的教师可以注册账号
            ['username','checkUsername','message'=>'不能注册,你不是在职员工!','on'=>['register']],
            ['remeber_me','safe','on'=>['login']],
            ['captchaCode','captcha','captchaAction'=>'back-login/captcha','message'=>'验证码不正确!','on'=>['login', 'register']]
        ];
    }
    //添加用户
    public function register(){
        if($this->validate()){
            $adminModel = new Admin();
            $adminModel->setScenario('register');
            $teacher = Teacher::findOne(['real_name'=>$this->username]);
            $adminModel->teacher_id = $teacher->id;
            $adminModel->username = $this->username;
            $adminModel->setPassword($this->password);//加密密码
            $adminModel->create_time = time();
            //var_dump($adminModel);exit;
            $rst = $adminModel->save();
            $adminModel->primaryKey();
            if($rst){
                \Yii::$app->user->login($adminModel);
                //给注册成功的用户添加普通权限
                Helper::getService('AuthManager')->assignAuth($adminModel->getId());
            }
            return $rst;
        }
        return false;

    }
    //后台账户登录
    public function login($postData){
        if($this->validate()){
            $adminModel = Admin::findOne(['username'=>$postData['username']]);
            if($adminModel && $adminModel->validatePassword($postData['password'])){
                //设置自动登录的日期
                $duration = $postData['remeber_me'] ? 3600*168 :0;
                if($duration){
                    $adminModel->generateAuthKey();
                    $adminModel->save();
                }
                \Yii::$app->user->login($adminModel,$duration);
                return true;
            }
        }
        return false;
    }
    //验证是否为在职员工
    public function checkUsername($attribute){
        if(!Helper::checkUsername($this->$attribute)){
            $this->addError($attribute,'不是在职员工!');
        }
    }
}