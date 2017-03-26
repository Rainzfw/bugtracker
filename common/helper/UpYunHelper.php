<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/13
 * Time: 11:51
 * 此类应该是利用 又拍云的空间实现云上传
 * 现在暂时保存在当前服务器的本地文件上
 */
namespace common\helper;
use crazyfd\qiniu\Qiniu;
class UpYunHelper extends BaseUploadHelper
{

    /*
     * @param  string $name 上传文件属性名
     * @return boolean
     */
    private $qiniu = null;
    public function __construct(){
        $settings = \Yii::$app->params['qiniuyun'];
        //创建七牛云对象
        $this->qiniu = new Qiniu($settings['ak'], $settings['sk'],$settings['domain'], $settings['bucket']);
    }
    //处理传递过来文件名称
    public function handleFiles($files,$imageName){
        $data = [];
        foreach($files as $k => $v){
            $data[$k] = $v[$imageName];
        }
        return $data;
    }
    public function uploadOne($data){
        //判断文件是否超过预期的大小
        if($data['error']){
            $this->error='上传图片失败';
            return false;
        }
        //判断文件的大小
        if($data['size']>\Yii::$app->params['upload_image_limit']['max_size']){
            $this->error='图片大小最好在1M以内!';
            return false;
        }
        //判断文件上传的类型
        if(!in_array($data['type'],\Yii::$app->params['upload_image_limit']['allow_types'])){
            $this->error='上传的图片格式不正确!';
            return false;
        }
        //判断文件是否为上传文件
        if(!is_uploaded_file($data['tmp_name'])){
            $this->error='不是上传文件!';
            return false;
        }
        //获取创建文件名
        $key = $this->createFileName().$this->getFileExt($data['name']);
        $this->qiniu->uploadFile($data['tmp_name'],$key);
        return $this->qiniu->getLink($key);
    }
    //删除指定资源
    public function delete($key){
        return $this->qiniu->delete($key);
    }
}