<?php
namespace Admin\Controller;
use Admin\Common;
use Admin\Controller\CommonController;

class AboutController extends CommonController {
	//关于我信息
    public function about(){
    	$about=M('About');
        $info=$about->select();
        $info[0]['about_content']=htmlspecialchars_decode($info[0]['about_content']);
    	$this->assign('info',$info[0]);

	   	$this->display();
    }
    //关于我修改
    public function aboutUpdate(){
    	$about=M('About');
    	$info=$about->create();
        $z=$about->save($info);
        if($z){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    } 
}