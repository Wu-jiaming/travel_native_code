<?php
define('IN_TG',true);
require dirname(__FILE__).'/include/common.inc.php';
header("Content-Type:text/plain;charset=utf-8");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	search();
}elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
	create();
}

function search(){
	if(!isset($_GET['number']) || empty($_GET['number'])){
		echo '参数错误';
		return ;
	}
	global $staff;
/* 	$staff=array(
			array("name"=>"吴家明","number"=>"1","sex"=>"男","job"=>"总经理")
	); */
	$staff=array();
	$result=_query("select * from t_user");
	while(!!$array2=_fetch_array_list($result)){
		@array_push($staff, $array2);
	}
	
	
	$number=$_GET['number'];
	//$staffs=_query("select * from t_user");
	//$staff=_fetch_array_list($staffs);

	$result="没有找到员工";
	
	foreach($staff as $value){
		if($value['t_id'] == $number){
			//$result = "找到员工：员工编号：".$value['number']."，员工姓名：".$value['name']."，员工性别：".$value['sex']."，员工职位：".$value['job'];
			$result = "找到员工：员工编号：".$value['t_id']."，员工姓名：".$value['t_username']."，员工性别：".$value['t_sex']."，员工职位：".$value['t_level'];
					
				break;
		}
		
	}
	echo $result;
}

function create(){
	if(!isset($_POST['name']) || empty($_POST['name'])
	||!isset($_POST['number']) ||empty($_POST['number'])
	||!isset($_POST['sex']) || empty($_POST['sex'])
	||!isset($_POST['job']) || empty($_POST['job'])
			){
		echo "参数错误，员工信息填写不全";
		return ;
	}
	echo "员工：".$_POST['name']."信息保存成功！";
}


?>