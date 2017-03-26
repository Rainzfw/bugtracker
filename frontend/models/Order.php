<?php
namespace frontend\models;
use yii\db\ActiveRecord;

class Order extends ActiveRecord{
    //重写静态方法 重写表名
    public static function tableName(){
        return "{{%order}}";
    }
    //将订单和商品的表对应上 多对多的关系需要中间表
    public function getGoods(){
        return $this->hasMany(Goods::className(),['id'=>'goods_id'])->
            viaTable('{{%order_goods}}',['order_id'=>'id']);
    }
    public function getUers(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }

}