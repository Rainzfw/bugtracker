<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/16
 * Time: 16:22
 */
namespace frontend\controllers;
use common\helper\ConstHelper;
use common\helper\Helper;
use frontend\core\base\BackController;
use frontend\models\ImgeForm;
use frontend\models\Question;
use kucha\ueditor\UEditorAction;
use yii\data\Pagination;
use yii\helpers\Json;
use yii\web\UploadedFile;

class BackQuestionController extends BackController
{

    public function actionIndex(){
        //设置导航栏
        $this->setBreadcrumbs('问题集',false);
        //获取搜索信息
        $params = [];
        $params['status'] = \Yii::$app->request->get('status','');
        $params['keyword'] = \Yii::$app->request->get('keyword','');
        $params['is_show'] = \Yii::$app->request->get('is_show','');
        $rst['params'] = $params;
        //分词搜索获取到数据的id
        if($params['keyword']){
            //var_dump(implode(',',Helper::getService('Sphinx')->getDataByKeyword($params['keyword'])));exit;
            $params['id']= implode(',',Helper::getService('Sphinx')->getDataByKeyword($params['keyword']));
        }
        //获取当前页数
        $currentPage=\Yii::$app->request->get('page',ConstHelper::FIRST_PAGE);
        //获取每个学科数据的总条数
        $totalCount = Helper::getService('Question')->getCount($params,false);
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
        $questions = Helper::getService('Question')->getQuestionAll($params,true,false);
        $rst['question'] =  $questions;
        $rst['pagers'] =  $paginations;
        //这里是组装查询出来的结果
        if($params['status'] || $params['keyword'] || $params['is_show']){
            $rst['totalCount'] = $totalCount;
        }
        //定义问题状态文字描述的数组
        $rst['statusText'] = [
            ConstHelper::AUDIT_NO=>'未审核通过',
            ConstHelper::SOLVE_NO=>'未解决',
            ConstHelper::SOLVE_YES=>'已解决',
            ConstHelper::AUDIT_FAIL=>'审核失败',

        ];
        //定义是否显示的文字描述
        $rst['showText'] = [
            ConstHelper::ISSHOW_YES=>'显示',
            ConstHelper::ISSHOW_NO =>'不显示'
        ];
        return $this->render('index',$rst);
    }
    //获取所有未审核的问题
    public function actionNoaudit(){
        //设置导航栏
        $this->view->params['breadcrumbs'][] = ['label' => '问题集', 'url' => '/back-question/index.html'];
        $this->view->params['breadcrumbs'][] = '未审核的问题';
        $params['status'] = ConstHelper::AUDIT_NO;
        //获取每个学科数据的未审核的总条数
        $totalCount = Helper::getService('Question')->getCount($params,false);

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
        $questions = Helper::getService('Question')->getQuestionAll($params,true,false);
        $rst['question'] =  $questions;
        $rst['pagers'] =  $paginations;
        $rst['totalCount'] = $totalCount;
        //定义问题状态文字描述的数组
        $rst['statusText'] = [
            ConstHelper::AUDIT_NO=>'未审核通过',
            ConstHelper::SOLVE_NO=>'未解决',
            ConstHelper::SOLVE_YES=>'已解决',
            ConstHelper::AUDIT_FAIL=>'审核失败',

        ];
        //定义是否显示的文字描述
        $rst['showText'] = [
            ConstHelper::ISSHOW_YES=>'显示',
            ConstHelper::ISSHOW_NO =>'不显示'
        ];
        return $this->render('noaudit',$rst);
    }
    //审核问题
    public function actionAuditQuestion(){
        $id = \Yii::$app->request->post('id','');
        $status = \Yii::$app->request->post('status','');
        if($id && $status){
            $questionService = Helper::getService('Question');
            if($questionService->auditQestion($id,$status)){
                return Json::encode(['status'=>'success','msg'=>'操作成功']);
            }
            return Json::encode(['status'=>'error','msg'=>$questionService->getErrorMsg()]);
        }
        return Json::encode(['status'=>'error','msg'=>'缺少必要参数!']);
    }
    //编辑显示状态
    public function actionEditshow(){
        $id = \Yii::$app->request->post('id','');
        $oldIsShow = \Yii::$app->request->post('is_show','');
        if($id && $oldIsShow){
            $questionService = Helper::getService('Question');
            if($questionService->editIsShow($id,$oldIsShow)){
                return Json::encode(['status'=>'success','msg'=>'操作成功']);
            }
            return Json::encode(['status'=>'error','msg'=>$questionService->getErrorMsg()]);
        }
        return Json::encode(['status'=>'error','msg'=>'缺少必要参数!']);
    }
    //问题的详细信息
    public function actionDetail($id){
        //设置导航栏
        $this->setBreadcrumbs('错误详情');
        $rst['question'] = Question::findOne($id);
        if($rst['question']){
            $rst['answer'] = $rst['question']->answer;
        }
        //定义是否显示的文字描述
        $rst['answerShowText'] = [
            ConstHelper::ISSHOW_YES=>'隐藏答案',
            ConstHelper::ISSHOW_NO =>'显示答案'
        ];
        $rst['questionShowText'] = [
            ConstHelper::ISSHOW_YES=>'隐藏问题',
            ConstHelper::ISSHOW_NO =>'显示问题'
        ];
        //var_dump($question,$answer);
        return $this->render('detail',$rst);
    }
    //问题编辑
    public function actionEdit($id){
        //设置导航栏
        $this->setBreadcrumbs('编辑问题');
        $question = Question::findOne($id);
        //创建上传图片的模型
        $imgModel = new ImgeForm();
        if(!$question){
            $this->msg(["detail.html?id=$id"],'此问题ID不存在!');
        }
        if(\Yii::$app->request->isPost){
            //查看原来图片的地址 删除废除的图片地址
            if(!\Yii::$app->request->getBodyParam('Question[img]','')){
                //TODO实现删除不使用的图片
            }
            if($question->load(\Yii::$app->request->post()) && $question->save()){
                return $this->msg(['index'],'修改问题成功!',3,false);
            }
            return $this->msg(['edit.html?id='.$id],$this->getErrors($question));
        }
        return $this->render('add',['model'=>$question,'imgModel'=>$imgModel,'subject'=>$this->subject]);
    }
    //后台新增问题
    public function actionAdd(){
        //设置导航栏
        $this->setBreadcrumbs('新增问题');
        $question = new Question();
        $imgForm = new ImgeForm();
        if(\Yii::$app->request->isPost){
            if($question->load(\Yii::$app->request->post()) && $question->validate()){
                $question->user_id = ConstHelper::USER_ID;
                $question->add_time =time();
                $question->save();
                return $this->msg(['noaudit'],'添加成功,赶快去审核!',3,true);
            }
            return $this->msg(['add'],$this->getErrors($question));
        }
        return $this->render('add',['model'=>$question,'imgModel'=>$imgForm,'subject'=>$this->subject]);
    }
    private function setBreadcrumbs($currentLabel,$child=true){
        if($child){
            $this->view->params['breadcrumbs'][] = ['label' => '问题集', 'url' => '/back-question/index.html'];
        }
        $this->view->params['breadcrumbs'][] = $currentLabel;
    }

}