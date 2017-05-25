<?php
namespace Home\Controller;
use Home\Common;
// use Think\Controller;
use Home\Controller\CommonController;

class AboutController extends CommonController {
    public function about(){
    	$about=M('About');
    	$info=$about->select();
    	$info[0]['about_content']=htmlspecialchars_decode($info[0]['about_content']);
    	
    	$this->assign('info',$info[0]);
        $this->display();
    }
}