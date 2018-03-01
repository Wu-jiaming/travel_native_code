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
	if($level['level'] == '3'){
		if (!! $rows=_fetch_array("SELECT t_uniqid ,t_level
				FROM  t_user
				
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
	}else{
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

}
global  $pagesize,$pagenum;
_page("SELECT t_id FROM t_pay WHERE t_business_name='{$_COOKIE['username']}' and  t_pay_status='1'",15);
$result=_query("SELECT t_id,t_total_price,t_pay_status,t_pay_time,
								t_username,t_scence_name,t_menu_content,
									t_scence_id,t_business_name,t_adult,t_child
										FROM t_pay
											where t_pay_status='1'
								
											ORDER BY t_pay_time DESC
												LIMIT $pagenum,$pagesize
													
		
		");
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
					<h2>已付款订单</h2>
					<form method="post" action="?action=delete">
					<table cellspacing="1">
						<tr><th>套餐id</th><th>价格</th><th>人数</th><th>套餐内容</th><th>下单时间</th><th>下单会员</th><th>浏览</th><th>操作</th></tr>
						
						<?php 
						$html=array();
								while (!!$rows=_fetch_array_list($result)){
									
									$html['scence_id']=$rows['t_scence_id'];
									$html['price']=$rows['t_total_price'];
									$html['adult']=$rows['t_adult'];
									$html['child']=$rows['t_child'];
									$html['menu_content']=$rows['t_menu_content'];
									$html['pay_time']=$rows['t_pay_time'];
									$html['username']=$rows['t_username'];
									
									$html=_html($html);
									if(empty($rows['t_status'])){
										$html['t_status']='<img src="image/noread.gif" alt="未读" title="未读"';
										$html['strong_t_content']='<strong>'._title($html['menu_content'],5).'</strong>';
									}	else{
										$html['t_status']='<img src="image/read.gif" alt="已读" title="已读"';
										$html['strong_t_content']=_title($html['menu_content'],5);
									}
								
								
								?>
						<tr>

								<td><?php echo $html['scence_id']?></td>
								<td>￥<?php echo $html['price']?></td>
								<td><?php  echo $html['adult'];?>个成人+<?php  echo $html['child'];?>个儿童</td>
								<td><a href="message_detail.php?id=<?php echo $html['scence_id']?>" 
														title="<?php echo $html['content']?>"> 
										<?php echo $html['strong_t_content']?></a></td>
								<td><?php echo $html['pay_time']?></td>
								<td><?php echo $html['username']?></td>
								<td><?php echo $html['t_status']?></td>
								
								<td><input name="ids[]" value="<?php  echo $html['t_id']?>" type="checkbox" /></td></tr>		
						
						<?php }	
							_free_result($result);
						?>
						
						<tr><td colspan="8"><label for="all">全选 <input type="checkbox" name="chkall" id="all" /></label> 
								<input type="submit" value="批删除" /></td></tr>
					</table>
					</form>
						<?php _type(1);?>
				</div>

</div>
<?php require ROOT_PATH.'include/footer.inc.php'; ?>
</body>  
</html>   	