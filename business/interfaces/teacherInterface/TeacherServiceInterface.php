<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/10
 * Time: 15:54
 */

namespace business\interfaces\teacherInterface;


interface TeacherServiceInterface
{

    /*
     * 依据条件获取教师信息
     * @param $condition
     * @param $$operator
     * @return mixed
     **/
    public function getTeachersAll(array $condition=[],$operator='and');

}