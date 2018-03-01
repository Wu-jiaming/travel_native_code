<?php

session_start();
define('IN_TG',true);
define('SCRIPT','register');
require dirname(__FILE__).'/include/common.inc.php';//dirname(__FILE__)=文件所在层的目录名
//登陆状态无法进行本操作
_login_state();
global $system;
//判断是否提交注册
if(@$_GET['action']=='register')
{
	//验证吗是否相等
	_check_yzm($_POST['yzm'],$_SESSION['code']);
	include ROOT_PATH.'/include/check.func.php';
	$clean=array();
	//通过一个唯一的标识符可以防止恶意注册
	//第二个作用是登录cookie
	$clean['uniqid']=_check_uniqid($_POST['uniqid'], $_SESSION['uniqid']);
	//active也会死一种标识符  用来注册的用户进行激活处理
	//$clean['active']=_sha1_uniqid();
	$clean['username']=_check_name($_POST['username'],2,20);
	$clean['password']=_check_password($_POST['password'],$_POST['notpassword'],6,40);
	$clean['sex']=_check_sex($_POST['sex']);
	$clean['face']=_check_face($_POST['face']);
	$clean['email']=_check_email($_POST['email'],40);
	$clean['phone'] = _check_phone($_POST['phone']);
	$clean['level'] = $_POST['level'];
	
	//用户名的唯一性
	_is_repeat("SELECT t_username FROM t_user WHERE t_username ='{$clean['username']}' LIMIT 1", '对不起，该用户名已经被注册！');
	//新增用户  //在双引号里，直接放变量是可以的，比如$_username,但如果是数组，就必须加上{} ，比如 {$_clean['username']}
	_query(
			"INSERT INTO t_user (
			t_uniqid,
		
			t_username,
			t_password,
			t_phone,
			t_sex,
			t_face,
			t_email,
			t_reg_time,
			t_last_time,
			t_last_ip,
			t_level
			
			)
			VALUES (
																'{$clean['uniqid']}',
															
																'{$clean['username']}',
																'{$clean['password']}',
																'{$clean['phone']}',
																'{$clean['sex']}',
																'{$clean['face']}',
																'{$clean['email']}',
																	NOW(),
																	NOW(),
																	'{$_SERVER["REMOTE_ADDR"]}',
																	'{$clean['level']}'
			)"
	) ;
	if(_affect_rows() == 1){
		//获取刚刚新增的id
			$clean['id']=_insert_id();
			$exptime = time()+60*60*24;
			if($clean['id']){
				require dirname(__FILE__).'/include/smtp.class.php';
				$smtpserver = "smtp.163.com"; //SMTP服务器
			    $smtpserverport = 25; //SMTP服务器端口
			    $smtpusermail = "wnfnko@163.com"; //SMTP服务器的用户邮箱
			    $smtpuser = "wnfnko@163.com"; //SMTP服务器的用户帐号
			    $smtppass = "1wujiaming"; //SMTP服务器的用户密码
			    $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
			    $emailtype = "HTML"; //信件类型，文本:text；网页：HTML
			    $smtpemailto = $clean['email'];
			    $smtpemailfrom = $smtpusermail;
			    $emailsubject = "用户帐号激活";
			    $active_code = _active_code();
			    //$emailbody = '123';
				//$emailbody = "亲爱的".$clean['username']."：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/><a href='http://localhost:8080/tourism_management/active.php?action=".$clean['active']."'>http://localhost:8080/tourism_management/active.php?action=".$clean['active']."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- Hellwoeba.com 敬上</p>";
			    $emailbody = "亲爱的".$clean['username']."：<br/>感谢您在我站注册了新帐号。<br/>请用激活码激活您的帐号。<br/>".$_SESSION['active_code']."<br/>该激活码24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- 旅游管理系统 敬上</p>";
			     
			    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
			    if($rs==1){
			        $msg = '恭喜您，注册成功！<br/>请登录到您的邮箱及时激活您的帐号！';   
			    }else{
			        $msg = $rs;
			       
			    }
			} else {
			    $msg = '服务器忙，请稍后再试';
			    
			}

			_close();
			_session_destroy();
			//生成XML
			_set_xml('new.xml', $clean);
			echo $msg;
			_location( $msg, 'active.php?id='.$clean['id']);
	}else{
		_close();
		_session_destroy();
		_location('很遗憾，注册失败', 'register.php');
	}
}
else {
	$_SESSION['uniqid']=$_uniqid=_sha1_uniqid();
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
<script type="text/javascript" src="js/register.js"></script	>
</head>  
<body>
<?php require ROOT_PATH.'include/header.inc.php'; ?>

<div id="register">
	<h2>用户注册</h2>
	
	<form method="post" name="register" action="register.php?action=register" >
	<input type="hidden" name="uniqid" value="<?php echo $_uniqid?>"/>
		<dl>	
			<dt>请认真填写以下个人信息！打死不泄露（滑稽）</dt>
			<dd>用 户 名：<input type="text" name="username" class="text" />*必填 2位-20位(数字或者字母)</dd>
			<dd><input type="radio" id="level" name="level" value="1" checked="checked" />会员<input type="radio" id="level" name="level" value="2" />商家</dd>
			<dd>密　　码：<input type="password" name="password" class="text" />*必填 6位-20位(数字或者字母)</dd>
			<dd>确认密码：<input type="password" name="notpassword" class="text" />*必填 重新输入密码</dd>
			<dd>手机号码：<input type="text" name="phone" class="text" />*必填 11位数字</dd>
			<dd>性　　别：<input type="radio" name="sex" value="男" checked="checked" />男<input type="radio" name="sex" value="女" />女</dd>
			<dd class="face">头像选择：<input type="hidden" name="face" value="face/m01.gif" /><img src="face/m01.gif" alt="头像选择" id="faceimg" /></dd>
			<dd>电子邮件：<input type="text" name="email" class="text" />选填 格式：XX@xx.xx</dd>
			<dd>验 证 	码：<input type="text" name="yzm" class="yzm" /><img src="code.php" id="code"/></dd>
			
			<dd><input type="submit" class="submit" value="注册" /></dd>
		</dl>
	</form>

</div>
<?php require ROOT_PATH.'include/footer.inc.php'; ?>
</body>  
</html> 




