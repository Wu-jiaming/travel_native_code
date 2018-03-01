<?php 
if (!defined('IN_TG')) {
	exit('Access Defined!');
}
?>
<div id="basic_sidebar">
	<h2>管理导航</h2>

		<dl>
				<dt>系统管理</dt>
				<dd><a href="manage.php">后台首页</a></dd>
				<dd><a href="manage_set.php">系统设置</a></dd>
		</dl>
	<dl>
		<dt>订单管理</dt>
		<dd><a href="order_all.php">所有订单</a></dd>
		<dd><a href="order_not_pay.php">待付款订单</a></dd>
		<dd><a href="order_pay.php">已付款订单</a></dd>

	</dl>
	<dl>
		<dt>会员管理</dt>
		<dd><a href="manage_member.php">会员首页</a></d>
			
	</dl>
	<dl>
		<dt>商家管理</dt>
		<dd><a href="manage_business.php">商家首页</a></dd>
	</dl>
	<dl>
		<dt>职务管理</dt>
		<dd><a href="manage_job.php">职务设置</a></dd>
			
	</dl>
		<dl>
		<dt>系统通告</dt>
		<dd><a href="system_message.php">系统通告</a></dd>
			
	</dl>

</div>