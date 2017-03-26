<?php
namespace business\coreseekService\service;
class SphinxService
{
	private $_sphinxapi = null;
	private $_params = [];
	private $_error;
	public function __construct(){
		//连接searchd服务
		$this->_sphinxapi = new SphinxClient;
		$this->_params = \Yii::$app->params['coreseek'];
		$this->_sphinxapi->setServer($this->_params['host'], $this->_params['port']);
	}
	//执行分词关键字查询
	public function getDataByKeyword($keyword){
		$this->_sphinxapi->setMatchMode(SPH_MATCH_ANY);
		$this->_sphinxapi->setMaxQueryTime($this->_params['searchtime']);                             //设置最大搜索时间
		$this->_sphinxapi->SetArrayResult(false);//是否将Matches的key用ID代替
 		//是否将Matches的key用ID代替 		//设置返回信息的内容,等同于SQL
		$res = $this->_sphinxapi->query($keyword,$this->_params['indexs']); #[宝马]关键字，[main]数据源source
		$this->_error = $this->_sphinxapi->GetLastError();
		if($res['total_found']){
			return  array_keys($res['matches']);
		}
		return [];
	}
	//返回执行的错误信息
	public function getError(){
		return $this->_error;
	}
}

?>