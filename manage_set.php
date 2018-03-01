<?php 
session_start();
define('IN_TG',true);
define('SCRIPT','manage_set');
require dirname(__FILE__).'/include/common.inc.php';
//检查是否正常登陆
_manage_login();

//修改系统表
if ($_GET['action'] == 'set'){
	if(!!$rows = _fetch_array("SELECT t_uniqid
										FROM t_user
								WHERE t_username='{$_COOKIE['username']}'
											LIMIT 1
	")){
		_uniqid($rows['t_uniqid'], $_COOKIE['uniqid']);
		$clean= array();
		$clean['webname'] = $_POST['webname'];
		$clean['article'] = $_POST['article'];

		$clean['skin'] = $_POST['skin'];

		$clean['code'] = $_POST['code'];
		$clean['register'] = $_POST['register'];
		$clean['illegal_string'] = $_POST['illegal_string'];
		$clean = _mysql_string($clean);
		
		//写入数据库
		_query("UPDATE t_system 
								SET t_webname='{$clean['webname']}',
										t_article='{$clean['article']}',

										t_skin='{$clean['skin']}',


										t_code='{$clean['code']}',
										t_register='{$clean['register']}',
										t_string='{$clean['illegal_string']}'
								WHERE t_id =1
										LIMIT 1");
		
		if (_affect_rows() ==1){
			_close();
			_location('恭喜你，修改成功', 'manage_set.php');
		}else{
			_close();
			_location('很遗憾，没有数据被修改', 'manage_set.php');
		}
	}else{
		_alert_back('异常，登录的用户在数据库中找不到');
	}
}

//取出系统表
if (!!$rows = _fetch_array("select t_webname,
															t_article,

															t_skin,
															t_illegal_string,

															t_code,
															t_register
								FROM  t_system
					WHERE t_id=1
							LIMIT 1")){
	$html=array();
	$html['webname'] = $rows['t_webname'];
	$html['article'] = $rows['t_article'];
	$html['skin'] = $rows['t_skin'];
	$html['illegal_string'] = $rows['t_illegal_string'];
	$html['code'] = $rows['t_code'];
	$html['register'] = $rows['t_register'];
	$html=_html($html);
	
	//文章
	if ($html['article'] == 10){
		$html['article_html'] = '<select name="article"><option value="10" selected="selected">每页10篇</option><option value="15">每页15篇</option></select>';
	}elseif($html['article'] == 15){
		$html['article_html']='<select name="article"><option value="10">每篇10篇</option><option value="15" selected="selected">每页15篇</option></select>';
	}

   

    

   

   //皮肤
   if ($html['skin'] == 1) {
   	$html['skin_html'] = '<select name="skin"><option value="1" selected="selected">一号皮肤</option><option value="2">二号皮肤</option><option value="3">三号皮肤</option></select>';
   } elseif ($html['skin'] == 2) {
   	$html['skin_html'] = '<select name="skin"><option value="1">一号皮肤</option><option value="2" selected="selected">二号皮肤</option><option value="3">三号皮肤</option></select>';
   } elseif ($html['skin'] == 3) {
   	$html['skin_html'] = '<select name="skin"><option value="1">一号皮肤</option><option value="2">二号皮肤</option><option value="3" selected="selected">三号皮肤</option></select>';
   }
   


   //验证码
   if ($html['code'] == 1){
   	$html['code_html'] = '<input type="radio" name="code" value="1" checked="checked" />启用<input type="radio" name="code" value="0"/>禁用';
   }elseif ($html['code'] == 0){
   	$html['code_html'] ='<input type="radio" name="code" value="1" />启用<input type="radio" name="code"value="0"  checked="checked"/>禁用';
   }
   
   //放开注册
   if ($html['register'] == 1){
   	$html['register_html'] = '<input type="radio" name="register" value="1" checked="checked" />启用<input type="radio" name="register" value="0" />禁用';
   }elseif ($html['register'] == 0){
   	$html['register_html'] = '<input type="radio" name="register" value="1"/>启用<input type="radio" name="register" value="0"  checked="checked" />禁用';
   }
  
   
   
}else{
	_alert_back('系统表读取错误！请联系管理员检查');
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
<body>
<?php 
require ROOT_PATH.'include/header.inc.php';
?>
<div id="member">
<?php 
	require ROOT_PATH.'/include/manage.inc.php';
?>
	<div id="member_main">
		<h2>后台管理中心</h2>
		<form method="post" action="?action=set">
			<dl>
									<dd>·网 站 名 称：<input type="text" name="webname" value="<?php echo $html['webname'];?>"></input></dd>
					<dd>·文章每页列表数：<?php echo $html['article_html'];?></dd>
					<dd>·站点  默认  皮肤：<?php echo  $html['skin_html'];?></dd>
					<dd>·非法  字符  过滤：<input type="text" name="illegal_string" class="text" value="<?php echo $html['illegal_string']?>"/>(*用|线隔开)</dd>

									<dd>·是否  启用  验证：<?php echo $html['code_html'];?></dd>
									<dd>·是否  开放  注册：<?php echo $html['register_html'];?></dd>
					
					<dd><input type="submit" value="修改系统设置" class="submit" /></dd>
					
			</dl>
			</form>
	</div>
</div>

<?php 
		require ROOT_PATH.'/include/footer.inc.php';
?>
</body>  
</html> 	