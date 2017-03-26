<?php
/**
 * 问题接口
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/19
 * Time: 11:32
 */

namespace business\interfaces\questionInterface;

interface QuestionServiceInterface
{
    /*
     * 依据条件获取数据的总条数
     * @param $where
     * @param $home是否为前台控制器
     * @return mixed
     */
    public function getCount(array $where=[],$home=true);
    /*
     *依据条件获取所有的问题
     * @param $where
     * @param $operator 操作符 true ===>and  false ====>or
     * @return mixed
     */
    public function getQuestionAll(array $where=[],$operator=true,$home=true);
    /*
     * 依据条件获取一行数
     * @param $condition
     * @param $operator
     * return mixed
     */
    public function getRow(array $condition=[],$operator=true);
}
