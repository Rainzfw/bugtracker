<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/23
 * Time: 15:58
 */

namespace frontend\controllers;
use business\questionService\model\Question;
use common\helper\ConstHelper;
use common\helper\Helper;
use frontend\core\base\BackController;
use frontend\models\AnswerForm;
use frontend\models\Answer;
use yii\data\Pagination;

class BackAnswerController extends BackController
{
    //展示所有的回答
    public function actionIndex(){
        //设置导航栏
        $this->view->params['breadcrumbs'][] = '回答列表';
        //获取搜索信息
        $params = [];
        $params['keyword'] = \Yii::$app->request->get('keyword','');
        $params['is_show'] = \Yii::$app->request->get('is_show','');
        $params['teacher_id'] = \Yii::$app->request->get('teacher_id','');
        $rst['params'] = $params;
        //获取当前页数
        $currentPage=\Yii::$app->request->get('page',ConstHelper::FIRST_PAGE);
        //获取每个学科数据的总条数
        $totalCount = Helper::getService('Answer')->getCount($params);
        //var_dump($totalCount);exit;
        //创建分页工具
        $paginations = [];
        foreach($totalCount as $k =>$v){
            if($v){
                //var_dump(\Yii::$app->params['backPageSize']);
                //创建分类工具
                $paginations[$k] = new Pagination(['totalCount'=>$totalCount[$k],'pageSize'=>\Yii::$app->params['backPageSize']]);
                //var_dump($paginations);exit;
                //组装参数
                $params[$k]['limit'] =$paginations[$k]->limit;
                $params[$k]['offset'] =$paginations[$k]->offset;
            }

        }
        //获取查询的结果
        $answers = Helper::getService('Answer')->getAllAnswers($params);
        $rst['answers'] =  $answers;
        $rst['pagers'] =  $paginations;
        //这里是组装查询出来的结果
        if($params['is_show'] || $params['keyword'] || $params['teacher_id']){
            $rst['totalCount'] = $totalCount;
        }
        //获取所有的教师信息TODO
        $rst['teachers'] = ['1'=>'nnn','4'=>'dwtydfw','6'=>'gfyegf'];
        //定义是否显示的文字描述
        $rst['answerShowText'] = [
            ConstHelper::ISSHOW_YES=>'不显示',
            ConstHelper::ISSHOW_NO =>'显示'
        ];
        //var_dump($rst);exit;
        return $this->render('index',$rst);
    }
    //添加解答
    public function actionAdd(){
        //设置导航栏
        $this->view->params['breadcrumbs'][] = ['label' => '所有问题', 'url' => '/back-question/index.html'];
        $this->view->params['breadcrumbs'][] = '添加回答';
        //创建问题模型
        $model = new AnswerForm();
        $from = \Yii::$app->request->getQueryParam('from','');
        if(\Yii::$app->request->isGet && empty($from)){
            return $this->render('add',['model'=>$model]);
        }
        if($from && \Yii::$app->request->isGet){
            $params['id'] = \Yii::$app->request->getQueryParam('id','');
        }else{
            $params = \Yii::$app->request->post('AnswerForm');
        }
        if((int)$params['id']){
            $params['status'] = ConstHelper::SOLVE_NO;
            $question = Helper::getService('Question')->getRow($params);
            if(!$question){
               return $this->msg(['add'],'此问题的状态不是【未解决】');
            }
            $answerModel = new Answer();
            return $this->render('addAnswer',['answerModel'=>$answerModel,'question'=>$question]);
        }else{
            return $this->msg(['add'],'请传入正确的id号');
        }
    }
    //添加问题数据
    public function actionSave(){
        $questionData = \Yii::$app->request->getBodyParam('Question');
        $answerModel = new Answer();
        if($answerModel->load(\Yii::$app->request->getBodyParam('Answer')) && $answerModel->validate()){
            $answerModel->answer_des = serialize($answerModel->answer_des);
            $answerModel->ques_id = $questionData['id'];
            $answerModel->sub_id = $questionData['sub_id'];
            //获取登录的当前用户
            $answerModel->teacher_id =0;
            $answerModel->add_time =time();
            if($answerModel->save()){
                return $this->msg(['index.html'],'添加解答成功!',3,false);
            }
        }
        return $this->msg(['add'],$this->getErrors($answerModel));
    }
    //编辑回答
    public function actionEdit($id){
        $answerModel = Answer::findOne($id);
        if(!$answerModel){
            $question = Question::findOne($answerModel->ques_id);
            if($question){
                return $this->render('addAnswer',['answerModel'=>$answerModel,'question'=>$question]);
            }
        }
        return $this->msg(['index'],'编辑回答失败');
    }
    //编辑问题是否显示
    public function actionEditshow($id){
        $id = \Yii::$app->request->post('id','');
        $oldIsShow = \Yii::$app->request->post('is_show','');
        if($id && $oldIsShow){
            $answerService = Helper::getService('Answer');
            if($answerService->editIsShow($id,$oldIsShow)){
                return Json::encode(['status'=>'success','msg'=>'操作成功']);
            }
            return Json::encode(['status'=>'error','msg'=>$answerService->getErrorMsg()]);
        }
        return Json::encode(['status'=>'error','msg'=>'缺少必要参数!']);
    }
}