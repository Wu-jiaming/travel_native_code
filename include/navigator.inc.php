<?php
if(!defined('IN_TG'))
{
	exit('Access Defined!');
}
?>
<div id ="select">
	<ul>
		<li><a href="main.php" title="旅游">旅游</a></li>
		<li><a href="hotel.php" title="酒店">酒店</a></li>
		<li><a href="airplane.php" title="机票">机票</a></li>
		<li><a href="ticket.php" title="门票">门票</a></li>
	</ul>
	


<div class="more_search"><div class="sos"><div class="text1">
											<font class="icon_gps"></font><strong><?php echo $ip_info['city']?></strong>
											<div class="hide_box"><div class="line"></div><div class="cf_tag_top">
											<a href="#?" class="on" target="_self">热门出发城市</a></div>
											<div class="cf_tag_con"></div></div></div><div class="text2">
											<i class="icon_fangda"></i>
											<form method="post" action="search?action=select" id="dest_so" target="_self">
											<input type="hidden" name="tn" value="line">
											<input type="hidden" name="city_en" value="beijing">
											<input type="hidden" name="city_id" id="dest_city_id" value="110000">
											<input type="text" placeholder="请输入想去的目的地" id="dest_so_input" name="search" autocomplete="off" x-webkit-speech="" onwebkitspeechchange="webkitspeechchange()" style="color: rgb(170, 170, 170);"> 
											<input type="submit" class="btn" value="马上去" style="cursor:pointer;" onClick="_czc.push(['_trackEvent', 'page_hits', 'line_list', 'so_go', 1]);">
											<div id="dest_smart_arrow" style="height: 35px; left: 539px; top: 222px;">
											<div class="hide"></div></div></form></div><div class="key">热搜：
											<a href="search?search=厦门">厦门</a>
											<a href="search?search=三亚">三亚</a>
											
											<a href="search?search=马尔代夫">马尔代夫</a>
											</div></div></div></div>
											</div>