/*
SQLyog Ultimate v11.24 (32 bit)
MySQL - 5.7.16-log : Database - itsource_bug_tracker
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`itsource_bug_tracker` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `itsource_bug_tracker`;

/*Table structure for table `ibt_admin` */

DROP TABLE IF EXISTS `ibt_admin`;

CREATE TABLE `ibt_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '后台用户ID',
  `username` varchar(20) NOT NULL COMMENT '后台用户名称,员工真实姓名拼音',
  `password_hash` char(64) NOT NULL COMMENT '用户密码',
  `is_delete` tinyint(3) unsigned DEFAULT '1' COMMENT '状态1未删除2删除',
  `auth_key` char(32) DEFAULT NULL COMMENT '自动登录的token',
  `password_reset_token` char(32) DEFAULT NULL COMMENT '密码重置的token',
  `teacher_id` tinyint(3) unsigned NOT NULL COMMENT '后台用户对应的教师id',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户注册时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `ibt_admin` */

insert  into `ibt_admin`(`id`,`username`,`password_hash`,`is_delete`,`auth_key`,`password_reset_token`,`teacher_id`,`create_time`) values (1,'黄中山','$2y$13$UacPCAF/ZxDo1FXN6W.6EO3zpg5uP3J8oktc1MLtOXSdnuE8yD58C',1,'wtVNs_kcuoihYnj92valSHy4et_jZgMg',NULL,5,1489402284),(2,'季飞','$2y$13$UacPCAF/ZxDo1FXN6W.6EO3zpg5uP3J8oktc1MLtOXSdnuE8yD58C',1,NULL,NULL,6,1489402285);

/*Table structure for table `ibt_answer` */

DROP TABLE IF EXISTS `ibt_answer`;

CREATE TABLE `ibt_answer` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '答案ID',
  `sub_id` tinyint(3) unsigned NOT NULL COMMENT '所属学科',
  `ques_id` mediumint(8) unsigned NOT NULL COMMENT '问题ID',
  `teacher_id` tinyint(3) unsigned DEFAULT '1' COMMENT '问题解答者ID',
  `answer_des` text NOT NULL COMMENT '问题解决方式',
  `translate_error` text COMMENT '错误提示翻译',
  `video_id` varchar(100) DEFAULT NULL COMMENT '解答错误的视频ID',
  `is_show` tinyint(3) unsigned DEFAULT '1' COMMENT '状态,1关闭,2显示',
  `add_time` int(10) unsigned NOT NULL COMMENT '问题添加时间',
  `edit_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '问题编辑时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ques_id` (`ques_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `ibt_answer` */

insert  into `ibt_answer`(`id`,`sub_id`,`ques_id`,`teacher_id`,`answer_des`,`translate_error`,`video_id`,`is_show`,`add_time`,`edit_time`) values (1,1,1,1,'ui问题的答案 ps在创建新图层遇见的问题',NULL,'XMjUyOTkzOTcyNA==',2,0,'2017-01-13 13:14:55'),(2,2,2,3,'web问题的答案js面向对象',NULL,'XMjUyOTkzOTcyNA==',2,0,'2017-01-13 13:14:55'),(3,3,5,5,'1.问题分析：\r\n  由于php没有开启curl扩展造成的\r\n2.解决步骤：\r\n2.1. phpinfo()查看php有没有开启扩展\r\n2.2. 按照步骤开启php扩展','调用未定义的函数 curl_init()','XMjUyOTkzOTcyNA==',2,0,'2017-01-13 13:14:55'),(4,4,4,7,'java问题 前段框架使用',NULL,'XMjUyOTkzOTcyNA==',2,0,'2017-01-13 13:14:55'),(5,3,6,1,'java问题 前段框架使用',NULL,'XMjUyOTkzOTcyNA==',2,0,'2017-01-13 13:14:55'),(6,3,10,1,'因为我们多引入了一个jquery文件，yii本身会自动加载jquery文件，\r\n再加载一遍的话会引起jquery的冲突就会报 ： \r\nTypeError: jQuery(...).yiiActiveForm is not a function 的错误','yiiActiveForm函数未定义','XMjUyOTkzOTcyNA==',2,0,'2017-02-23 18:02:45');

/*Table structure for table `ibt_auth_assignment` */

DROP TABLE IF EXISTS `ibt_auth_assignment`;

CREATE TABLE `ibt_auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `ibt_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `ibt_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ibt_auth_assignment` */

insert  into `ibt_auth_assignment`(`item_name`,`user_id`,`created_at`) values ('supermember','1',1489977566);

/*Table structure for table `ibt_auth_item` */

DROP TABLE IF EXISTS `ibt_auth_item`;

CREATE TABLE `ibt_auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `ibt_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `ibt_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ibt_auth_item` */

insert  into `ibt_auth_item`(`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) values ('back-answer/add',2,'添加回答',NULL,NULL,NULL,NULL),('back-answer/edit',2,'编辑回答',NULL,NULL,NULL,NULL),('back-answer/editshow',2,'回答是否显示',NULL,NULL,NULL,NULL),('back-answer/index',2,'所有回答',NULL,NULL,NULL,NULL),('back-menu/add',2,'添加菜单',NULL,NULL,NULL,NULL),('back-menu/delete',2,'删除菜单',NULL,NULL,NULL,NULL),('back-menu/edit',2,'编辑菜单',NULL,NULL,NULL,NULL),('back-menu/index',2,'所有菜单',NULL,NULL,NULL,NULL),('back-permission/add',2,'添加权限',NULL,NULL,NULL,NULL),('back-permission/delete',2,'删除权限',NULL,NULL,NULL,NULL),('back-permission/index',2,'所有权限',NULL,NULL,NULL,NULL),('back-question/add',2,'添加问题',NULL,NULL,1489733099,1489733099),('back-question/audit-question',2,'审核问题',NULL,NULL,1489733428,1489733428),('back-question/detail',2,'问题详情页',NULL,NULL,1489733508,1489733508),('back-question/edit',2,'编辑问题',NULL,NULL,NULL,NULL),('back-question/editshow',2,'问题是否显示',NULL,NULL,1489733633,1489733633),('back-question/index',2,'所有问题',NULL,NULL,1489732845,1489732845),('back-question/noaudit',2,'未审核的问题',NULL,NULL,1489733034,1489733034),('back-role/add',2,'添加角色',NULL,NULL,NULL,NULL),('back-role/delete',2,'删除角色',NULL,NULL,NULL,NULL),('back-role/edit',2,'编辑角色',NULL,NULL,NULL,NULL),('back-role/index',2,'所有角色',NULL,NULL,NULL,NULL),('back-teacher/add',2,'添加教师',NULL,NULL,NULL,NULL),('back-teacher/edit',2,'编辑教师信息',NULL,NULL,NULL,NULL),('back-teacher/edit-status',2,'编辑教师在职状态',NULL,NULL,NULL,NULL),('back-teacher/index',2,'所有教师',NULL,NULL,NULL,NULL),('back/index',2,'后台首页',NULL,NULL,1489732740,1489732740),('member',1,'普通管理员',NULL,NULL,1489895333,1489895333),('quesmember',1,'问题管理员',NULL,NULL,1489895179,1489895179),('supermember',1,'超级管理员',NULL,NULL,1489735035,1489737269);

/*Table structure for table `ibt_auth_item_child` */

DROP TABLE IF EXISTS `ibt_auth_item_child`;

CREATE TABLE `ibt_auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `ibt_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `ibt_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ibt_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `ibt_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ibt_auth_item_child` */

insert  into `ibt_auth_item_child`(`parent`,`child`) values ('member','back-answer/index'),('quesmember','back-answer/index'),('member','back-menu/index'),('quesmember','back-menu/index'),('member','back-permission/index'),('quesmember','back-question/add'),('supermember','back-question/add'),('quesmember','back-question/audit-question'),('supermember','back-question/audit-question'),('supermember','back-question/detail'),('quesmember','back-question/edit'),('supermember','back-question/edit'),('quesmember','back-question/editshow'),('supermember','back-question/editshow'),('member','back-question/index'),('quesmember','back-question/index'),('supermember','back-question/index'),('quesmember','back-question/noaudit'),('supermember','back-question/noaudit'),('member','back-role/index'),('quesmember','back-role/index'),('member','back-teacher/index'),('member','back/index'),('quesmember','back/index'),('supermember','back/index');

/*Table structure for table `ibt_auth_rule` */

DROP TABLE IF EXISTS `ibt_auth_rule`;

CREATE TABLE `ibt_auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ibt_auth_rule` */

/*Table structure for table `ibt_carousel_figure` */

DROP TABLE IF EXISTS `ibt_carousel_figure`;

CREATE TABLE `ibt_carousel_figure` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img` char(200) DEFAULT NULL,
  `sort` tinyint(3) unsigned DEFAULT NULL COMMENT '图片排序',
  `is_show` tinyint(3) unsigned DEFAULT '0' COMMENT '0=>不显示,1=>显示',
  `type` tinyint(3) unsigned DEFAULT '1' COMMENT '1=>轮播图,2=>右侧广告图',
  `link` char(255) DEFAULT NULL,
  `add_time` int(10) unsigned NOT NULL COMMENT '图片添加时间',
  `edit_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '图片编辑时间',
  `describute` text COMMENT '轮播图片描述',
  `is_select` tinyint(3) unsigned DEFAULT '0' COMMENT '是否默认选中 0>不选中 1>选中',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `ibt_carousel_figure` */

insert  into `ibt_carousel_figure`(`id`,`img`,`sort`,`is_show`,`type`,`link`,`add_time`,`edit_time`,`describute`,`is_select`) values (1,'/images/carousel/carousel1.png',1,2,1,'home/index',0,'2017-01-12 14:24:52','这个轮播广告图片第一张',0),(2,'/images/carousel/carousel2.png',2,2,1,'home/index',0,'2017-01-12 14:24:52',NULL,0),(3,'/images/carousel/carousel3.png',3,2,1,'home/index',0,'2017-01-12 14:24:52',NULL,0),(5,'/images/carousel/carousel5.png',5,2,1,'home/index',0,'2017-01-12 14:24:52',NULL,1),(4,'/images/carousel/carousel4.png',4,2,1,'home/index',0,'2017-01-12 14:24:52',NULL,0),(6,'/images/carousel/rightsmall.png',0,2,2,'',0,'2017-01-12 14:24:52',NULL,0);

/*Table structure for table `ibt_course` */

DROP TABLE IF EXISTS `ibt_course`;

CREATE TABLE `ibt_course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '课程id',
  `sub_id` tinyint(3) unsigned NOT NULL COMMENT '所属学科',
  `teacher_id` tinyint(3) unsigned DEFAULT NULL COMMENT '教师ID',
  `status` tinyint(3) unsigned DEFAULT '0' COMMENT '0未审核1显示2关闭',
  `img` char(30) NOT NULL,
  `cour_name` char(20) NOT NULL COMMENT '课程名称',
  `describute` char(40) NOT NULL COMMENT '课程描述',
  `add_time` int(10) unsigned NOT NULL COMMENT '添加时间',
  `edit_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '编辑时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `ibt_course` */

insert  into `ibt_course`(`id`,`sub_id`,`teacher_id`,`status`,`img`,`cour_name`,`describute`,`add_time`,`edit_time`) values (1,3,2,5,'/images/course/1.jpg','HTML+CSS基础课程',' 8小时带领大家步步深入学习标签的基础知识，掌握各种样式的基本用法',0,'2017-01-14 16:37:51'),(2,3,2,5,'/images/course/2.jpg','JavaScript入门篇','做为一名Web攻城狮的必备技术，让您从糊涂到明白，快速认识JavaScript',0,'2017-01-14 16:37:51'),(3,3,2,5,'/images/course/3.jpg','PHP入门篇','3小时轻松帮您快速掌握PHP语言基础知识，为后续PHP进级课程学习打下基础',0,'2017-01-14 16:37:51'),(4,3,2,5,'/images/course/4.jpg','Android攻城狮的第一门课','想快速进入Android开发领域的程序猿的首选课程',0,'2017-01-14 16:37:51'),(5,3,2,5,'/images/course/1.jpg','PHP入门篇门课','3小时轻松帮您快速掌握PHP语言基础知识，为后续PHP进级课程学习打下基础',0,'2017-01-14 16:37:51'),(6,3,2,5,'/images/course/2.jpg','PHP入门篇','3小时轻松帮您快速掌握PHP语言基础知识，为后续PHP进级课程学习打下基础',0,'2017-01-14 16:37:51'),(7,3,2,5,'/images/course/4.jpg','JavaScript入门篇','做为一名Web攻城狮的必备技术，让您从糊涂到明白，快速认识JavaScript',0,'2017-01-14 16:37:51'),(8,3,2,5,'/images/course/1.jpg','HTML+CSS基础课程','做为一名Web攻城狮的必备技术，让您从糊涂到明白，快速认识JavaScript',0,'2017-01-14 16:37:51');

/*Table structure for table `ibt_menu` */

DROP TABLE IF EXISTS `ibt_menu`;

CREATE TABLE `ibt_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '菜单ID',
  `name` varchar(128) NOT NULL COMMENT '菜单姓名',
  `pid` int(10) unsigned DEFAULT NULL COMMENT '父级菜单ID',
  `route` varchar(50) DEFAULT NULL COMMENT '路由',
  `description` varchar(256) DEFAULT NULL COMMENT '描述',
  `icon` varchar(50) DEFAULT NULL COMMENT '菜单图标',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `route` (`route`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Data for the table `ibt_menu` */

insert  into `ibt_menu`(`id`,`name`,`pid`,`route`,`description`,`icon`) values (2,'主页',0,'/back/index','主页','fa-home'),(3,'问题管理',0,'\'\'','问题管理','fa-question-circle'),(4,'答案管理',0,'\'\'','答案管理','fa-thumbs-o-up'),(5,'知识聚焦',0,'\'\'','知识聚焦','fa-book'),(6,'教师信息',0,'/back-teacher/index','教师信息','fa-th-large'),(7,'权限管理',0,'\'\'','权限管理','fa-lock'),(8,'所有问题',3,'/back-question/index','所有问题',NULL),(9,'添加问题',3,'/back-question/add','添加问题',NULL),(10,'待审核问题',3,'/back-question/noaudit','待审核问题',NULL),(11,'所有解答',4,'/back-question/index','所有解答',NULL),(12,'添加解答',4,'/back-question/add','添加解答',NULL),(13,'权限',7,'/back-permission/index','权限',NULL),(14,'角色',7,'/back-role/index','角色',NULL),(15,'菜单',7,'/back-menu/index','菜单',NULL),(16,'用户',7,'back-admin/userindex','前台用户',''),(17,'管理员',7,'back-admin/index','后台管理员','');

/*Table structure for table `ibt_question` */

DROP TABLE IF EXISTS `ibt_question`;

CREATE TABLE `ibt_question` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '问题ID',
  `sub_id` tinyint(3) unsigned DEFAULT NULL COMMENT '问题所属学科',
  `user_id` int(10) unsigned NOT NULL COMMENT '用户id',
  `ques_title` char(50) NOT NULL COMMENT '问题概要',
  `is_show` tinyint(4) NOT NULL DEFAULT '2' COMMENT '问题的关闭状态',
  `status` tinyint(3) unsigned DEFAULT '1' COMMENT '状态,1未审核通过,2,审核通过,3未解决,4已解决',
  `img` varchar(100) DEFAULT NULL COMMENT '问题图片地址',
  `content` text NOT NULL COMMENT '提问的内容',
  `add_time` int(10) unsigned NOT NULL COMMENT '问题添加时间',
  `edit_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '问题编辑时间',
  `teacher_id` int(10) unsigned DEFAULT NULL COMMENT '教师的id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Data for the table `ibt_question` */

insert  into `ibt_question`(`id`,`sub_id`,`user_id`,`ques_title`,`is_show`,`status`,`img`,`content`,`add_time`,`edit_time`,`teacher_id`) values (21,3,0,'html实现上传多张图片,以及demo？',2,3,NULL,'<p>没有报错信息</p>',1490499964,'2017-03-26 11:46:04',NULL),(20,3,0,'解释php预定义变量的应用场景和解释',2,3,NULL,'<p>没有错误提示</p>',1490499845,'2017-03-26 11:44:05',NULL),(18,3,0,'分布式配置文件.htacces的用途',2,3,NULL,'<p>分布式配置文件.htacces的用途</p>',1490499675,'2017-03-26 11:41:15',NULL),(19,3,0,'php框架的单一入口解释',2,3,NULL,'<p><span style=\"font-family:Calibri\">index.php</span><span style=\"font-family: SimSun\">单一入口文件没有理解透</span></p>',1490499769,'2017-03-26 11:42:49',NULL),(17,3,0,'定界符的使用场景是什么?',2,3,'http://oml69zlsx.bkt.clouddn.com/5e40ce1809bd724ef50a1964951a2b6a.jpg','<p><strong style=\"font-family: Simsun; font-size: medium; white-space: normal;\">Parse error</strong><span style=\"font-family: Simsun; font-size: medium;\">: syntax error, unexpected &#39;&#39; (T_ENCAPSED_AND_WHITESPACE), expecting identifier (T_STRING) or variable (T_VARIABLE) or number (T_NUM_STRING) in&nbsp;</span><strong style=\"font-family: Simsun; font-size: medium; white-space: normal;\">E:\\project\\bease\\blogsSystems\\admin\\deleteArticle.php</strong><span style=\"font-family: Simsun; font-size: medium;\">&nbsp;on line&nbsp;</span><strong style=\"font-family: Simsun; font-size: medium; white-space: normal;\">6</strong></p><p><strong style=\"font-family: Simsun; font-size: medium; white-space: normal;\"><br/></strong></p>',1490499565,'2017-03-26 11:39:25',NULL),(16,3,0,'使用绝对路径和相对路径的区别',2,3,'http://oml69zlsx.bkt.clouddn.com/f04b92bb2476c96720e135bf06c60e72.jpg','<p><strong style=\"font-family: Simsun; font-size: medium; white-space: normal;\">Warning</strong><span style=\"font-family: Simsun; font-size: medium;\">: require(../conn.php): failed to open stream: No such file or directory in&nbsp;</span><strong style=\"font-family: Simsun; font-size: medium; white-space: normal;\">E:\\project\\error\\test.php</strong><span style=\"font-family: Simsun; font-size: medium;\">&nbsp;on line&nbsp;</span><strong style=\"font-family: Simsun; font-size: medium; white-space: normal;\">2</strong><br/><strong style=\"font-family: Simsun; font-size: medium; white-space: normal;\">Fatal error</strong><span style=\"font-family: Simsun; font-size: medium;\">: require(): Failed opening required &#39;../conn.php&#39; (include_path=&#39;.;C:\\php\\pear&#39;) in&nbsp;</span><strong style=\"font-family: Simsun; font-size: medium; white-space: normal;\">E:\\project\\error\\test.php</strong><span style=\"font-family: Simsun; font-size: medium;\">&nbsp;on line&nbsp;</span><strong style=\"font-family: Simsun; font-size: medium; white-space: normal;\">2</strong></p>',1490499164,'2017-03-26 11:32:44',NULL),(22,3,0,'实现重定向，客服端执行跳转和服务器端执行跳转的区别是什么？  \r\n头缓存和代码缓存是什么意思？',2,3,NULL,'<p>没有错误提示</p>',1490500089,'2017-03-26 11:48:09',NULL),(23,3,0,'怎样实现自动加载类的功能，包括有命名空间的',2,3,NULL,'<p>没有错误提示</p>',1490500428,'2017-03-26 11:53:48',NULL),(24,3,0,'php脚本执行内存的限制',2,3,NULL,'<p>没有错误提示</p>',1490500669,'2017-03-26 11:57:49',NULL),(25,3,7,'Phpstorm中设置连接FTP，并快速进行文件比较，上传下载，同步等操作',2,3,'http://oml69zlsx.bkt.clouddn.com/d42452194203429e9a2f64b91a5c1bcd.jpg','没有错误提示',1490510356,'2017-03-26 14:39:16',NULL);

/*Table structure for table `ibt_subject` */

DROP TABLE IF EXISTS `ibt_subject`;

CREATE TABLE `ibt_subject` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '学科ID',
  `sub_name` char(20) NOT NULL COMMENT '学科名称',
  `is_close` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1开启,2关闭',
  `describute` text COMMENT '学科描述',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sub_name` (`sub_name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `ibt_subject` */

insert  into `ibt_subject`(`id`,`sub_name`,`is_close`,`describute`) values (1,'UI',1,NULL),(2,'WEB',1,NULL),(3,'PHP',1,NULL),(4,'JAVA',1,NULL);

/*Table structure for table `ibt_teachers` */

DROP TABLE IF EXISTS `ibt_teachers`;

CREATE TABLE `ibt_teachers` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '教师ID',
  `sub_id` tinyint(3) unsigned NOT NULL COMMENT '所属学科',
  `real_name` char(20) NOT NULL COMMENT '教师名字',
  `alias_name` char(20) NOT NULL COMMENT '昵称',
  `tel` char(11) NOT NULL DEFAULT '18111251826',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1男,2女',
  `is_delete` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1在职2离职',
  `add_time` int(10) unsigned NOT NULL COMMENT '问题添加时间',
  `edit_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '问题编辑时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `ibt_teachers` */

insert  into `ibt_teachers`(`id`,`sub_id`,`real_name`,`alias_name`,`tel`,`sex`,`is_delete`,`add_time`,`edit_time`) values (1,1,'叶飞','叶飞','18111251826',1,1,0,'2017-01-13 12:52:06'),(2,1,'王兮玥','王兮玥','18111251826',1,1,0,'2017-01-13 12:52:06'),(3,2,'郑羽','郑羽','18111251826',1,1,0,'2017-01-13 13:07:50'),(4,3,'侯忠建','侯忠建','18111251826',1,1,0,'2017-01-13 13:08:48'),(5,3,'黄中山','yellow_mediu_three','18111251826',1,1,0,'2017-01-13 13:09:51'),(6,3,'许坤','四哥','18111251826',1,1,0,'2017-01-13 13:10:27'),(7,4,'赵毅','赵毅','18111251826',1,1,0,'2017-01-13 13:10:52'),(8,4,'蓝声强','蓝声强','18111251826',1,1,0,'2017-01-13 13:11:53'),(9,2,'dagdcg','dagdcg','18111251826',1,1,1489123026,'2017-03-10 13:17:06');

/*Table structure for table `ibt_user` */

DROP TABLE IF EXISTS `ibt_user`;

CREATE TABLE `ibt_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `sub_id` char(10) NOT NULL DEFAULT '' COMMENT '你感兴趣的学科',
  `username` char(10) NOT NULL DEFAULT '2' COMMENT '用户名',
  `password` char(32) NOT NULL COMMENT '密码',
  `salt` char(5) NOT NULL,
  `sex` tinyint(4) NOT NULL DEFAULT '1' COMMENT '性别',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `is_forbid` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '1允许提问，2禁止提问',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `ibt_user` */

insert  into `ibt_user`(`id`,`sub_id`,`username`,`password`,`salt`,`sex`,`email`,`is_forbid`,`create_time`) values (7,'2','小李','bef2af59971b16f24eca23ccd41f519d','BOBHF',2,'4325646@qq.com',1,0),(6,'2','李林桐','0984c684ef01b4aef5aa8a48ebfd9adb','ibugt',2,'1243@163.com',2,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
