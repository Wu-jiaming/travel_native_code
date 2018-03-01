<?php
session_start();
define('IN_TG',true);
define('SCRIPT','menu_tourism_up');
require dirname(__FILE__).'/include/common.inc.php';
if(!!$rows=_fetch_array("select t_level,t_id from t_user
		where t_username='{$_COOKIE['username']}'")){
		$level=array();
		$level['level']=$rows['t_level'];
		$level['id']=$rows['t_id'];

}
if($_GET['action'] == 'menu'){
	$clean = array();
	$clean['scence_name'] = $_POST['scence_name'];
	$clean['cityname']=$_POST['cityname'];
	$clean['longitude']=$_POST['longitude'];
	$clean['latitude']=$_POST['latitude'];
	$clean['content']=$_POST['content'];
	$clean['price']=$_POST['price'];
	$clean['url']=$_POST['url'];
	$clean['introduce']=$_POST['introduce'];
	$clean['route']=$_POST['route'];
	$clean['own_cost']=$_POST['own_cost'];
	$clean['include_cost']=$_POST['include_cost'];
	$clean['limit']=$_POST['limit'];
	
	_query("insert into t_photo 
											(		
												t_name,t_cityname,t_longitude,t_latitude,
													t_content,t_price,t_url,t_introduce,t_route,
														t_own_cost,t_include_cost,t_limit,t_time
											)
							VALUES (
																				'{$clean['scence_name']}','{$clean['cityname']}',
										'{$clean['longitude']}','{$clean['latitude']}','{$clean['content']}',
											'{$clean['price']}','{$clean['url']}','{$clean['introduce']}',
											'{$clean['route']}','{$clean['own_cost']}',
												'{$clean['include_cost']}','{$clean['limit']}',NOW()
											)"
					);
	if(_affect_rows() == 1){
		_close();
		_session_destroy();
		_location('上传成功', 'menu_tourism_all.php');
	}else{
		_close();
		_session_destroy();
		_location('上传失败	', 'menu_tourism_up.php');
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
<script type="text/javascript" src="js/photo_add_img.js"></script>

</head>  
<body>
<?php 
require ROOT_PATH.'include/header.inc.php';
?>
<div id="member">
<?php 

if($level['level'] ==3){
	require ROOT_PATH.'/include/manage.inc.php';
}elseif($level['level'] ==2){
	require ROOT_PATH.'/include/business.inc.php';
}
else{
	require ROOT_PATH.'/include/member.inc.php';
}
?>
<div id="member_main">
	<h2>上传旅游套餐</h2>
	<form  method="post" name="menu" action="menu_tourism_up.php?action=menu">
	<dl>
		<dd><input type="text"  name="scence_name"/>景点名</dd>
		<dd><input type="text" name="cityname"/>所在城市</dd>
		<dd><input type="text"  name="longitude"/>经度</dd>
		<dd><input type="text" name="latitude"/>纬度</dd>
		<dd>旅游景点的安排:</dd><dd><textarea  name="content"></textarea> 如：丽江玉龙雪山+冰川公园大索道经典纯玩一天游</dd>
		<dd><input type="text" name="price"/>价格 如：惊爆价：￥188</dd>
		<dd>图片地址：<input type="text" name="url" id="url" readonly="readonly" class="text"/><a href="javascript:;" title="<?php echo $level['id']?>" id="up">上传</a></dd>
		<dd>套餐介绍:</dd><dd><textarea  name="introduce"></textarea>关于此套餐的介绍</dd>
		<dd>景点路线:</dd><dd><textarea  name="route"></textarea>DAY 1  DAY 2 的安排</dd>
		<dd>自理费用:</dd><dd><textarea  name="own_cost"></textarea></dd>
		<dd>包含费用:</dd><dd><textarea  name="include_cost"></textarea></dd>
		<dd>订票限制:</dd><dd><textarea  name="limit"></textarea></dd>
		<dd><input type="text" name="travel"/>游记</dd>
		<dd><input type="submit" name="submit" value="上传"/></dd>
	</dl>
		
	</form>
	
	
</div>
</div>
<?php require ROOT_PATH.'include/footer.inc.php'; ?>
</body>  
</html>   	