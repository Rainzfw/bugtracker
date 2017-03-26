<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/15
 * Time: 10:06
 */

namespace frontend\models;


use yii\base\Model;
use yii\helpers\ArrayHelper;

class RoleForm extends Model
{
    public $name;//角色名称
    public $description;//角色描述
    public $permissions;//权限
    public function rules(){
        return [
            [['name','description','permissions'],'required','on'=>['add','edit']],
            ['name','checkUnique','on'=>['add']],
        ];
    }
    public  function attributeLabels(){
        return [
            'name'=>'角色',
            'description'=>'描述',
            'permissions'=>'权限'
        ];
    }
    //验证角色的唯一性
    public function checkUnique($attribute){
        if(\Yii::$app->authManager->getRole($this->$attribute)){
            $this->addError($attribute,'此角色已存在');
        }
    }
    //添加角色和权限
    public function addRole()
    {
        $authManager=\Yii::$app->authManager;
        $role=$authManager->createRole($this->name);
        $role->description=$this->description;
        $authManager->add($role);
        //角色添加权限
        if($this->permissions){
            foreach($this->permissions as $item){
                $permi=$authManager->getPermission($item);
                $authManager->addChild($role,$permi);
            }
        }
        return true;
    }
    //获取所有的权限
    public function getAllPermissions(){
        $permissions = \Yii::$app->authManager->getPermissions();
        return ArrayHelper::map($permissions,'name','description');
    }
    //编辑角色 模型加载权限数据
    public function loadData($name)
    {
        $role=\Yii::$app->authManager->getRole($name);
        $this->name=$name;
        $this->description=$role->description;
        $pers=\Yii::$app->authManager->getPermissionsByRole($name);
        $arrPer=ArrayHelper::map($pers,'name','name');
        $this->permissions=$arrPer;

    }
    //编辑角色
    public function editRole($name)
    {
        if($this->validate()){
            $authManager=\Yii::$app->authManager;
            //角色名称 （主键 不能修改）
            $role=$authManager->getRole($name);
            $role->description=$this->description;
            $authManager->update($name,$role);
            //修改权限 先删除权限再分配权限
            $authManager->removeChildren($role);
            if($this->permissions){
                foreach($this->permissions as $value){
                    //根据权限名称获取权限对象
                    $permission = $authManager->getPermission($value);
                    $authManager->addChild($role,$permission);
                }
            }
            return true;
        }
        return false;

    }
}