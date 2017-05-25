<?php
namespace Admin\Controller;
// use Admin\Common;
// use Think\Controller;

use Admin\Controller\CommonController;

class PersonalController extends CommonController {
    //个人信息
    public function personal(){
        $admin=M('Admin');
        $info=$admin->join('ni_role ON ni_admin.role_id = ni_role.role_id')->find($_SESSION['adminId']);
        $this->assign('admin',$info);
        $this->display();
    }
	//更新个人信息
    public function personalInfo(){
        $admin=M('Admin');
        if(!empty($_POST)){
            $admin->create();//收集表单数据
            
            $info=$admin->save();
            if($info){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            $data['admin_id']=$_SESSION['adminId'];
            $info=$admin->where($data)->find();
            $this->assign('admin',$info);
            $this->display();
        }
    }
    //更新个人头像
    public function personalAvatar(){
        $this->display();
    }
    //个人密码信息
    public function personalPwd(){
        $admin=M('Admin');
       
        $data['admin_id']=$_SESSION['adminId'];
        $info=$admin->where($data)->find();
        $this->assign('admin',$info);
        $this->display();
    }

    //更新个人密码
    public function personalPwdUpdate(){
        
        $admin=M('Admin');
        $info=$admin->find($_POST['admin_id']);
        
        if($info['admin_pwd']!==md5($_POST['admin_pwd'])){
            $this->ajaxReturn(false);
        }else{  
            $data['admin_id']=$_POST['admin_id'];
            $data['admin_pwd']=md5($_POST['admin_new_pwd']);
            $z=$admin->save($data);
            if($z){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }
    }
}