<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/16
 * Time: 17:10
 */

namespace business\userService\service;


use business\common\BaseService;
use business\interfaces\userInterface\UserServiceInterface;
use business\userService\model\User;
use common\Helper\Helper;

class UserService extends BaseService implements UserServiceInterface
{
    private $userModel;
    public function __construct(){
        if(empty($this->userModel)){
            $this->userModel = new User();
        }

    }
    public function login($username, $password)
    {
        $userInfo = User::findOne(['username'=>$username]);
        $pwd = md5($userInfo['salt'].md5($password));
        if($userInfo && !strcmp($pwd,$userInfo['password'])){
            return $userInfo;
        }
        return false;
    }
    //注册用户的主方法
    public function register($data)
    {
        //对喜欢的学科进行处理
        $data['sub_id']=implode(',',$data['sub_id']);
        //获取随机的字符串
        $data['salt'] = Helper::generateString();
        $data['password'] = md5($data['salt'].md5($data['password']));
        try{
            return $this->userModel->add($data);
        }catch (Exception $e){
            \Yii::error($e->getMessage());
            return false;
        }
    }
    public function getUserByEmail($email)
    {
        return User::findOne(['email'=>$email]);

    }

    public function getUserByName($username)
    {
        return User::findOne(['username'=>$username]);
    }
    //依据主键id获取数据
    public function getUserById($id){
        return User::findOne(['id'=>$id]);
    }
}