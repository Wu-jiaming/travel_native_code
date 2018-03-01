<?php
define('IN_TG',true);
require dirname(__FILE__).'/include/common.inc.php';
header("Content-Type:text/plain;charset=utf-8");

	$staff=array();
	$result=_query("select * from t_user");
	while(!!$array2=_fetch_array_list($result)){
		@array_push($staff, $array2);
	}
print_r($staff);

?>