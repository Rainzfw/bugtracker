<?php
/**
 * 所有控制下面的基础控制器.
 */
namespace common\core\base;
use common\Helper\ConstHelper;
use common\Helper\Helper;
use Yii;
use yii\helpers\Url;


class Controller extends \yii\web\Controller{
    //定义学科数组
    public $subject=[
        ConstHelper::UI=>'UI',
        ConstHelper::WEB=>'WEB',
        ConstHelper::PHP=>'PHP',
        ConstHelper::JAVA=>'JAVA',
    ];
    public function __construct($id, $module, $config = [])
    {
        //初始化注入服务
        $business = new \business\BusinessInit();
        $business->init();
        parent::__construct($id, $module,$config);
    }
    //操作之后需要显示的页面
    public function msg(array $url=[],$msg='',$sec=3,$error=true){
        $url = Url::toRoute($url);
        if(empty($msg)){
            $msg = $error?'操作出错啦':'操作成功!';
        }
        return $this->renderPartial('/base/msg',['data'=>['goTo'=>$url,'sec'=>$sec,'error'=>$error,'msg'=>$msg]]);
    }
    //获取验证的错误信息
    /*
     * @param $model 数据模型
     * @parameter $attribute 属性
     * @return string
     */
    public function getErrors($model,$attribute=null){
        $errors = $model->getErrors($attribute);
        if(!$errors){
            return '错误信息不详';
        }
        if($attribute){
            return $errors[0];
        }
        $tmp = [];
        foreach($errors as $error){
            $tmp[] =  $error[0];
        }
        return implode('',$tmp);
    }


}