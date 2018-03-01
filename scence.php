<?php

session_start();
define('IN_TG',true);
define('SCRIPT','model');
require dirname(__FILE__).'/include/common.inc.php';//dirname(__FILE__)=文件所在层的目录名
if($_GET['place']==1){
	$photos=_query("select t_id,t_url ,t_cityname,
												   t_name ,t_price ,
															t_content
																from t_photo where t_type='0'");
	$place='周边热门';
}elseif ($_GET['place']==2){
	$photos=_query("select t_id,t_url ,t_cityname,
												   t_name ,t_price ,
															t_content
																from t_photo where t_type='1'");
	$place='国内热门';
	
}elseif ($_GET['place']==3){
	$photos=_query("select t_id,t_url ,t_cityname,
												   t_name ,t_price ,
															t_content
																from t_photo where t_type='2'");
	$place='境外热门';
	
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
<?php require ROOT_PATH.'include/header.inc.php'; 
require ROOT_PATH.'include/navigator.inc.php';
?>

<div class="zy_hui">
		<div class="zy_mod green"> 
				<div class="title">
						<span><i class="icon_gps1"></i><?php echo $place?></span>
				</div>			
				<div class="right_img"> 			
	<?php while(!!$rows=_fetch_array_list($photos)){
					$photo = array();
					$photo['id'] = _html($rows['t_id']);
					$photo['cityname'] = _html($rows['t_cityname']);
					$photo['url'] = _html($rows['t_url']);
					$photo['name'] = _html($rows['t_name']);
					$photo['content'] = _html($rows['t_content']);
					$photo['price'] =  _html($rows['t_price']);
					$num=$num+1;
	?>
							
							  <a href="scence_detail.php?id=<?php echo $photo['id']?>" target="_blank" title="<?php echo $photo['content']?>" > 
							  <img src="<?php echo $photo['url']?>" alt="<?php echo $photo['content']?>" />
							   <p><?php echo $photo['content']?></p> 
						<div class="money">   
								<span>￥<b><?php echo $photo['price']?></b>起</span> 
								<font class="icon_sheng"><i></i>110</font>   
						</div>
					<?php }?>
	</div></div>


		
<?php require ROOT_PATH.'include/footer.inc.php'; ?>
</body>  
</html>