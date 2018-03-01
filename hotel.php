<?php 
session_start();
define('IN_TG',true);
define('SCRIPT','model');
require dirname(__FILE__).'/include/common.inc.php';
$html=array();
$articles = _query("select t_id,t_title,t_content
									from t_article");
$photos=_query("select t_id,t_photo_url ,t_cityname,
												   t_hotel_name ,t_price ,
															t_content 
																from t_hotel");


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

											
											<div class="main banner"style="border:solid 1px #ccc">
        <div class="m_l banner_left clearfix" >

            <div class="hotel_search mt20">
             <form action="" method="post" id="search-from">    <!-- 调用SO库 -->
             <ul>
             <li>
                            <span class="text">入住城市</span>
                            <input type="hidden" class="text index_city_en" name="city_en" value="beijing" />
                            <input type="text" class="ipt_text" placeholder="中文/拼音" id="city" name="from_city" value="北京" autocomplete="off"/>
                            <div id='suggest' class="ac_results"></div>
                            <div class="tanchu">
             <div class="tc_title"><strong>热门城市</strong><span>(仅供选择)</span><a class="tc_close cancel_pop" href="#?" method="close" title="关闭"></a></div>
    <div class="tc_tag">
                            <a href="#?" class="on cancel_pop">北京</a>
                            <a href="#?" class="cancel_pop">上海</a>
                            <a href="#?" class="cancel_pop">深圳</a>
                            <a href="#?" class="cancel_pop">广州</a>
                            <a href="#?" class="cancel_pop">珠海</a>
                            <a href="#?" class="cancel_pop">西安</a>
              </div>
              <div class="tc_con">
       
              </div>
              </div>                        
			  </li>
                        <li>
                            <br><span class="text">入住日期</span>
                            <input type="text" class="ipt_text" placeholder="yy-mm-dd" onFocus="var checkOutDate=$dp.$('checkOutDate');WdatePicker({onpicked:function(){checkOutDate.focus();},doubleCalendar:true,dateFmt:'yyyy-MM-dd',minDate:'%y-%M-%d'});" id="checkInDate" name="checkInDate" value="2017-11-19"readonly/>
                            <i class="icon ico_calendar_1"></i>
                        </li>
                        <li>
                            <br><span class="text">退房日期</span>
                            <input type="text" class="ipt_text" placeholder="yy-mm-dd" onFocus="WdatePicker({onpicked:function(){checkOutDate.blur();},doubleCalendar:true,dateFmt:'yyyy-MM-dd',minDate:'#F{$dp.$D(\'checkInDate\',{d:1})}',maxDate:'#F{$dp.$D(\'checkInDate\',{d:20});}'})" id="checkOutDate" name="checkOutDate" value="2017-11-20" readonly/>
                           <i class="icon ico_calendar_2"></i>
                        </li>
						<br>酒店级别：<select name="不限"id="不限"disable=true> 
						  <option value="五星级">五星级</option>
						  <option value="四星级">四星级</option>
						  <option value="三星级">三星级</option> 
						  <option value="普通酒店">普通酒店</option>
						  <option value="小旅馆">小旅馆</option> 
						  </select>
                        <li>
                          <span class="text">关键词</span>
                          <input type="text" class="ipt_text" id="address" name="q" placeholder="酒店名/品牌/地标/商圈"/>
                          <div class="tanchu" id="tanchu_address">
                           <a class="tc_close" href="#?" method="close" title="关闭"></a>
                           <div class="tc_con1 child-noborder"></div>
                        </div>
                        </li>
                        <li class="btn_box">
                          <input class="btn_search" type="submit" value="立即搜索"/>
                        </li>
                    </ul>
                </form>
            </div>
     

           <script src="http://s1.cncnimg.cn/js/My97DatePicker/WdatePicker.js"></script>
                       
                       <div class="footer">
                      </div>
                     </div>

<div class="zy_hui">
		<div class="zy_mod green"> 
				<div class="title">
						<span><i class="icon_gps1"></i>热门酒店</span><a href="hotel?place=1" class="more">更多&gt;</a>		
				</div>			
				<div class="right_img"> 			
	<?php while(!!$rows=_fetch_array_list($photos)){
					$photo = array();
					$photo['id'] = _html($rows['t_id']);
					$photo['cityname'] = _html($rows['t_cityname']);
					$photo['url'] = _html($rows['t_photo_url']);
					$photo['name'] = _html($rows['t_name']);
					$photo['content'] = _html($rows['t_content']);
					$photo['price'] =  _html($rows['t_price']);
					$num=$num+1;
	?>
							
							  <a href="hotel_detail.php?id=<?php echo $photo['id']?>" target="_blank" title="<?php echo $photo['content']?>" > 
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