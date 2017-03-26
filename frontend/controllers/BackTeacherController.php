<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/7
 * Time: 11:21
 */

namespace frontend\controllers;


use common\helper\ConstHelper;
use frontend\core\base\BackController;
use frontend\models\Teacher;
use frontend\models\TeacherSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class BackTeacherController extends BackController
{
    //定义在职状态
    private $isDelete=[
        ConstHelper::ZERO => '请选择',
        ConstHelper::STATUS_DELETED=>'离职',
        ConstHelper::STATUS_ACTIVE=>'在职'
    ];
    //展示教师信息列表
    public function actionIndex(){
        //设置导航栏
        $this->view->params['breadcrumbs'][] = '教师列表';
        $rst['searchModel'] = new TeacherSearch();
        if(\Yii::$app->request->get()){
            $rst['searchModel']->load(\Yii::$app->request->post());
        }
        $rst['dataProvider']  = $rst['searchModel']->search(\Yii::$app->request->get());
        $rst['isDeleteItems'] = $this->isDelete;
        $rst['subjectItems'] = $this->subject;
        array_unshift($rst['subjectItems'],'请选择');
        return $this->render('index',$rst);
    }
    //修改教师的在职状态is_delete
    public function actionEditStatus(){
        $id = \Yii::$app->request->post('id','');
        $oldIsDelete = \Yii::$app->request->post('is_delete','');
        if($id && $oldIsDelete){
            $teacerModel = Teacher::findOne($id);
            if($teacerModel && $teacerModel->editStatus($oldIsDelete)){
                return Json::encode(['status'=>'success','msg'=>'修改成功!']);
            }
            return Json::encode(['status'=>'error','msg'=>'修改失败!']);
        }
        return Json::encode(['status'=>'error','msg'=>'修改失败,缺少参数!']);
    }
    //编辑教师信息
    public function actionEdit($id){
        $this->setBreadcrumbs('编辑');
        $model = Teacher::findOne($id);
        $model->setScenario('edit');
        if(\Yii::$app->request->isPost){
            if($model->load(\Yii::$app->request->post()) && $model->validate()){
                if($model->save()){
                    return $this->msg(['index'],'操作成功');
                }
            }
            return $this->msg(['edit','id'=>$id],$this->getErrors($model));
        }
        return $this ->render('add',['model'=>$model]);
    }
    //添加教师信息
    public function actionAdd(){

        $this->setBreadcrumbs('添加');
        $model = new Teacher();
        $model->setScenario('add');
        if(\Yii::$app->request->isPost){
            if($model->load(\Yii::$app->request->post()) && $model->validate()){
                $model->alias_name = empty($model->alias_name)?$model->real_name:$model->alias_name;
                $model->add_time = time();
                if($model->save()){
                    return $this->msg(['index'],'操作成功');
                }
            }
            return $this->msg(['add'],$this->getErrors($model));
        }
        return $this ->render('add',['model'=>$model]);
    }


    //设置导航栏信息
    private function setBreadcrumbs($currentLabel,$child=true){
        if($child){
            $this->view->params['breadcrumbs'][] = ['label' => '教师列表', 'url' => '/back-teacher/index.html'];
        }
        $this->view->params['breadcrumbs'][] = $currentLabel;
    }


}