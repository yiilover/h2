/**
* 封装 GOOGLE 地图 API
*/
//;;;var iterate = function (obj){	s="遍历对象"+obj+"的属性：\n";	for(i in obj)	s+=i+":"+obj[i]+"\n";	return s;};
var MapApi = function(){
	var arg = arguments;
	var cont = 'mapObj';
	var lat = 39.917;
	var lng = 116.397;
	var zoom = 14;
	for(var i=0; i<arg.length; i++)
	{
		if(0 == i) cont = arg[0];
		else if(1 == i) lat = arg[1];
		else if(2 == i) lng = arg[2];
		else if(3 == i) zoom = arg[3];
	}

	this.isClick = 0;
	this.viewAuto = false;

	this.citycenter = new MLngLat(lng,lat);
	var mapOptions = new MMapOptions();
	mapOptions.center = this.citycenter;
	mapOptions.zoom = zoom;
	mapOptions.toolbar = DEFAULT;
	mapOptions.scale = SHOW;
	//mapOptions.Language = MAP_CN;
	//alert(lng+','+lat);
	//116.39794921875,39.908172607421875
	this.container = document.getElementById(cont);
	this._map = new MMap(cont,mapOptions);
	this._map.setKeyboardEnabled(false);
	this._markerManager = new MarkerManager(this._map);
};

//MapApi.ZOOM_MAX = 19;
MapApi.ZOOM_MIN = 10;

MapApi.prototype.addEvent = function(obj, eve, motion)
{
	if(obj === this) obj = this._map;
	return this._map.addEventListener(obj, eve, motion);
};
MapApi.prototype.removeEvent = function(handler)
{
	this._map.removeEventListener(handler);
};
/*MapApi.prototype.enableScrollWheel = function()
{
	var map = this._map;
	map.enableScrollWheelZoom();
};*/
MapApi.prototype.gethdBounds = function()
{
	var map = this._map;
	var bounds = map.getLngLatBounds();
	var sw0 = bounds.southWest;
	var ne0 = bounds.northEast;
	var pointSw = map.fromLngLatToContainerPixel(sw0);
	var sw = map.fromContainerPixelToLngLat(new MPoint(pointSw.x+8, pointSw.y-8));
	var pointNe = map.fromLngLatToContainerPixel(ne0);
	var ne = map.fromContainerPixelToLngLat(new MPoint(pointNe.x-8, pointNe.y+8));
	//alert('hdx1:'+sw.lngX+',hdx2:'+ne.lngX+',hdy1:'+sw.latY+',hdy2:'+ne.latY);
	return {'hdx1':sw.lngX,'hdx2':ne.lngX,'hdy1':sw.latY,'hdy2':ne.latY};
};
MapApi.prototype.setTipId = function(newCode)
{
	this.isClick = newCode;
};
MapApi.prototype.drawMarkers = function(metaMarkers)
{
	var me = this;
	var map = me._map;
	var mm = me._markerManager;
	var bounds = new MLngLatBounds();
	var counter = 0;

	//mm.clearMarkers();
	for(var i=0; i<metaMarkers.length; i++)
	{
		var info = metaMarkers[i];
		if(!info.y || !info.x || Math.abs(info.y*1)>90 || Math.abs(info.x*1)>180) continue;
		bounds.extend(new MLngLat(info.x,info.y));
		var marker = me.createMarker(info);

		marker.provalue = info;
		me.addMarker(marker);
		

		counter ++;
	}

	
	//alert(bounds.getSouthWest().toString()+';'+bounds.getNorthEast().toString());
	//mm.refresh();
	if(counter > 0) me.panMap(bounds);
};
MapApi.prototype.addMarker = function(marker)
{
	var me = this;
	var map = me._map;
	var mm = me._markerManager;
	map.addLabeledMarker(marker);
	//var m = document.getElementById('tip'+marker.provalue['newCode']);
	//marker.div_ = m.parentNode;
	//alert(marker.div_.innerHTML);
	mm._markers.push(marker);
};
MapApi.prototype.setMapType = function(mType)
{
	this._map.setMapType(mType);
};
MapApi.prototype.clearMarkers = function()
{
	this._markerManager.clearMarkers();
};
MapApi.prototype.clearOverlays = function()
{
	this._map.removeAllOverlays();
	this.closeTip();
};
//注意对地图进行移动操作时，如果不想重新搜索，应该先把SFMap中的isDragend置成false
//重新设置地图中心点
MapApi.prototype.setCenter = function(y,x,zoom)
{
	if(!y || !x) return;
	var zoom = zoom || this._map.getZoom();
	this._map.setZoomAndCenter(zoom,new MLngLat(x,y));
};
MapApi.prototype.panTo = function(y,x)
{
	if(!y || !x) return;
	this._map.panTo(new MLngLat(x,y));
};
MapApi.prototype.createMarker = function(info)
{
	var me = this;
	var map = me._map;
	var mm = me._markerManager;
	var latLng = new MLngLat(info.x,info.y);
	if ('undefined' != typeof(info.isAD) && info.isAD == 1)
	{
		var lclass = "mapFinddingCanvasLabelStyle8";
		var ltext = '<table id="tip'+info.newCode+'" cellspacing="0" cellpadding="0" border="0" id="tip"><tbody><tr><td class="s1">&nbsp;</td><td class="s2"><strong>'+info.title+'</strong><br><span>'+info.tel400+'</span></td><td class="s3">&nbsp;</td></tr><tr><td class="s5" colspan="3"></td></tr></tbody></table>';	
		var offset_new = new MSize(0,53);
	}
	else
	{
		var lclass = "mapFinddingCanvasLabelStyle3";
		var sTc = {'0':'6', '2':'4', '3':'2', '4':'1'};
		if('undefined' != typeof(info.saling) && 'undefined' != typeof(sTc[info.saling]))
		{
			//lclass = 'mapFinddingCanvasLabelStyle' + sTc[info.saling];
		}
		lclass = 'mapFinddingCanvasLabelStyle' + info.saling;
		var ltext = '<table id="tip'+info.newCode+'" cellpadding=0 cellspacing=0 border=0><tr><td class="s1">&nbsp;</td><td class="s2">'+info.title+'</td><td class="s3">&nbsp;</td></tr><tr><td colspan="3" class="s5"></td></tr></table>';
		//var ltext = '<div class="s1"></div><div class="s2" id="tip'+info.newCode+'">'+info.title+'</div><div class="s3"></div><div class="s4"></div><div class="s5"></div>';
		var offset_new = new MSize(0,40);
	}
	var opts = {/*icon:icon,*/labelText:ltext,labelClass:lclass,labelOffset:offset_new,map:map};
	var marker = new LabeledMarker(latLng,opts);
	SFUtil.eventAdd(marker.div_,"mouseover",function(){me.hoverMarker(marker,true);});
	SFUtil.eventAdd(marker.div_,"mouseout",function(){me.hoverMarker(marker,false);});
	SFUtil.eventAdd(marker.div_,"click",function(){me.openTip(marker);});
	marker.provalue = info;
	return marker;
	
};
//隐藏标点的 DIV 元素
//newCode 楼盘 ID
MapApi.prototype.hideMarker = function(newCode)
{
	var nodeId = 'tip'+newCode;
	var mNode = $id(nodeId);
	if(mNode)
	{
		var domMark = mNode.parentNode;
		domMark.style.display='none';
	}
};
MapApi.prototype.hoverMarker = function(marker, flg)
{
	var me = this;
	var map = me._map;
	var mm = me._markerManager;
	if(!marker.div_) return;
	if(flg){
		//map.setOverlayToTopById(marker.id);
		if (marker.div_.className != "mapFinddingCanvasLabelStyle8")
		{
			marker.div_.className="mapFinddingCanvasLabelStyle5";
		}
		marker.div_.parentNode.style.zIndex= 1;
	}
	else
	{
		if(me.isClick != marker.provalue.newCode)
		{
			//var mIndex = GOverlay.getZIndex(marker.getLatLng().lat());
			marker.div_.parentNode.style.zIndex = 0;
			if (marker.div_.className != "mapFinddingCanvasLabelStyle8")
			{
				var lclass = "mapFinddingCanvasLabelStyle3";
				var sTc = {'0':'6', '2':'4', '3':'2', '4':'1'};
				if('undefined' != typeof(marker.provalue.saling) && 'undefined' != typeof(sTc[marker.provalue.saling]))
				{
					//lclass = 'mapFinddingCanvasLabelStyle' + sTc[marker.provalue.saling];
				}
				lclass = 'mapFinddingCanvasLabelStyle' + marker.provalue.saling;
				marker.div_.className = lclass;
			}
			//map.enableDragging();
		}
	}
};
MapApi.prototype.openTip = function(marker)
{
	var me = this;
	var map = me._map;
	var mm = me._markerManager;
	var node = $id('maptip');
	if('undefined' == typeof marker.provalue.newCode) return; 
	//alert(iterate(marker.div_.offsetParent));
	//me.getMarkerById(marker.provalue.newCode);
	if(0 != me.isClick && marker.provalue.newCode != me.isClick)
	{
		me.closeTip();
	}
	if(marker.provalue.newCode == me.isClick)
	{
		return;
	}
	var mapBounds = map.getLngLatBounds();
	var point = new MLngLat(marker.provalue.x, marker.provalue.y);
	if(!mapBounds.containsLatLng(point))
	{
		if('undefined' != typeof(SFMap.isDragend))
		{
			var isDragendSave = SFMap.isDragend;
			SFMap.isDragend = false;
		}
		//setCenter的执行速度要比panTo快很多
		map.setCenter(point);
		if('undefined' != typeof(SFMap.isDragend))
		{
			SFMap.isDragend = isDragendSave;
		}
	}
	me.isClick = marker.provalue.newCode;
	//alert(iterate(marker.provalue));
	var content = SFUI.templateFetch($id('template_maptip').value, marker.provalue);
	//alert(content);
	node.innerHTML = content;
	node.style.display = 'block';
	var mapNode = $id('map_canvas');
	var mapHeight = mapNode.offsetHeight;
	var topPx = 0;
	var leftPx = 0;
	var nodeWidth = node.offsetWidth;
	var nodeHeight = node.offsetHeight;
	var atLeft = true;
	var pixel = me._map.fromLngLatToContainerPixel(point);
	if(pixel.y > nodeHeight - 27)
	{
		topPx = pixel.y - nodeHeight + 27;
		if(topPx+nodeHeight > mapHeight) topPx = mapHeight - nodeHeight;
	}
	else
	{
		topPx = 3;
	}
	if(pixel.x > nodeWidth + 12)
	{
		leftPx = pixel.x - nodeWidth - 12;
	}
	else
	{
		leftPx = pixel.x + 12;
		atLeft = false;
	}
	node.style.top = topPx+'px';
	node.style.left = leftPx+'px';
	var qipaojt = document.getElementById('qipaojt');
	if(qipaojt)
	{
		qipaojt.className = atLeft ? 'qipaojt2' : 'qipaojt1';
		var jtTop = pixel.y - topPx - 8;
		if(jtTop > 7)
		{
			if(jtTop > nodeHeight-27) jtTop = nodeHeight - 27;
		}
		else
		{
			jtTop = 7;
		}
		qipaojt.style.top = jtTop+'px';
	}
	me.hoverMarker(marker,true);
	var newCode = marker.provalue.newCode;
	if(newCode && SFMap.markerList[newCode])
	{
		SFMap.markerList[newCode].onCloseTip = function(){me.hoverMarker(marker,false);};
	}
};
MapApi.prototype.closeTip = function()
{
	var me = this;
	var node = $id('maptip');
	var newCode = me.isClick;
	me.isClick = 0;
	if(node)
	{
		node.style.display = 'none';
		node.innerHTML = '';
	}
	if(newCode && SFMap.markerList[newCode])
	{
		SFMap.markerList[newCode].onCloseTip();
	}
};
MapApi.prototype.panMap = function(markerBounds)
{

	var me = this;
	var map = me._map;
	var mm = me._markerManager;
	
	//var center = markerBounds.getCenter();
	if(me.viewAuto)
	{
		//var zoom = map.getBoundsZoomLevel(markerBounds);
		map.setLngLatBounds(markerBounds);
		me.viewAuto = false;
	}
	else
	{
		var mapBounds = map.getLngLatBounds();
		//alert(mapBounds.getSouthWest().toString()+';'+mapBounds.getNorthEast().toString());
		if(mapBounds.containsBounds(markerBounds))
		{
			//alert('not pan');
			return;
		}
		map.setLngLatBounds(markerBounds);
		if(getOne){
			map.zoomOut();
			map.zoomOut();
			getOne=false;
		}
		//alert('pan');
		/*var zoomt = map.getBoundsZoomLevel(markerBounds);
		//alert(zoomt);
		var zoomn = map.getZoom();
		var zoom = (zoomt < zoomn) ? zoomt : zoomn;*/
	}
	//if(zoom > MapApi.ZOOM_MAX) zoom = MapApi.ZOOM_MAX;
	/*if(zoom < MapApi.ZOOM_MIN)
	{
		//如果缩放的太小，就把比例设成最小的，中心点设为城市的中心点
		zoom = MapApi.ZOOM_MIN;
		center = this.citycenter;
	}
	map.setCenter(center,zoom);*/
};
MapApi.prototype.addKeyMarker = function(info)
{
	var me = this;
	var map = me._map;
	if(!info.name || !info.y || !info.x) return;
	if(Math.abs(info.y*1)>90 || Math.abs(info.x*1)>180) return;
	var html='<div style="position: absolute;left:-9px;top:-52px;cursor:default;" id="divkeymarker"><div style="font-size:12px;color:#fff;line-height:18px;text-align:center;z-index:9990;white-space: nowrap;"><div style="background:url(mf/img/place_mask.png) repeat-x;padding:0 5px;float:left;white-space:nowrap;">'+info.name+'</div><div style="background:url(mf/img/place_mask.png) repeat-x;width:16px; height:35px;margin-left:10px;_margin-left:5px; background-position:0 -30px; float:left; clear:left;"></div></div>';
	var opts={labelText:html,labelOffset:MSize(8,53)};
	var keymarker = new LabeledMarker(new MLngLat(info.x, info.y),opts);
	map.addLabeledMarker(keymarker);
	//map.addOverlay(new MMarker(new MLngLat(info.x, info.y)));
	map.setOverlayToTopById(keymarker.id);
	/*var oDiv = $id("divkeymarker");
	if(oDiv)
	{
		oDiv.parentNode.style.zIndex= 500;
	}*/
};
MapApi.prototype.setViewAuto = function(flg)
{
	this.viewAuto = flg;
};
MapApi.prototype.setZoom = function(zoom)
{
	var zoom = parseInt(zoom);
	this._map.setZoom(zoom);
};
MapApi.prototype.drawLine = function(linexy, pan)
{
	var pan = pan ? true : false;
	var me = this;
	var map = me._map;
	var linexys = linexy;

	var lineNodes = linexys.split(';');
	var polyline = [];
	var counter = 0;
	var bounds = new MLngLatBounds();
	for(var ln=0;ln<lineNodes.length;ln=ln+2)
	{
		if(!lineNodes[ln] || !lineNodes[ln+1]) continue;
		var vertex =  new MLngLat(lineNodes[ln],lineNodes[ln+1]);
		polyline.push(vertex);
		bounds.extend(vertex);
		counter ++;
	}

	var lineStyle = new MLineStyle();
	lineStyle.thickness = 6;
	lineStyle.color = '#ff0000';
	var lineOption = new MLineOptions();
	lineOption.lineStyle = lineStyle;
	var polylines = new MPolyline(polyline, lineOption);
	//var bounds = polylines.getLngLatBounds();
	map.addOverlay(polylines);

	//pan为true并且有线路时，移动地图
	if(pan && counter > 0)
	{
		map.setZoomAndCenter(11,me.citycenter);
		me.viewAuto = true;
		me.panMap(bounds);
	}
};
MapApi.prototype.createSubwayMarker = function(subwayTemp)
{
	var me = this;
	var map = me._map;
	var latlng = new MLngLat(parseFloat(subwayTemp[1]),parseFloat(subwayTemp[2]));
	var sContent = '<div class="subwayneme" style="position:absolute;">'+subwayTemp[0]+'</div>';
	var markerOption = new MMarkerOptions();
	markerOption.imageUrl = 'mf/img/site.png';
	markerOption.imageSize = new MSize(12,12);
	var marker = new MMarker(latlng,markerOption);
	map.addOverlay(marker);
	marker.div_ = document.getElementById(marker.id);
	var station = document.getElementById('subway_station_tip');
	if(!station)
	{
		station = document.createElement('div');
		station.id = 'subway_station_tip';
		me.container.appendChild(station);
	}
	var point = me._map.fromLngLatToContainerPixel(latlng);

	SFUtil.eventAdd(marker.div_, 'mouseover', function() {
		var newpoint = me._map.fromLngLatToContainerPixel(latlng);
		station.innerHTML = sContent;
		station.style.display = 'block';
		station.style.top = (newpoint.y-40)+'px';
		station.style.left = newpoint.x+'px';
		//alert(station.style.top+','+station.style.left);
	});
	SFUtil.eventAdd(marker.div_, 'mouseout', function() {
		station.style.display = 'none';
	});
	if('undefined' != typeof subwayTemp.center)
	{
		station.innerHTML = sContent;
		station.style.display = 'block';
		station.style.top = (point.y-40)+'px';
		station.style.left = point.x+'px';
	}
	//return marker;
};
MapApi.prototype.drawSubwayStation = function(subwayLineSites)
{
	var me = this;
	var map = me._map;
	for(var p=0; p<subwayLineSites.length; p++)
	{
		me.createSubwayMarker(subwayLineSites[p]);
		//var subwaymarker = me.createSubwayMarker(subwayLineSites[p]);
		//map.addOverlay(subwaymarker);
	}
};
MapApi.prototype.addOverlay = function(o)
{
	this._map.addOverlay(o);
};
MapApi.prototype.removeOverlay = function(o)
{
	this._map.removeOverlay(o);
};
function MarkerManager(map)
{
	this._markers = [];
	this._map = map;
}
MarkerManager.prototype.addMarker = function(marker)
{
	this._markers.push(marker);
	this._map.addLabeledMarker(marker);
};
MarkerManager.prototype.clearMarkers = function(marker)
{
	while(this._markers.length > 0)
	{
		this._map.removeOverlay(this._markers.shift());
	}
};
/*扩展bounds的范围*/
MLngLatBounds.prototype.extend = function(ll)
{
	//alert('ll:'+ll.lngX+','+ll.latY);
	if(!this.southWest || !this.northEast)
	{
		this.southWest = this.northEast = ll;
	}
	else
	{
		var sw = this.southWest;
		var ne = this.northEast;
		var lngMin = sw.lngX > ll.lngX ? ll.lngX : sw.lngX;
		var latMin = sw.latY > ll.latY ? ll.latY : sw.latY;
		var lngMax = ne.lngX < ll.lngX ? ll.lngX : ne.lngX;
		var latMax = ne.latY < ll.latY ? ll.latY : ne.latY;

		//alert(lngMin+','+latMin+' vs '+lngMax+','+latMax);
		this.southWest = new MLngLat(lngMin, latMin);
		this.northEast = new MLngLat(lngMax, latMax);
	}
	//alert('sw:'+this.southWest.lngX+','+this.southWest.latY);
	//alert('ne:'+this.northEast.lngX+','+this.northEast.latY);
};
MLngLatBounds.prototype.containsBounds = function(bounds)
{
	if(!this.southWest || !this.northEast) return false;
	if(!bounds.southWest || !bounds.northEast) return true;
	var swo = this.southWest;
	var neo = this.northEast;
	var swi = bounds.southWest;
	var nei = bounds.northEast;
	if(swi.lngX >= swo.lngX && swi.latY >= swo.latY && nei.lngX <= neo.lngX && nei.latY <= neo.latY) return true;
	return false;
};
MLngLatBounds.prototype.containsLatLng = function(ll)
{
	if(!this.southWest || !this.northEast) return false;
	var swo = this.southWest;
	var neo = this.northEast;
	if(ll.lngX >= swo.lngX && ll.latY >= swo.latY && ll.lngX <= neo.lngX && ll.latY <= neo.latY) return true;
	return false;
};
MMarker.prototype.setLatLng = function(ll)
{
	this.lnglat = ll;
};
/*
* 参数说明：
*   latlng: 经纬度
*   opts: labelOffset MSize(width:marker的尖角与左边界的距离*2,height:marker的尖角与上边界的距离)
*         labelClass label的className
*         labelText label的内容
* 使用说明：
*   1. 请用MMap.addLabeledMarker而不是addOverlay添加标注
*   2. 标注的事件要注册在LabeledMarker.div_上
*/
function LabeledMarker(latlng,opts){
	var mOpt = new MMarkerOptions();
	mOpt.imageSize = opts.labelOffset || new MSize(0, 0);
	var div = document.createElement('div');
	div.className = opts.labelClass || '';
	div.innerHTML = opts.labelText || '';
	var marker = new MMarker(latlng,mOpt);
	marker.div_ = div;
	return marker;
}
MMap.prototype.addLabeledMarker = function (a, d) {
	this.addOverlay(a,d);
	if ((b = Mapabc.Util.getElement(a.id)) && a.div_) {
		b.innerHTML = '';
		b.style.filter = '';
		b.appendChild(a.div_);
	}
};