<?php
return array(
    // C('TT',22),
	  //'配置项'=>'配置值'
	  //模板相关配置
   	'TMPL_PARSE_STRING' => array(
    	'__IMG__'         => __ROOT__ . '/Public/admin/img',
    	'__CSS__'         => __ROOT__ . '/Public/admin/css',
    	'__JS__'          => __ROOT__ . '/Public/admin/js',
      '__SWEETALERT__'  => __ROOT__ . '/Public/admin/sweetalert',
      '__BOOTSTRAP__'   => __ROOT__ . '/Public/admin/bootstrap',
      '__LAYDATE__'     => __ROOT__ . '/Public/admin/laydate',
      '__FORM__'        => __ROOT__ . '/Public/admin/form',
      '__UEDITOR__'     => __ROOT__ . '/Public/admin/ueditor',
      '__VALIDATE__'    => __ROOT__ . '/Public/admin/validate',
      '__NAV__'         => __ROOT__ . '/Public/admin/nav',
      '__PROVINCE__'    => __ROOT__ . '/Public/admin/province',
    	'__UPLOADIFY__'    => __ROOT__ . '/Public/admin/uploadify',
      // '__ROOT__'        => __ROOT__ ,
      // 'TT'              =>hehe,

      // 说说图片
      '{TALK_WIDTH}'         =>'150',
      '{TALK_HEIGHT}'        =>'100',

      // 文章图片
      '{ARTICLE_WIDTH}'         =>'180',
      '{ARTICLE_HEIGHT}'        =>'120',

      // logo图片
      '{LOGO_WIDTH}'         =>'200',
      '{LOGO_HEIGHT}'        =>'40',

      // 相册图片
      '{PHOTO_WIDTH}'         =>'200',
      '{PHOTO_HEIGHT}'        =>'150',

      // 图片图片
      '{PICTURE_WIDTH}'         =>'400',
      '{PICTURE_HEIGHT}'        =>'400',
   	),


   	//修改默认路径（主页）
	  'DEFAULT_CONTROLLER'    =>  'Login', //默认控制器名称
	  'DEFAULT_ACTION'        =>  'login', // 默认操作名称

);