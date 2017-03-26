<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/13
 * Time: 13:20
 */

namespace frontend\models;
use common\helper\Helper;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property integer $sub_id
 * @property integer $user_id
 * @property integer $status
 * @property integer $add_time
 * @property integer $edit_time
 * @property string  $ques_title
 * @property integer $teacher_id
 * @property string  $img
 * @property string  $imgFile
 *
 */
class Question extends ActiveRecord
{
    //设置保存错误图片的属性
    public $imgFile;
    public static function tableName(){
        return "{{%question}}";
    }
    public function rules(){
        return [
            [['ques_title','content','sub_id'],'required','message'=>'{attribute}不能为空!'],
            ['ques_title','string','max'=>'100'],
            [['img','user_id'],'safe'],
        ];
    }
    public function attributeLabels(){
        return [
            'ques_title'=>'问题描述',
            'content'=>'错误提示',
            'sub_id'=>'问题所属学科',
            'imgFile'=>'错误截图',
        ];
    }
    //建立模型之间的关系
    public function getAnswer(){
        return $this->hasOne(Answer::className(),['ques_id'=>'id']);
    }

}