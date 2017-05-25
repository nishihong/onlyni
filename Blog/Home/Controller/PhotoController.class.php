<?php
namespace Home\Controller;
use Home\Controller\CommonController;

class PhotoController extends CommonController {
    public function photo(){
        // 相册
        $photo=M('Photo');
        $photoInfo=$photo
                ->field('photo_id,photo_name,photo_pic')
                ->select();
        $this->assign('photoInfo',$photoInfo);

        $this->display();
    }
    public function picture($id=""){
        // 图片
        $picture=M('Picture');
        $pictureInfo=$picture
                ->field('picture_id,picture_name,picture_pic,photo_name')
                ->where('picture_photo='.$id)
                ->join('left join ni_photo on ni_picture.picture_photo=ni_photo.photo_id')
                ->select();
        $this->assign('pictureInfo',$pictureInfo);

        // 该图片是哪个相册的
        $photo=M('Photo');
        $status=$photo
                ->field('photo_name')
                ->find($id);
        $this->assign('status',$status['photo_name']);

        $this->display();
    }
}