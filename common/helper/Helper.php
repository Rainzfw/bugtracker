<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/15
 * Time: 12:42
 * 帮助类
 */

namespace common\helper;


use business\teacherService\model\Teachers;
use frontend\models\Teacher;
use yii\base\Exception;

class Helper
{
    //问题状态
    public static function getQuestatus(){

    }
    //课程状态
    public static function getCourstatus(){

    }
    /*
     * 验证邮箱
     * @param $email
     * @return bool
     */
    public static function isEmail($email){
        if(preg_match(ConstHelper::EMAIL_REGEX,$email)){
            return true;
        }
        return false;
    }
    /*
     * 电话号码
     * @param $email
     * @return bool
     */
    public static function isTelphone($tel){
        if(preg_match(ConstHelper::TEL_REGEX,$tel)){
            return true;
        }
        return false;
    }
    /*
     * 验证昵称 2-15 字母下划线数字 只能以字母开头
     * @param $username
     * @return bool
     * */
    public static function checkName($username){
        if(preg_match(ConstHelper::USERNAME_REGEX,$username)){
            return true;
        }
        return false;
    }
    //验证后台注册用户名是否为在职员
    public static function checkUsername($username){
        $teacherInfo  = Teachers::findOne(['real_name'=>$username]);
        if($teacherInfo['is_delete'] == ConstHelper::STATUS_ACTIVE){
            return true;
        }
        return false;
    }
    //验证上传的图片格式是否正确
    public static function checkImgExt($imgName){
        if(preg_match(ConstHelper::ImgExt_REGEX,$imgName)){
            return true;
        }
        return false;
    }
    //获取服务对象解决依赖关系
    public static function getService($serviceName){
        return \Yii::$container->get($serviceName.'Service');
    }
    //开启session
    private static function openSess(){
        if(\Yii::$app->session->isActive){
            \Yii::$app->session->open();
        }
    }
    //获取session中存储的值
    public static function getSess($key,$defaultValue=null){
        $rst =  \Yii::$app->session->get($key,$defaultValue);
        \Yii::$app->session->close();
        return $rst;
    }
    //在session储存值
    public static function setSess($key,$value){
        \Yii::$app->session->set($key,$value);
        \Yii::$app->session->close();
    }
    //删除session数据
    public static function removeSess($key){
        \Yii::$app->session->remove($key);
        \Yii::$app->session->close();
    }
    //用于创建上传类
    public static function UploadFactoryHelper($className){
        if(empty($className)){
            throw new Exception("类{$className}不存在!");
        }
        return new $className();
    }
    //获取分页条条html
    public static function getPagerHtml($pagers,$key){
        if($pagination = \yii\helpers\ArrayHelper::getValue($pagers,$key)){
            $configs = \Yii::$app->params['pagerConfigs'];
            $configs['pagination'] = $pagination;
            return \yii\widgets\LinkPager::widget($configs);
        }
        return '';
    }
    //生成随机字符串
    public static function generateString($length = 5) {
        //随机字符串的字符集
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for ( $i = 0; $i < $length; $i++ )
        {
            // 第一，使用 substr 截取$chars中的任意一位字符；
            // 第二，取字符数组 $chars 的任意元素
            // $str .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);
            $str .= $chars[ mt_rand(0, strlen($chars) - 1) ];
        }
        return $str;
    }
}