<?php 
session_start();
define('IN_TG',true);
define('SCRIPT','model');
require dirname(__FILE__).'/include/common.inc.php';
$html=array();
$articles = _query("select t_id,t_title,t_content
									from t_article");
$photos=_query("select t_id,t_url ,t_cityname,
												   t_name ,t_price ,
															t_content 
																from t_photo");


if(isset($_GET['action'])){
	if($_GET['action'] == 'select'){
		$photos = _query("select * from t_photo where t_cityname like '%{$_POST['search']}%' or t_name like '%{$_POST['search']}%' ");
	}
	
}
//读取xml文件
$html=_html(_get_xml('new.xml'));
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
?>
<div id ="select">
	<ul>
		<li><a href="hotel.php" title="酒店">酒店</a></li>
		<li><a href="travel.php" title="旅游">旅游</a></li>
		<li><a href="airplane.php" title="机票">机票</a></li>
		<li><a href="train.php" title="火车票">火车票</a></li>
		<li><a href="bus.php" title="汽车票">汽车票</a></li>
		<li><a href="car.php" title="用车">用车</a></li>
		<li><a href="ticket.php" title="门票">门票</a></li>
	</ul>
	
	<form id="search" method = "post" action="?action=select">
		<dl>
		<dd>
			<input type="text" name="search" placeholder="城市/景点/酒店"  class="text" />
					<input type="submit" value="搜索" class="submit"/>
			</dd>
		</dl>
	
	</form>
</div>


<div class="zy_hui">
		<div class="zy_mod green"> 
				<div class="title">
						<span><i class="icon_gps1"></i>周边热门</span><a href="/beijing/zhoubian-t4" class="more">更多&gt;</a></div>
						<div class="right_img"> 
						
	<?php $num=0;?>
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

							  <a href="http://" target="_blank" title="<?php echo $photo['content']?>" > 
							  <img src="<?php echo $photo['url']?>" alt="<?php echo $photo['content']?>" />
							   <p><?php echo $photo['content']?></p> 
						<div class="money">   
								<span>￥<b><?php echo $photo['price']?></b>起</span> 
								<font class="icon_sheng"><i></i>110</font>   
					<?php }?>
</div></div></div>
				 <div class="zt_bai">
				 		<div class="zy_mod orange">
				 				<div class="title">
				 						<span><i class="icon_ditu"></i>国内热门</span>
				 						<a href="/beijing/guonei-t4" class="more">更多&gt;</a>
		 						</div>
		 						<div class="right_img"> 
		 							<?php $num=0;?>
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

							  <a href="http://" target="_blank" title="<?php echo $photo['content']?>" > 
							  <img src="<?php echo $photo['url']?>" alt="<?php echo $photo['content']?>" />
							   <p><?php echo $photo['content']?></p> 
						<div class="money">   
								<span>￥<b><?php echo $photo['price']?></b>起</span> 
								<font class="icon_sheng"><i></i>110</font>   
					<?php }?>
					
									</div></div></div>
								
	<div class="zy_hui">
				<div class="zy_mod blue">
							<div class="title">
										<span><i class="icon_feiji"></i>境外热门</span>
										<a href="/beijing/chujing-t4" class="more">更多&gt;</a>
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

							  <a href="http://" target="_blank" title="<?php echo $photo['content']?>" > 
							  <img src="<?php echo $photo['url']?>" alt="<?php echo $photo['content']?>" />
							   <p><?php echo $photo['content']?></p> 
						<div class="money">   
								<span>￥<b><?php echo $photo['price']?></b>起</span> 
								<font class="icon_sheng"><i></i>110</font>   
					<?php }?>
									</div></div></div>
									
									
		<div class="zy_mod min"> <div class="title hui"><span><i class="icon_txt"></i>旅游攻略</span><a href="/guide/" class="more">更多&gt;</a></div><ul class="list">
													
													
													
												<li> <a class="img" href="http:" title="北京周边旅游攻略">
										 <img src="zi_29.jpg" /><div> <p class="t">北京旅游攻略</p> <p class="num">共计4699篇攻略</p>
									 <p class="go">去看看</p></div></a> <p class="con">八大古都之一 位于华北平原北部</p>
									 <p class="down">北京攻略<a target="_blank" href="http://" title="北京旅游攻略">下载PDF</a></p> 
								  <p class="down">颐和园攻略<a target="_blank" href="http://" title="颐和园旅游攻略">下载PDF</a></p> </li>
								  
								  
								   <li> <a class="img" href="http://" title="厦门周边旅游攻略"> 
								   <img src="zi_30.jpg" /><div>
								    <p class="t">厦门旅游攻略</p> <p class="num">共计2880篇攻略</p><p class="go">去看看</p></div></a>
									 <p class="con">东方夏威夷 位于福建省东南端</p>
									  <p class="down">鼓浪屿攻略<a target="_blank" href="http://" title="鼓浪屿旅游攻略">下载PDF</a></p>
									   <p class="down">厦门攻略<a target="_blank" href="http://" title="厦门旅游攻略">下载PDF</a></p> </li>
													
													</ul></div>
	<?php 
		require ROOT_PATH.'/include/footer.inc.php';
	?>
</body>  
</html> 