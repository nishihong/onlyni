<?php
namespace Admin\Controller;
use Admin\Common;
use Admin\Controller\CommonController;

class PictureController extends CommonController {
    //图片列表
    public function pictureList(){
        $picture=M('Picture');

        //分页
        $total=$picture->count();
        $per=10;
        $page=new Common\Page($total,$per);

        $info=$picture
                ->alias('pi')
                ->field('pi.picture_id,pi.picture_name,ph.photo_name,pi.picture_pic,pi.picture_datetime')
                ->join('left join ni_photo ph on pi.picture_photo=ph.photo_id')
                ->order('pi.picture_id desc')
                ->limit($page->limit)
                ->select();

        $this->assign('pictureInfo',$info);

        $pagelist=$page->fpage();
        $this->assign('pagelist',$pagelist);

        // 相册信息
        $photo=M('Photo');
        $info=$photo->select();

        $this->assign('photoInfo',$info); 

        $this->display();
    }
    //图片添加
    public function pictureAdd(){
        if(!empty($_POST)){
            $picture=M('Picture');
            $data=$picture->create();
            $data['picture_datetime']=date('Y-m-d H:i:s');

            // 图片上传
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     'Upload/picture/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            $upload->autoSub       =  false; //自动子目录保存文件

            // 上传文件 
            $info   =   $upload->upload();

            if($info){
                $data['picture_pic']="/Upload/picture/".$info['picture_pic']['savename'];
            }

            $z=$picture->add($data);
            if($z){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            //相册信息
            $photo=M('Photo');
            $info=$photo->select();

            $this->assign('photoInfo',$info);

            $this->display();
        }
    }

    //多张图片添加
    public function pictureAddMore(){
        //相册信息
        $photo=M('Photo');
        $info=$photo->select();

        $this->assign('photoInfo',$info);

        $this->display();
    }

    //图片修改
    public function pictureUpdate($id=""){
        $picture=M('Picture');
        if(!empty($_POST)){
            $data=$picture->create();

            // 图片上传
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     'Upload/picture/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            $upload->autoSub       =  false; //自动子目录保存文件
            // 上传文件 
            $info   =   $upload->upload();

            if($info){
                $data['picture_pic']="/Upload/picture/".$info['picture_pic']['savename'];

                // 删除原图片文件
                $file = $_POST['delete_pic'];
                $file = substr($file,1);
                unlink($file);
            }else{
                unset($data['picture_pic']);
            }

            $z=$picture->save($data);
            if($z){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            $info=$picture->find($id);
            $this->assign('info',$info);

            //相册信息
            $photo=M('Photo');
            $info=$photo->select();

            $this->assign('photoInfo',$info);

            $this->display();
        }
    }
    //相册查找
    public function pictureQuery($id=""){
        if($id==0){
            $this->redirect('Picture/pictureList');
        }else{
            $picture=M('Picture');

            $total=$picture
                    ->alias('p')
                    ->where('p.picture_photo='.$id)
                    ->count();

            $per=10;
            $page=new Common\Page($total,$per);

            $info=$picture
                ->alias('pi')
                ->field('pi.picture_id,pi.picture_name,ph.photo_name,pi.picture_pic,pi.picture_datetime')
                ->where('pi.picture_photo='.$id)
                ->join('left join ni_photo ph on pi.picture_photo=ph.photo_id')
                ->order('pi.picture_id desc')
                ->limit($page->limit)
                ->select();

            $this->assign('pictureInfo',$info);

            $pagelist=$page->fpage();
            $this->assign('pagelist',$pagelist);

            //相册信息
            $photo=M('Photo');
            $info=$photo->select();

            $this->assign('photoInfo',$info);

            $this->display('Picture/pictureList');
        }
    }
    //图片删除
    public function pictureDelete($id=""){
        $picture=M('Picture');
        // 删除原图片文件
        $info=$picture->field('picture_pic')->find($id);
        $file = $info['picture_pic'];
        $file = substr($file,1);
        unlink($file);

        $z=$picture->delete($id);
        if($z){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    // 图片批量删除
    public function pictureDeleteAll(){
        $picture=M('Picture');
        $ID_Delete=implode(",", I('post.ID_Delete')); 

        // 删除原图片文件
        $ID_Delete1=I('post.ID_Delete');
        for ($i=0; $i < count($ID_Delete1) ; $i++) {
            $info=$picture->field('picture_pic')->find($ID_Delete1[$i]);
            $file = $info['picture_pic'];
            $file = substr($file,1);
            unlink($file);
        }

        $z=$picture->delete($ID_Delete);
        if($z){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
}