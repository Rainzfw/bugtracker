<?php

namespace frontend\modules\admin\controllers;

use frontend\models\Sql1;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $res = Sql1::find()->all();
        var_dump($res);exit;
        echo 'admin-default-index';
        return $this->render('index');
    }
}
