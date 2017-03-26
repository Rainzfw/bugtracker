<?php
/*
 * frontend目录下面的基础控制器
 * frontend目录下的所有的控制都要继承此控制器
 * 该类需要继承common下面的核心基础类
 * */
namespace frontend\core\base;
use common\core\base\Controller;
use frontend\core\filters\UserFilter;

class HomeController extends Controller
{
    //绑定验证是否登录的事件
    public function behaviors(){
         return [
             [
                 'class'=>UserFilter::className(),
                 'controller' => $this,
                 'actions'=>[
                     'question-set'=>['add','edit','delete','upload-img']
                 ],
                 'ignoreActions'=>[
                     'question-set'=>['detail','index']
                 ],

             ],

         ];
     }

}