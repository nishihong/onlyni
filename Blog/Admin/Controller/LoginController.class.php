<?php
namespace Admin\Controller;
use Admin\Model;
use Think\Controller;

class LoginController extends Controller {
    public function login(){
    	if(!empty($_SESSION['adminId'])){
    		$this->redirect('Index/index');
    	}
    	if (!empty($_POST)) {
			$admin = new Model\AdminModel();
			$z = $admin->create(); //收集（验证功能）  集成表单验证
			if (!$z) {
				$this->assign('error', $admin->getError());
			} else {
				if($_POST['config_save_code']=='0'){
					//验证码校验
					$verify = new \Think\Verify();
					if (!$verify->check($_POST['checkCode'])) {
						$this->assign('error', "验证码错误");
					}else {
						//判断用户名和密码，在model模型里面制作一个专门方法进行验证
						$rst = $admin->checkAccountPwd($_POST['admin_account'], $_POST['admin_pwd']);
						if ($rst === '1') {
							$this->assign('error', "帐号或密码错误");
						}else if($rst === '2'){
							$this->assign('error', "用户被禁用");
						}else {
							//登录信息持久化
							session('adminName', $rst['admin_name']);
							session('adminId', $rst['admin_id']);

							// 获取最后登录时间保存到session
							$lastLoginTime=$admin->field('last_login_time')->find($rst['admin_id']);
							session('lastLoginTime',$lastLoginTime['last_login_time']);

							// 最后登录时间修改
							$data['admin_id']=$rst['admin_id'];
							// 设置地区
							date_default_timezone_set("Asia/Shanghai");
							$data['last_login_time']=date("Y-m-d H:i:s");
							$admin->save($data);

							// 角色名称
							$role=M('Role');
							$info=$role->field('role_name')->find($rst['role_id']);
							session('adminRoleName',$info['role_name']);

							$this->redirect('Index/index');
						}
					}
				}else{
					//判断用户名和密码，在model模型里面制作一个专门方法进行验证
					$rst = $admin->checkAccountPwd($_POST['admin_account'], $_POST['admin_pwd']);
					
					if ($rst === '1') {
						$this->assign('error', "帐号或密码错误");
					}else if($rst === '2'){
						$this->assign('error', "用户被禁用");
					}else {
						//登录信息持久化
						session('adminName', $rst['admin_name']);
						session('adminId', $rst['admin_id']);

						// 获取最后登录时间保存到session
						$lastLoginTime=$admin->field('last_login_time')->find($rst['admin_id']);
						session('lastLoginTime',$lastLoginTime['last_login_time']);

						// 最后登录时间修改
						// $admin=M('Admin');
						$data['admin_id']=$rst['admin_id'];
						// 设置地区
						date_default_timezone_set("Asia/Shanghai");
						$data['last_login_time']=date("Y-m-d H:i:s");
						$admin->save($data);

						// 角色名称
						$role=M('Role');
						$info=$role->field('role_name')->find($rst['role_id']);
						session('adminRoleName',$info['role_name']);

						$this->redirect('Index/index');
					}
				}
			}
		}

		// 判断是否显示验证码
		$config=M('Config');
		$info=$config->field('config_save_code')->find();
		$this->assign('saveCode',$info['config_save_code']);

       	$this->display();
    }

    //注销用户
    public function logout(){
    	session(null);//清空全部session
    	$this->redirect('Login/login');
    }

    //制作专门方法实现验证码生成
	public function verifyImg() {
		//验证码显示不出来的解决办法
		//ob_clean();
		//ob_end_clean();

		//以下类verify在之前并没有include引入
		//走自动加载Think.class.php  autoload()
		$config = array(
			'imageH' => 33, //验证码图片高度
			'imageW' => 125,
			'fontSize' => 18, // 验证码字体大小(px)
			'fontttf' => '4.ttf', // 验证码字体，不设置随机获取
			'length' => 4, // 验证码位数
		);
		$verify = new \Think\Verify($config);
		$verify->entry();
	}
}