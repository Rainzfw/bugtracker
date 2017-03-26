<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/19
 * Time: 11:15
 */

namespace frontend\widgets;


use frontend\models\Menu;
use yii\base\Widget;

class BackMenuWidget extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        //获取所有的一级菜单菜单
        $menus = Menu::getTops();
        return $this->render('menu',['menus'=>$menus]);
    }

}