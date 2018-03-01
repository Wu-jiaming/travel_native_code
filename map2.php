<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
body, html{width: 100%;height: 100%;margin:0;font-family:"微软雅黑";}
#allmap{height:500px;width:100%;}
#r-result{width:100%; font-size:14px;}
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=GX7TUqUfqZTzGmUBM6MhwOqSwgrX2C3n"></script>
<title>城市名定位</title>
</head>
<body>
<div id="allmap"></div>
<div id="r-result">
城市名: <input id="cityName" type="text" style="width:100px; margin-right:10px;" />
<input type="button" value="查询" onclick="theLocation()" />
</div>
</body>
</html>
<script type="text/javascript">
// 百度地图API功能
var map = new BMap.Map("allmap");
var point = new BMap.Point(116.331398,39.897445);
map.centerAndZoom(point,11);


function theLocation(){
var city = document.getElementById("cityName").value;
if(city != ""){<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>数据接口</title>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.2"></script>
</head>
<body>
地址：<input type="text" name="address" id="address"  value="上海市"/> <button id="mapsearch" onClick="searchAddress()">搜索</button>
<div style="width:600px;height:400px;border:1px solid gray" id="container"></div>
<div id="results" style="font-size:13px;margin-top:10px;"></div>
</body>
</html>
<script type="text/javascript">
var map = new BMap.Map("container");
map.addControl(new BMap.NavigationControl());//创建一个特定样式的地图平移缩放控件
map.enableScrollWheelZoom();
var lng=121.5;
var lat=31.3;
var point = new BMap.Point(lng,lat);

//在地图首次自动加载的时候以lng=121.5，lat=31.3经纬度显示该地附近的餐馆。
allmap(point);

//当点击鼠标左键的时候，获得点击事件，获得点击点经纬度，通过经纬度搜索方圆附近的餐馆。
map.addEventListener("click", function(){

map.clearOverlays();//清除由于上次事件留下的痕迹。
var center = map.getCenter();//为得到地图的中心点位，返回GLatLng类型的值.
lng=center.lng;
lat=center.lat;
point = new BMap.Point(lng,lat);
allmap(point);
});

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
function allmap(point){
map.centerAndZoom(point,11);
 var circle = new BMap.Circle(point,1000,{fillColor:"blue", strokeWeight: 1 ,fillOpacity: 0.3, strokeOpacity: 0.3});
 map.addOverlay(circle);
 var local = new BMap.LocalSearch(map, {
 renderOptions: {map: map, panel: "results"}});
 var bounds = getSquareBounds(circle.getCenter(),circle.getRadius());
 local.searchInBounds("餐馆",bounds);//以圆形为范围以餐馆为关键字进行搜索。
}

//获得输入框address的地址，通过地址解析，获得该地址的经纬度。记住该地址只能为上海市地区的位置。
function searchAddress(){
var address = document.getElementByIdx_x_x_x("address").value;
var myGeo = new BMap.Geocoder();
myGeo.getPoint(address, function(point){
if (point) {
map.addOverlay(new BMap.Marker(point));
map.clearOverlays();//清除由于上次事件留下的痕迹。
allmap(point);
   }        }, "上海市");
}
</script>

map.centerAndZoom(city,11);      // 用城市名设置地图中心点
}
}
</script>