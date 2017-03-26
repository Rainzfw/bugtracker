<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/20
 * Time: 18:57
 */

namespace frontend\core\base;


use common\core\base\Controller;
use frontend\core\filters\AdminFilter;

class BackController extends Controller
{
    public $layout = '@app/views/layouts/back.php';
    //绑定事件 所有行为都会执行
    //这里是要验证是否登录过
    public function behaviors(){
        return [
           'identity'=>[
                'class'=>AdminFilter::className(),
                'controller' =>$this,
                'nocsrfActions'=>[
                    'back-question'=>['audit-question','editshow'],
                    'back-teacher'=>['edit-status']
                ],
           ]
        ];
    }


}