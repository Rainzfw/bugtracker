<?php
//创建权限管理的服务
namespace business\authManagerService\service;
use yii\helpers\ArrayHelper;

class AuthManagerService
{
    //给用户指派角色
    public function assignAuth($admin_id,$roleNames=['member']){
        //var_dump($admin_id,$roleNames);exit;
        $authManager = \Yii::$app->authManager;
        //清除用户关联的所有角色
        $authManager->revokeAll($admin_id);
        if(is_array($roleNames)){
            //关联角色
            foreach($roleNames as $roleName){
                $role = $authManager->getRole($roleName);
                $authManager->assign($role,$admin_id);
            }
        }
        return true;
    }
    //获取所有角色选项
    public  function getRolesItem()
    {
        $authManager = \Yii::$app->authManager;
        $roles = $authManager->getRoles();
        return ArrayHelper::map($roles,'name','description');
    }
    //下载当前用户的所有角色
    public function loadRoles($admin_id){
        $authManager = \Yii::$app->authManager;
        $roles = $authManager->getRolesByUser($admin_id);
        return ArrayHelper::map($roles,'name','name');
    }

}