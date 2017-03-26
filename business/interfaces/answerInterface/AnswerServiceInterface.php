<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/8
 * Time: 16:48
 */

namespace business\interfaces\answerInterface;


interface AnswerServiceInterface
{
    /*
    * 依据条件获取一行数
    * @param $condition
    * @param $operator
    * return mixed
    */
    public function getRow(array $condition=[],$operator=true);
    /*
    * 依据条件获取总计有多少数据
    * @param array $condition
    * @param $operator
    * return mixed
    */
    public function getCount(array $condition=[],$operator=true);
    /*
     * 依据条件获取所有的回答
     * @param  array $condition
     * @param bool $operator
     * return mixed
     */
    public function getAllAnswers(array $condition=[],$operator=true);

}