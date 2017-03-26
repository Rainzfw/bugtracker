<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/18
 * Time: 18:39
 */

namespace frontend\controllers;


use common\helper\ConstHelper;
use common\helper\Helper;
use frontend\core\base\HomeController;
use frontend\models\Img;
use frontend\models\Question;
use yii\data\Pagination;

class QuestionSetController extends HomeController
{
    //获取问题的详细
    public function actionDetail(){
        //设置导航栏
        $this->view->params['breadcrumbs'][] = ['label' => '错误集', 'url' => '/question-set/index.html'];
        $this->view->params['breadcrumbs'][] = '错误详情';
        //获取请求的问题id 若是没有获取到默认值设置为1
        $id = \Yii::$app->request->get('id','');
        if(empty($id)){
            return $this->msg(['question-set/index'],'缺少参数ID!');
        }
        $subject = \Yii::$app->request->get('subject','未知');
        //获取指定id的问题数据
        $rst['question'] = Helper::getService('Question')->getRow(['id'=>$id]);
        //依据ques_id获取答案
        $rst['answer'] = Helper::getService('Answer')->getRow(['ques_id'=>$rst['question']['id']]);
        //判断这个问题是不是属于当前用户 这个地方需要做判断
        $userInfo = Helper::getSess('userInfo','');
        $rst['flag'] = false;
        if($userInfo &&  Helper::getSess('userInfo','')->id == $rst['question']['user_id']){
            $rst['flag'] = true;
        }
        return $this->render('detail',$rst);
    }
    //错误集列表页
    public function actionIndex(){
        //设置标题导航栏
        $this->view->params['breadcrumbs'][] = '错误集';
        $rst = [];
        //获取取传递过来的学科分类,关键字,当前页数
        $params['status'] = \Yii::$app->request->get('status','');
        $params['keyword'] = \Yii::$app->request->get('keyword','');
        $rst['params'] = $params;
        //在这里实现关键字的查询 获取所有的id
        if($params['keyword']){
            $params['id'] = implode(',',Helper::getService('Sphinx')->getDataByKeyword($params['keyword']));
        }
        $currentPage = \Yii::$app->request->get('page',ConstHelper::FIRST_PAGE);
        //获取分页的总条数
        $totalCount =Helper::getService('Question')->getCount($params);
        $paginations = [];
        foreach($totalCount as $k=>$v){
            if($v){
                //创建分页类工具
                $paginations[$k] = new Pagination(['totalCount'=>$totalCount[$k],'pageSize'=>\Yii::$app->params['pageSize']]);
                //组装参数
                $params[$k]['limit'] = $paginations[$k]->limit;
                $params[$k]['offset']=$paginations[$k]->offset;
            }
        }
        //var_dump($paginations);exit;
        //获取查询出来的结果
        $questions = Helper::getService('Question')->getQuestionAll($params);
        //获取所有的错误集
        $rst['question'] = $questions;
        $rst['pagers'] = $paginations;
        if($params['status'] || $params['keyword']){
            $rst['totalCount'] = $totalCount;
        }
        return $this->render('index',$rst);
    }
    //添加问题
    public function actionAdd(){
        //获取当前用户的信息
        $userInfo = Helper::getSess('userInfo',['id'=>0,'username'=>'zhangsan']);
        $model = new Question();
        if(\Yii::$app->request->isPost){
            $model->load(\Yii::$app->request->post());
            //验证数据
            if(!$model->validate()){
                return json_encode(['status'=>'error','msg'=>$this->getErrors($model)]);
            }
            //获取图片的地址
            $postData = \Yii::$app->request->getBodyParam('Question','');
            $model->img = isset($postData['img'])?$postData['img']:'';
            $model->add_time = time();
            $model->user_id = $userInfo['id'];
            if($model->save()){
                return json_encode(['status'=>'success','msg'=>'新增问题成功']);
            }
            return json_encode(['status'=>'error','msg'=>'新增问题失败']);
        }else{
            if(!$userInfo){
                return $this->msg(['/login/index'],'请先登录');
            }
            //设置导航栏
            $this->view->params['breadcrumbs'][] = ['label' => '错误集', 'url' => '/question-set/index.html'];
            $this->view->params['breadcrumbs'][] = '新增问题';
            return $this->render('add',['model'=>$model]);
        }
    }
    //编辑问题
    public function actionEdit($id){
        $question = Question::findOne($id);
        if(\Yii::$app->request->isPost){
            if($question->load(\Yii::$app->request->post()) && $question->validate()){
                if($question->save()){
                    return json_encode(['status'=>'success','msg'=>'修改问题成功']);
                }
            }
            return json_encode(['status'=>'error','msg'=>$this->getErrors($question)]);
        }
        return $this->render('add',['model'=>$question]);
    }
    //删除问题TODO
    public function actionDelete($id){
    }
    public function actionGetTeachers(){
        $sub_id = \Yii::$app->request->get('sub_id',ConstHelper::PHP);
        $teachers = Helper::getService('Teacher')->getTeachersAll(['sub_id'=>$sub_id]);
        $html = '';
        if($teachers){
            foreach($teachers as $teacher){
                $tmp[$teacher['id']] = $teacher['real_name'];
            }
            return json_encode(['status'=>'success','teachers'=>$tmp]);
        }else{
            return json_encode(['status'=>'error','msg'=>'sub_id:'.$sub_id.'没有教师']);
        }
    }
}