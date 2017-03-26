<?php
//过滤器就是在控制器中方法执行前执行后执行的操作 有点切面开发的意味
//定义过滤器的命名空间
namespace frontend\filters;
//定义一个时间过滤器类
use yii\base\ActionFilter;
//计算操作执行的时间
class TimeFilter extends ActionFilter{
    private $_excStart;
    private $_excEnd;
    private $_diff;
    //动作执行之前执行的过滤器动作
    public function beforeAction($action){
        //调用父类的数据 microtime获取到毫秒
        $this->_excStart = microtime();
        //要拦截后续的执行 返回false就可以了 不拦截直接返回true
        return parent::beforeAction($action);

    }
    //动作执行之后执行的过滤器动作
    public function afterAction($action,$after){
        $this->_excEnd = microtime();
        $this->_diff = $this->_excEnd - $this->_excStart;
        echo "执行动作[{$action->uniqueId}]";
        echo '执行开始的时间戳:'.$this->_excStart.' 执行结束的时间戳:'.$this->_excEnd.'<br/>';
        echo '总计消耗的时间:'.$this->_diff;
        parent::afterAction($action,$after);
    }
}