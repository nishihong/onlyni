<?php
return array(
	// url重写
	// define('URL_REWRITE',2);

	//'配置项'=>'配置值'
	//默认Admin
	'MODULE_ALLOW_LIST' => array('Home', 'Admin'), //允许访问的模块
	'DEFAULT_MODULE' => 'Home', //默认模块
	'MODULE_DENY_LIST' => array('Common', 'Runtime'), // 设置禁止访问的模块列表

	// url模式 可以去掉前面的index.php
	'URL_MODEL'                 =>2,

	//修改默认路径（主页）
	// 'DEFAULT_CONTROLLER'    =>  'Login', //默认控制器名称
	// 'DEFAULT_ACTION'        =>  'login', // 默认操作名称

	'DB_TYPE' => 'mysql', // 数据库类型
	'DB_HOST' => 'localhost', // 服务器地址
	'DB_NAME' => 'blog', // 数据库名
	'DB_USER' => 'root', // 用户名
	'DB_PWD' => 'root', // 密码
	'DB_PORT' => '3306', // 端口
	'DB_PREFIX'             =>  'ni_',    // 数据库表前缀
	'DB_CHARSET' => 'utf8', // 数据库编码默认采用utf8

	'SHOW_PAGE_TRACE'=>true,//开启页面Trace
	'DB_DEBUG'				=> true, // 开启调试模式 记录SQL日志
	'URL_CASE_INSENSITIVE'  =>  false,  // URL区分大小写

	// 'TMPL_L_DELIM'          => '<{',   //模板引擎普通标签开始标记 
 	// 'TMPL_R_DELIM'          => '}>',      //模板引擎普通标签结束标记

 	'LANG_SWITCH_ON'     =>     true,    //开启语言包功能       
    'LANG_AUTO_DETECT'     =>     true, // 自动侦测语言
    'DEFAULT_LANG'         =>     'zh-cn', // 默认语言       
    'LANG_LIST'            =>    'en-us,zh-cn,zh-tw', //必须写可允许的语言列表
    'VAR_LANGUAGE'     => 'l', // 默认语言切换变量


    //二级域名部署
    // 'APP_GROUP_LIST'     => 'Home,Admin', 
    // 'DEFAULT_GROUP'      =>'Home', 
    // 'APP_SUB_DOMAIN_DEPLOY'=>1, // 开启子域名配置
        /*子域名配置 
        *格式如: '子域名'=>array('分组名/[模块名]','var1=a&var2=b'); 
        */ 
        // 'APP_SUB_DOMAIN_RULES'=>array(   
        //     'admin'=>array('Admin/'),  // admin域名指向Admin分组
        //     'wish'=>array('Home/Wish'),  // wish域名指向Test分组
        // ),
);