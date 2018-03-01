<?php
session_start();
define('IN_TG',true);
define('SCRIPT','scence_detail');
require dirname(__FILE__).'/include/common.inc.php';

if (isset($_GET['id']))
		{
			$mark=0;
			if(!!($rows=_fetch_array("select * from t_scence_ticket where t_id='{$_GET['id']}'")))
			{
				$html = array();
				$html['scence_id'] = $rows['t_id']; 
				$html['name'] = $rows['t_hotel_name'];
				$html['cityname'] = $rows['t_cityname'];
				$html['url'] = $rows['t_photo_url'];
				$html['scence_content'] = $rows['t_scence_content'];
				$html['price'] = $rows['t_price'];
				$html['longitude'] = $rows['t_longitude'];
				$html['latitude'] = $rows['t_latitude'];


					if(!!($rows=_fetch_array("select * from t_grade where t_id='{$_GET['id']}'")))
					{
						$grade['total_grade'] = $rows['t_total_grade'];

					}
				//$html =  _html($html);
			}else{
				
			}
			
			if(	($_GET['detail'])=='jieshao'){
				$mark=1;
			}
			if(($_GET['detail'])=='jingdian'){
				$mark=2;
			}
			if(($_GET['detail'])=='tuangou'){
				$mark=3;
			}
			if(($_GET['detail'])=='jiaotong'){
				$mark=4;
			}
			if(($_GET['detail'])=='hotel'){
				$mark=5;
			}
			if(($_GET['detail'])=='comment'){
				$mark=6;


						
				if($_GET['comment'] ==1){

					
						

					_login();
					$clean=array();
					$clean['user_id']=$_POST['user_id'];
					$clean['content']=$_POST['content'];
					$clean['scence_id']=$_GET['id'];
					$clean['star']=$_POST['star'];
					$clean=_mysql_string($clean);
					//写进数据库
					_query("insert into t_comment
										(t_user_id,t_content,t_comment_time,t_scence_id,t_comment_star) 
								values 
										('{$clean['user_id']}','{$clean['content']}',NOW(),'{$clean['scence_id']}','{$clean['star']}')");
					
					

				}
				$result = _query("select * from t_comment
						where t_scence_id='{$_GET['id']}'
						order by t_comment_time ASC
						");
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
<script type="text/javascript" src="js/scence_detail.js"></script>

</head>  
<body>

<?php require ROOT_PATH.'include/header.inc.php'; ?>

<div id="scence">
	<h2>景点详细</h2><h3><?php echo $html['name']?></h3>
		<div id="photo">
			
			<img src="<?php echo $html['url']?>" />
			
		</div>	
		<div id="content">
		<p><?php echo $html['scence_content']?></p><p><?php echo $html['price']?></p>
		</div>
			<div id="pingfen">
				<span><?php $count = _query("select count(*) from t_pay where t_pay_status ='1'")?><?php echo $garde['total_grade']?></span>/5(<?php echo $count['num']?>人出游)
									<p>好  评  率·····<?php echo $grade['good_appraise']?></p>
									
			</div>
			
			<div id ="select">
				<form method="post" action="order.php?action=order&id=<?php echo $_GET['id']?>">
					<dl><?php echo $clean['scence_id']?>
						<dd>入园时间 <select name="year"><option value="2017" selected="selected">2017</option><option value="2018">2018</option><option value="2019">2019</option><option value="2020">2020</option>
														</select>
													年<select name="month"><option value="01" selected="selected">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option>
																									<option value="05" >05</option><option value="2018">06</option><option value="2019">07</option><option value="08">08</option>
																									<option value="09" >09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>
															</select>
													月<select name="day"><option value="01" selected="selected">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option>
																									<option value="05" >05</option><option value="2018">06</option><option value="2019">07</option><option value="08">08</option>
																									<option value="09" >09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>
																									<option value="13" >13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option>
																									<option value="17" >17</option><option value="18">18</option><option value="19">19</option><option value="20">21</option>
																									<option value="21" >21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option>
																									<option value="25" >25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option>
																									<option value="29" >29</option><option value="30">30</option><option value="31">31</option>
														</select>日&nbsp;
										成人票 <select name="adult"><option value="1" selected="selected">1</option><option value="2" >2</option><option value="3" >3</option>
																				<option value="4" >4</option><option value="5" >5</option><option value="6" >6</option><option value="7" >7</option>
																				<option value="8" >8</option><option value="9" >9</option><option value="10" >10</option>
																				</select>	
									
										儿童票 <select name="child"><option value="0" selected="selected">0</option><option value="1" >1</option><option value="2" >2</option><option value="3" >3</option>
										<option value="4" >4</option><option value="5" >5</option><option value="6" >6</option><option value="7" >7</option>
										<option value="8" >8</option><option value="9" >9</option><option value="10" >10</option>
										</select>		

						<input type="submit" value="提交订单" />
						<?php 
							if(!$rows=_fetch_array("select t_id from t_user where t_id =( select  t_business_id from t_hotel where t_id = '{$html['scence_id']}')")){
								echo '<a id="message"  href ="javascript:;" name ="message" title='.$html['id'].'>咨询商家</a>';
							}
							
						?>
						
						</dd>
									
	
	</dl>
			
				
				</form>
			</div>
			
			<div id="mokuai">
				<a href="ticket_detail?id=<?php echo $html['scence_id']?>&detail=jiudian">周边酒店</a>
				<a href="ticket_detail?id=<?php echo $html['scence_id']?>&detail=jingdian">周边景点</a>
				<a href="ticket_detail?id=<?php echo $html['scence_id']?>&detail=tuangou">周边商场</a>
				<a href="ticket_detail?id=<?php echo $html['scence_id']?>&detail=jiaotong">附近交通</a>
				<a href="ticket_detail?id=<?php echo $html['scence_id']?>&detail=comment">查看评论</a>
			</div>

						
				<?php if ($mark == 0){?>
						<div >
								<!--引用百度地图API-->								
					<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.2"></script>				
					地址：<input type="text" name="address" id="address"  placeholder="<?php echo $html['name']?>"/> <button id="mapsearch" onClick="searchAddress()">搜索</button>
					<div style="width:960px;height:400px;border:1px solid gray" id="container"></div>
					<div id="results" style="font-size:13px;margin-top:10px;"></div>
					</body>
					</html>
					<script type="text/javascript">
					 var map = new BMap.Map("container");
					 map.addControl(new BMap.NavigationControl());//创建一个特定样式的地图平移缩放控件
					 map.enableScrollWheelZoom();
					 var lng=<?php echo $html['longitude'] ?>;
					 var lat=<?php echo $html['latitude'] ?>;
					 var point = new BMap.Point(lng,lat);
					
					
					 //在地图首次自动加载的时候以lng=121.5，lat=31.3经纬度显示该地附近的餐馆。
					 allmap(point);
					//一开始显示的地方
					//firstAddress("吉林大学珠海学院");
					 //当点击鼠标左键的时候，获得点击事件，获得点击点经纬度，通过经纬度搜索方圆附近的餐馆。
					 map.addEventListener("click", function(){
					
							  	 map.clearOverlays();//清除由于上次事件留下的痕迹。
								 var center = map.getCenter();//为得到地图的中心点位，返回GLatLng类型的值.
								 lng=center.lng;
								 lat=center.lat;
								 point = new BMap.Point(lng,lat);
							     allmap(point);
					   }
					 );
					
					    function getSquareBounds(centerPoi,r){
					        var a = Math.sqrt(2) * r; //正方形边长
					        mPoi = getMecator(centerPoi);
					        var x0 = mPoi.x, y0 = mPoi.y;
					        var x1 = x0 + a / 2 , y1 = y0 + a / 2;//东北点
					        var x2 = x0 - a / 2 , y2 = y0 - a / 2;//西南点
					
					        var ne = getPoi(new BMap.Pixel(x1, y1)), sw = getPoi(new BMap.Pixel(x2, y2));
					        return new BMap.Bounds(sw, ne);
					    }
					    //根据球面坐标获得平面坐标。
					    function getMecator(poi){
					        return map.getMapType().getProjection().lngLatToPoint(poi);
					    }
					    //根据平面坐标获得球面坐标。
					    function getPoi(mecator){
					        return map.getMapType().getProjection().pointToLngLat(mecator);
					    }
					
					 //根据经纬度这个点，搜索方圆附近所有的餐馆。
					 //strokeWeight圆圈的轨迹线粗细，fillOpacity圆圈的颜色深度
					 function allmap(point){
					  map.centerAndZoom(point,13);
					     var circle = new BMap.Circle(point,1000,{fillColor:"green", strokeWeight: 1 ,fillOpacity: 0.1, strokeOpacity: 0.3});
					     map.addOverlay(circle);
					     var local = new BMap.LocalSearch(map, {
					    																			 renderOptions: {map: map, panel: "results"}
						 																		}
																						);
					     var bounds = getSquareBounds(circle.getCenter(),circle.getRadius());
					     local.searchInBounds("酒店",bounds);//以圆形为范围以餐馆为关键字进行搜索。
					 }
					
					    //获得输入框address的地址，通过地址解析，获得该地址的经纬度。记住该地址只能为上海市地区的位置。
					 function searchAddress(){
					 var address = document.getElementById("address").value;
					 var myGeo = new BMap.Geocoder();//地址解析
					  myGeo.getPoint(address, function(point)
							  {
									 if (point) 
										 {
										 	map.addOverlay(new BMap.Marker(point));
										 	map.clearOverlays();//清除由于上次事件留下的痕迹。
										    allmap(point);
									       }        
						       }, "<?php echo $html['cityname']?>");
					    }
					
					 function firstAddress(first_address){
						
						 var myGeo = new BMap.Geocoder();//地址解析
						  myGeo.getPoint(first_address, function(point)
								  {
										 if (point) 
											 {
											 	map.addOverlay(new BMap.Marker(point));
											 	map.clearOverlays();//清除由于上次事件留下的痕迹。
											    allmap(point);
										       }        
							       }, "中国");
						    }
					</script>
			
			
						</div>
		<?php }elseif ($mark == 2){?>
		
						<div >
							
							<!--引用百度地图API-->								
					<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.2"></script>				
					地址：<input type="text" name="address" id="address"  placeholder="<?php echo $html['name']?>"/> <button id="mapsearch" onClick="searchAddress()">搜索</button>
					<div style="width:960px;height:400px;border:1px solid gray" id="container"></div>
					<div id="results" style="font-size:13px;margin-top:10px;"></div>
					</body>
					</html>
					<script type="text/javascript">
					 var map = new BMap.Map("container");
					 map.addControl(new BMap.NavigationControl());//创建一个特定样式的地图平移缩放控件
					 map.enableScrollWheelZoom();
					 var lng=<?php echo $html['longitude'] ?>;
					 var lat=<?php echo $html['latitude'] ?>;
					 var point = new BMap.Point(lng,lat);
					
					
					 //在地图首次自动加载的时候以lng=121.5，lat=31.3经纬度显示该地附近的餐馆。
					 allmap(point);
					//一开始显示的地方
					//firstAddress("吉林大学珠海学院");
					 //当点击鼠标左键的时候，获得点击事件，获得点击点经纬度，通过经纬度搜索方圆附近的餐馆。
					 map.addEventListener("click", function(){
					
							  	 map.clearOverlays();//清除由于上次事件留下的痕迹。
								 var center = map.getCenter();//为得到地图的中心点位，返回GLatLng类型的值.
								 lng=center.lng;
								 lat=center.lat;
								 point = new BMap.Point(lng,lat);
							     allmap(point);
					   }
					 );
					
					    function getSquareBounds(centerPoi,r){
					        var a = Math.sqrt(2) * r; //正方形边长
					        mPoi = getMecator(centerPoi);
					        var x0 = mPoi.x, y0 = mPoi.y;
					        var x1 = x0 + a / 2 , y1 = y0 + a / 2;//东北点
					        var x2 = x0 - a / 2 , y2 = y0 - a / 2;//西南点
					
					        var ne = getPoi(new BMap.Pixel(x1, y1)), sw = getPoi(new BMap.Pixel(x2, y2));
					        return new BMap.Bounds(sw, ne);
					    }
					    //根据球面坐标获得平面坐标。
					    function getMecator(poi){
					        return map.getMapType().getProjection().lngLatToPoint(poi);
					    }
					    //根据平面坐标获得球面坐标。
					    function getPoi(mecator){
					        return map.getMapType().getProjection().pointToLngLat(mecator);
					    }
					
					 //根据经纬度这个点，搜索方圆附近所有的餐馆。
					 //strokeWeight圆圈的轨迹线粗细，fillOpacity圆圈的颜色深度
					 function allmap(point){
					  map.centerAndZoom(point,13);
					     var circle = new BMap.Circle(point,1000,{fillColor:"green", strokeWeight: 1 ,fillOpacity: 0.1, strokeOpacity: 0.3});
					     map.addOverlay(circle);
					     var local = new BMap.LocalSearch(map, {
					    																			 renderOptions: {map: map, panel: "results"}
						 																		}
																						);
					     var bounds = getSquareBounds(circle.getCenter(),circle.getRadius());
					     local.searchInBounds("景点",bounds);//以圆形为范围以餐馆为关键字进行搜索。
					 }
					
					    //获得输入框address的地址，通过地址解析，获得该地址的经纬度。记住该地址只能为上海市地区的位置。
					 function searchAddress(){
					 var address = document.getElementById("address").value;
					 var myGeo = new BMap.Geocoder();//地址解析
					  myGeo.getPoint(address, function(point)
							  {
									 if (point) 
										 {
										 	map.addOverlay(new BMap.Marker(point));
										 	map.clearOverlays();//清除由于上次事件留下的痕迹。
										    allmap(point);
									       }        
						       }, "<?php echo $html['cityname']?>");
					    }
					
					 function firstAddress(first_address){
						
						 var myGeo = new BMap.Geocoder();//地址解析
						  myGeo.getPoint(first_address, function(point)
								  {
										 if (point) 
											 {
											 	map.addOverlay(new BMap.Marker(point));
											 	map.clearOverlays();//清除由于上次事件留下的痕迹。
											    allmap(point);
										       }        
							       }, "中国");
						    }
					</script>
</div>
		<?php }elseif ($mark == 3){?>

							<!--引用百度地图API-->								
					<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=GX7TUqUfqZTzGmUBM6MhwOqSwgrX2C3n"></script>					
					地址：<input type="text" name="address" id="address"  placeholder="<?php echo $html['name']?>"/> <button id="mapsearch" onClick="searchAddress()">搜索</button>
					<div style="width:960px;height:400px;border:1px solid gray" id="container"></div>
					<div id="results" style="font-size:13px;margin-top:10px;"></div>
					</body>
					</html>
					<script type="text/javascript">
					 var map = new BMap.Map("container");
					 map.addControl(new BMap.NavigationControl());//创建一个特定样式的地图平移缩放控件
					 map.enableScrollWheelZoom();
					 var lng=<?php echo $html['longitude'] ?>;
					 var lat=<?php echo $html['latitude'] ?>;
					 var point = new BMap.Point(lng,lat);
					
					
					 //在地图首次自动加载的时候以lng=121.5，lat=31.3经纬度显示该地附近的餐馆。
					 allmap(point);
					//一开始显示的地方
					//firstAddress("吉林大学珠海学院");
					 //当点击鼠标左键的时候，获得点击事件，获得点击点经纬度，通过经纬度搜索方圆附近的餐馆。
					 map.addEventListener("click", function(){
					
							  	 map.clearOverlays();//清除由于上次事件留下的痕迹。
								 var center = map.getCenter();//为得到地图的中心点位，返回GLatLng类型的值.
								 lng=center.lng;
								 lat=center.lat;
								 point = new BMap.Point(lng,lat);
							     allmap(point);
					   }
					 );
					
					    function getSquareBounds(centerPoi,r){
					        var a = Math.sqrt(2) * r; //正方形边长
					        mPoi = getMecator(centerPoi);
					        var x0 = mPoi.x, y0 = mPoi.y;
					        var x1 = x0 + a / 2 , y1 = y0 + a / 2;//东北点
					        var x2 = x0 - a / 2 , y2 = y0 - a / 2;//西南点
					
					        var ne = getPoi(new BMap.Pixel(x1, y1)), sw = getPoi(new BMap.Pixel(x2, y2));
					        return new BMap.Bounds(sw, ne);
					    }
					    //根据球面坐标获得平面坐标。
					    function getMecator(poi){
					        return map.getMapType().getProjection().lngLatToPoint(poi);
					    }
					    //根据平面坐标获得球面坐标。
					    function getPoi(mecator){
					        return map.getMapType().getProjection().pointToLngLat(mecator);
					    }
					
					 //根据经纬度这个点，搜索方圆附近所有的餐馆。
					 //strokeWeight圆圈的轨迹线粗细，fillOpacity圆圈的颜色深度
					 function allmap(point){
					  map.centerAndZoom(point,13);
					     var circle = new BMap.Circle(point,1000,{fillColor:"green", strokeWeight: 1 ,fillOpacity: 0.1, strokeOpacity: 0.3});
					     map.addOverlay(circle);
					     var local = new BMap.LocalSearch(map, {
					    																			 renderOptions: {map: map, panel: "results"}
						 																		}
																						);
					     var bounds = getSquareBounds(circle.getCenter(),circle.getRadius());
					     local.searchInBounds("商场",bounds);//以圆形为范围以餐馆为关键字进行搜索。
					 }
					
					    //获得输入框address的地址，通过地址解析，获得该地址的经纬度。记住该地址只能为上海市地区的位置。
					 function searchAddress(){
					 var address = document.getElementById("address").value;
					 var myGeo = new BMap.Geocoder();//地址解析
					  myGeo.getPoint(address, function(point)
							  {
									 if (point) 
										 {
										 	map.addOverlay(new BMap.Marker(point));
										 	map.clearOverlays();//清除由于上次事件留下的痕迹。
										    allmap(point);
									       }        
						       }, "<?php echo $html['cityname']?>");
					    }
					

					</script>
</div>
		<?php }if ($mark == 4){?>
					<div>
																			交通
						
														市区内乘1路、12路、17路、24路“拉百站”下车即可
																				<div >
							
							<!--引用百度地图API-->								
					<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=GX7TUqUfqZTzGmUBM6MhwOqSwgrX2C3n"></script>					
					地址：<input type="text" name="address" id="address"  placeholder="<?php echo $html['name']?>"/> <button id="mapsearch" onClick="searchAddress()">搜索</button>
					<div style="width:960px;height:400px;border:1px solid gray" id="container"></div>
					<div id="results" style="font-size:13px;margin-top:10px;"></div>
					</body>
					</html>
					<script type="text/javascript">
					 var map = new BMap.Map("container");
					 map.addControl(new BMap.NavigationControl());//创建一个特定样式的地图平移缩放控件
					 map.enableScrollWheelZoom();
					 var lng=<?php echo $html['longitude'] ?>;
					 var lat=<?php echo $html['latitude'] ?>;
					 var point = new BMap.Point(lng,lat);
					
					
					 //在地图首次自动加载的时候以lng=121.5，lat=31.3经纬度显示该地附近的餐馆。
					 allmap(point);
					//一开始显示的地方
					//firstAddress("吉林大学珠海学院");
					 //当点击鼠标左键的时候，获得点击事件，获得点击点经纬度，通过经纬度搜索方圆附近的餐馆。
					 map.addEventListener("click", function(){
					
							  	 map.clearOverlays();//清除由于上次事件留下的痕迹。
								 var center = map.getCenter();//为得到地图的中心点位，返回GLatLng类型的值.
								 lng=center.lng;
								 lat=center.lat;
								 point = new BMap.Point(lng,lat);
							     allmap(point);
					   }
					 );
					
					    function getSquareBounds(centerPoi,r){
					        var a = Math.sqrt(2) * r; //正方形边长
					        mPoi = getMecator(centerPoi);
					        var x0 = mPoi.x, y0 = mPoi.y;
					        var x1 = x0 + a / 2 , y1 = y0 + a / 2;//东北点
					        var x2 = x0 - a / 2 , y2 = y0 - a / 2;//西南点
					
					        var ne = getPoi(new BMap.Pixel(x1, y1)), sw = getPoi(new BMap.Pixel(x2, y2));
					        return new BMap.Bounds(sw, ne);
					    }
					    //根据球面坐标获得平面坐标。
					    function getMecator(poi){
					        return map.getMapType().getProjection().lngLatToPoint(poi);
					    }
					    //根据平面坐标获得球面坐标。
					    function getPoi(mecator){
					        return map.getMapType().getProjection().pointToLngLat(mecator);
					    }
					
					 //根据经纬度这个点，搜索方圆附近所有的餐馆。
					 //strokeWeight圆圈的轨迹线粗细，fillOpacity圆圈的颜色深度
					 function allmap(point){
					  map.centerAndZoom(point,13);
					     var circle = new BMap.Circle(point,1000,{fillColor:"green", strokeWeight: 1 ,fillOpacity: 0.1, strokeOpacity: 0.3});
					     map.addOverlay(circle);
					     var local = new BMap.LocalSearch(map, {
					    																			 renderOptions: {map: map, panel: "results"}
						 																		}
																						);
					     var bounds = getSquareBounds(circle.getCenter(),circle.getRadius());
					     local.searchInBounds("公交车站",bounds);//以圆形为范围以餐馆为关键字进行搜索。
					 }
					
					    //获得输入框address的地址，通过地址解析，获得该地址的经纬度。记住该地址只能为上海市地区的位置。
					 function searchAddress(){
					 var address = document.getElementById("address").value;
					 var myGeo = new BMap.Geocoder();//地址解析
					  myGeo.getPoint(address, function(point)
							  {
									 if (point) 
										 {
										 	map.addOverlay(new BMap.Marker(point));
										 	map.clearOverlays();//清除由于上次事件留下的痕迹。
										    allmap(point);
									       }        
						       }, "<?php echo $html['cityname']?>");
					    }
					

					</script>
					


					  <?php }elseif($mark == 5){?>
					  					<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=GX7TUqUfqZTzGmUBM6MhwOqSwgrX2C3n"></script>					
					  
					<div id="hotel">
										地址：<input type="text" name="address" id="address"  placeholder="<?php echo $html['name']?>"/> <button id="mapsearch" onClick="searchAddress()">搜索</button>
					<div style="width:960px;height:400px;border:1px solid gray" id="container"></div>
					<div id="results" style="font-size:13px;margin-top:10px;"></div>
					</body>
					</html>
					<script type="text/javascript">
					 var map = new BMap.Map("container");
					 map.addControl(new BMap.NavigationControl());//创建一个特定样式的地图平移缩放控件
					 map.enableScrollWheelZoom();
					 var lng=<?php echo $html['longitude'] ?>;
					 var lat=<?php echo $html['latitude'] ?>;
					 var point = new BMap.Point(lng,lat);
					
					
					 //在地图首次自动加载的时候以lng=121.5，lat=31.3经纬度显示该地附近的餐馆。
					 allmap(point);
					//一开始显示的地方
					//firstAddress("吉林大学珠海学院");
					 //当点击鼠标左键的时候，获得点击事件，获得点击点经纬度，通过经纬度搜索方圆附近的餐馆。
					 map.addEventListener("click", function(){
					
							  	 map.clearOverlays();//清除由于上次事件留下的痕迹。
								 var center = map.getCenter();//为得到地图的中心点位，返回GLatLng类型的值.
								 lng=center.lng;
								 lat=center.lat;
								 point = new BMap.Point(lng,lat);
							     allmap(point);
					   }
					 );
					
					    function getSquareBounds(centerPoi,r){
					        var a = Math.sqrt(2) * r; //正方形边长
					        mPoi = getMecator(centerPoi);
					        var x0 = mPoi.x, y0 = mPoi.y;
					        var x1 = x0 + a / 2 , y1 = y0 + a / 2;//东北点
					        var x2 = x0 - a / 2 , y2 = y0 - a / 2;//西南点
					
					        var ne = getPoi(new BMap.Pixel(x1, y1)), sw = getPoi(new BMap.Pixel(x2, y2));
					        return new BMap.Bounds(sw, ne);
					    }
					    //根据球面坐标获得平面坐标。
					    function getMecator(poi){
					        return map.getMapType().getProjection().lngLatToPoint(poi);
					    }
					    //根据平面坐标获得球面坐标。
					    function getPoi(mecator){
					        return map.getMapType().getProjection().pointToLngLat(mecator);
					    }
					
					 //根据经纬度这个点，搜索方圆附近所有的餐馆。
					 //strokeWeight圆圈的轨迹线粗细，fillOpacity圆圈的颜色深度
					 function allmap(point){
					  map.centerAndZoom(point,13);
					     var circle = new BMap.Circle(point,1000,{fillColor:"green", strokeWeight: 1 ,fillOpacity: 0.1, strokeOpacity: 0.3});
					     map.addOverlay(circle);
					     var local = new BMap.LocalSearch(map, {
					    																			 renderOptions: {map: map, panel: "results"}
						 																		}
																						);
					     var bounds = getSquareBounds(circle.getCenter(),circle.getRadius());
					     local.searchInBounds("酒店",bounds);//以圆形为范围以餐馆为关键字进行搜索。
					 }
					
					    //获得输入框address的地址，通过地址解析，获得该地址的经纬度。记住该地址只能为上海市地区的位置。
					 function searchAddress(){
					 var address = document.getElementById("address").value;
					 var myGeo = new BMap.Geocoder();//地址解析
					  myGeo.getPoint(address, function(point)
							  {
									 if (point) 
										 {
										 	map.addOverlay(new BMap.Marker(point));
										 	map.clearOverlays();//清除由于上次事件留下的痕迹。
										    allmap(point);
									       }        
						       }, "<?php echo $html['cityname']?>");
					    }
				</script>	
					</div>
				
		<?php }elseif ($mark == 6){
			
			while(!!$rows=_fetch_array_list($result)){
				
				$html['comment_content']=$rows['t_content'];
				$html['comment_time'] = $rows['t_comment_time'];
				$html['comment_star'] = $rows['t_comment_star'];
				$html['user_id'] = $rows['t_user_id'];
				
				if(!!$rows=_fetch_array("select * from t_user 
																where t_id='{$html['user_id']}'")){
					$html['sex']=$rows['t_sex'];
					$html['face']=$rows['t_face'];
					$html['username']=$rows['t_username'];
				}else{
					//_alert_back('无法获取跟username相等的数据');
				}
		
			?>
			
		<div class="comment">
		<p class="line"></p>
		<div class="re">
			<dl>
				<dd class="user"><?php echo $html['username']?>(<?php echo $html['sex']?>)</dd>
				<dt><img src="<?php echo $html['face']?>" alt="<?php echo $html['username']?>"></img></dt>
			</dl>
			<div class="content">
				<div class="user">
					<span><?php echo $html['username']?></span>|发表于：<?php echo $html['comment_time']?>
				</div>
				评价<?php echo $rows['t_user_id']?>：<?php foreach (range(1,$html['comment_star']) as $num){?>
										<img src="pay/star.jpg" alt="star" />
									<?php }
									if($html['comment_star']<3){
										echo '差评';
									}elseif ($html['comment_star']<5){
										echo '中评';
									}else {
										echo '五星好评';
									}
									?>
				<div class="detail">
				<?php echo  _ubb($html['comment_content']);?>
				
				</div>
			</div>
		</div>
		</div>
		
		<p class="line"></p>
		<?php }?>
		
		<form method="post" action="?id=<?php echo $html['scence_id'] ?>&detail=comment&comment=1">
		<a name="ree"></a>
		<?php 
						if(!!$user=_fetch_array("select * from t_user 
																where t_username='{$_COOKIE['username']}'")){
							
				}else{
					//_alert_back('无法获取跟username相等的数据');
				}
		?>
				<input type="hidden" name="user_id" value="<?php  echo $user['t_id']?>"/>
				<input type="hidden" name="type" value="<?php  echo $html['type']?>"/>
				
				<dl>
					<dd>五星评价：<?php foreach (range(1,5) as $num){
																	echo '<label for ="star'.$num.'"><input type="radio" id="star'.$num.'" name="star" value="'.$num.'" checked="checked" />';
																
																	echo $num.'<img src="pay/star.jpg" alt="star"></img>';
								}
				?></dd>
					<dd id="q">贴   图：<a href="javascript:;">Q图系列【1】</a> 	<a href="javascript:;">Q图系列【2】</a> 	<a href="javascript:;">Q图系列【3】</a></dd>
					<dd>
						<?php include ROOT_PATH.'/include/ubb.inc.php';?>
						<textarea name="content"  rows="9"></textarea>
					</dd>
					
					<dd>
					
					验 证 码：<input type="text" name="yzm" class="yzm" /><img src="code.php" id="code"/>
					
					<input type="submit" class="submit" value="发表评论"/></dd>
				</dl>
		</form>
						</div>
						<?php }?>
						</div>

<?php require ROOT_PATH.'include/footer.inc.php'; ?>
</body>  
</html>