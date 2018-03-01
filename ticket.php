<?php 
session_start();
define('IN_TG',true);
define('SCRIPT','model');
require dirname(__FILE__).'/include/common.inc.php';
$html=array();
$articles = _query("select t_id,t_title,t_content
									from t_article");
$photos=_query("select t_id,t_photo_url ,t_cityname,
												   t_scence_name ,t_price ,
															t_scence_content 
																from t_scence_ticket");


if(isset($_GET['action'])){
	if($_GET['action'] == 'select'){
		$photos = _query("select * from t_photo where t_cityname like '%{$_POST['search']}%' or t_name like '%{$_POST['search']}%' ");
	}
	
}
//获取ip城市
function getIpAddress(){
	$ipContent  = @file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js");
	$jsonData = explode("=",$ipContent);
	$jsonAddress = substr($jsonData[1], 0, -1);
	return $jsonAddress;
}
$ip_info=json_decode(getIpAddress(),true);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  

<?php
//把标题，basic.css,main.css
require ROOT_PATH.'/include/title.inc.php';

?>  
<script type="text/javascript" src="js/blog.js"></script>
</head>  
<body>
<?php 
require ROOT_PATH.'include/header.inc.php';
require ROOT_PATH.'include/navigator.inc.php';
?>
<div class="zy_hui">
		<div class="zy_mod green"> 
				<div class="title">
						<span><i class="icon_gps1"></i>周边热门</span><a href="scence_ticket?place=1" class="more">更多&gt;</a>		
				</div>			
				<div class="right_img"> 			
	<?php while(!!$rows=_fetch_array_list($photos)){
					$photo = array();
					$photo['id'] = _html($rows['t_id']);
					$photo['cityname'] = _html($rows['t_cityname']);
					$photo['url'] = _html($rows['t_photo_url']);
					$photo['name'] = _html($rows['t_scence_name']);
					$photo['content'] = _html($rows['t_scence_content']);
					$photo['price'] =  _html($rows['t_price']);
					$num=$num+1;
	?>
							
							  <a href="ticket_detail.php?id=<?php echo $photo['id']?>" target="_blank" title="<?php echo $photo['content']?>" > 
							  <img src="<?php echo $photo['url']?>" alt="<?php echo $photo['content']?>" />
							   <p><?php echo $photo['content']?></p> 
						<div class="money">   
								<span>￥<b><?php echo $photo['price']?></b>起</span> 
								<font class="icon_sheng"><i></i>110</font>   
						</div>
						
						
					<?php }?>
					
	</div></div>
	

	<?php 
		require ROOT_PATH.'/include/footer.inc.php';
	?>
</body>  
</html> 