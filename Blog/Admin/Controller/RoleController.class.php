<?php

namespace Admin\Controller;
use Admin\Controller\CommonController;

//角色控制器
class RoleController extends CommonController{
    //显示角色列表
    public function roleList(){
        $role=M('Role');
        $info = $role->select();
        $this -> assign('info',$info);
        $this -> display();
    }

    //添加角色
    public function roleAdd(){
        if(!empty($_POST)){
            $role=M('Role');
            $role->create();
            $z=$role->add();
            if($z){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            $this->display();
        }
    }
    //角色修改
    public function roleUpdate($id=""){
        $role=M('Role');
        if(!empty($_POST)){ 
            $id=$_POST['role_id']; //后面修改失败跳回

            if($id=='1'){
                $this->ajaxReturn(false);
            }else{
                $role->create();
                $z=$role->save();
                if($z){
                    $this->ajaxReturn(true);
                }else{
                    $this->ajaxReturn(false);
                }
            }
        }else{
            $info=$role->find($id);
            $this->assign('info',$info);

            $this->display();
        }
    }
    //进行权限分配
    public function authDistribute($id=""){
        if(!empty($_POST)){
            //把权限id信息有数组变为中间用逗号的分隔的字符串信息

            $id=$_POST['role_id'];
            $auth_ids = implode(',',$_POST['auth_name']);
            $auth=M('Auth');
            //根据ids权限id信息查询具体操作方法信息
            $info = $auth->select($auth_ids);//二维数组信息
            
            //拼装控制器和操作方法
            $auth_ac = '';
            foreach($info as $k => $v){
                if(!empty($v['auth_c']) && !empty($v['auth_a'])){
                    $auth_ac .= $v['auth_c']."-".$v['auth_a'].",";
                }
            }
            $auth_ac = rtrim($auth_ac,',');//删除最右边的逗号
            
            $dt = array(
                'role_id'=>$id,
                'role_auth_ids'=>$auth_ids,
                'role_auth_ac'=>$auth_ac,
            );
            $role=M('Role');
            //saveAuth接收到一维数组信息
            $z = $role -> save($dt);
            if($z){
                $this->ajaxReturn(true);
            } else {
                $this->ajaxReturn(false);
            }
        } else {
            //根据$role_id查询对应的角色名字
            $role=M('Role');
            $rinfo = $role->find($id);
            $this->assign('role_id',$rinfo['role_id']);
            $this -> assign('role_name', $rinfo['role_name']);

            // 所有权限
            $auth=M('Auth');
            //排序输出列表
            $info=$auth->order('auth_path asc')->select();
            
            $this -> assign('info', $info);
            
            //把当前角色对应的权限信息给查询出来
            $auth_ids_arr = explode(',',$rinfo['role_auth_ids']); //数组auth_id 信息
            $this -> assign('auth_ids_arr', $auth_ids_arr); 

            $this -> display();
        }
    }
    //角色删除
    public function roleDelete($id=""){
        $role=M('Role');

        // 判断内部是否有内容
        $admin=M('Admin');
        $info=$admin
            ->where('role_id='.$id)
            ->find();
        
        if(!empty($info)){
            $this->ajaxReturn(false);
            exit();
        }

        if($id=='1'){
            $this->ajaxReturn(false);
        }else{
            $z=$role->delete($id);
            if($z){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }

    }
    // 角色选择删除
    public function roleDeleteAll(){
        $role=M('Role');
        $ID_Delete=implode(",", I('post.ID_Delete'));
        if(!$ID_Delete){
            $this->ajaxReturn(false);
            exit();
        }

        $ID_Delete1=$_POST['ID_Delete'];
        $flag=0;
        // 判断内部是否有内容
        for ($i=0; $i < count($ID_Delete1); $i++) { 
            $admin=M('Admin');
            $info=$admin
                ->where('role_id='.$ID_Delete1[$i])
                ->find();
            if(!empty($info)){
                $flag=1;
            }
        }
        if($flag==1){
            $this->ajaxReturn(false);
            exit();
        }

        if(in_array('1', I('post.ID_Delete'))){
            $this->ajaxReturn(false);
        }else{
            $z=$role->delete($ID_Delete);
            if($z){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }
    }

    /**
    * ajax 校验名称是否存在
    **/
    public function validateName(){
        $role=M('Role');
        $data['role_name']=$_POST['role_name'];
        $z=$role->where($data)->find();
        if(!empty($z)){
            $this->ajaxReturn(false);
        }else{
            $this->ajaxReturn(true);
        }
    }
    // 修改名称检验
    public function validateNameUpdate(){
        $role=M('Role');
        // 该名字是否是自己本身
        $info['role_id']=$_POST['role_id'];
        $info['role_name']=$_POST['role_name'];
        $j=$role->where($info)->find();
        if(!empty($j)){
            $this->ajaxReturn(true);
        }else{
            $data['role_name']=$_POST['role_name'];
            $z=$role->where($data)->find();
            if(!empty($z)){
                $this->ajaxReturn(false);
            }else{
                $this->ajaxReturn(true);
            }
        }
    }
}
