<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/21
 * Time: 10:07
 */

namespace frontend\controllers;


use common\core\base\Controller;
use frontend\models\Admin;

class BackController extends Controller
{
    public $layout = '@app/views/layouts/back.php';
    //后台首页页面
    public function actionIndex(){
        //$this->layout='@app/views/layouts/back.php';
        return $this->render('index');
    }
    //获取招生数据
    public function actionRecruitData(){
        //获取每班招生人数
        $uiData = [34,40,45,60,65,55,57,49,45,46,42,40];
        $webData = [50,60,66,67,60,68,50,54,48,44,49,42];
        $phpData = [40,46,57,58,68,70,60,50,52,49,41,43];
        $javaData = [80,90,99,98,101,102,103,90,80,79,84,86];
        $recruit = ['uiData'=>$uiData,'webData'=>$webData,'phpData'=>$phpData,'javaData'=>$javaData];
        return  json_encode($recruit);
    }

    //用户登录界面 这里不需要注册页面 管理员具有添加页面的操作
    public function actionLoginIndex(){
        $model = new Admin();
        return $this->render('loginIndex',['model'=>$model]);
    }
    //用户登录
    public function actionLogin(){
        if(\Yii::$app->request->isPost){
            $model = new Admin();
            if($model->load(\Yii::$app->request->post()) && $model->login()){
                return $this->redirect('index');
            }
            return $this->msg(['login-index'],$this->getErrors($model));
        }
        return $this->msg('login-index','不正确的操作方式!');
    }

}