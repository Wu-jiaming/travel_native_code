
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  

</head>
<body>
<h1>员工查询</h1>
<label>请输入员工编号：</label><br/>
<input type="text" id="keyword"></input><br/>
<button id="search">查询</button><br/>
<p id="searchResult"></p><br/>

<h1>员工创建</h1>
<label>请输入员工姓名：</label><br/>
<input type="text" id="staffName"></input><br/>
<label>请输入员工编号：</label><br/>
<input type="text" id="staffNumber"></input><br/>
<label>请选择员工性别:</label><br/>
<select id="staffSex">
	<option>男</option>
	<option>女</option>
</select><br/>
<label>请输入员工职位：</label><br/>
<input type="text" id="staffJob"></input><br/>
<button id="save">保存</button><br/>
<script>
	document.getElementById("search").onclick=function(){
			var request = new XMLHttpRequest();
			request.open("GET","ajax2.php?number="+document.getElementById("keyword").value);
			request.send();
			
			request.onreadystatechange = function(){
				if(request.readyState === 4){
					if(request.status === 200){
							document.getElementById("searchResult").innerHTML=request.responseText;
						}else{
								alert("发生错误："+request.status);
							}
				}
			}
		}
</script>
</body>
  
</html>