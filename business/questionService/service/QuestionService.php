<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/19
 * Time: 11:30
 */

namespace business\questionService\service;


use business\common\BaseService;
use business\interfaces\questionInterface\QuestionServiceInterface;
use business\questionService\model\Question;
use business\userService\model\User;
use common\helper\ConstHelper;
use common\Helper\Helper;

class QuestionService extends BaseService implements QuestionServiceInterface
{
    public function getCount(array $where = [],$home=true)
    {
        $toalCount  = [];
        $whereStr = [];
        $query = Question::find();
        if($home){
            $whereStr [] = ' is_show = '.ConstHelper::ISSHOW_YES;
            $whereStr [] = 'status not in ( ' .ConstHelper::AUDIT_NO.','.ConstHelper::AUDIT_FAIL.' ) ';
        }
        if($where){
            if(!empty($where['status'])){
                $whereStr ['status']= ' status = '.$where['status'];
            }
            if(!empty($where['keyword'])){
                if($where['id']){
                    $whereStr ['id']= " id in({$where ['id']}) ";
                }else{
                    $whereStr ['id']= ' id in(" ") ';
                }
            }
            if(!empty($where['is_show'])){
                $whereStr ['is_show']= ' is_show = '.$where['is_show'];
            }
        }
        foreach($this->sub_ids as $k=>$v){
            $whereStr['sub_id'] = ' sub_id = '.$v;
            $toalCount[$k] = $query->where(implode(' and ',$whereStr))->count();
        }
        return $toalCount;
    }
    public function getQuestionAll(array $where=[],$operator=true,$home=true)
    {
        $questions = [];
        $whereStr = [];
        $query = Question::find();
        if($home){
            $whereStr[] = ' is_show = '.ConstHelper::ISSHOW_YES;
            $whereStr [] = 'status not in ( ' .ConstHelper::AUDIT_NO.','.ConstHelper::AUDIT_FAIL.' )';
        }
        if($where){
            if(!empty($where['status'])){
                $whereStr ['status']= ' status = '.$where['status'];
            }
            if(!empty($where['keyword'])){
                if($where['id']){
                    $whereStr ['id']= "id in ({$where['id']}) ";
                }else{
                    $whereStr ['id']= 'id in (" ") ';
                }
            }
            if(!$home && !empty($where['is_show'])){
                $whereStr['is_show'] = 'is_show = '.$where['is_show'];
            }
        }
        foreach($this->sub_ids as $k=>$v){
            $whereStr['sub_id'] = ' sub_id = '.$v;
            $condition = implode(' and ',$whereStr);
            if(isset($where[$k])){
                $questions[$k] = $query->where($condition)->limit($where[$k]['limit'])->offset($where[$k]['offset'])->all();
                //var_dump($questions);exit;
            }
        }
        return $questions;
    }
    public function getRow(array $condition=[],$operator=true){
        $whereStr = '';
        if($condition){
            $where = [];
            foreach($condition as $key => $value){
                $where[] = "`".$key."` = ".$value;
            }
            $whereStr = implode(' and ',$where);
        }
        $query = Question::find();
        if($whereStr){
            $res = $query->where($whereStr)->one();
        }else{
            $res = $query->one();
        }
        return $res;
    }
    //审核问题状态
    public function auditQestion($id,$status){
        $question = Question::findOne($id);
        if(!$question){
            $this->setErrorMsg('此问题不存在');
            return false;
        }
        if($status == ConstHelper::SOLVE_NO){
            $question->status = ConstHelper::SOLVE_NO;
        }
        if($status == ConstHelper::AUDIT_FAIL){
            $question->status = ConstHelper::AUDIT_FAIL;
        }
        if($question->save()){
            return true;
        }else{
            $this->setErrorMsg('操作失败!');
            return false;
        }
    }
    //修改问题是否显示
    public function editIsShow($id,$oldIsShow){
        $question = Question::findOne($id);
        if(!$question){
            $this->setErrorMsg('此问题不存在');
            return false;
        }
        $question->is_show = $oldIsShow == ConstHelper::ISSHOW_YES ? ConstHelper::ISSHOW_NO:ConstHelper::ISSHOW_YES;
        if($question->save()){
            return true;
        }
        $this->setErrorMsg('修改显示状态失败!');
        return false;
    }
}