<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/13
 * Time: 11:53
 */

namespace common\Helper;


class BaseUploadHelper
{
    //错误信息
    protected $error='';
    //文件后缀名
    private $_extension;
    public $filePath='';
    public function __construct(){

    }
    /*获取文件路径
     * @param $name 文件属性名
     * @return string 返回文件保存的路径
     */
    protected function getFilePath($fileName){
        //获取上传图片的后缀
        $this->getFileExt($fileName);
        $this->filePath = $this->createPath();
        //获取上传文件的路径
        $this->filePath;
    }
    /*创建文件路径
     *@return string
     */
    private function createPath(){
        //判断文件路径是否存在
        if(!is_dir('./upload/')){
            mkdir('./upload/');
        }
        if(!is_dir('./upload/'.date('Ymd',time()))){
            mkdir('./upload/'.date('Ymd',time()));
        }
        return '/upload/'.date('Ymd', time()).'/'.$this->createFileName().$this->_extension;
    }
    /*创建文件名称
     * @return string
     */
    protected function createFileName(){
        return md5(time().rand(100000, 999999));
    }
    /* 获取文件名.
     * @param $file
     * @return string
     */
    protected function getFileExt($file)
    {
        $arr = explode('.', $file);
        $this->_extension = '.'.end($arr);
        return $this->_extension;
    }
    /*获取上传文件出错的信息
     *@return string
     */
    public function getErrors(){
        return $this->error;
    }
}