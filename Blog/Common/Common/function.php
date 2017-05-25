<?php
/**
 * TODO 基础分页的相同代码封装，使前台的代码更少
 * @param $count 要分页的总记录数
 * @param int $pagesize 每页查询条数
 * @return \Think\Page
 */
function getpage($count, $pagesize = 8) {
	$p = new Think\Page($count, $pagesize);
	$p -> setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
	$p -> setConfig('prev', '上一页');
	$p -> setConfig('next', '下一页');
	$p -> setConfig('last', '末页');
	$p -> setConfig('first', '首页');
	$p -> setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
	$p -> lastSuffix = false;
	//最后一页不显示为总页数
	return $p;
}


function tranTime($time) { 

	// 原本的时间
	$time1=$time;
	//获取今天凌晨的时间戳
   $day = strtotime(date('Y-m-d',time()));
   //获取昨天凌晨的时间戳
   $pday = strtotime(date('Y-m-d',strtotime('-1 day')));
   //获取前天凌晨的时间戳
   $qday = strtotime(date('Y-m-d',strtotime('-2 day')));

    $rtime = date("Y-m-d H:i", $time); 
    $htime = date("H:i", $time); 
    $time = time() - $time; 
    if ($time < 60) { 
        $str = '刚刚'; 
    } elseif ($time < 60 * 60) { 
        $min = floor($time / 60); 
        $str = $min . '分钟前'; 
    } elseif ($time < 60 * 60 * 24) { 
        $h = floor($time / (60 * 60)); 
        $str = $h . '小时前 ' . $htime; 
    } elseif ($time < 60 * 60 * 24 * 3) {
    	if($time1<$day && $time1>$pday){
    		$str = '昨天 ' . $htime;
    	}else{
    		$str = '前天 ' . $htime;
    	} 
        // $d = floor($time / (60 * 60 * 24)); 
        // if ($d == 1) 
        //     $str = '昨天 ' . $htime; 
        // else 
        //     $str = '前天 ' . $htime; 
    } 
    else { 
        $str = $rtime; 
    } 
    return $str; 
}	

/**
 * 邮件发送函数
 */
function SendMail($to, $title, $content) {
	// echo C('MAIL_CHARSET'),C('MAIL_HOST'),
    Vendor('PHPMailer.PHPMailerAutoload');     
    $mail = new \PHPMailer(true); //实例化
    $mail->IsSMTP(); // 启用SMTP
    $mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
    $mail->Host       = C('MAIL_HOST'); //smtp服务器的名称（这里以QQ邮箱为例）
    $mail->SMTPSecure = C('MAIL_SECURE'); //安全协议
    $mail->Port       = C('MAIL_PORT');  // SMTP服务器的端口号
    $mail->SMTPAuth   = C('MAIL_SMTPAUTH'); //启用smtp认证
    $mail->Username   = C('MAIL_USERNAME'); //你的邮箱名
    $mail->Password   = C('MAIL_PASSWORD') ; //邮箱密码
    $mail->From       = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
    $mail->FromName   = C('MAIL_FROMNAME'); //发件人姓名
    $mail->addAddress($to,"亲爱的朋友");
    $mail->WordWrap   = 50; //设置每行字符长度
    $mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件

    $mail->Subject =$title; //邮件主题
    $mail->Body    =$content; //邮件内容
    $mail->MsgHtml($content); //邮件内容
    $mail->AltBody ="这是一个纯文本的内容在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
    return($mail->send());
    // $mail->send();
    // var_dump($mail->send());exit;
    // return($mail->errorInfo);
    // return true;
}

// 获取ip地址
	
function getIpaddr($ip,$newIP){
	$data="";
    if(!isset($newIP)){
    	$newIP = new \Org\Util\IP();
	}
    if ($ip == '127.0.0.1' || $ip == '0.0.0.0')
    	$data = '本机地址';
    else
    {
        $ip = $newIP -> find($ip);
        for ($i=1; $i < count($ip) ; $i++) {
            if($ip[$i] != $ip[$i-1]){
            	$data  = $data .$ip[$i];
            }
        }
    }
    return $data;
}

// 获取操作系统
function getOS() {
	$os = '';
	$Agent = $_SERVER['HTTP_USER_AGENT'];
	if (eregi('win', $Agent) && strpos($Agent, '95')) {
		$os = 'Win 95';
	} elseif (eregi('win 9x', $Agent) && strpos($Agent, '4.90')) {
		$os = 'Win ME';
	} elseif (eregi('win', $Agent) && ereg('98', $Agent)) {
		$os = 'Win 98';
	} elseif (eregi('win', $Agent) && eregi('nt 5.0', $Agent)) {
		$os = 'Win 2000';
	} elseif (eregi('win', $Agent) && eregi('nt 6.0', $Agent)) {
		$os = 'Win Vista';
	} elseif (eregi('win', $Agent) && eregi('nt 6.1', $Agent)) {
		$os = 'Win 7';
	} elseif (eregi('win', $Agent) && eregi('nt 5.1', $Agent)) {
		$os = 'Win XP';
	} elseif (eregi('win', $Agent) && eregi('nt 6.2', $Agent)) {
		$os = 'Win 8';
	} elseif (eregi('win', $Agent) && eregi('nt 6.3', $Agent)) {
		$os = 'Win 8.1';
	} elseif (eregi('win', $Agent) && eregi('nt 10', $Agent)) {
		$os = 'Win 10';
	} elseif (eregi('win', $Agent) && eregi('nt', $Agent)) {
		$os = 'Win NT';
	} elseif (eregi('win', $Agent) && ereg('32', $Agent)) {
		$os = 'Win 32';
	} elseif (ereg('Mi', $Agent)) {
		$os = '小米';
	} elseif (eregi('Android', $Agent) && ereg('LG', $Agent)) {
		$os = 'LG';
	} elseif (eregi('Android', $Agent) && ereg('M1', $Agent)) {
		$os = '魅族';
	} elseif (eregi('Android', $Agent) && ereg('MX4', $Agent)) {
		$os = '魅族4';
	} elseif (eregi('Android', $Agent) && ereg('M3', $Agent)) {
		$os = '魅族';
	} elseif (eregi('Android', $Agent) && ereg('M4', $Agent)) {
		$os = '魅族';
	} elseif (eregi('Android', $Agent) && ereg('Huawei', $Agent)) {
		$os = '华为';
	} elseif (eregi('Android', $Agent) && ereg('HM201', $Agent)) {
		$os = '红米';
	} elseif (eregi('Android', $Agent) && ereg('KOT', $Agent)) {
		$os = '红米4G版';
	} elseif (eregi('Android', $Agent) && ereg('NX5', $Agent)) {
		$os = '努比亚';
	} elseif (eregi('Android', $Agent) && ereg('vivo', $Agent)) {
		$os = 'Vivo';
	} elseif (eregi('Android', $Agent)) {
		$os = 'Android';
	} elseif (eregi('linux', $Agent)) {
		$os = 'Linux';
	} elseif (eregi('unix', $Agent)) {
		$os = 'Unix';
	} elseif (eregi('iPhone', $Agent)) {
		$os = '苹果';
	} else if (eregi('sun', $Agent) && eregi('os', $Agent)) {
		$os = 'SunOS';
	} elseif (eregi('ibm', $Agent) && eregi('os', $Agent)) {
		$os = 'IBM OS/2';
	} elseif (eregi('Mac', $Agent) && eregi('PC', $Agent)) {
		$os = 'Macintosh';
	} elseif (eregi('PowerPC', $Agent)) {
		$os = 'PowerPC';
	} elseif (eregi('AIX', $Agent)) {
		$os = 'AIX';
	} elseif (eregi('HPUX', $Agent)) {
		$os = 'HPUX';
	} elseif (eregi('NetBSD', $Agent)) {
		$os = 'NetBSD';
	} elseif (eregi('BSD', $Agent)) {
		$os = 'BSD';
	} elseif (ereg('OSF1', $Agent)) {
		$os = 'OSF1';
	} elseif (ereg('IRIX', $Agent)) {
		$os = 'IRIX';
	} elseif (eregi('FreeBSD', $Agent)) {
		$os = 'FreeBSD';
	} elseif ($os == '') {
		$os = 'Unknown';
	}
	return $os;
}

/**
 * 验证码检查
 */
function check_verify($code, $id = "") {
	$verify = new \Think\Verify();
	return $verify -> check($code, $id);
}

/**
 * 获取当前日期
 */
function getNowDate() {
	return date("Y-m-d");
}

/**
 * 手机号码
 */
function isPhone($val) {

	if (ereg("^1[1-9][0-9]{9}$", $val))
		return true;
	return false;

}

/*
 * 获取浏览器信息
 */
function getUserBrowser() {
	if (strpos($_SERVER['HTTP_USER_AGENT'], 'Maxthon')) {
		$browser = 'Maxthon';
	} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 12.0')) {
		$browser = 'IE12.0';
	} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 11.0')) {
		$browser = 'IE11.0';
	} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 10.0')) {
		$browser = 'IE10.0';
	} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.0')) {
		$browser = 'IE9.0';
	} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0')) {
		$browser = 'IE8.0';
	} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0')) {
		$browser = 'IE7.0';
	} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0')) {
		$browser = 'IE6.0';
	} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'NetCaptor')) {
		$browser = 'NetCaptor';
	} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape')) {
		$browser = 'Netscape';
	} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Lynx')) {
		$browser = 'Lynx';
	} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera')) {
		$browser = 'Opera';
	} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')) {
		$browser = 'Chrome';
	} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox')) {
		$browser = 'Firefox';
	} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Safari')) {
		$browser = 'Safari';
	} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iphone') || strpos($_SERVER['HTTP_USER_AGENT'], 'ipod')) {
		$browser = 'iphone';
	} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'ipad')) {
		$browser = 'iphone';
	} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'android')) {
		$browser = 'android';
	} else {
		$browser = 'other';
	}
	return $browser;
}

function getAgent() {
	$agent = $_SERVER['HTTP_USER_AGENT'];
	return $agent;
}

// 获取IP地址
function getIp() {
	$ip = '未知IP';
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		return is_ip($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : $ip;
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		return is_ip($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $ip;
	} else {
		return is_ip($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : $ip;
	}
}

function is_ip($str) {
	$ip = explode('.', $str);
	for ($i = 0; $i < count($ip); $i++) {
		if ($ip[$i] > 255) {
			return false;
		}
	}
	return preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $str);
}

function LinkTo($ctl, $vars = array(), $var2 = array()) {
	$vars = array_merge($vars, $var2);
	foreach ($vars as $k => $v) {
		if (empty($v))
			unset($vars[$k]);
	}
	return U($ctl, $vars);
}

/*
 * 经度纬度 转换成距离
 * $lat1 $lng1 是 数据的经度纬度
 * $lat2,$lng2 是获取定位的经度纬度
 */

function rad($d) {
	return $d * 3.1415926535898 / 180.0;
}

function getDistanceNone($lat1, $lng1, $lat2, $lng2) {
	$EARTH_RADIUS = 6378.137;
	$radLat1 = rad($lat1);
	//echo $radLat1;
	$radLat2 = rad($lat2);
	$a = $radLat1 - $radLat2;
	$b = rad($lng1) - rad($lng2);
	$s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
	$s = $s * $EARTH_RADIUS;
	$s = round($s * 10000);
	return $s;
}

function getDistance($lat1, $lng1, $lat2, $lng2) {
	$s = getDistanceNone($lat1, $lng1, $lat2, $lng2);
	$s = $s / 10000;
	if ($s < 1) {
		$s = round($s * 1000);
		$s .= 'm';
	} else {
		$s = round($s, 2);
		$s .= 'km';
	}
	return $s;
}

/**
 * 字符串截取，支持中文和其他编码
 * @static
 * @access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * @return string
 */
function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = true) {
	if (function_exists("mb_substr"))
		$slice = mb_substr($str, $start, $length, $charset);
	elseif (function_exists('iconv_substr')) {
		$slice = iconv_substr($str, $start, $length, $charset);
		if (false === $slice) {
			$slice = '';
		}
	} else {
		$re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		preg_match_all($re[$charset], $str, $match);
		$slice = join("", array_slice($match[0], $start, $length));
	}
	return $suffix ? $slice . '...' : $slice;
}

/*
 * 删除缓存方法
 */
function delFileByDir($dir) {
	// echo $dir;
	$dh = opendir($dir);
	// echo $dh;
	// echo readdir($dh);
	while ($file = readdir($dh)) {
		if ($file != "." && $file != "..") {

			$fullpath = $dir . "/" . $file;
			// echo $fullpath;
			if (is_dir($fullpath)) {
				delFileByDir($fullpath);
			} else {
				unlink($fullpath);
				// echo $fullpath;
			}
		}
	}
	closedir($dh);
}

// 数据库操作里面使用的
function format_bytes($size, $delimiter = '') {
	$units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
	for ($i = 0; $size >= 1024 && $i < 5; $i++) 
		$size /= 1024;
	return round($size, 2) . $delimiter . $units[$i];
}

/**
 * sns表情标示符替换为html
 */
function parsesmiles($message) {
	$smilescache_file = 'Blog/Common/Common/smilies.php';
	if (file_exists($smilescache_file)){
		include $smilescache_file;
		// if (strtoupper(CHARSET) == 'GBK') {
		// 	$smilies_array = Language::getGBK($smilies_array);
		// }
		if(!empty($smilies_array) && is_array($smilies_array)) {
			$imagesurl = '/Public/home/js/wish/smilies/images/';
			$replace_arr = array();
			foreach($smilies_array['replacearray'] AS $key => $smiley) {
				$replace_arr[$key] = '<img src="'.$imagesurl.$smiley['imagename'].'" title="'.$smiley['desc'].'" border="0" alt="'.$imagesurl.$smiley['desc'].'" />';
			}

			$message = preg_replace($smilies_array['searcharray'], $replace_arr, $message);
		}
	}
	return $message;
}
?>