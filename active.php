<?php
session_start();
define('IN_TG',true);
define('SCRIPT','active');
require dirname(__FILE__).'/include/common.inc.php';
if (!isset($_GET['id'])) {
	_alert_back('非法操作');
}
else{
	$id=$_GET['id'];
}
if (($_GET['action']=='active') && ($_GET['id']==$id)) 
{
	if($_POST['active_code']==$_SESSION['active_code']){
	
				_query("UPDATE t_user SET t_status = 1 WHERE t_id='{$_GET['id']}' LIMIT 1");
				if (_affect_rows() == 1)
				{
					_close();
					_location('账户激活成功','login.php');
				} else
					{
						_close();
						_location('账户激活失败','register.php');
					}
		
	}
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  

<?php 
	require ROOT_PATH.'/include/title.inc.php';
?>
<script type="text/javascript" src="js/register.js"></script	>
</head>  
<body>
<?php require ROOT_PATH.'include/header.inc.php'; ?>
<div id="active">
	<h2>激活账户</h2>
	<p>本页面是模拟邮件发送功能  用于激活你的账户</p>
	<form method="post" name="avtive" action="active.php?action=active&id=<?php echo $id?>">
		<dl>
			<dd>请输入激活码：<input type="text" name="active_code" class="text"/></dd>
			<dd><input type="submit" class="submit" value="提交"/></dd>
		</dl>
		
	</form>
	
</div>
<?php require ROOT_PATH.'include/footer.inc.php'; ?>
</body>  
</html> 