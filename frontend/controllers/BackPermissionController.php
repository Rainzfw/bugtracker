<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 18:38
 */

namespace frontend\controllers;


use frontend\core\base\BackController;
use frontend\models\PermissionForm;

class BackPermissionController extends BackController
{
    //添加权限
    public function actionAdd(){
        //设置导航
        $this->setBreadcrumbs('权限添加');
        $model = new PermissionForm();
        if(\Yii::$app->request->isPost){
            if($model->load(\Yii::$app->request->post()) && $model->add()){
               return $this->msg(['index'],'添加权限成功');
            }
            \Yii::$app->session->setFlash('error','添加权限失败,'.$this->getErrors($model));
        }
        return $this->render('add',['model'=>$model]);
    }
    //展示所有的权限
    public function actionIndex(){
        //设置导航栏
        $this->view->params['breadcrumbs'][] = '所有权限';
        $permissions = \Yii::$app->authManager->getPermissions();
        return $this->render('index',['permissions'=>$permissions]);
    }
    //删除权限
    public function actionDelete($name){
        $permission=\Yii::$app->authManager->getPermission($name);
        if(\Yii::$app->authManager->remove($permission)){
            \Yii::$app->session->setFlash('权限删除成功');
        }else{
            \Yii::$app->session->setFlash('权限删除失败');
        }
        $permissions = \Yii::$app->authManager->getPermissions();
        return $this->render('index',['permissions'=>$permissions]);
    }
    //设置导航栏信息
    private function setBreadcrumbs($currentLabel,$child=true){
        if($child){
            $this->view->params['breadcrumbs'][] = ['label' => '所有权限', 'url' => '/back-permission/index.html'];
        }
        $this->view->params['breadcrumbs'][] = $currentLabel;
    }

}