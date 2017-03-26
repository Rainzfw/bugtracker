<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/16
 * Time: 17:25
 */

namespace business\common;


use common\helper\ConstHelper;

class BaseService
{
    private $errorMsg = '';
    //定义学科的数据
    protected $sub_ids = [
        'ui'=>ConstHelper::UI,
        'web'=>ConstHelper::WEB,
        'php'=>ConstHelper::PHP,
        'java'=>ConstHelper::JAVA
    ];
        //获取service的方法
    protected function getService($serviceName){
        return \Yii::$container->get($serviceName.'service');
    }
    //获取错误信息的函数
    public function getErrorMsg(){
        return $this->errorMsg;
    }
    //设置错误信息的函数
    public function setErrorMsg($msg){
        $this->errorMsg = $msg;
    }



}