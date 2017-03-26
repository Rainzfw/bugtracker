<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/10
 * Time: 16:33
 */
//自定一个图片上传的控制器
namespace frontend\controllers;
use common\helper\Helper;

class UploadController extends \yii\web\Controller
{
    //定义上传单个图片的方法
    public function actionUploadImg(){
        //获取上传类 上传图片
        $uploadImg = Helper::UploadFactoryHelper(\Yii::$app->params['upload_message']['upload_class']);
        //判断是否使用了表单模型
        $postData = \Yii::$app->request->post();
        $isImgFile  = isset($postData['ImgeForm']['isImgFile'])?$postData['ImgeForm']['isImgFile']:'';
        if($isImgFile){
            $fileData = $uploadImg->handleFiles($_FILES['ImgeForm'],'imgFile');
        }else{
            $fileData = $_FILES['imgFile'];
        }
        if($imgUrl = $uploadImg->uploadOne($fileData)){
            return json_encode(['status'=>'success','url'=>$imgUrl,'path'=>$imgUrl]);
        }else{
            return json_encode(['status'=>'error','msg'=>$uploadImg->getErrors()]);
        }
    }
    //删除图片的接口
    public function actionDelete(){
        $filepath = \Yii::$app->request->post('filepath');
        if($filepath){
            $filepathInfo = pathinfo($filepath);
            $uploadImg = Helper::UploadFactoryHelper(\Yii::$app->params['upload_message']['upload_class']);
            $uploadImg->delete($filepathInfo['basename']);
        }
    }
}