<?php

namespace Admin\Controller;
// use Think\Controller;
use Admin\Common;
use Admin\Controller\CommonController;

class ManagerController extends CommonController{
	//管理员列表
	public function managerList(){
		$admin=M('Admin');

		//分页
		$total=$admin
				->alias('a')
				->join('left join ni_role r on a.role_id=r.role_id')
				->count();

		$per=10;
		$page=new Common\Page($total,$per);

		$info=$admin
				->alias('a')
				->field('a.admin_id,a.admin_account,a.admin_name,a.last_login_time,a.admin_status,r.role_name')
				->join('left join ni_role r on a.role_id=r.role_id')
				->limit($page->limit)
				->select();

		$this->assign('info',$info);

		$pagelist=$page->fpage();
		$this->assign('pagelist',$pagelist);

		//角色信息
		$role=M('Role');
		$info=$role->select();
		$this->assign('roleInfo',$info); 

		$this->display();
	}

	//管理员添加
	public function managerAdd(){
		if(!empty($_POST)){
			$admin=M('Admin');
			
				$data=$admin->create();
				$data['admin_pwd']=md5($data['admin_pwd']);
				// 设置地区
				date_default_timezone_set("Asia/Shanghai");
				$data['last_login_time']=date("Y-m-d H:i:s");

				$z=$admin->add($data);
				if($z){
					$this->ajaxReturn(true);
				}else{
					$this->ajaxReturn(false);
				}
		}else{
			//获取角色表信息
			$role=M('Role');
			$roleInfo=$role->select();
			$this->assign('roleInfo',$roleInfo);
			$this->display();
		}
	}

	//管理员信息修改
	public function managerUpdate($id=""){
		$admin=M('Admin');
		if(!empty($_POST)){
			if($_POST['admin_id']=='1'){
				$this->ajaxReturn(false);
			}else{
				$admin->create();
				$z=$admin->save();
				if($z){
					$this->ajaxReturn(true);
				}else{
					$this->ajaxReturn(false);
				}
			}
		}else{
			//获得被修改管理员的信息
			$info=$admin->join('left join ni_role ON ni_admin.role_id = ni_role.role_id')->find($id);
			$this->assign('info',$info);

			//获取角色表信息
			$role=M('Role');
			$roleInfo=$role->select();
			$this->assign('roleInfo',$roleInfo);
			$this->display();
		}
	}
	//管理员密码修改
	public function managerUpdatePwd($id=""){
		if(!empty($_POST)){
			$admin=M('Admin');
			$data=$admin->create();
			$data['admin_pwd']=md5($data['admin_pwd']);
			$z=$admin->save($data);
			if($z){
				$this->ajaxReturn(true);
			}else{
				$this->ajaxReturn(false);
			}
		}else{
			//获得被修改管理员的信息
			$admin=M('Admin');
			$info=$admin->find($id);
			$this->assign('info',$info);

			$this->display();
		}
	}
	//管理员删除
    public function managerDelete($id=""){
    	if($id=='1'){
    		$this->ajaxReturn(false);
    	}else{
	    	$admin=M('Admin');
	    	$z=$admin->delete($id);
	    	if($z){
	    		$this->ajaxReturn(true);
	    	}else{
	    		$this->ajaxReturn(false);
	    	}
	    }	
    }
    // 管理员选择删除
    public function managerDeleteAll(){ 	
        $ID_Delete=implode(",", I('post.ID_Delete'));
        
        if(!$ID_Delete){
            $this->ajaxReturn(false);
            exit();
        }
        if(in_array('1', I('post.ID_Delete'))){
        	$this->ajaxReturn(false);
        }else{	
        	$admin=M('Admin');
	        $z=$admin->delete($ID_Delete);
	        if($z){
	            $this->ajaxReturn(true);
	        }else{
	            $this->ajaxReturn(false);
	        }
        }
    }
    //管理员角色查找
    public function managerQuery($id=""){
        if($id==0){
            $this->redirect('Manager/managerList');
        }else{
            $admin=M('Admin');

            $total=$admin
            		->alias('a')
            		->where('a.role_id='.$id)
            		->join('left join ni_role r on a.role_id=r.role_id')
            		->count();

            $per=10;
            $page=new Common\Page($total,$per);

            $info=$admin
            		->alias('a')
            		->field('a.admin_id,a.admin_account,a.admin_name,a.last_login_time,a.admin_status,r.role_name')
            		->where('a.role_id='.$id)
            		->join('left join ni_role r on a.role_id=r.role_id')
            		->limit($page->limit)
            		->select();

            $this->assign('info',$info);

            $pagelist=$page->fpage();
            $this->assign('pagelist',$pagelist);

            //角色信息
            $role=M('Role');
            $info=$role->select();
            $this->assign('roleInfo',$info); 

            $this->display('Manager/managerList');
        }
    }

    /**
    * ajax 校验帐号是否存在
    **/
    public function validateAccount(){
        $admin=M('Admin');
        $data['admin_account']=$_POST['admin_account'];
        $z=$admin->where($data)->find();
        if(!empty($z)){
            $this->ajaxReturn(false);
        }else{
            $this->ajaxReturn(true);
        }
    }
}