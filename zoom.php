<?php

error_reporting(0);
$pic = trim($_GET['pic']);
if(isset($pic)&&!empty($pic))
{
;echo '<html>
<head>
<title>威海房地产网图片缩放查看工具 -  威海房地产网</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="keywords" content="威海房地产,威海二手房,威海房地产网，威海房地产门户信息网,房产博客,房产论坛">
<meta name="description" content="威海房地产网以供房产资讯 建展示平台为宗旨 网罗最全面威海房地产新闻资讯 提供最及时威海房地产楼盘的详细资料 为威海房地产企业与威海购房者架起一座威海房地产网络信息互动交流的桥梁！">
</head>
 
<body bgColor="#ffffff" text="#000000" style="cursor:hand;margin:0;padding:0"> 
<center>
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="100%" height="100%">
<param name="movie" value="statics/style/house/picviewfull.swf" />
<param name="quality" value="high">
<param name="FlashVars" value="p1Src=';echo $pic;echo '">
<embed name="FlashVars" src="statics/style/house/picviewfull.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="100%" height="100%" FlashVars="p1Src=';echo $pic;echo '"></embed>
</object>
</center>
</body>
</html>
';}?>