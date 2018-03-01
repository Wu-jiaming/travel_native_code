<?php 
session_start();
define('IN_TG',true);
define('SCRIPT','main');
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


<div id="scenic_spot">
	<h2>推荐景点</h2>
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
					<div id ="spot_1">
					<h2>推荐景点<?php echo $num?></h2>
					<a href="scence_detail.php?id=<?php echo $photo['id']?>">
							<img src="thumb.php?filename=<?php echo $photo['url']?>&percent=1" alt="<?php echo $photo['name']?>" />
									</a>
									<p><?php echo $photo['content']?></p>
									<span><?php echo $photo['price']?></span>
						</div>
		
	<?php }?>
</div>

<div id="article">
	<h2>有关景点文章阅读区</h2>
	<dl>
		<?php while(!!$rows = _fetch_array_list($articles)){
							$article = array();
							$article['id'] = _html($rows['t_id']); 
							$article['title'] = _html($rows['t_title']);
		?>
		<dd><a href="article.php?id=<?php echo$article['id']?>">·<?php echo $article['title']?></a></dd>
		<?php }?>
	</dl>
</div>
	<?php 
		require ROOT_PATH.'/include/footer.inc.php';
	?>
</body>  
</html> 