<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/10
 * Time: 14:08
 */
namespace frontend\models;
use common\helper\Helper;
use yii\base\Model;

class UserRegisterForm extends Model
{
    public $username;
    public $password;
    public $sub_id;
    public $email;
    public $sex;
    public $captchaCode;
    public static function tableName(){
        return "{{%user}}";
    }
    //验证规则
    public function rules(){
        return [
            [['username','password','email','sex'],'required','message'=>'{attribute}不能为空!'],
            ['password', 'string', 'max' => 18,'min'=>6,'message'=>'密码为6-18位'],
            ['email','checkEmail'],
            ['username','checkUsername'],
            ['captchaCode','captcha','captchaAction'=>'login/captcha','message'=>'验证码错误!'],
            //[['username','email'],'unique','message'=>'{attribute}已注册'],
        ];
    }
    //标签
    public function attributeLabels(){
        return [
            'username'=>'用户名',
            'password'=>'密码',
            'email'=>'邮箱',
            'sex'=>'性别'
        ];
    }
    //自定义验证邮箱
    public function checkEmail($attribute){
        if(!Helper::isEmail($this->$attribute)){
            $this->addError($attribute,'邮箱格式错误');
        }
    }
    //自定义验证用户名
    public function checkUsername($attribute){
        if(!Helper::checkName($this->$attribute)){
            $this->addError($attribute,'3-15位,由字母数字下划线组成,以字母开头');
        }
    }
    public function register($data){
        if($this->validate()){
            //验证用户名和邮箱的唯一性
            $rst = Helper::getService('User')->getUserByEmail($data['email']);
            if($rst){
               $this->addError('email','该邮箱已注册!');
                return false;
            }
            $rst = Helper::getService('User')->getUserByName($data['username']);
            if($rst){
                $this->addError('username','该用户名已存在!');
                return false;
            }
            $id = Helper::getService('User')->register($data);
            if($id){
                //注册成功之后将用户的信息保存在session中
                $userInfo = Helper::getService('User')->getUserById($id);
                \Yii::$app->session->set('userInfo',$userInfo);
                return true;
            }
        }
        return false;
    }
}