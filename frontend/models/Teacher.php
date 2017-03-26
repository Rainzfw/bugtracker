<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/7
 * Time: 14:34
 */

namespace frontend\models;


use common\helper\ConstHelper;
use common\helper\Helper;
use yii\db\ActiveRecord;

class Teacher extends ActiveRecord
{
    public static function tableName(){
        return "{{%teachers}}";
    }
    public function attributeLabels(){
        return [
            'id'=>'ID',
            'real_name'=>'名字',
            'alias_name'=>'昵称',
            'sub_id'=>'所属学科',
            'is_delete'=>'状态',
            'tel'=>'联系电话',
            'sex'=>'性别'
        ];
    }
    //验证规则 应用验证场景
    public function rules(){
        return [
            [['real_name','sub_id','tel','sex'],'required','message'=>'{attribute}不能为空','on'=>['add', 'edit']],
            ['real_name','unique','message'=>'已存在','on'=>['add']],
            ['tel','checkEmail','on'=>['add', 'edit']],
            [['alias_name','is_delete'],'safe','on'=>['add', 'edit']]
        ];
    }
    //修改teacher的状态
    public function editStatus($oldIsDelete){
        $isDeleteArr = [
            ConstHelper::STATUS_ACTIVE=>ConstHelper::STATUS_DELETED,
            ConstHelper::STATUS_DELETED=>ConstHelper::STATUS_ACTIVE
        ];
        $this->is_delete = $isDeleteArr[$oldIsDelete];
        return $this->save();
    }
    //自定义验证邮箱
    public function checkEmail($attribute){
        if(!Helper::isTelphone($this->$attribute)){
            $this->addError($attribute,'电话格式错误');
        }
    }
    //定义验证的场景
    public function scenarios()
    {
        return [
            'add'=>['real_name', 'sub_id', 'tel', 'sex','alias_name','is_delete'],
            'edit'=>['real_name', 'sub_id', 'tel', 'sex','alias_name','is_delete'],
        ];
    }

}