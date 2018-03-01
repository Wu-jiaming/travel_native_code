<?php

session_start();
define('IN_TG',true);
define('SCRIPT','pay');
require dirname(__FILE__).'/include/common.inc.php';//dirname(__FILE__)=文件所在层的目录名
if($_GET['action'] == 'pay'){
if(!isset($_COOKIE['username'])){
	_alert_back('会员必须先登陆');
}
//验证码
_check_yzm($_POST['yzm'],$_SESSION['code']);

$clean=array();
$clean['leave_time']=$_POST['time'];
$clean['num_adult']=$_POST['adult'];
$clean['num_child']=$_POST['child'];
$clean['scence_name']=$_POST['scence_name'];
$clean['price']=$_POST['price'];
$clean['username']=$_COOKIE['username'];

if(!!$rows=_fetch_array("select t_cityname from t_photo where t_name = '{$clean['scence_name']}'")){
	$clean['cityname'] = $rows['t_cityname']; 
	
}

	
	//取出数据

	//导进数据库
	_query("insert into t_pay(t_total_price,t_pay_time,t_username,t_scence_name,t_cityname)
			values('{$clean['price']}',NOW(),'{$clean['username']}','{$clean['scence_name']}','{$clean['cityname']}')");

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

</head>  
<body>
<?php require ROOT_PATH.'include/header.inc.php'; ?>

<div id="pay">
	<h2>支付页面</h2>
		<div id="wechat">
			<h3>微信支付</h3>
			<img src="thumb.php?filename=pay/wechat.png&percent=0.5" alt="微信支付" />
		</div>
		
		<div id="alipay">
			<h3>支付宝支付</h3>
			<img src="thumb.php?filename=pay/alipay.jpg&percent=0.5" alt="支付宝支付" />
		</div>
		
		<div id="card">
			<h3>银行卡支付</h3>
			请输入银行卡号：<input type="text" name="card"></input>
			<input type="submit" name="pay" value="确定"></input>
		</div>		

</div>
<?php require ROOT_PATH.'include/footer.inc.php'; ?>
</body>  
</html>