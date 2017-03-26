<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/15
 * Time: 12:49
 * 用来定义常量的
 */

namespace common\Helper;


class ConstHelper
{
    //邮箱正则表达式
    const EMAIL_REGEX = '/^[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/';
    //电话号码正则表达式
    const TEL_REGEX =  '/^((\+86)|(86))?\d{11}$/';
    //用户昵称的规范
    const USERNAME_REGEX = '/^([\x{4e00}-\x{9fa5}]|[A-Za-z])+\w*$/u';
    //图片名称的正则
    Const ImgExt_REGEX = '/^([\w-]+\.(png|jpg|gif))$/';
    //学科
    const UI = 1;
    const WEB = 2;
    const PHP = 3;
    const JAVA = 4;
    //是否显示
    const ISSHOW_NO = 1;
    const ISSHOW_YES = 2;
    //课程显示
    const SHOW = 5;
    const COLSE = 6;
    //图片类型
    const CAROUSEL_IMG = 1; //轮播图
    const RIGHT_MIN_IMG = 2; //右侧小广告图
    //问题的所有 状态 status状态
    const AUDIT_NO = 1;  //未审核 审核不通过
    const AUDIT_YES = 2;  //审核通过
    const SOLVE_NO = 3;  //未解决
    const SOLVE_YES = 4;  //已解决
    const AUDIT_FAIL=5;//审核失败的
    //性别
    const MALE = 1;
    const FEMALE = 2;
    //定义每页显示的条数
    const SIZE_TEN = 10;
    //定义后台页面每页显示的条数
    const BACK_SIZE = 20;
    //教室列表页
    const TEACHER_SIZE = 6;
    //定义列表数据的第一页
    const FIRST_PAGE = 1;
    //优酷云客户端id
    const CLIENT_ID = '14139104b387cfda';
    //视频类型id
    const STYLEID = 0;
    //默认插入问题表的user_id值
    const USER_ID = 0;
    //定义后台用户的有效性 是否为删除状态
    const STATUS_DELETED = 2;
    const STATUS_ACTIVE = 1;
    //定义数字0
    const ZERO = 0;
    //定义警告框的html字符串 未搜索到问题
    const WARNING_HTML = <<<warning
<div class="alert alert-success alert-dismissable" style=' background-color: #F2F2F2;'>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>
        注意!
    </h4><strong>Warning!</strong>此学科没有你搜索的问题
</div>
warning;

    //定义警告框的html字符串 未搜索到问题
    const NOADUIT_DATA = <<<warning
<div class="alert alert-success alert-dismissable" style=' background-color: #F2F2F2;'>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>
        注意!
    </h4><strong>Warning!</strong>此学科没有需要审核的问题
</div>
warning;

    //定义警告框的html字符串 未搜索任何答案
    const ANSWER_DATA = <<<warning
<div class="alert alert-success alert-dismissable" style=' background-color: #F2F2F2;'>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>
        注意!
    </h4><strong>Warning!</strong>此学科没有回答的任何问题
</div>
warning;
}