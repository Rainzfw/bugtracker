<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/8
 * Time: 16:31
 */

namespace business\answerService\service;


use business\answerService\model\Answer;
use business\common\BaseService;
use business\interfaces\answerInterface\AnswerServiceInterface;
use common\helper\ConstHelper;

class AnswerService extends BaseService implements AnswerServiceInterface
{

    public function getRow(array $condition = [], $operator = true)
    {
        $whereStr = '';
        if($condition){
            $where = [];
            foreach($condition as $key => $value){
                $where[] = "`".$key."` = ".$value;
            }
            if($operator){
                $whereStr = implode(' and ',$where);
            }else{
                $whereStr = implode(' or ',$where);
            }
        }
        $query = Answer::find();
        if($whereStr){
            $res = $query->where($whereStr)->one();
        }else{
            $res = $query->one();
        }
        return $res;
    }
    public function getCount(array $condition=[],$operator=true){
        $toalCount  = [];
        $whereStr = [];
        $query = Answer::find();
        if($condition){
            if(!empty($condition['is_show'])){
                $whereStr = ' is_show = '.$condition['is_show'];
                $operator?$query->andWhere($whereStr):$query->orWhere($whereStr);

            }
            if(!empty($condition['keyword'])){
                $whereStr = ' translate_error like "%'.$condition['keyword'].'%"';
                $operator?$query->andWhere($whereStr):$query->orWhere($whereStr);
            }
            if(!empty($condition['teacher_id'])){
                $whereStr = ' teacher_id = '.$condition['teacher_id'];
                $operator?$query->andWhere($whereStr):$query->orWhere($whereStr);
            }
        }
        foreach($this->sub_ids as $k=>$v){
            $toalCount[$k] = $query->where(' sub_id = '.$v)->count();
        }
        return $toalCount;
    }
    public function getAllAnswers(array $condition=[],$operator=true){
        $answers = [];
        $query = Answer::find();
        if($condition){
            if(!empty($condition['is_show'])){
                $whereStr = ' is_show = '.$condition['is_show'];
                $operator?$query->andWhere($whereStr):$query->orWhere($whereStr);

            }
            if(!empty($condition['keyword'])){
                $whereStr = ' translate_error like "%'.$condition['keyword'].'%"';
                $operator?$query->andWhere($whereStr):$query->orWhere($whereStr);
            }
            if(!empty($condition['teacher_id'])){
                $whereStr = ' teacher_id = '.$condition['teacher_id'];
                $operator?$query->andWhere($whereStr):$query->orWhere($whereStr);
            }
        }
        foreach($this->sub_ids as $k=>$v){
            if(isset($condition[$k])){
                $answers[$k] = $query->where(' sub_id = '.$v)->limit($condition[$k]['limit'])->offset($condition[$k]['offset'])->all();
                //var_dump($questions);exit;
            }
        }

        return $answers;
    }
    //修改问题是否显示
    public function editIsShow($id,$oldIsShow){
        $answer = Answer::findOne($id);
        if(!$answer){
            $this->setErrorMsg('回答不存在!');
            return false;
        }
        $answer->is_show = $oldIsShow == ConstHelper::ISSHOW_YES?ConstHelper::ISSHOW_NO:ConstHelper::ISSHOW_YES;
        if($answer->save()){
            return true;
        }
        $this->setErrorMsg('修改问题是否显示失败');
        return false;
    }
}
