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
		
旅游资讯<br>
    宾馆索引<br>
    攻略索引<br>
    机票索引<br>
    网站导航<br>
    旅游索引<br>
    火车票索引<br>
    邮轮索引<br>
    企业差旅索引<br>
    用车索引 <br>
	</div>
</div>
<?php require ROOT_PATH.'include/footer.inc.php'; ?>
</body>  
</html>   	