<?php
session_start();
define('IN_TG',true);
define('SCRIPT','business_message');
require dirname(__FILE__).'/include/common.inc.php';
if (!isset($_COOKIE['username'])){
	_alert_back('请先登录');
}
if(!!$rows=_fetch_array("select t_level from t_user
		where t_username='{$_COOKIE['username']}'")){
		$level=array();
		$level['level']=$rows['t_level'];

}
//批删除
if ($_GET['action']=='delete' && isset($_POST['ids'])){
	$clean=array();
	$clean['ids']=_mysql_string(implode(',', $_POST['ids']));
	//检验cookie
	if (!! $rows=_fetch_array("SELECT t_uniqid ,t_level
											FROM  t_user 
										WHERE t_username='{$_COOKIE['username']}'
									LIMIT 1
			
			")){
		
			_query("DELETE FROM  t_message
						WHERE t_id IN ({$clean['ids']})
					");
			if (_affect_rows()){
				_close();
				_location('信息批量删除成功', 'message.php');
			}else{
				_close();
				_location('信息批量删除失败');
			}
	}else {
		_alert_back('检测没有找到t_uniqid非法登录');
	}
}
global  $pagesize,$pagenum;
_page("SELECT t_id FROM t_message WHERE t_touser='{$_COOKIE['username']}'",15);
$result=_query("SELECT t_id,t_status,t_time,t_content
									FROM t_system_message
								
											ORDER BY t_time DESC
												LIMIT $pagenum,$pagesize
													
		
		");

//发布公告
if($_GET['action'] == 'system_message_up'){
	
	if (!!$rows=_fetch_array("SELECT t_uniqid
			FROM t_user
			WHERE
			t_username='{$_COOKIE['username']}'
			LIMIT 1"))
	{
		_uniqid($_COOKIE['uniqid'], $rows['t_uniqid']);
		
	$clean['system_message'] = $_POST['system_message'];
	$clean['username'] = $_COOKIE['username'];
	
	_query("insert into t_system_message (t_content,t_admin_name,t_time)
							values('{$clean['system_message']}','{$clean['username']}',
											now())");
		if (_affect_rows() ==1){
			_close();
			//_session_destroy();
			_location('发布通告成功','system_message.php');
		}else{
			_close();
			//_session_destroy();
			_alert_back('发布通告失败');
		}
	}else{
		_alert_back('无法获取unqiid');
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

<script type="text/javascript" src="js/business_message.js"></script>
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
					<h2>系统通告</h2>
					<form method="post" action="?action=delete">
					<table cellspacing="1">
						<tr><th>信息内容</th><th>时间</th><th>状态</th><th>操作</th></tr>
						
						<?php 
						$html=array();
								while (!!$rows=_fetch_array_list($result)){
									
									$html['t_id']=$rows['t_id'];
									
									
									$html['t_content']=$rows['t_content'];
									$html['t_touser']=$_COOKIE['username'];
									$html['t_time']=$rows['t_time'];
									$html=_html($html);
									if(empty($rows['t_status'])){
										$html['t_status']='<img src="image/noread.gif" alt="未读" title="未读"';
										$html['strong_t_content']='<strong>'._title($html['t_content'],14).'</strong>';
									}	else{
										$html['t_status']='<img src="image/read.gif" alt="已读" title="已读"';
										$html['strong_t_content']=_title($html['t_content'],14);
									}
								
								
								?>
						<tr>
								<td><a href="message_detail.php?id=<?php echo $html['t_id']?>" 
														title="<?php echo $html['t_content']?>"> 
										<?php echo $html['strong_t_content']?></a></td>
								<td><?php echo $html['t_time']?></td>
								<td><?php  echo $html['t_status'];?></td>
								<td><input name="ids[]" value="<?php  echo $html['t_id']?>" type="checkbox" /></td></tr>		
						
						<?php }	
							_free_result($result);
						?>
						
						<tr><td colspan="5"><label for="all">全选 <input type="checkbox" name="chkall" id="all" /></label> 
								<input type="submit" value="批删除" /></td></tr>
					</table>
					</form>
						<?php _type(1);?>
						<?php if($level['level'] == 3){
						
						
						
						?>
						
						<form method="post" action="?action=system_message_up">
						<dl>
						<dd>通告</dd>
						<dd><textarea name="system_message" rows="" cols=""></textarea></dd>
						<dd><input type="submit" name="submit" value="发布通告" ></input></dd>
						</dl>
						</form>
						<?php }?>
				</div>

</div>
<?php require ROOT_PATH.'include/footer.inc.php'; ?>
</body>  
</html>   	