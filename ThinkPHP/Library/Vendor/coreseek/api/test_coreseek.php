<?php
// --------------------------------------------------------------------------
// File name   : test_coreseek.php
// Description : coreseek中文全文检索系统测试程序
// Requirement : PHP5 (http://www.php.net)
//
// Copyright(C), HonestQiao, 2011, All Rights Reserved.
//
// Author: HonestQiao (honestqiao@gmail.com)
//
// 最新使用文档，请查看：http://www.coreseek.cn/products/products-install/
//
// --------------------------------------------------------------------------
header("Content-type: text/html; charset=utf-8");
require ( "sphinxapi.php" );

$cl = new SphinxClient ();
$cl->SetServer ( '127.0.0.1', 9312);
$cl->SetConnectTimeout ( 3 );
$cl->SetArrayResult ( true );
$cl->SetMatchMode ( SPH_MATCH_ANY);
// $res = $cl->Query ( '网络搜索', "*" );
$res = $cl->Query ( '触及灵魂', "*" );

// print_r($cl);

echo "<pre>";
print_r($res);
echo "</pre>";