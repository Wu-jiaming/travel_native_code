<?php
session_start();
define('IN_TG',true);
define('SCRIPT','article');
require dirname(__FILE__).'/include/common.inc.php';
$article=array();
$article = _fetch_array("select t_title ,t_content as content , t_time as time
										from t_article where t_id = '{$_GET['id']}'");

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
<div id="article">
	<h3><?php echo $article['t_title']?></h3>
		<p><?php echo $article['content']?></p>
</div>
<?php 
		require ROOT_PATH.'/include/footer.inc.php';
?>
</body>
</html>