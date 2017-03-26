<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/26
 * Time: 10:46
 */

namespace frontend\models;


use yii\base\Model;

class ImgeForm extends Model
{
    //上传图片的属性
    public $imgFile;
    public $isImgFile=true;
    public function rules(){
        return [
            ['imgFile','file','extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024*1024*2],
            ['isImgFile','safe']
        ];
    }
    public function attributeLabels(){
        return [
            'imgFile'=>'错误截图',
        ];
    }

}