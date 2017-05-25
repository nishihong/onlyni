<?php
namespace Admin\Controller;
use Admin\Common;
// use Think\Controller;
use Admin\Controller\CommonController;


class ConfigController extends CommonController {
	// 配置管理
	public function configList(){
		$config=M('Config');
	    $info=$config->select();
	    $this->assign('info',$info[0]);

		$this->display();
	}
	// 配置管理修改
	public function configUpdate(){

	    // 信息修改
	    $config=M('Config');
	    $data=$config->create();
	    
	    $z=$config->save($data);

	    if($z) {// 上传错误提示错误信息
	        $this->ajaxReturn(true);
	    }else{// 上传成功
	        $this->ajaxReturn(false);
	    }
	}
	// 清除缓存
	public function clearCache() { 
           
		delFileByDir(APP_PATH.'Runtime/');
		$this->success('删除缓存成功！',U('index/index'));
	}
}