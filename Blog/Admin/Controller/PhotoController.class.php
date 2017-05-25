<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;

class PhotoController extends CommonController {
    //相册列表
    public function photoList(){
        $photo=M('Photo');

        $info=$photo
                ->field('photo_id,photo_name,photo_pic')
                ->select();
        $this->assign('info',$info);

        $this->display();
    }
    //相册添加
    public function photoAdd(){
        if(!empty($_POST)){
            $photo=M('Photo');
            $data=$photo->create();

            // 图片上传
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     'Upload/photo/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            $upload->autoSub       =  false; //自动子目录保存文件
            // 上传文件 
            $info   =   $upload->upload();

            if($info){
                $data['photo_pic']="/Upload/photo/".$info['photo_pic']['savename'];
            }

            $z=$photo->add($data);
            if($z){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            $this->display();
        }
    }
    //相册修改
    public function photoUpdate($id=""){
        $photo=M('Photo');
        if(!empty($_POST)){
            $data=$photo->create();

            // 图片上传
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     'Upload/photo/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            $upload->autoSub       =  false; //自动子目录保存文件
            // 上传文件 
            $info   =   $upload->upload();

            if($info){
                $data['photo_pic']="/Upload/photo/".$info['photo_pic']['savename'];

                // 删除原图片文件
                $file = $_POST['delete_pic'];
                $file = substr($file,1);
                unlink($file);
            }else{
                unset($data['photo_pic']);
            }

            $z=$photo->save($data);
            if($z){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            $info=$photo->find($id);
            $this->assign('info',$info);

            $this->display();
        }
    }
    //相册删除
    public function photoDelete($id=""){
        $photo=M('Photo');

        // 判断内部是否有内容
        $picture=M('Picture');
        $info=$picture
            ->where('picture_photo='.$id)
            ->find();
        if(!empty($info)){
            $this->ajaxReturn(false);
            exit();
        }

        // 删除原图片文件
        $info=$photo->field('photo_pic')->find($id);
        $file = $info['photo_pic'];
        $file = substr($file,1);
        unlink($file);

        $z=$photo->delete($id);
        if($z){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    // 相册批量删除
    public function photoDeleteAll(){
        $photo=M('Photo');
        $ID_Delete=implode(",", I('post.ID_Delete')); 

        // 判断内部是否有内容
        $ID_Delete1=$_POST['ID_Delete'];
        $flag=0;
        for ($i=0; $i < count($ID_Delete1); $i++) { 
            $picture=M('Picture');
            $info=$picture
                ->where('picture_photo='.$ID_Delete1[$i])
                ->find();
            if(!empty($info)){
                $flag=1;
            }
        }
        if($flag==1){
            $this->ajaxReturn(false);
            exit();
        }

        // 删除原图片文件
        $ID_Delete1=I('post.ID_Delete');
        for ($i=0; $i < count($ID_Delete1) ; $i++) {
            $info=$photo->field('photo_pic')->find($ID_Delete1[$i]);
            $file = $info['photo_pic'];
            $file = substr($file,1);
            unlink($file);
        }

        $z=$photo->delete($ID_Delete);
        if($z){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }

    /**
    * ajax 校验名称是否存在
    **/
    public function validateName(){
        $photo=M('Photo');
        $data['photo_name']=$_POST['photo_name'];
        $z=$photo->where($data)->find();

        if(!empty($z)){
            $this->ajaxReturn(false);
        }else{
            $this->ajaxReturn(true);
        }
    }
    // 修改名称检验
    public function validateNameUpdate(){
        $photo=M('Photo');
        // 该名字是否是自己本身
        $info['photo_id']=$_POST['photo_id'];
        $info['photo_name']=$_POST['photo_name'];
        $j=$photo->where($info)->find();
        if(!empty($j)){
            $this->ajaxReturn(true);
        }else{
            $data['photo_name']=$_POST['photo_name'];
            $z=$photo->where($data)->find();

            if(!empty($z)){
                $this->ajaxReturn(false);
            }else{
                $this->ajaxReturn(true);
            }
        }
    }
}