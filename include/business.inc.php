<?php 
if (!defined('IN_TG')) {
	exit('Access Defined!');
}
?>
<div id="basic_sidebar">
	<h2>中心导航</h2>
	<dl>
		<dt>订单管理</dt>
		<dd><a href="order_all.php">所有订单</a></dd>
		<dd><a href="order_not_pay.php">待付款订单</a></dd>
		<dd><a href="order_pay.php">已付款订单</a></dd>
	</dl>
	<dl>
		<dt>套餐管理</dt>
		<dd><a href="menu_tourism_up.php">上传套餐</a></dd>
		<dd><a href="menu_tourism_all.php">全部套餐</a></dd>
		
	</dl>
	<dl>
		<dt>信息中心</dt>
		<dd><a href="business_message.php">旅客咨询</a></dd>
		<dd><a href="system_message.php">系统通告</a></dd>
		
	</dl>
</div>