var plate_default=1; //轮播菜单默认值

//首页图文轮播  楼盘测评处
function plate(a){
	var plate_total=2; //轮播菜单总数
	plate_default+=a;
	if (plate_default>plate_total){plate_default=1;}
	if (plate_default==0){plate_default=plate_total;}
	for (var j=1; j<=plate_total; j++){
		$("#platecon"+j).hide();
	}
	$("#platecon"+plate_default).show();
} 

//地图周边配套设施
function search(keyword){
	var point = new BMap.Point(houseObj.coordx_encode, houseObj.coordy_encode);
	if(typeof circle =='undefined'){
		circle = new BMap.Circle(point,2000,{fillColor:"blue", strokeWeight: 1 ,fillOpacity: 0.001, strokeOpacity: 0.001});
		disableMassClear = true;
	}
	if(typeof circle == 'object' && (circle.getCenter().lng != houseObj.coordx_encode || circle.getCenter().lat != houseObj.coordy_encode)){
		map.clearOverlays();
		circle = new BMap.Circle(point,2000,{fillColor:"blue", strokeWeight: 1 ,fillOpacity: 0.001, strokeOpacity: 0.001});
		disableMassClear = true;
	}
	map.addOverlay(circle);
	var bounds = getSquareBounds(circle.getCenter(),circle.getRadius());
	local.searchInBounds(keyword,bounds);
}

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

