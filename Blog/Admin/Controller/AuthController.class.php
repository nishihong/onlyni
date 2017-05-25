<?php

namespace Admin\Controller;
// use Think\Controller;
use Admin\Controller\CommonController;

class AuthController extends CommonController{
    //权限列表
    public function authList(){
        $auth=M('Auth');
        //排序输出列表

        // 最高级
        $p_info=$auth->where('auth_level=0')->order('auth_rank')->select();
        // 次高级
        $s_info=$auth->where('auth_level=1')->order('auth_rank')->select();
        // 最低级
        $t_info=$auth->where('auth_level=2')->order('auth_rank')->select();

        //次级权限标识-->
        // foreach($info as $k => $v){
        //           // str_repeat()函数把字符串重复指定的次数。
        //           $info[$k]['auth_name'] = str_repeat(' ├─ ',$v['auth_level']).$info[$k]['auth_name'];
        //       }
        $this -> assign('pinfo', $p_info);
        $this -> assign('sinfo', $s_info);
        $this -> assign('tinfo', $t_info);

        $this -> display();
    }
    // 权限添加
    public function authAdd(){
        if(!empty($_POST)){
            //$auth里边存在4个信息，还缺少两个关键信息：auth_path和auth_level
            //① insert生成一个新记录
            //② update把path和leve更新进去
            $auth=M('Auth');
            $new_id = $auth -> add($_POST);  //返回新记录的主键id值
            
            //path的值分为两种情况
            //全路径：父级全路径与本身id的连接信息
            //① 当前权限是顶级权限，path=$new_id
            //② 当前权限是非顶级权限，path=父级全路径+$new_id
            if($_POST['auth_pid'] == 0){
                $auth_path = $new_id;
            } else {
                //查询指定父级的全路径,条件：$auth['auth_pid']
                $pinfo = $auth -> find($_POST['auth_pid']); //查询出父级的记录信息
                $p_path = $pinfo['auth_path']; //父级全路径
                $auth_path = $p_path."-".$new_id;
            }
            
            //auth_level数目：全路径里边中恒线的个数
            //      把全路径变为数组，计算数组的个数和减去-1，就是level的信息
            $auth_level = count(explode('-',$auth_path))-1;
            
            $dt = array(
                'auth_id' => $new_id,
                'auth_path'=>$auth_path,
                'auth_level'=>$auth_level,
            );
            $z=$auth->save($dt);
            if($z){
                // $this -> success('添加权限成功！',U('authAdd'));
                $this->ajaxReturn(true);
            }else {
                // $this -> error('添加权限失败！',U('authAdd'));
                $this->ajaxReturn(false);
            }
        }else{      
            //获得父级权限信息
            $auth=M('Auth');
            // 第二层以下的
            // $info=$auth->where('auth_level<2')->order('auth_path asc')->select();
            // 全部的
            $info=$auth->order('auth_path asc')->select();
            //次级权限标识-->
            foreach($info as $k => $v){
                $info[$k]['auth_name'] = str_repeat('├─ ',$v['auth_level']).$info[$k]['auth_name'];
            }
            $this->assign('authInfo',$info);
            // var_dump($info); 
            $this->display();       
        }
    }
    //权限修改
    public function authUpdate($id=""){
        // echo $id."hehe";
        $auth=M('Auth');
        if(!empty($_POST)){
            $id=$_POST['auth_id'];
            $auth->create();
            $z=$auth->save();
            if($z){
                $this->ajaxReturn(true);
            }else{
                $this->ajaxReturn(false);
            }
        }else{
            $info=$auth->find($id);
            $this->assign('info',$info);

            // 暂时不要修改父级---------------------
            // 权限信息
            // $info=$auth->order('auth_path asc')->select();
            // // 次级权限标识
            // foreach($info as $k=>$v){
            //     $info[$k]['auth_name']=str_repeat('├─ ', $v['auth_level']).$info[$k]['auth_name'];
            // }
            // $this->assign('authInfo',$info);

            $this->display();
        }
    }
    //权限删除
    public function authDelete($id=""){
        $auth=M('Auth');
        $z=$auth->delete($id);
        if($z){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
    // 权限选择删除
    public function authDeleteAll(){
        $auth=M('Auth');
        $ID_Delete=implode(",", I('post.ID_Delete'));
        if(!$ID_Delete){
            $this->ajaxReturn(false);
            exit();
        }
        $z=$auth->delete($ID_Delete);
        if($z){
            $this->ajaxReturn(true);
        }else{
            $this->ajaxReturn(false);
        }
    }
}