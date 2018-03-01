<?php
header('Content-Type: text/html; charset=utf-8');
 function GetIpLookup($ip = ''){
	if(empty($ip)){
		return '请输入IP地址';
	}
	//取得这个网页的内容
	$res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);
	
	if(empty($res)){ return false; }
	
	$jsonMatches = array();
	//将$res 与#\{.+?\}# 匹配，若匹配到则回给$jsonMatches，$jsonMatches[0]=$res,$jsonMatches[1]=匹配到的第一个字符串
	preg_match('#\{.+?\}#', $res, $jsonMatches);
	
	if(!isset($jsonMatches[0])){ return false; }
	
	$json = json_decode($jsonMatches[0], true);
	if(isset($json['ret']) && $json['ret'] == 1){
		$json['ip'] = $ip;
		unset($json['ret']);
	}else{
		return false;
	}
	return $json;
} 
$ipInfos = GetIpLookup('123.125.114.144'); //baidu.com IP地址
//echo $ipInfos['city'];
//var_dump($ipInfos);
//print_r($ipInfos);

//简易版
/* function getIPAddress(){
	//直接获取本地IP地址，注意链接后面没有&ip=xxx
	$ipContent = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js");
	$ipData = explode("=", $ipContent);
	$ipData = substr($ipData, 0,-1);
	return $ipData;
}
$ipData = json_decode(getIPAddress());
print_r($ipData);
echo $ipData["city"]; */

function getIpAddress(){
	$ipContent  = @file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js");
	$jsonData = explode("=",$ipContent);
	$jsonAddress = substr($jsonData[1], 0, -1);
	return $jsonAddress;
}
$ip_info=json_decode(getIpAddress(),true);

//var_dump($ip_info);
echo $ip_info['city'];
?>