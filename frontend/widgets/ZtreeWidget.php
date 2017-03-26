<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 10:35
 */
namespace frontend\widgets;
use yii\base\Widget;
use yii\helpers\Json;
use yii\web\JqueryAsset;
use yii\web\View;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/28
 * Time: 11:25
 */
class ZtreeWidget extends  Widget
{
    public $Ztree_cssFile = '@web/css/ztree/zTreeStyle.css';
    public $Ztree_jsFile = '@web/js/ext/ztree/jquery.ztree.core.min.js';
    public $setting='{}';
    public $zNodes=[];
    public $id;//id
    public $expandAll=true;//展开所有
    public $selectNodes=[];//要选中的节点
    public  function  init(){
        parent::init();
        if($this->id==null) $this->id = 'Ztree'.uniqid();
    }
    public  function  run(){
        $this->loadCssFile();
        $this->loadJsFile();
        $this->loadJs();
        parent::run();
        return '<div><label class="control-label" >上级菜单</label><ul id="'.$this->id.'" class="ztree"></ul></div>';
    }
    public  function  loadCssFile(){
        $this->view->registerCssFile($this->Ztree_cssFile);
    }
    private function loadJsFile()
    {
        //jquery.ztree需要依赖jquery
        $this->view->registerJsFile($this->Ztree_jsFile,['depends'=>JqueryAsset::className()]);
    }
    private function loadJs()
    {
        $this->view->registerJs('var zTreeObj;
        // zTree 的参数配置，深入使用请参考 API 文档（setting 配置详解）
        var setting = '.$this->setting.';
        // zTree 的数据属性，深入使用请参考 API 文档（zTreeNode 节点数据详解）
        var zNodes = '.Json::encode($this->zNodes).';',View::POS_END);

        $this->view->registerJs('zTreeObj = $.fn.zTree.init($("#'.$this->id.'"), setting, zNodes);');
        //展开
        if($this->expandAll){
            $this->view->registerJs('zTreeObj.expandAll(true);');
        }
        //选中节点
        foreach($this->selectNodes as $k=>$v){
            $this->view->registerJs('zTreeObj.selectNode(zTreeObj.getNodesByParam("'.$k.'","'.$v.'",null)[0]);');
        }
    }
}