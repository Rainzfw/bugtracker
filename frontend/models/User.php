<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/15
 * Time: 11:40
 */
namespace frontend\models;


use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function tableName(){
        return '{{%user}}';
    }
}