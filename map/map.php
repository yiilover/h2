<?php

include '../house5/base.php';
$sitelist  = getcache('sitelist','commons');
$map_key = $sitelist[1]['map_key'];
$site_title = $sitelist[1]['site_title'];
$default_city = $sitelist[1]['default_city'];
$id = intval(trim($_GET['i']));
$title = trim($_GET['t']);
$x = trim($_GET['x']);
$y = trim($_GET['y']);
$z = trim($_GET['z']);
$price = trim($_GET['p']);
$priceunit = trim($_GET['pu']);
$address = trim($_GET['a']);
$tel = trim($_GET['d']);
$xszt = trim($_GET['s']);
if(($priceunit=="0")||empty($priceunit))
{
$pu = '元/平方米';
}
else
{
$pu = '元/套';
}
if(empty($price)||($price=='一房一价'))
{
$price = '一房一价';
$pu = '';
}
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml">   
<head>   
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />   

<title>';echo $title;;echo ' 地图上的位置 - ';echo $site_title;;echo '</title> 
<meta name="keywords" content="';echo $default_city;;echo '';echo $title;;echo '地图, ';echo $title;;echo '地图位置,';echo $title;;echo '电子地图,';echo $title;;echo '区域位置">
<meta name="description" content="';echo $default_city;;echo '';echo $title;;echo '地图, ';echo $title;;echo '地图位置, ';echo $title;;echo '电子地图, ';echo $title;;echo '区域位置">

<script src=\'http://app.mapabc.com/apis?&t=ajaxmap&v=2.1.2&key=';echo $map_key;;echo '\' type=\'text/javascript\'></script>
<link href="./mf/img/css.css" rel="stylesheet" type="text/css"/> 


<script type="text/javascript">

   


var x=';echo $x;;echo ';
var y=';echo $y;;echo ';
var x1=x;
var y1=y;
var saling="';echo $xszt;;echo '";
var newCode="';echo $id;;echo '";
var title="';echo $title;;echo '";
var price="均价：<span class=\\"redc\\">';echo $price;;echo '</span>';echo $pu;;echo '";
var tel="';echo $tel;;echo '";
var address="";


var mapObj=null;
var content=\'\'
+\'<div class="map_k">\'
+\'<div class="maptitlea">\'
+\'<div class="a1"><b>\'+title+\'</b> <img src="./mf/img/close.gif" onclick="mapObj.closeTip();"/></div>\'
+\'</div>\'
+\'<div class="mapcon">\'
+\'<ul>\'
+\'\'+address+\'\'
+\'<li>\'+price+\'</li>\'
+\'<li>电话：<span class="redc">\'+tel+\'</span></li>\'
+\'<li><a class="bluec" target="_blank" href="';echo HOUSE_PATH;;echo '\'+newCode+\'/xinxi.html">查看详细信息>></a></li>\'
+\'</ul>\'
+\'</div>\'
+\'</div>\';
var ltext = \'<div class=mapFinddingCanvasLabelStyle\'+saling+\'><table id="tip\'+newCode+\'" cellpadding=0 cellspacing=0 border=0><tr><td class="s1">&nbsp;</td><td class="s2"><b>\'+title+\'</b></td><td class="s3">&nbsp;</td></tr><tr><td colspan="3" class="s5"></td></tr></table></div>\';
var mapObj=null;
var tipOption=new MTipOptions();  

window.onload=function(){
	mapInit(x,y);
	addPolygonTip(x1,y1);
	addMarker(x,y);
}
function mapInit(x,y) {   
    var mapOptions = new MMapOptions();
    mapOptions.zoom=13;
    mapOptions.toolbar = SMALL;
    mapOptions.toolbarPos = new MPoint(2,0); 
    mapOptions.center=new MLngLat(x,y);
    mapOptions.scale = SHOW;
    mapOptions.returnCoordType = COORD_TYPE_OFFSET;
    mapOptions.zoomBox = true;
	
    mapObj=new MMap("map",mapOptions);
}   
function addMarker(x,y){ 
    var opt = new MBoxOptions();   
    opt.content = ltext;   
    opt.boxAlign = BOTTOM_LEFT;   
    var box = new MBox(new MLngLat(x,y),opt);   
    box.id = "newCode"+newCode;   
    mapObj.addOverlay(box,true); 
	mapObj.zoomOut();
}   
function addPolygonTip(x,y){
	var tipOption = new MTipOptions();
	tipOption.tipType = HTML_CUSTOM_TIP;
	tipOption.content = content;
	tipOption.tipAlign=TOP_LEFT;
	tipOption.tipPosition=new MPoint(10,10);
	var arr=new Array();
	arr.push(new MLngLat(x,y));
	arr.push(new MLngLat(x,y));
	arr.push(new MLngLat(x,y));
	var areaopt=new MAreaOptions();
	areaopt.canShowTip=true;
	areaopt.tipOption=tipOption;
	var polygon=new MPolygon(arr,areaopt);
	polygon.id="polygon01";
	mapObj.addOverlay(polygon,true);
	mapObj.openOverlayTip("polygon01");
}
</script>   
</head>   
<body>   
<div id="map" style="width:650px; height:250px"></div>   
</body> 



  
</html>
';?>