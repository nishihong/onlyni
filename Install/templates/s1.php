<!doctype html>
<html>
<head>
<meta charset="UTF-8" />
<title><?php echo $Title; ?> - <?php echo $Powered; ?></title>
<link rel="stylesheet" href="./css/install.css?v=9.0" />
</head>
<body>
<div class="wrap">
  <?php require './templates/header.php';?>
  <div class="section">
    <div class="main cc">
      <pre class="pact" readonly="readonly">小倪博客 使用协议

版权所有 (c)2015-<?php echo date("Y")?>，倪时鸿 保留所有权利。 

版本最新更新： 2016年01月01日 By Nsh

小倪博客网站：http://www.onlyni.com
-----------------------------------------------------
运 营 团 队: 倪时鸿
电       话: 156-590-44478
邮       箱: 249183418@qq.com
网       址: http://www.onlyni.com

</pre>
    
    </div>
    <div class="bottom tac"> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?step=2" class="btn">接 受</a> </div>
  </div>
</div>
<?php require './templates/footer.php';?>
</body>
</html>