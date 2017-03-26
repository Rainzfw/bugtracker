<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/11
 * Time: 11:41
 */

namespace frontend\controllers;


use common\helper\ConstHelper;
use common\helper\Helper;
use frontend\core\base\BackController;
use frontend\models\Admin;
use frontend\models\AssignroleForm;
use frontend\models\User;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class BackAdminController extends BackController
{
    //获取所有的管理员
    public function actionIndex(){
        $this->view->params['breadcrumbs'][] = '所有管理员';
        $query = Admin::find()->where('is_delete = '.ConstHelper::STATUS_ACTIVE);
        $rst['dataProvider']=new ActiveDataProvider(['query'=>$query,'pagination' => ['pageSize' => ConstHelper::TEACHER_SIZE]]);
        return $this->render('index',$rst);
    }
    //删除管理员
    public function actionDelete($id){
        $admin = Admin::findOne($id);
        $admin->is_delete =ConstHelper::STATUS_DELETED;
        $admin->save();
        return $this->redirect(['back-admin/index']);
    }
    //给管理员分配具体的角色
    public function actionAssignrole($id){
        $this->setBreadcrumbs('分配角色');
        $model = new AssignroleForm();
        $model->roles=Helper::getService('AuthManager')->loadRoles($id);
        if(\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());
            Helper::getService('AuthManager')->assignAuth($id,$model->roles);
           // return $this->redirect(['index']);
        }
        return $this->render('assignrole',['model'=>$model]);
    }
    //获取所有的用户
    public function actionUserindex(){
        $this->view->params['breadcrumbs'][] = '所有用户';
        $query = User::find();
        $rst['dataProvider']=new ActiveDataProvider(['query'=>$query,'pagination' => ['pageSize' => ConstHelper::TEACHER_SIZE]]);
        return $this->render('userindex',$rst);
    }
    public function actionIsforbid(){
        $id = \Yii::$app->request->post('user_id','');
        $is_forbid = \Yii::$app->request->post('is_forbid','');
        if($id && $is_forbid){
            $user = User::findOne($id);
            $isforbidArr = [
                ConstHelper::STATUS_DELETED=>ConstHelper::STATUS_ACTIVE,
                ConstHelper::STATUS_ACTIVE=>ConstHelper::STATUS_DELETED,

            ];
            $user->is_forbid = ArrayHelper::getValue($isforbidArr,$is_forbid);
            if($user->save()){
                return Json::encode(['status'=>'success','msg'=>'操作成功!']);
            }
        }
        return Json::encode(['status'=>'error','msg'=>'操作失败!']);
    }
    //设置导航栏信息
    private function setBreadcrumbs($currentLabel,$child=true){
        if($child){
            $this->view->params['breadcrumbs'][] = ['label' => '所有管理员', 'url' => '/back-menu/index.html'];
        }
        $this->view->params['breadcrumbs'][] = $currentLabel;
    }
}