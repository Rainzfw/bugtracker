<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/16
 * Time: 19:28
 */

namespace business;


class BusinessInit
{
    //初始化服务
    public function init(){
        $this->userService();
        $this->questionService();
        $this->answerService();
        $this->teacherService();
        $this->sphinxService();
        $this->authManagerService();
    }
    //注册用户服务
    private function userService(){
        \Yii::$container->setSingleton('UserService','business\userService\service\UserService');
    }
    //注册问题服务
    private function questionService(){
        \Yii::$container->setSingleton('QuestionService','business\questionService\service\QuestionService');
    }
    //注册问题回答服务
    private function answerService(){
        \Yii::$container->setSingleton('AnswerService','business\answerService\service\AnswerService');
    }
    //注册教师信息服务
    private function teacherService(){
        \Yii::$container->setSingleton('TeacherService','business\teacherService\service\TeacherService');
    }
    //注册coreseek搜索引擎服务
    private function sphinxService(){
        \Yii::$container->setSingleton('SphinxService','business\coreseekService\service\SphinxService');
    }
    //注册权限管理的服务
    private function authManagerService(){
        \Yii::$container->setSingleton('AuthManagerService','business\authManagerService\service\AuthManagerService');
    }
}