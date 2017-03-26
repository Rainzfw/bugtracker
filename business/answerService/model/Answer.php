<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/8
 * Time: 16:30
 */

namespace business\answerService\model;


use business\questionService\model\Question;
use yii\db\ActiveRecord;

class Answer extends ActiveRecord
{
    //绑定question表和answer表之间的关系
    public function getQuestion(){
        return $this->hasOne(Question::className(),['id'=>'ques_id']);
    }


}