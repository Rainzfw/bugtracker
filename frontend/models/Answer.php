<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/13
 * Time: 13:53
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class Answer extends ActiveRecord
{
    public function rules(){
        return [
          [['answer_des'],'required','message'=>'{attribute不能为空!}'],
          [['translate_error','video_id'],'safe']
        ];
    }
    public function attributeLabels(){
        return [
            'ques_title'=>'问题描述',
            'content'=>'错误提示',
            'sub_id'=>'问题所属学科'
        ];
    }


}