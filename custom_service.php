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

<script type="text/javascript" src="js/blog.js"></script>
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
		<a href="javascript:;"  name="message" title="联系客服"><img src="image/custom_service.jpg"></img></>联系客服</a>
	</div>
</div>
<?php require ROOT_PATH.'include/footer.inc.php'; ?>
</body>  
</html>   	