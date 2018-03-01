<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>所有POI的查询-地址解析</title>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=GX7TUqUfqZTzGmUBM6MhwOqSwgrX2C3n"></script>
</head>
<body>
<input type="button" onclick="displayPOI();" value="确定" />
<div style="width:600px;height:340px;border:1px solid gray;float:left;" id="container"></div>
<div style="width:300px;height:340px;border:1px solid gray;border-left:0;float:left;" id="panel"></div>
</body>
</html>
<script type="text/javascript">
var map = new BMap.Map("container");
var mpoint = new BMap.Point(116.404, 39.915);

map.centerAndZoom(mpoint, 16);
map.enableScrollWheelZoom();        //启用滚轮缩放

var mOption = {
    poiRadius : 500,           //半径为1000米内的POI,默认100米
    numPois : 12                //列举出50个POI,默认10个
}

var myGeo = new BMap.Geocoder();        //创建地址解析实例
function displayPOI(){
    map.addOverlay(new BMap.Circle(mpoint,500));        //添加一个圆形覆盖物
    myGeo.getLocation(mpoint,
        function mCallback(rs){
            var allPois = rs.surroundingPois;       //获取全部POI（该点半径为100米内有6个POI点）
            for(i=0;i<allPois.length;++i){
                document.getElementById("panel").innerHTML += "<p style='font-size:12px;'>" + (i+1) + "、" + allPois[i].title + ",地址:" + allPois[i].address + "</p>";
                map.addOverlay(new BMap.Marker(allPois[i].point));                
            }
        },mOption
    );
}
</script>
