<?php
session_start();
define('IN_TG',true);
define('SCRIPT','business_message');
require dirname(__FILE__).'/include/common.inc.php';
if (!isset($_COOKIE['username'])){
	_alert_back('请先登录');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  

<?php
require ROOT_PATH.'/include/title.inc.php';
?>  

<script type="text/javascript" src="js/business_message.js"></script>
</head>  
<body>
<?php 
require ROOT_PATH.'include/header.inc.php';
?>
<div id="help">
<h2>帮助中心</h2>
<?php 
	require ROOT_PATH.'/include/help.inc.php';
?>
	<div id="basic_main">
		
	关于在线旅游管理系统<br>
   
    联系我们<br>
    诚聘英才<br>
    旅游度假资质<br>
    企业公民<br>
    用户协议<br>
    营业执照<br>
    安全中心<br>
    信用卡 <br>
	</div>
</div>
<?php require ROOT_PATH.'include/footer.inc.php'; ?>
</body>  
</html>   	