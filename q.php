<?php

session_start();
define('IN_TG',true);
define('SCRIPT','login');
require dirname(__FILE__).'/include/common.inc.php';//dirname(__FILE__)=文件所在层的目录名
//登陆状态无法进行本操作
_login_state();

//判断是否提交注册
if($_GET['action']=='login')
{
	//验证吗是否相等
	include ROOT_PATH.'/include/login.func.php';
	_check_yzm($_POST['yzm'],$_SESSION['code']);
	
	$clean=array();
	$clean['username'] = _check_name($_POST['username'],2, 20);
	$clean['password'] = _check_password($_POST['password'], 6, 40);
	$clean['time'] = 0;
	
	//验证登录
	if (!!($rows = _fetch_array("select t_uniqid,t_level
														from t_user where t_username='{$clean['username']}'
																	and t_status = '1'
																		limit 1")))
	{
		//写入数据库
			_query("update t_user set t_last_time = NOW(),
															t_last_ip = '{$_SERVER['REMOVE_ADDR']}',
																t_login_count = t_login_count + 1
																		where t_username = '{$clean['username']}'");
			
		//设置cookies
		_setcookies($clean['username'], $rows['t_uniqid'], $clean['time']);
		if($rows['t_level'] == 3 ){
			$_SESSION['admin'] = $clean['username'];
		} 
		_close();
		_location(null, 'main.php');
	}
	else
	{
		_close();
		_location("帐号或密码不正确，或者该帐号还没激活！", 'login.php');
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
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
</head>  
<body>
<?php require ROOT_PATH.'include/header.inc.php'; ?>

<div id="login">
	<h2>用户登录</h2>
	
	<form method="post" name="login" action="login.php?action=login" >
	<input type="hidden" name="uniqid" value="<?php echo $_uniqid?>"/>
		<dl>	
			
			<dd>用 户 名：<input type="text" name="username" class="text" /> 2位-20位(数字或者字母)</dd>
			<dd>密　　码：<input type="password" name="password" class="text" /> 6位-20位(数字或者字母)</dd>

			<dd>验 证 	码：<input type="text" name="yzm" class="yzm" /><img src="code.php" id="code"/></dd>
			<dd><input type="submit" class="submit" value="登录" /></dd>
		</dl>
	</form>

</div>
<?php require ROOT_PATH.'include/footer.inc.php'; ?>
</body>  
</html>