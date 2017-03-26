<?php
namespace frontend\models;
use yii\db\ActiveRecord;

class Sql2 extends ActiveRecord{
    public static $hobbyItems=[
        '足球',
        '羽毛球',
        '乒乓球',
        '篮球'
    ];
    //定义图片的属性
    public $imgFile;//imgFile
    public static function tableName(){
        return "{{user_info}}";
    }
    public function rules(){
        return [
            [['adress','age','sex','tel','email','hobby'],'required','message'=>'{attribute}不能为空'],
            ['imgFile','file','extensions'=>['jpg','png','gif'],'maxFiles'=>4]
        ];
    }
    public function attributeLabels(){
        return [
            'adress'=>'地址',
            'age'=>'年龄',
            'sex'=>'性别',
            'tel'=>'电话',
            'email'=>'邮箱'
        ];
    }
    //添加之前所做的数据处理 这里是组件的行为么？
    public function beforeSave($insert){
        $tmp = [];
        foreach($this->hobby as $v){
            $tmp [$v] = self::$hobbyItems[$v];
        }
        $this->hobby =implode(',', $tmp);
        return parent::beforeSave($insert);
    }
    //findOne方法之后需要执行的
    public function afterFind(){
        $tmp =[];
        $this->hobby = explode(',',$this->hobby);
        foreach(self::$hobbyItems as $k=>$v){
            in_array($v, $this->hobby)?$tmp[$k]=$v:'';
        }
        $this->hobby = $tmp;
        parent::afterFind();
    }
}