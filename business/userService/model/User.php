<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/16
 * Time: 17:06
 */

namespace business\userService\model;


use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function tableName(){
        return '{{%user}}';
    }
    public  function rules(){
        return [
            [['username','password','email','sex','sub_id','salt'],'required','message'=>'{attribute}不能为空!'],
        ];
    }
    //标签
    public function attributeLabels(){
        return [
            'username'=>'用户名',
            'password'=>'密码',
            'email'=>'邮箱',
            'sex'=>'性别',
            'sub_id'=>'感兴趣的学科'
        ];
    }
    //添加用户
    public function add($data){
        //设置
        $this->setAttributes($data);
        $this->save();
        return $this->getPrimaryKey();
    }
}