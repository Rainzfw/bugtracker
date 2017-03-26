<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/26
 * Time: 14:28
 */

namespace frontend\widgets;
use yii\base\Widget;

class PlayerVideoWidget extends Widget
{
    public $styleid;
    public $client_id;
    public $vid;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('playervideo',['styleid'=>$this->styleid,'client_id'=>$this->client_id,'vid'=>$this->vid]);
    }

}