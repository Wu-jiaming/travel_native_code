<?php
	if(!defined('IN_TG'))
	{
		exit('Acess Defined!');
	}
	header('Content-Type: text/html; charset=utf-8');
	define ('ROOT_PATH',substr(dirname(__FILE__),0,-7));
	//将转义语句命名为GBC
	define('GBC',get_magic_quotes_gpc());
	if(PHP_VERSION < '4.1.0')
	{
		exit('version is too low');
	}
	require ROOT_PATH.'include/global.func.php';
	require ROOT_PATH.'include/mysql.func.php';
	define('start_time',_runtime());

	//将数据库的各个属性又命名
	define('DB_HOST', 'localhost');
	define('DB_USER','root');
	define('DB_PWD','123456');
	define('DB_NAME','tourism');
	
	_connect();
	_select_db();
	_set_query();


?>