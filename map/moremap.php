<?php

include '../house5/base.php';
$sitelist  = getcache('sitelist','commons');
$map_key = $sitelist[1]['map_key'];
$id = intval(trim($_GET['i']));
$id2 = intval(trim($_GET['ii']));
$title = trim($_GET['t']);
$title2 = trim($_GET['tt']);
$x = trim($_GET['x']);
$y = trim($_GET['y']);
$xx = trim($_GET['xx']);
$yy = trim($_GET['yy']);
$z = trim($_GET['z']);
$price = trim($_GET['p']);
$price2 = trim($_GET['pp']);
$priceunit = trim($_GET['pu']);
$priceunit2 = trim($_GET['pu2']);
$address = trim($_GET['a']);
$address2 = trim($_GET['aa']);
$tel = trim($_GET['d']);
$tel2 = trim($_GET['dd']);
$xszt = trim($_GET['s']);
$xszt2 = trim($_GET['ss']);
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
if(($priceunit2=="0")||empty($priceunit2))
{
$pu2 = '元/平方米';
}
else
{
$pu2 = '元/套';
}
if(empty($price2)||($price2=='一房一价'))
{
$price2 = '一房一价';
$pu2 = '';
}
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">   
<html xmlns="http://www.w3.org/1999/xhtml">   
<head>   
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />   

<title>';echo $title;;echo ' 地图上的位置 </title> 
<meta name="keywords" content="';echo $title;;echo '地图, ';echo $title;;echo '地图位置,';echo $title;;echo '电子地图,';echo $title;;echo '区域位置">
<meta name="description" content="';echo $title;;echo '地图, ';echo $title;;echo '地图位置, ';echo $title;;echo '电子地图, ';echo $title;;echo '区域位置">

<script src=\'http://app.mapabc.com/apis?&t=ajaxmap&v=2.1.2&key=';echo $map_key;;echo '\' type=\'text/javascript\'></script>
<link href="./mf/img/css.css" rel="stylesheet" type="text/css"/> 


<script type="text/javascript">

   


var x=';echo $x;;echo ';
var y=';echo $y;;echo ';
var x1=x;
var y1=y;
var xx=';echo $xx;;echo ';
var yy=';echo $yy;;echo ';
var saling="';echo $xszt;;echo '";
var saling2="';echo $xszt2;;echo '";
var newCode="';echo $id;;echo '";
var newCode2="';echo $id2;;echo '";
var title="';echo $title;;echo '";
var title2="';echo $title2;;echo '";
var price="均价：<span class=\\"redc\\">';echo $price;;echo '</span>';echo $pu;;echo '";
var price2="均价：<span class=\\"redc\\">';echo $price2;;echo '</span>';echo $pu2;;echo '";
var tel="';echo $tel;;echo '";
var tel2="';echo $tel2;;echo '";
var address="";
var address2="";


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

var content2=\'\'
+\'<div class="map_k">\'
+\'<div class="maptitlea">\'
+\'<div class="a1"><b>\'+title2+\'</b> <img src="./mf/img/close.gif" onclick="mapObj.closeTip();"/></div>\'
+\'</div>\'
+\'<div class="mapcon">\'
+\'<ul>\'
+\'\'+address2+\'\'
+\'<li>\'+price2+\'</li>\'
+\'<li>电话：<span class="redc">\'+tel2+\'</span></li>\'
+\'<li><a class="bluec" target="_blank" href="';echo HOUSE_PATH;;echo '\'+newCode2+\'/xinxi.html">查看详细信息>></a></li>\'
+\'</ul>\'
+\'</div>\'
+\'</div>\';
var ltext2 = \'<div class=mapFinddingCanvasLabelStyle\'+saling2+\'><table id="tip\'+newCode2+\'" cellpadding=0 cellspacing=0 border=0><tr><td class="s1">&nbsp;</td><td class="s2"><b>\'+title2+\'</b></td><td class="s3">&nbsp;</td></tr><tr><td colspan="3" class="s5"></td></tr></table></div>\';
var mapObj=null;
var tipOption=new MTipOptions();  
window.onload=function(){
	mapInit(x,y);
	addPolygonTip(x1,y1,newCode,content);
	addMarker(x,y,newCode,ltext);
	addMarker(xx,yy,newCode2,ltext2);
	addPolygonTip(xx,yy,newCode2,content2);
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
function addMarker(x,y,newCode,ltext){ 
    var opt = new MBoxOptions();   
    opt.content = ltext;   
    opt.boxAlign = BOTTOM_LEFT;   
    var box = new MBox(new MLngLat(x,y),opt);   
    box.id = "newCode"+newCode;   
    mapObj.addOverlay(box,true); 
	mapObj.zoomOut();
}   
function addPolygonTip(x,y,newCode,content){
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
	polygon.id="polygon"+newCode;   
	mapObj.addOverlay(polygon,true);
	mapObj.openOverlayTip(polygon.id);
}
</script>   
</head>   
<body>   
<div id="map" style="width:650px; height:250px"></div>   
</body> 



  
</html>
';?>