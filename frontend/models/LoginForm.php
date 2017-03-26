<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/16
 * Time: 20:20
 */

namespace frontend\models;


use common\helper\Helper;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $captchaCode;
    public static function tableName(){
        return '{{%user}}';
    }
    //验证规则
    public function rules(){
        return [
            [['username','password','captchaCode'],'required','message'=>'{attribute}不能为空!'],
            ['username','checkUsername'],
            ['captchaCode','captcha','captchaAction'=>'login/captcha','message'=>'验证码不正确!']
        ];
    }
    //验证用户名是否正确
    public function checkUsername($attribute){
        if(!Helper::checkName($this->$attribute)){
            $this->addError($attribute,'3-15位,由字母数字下划线组成,以字母开头');
        }
    }
    //用户登录
    public function login($username,$password){
        if($this->validate()){
            $rst = Helper::getService('User')->login($username,$password);
            if($rst){
                //开启session
                $session =  \Yii::$app->session;
                if(!$session->isActive){
                    $session->open();
                }
               $session->set('userInfo',$rst);
                return true;
            }
            $this->addError('username','用户名或者密码错误!');
        }
        return false;
    }
}