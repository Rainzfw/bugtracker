<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/19
 * Time: 16:20
 */

namespace frontend\models;


use yii\base\Model;
class AssignroleForm extends Model
{
    public $roles;

    public function attributeLabels()
    {
        return [
            'roles'=>'角色'
        ];
    }

    public function rules()
    {
        return [
            ['roles','safe']
        ];
    }

}