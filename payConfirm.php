<?php 
define('IN_TG',true);
define('SCRIPT','pay');
require dirname(__FILE__).'/include/common.inc.php';//dirname(__FILE__)=文件所在层的目录名

	if(!isset($_COOKIE['username'])){
		_alert_back('会员必须先登陆');
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
<?php 
require ROOT_PATH.'include/header.inc.php';
?>
<?php
include 'common.php';
// 这里我们获取用户提交的信息

// 1.获取订单号
$p0_Cmd = "Buy";
$p1_MerId = "10001126856";
$p2_Order = $_REQUEST['p2_Order'];
$p3_Amt = $_REQUEST['p3_Amt'];
$p4_Cur = "CNY";
// 商品名称
$p5_Pid = "";
$p6_Pcat = ""; // 商品种类
$p7_Pdesc = ""; // 商品介绍
// 只是易宝支付成功后，给url返回信息
$p8_Url = "http://loaclhost/FUCKPHP/onlinezhifu/res.php";
$p9_SAF = "0"; // 送货地址
$pa_MP = ""; // 额外介绍
$pd_FrpId = $_REQUEST['pd_FrpId']; // 支付通道
$pr_NeedResponse = "1"; // 应答机制
// 我们把请求参数一个一个拼接(拼接的时候，顺序很重要!!)
$data="";
$data=$data.$p0_Cmd;
$data=$data.$p1_MerId;
$data=$data.$p2_Order;
$data=$data.$p3_Amt;
$data=$data.$p4_Cur;
$data=$data.$p5_Pid;
$data=$data.$p6_Pcat;
$data=$data.$p7_Pdesc;
$data=$data.$p8_Url;
$data=$data.$p9_SAF;
$data=$data.$pa_MP;
$data=$data.$pd_FrpId;
$data=$data.$pr_NeedResponse;

$merchantKey ="69cl522AV6q613Ii4W6u8K6XuW8vM1N6bFgyv769220IuYe9u37N4y7rI4Pl";
// hmac是签名串，是用于易宝和商家互相确认的关键字
// 这里我们需要使用算法来生成(md5-hmac算法)
$hmac = HmacMd5($data,$merchantKey);
?>
你的订单号是:<?php echo $p2_Order;  ?>支付的金额是<?php echo $p3_Amt; ?>
<!-- 把要提交的数据用隐藏域表示 -->
<form action="https://www.yeepay.com/app-merchant-proxy/node" method="post">
    <input type="hidden" name="p0_Cmd" value="<?php echo $p0_Cmd; ?>"/>
    <input type="hidden" name="p1_MerId" value="<?php echo $p1_MerId; ?>"/>
    <input type="hidden" name="p2_Order" value="<?php echo $p2_Order; ?>"/>
    <input type="hidden" name="p3_Amt" value="<?php echo $p3_Amt; ?>"/>
    <input type="hidden" name="p4_Cur" value="<?php echo $p4_Cur; ?>"/>
    <input type="hidden" name="p5_Pid" value="<?php echo $p5_Pid; ?>"/>
    <input type="hidden" name="p6_Pcat" value="<?php echo $p6_Pcat; ?>"/>
    <input type="hidden" name="p7_Pdesc" value="<?php echo $p7_Pdesc; ?>"/>
    <input type="hidden" name="p8_Url" value="<?php echo $p8_Url; ?>"/>
    <input type="hidden" name="p9_SAF" value="<?php echo $p9_SAF; ?>"/>
    <input type="hidden" name="pa_MP" value="<?php echo $pa_MP; ?>"/>
    <input type="hidden" name="pd_FrpId" value="<?php echo $pd_FrpId; ?>"/>
    <input type="hidden" name="pr_NeedResponse" value="<?php echo $pr_NeedResponse; ?>"/>
    <input type="hidden" name="hmac" value="<?php echo $hmac; ?>"/>
    <input type="submit" value="确认网上支付"/>
</form>
<?php require ROOT_PATH.'include/footer.inc.php';?>
</html>

