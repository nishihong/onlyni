<?php
namespace Home\Controller;
// use Home\Common;
use Think\Controller;
// use Home\Controller\CommonController;

class TestController extends Controller {
	// 测试 redis功能
    public function index(){
    	// import('Think.Cache.Driver.Redis'); 
    	// $redis = new \Think\Cache\Driver\Redis();
    	// $redis = new \Think\Cache();
    	$redis = new \Redis();    
		$redis->connect('127.0.0.1',6379);
		$redis->set('test','hello world!');
		echo $redis->get("test");

		
	    S('test','1234');
	    var_dump(S('test'));
		exit;
	}


	// 测试 搜索功能
    public function test(){
    	header("Content-type: text/html; charset=utf-8");

		Vendor('coreseek.api.sphinxapi');//加载第三方扩展包的文件文件名不包含class
		// $db = newPDO('mysql:host=localhost;port=3306;dbname=lemai', 'root', '123', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));//实例化PDO

		$cl = new \SphinxClient ();
		$cl->SetServer ( '127.0.0.1', 9312);
		// $cl->SetServer ( '121.42.182.236', 9312);
		$cl->SetConnectTimeout ( 3 );
		$cl->SetArrayResult ( true );
		$cl->SetMatchMode ( SPH_MATCH_ANY);
		// $res = $cl->Query ( '搜索', "*" );
		$res = $cl->Query ( '科比nba', "*" );

		// dump($cl);

		// dump($res);
		// exit();

		// 所有的数据 id
		// $ids = join(",",array_keys($res['matches']));  //join()函数返回一个由数组元素组合成的字符串。

		// php>5.5才可以
		// $ids=array_column($res['matches'],'id');
		// dump($ids);
		// exit();

		// 所有的数据 id
		foreach ($res['matches'] as $v){
			// $tmp = explode('-', $v);
			$arr[] = $v['id'];
		}
		// dump($arr);
		$ids=join(",",$arr);
		// echo $ids;
		// exit();

		$sql = "SELECT * FROM ni_article where article_id in ({$ids})";
		$info = M()->query($sql);
		// $r = $stmt->FETCHALL(PDO::FETCH_ASSOC);
		// echo "";
		dump($info);

		// print_r($cl);

		// dump($res);
		exit;
	}
}