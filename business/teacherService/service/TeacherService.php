<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/10
 * Time: 15:58
 */

namespace business\teacherService\service;


use business\common\BaseService;
use business\interfaces\teacherInterface\TeacherServiceInterface;
use business\teacherService\model\Teachers;

class TeacherService extends BaseService implements TeacherServiceInterface
{

    public function getTeachersAll(array $condition = [], $operator = 'and')
    {
        $query = Teachers::find();
        if($condition){
            $conditionStr = implode($operator,$condition);
            $teachers = $query->where($condition)->all();
        }else{
            $teachers = $query->all();
        }
        return $teachers;
    }
}