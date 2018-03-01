<?php 
session_start();
define('IN_TG',true);
define('SCRIPT','member');
require dirname(__FILE__).'/include/common.inc.php';
//检查是否正常登陆
if(isset($_COOKIE['username'])){
	
	if(!!$rows=_fetch_array("SELECT t_login_count,t_last_ip,t_last_time,t_username,t_sex,t_face,t_email,t_level,t_reg_time,t_phone FROM t_user WHERE t_username='{$_COOKIE['username']}'")){
		$html=array();
		$html['username']=$rows['t_username'];
		$html['sex']=$rows['t_sex'];
		$html['face']=$rows['t_face'];
		$html['email']=$rows['t_email'];
		$html['phone']=$rows['t_phone'];
		$html['reg_time']=$rows['t_reg_time'];
		$html['last_time']=$rows['t_last_time'];
		$html['last_ip']=$rows['t_last_ip'];
		$html['login_count']=$rows['t_login_count'];
		switch($rows['t_level']){
			case 1:
				$html['level']='普通会员';
				break;
			case 2:
				$html['level']="商家";
				break;
			case 2:
				$html['level']="管理员";
				break;
			default:
				$html['level']='level不存在';
					
		}
		$html = _html($html);
	}else{
		_alert_back('用户不存在');
	}
	
}
else{
	_alert_back('非法登陆');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  

<?php
require ROOT_PATH.'/include/title.inc.php';
?>  
</head>  
<body>
<?php 
require ROOT_PATH.'include/header.inc.php';
?>
<div id="member">
<?php 


	require ROOT_PATH.'/include/member.inc.php';
?>
	<div id="member_main">
		<h2>会员管理中心</h2>
			<dl>
				<dd>用 户 名：<?php echo $html['username']?></dd>
				<dd>性　　别：<?php  echo $html['sex']?></dd>
				<dd>头　　像：<?php  echo $html['face']?></dd>
				<dd>电子邮件：<?php  echo $html['email']?></dd>
				<dd>电话号码：<?php  echo $html['phone']?></dd>
				<dd>注册时间：<?php  echo $html['reg_time']?></dd>
				<dd>登录次数：<?php  echo $html['login_count']?></dd>
				<dd>最后一次登录的IP：<?php  echo $html['last_ip']?></dd>
				<dd>最后一次登录时间：<?php  echo $html['last_time']?></dd>
				
				<dd>身　　份：<?php  echo $html['level']?></dd>
			</dl>
	</div>
</div>

<?php 
		require ROOT_PATH.'/include/footer.inc.php';
?>
</body>  
</html> 	