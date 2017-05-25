<?php

//用户登录判断模型model
namespace Admin\Model;
use Think\Model;

class AdminModel extends Model {
//实现表单项目验证
	//通过重写父类属性_validate 实现表单验证
	protected $_validate = array(
		//验证用户名  require必须填写项目
		array('admin_account', 'require', '帐号必须填写'),
		array('admin_pwd', 'require', '密码必须填写'),
		// //可以为同一个项目设置多个验证
		// array('admin_account', '4,12', '帐号不得小于4位，不得大于12位', 3, 'length'),
		// array('admin_password', '4,12', '密码不得小于4位，不得大于12位', 3, 'length'),
	); //自动验证定义
	// protected $autoCheckFields = false;

	//制作一个方法对用户名和密码进行校验
	public function checkAccountPwd($account, $pwd) {
		//echo "sb";
		//exit();
		$admin=D('Admin');
		$data['admin_account']=$account;
		$info = $admin->where($data)->find();
		//echo $login;
		// var_dump($info);
		// echo md5($pwd);
		// exit();
		//$info不为null，就可以继续验证密码

		if ($info != null) {
			// 判断管理员是否被禁用
			if($info['admin_status']=='1'){
				return '2';
			}else if ($info['admin_pwd'] != md5($pwd)) {
				//验证密码(查询出来的密码与用户输入的密码进行比较)
				return '1';
				// return $info;
			} else {
				return $info;
			}
		} else {
			return '1';
		}
	}
}