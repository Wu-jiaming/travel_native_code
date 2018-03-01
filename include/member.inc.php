<?php 
if (!defined('IN_TG')) {
	exit('Access Defined!');
}

?>
<div id="basic_sidebar">
	<h2>中心导航</h2>
	<dl>
		<dt>帐号管理</dt>
		<dd><a href="member.php">个人信息</a></dd>
		<dd><a href="business_modify.php">修改资料</a></dd>
	</dl>
<?php 
if(!!$rows=_fetch_array("select t_level from t_user
		where t_username='{$_COOKIE['username']}'")){
		$level=array();
		$level['level']=$rows['t_level'];

}
if($level['level'] == 1){
echo '<dl>
		<dt>信息中心</dt>
		<dd><a href="business_message.php">我的信息</a></dd>
		<dd><a href="system_message.php">系统通告</a></dd>
</dl>

	<dl>
		<dt>订单管理</dt>
		<dd><a href="order_all.php">我的订单</a></dd>
		<dd><a href="order_not_pay.php">待付款订单</a></dd>
		<dd><a href="order_pay.php">已付款订单</a></dd>

	</dl>';
			}

?>
</div>