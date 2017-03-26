<?php
/**
 * 用户服务的接口
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/16
 * Time: 17:13
 */

namespace business\interfaces\userInterface;


interface UserServiceInterface
{
    /*
     * 登录接口
     * @param $username
     * @param $password
     * @return mixed
     **/
    public function login($username,$password);
    /*
     * 注册接口
     * @param $data
     * @return mixed
     **/
    public function register($data);
    /*
     *依据邮箱查询用户信息
     * @param $email
     * @return mixed
     **/
    public function getUserByEmail($email);
    /*
     * 依据用户名称查询用户信息
     * @param $username
     * @return mixed
     **/
    public function getUserByName($username);

}