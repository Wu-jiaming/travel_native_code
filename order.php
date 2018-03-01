<?php
session_start();
define('IN_TG',true);
define('SCRIPT','order');
require dirname(__FILE__).'/include/common.inc.php';
 //判断是否登录咯
 if(!isset($_COOKIE['username'])){
 	_alert_back('会员必须先登陆');
 }
if(isset($_GET['id']) && $_GET['action']=='order'){
	//算价格
	if(!!($rows=_fetch_array("Select t_price,t_name,t_cityname from t_photo where t_id='{$_GET['id']}'"))){
		$price=explode('￥', $rows['t_price']);
		$html=array();
		$html['scence_name']=$rows['t_name'];
/* 		$html=array();
		$html['price']=$price;
		$html['scence_name']=$rows['t_name'];
		$html['cityname']=$rows['t_cityname'];
		$html['username']=$_COOKIE['username'];
		//取出数据
		
		//导进数据库
		_query("insert into t_pay(t_total_price,t_pay_time,t_username,t_scence_name,t_cityname)
							values('{$html['price']}',NOW(),'{$html['username']}','{$html['scence_name']}','{$html['cityname']}')");
		 */
		
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
<div id="message">
	<h2>提交订单</h2>
	<form method="post"  action="pay.php?action=pay">
	
		<dl>
			<dd>
					
					TO:<input type="text" name="scence_name"  readonly="readonly" value="<?php echo $html['scence_name'] 	?>" />
			</dd> 
			<dd>
					出发时间：
					<input type="text"  name="time" readonly="readonly" value="<?php echo $_POST['year'] 	?>年<?php echo $_POST['month'] ?>月 <?php echo $_POST['day'] ?>日" />
			</dd>		
			<dd>
				订票数：大人：<input type="text" name="adult"  readonly="readonly" value="<?php echo $_POST['adult'] 	?>"/>张
								小朋友：<input type="text" name="child" readonly="readonly" value="<?php echo $_POST['child']?>"/>张
				
			</dd>
			<dd>
				价格：￥<input type="text"name="price"  readonly="readonly" value="<?php  echo $price['1']*$_POST['adult']+$price['1']/2*$_POST['child']?>"/>
				
			</dd>
			<dd>验 证 	码：<input type="text" name="yzm" class="yzm" /><img src="code.php" id="code"/><input type="submit" class="submit" value="立刻付钱" /></dd>
			
	
		</dl>
	</form>

</div>
<?php require ROOT_PATH.'include/footer.inc.php'; ?>
</body>  
</html>   	