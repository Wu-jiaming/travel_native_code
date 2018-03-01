<?php

session_start();
define('IN_TG',true);
define('SCRIPT','model');
require dirname(__FILE__).'/include/common.inc.php';//dirname(__FILE__)=文件所在层的目录名




if(isset($_GET['action'])){
	if($_GET['action'] == 'select'){
		$photos = _query("select * from t_photo where t_cityname
													like '%{$_POST['search']}%' or t_name like '%{$_POST['search']}%' ");
	}
}
if(isset($_GET['search'])){
	
		$photos = _query("select * from t_photo where t_cityname 
													like '%{$_GET['search']}%' or t_name like '%{$_GET['search']}%' ");
	
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
<div id ="select">
	<ul>
		<li><a href="main.php" title="旅游">旅游</a></li>
		<li><a href="hotel.php" title="酒店">酒店</a></li>
		<li><a href="airplane.php" title="机票">机票</a></li>
		<li><a href="train.php" title="火车票">火车票</a></li>
		<li><a href="bus.php" title="汽车票">汽车票</a></li>
		<li><a href="car.php" title="用车">用车</a></li>
		<li><a href="ticket.php" title="门票">门票</a></li>
	</ul>
	


<div class="more_search"><div class="sos"><div class="text1">
											<font class="icon_gps"></font><strong>北京</strong>
											<div class="hide_box"><div class="line"></div><div class="cf_tag_top">
											<a href="#?" class="on" target="_self">热门出发城市</a></div>
											<div class="cf_tag_con"></div></div></div><div class="text2">
											<i class="icon_fangda"></i>
											<form method="post" action="search?action=select" id="dest_so" target="_self">
											<input type="hidden" name="tn" value="line">
											<input type="hidden" name="city_en" value="beijing">
											<input type="hidden" name="city_id" id="dest_city_id" value="110000">
											<input type="text" placeholder="请输入想去的目的地" id="dest_so_input" name="q" autocomplete="off" x-webkit-speech="" onwebkitspeechchange="webkitspeechchange()" style="color: rgb(170, 170, 170);"> 
											<input type="submit" class="btn" value="马上去" style="cursor:pointer;" onClick="_czc.push(['_trackEvent', 'page_hits', 'line_list', 'so_go', 1]);">
											<div id="dest_smart_arrow" style="height: 35px; left: 539px; top: 222px;">
											<div class="hide"></div></div></form></div><div class="key">热搜：
											<a href="search?search=厦门">厦门</a>
											<a href="search?search=三亚">三亚</a>
											
											<a href="search?search=马尔代夫">马尔代夫</a>
											</div></div></div></div>
											</div>
<div class="zy_hui">
		<div class="zy_mod green"> 
				<div class="title">
						<span><i class="icon_gps1"></i>目的地</span><a href="/beijing/zhoubian-t4" class="more">更多&gt;</a>		
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