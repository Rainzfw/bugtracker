<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 11:51
 */

namespace frontend\controllers;


use frontend\core\base\BackController;
use frontend\models\Menu;

class BackMenuController extends BackController
{
    //菜单添加
    public function actionAdd(){
        //设置导航
        $this->setBreadcrumbs('添加');
        $model = new Menu();
        $model->setScenario('add');
        if(\Yii::$app->request->isPost){
            if($model->load(\Yii::$app->request->post()) && $model->add()){
                return $this->msg(['back-menu/index'],'操作成功');
            }
            \Yii::$app->session->setFlash('error',$this->getErrors($model));
        }
        return $this->render('add',['model'=>$model]);
    }
    //菜单展示首页
    public function actionIndex(){
        //设置导航
        $this->view->params['breadcrumbs'][] = '所有菜单';
        $model = Menu::getTops();
        return $this->render('index',['model'=>$model]);
    }
    //编辑菜单
    public function  actionEdit($id){
        //设置导航
        $this->setBreadcrumbs('编辑');
        $model =Menu::findOne($id);
        $model->setScenario('edit');
        if(\Yii::$app->request->isPost){
            if($model->load(\Yii::$app->request->post()) && $model->validate()){
                if($model->save()){
                    return $this->msg(['back-menu/index'],'操作成功');
                }
            }
            \Yii::$app->session->setFlash('error',$this->getErrors($model));
        }
        return $this->render('add',['model'=>$model]);
    }
    //删除菜单
    public function actionDelete($id){
        $model =Menu::findOne($id);
        if($model->submenus){
            $error = '不能删除有子菜单的菜单';
        }else{
            $model->delete();
            $error = '删除成功';
        }
        $menu = Menu::getTops();
        \Yii::$app->session->setFlash('error',$error);
        return $this->render('index',['model'=>$menu]);
    }
    //设置导航栏信息
    private function setBreadcrumbs($currentLabel,$child=true){
        if($child){
            $this->view->params['breadcrumbs'][] = ['label' => '所有菜单', 'url' => '/back-menu/index.html'];
        }
        $this->view->params['breadcrumbs'][] = $currentLabel;
    }
}