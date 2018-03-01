/**
 * 
 */
var map = new BMap.Map("container");   
    var mypoint = new BMap.Point(116.404, 39.915);    // 创建点坐标 
    map.centerAndZoom(mypoint,15); // 初始化地图，设置中心点坐标和地图级别
    //    map.setMapType(BMAP_SATELLITE_MAP); 设置地图类型
    var marker = new BMap.Marker( mypoint );
    map.addOverlay( marker );
    marker.addEventListener("click", function(){ 
                var infoWin = new BMap.InfoWindow("your show information");
                this.openInfoWindow(infoWin);
    });
    
    var x1 = mypoint.lat+0.002;
    var x2 = mypoint.lat- 0.002;
    var y1 = mypoint.lng + 0.002;
    var y2 = mypoint.lng - 0.002; 
            
    var secRing = [
            new BMap.Point(y1, x1),  // 经度 纬度
            new BMap.Point(y1, x2),
            new BMap.Point(y2, x2),
            new BMap.Point(y2, x1)
        ];
    var secRingPolygon = new BMap.Polygon(
            secRing,
            {
                strokeColor:"#f50704",
                fillColor:"#FF0000",
                strokeWeight:2, 
                fillOpacity:0,
                strokeOpacity:0.8
            }
);
map.addOverlay(secRingPolygon);
map.enableScrollWheelZoom();    //启用滚轮放大缩小，默认禁用
map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用    // 创建Map实例
map.addControl(new BMap.NavigationControl());  //添加默认缩放平移控件
map.addControl(new BMap.OverviewMapControl({ isOpen: true, anchor: BMAP_ANCHOR_BOTTOM_RIGHT }));   //右下角，打开

secRingPolygon.enableEditing();

//添加事件    
secRingPolygon.addEventListener("mouseout", function(){    
    var pathObj = secRingPolygon.getPath();
    var htmlStr = "";
    for(var i in pathObj){
        var position = pathObj[i];
        htmlStr += position.lng +","+position.lat+ "<br>";            
    }
     document.getElementById('info').innerHTML = htmlStr
}); 

//不带回调函数的返回值
{
    status: 0,
    result: 
    {
        location: 
        {
            lng: 116.30814954222,
            lat: 40.056885091681
        },
    precise: 1,
    confidence: 80,
    level: "商务大厦"
    }
}