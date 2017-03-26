<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 10:55
 */

namespace frontend\models;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Menu extends ActiveRecord
{
    public static function tableName(){
        return  "{{%menu}}";
    }
    public function rules(){
        return [
            [['name','route'], 'required','message'=>'不能为空','on'=>['add','edit']],
            [['pid'], 'integer','on'=>['add','edit']],
            [['name'], 'string', 'max' => 50,'on'=>['add','edit']],
            [['description'], 'string', 'max' => 255,'on'=>['add','edit']],
            [['route'], 'string', 'max' => 50,'on'=>['add','edit']],
            ['route', 'unique','on'=>['add']],
            ['route', 'checkRoute','on'=>['edit']],
            ['icon','safe']
        ];
    }
    //定义验证route的规则 编辑的时候使用
    public function checkRoute($attribute){
        if(self::find()->where("id !={$this->id} and route = '{$this->$attribute}'")->one()){
            $this->addError($attribute,'此路由已存在');
        }
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '菜单名',
            'pid' => '父级菜单',
            'description' => '描述',
            'route' => '路由',
            'icon'=>'图标'
        ];
    }
    //获取所有的分类
    public static function getAll(){
        return ArrayHelper::toArray(self::find()->all());
    }
    //获取顶级分类
    public static function getTops(){
        return self::findAll(['pid'=>0]);
    }
    //获取子菜单 这里限制死了只能循环到二级菜单
    public function getSubmenus(){
        return self::findAll(['pid'=>$this->id]);
    }
    //获取当前用户可以访问子菜单
    public function getadminSubmenus(){
        $submenus = $this->submenus;
        foreach($submenus as $submenu){
            if(\Yii::$app->user->can($submenu['route'])){
                $new[] = $submenu;
            }
        }
        return $new;
    }
    //添加菜单
    public  function add(){
        if($this->validate()){
            $this->pid = empty($this->pid)?0:$this->pid;
            return $this->save();
        }
        return false;
    }

}