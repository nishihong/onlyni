<?php
return array(
	//'配置项'=>'配置值'
	//模板相关配置
	'TMPL_PARSE_STRING' => array(
    	'__IMG__'         => __ROOT__ . '/Public/home/img',
    	'__CSS__'         => __ROOT__ . '/Public/home/css',
    	'__JS__'          => __ROOT__ . '/Public/home/js',
   	),

    //腾讯QQ登录配置
    'THINK_SDK_QQ' => array(
        
        'APP_KEY'               => '101316605', //应用注册成功后分配的 APP ID           
        'APP_SECRET'            => '409079c01e84322021fe17e6e1898472', //应用注册成功后分配的KEY              
        'CALLBACK'              => 'http://www.onlyni.com',//回调地址        
        // 修改后，请记得的修改 View/header.html中的 qqadmin 值
    ),

    // 后缀定义   未解决
    // 'URL_HTML_SUFFIX'=>'html'

    // 路由定义
    'URL_ROUTER_ON'             => true,   //开启路由
    //路由规则
    'URL_ROUTE_RULES' => array(
        '/^index$/'   =>    'Index/index',
        '/^about$/'   =>    'About/about', 
        '/^article$/'   =>    'Article/article', 
        '/^talk$/'    =>  'Talk/talk',
        '/^photo$/'    =>  'Photo/photo',
        '/^guestbook$/'    =>  'Guestbook/guestbook',
        '/^articleDetails-(\d{1,})$/'   =>  'Article/articleDetails?id=:1',
        '/^articleQuery-(\d{1,})$/'   =>  'Article/articleQuery?id=:1',
        '/^photo-(\d{1,})$/'   =>  'Photo/picture?id=:1',

        '/^articleDetails-(\d{1,})\/p-(\d{1,})$/'   =>  'Article/articleDetails?id=:1&articlePage=:2',

        // 分页改写路由，未完成
        // '/^article\/p-(\d{1,})$/'   =>  'Article/article?&page=:1',

        // '/^said\/p\/(\d{1,})$/'  =>  'Said/index?p=:1',
        // '/^feel-(\d{1,})$/'     =>  'Feel/index?id=:1',
        // '/^gustbook\/(\d{1,})$/'  =>    'Gustbook/index?page=:1',
        // '/^album-(\d{1,5})$/'     =>  'Album/look?id=:1',
        // '/^class-(\d{1,})\/page\/(\d{1,})$/'  =>  'Class/index?id=:1&page=:2',
        // '/^class-(\d)$/'    =>  'Class/index?id=:1',
        // '/^article-(\d{1,5})$/'   =>  'Article/index?id=:1',
    ),

    // redis缓存
    'DATA_CACHE_PREFIX' => 'Redis_',//缓存前缀
    'DATA_CACHE_TYPE'=>'Redis',//默认动态缓存为Redis
    'REDIS_RW_SEPARATE' => true, //Redis读写分离 true 开启
    'REDIS_HOST'=>'127.0.0.1', //redis服务器ip，多台用逗号隔开；读写分离开启时，第一台负责写，其它[随机]负责读；
    'REDIS_PORT'=>'6379',//端口号
    'REDIS_TIMEOUT'=>'300',//超时时间
    'REDIS_PERSISTENT'=>false,//是否长连接 false=短连接
    'REDIS_AUTH'=>'',//AUTH认证密码
);