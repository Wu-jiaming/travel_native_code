<?php
session_start();
define('IN_TG',true);
define('SCRIPT','business_message');
require dirname(__FILE__).'/include/common.inc.php';

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
		
加盟合作<br>
    分销联盟<br>
    友情链接<br>
    广告业务<br>
    企业礼品卡采购<br>
    保险代理<br>
    代理合作<br>
    酒店加盟<br>
    目的地及景区合作<br>
    智慧旅游<br>
    更多加盟合作 <br>
	</div>
</div>
<?php require ROOT_PATH.'include/footer.inc.php'; ?>
</body>  
</html>   	