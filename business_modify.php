<?php 
session_start();
define('IN_TG',true);
define('SCRIPT','business_modify');
require dirname(__FILE__).'/include/common.inc.php';
//修改资料
if($_GET['action']=='business_modify'){
	_check_yzm($_POST['yzm'], $_SESSION['code']);
	if (!!$_rows = _fetch_array("SELECT 
																t_uniqid 
													FROM 
																t_user 
												 WHERE 
																t_username='{$_COOKIE['username']}' 
													 LIMIT 
																1"
		)) {
		//为了防止cookies伪造，还要比对一下唯一标识符uniqid()
		_uniqid($_rows['t_uniqid'],$_COOKIE['uniqid']);
		include ROOT_PATH.'/include/check.func.php';
		$clean=array();
		
		$clean['password']=_check_modify_password($_POST['password'],6,40);
		$clean['sex']=_check_sex($_POST['sex']);
		$clean['face']=_check_face($_POST['face']);
		$clean['email']=_check_email($_POST['email'],40);
		$clean['phone'] = _check_phone($_POST['phone'],11);

		if(empty($clean['password'])){
		
			_query("UPDATE t_user SET
					t_sex='{$clean['sex']}',
					t_face='{$clean['face']}',
					t_email='{$clean['email']}',
					t_phone='{$clean['phone']}'
					WHERE t_username ='{$_COOKIE['username']}'
					");
		}else {
			_query("UPDATE t_user SET
					t_password='{$clean['password']}',
					t_sex='{$clean['sex']}',
					t_face='{$clean['face']}',
					t_email='{$clean['email']}',
					t_phone='{$clean['phone']}'
					WHERE t_username ='{$_COOKIE['username']}'
					");
				
		}
	}
	
	
	if(_affect_rows() == 1){
			_close();
			//_session_destroy();
			_location('恭喜你，修改成功', 'business.php');
	}else{
		
		_close();
		//_session_destroy();
 		_location('很遗憾，没有任何数据被修改', 'business_modify.php');
	}
}
//检查是否正常登陆
if(isset($_COOKIE['username'])){
	$rows=_fetch_array("SELECT t_username,
														t_sex,t_face,
														t_email,t_phone
										FROM t_user WHERE 
											t_username='{$_COOKIE['username']}'");
	if($rows){
		$html=array();
		$html['username']=$rows['t_username'];
		$html['sex']=$rows['t_sex'];
		$html['face']=$rows['t_face'];
		$html['email']=$rows['t_email'];
		$html['phone']=$rows['t_phone'];

		$html = _html($html);
		//性别选择
		if($html['sex']=='男'){
			$html['sex_html']='<input type="radio" name="sex" value="男" checked="checked" /> 男 <input type="radio" name="sex" value="女" /> 女';
			
		}else{
			$html['sex_html']='<input type="radio" name="sex" value="男" /> 男 <input type="radio" name="sex" value="女" checked="checked" />  女 ';
		}
		

		//头像选择
// 		$html['face_html']='<select name="face">';
// 		foreach (range(1, 9 ) as  $num){
// 			$html['face_html'].='<option value="face/m0'.$num.'.gif">face/m0'.$num.'.gif</option>';
// 		}
// 		foreach (range(10, 64) as $num){
// 			$html['face_html'].='<option value ="face/m'.$num.'.gif">face/m0'.$num.'.gif</option>';
// 		}
// 		$html['face_html'] .='</select>';
	}else{
		_alert_back('用户不存在');
	}
	
}
else{
	_alert_back('非法登陆');
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
<script type="text/javascript" src="js/business_modify.js"></script>
</head>  
<body>
<?php 
require ROOT_PATH.'include/header.inc.php';
?>

<div id="business">


<?php 
	require ROOT_PATH.'/include/member.inc.php';
?>

	<div id="business_main">
	
		<h2>会员管理中心</h2>
		<form method="post" name="business_modify" action ="?action=business_modify">
			<dl>
				<dd>用 户 名：<?php echo $html['username']?></dd>
				<dd>密　　码：<input type ="password" class="text" name="password"/>(留空则密码不修改) </dd>
				<dd>性　　别：<?php  echo $html['sex_html']?></dd>
				<dd class="face"><input type="text" name="face" value="<?php  echo $html['face']?>" /><img src="<?php  echo $html['face']?>" alt="头像选择" id="faceimg" /></dd>
				<dd>电子邮件：<input type="text" class="text" name="email" value="<?php echo $html['email']?>"/></dd>
				<dd>电话号码：<input type="text" class="text" name="phone" value="<?php echo $html['phone']?>"/></dd>
			
				<dd>验 证 	码：<input type="text" name="yzm" class="yzm" /><img src="code.php" id="code"/></dd>
				<dd><input type ="submit" class="submit" value="完成修改" /></dd>
			</dl>
			</form>
	</div>
</div>

<?php 
		require ROOT_PATH.'/include/footer.inc.php';
?>
</body>  
</html> 	