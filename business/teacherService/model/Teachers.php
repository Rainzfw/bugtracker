<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/10
 * Time: 15:51
 */

namespace business\teacherService\model;


use yii\db\ActiveRecord;

class Teachers extends ActiveRecord
{
    public static function tableName(){
        return '{{%teachers}}';
    }

}