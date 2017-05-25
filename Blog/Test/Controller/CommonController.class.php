<?php
namespace Test\Controller;
use Think\Controller;
// 引入QQ登陆插件
use Org\ThinkSDK\ThinkOauth;
//公共继承  nav导航
class CommonController extends Controller {
	public function __construct(){
		//先执行父类的构造方法，否则系统要报错
        //因为原先的构造方法默认是被执行的
		parent::__construct();//一定要注意这一行，这一行是为了执行父类中的构造函数，否则运行是会出错的

		// 语言包
		// $this->lang();

        // 获取二级域名
		// $this->getDomain();
	}

	// 空方法 跳转404页面
	public function _empty() {  
	    R('Empty/_empty');  
	} 

	// 获取二级域名
    public function getDomain(){
        $host = $_SERVER['HTTP_HOST'];
        $hosts = explode('.', $host);
        if(sizeof($hosts) == 3){
            $domain = $hosts[0];
            if($domain == 'wish'){
                // $this->redirect('Wish/wish');
            }
        }
    }

    // 语言包
	// public function lang(){
	// 	if(!cookie('think_language')){
	// 		cookie('think_language','zh-cn');
	// 	}
	// }

	/* QQ登陆方法 */
	public function loginQq(){
        $sdk = ThinkOauth::getInstance('qq');
        redirect($sdk->getRequestCodeURL());
	}

	/* QQ退出方法 */
    public function outQq() {
        session(null);
        $this->redirect('Index/index');
    }

    protected function _initialize(){
		 // 判断是否QQ登陆
        if (!session('qqname')) {
            if (!empty($_GET['code'])) {
                $code = I('get.code');
                $sns = ThinkOauth::getInstance('QQ');
                $extend = null;
                $token = $sns->getAccessToken($code, $extend);
 
                if (is_array($token)) {
                    $data = $sns->call('user/get_user_info');

                    if ($data['ret'] == 0) {
                        // $userInfo['type'] = 'QQ';
                        $userInfo['qq_openid'] = $token['openid'];
                        // 判断有没有登录过
                        $res = M('QqUser')->where($userInfo)->getField('qq_num');
                        $userInfo['qq_name'] = $data['nickname'];
                        $userInfo['qq_img'] = $data['figureurl_qq_2'];
                        $userInfo['qq_gender'] = $data['gender'];
                        $userInfo['qq_city'] = $data['city'];
                        $userInfo['qq_province'] = $data['province'];
                        $userInfo['qq_year'] = $data['year'];
                        // 如果登录过 登录次数+1  否则添加用户
                        if ($res) {
                            $data = array('qq_num' => $res + 1,);
                            M('QqUser')->where(array('qq_openid' => $token['openid']))->save($data);
                        } else {
                        	$userInfo['qq_num'] = 1;
                            M('QqUser')->add($userInfo);
                        }
                        /* 最近访客存入系统 */
                        SESSION('qqname', $userInfo['qq_name']);
                        SESSION('qqimg', $userInfo['qq_img']);

                        $this->redirect('Index/index');
                    }
                }
            }
        }
        $this->qqname = session('qqname');
    }
}
