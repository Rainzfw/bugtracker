<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 19:09
 */

namespace frontend\models;


use yii\base\Model;

class PermissionForm extends Model
{
    public $name;
    public $description;
    public function rules(){
        return [
            [['name','description'],'required'],
            [['name'],'checkPerminame'],
        ];
    }
    //定义属性标签
    public  function attributeLabels(){
        return [
            'name'=>'权限名称',
            'description'=>'描述',
        ];
    }
    //验证此权限是否已经存在
    public function checkPerminame($attribute){
        if(\Yii::$app->authManager->getPermission($this->$attribute)){
            $this->addError($attribute,'此权限已存在!');
        }
    }
    //添加权限
    public function add(){
        if($this->validate()){
            $authManager = \Yii::$app->authManager;
            $permission = $authManager->createPermission($this->name);
            $permission->description = $this->description;
            return $authManager->add($permission);
        }
        return false;
    }


}