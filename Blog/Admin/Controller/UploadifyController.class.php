<?php
namespace Admin\Controller;
use Think\Controller;

// uploadify 头像上传
use Think\Upload;
use Vendor\ThinkImage\ThinkImage;

//头像
class UploadifyController extends Controller {
	//上传头像
    public function uploadImg(){
        // $upload = new Upload(C('UPLOAD_CONFIG'));   // 实例化上传类

        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Upload/avatar/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        $upload->saveName  =     'temp'; //上传文件命名规则

        $upload->autoSub       =  false; //自动子目录保存文件
        $upload->subName       =  array('date', 'Y-m-d'); //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        $upload->saveExt      =  'jpg'; //文件保存后缀，空则使用原后缀
        $upload->replace       =  true; //存在同名是否覆盖
        $upload->hash          =  true; //是否生成hash编码
        $upload->callback      =  false; //检测文件是否存在回调，如果存在返回文件信息数组
        $upload->driver        =  'Local'; // 文件上传驱动
        $upload->driverConfig  =  array(); // 上传驱动配置

        //头像目录地址
        $path = './Upload/avatar/';

        // 上传文件 
        $info   =   $upload->upload();        

        if(!$info) {                        // 上传错误提示错误信息
            $this->ajaxReturn(array('status'=>0,'info'=>$upload->getErrorMsg()));
        }else{                                          // 上传成功 获取上传文件信息
            $temp_size = getimagesize($path.'temp.jpg');

            $this->ajaxReturn(array('status'=>1,'path'=>__ROOT__.'/Upload/avatar/'.'temp.jpg'));
        }
    }

    //裁剪并保存用户头像
    public function cropImg(){
        //图片裁剪数据
        $params = I('post.');                       //裁剪参数
        if(!isset($params) && empty($params)){
            $this->ajaxReturn(false);
        }

        //头像目录地址
        $path = './Upload/avatar/';
        //要保存的图片
        $real_path = $path.'avatar.jpg';
        //临时图片地址
        $pic_path = $path.'temp.jpg';
        //实例化裁剪类
        $Think_img = new ThinkImage(THINKIMAGE_GD);
        //裁剪原图得到选中区域
        $Think_img->open($pic_path)->crop($params['w'],$params['h'],$params['x'],$params['y'])->save($real_path);
        //生成缩略图
        $Think_img->open($real_path)->thumb(100,100, 1)->save($path.'avatar_100.jpg');
        $Think_img->open($real_path)->thumb(60,60, 1)->save($path.'avatar_60.jpg');
        $Think_img->open($real_path)->thumb(30,30, 1)->save($path.'avatar_30.jpg');
        $this->ajaxReturn(true);
    }

    //多张图片添加
    public function pictureAddMore(){
        $picture=M('Picture');

        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Upload/picture/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        // $upload->saveName  =     'temp'; //上传文件命名规则

        $upload->autoSub       =  false; //自动子目录保存文件
        // $upload->subName       =  array('date', 'Y-m-d'); //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
        // $upload->saveExt      =  'jpg'; //文件保存后缀，空则使用原后缀
        // $upload->replace       =  true; //存在同名是否覆盖
        // $upload->hash          =  true; //是否生成hash编码
        // $upload->callback      =  false; //检测文件是否存在回调，如果存在返回文件信息数组
        // $upload->driver        =  'Local'; // 文件上传驱动
        // $upload->driverConfig  =  array(); // 上传驱动配置
        //头像目录地址
        // $path = './Upload/avatar/';

        // 上传文件 
        $info   =   $upload->upload();

        if($info){
            $data['picture_pic']="/Upload/picture/".$info['Filedata']['savename'];
            $data['picture_datetime']=date('Y-m-d H:i:s');
            $data['picture_photo']=$_POST['picture_photo'];
        }
        $picture->add($data);
    }
}
