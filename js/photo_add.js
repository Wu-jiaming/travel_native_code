/**
 * 
 */
window.onload = function(){
	var fm  = document.getElementsByTagName('form')[0];
	var pass = document.getElementById('pass');

	fm[1].onclick  = function(){
		pass.style.display= 'none';
	};
	fm[2].onclick = function(){
		pass.style.display= 'block';
	};
	
	fm.onsubmit = function(){
		if(fm.name.value.length <2 || fm.name.value >20){
			alert('相册名不得小于2位或者大于20位');
			fm.name.value='';
			fm.name.focus();
			return false;
		}		
		if(fm[2].checked){
			if(fm.password.value.length < 6|| fm.password.value.length >20){
				alert('密码不得小于6位或者大于20位');
				fm.password.value='';
				fm.password.focus();
				return false;
			}
		}
		return true;
		
	};
};