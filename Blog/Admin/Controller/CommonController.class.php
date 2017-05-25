<?php
namespace Admin\Controller;
use Think\Controller;

//公共继承  nav导航
class CommonController extends Controller {
	public function __construct(){
		//先执行父类的构造方法，否则系统要报错
        //因为原先的构造方法默认是被执行的
		parent::__construct();//一定要注意这一行，这一行是为了执行父类中的构造函数，否则运行是会出错的

		// 语言包
		// $this->lang();

		self::nav();
		// 验证session
		$this->CheckSession();
		// 验证权限
		$this->CheckAuth();
		// 获取配置信息   如logo  title  关键词 描述
		// $this->config();
	}

	// 语言包
	// public function lang(){
	// 	if(!cookie('think_language')){
	// 		cookie('think_language','zh-cn');
	// 	}
	// }
	
	// 空方法 跳转404页面
	public function _empty() {  
	    R('Empty/_empty');  
	} 

	//导航条获取
	public function nav(){
		//根据session用户id信息查询角色id信息
		 if(!empty($_SESSION['adminId'])){
			$admin=M('Admin');
			$adminInfo=$admin->find($_SESSION['adminId']);
			$role_id=$adminInfo['role_id'];
			//根据角色信息获得权限ids的信息
			$role=M('Role');
			$roleInfo=$role->find($role_id);
			$auth_ids=$roleInfo['role_auth_ids'];

			//根据$auth_ids查询全部拥有的权限信息
	        // ① 获得顶级权限
	        $sql="select * from ni_auth where auth_level=0 ";
	        //如果是admin管理员要现实全部权限
	        if($_SESSION['adminId']!=1&&!empty($auth_ids)){
	        	$sql.=" and auth_id in ($auth_ids)";
	        }
	        $sql.=" order by auth_rank ";
	        $p_info=D()->query($sql);
	        // var_dump($p_info);
	        //② 获得次顶级权限
	        $sql="select * from ni_auth where auth_level=1 ";
	        //如果是admin管理员要现实全部权限
	        if($_SESSION['adminId']!=1&&!empty($auth_ids)){
	        	$sql.=" and auth_id in ($auth_ids)";
	        }
	        $sql.=" order by auth_rank ";
	        $s_info=D()->query($sql);
	        // var_dump($s_info);

	        $this -> assign('pauth_info',$p_info);
	        $this -> assign('sauth_info',$s_info);
         }
	}

	//构造函数，验证Session
	private function CheckSession() {
		if (!isset($_SESSION['adminName'])) {
			$this->redirect('Login/login', '', 0.01, '<script>alert("当前用户未登录或登录超时，请重新登录")</script>');
		}
	}

	//验证跨权限访问，是否非法
	private function CheckAuth(){
		//CONTROLLER_NAME ---Goods
        //ACTION_NAME  ----showlist
        //当前请求操作
        $now_ac = CONTROLLER_NAME."-".ACTION_NAME;
        // var_dump($now_ac);
        //过滤控制器和方法，避免用户非法请求
        //通过角色获得用户可以访问的控制器和方法信息
        $sql ="select role_auth_ac from ni_admin a join ni_role b on a.role_id=b.role_id where a.admin_id=".$_SESSION['adminId'];
        $auth_ac = D()->query($sql);      
        $auth_ac = $auth_ac[0]['role_auth_ac'];
        // var_dump($auth_ac);

        //判断$now_ac是否在$auth_ac字符串里边有出现过
        //strpos函数如果返回false是没有出现，返回0 1 2 3表示有出现
        //管理员不限制
        //默认以下权限没有限制
        //Index-index  Login/login
        $allow_ac = array('Index-index','Personal-personal','Personal-personalInfo','Personal-personalPwd','Personal-personalPwdUpdate');
        if(!in_array($now_ac,$allow_ac) && $_SESSION['adminId'] !=1 && strpos($auth_ac,$now_ac) === false){
            $this -> error('没有权限访问',U("Index/index"));
        } 	
	}
}
