<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/15
 * Time: 10:03
 */

namespace frontend\controllers;


use frontend\core\base\BackController;
use frontend\models\RoleForm;

class BackRoleController extends BackController
{
    //添加功能
    public function actionAdd(){
        //设置导航
        $this->setBreadcrumbs('角色添加');
        $model = new RoleForm();
        $model->setScenario('add');
        if(\Yii::$app->request->isPost){
            if($model->load(\Yii::$app->request->post()) && $model->addRole()){
                return $this->msg(['index'],'添加角色成功!');
            }
            \Yii::$app->session->setFlash('error','添加角色失败,'.$this->getErrors($model));
        }
        return $this->render('add',['model'=>$model]);
    }
    public function actionIndex(){
        //设置导航栏
        $this->view->params['breadcrumbs'][] = '所有角色';
        $roles=\Yii::$app->authManager->getRoles();
        return $this->render('index',['roles'=>$roles]);
    }
    public function actionEdit($name){
        //设置导航栏
        $this->view->params['breadcrumbs'][] = '角色编辑';
        $model = new RoleForm();
        $model->setScenario('edit');
        //加载模型中的数据
        $model->loadData($name);
        if($model->load(\Yii::$app->request->post())){
            if($model->editRole($name)){
                return $this->msg(['index'],'编辑角色成功!');
            }
            \Yii::$app->session->setFlash('error','编辑失败:'.$this->getErrors($model));
        }
        return $this->render('add',['model'=>$model]);
    }
    //删除角色的功能
    public function actionDelete($name)
    {
        $manager=\Yii::$app->authManager;
        $role=$manager->getRole($name);
        $manager->remove($role);
        return $this->redirect(['index']);
    }
    //设置导航栏信息
    private function setBreadcrumbs($currentLabel,$child=true){
        if($child){
            $this->view->params['breadcrumbs'][] = ['label' => '所有角色', 'url' => '/back-role/index.html'];
        }
        $this->view->params['breadcrumbs'][] = $currentLabel;
    }


}