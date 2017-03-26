<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/10
 * Time: 18:51
 */

namespace frontend\controllers;
use common\helper\ConstHelper;
use common\helper\Helper;
use frontend\models\CarouselFigure;
use frontend\models\Course;
use frontend\models\LoginForm;
use frontend\models\Question;
use frontend\models\UserRegisterForm;
use yii\web\Controller;

class HomeController extends Controller
{
    public function actionIndex(){
        //获取轮播图片数据
        $carouselFigures = CarouselFigure::find()->where('type='.ConstHelper::CAROUSEL_IMG.' and is_show = '.ConstHelper::ISSHOW_YES)->all();
        //获取到右侧的小广告图片
        $rightImg = CarouselFigure::findOne(['type'=>ConstHelper::RIGHT_MIN_IMG,'is_show'=>ConstHelper::ISSHOW_YES]);
        //获取所有的问题
        $ques['ui']= Question::find()->where('status > '.ConstHelper::AUDIT_NO.' and sub_id = '.ConstHelper::UI)->limit(5)->all();
        $ques['web'] = Question::find()->where('status > '.ConstHelper::AUDIT_NO.' and sub_id = '.ConstHelper::WEB)->limit(5)->all();
        $ques['php'] = Question::find()->where('status > '.ConstHelper::AUDIT_NO.' and sub_id = '.ConstHelper::PHP)->limit(5)->all();
        $ques['java'] = Question::find()->where('status > '.ConstHelper::AUDIT_NO.' and sub_id = '.ConstHelper::JAVA)->limit(5)->all();
        //获取所有视频数据
        $courses = Course::find()->where('status = '.ConstHelper::SHOW)->limit(8)->all();
        //创建注册表单模型
        $model = new UserRegisterForm();
        //创建登录表单模型
        $loginModel = new LoginForm();
        //var_dump($ques);exit;
        return $this->render('index', [
            'carouselFigures'=>$carouselFigures,
            'rightImg'=>$rightImg['img'],
            'ques'=>$ques,
            'courses'=>$courses,
            'model'=>$model,
            'loginModel'=> $loginModel
        ]);
    }
    //退出登录
    public function actionLogout(){
        //判断是否登录了
        if(Helper::getSess('userInfo')){
            \Yii::$app->getSession()->setFlash('success', '用户未登录，请先登录!');
            return $this->redirect(['logo/index.html']);
        }
        Helper::removeSess('userInfo');
        \Yii::$app->getSession()->setFlash('success', '已退出登录!');
        return $this->redirect(['home/index']);
    }
}