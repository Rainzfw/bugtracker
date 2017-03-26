<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/7
 * Time: 14:36
 */

namespace frontend\models;


use common\helper\ConstHelper;
use yii\data\ActiveDataProvider;

class TeacherSearch extends Teacher
{
    //验证的规则
    public function rules(){
        return [
            [['real_name','sub_id','is_delete'],'safe']
        ];
    }
    //搜索数据的函数
    public function search($params){
        //获取一个查询器
        $query = self::find();
        if(!$this->load($params)){
            $dataProvider = new ActiveDataProvider(['query'=>$query,'pagination' => ['pageSize' => ConstHelper::TEACHER_SIZE]]);
            return $dataProvider;
        }
        //添加过滤数据字段
        if(!empty($this->real_name)){
            //模糊查询
            $query->andFilterWhere(['like', 'real_name', $this->real_name]);
        }
        if(!empty($this->sub_id)){
            $query->andFilterWhere(['sub_id'=>$this->sub_id]);
        }
        if(!empty($this->is_delete)){
            $query->andFilterWhere(['is_delete'=>$this->is_delete]);
        }
        $dataProvider = new ActiveDataProvider(['query'=>$query,'pagination' => ['pageSize' => 2]]);
        return $dataProvider;
    }
}