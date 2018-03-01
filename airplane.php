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
					</div>

			<div class="main banner" style="border:solid 1px #ccc;">
              <div class="m_l banner_left clearfix">
              <div class="tag_hotel_search">
			  <div class="top_r1" ><img src="mm1.jpg" alt="" width="500" height="250" align="right">    
                </div>
			 <br>
         </div>
      <div class="hotel_search mt20">
              <form action="/so.php" method="post" id="search-from">
                    <ul>
                        <li>
              <span class="text">出发城市</span>
              <input type="hidden" class="text index_city_en" name="city_en" value="beijing" />
              <input type="text" class="ipt_text" placeholder="中文/拼音" id="city" name="from_city" value="北京" autocomplete="off"/>
                  <br>
			  <span class="text">到达城市</span>
              <input type="hidden" class="text index_city_en" name="city_en" value="beijing" />
              <input type="text" class="ipt_text" placeholder="中文/拼音" id="city" name="from_city" value="上海" autocomplete="off"/>
              <div id='suggest' class="ac_results"><br>
              <span class="text">出发日期</span>
              <input type="text" class="ipt_text" placeholder="yy-mm-dd" onFocus="var checkOutDate=$dp.$('checkOutDate');WdatePicker({onpicked:function(){checkOutDate.focus();},doubleCalendar:true,dateFmt:'yyyy-MM-dd',minDate:'%y-%M-%d'});" 
			  id="checkInDate" name="checkInDate" value="2017-11-19"readonly/>

			          </div>
                            </li>
            <li>
               <br>
			   <span class="text">返回日期</span>
               <input type="text" class="ipt_text" placeholder="yy-mm-dd" onFocus="WdatePicker({onpicked:function(){checkOutDate.blur();},doubleCalendar:true,dateFmt:'yyyy-MM-dd',minDate:'#F{$dp.$D(\'checkInDate\',{d:1})}',maxDate:'#F{$dp.$D(\'checkInDate\',{d:20});}'})" id="checkOutDate" name="checkOutDate" value="2017-11-20" readonly/>
               
			<input class="btn_search" type="submit" value="搜索"/>
			</li>
			</ul>
			</form>
	
 <script src="http://s1.cncnimg.cn/js/My97DatePicker/WdatePicker.js"></script>

            
  
</div>
</div>
</div>
	<?php 
		require ROOT_PATH.'/include/footer.inc.php';
	?>
</body>  
</html> 