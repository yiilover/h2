<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$field = remove_xss(safe_replace(trim($_GET['field'])));
$modelid = intval($_GET['modelid']);
$data = getcache('model_field_'.$modelid,'model');
$setting = string2array($data[$field]['setting']);
$maptype = $_GET['maptype'] ?intval($_GET['maptype']) : ($setting['maptype'] ?$setting['maptype'] : 1);
$sitelist  = getcache('sitelist','commons');
$key = $sitelist[1]['map_key'];
$defaultcity = $sitelist[1]['default_city'] ?$sitelist[1]['default_city'] : '����';
$hotcitys = explode(",",$setting['hotcitys']);
if(!isset($_GET['city'])) {
;echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"';if(isset($addbg)) {;echo ' class="addbg"';};echo '>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=';echo CHARSET ;echo '">
';if($maptype == 1) {;echo '<script type="text/javascript" src="http://app.mapabc.com/apis?&t=ajaxmap&v=2.1.2&key=';echo $key;echo '"></script> 
';}elseif($maptype == 2) {;echo '<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.2&key=';echo $key;echo '"></script></script>
';};echo '<script type="text/javascript" src="';echo JS_PATH ;echo 'jquery.min.js"></script>

<style type="text/css">
*{ padding:0; margin:0}
body{font-size: 12px;}
#toolbar{ background-color:#E5ECF9;zoom:1; height:24px; line-height:24px; padding:0 12px; margin-top:3px; position:relative}
#toolbar a{display:inline-block;zoom:1;*display:inline; color:#4673CC}
#toolbar a.mark,#toolbar a.map{ background: url(';echo IMG_PATH ;echo 'icon/map_mark.png) no-repeat left 50%; padding:0 0 0 20px}
#toolbar a.map{ background-image:url(';echo IMG_PATH ;echo 'icon/map.png); margin-left:12px}
#toolbar .right{ float:right;}
#toolbar .CityBox{position:absolute; left:40px; top:30px; background-color:#fff; border:1px solid #8BA4D8; padding:2px; z-index:1; width:200px; display:none}
#toolbar .CityBox h4{background-color:#E5ECF9; line-height:20px; height:20px; padding:0 6px; color:#6688CC; position:relative}
#toolbar .CityBox h4 div.top{background: url(';echo IMG_PATH ;echo 'topo.png) no-repeat; height:6px; width:11px; position:absolute; top:-9px; left:38px; line-height:normal; font-size:0}
#toolbar .CityBox .content{ padding:6px; height:150px;overflow-y:auto; padding-bottom:8px}
#toolbar .CityBox a.close{background: url(';echo IMG_PATH ;echo 'cross.png) no-repeat left 3px; display:block; width:16px; height:16px;position: absolute;outline:none;right:3px; bottom:1px}
#toolbar .CityBox a.close:hover{background-position: left -46px}
#toolbar .CityBox .line{ height:6px; border-bottom:1px solid #EBEBEB; margin-bottom:5px;}
#mapObj{width:699px;height:388px; padding-top:1px}

</style>
</head>
<body>
<div id="toolbar">
	<div class="selCity">
    	<div class="right"><a href="javascript:;" class="mark" onClick="addMarker();">';echo L('api_addmark','','map');echo '</a><a href="javascript:;" onClick="removeMarker();" class="map">';echo L('api_resetmap','','map');echo '</a></div>
    	<strong id="curCity">';echo $defaultcity;echo '</strong> [<a onClick="mapClose();" id="curCityText" href="javascript:;">';echo L('api_keyword','','map');echo '</a>]
    </div>
    <div class="CityBox">
    	<h4><div class="top"></div><a href="javascript:;" class="close" onClick="mapClose();"></a></h4>
        <div class="content" style="height:30px;overflow:auto;width:200px;>
			<p>
			';foreach($hotcitys as $n=>$city) {;echo '        	<a href="javascript:;" onClick="keywordSearch(\'';echo trim($city);echo '\')">';echo $city;echo '</a> 
			';};echo '			</p>
            <div class="line"></div>
			<input type="text" value="';echo L('api_inputkeyword','','map');echo '" style=" width:140px; height:18px" name="keyword" id="keyword" onclick="$(this).val(\'\');">
			<input type="submit" value="';echo L('api_citysear_submit','','map');echo '" class="city_submit" onClick="keywordSearch()">
        </div>
		<div id="result" name="result" style="height:300px;overflow:auto;width:200px;margin-top:5px"></div>
    </div>
</div>
<div id="mapObj" class="view"></div>
';if($maptype == 1) {;echo '<SCRIPT LANGUAGE="JavaScript">
  //�������ĵ�Ϊ����
  //���õ�ͼ��ʼ����������
  var mapOptions = new MMapOptions();
  var defaultcity = "';echo strtolower(CHARSET)!='utf-8'?iconv(CHARSET,'UTF-8',$defaultcity) : $defaultcity;echo '";
  mapOptions.toolbar = MConstants.MINI;
  mapOptions.scale = new MPoint(20,20);  
  mapOptions.zoom = 10;
  mapOptions.overviewMap = MConstants.SHOW;  
  mapOptions.scale = MConstants.SHOW; 
  mapOptions.mapComButton = MConstants.SHOW_NO
  //������ͼ����
  var mapObj = new MMap("mapObj", mapOptions);
  var  maptools = new MMapTools(mapObj);
  maptools.setCenterByCity(defaultcity);
  if(window.top.$(\'#';echo $field;echo '\').val()) {
	drawPoints();
  } 
function keywordSearch(){
	var keywords = document.getElementById("keyword").value;
	var city = "';echo $defaultcity;echo '";
	var MSearch = new MPoiSearch();
	var opt = new MPoiSearchOptions();
	opt.recordsPerPage = 10;//ÿҳ������������Ĭ��Ϊ10
	opt.pageNum = 1;//��ǰҳ����
	opt.dataType = "";//������𣬸ô�Ϊ�ִʲ�ѯ��ֻ��Ҫ�����ҵ�ؼ��ּ���
	opt.dataSources = DS_BASE_ENPOI;//����Դ������+��ҵ�ر����ݿ⣨Ĭ�ϣ�
	MSearch.setCallbackFunction(keywordSearch_CallBack);
	MSearch.poiSearchByKeywords(keywords,city,opt);
}
var resultCount=10;
function keywordSearch_CallBack(data){
	var resultStr="";
	if(data.error_message != null){
		resultStr="��ѯ�쳣��"+data.error_message;
	}else{
	switch(data.message){
		case \'ok\':
			var marker = new Array();
			if(data.poilist.length==0){
				resultStr = "δ���ҵ��κν��!<br />���飺<br />1.��ȷ�������ִ�ƴд��ȷ��<br />2.���Բ�ͬ�Ĺؼ��֡�<br />3.���Ը����Ĺؼ��֡�";
			}else{
				resultCount=data.poilist.length;
				for (var i = 0; i < data.poilist.length; i++) {
					resultStr += "<div id=\'divid"+(i+1)+"\' onmouseover=\'openMarkerTipById1("+(i+1)+",this)\' onmouseout=\'onmouseout_MarkerStyle("+(i+1)+",this)\' style=\\"font-size: 13px;cursor:pointer;padding:2px 0 10px 5px;\\">"+(i+1)+"��"+data.poilist[i].name+"<br \\/>";
					resultStr += TipContents(data.poilist[i].type,data.poilist[i].address,data.poilist[i].tel);
					resultStr += "<br />���У�"+data.poilist[i].citycode + "<br \\/></div>";
					var markerOption = new MMarkerOptions();
					markerOption.imageUrl ="http://code.mapabc.com/images/lan_1.png";

					var tipOption = new MTipOptions();
					tipOption.title=(i+1) + ". "+ data.poilist[i].name;
					var tipC = "<br />"+TipContents(data.poilist[i].type,data.poilist[i].address,data.poilist[i].tel);
					tipOption.content=tipC;//tip����
					tipOption.borderStyle.thickness=2;
					tipOption.borderStyle.color= 0x005cb5;
					tipOption.borderStyle.alpha=1;
					tipOption.titleFontStyle.name="Arial";
					tipOption.titleFontStyle.size=12;
					tipOption.titleFontStyle.color= 0xffffff;
					tipOption.titleFontStyle.bold=true;
					tipOption.contentFontStyle.name="Arial";
					tipOption.contentFontStyle.size=13;
					tipOption.contentFontStyle.color= 0x000000 ;
					tipOption.contentFontStyle.bold=false;
					tipOption.fillStyle.color= 0xFFFFFF; //���ɫ
					tipOption.fillStyle.alpha=1;
					tipOption.titleFillStyle.color=0x005cb5;
					tipOption.titleFillStyle.alpha=1;

					markerOption.tipOption = tipOption;
					markerOption.canShowTip=true;
					var mar = new MMarker(new MLngLat(data.poilist[i].x,data.poilist[i].y),markerOption);
					mar.id=(i+1);
					marker.push(mar);
				}
				mapObj.addOverlays(marker,true);
				mapObj.addEventListener(mapObj,TIP_OPEN,openTip);
			}
		break;
		case \'error\':
			resultStr= "<div class=\\"default\\"><div class=\\"default_title\\">����æ�������³��ԣ�</div><div class=\\"d_link\\"><div class=\\"d_right\\"></div><div class=\\"suggest\\"><strong>���飺</strong><br />�����ˢ��ҳ�����޷���ʾ�������������Ӻ��ٴγ��Ի��������ǵķ�����Ա��ϵ��<br />Email��service@mapabc.com <br />�绰��400 810 0080</div></div></span>������Ϣ��"+data.message+"</div>";
		break;
		default:
			resultStr= "<div class=\\"default\\"><div class=\\"default_title\\">�Բ������緱æ�����Ժ����³��ԣ�</div><div class=\\"d_link\\"><div class=\\"d_right\\"></div><div class=\\"suggest\\"><strong>���飺</strong><br />�����ˢ��ҳ�����޷���ʾ�������������Ӻ��ٴγ��Ի��������ǵķ�����Ա��ϵ��<br />Email��service@mapabc.com <br />�绰��400 810 0080</div></div></span>������Ϣ��"+data.message+"</div>";
		}
	}
	document.getElementById("result").innerHTML = resultStr;
}
function TipContents(type,address,tel){
	if (type == "" || type == "undefined" || type == null || type == " undefined" || typeof type == "undefined") {
		type = "����";
	}
	if (address == "" || address == "undefined" || address == null || address == " undefined" || typeof address == "undefined") {
		address = "����";
	}
	if (tel == "" || tel == "undefined" || tel == null || tel == " undefined" || typeof address == "tel") {
		tel = "����";
	}
	var str ="��ַ��" + address + "<br>�绰��" + tel + " <br>���ͣ�"+type;
	return str;
}
function openMarkerTipById1(pointid,thiss){  //����id�����������tip
	thiss.style.background=\'#CFD6E8\';
	mapObj.openOverlayTip(pointid);
}
function onmouseout_MarkerStyle(pointid,thiss) {//����ƿ������ʽ�ָ�
   thiss.style.background="";
}
function openTip(param){
	var n = "divid"+(param.overlayId);
	for (var i = 1; i <= resultCount; ++i){
		var id="divid"+i;
		document.getElementById(id).style.background=\'\';
		document.getElementById(id).onmouseout = function(){this.style.backgroundColor=\'\';};
	}
	document.getElementById(n).style.background=\'#CFD6E8\';
	document.getElementById(n).onmouseout = function(){this.style.backgroundColor=\'#CFD6E8\';};
}
	
	function addMarker(){
		var address = $(window.parent.document).find("input[id=\'address\']").val();
		var tipOption=new MTipOptions();//�����Ϣ���� 
		tipOption.tipType = MConstants.HTML_BUBBLE_TIP;//��Ϣ���ڱ���  
		tipOption.title = address;//��Ϣ���ڱ���  
		tipOption.content = address;//��Ϣ��������   
		var markerOption = new MMarkerOptions(); 		
		markerOption.imageUrl=\'';echo IMG_PATH ;echo 'icon/mak.png\';		
		markerOption.picAgent=false;   
		markerOption.imageAlign=MConstants.BOTTOM_CENTER; 	   
		markerOption.isBounce=false; 	  
		markerOption.isEditable=true;   		

		markerOption.tipOption = tipOption; 		 
		markerOption.canShowTip= address ? true : false; 	  
		markerOption.rotation="0"; 		  	
		markerOption.dimorphicColor="0x00A0FF"; 	  
		var center = mapObj.getCenter();
		var ZoomLevel = mapObj.getZoomLevel();
		Mmarker = new MMarker(new MLngLat(center.lngX,center.latY),markerOption);
		Mmarker.id="mark101";  
		mapObj.addOverlay(Mmarker,true) ; 		
	//	mapObj.addEventListener(mapObj,MConstants.MOUSE_UP,mouseUp);
		mapObj.addEventListener(mapObj,MOUSE_MOVING,mouseUp);
		window.top.$(\'#';echo $field;echo '\').val(center.lngX+\'|\'+center.latY+\'|\'+ZoomLevel);
	} 
	
	function removeMarker() {
		mapObj.removeAllOverlays();
		maptools.setCenterByCity(defaultcity);
		$("#curCity").html(\'';echo $defaultcity;echo '\');
		mapOptions.zoom = 10;
		window.top.$(\'#';echo $field;echo '\').val(\'\');
	}
function mouseUp(param)
	{
		var object=mapObj.getOverlayById(\'mark101\');
		var lngX = object.lnglat.lngX;
		var latY = object.lnglat.latY;
	//	alert(param.mapId+";"+param.eventType+";"+lngX+";"+latY);
		window.top.$(\'#';echo $field;echo '\').val(lngX+\'|\'+latY+\'|\'+mapObj.getZoomLevel());
	}
/*	function mouseUp(param){ 
		var object=mapObj.getOverlayById(\'mark101\');
		var lngX = object.lnglat.lngX;
		var latY = object.lnglat.latY;
		var ZoomLevel = mapObj.getZoomLevel();
		window.top.$(\'#';echo $field;echo '\').val(lngX+\'|\'+latY+\'|\'+ZoomLevel);
	}
	*/
	function mapClose(){
		var CityBox=$(".CityBox");
		if(CityBox.css(\'display\')==\'none\'){
			CityBox.show();
		}else{
			CityBox.hide();
		}
	}
	
	function drawPoints(){
		var data = window.top.$(\'#';echo $field;echo '\').val();
		var data = data.split(\'|\');
		var lngX = data[0];
		var latY = data[1];
		var zoom = data[2]? data[2] : 10
		mapObj.setZoomAndCenter(zoom,new MLngLat(lngX,latY));
		var markerOption = new MMarkerOptions();
		var tipOption=new MTipOptions();//�����Ϣ���� 
		var address = "123123";
		tipOption.tipType = MConstants.HTML_BUBBLE_TIP;//��Ϣ���ڱ���  
		tipOption.title = address;//��Ϣ���ڱ���  
		tipOption.content = address;//��Ϣ��������     
		var markerOption = new MMarkerOptions(); 		
		markerOption.imageUrl="';echo IMG_PATH ;echo 'icon/mak.png";		
		markerOption.picAgent=false;   
		markerOption.isEditable=true;  
		markerOption.imageAlign=MConstants.BOTTOM_CENTER; 	   
		markerOption.tipOption = tipOption; 		  
		markerOption.canShowTip= address ? true : false; 	  	
		markerOption.dimorphicColor="0x00A0FF"; 			 			
		Mmarker = new MMarker(new MLngLat(lngX,latY),markerOption);
		Mmarker.id="mark101";
		mapObj.addOverlay(Mmarker,true);
	//	mapObj.addEventListener(mapObj,MConstants.MOUSE_UP,mouseUp);
		mapObj.addEventListener(mapObj,MOUSE_MOVING,mouseUp);
	}	
</script>
<style>
.MFMP_pngImg0{ left:0; bottom:0; display:none}
</style>
';}elseif($maptype == 2) {;echo '<script type="text/javascript">  
var mapObj = new BMap.Map("mapObj");          // ������ͼʵ��  
//���ͼ��������ſؼ�
var ctrl_nav = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
mapObj.addControl(ctrl_nav);
mapObj.enableDragging();//���õ�ͼ��ק�¼���Ĭ������(�ɲ�д)
mapObj.enableScrollWheelZoom();//���õ�ͼ���ַŴ���С
mapObj.enableDoubleClickZoom();//�������˫���Ŵ�Ĭ������(�ɲ�д)
mapObj.enableKeyboard();//���ü����������Ҽ��ƶ���ͼ
//mapObj.centerAndZoom("';echo $defaultcity;echo '");
if(window.top.$(\'#';echo $field;echo '\').val()) {
	drawPoints();
} else {
	mapObj.centerAndZoom("';echo $defaultcity;echo '");
} 
//�����л�����
function keywordSearch(city) {
	if(city==null || city==\'\') {
		var city=$("#citywd").val();
	}
	mapObj.setCenter(city);
	$("#curCity").html(city);
}

function drawPoints(){
	var data = window.top.$(\'#';echo $field;echo '\').val();
	var data = data.split(\'|\');
	var lngX = data[0];
	var latY = data[1];
	var zoom = data[2] ? data[2] : 10;
	mapObj.centerAndZoom(new BMap.Point(lngX,latY),zoom);
	// ����ͼ�����
	var myIcon = new BMap.Icon(\'';echo IMG_PATH ;echo 'icon/mak.png\', new BMap.Size(27, 45));

	// ������ע������ӵ���ͼ
	var center = mapObj.getCenter();
	var point = new BMap.Point(lngX,latY);
	var marker = new BMap.Marker(point, {icon: myIcon});
	marker.enableDragging();
	mapObj.addOverlay(marker);
	var ZoomLevel = mapObj.getZoom();
	marker.addEventListener("dragend", function(e){  
		window.top.$(\'#';echo $field;echo '\').val(e.point.lng+\'|\'+e.point.lat+\'|\'+ZoomLevel); 
	}) 
}

function addMarker(){ 
	  mapObj.clearOverlays();
	  // ����ͼ�����
	  var myIcon = new BMap.Icon(\'';echo IMG_PATH ;echo 'icon/mak.png\', new BMap.Size(27, 45));
	
	  // ������ע������ӵ���ͼ
	  var center = mapObj.getCenter();
	  var point = new BMap.Point(center.lng,center.lat);
	  var marker = new BMap.Marker(point, {icon: myIcon});
	  marker.enableDragging();
	  mapObj.addOverlay(marker);
	  var ZoomLevel = mapObj.getZoom();
	  window.top.$(\'#';echo $field;echo '\').val(center.lng+\'|\'+center.lat+\'|\'+ZoomLevel);
	  marker.addEventListener("dragend", function(e){  
		window.top.$(\'#';echo $field;echo '\').val(e.point.lng+\'|\'+e.point.lat+\'|\'+ZoomLevel); 
	}) 
}

function mapClose(){
	var CityBox=$(".CityBox");
	if(CityBox.css(\'display\')==\'none\'){
		CityBox.show();
	}else{
		CityBox.hide();
	}
}

function removeMarker() {
	mapObj.clearOverlays();
	mapObj.centerAndZoom("';echo $defaultcity;echo '");
	$("#curCity").html(\'';echo $defaultcity;echo '\');
	window.top.$(\'#';echo $field;echo '\').val(\'\');
}
</script>  
';};echo '</body>
</html>
';
}elseif(!empty($_GET['keyword']) &&$maptype==1) {
if(!$_GET['keyword'])  showmessage(L('error'));
$keyword = urldecode(trim($_GET['keyword']));
echo $keyword;
}
?>