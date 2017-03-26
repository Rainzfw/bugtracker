<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/7
 * Time: 9:23
 */

namespace frontend\models;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Sql1 extends ActiveRecord
{
    public static function tableName(){
        return "{{user_register}}";
    }
    public function rules(){
        return [
            [['user_name','password'],'required','message'=>'{attribute}不能为空'],
        ];
    }
    public function attributeLabels(){
        return [
            'user_name'=>'用户名',
            'password'=>'密码'
        ];
    }
    public function getSql2(){
        return $this->hasOne(Sql2::className(),['user_id'=>'id']);
    }
}