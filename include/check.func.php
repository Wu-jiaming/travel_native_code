<?php
//防止恶意调用
if(!defined('IN_TG')){
	exit('Access defined');
}
//检查_alert_back()函数是否存在
if(!(function_exists('_alert_back')))
{
	exit('_alert_back()函数不存在');
}

//外部函数需要检查是否存在
//检查_mysql_string
if(!function_exists('_mysql_string'))
{
	exit('_mysql_string函数不存在');
}
//检查图片的名称对不对
function _check_photo_url($str){
	if (empty($str)){
		_alert_back('地址不能为空');
	}
	return $str;
}
//是否相等  唯一的标识符
function _check_uniqid($f_uniqid,$s_uniqid){
	if((strlen($f_uniqid)!=40)||($f_uniqid !=$s_uniqid))
	{
	_alert_back('唯一标识符异常');
	}
	return _mysql_string($f_uniqid);
}
//返回性别
function _check_sex($sex){
	return _mysql_string($sex);
}
//头像返回函数
function _check_face($face){
	return _mysql_string($face);
	
	
}
//检查信息内容是否超出或者不足1
function _check_content($str){
	if(mb_strlen($str,'utf-8') < 1 || mb_strlen($str,'utf-8') >10000){
		_alert_back('信息内容必须至少一位且不少于10000');
	}
	return $str;
}

//过滤用户名是否符合标准
function _check_name($string,$min_num,$max_num){
	$string=trim($string);	
	if(!(mb_strlen($string,'utf-8')>=$min_num&&mb_strlen($string,'utf-8')<=$max_num)){
		_alert_back('长度不得小于'.$min_num.'或者大于'.$max_num.'位');
		
	}
	$char_pattern ='/[<>\'\"\ ]/';
	if(preg_match($char_pattern, $string))
	{
			_alert_back('用户名不得是特殊字符');
	}
	$mg[0]='操你妈';
	$mg[1]='你麻痹';
//	将敏感名词连在一起
	foreach ($mg as $value){
		$mg_string.='['.$value.']';
		
	}
	//检查输入的用户名是否等于敏感名词
	if(in_array($string,$mg)){
		_alert_back($mg_string.'以上敏感用户名不得注册');
	}
	return _mysql_string($string);
}
//用户输入的密码和确认密码是否符合标准
function _check_password_one($pass,$min_num,$max_num){
	if (!empty($pass)){
				if((strlen($pass)<$min_num)&&(strlen($pass)<=$max_num)){
			
					_alert_back('密码必须至少'.$min_num.'位且少于'.$max_num.'');
				}
	}

	return _mysql_string(sha1($pass));
}
//用户输入的密码和确认密码是否符合标准
function _check_password($pass,$repass,$min_num,$max_num){
	if((strlen($pass)<$min_num)&&(strlen($pass)>=$max_num)){
		
		_alert_back('密码必须至少'.$min_num.'位且少于'.$max_num.'');
	}
	if($pass != $repass){
		_alert_back('密码跟确认密码必须相同');
	}
	return _mysql_string(sha1($pass));
}

//验证phone号码是不是11位数字
function _check_phone($phone){
	if (is_numeric($phone)){
		if(strlen($phone) != 11)
		{
			_alert_back('您填的电话号码不是11位');
			
		}
	}else{
		_alert_back('您填的电话号码含有非数字字符');
	}
	return $phone;
}
//验证修改之后的面格式
function _check_modify_password($pass,$min_num,$max_num){
	if(!empty($pass)){
		if((strlen($pass)<$min_num)&&(strlen($pass)>=$max_num)){
			
			_alert_back('密码必须至少'.$min_num.'位且少于'.$max_num.'');
		}
		
	}
	else {
		return null;
	}
	return sha1($pass);
}


//检查邮箱格式
function _check_email($email,$max_num){
//sadadf@qq.com
		if (!empty($email)){
			if(!preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/', $email)){
				_alert_back('邮箱格式不正确check');
			}
			if(strlen($email)>$max_num){
				_alert_back('邮箱网址超过'.$max_num.'');
			}
			
			return $email;
		}else{
			return null;
		}
}


//检查post的标题
function _check_post_title($str,$min,$max){
	if(mb_strlen($str,'utf-8')>$max ||mb_strlen($str,'utf-8')<$min){
		_alert_back('post标题字数不得小于'.$min.'或者大于'.$max.'');
	}
	return $str;
}
//检查post的帖子内容
function _check_post_content($str,$min,$max){
	if(mb_strlen($str,'utf-8')>$max ||mb_strlen($str,'utf-8')<$min){
		_alert_back('post内容字数不得小于'.$min.'或者大于'.$max.'');
	}
	return $str;
}
?>