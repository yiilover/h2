<?php

error_reporting(0);
$pic = trim($_GET['pic']);
if(isset($pic)&&!empty($pic))
{
;echo '<html>
<head>
<title>�������ز���ͼƬ���Ų鿴���� -  �������ز���</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta name="keywords" content="�������ز�,�������ַ�,�������ز������������ز��Ż���Ϣ��,��������,������̳">
<meta name="description" content="�������ز����Թ�������Ѷ ��չʾƽ̨Ϊ��ּ ������ȫ���������ز�������Ѷ �ṩ�ʱ�������ز�¥�̵���ϸ���� Ϊ�������ز���ҵ�����������߼���һ���������ز�������Ϣ����������������">
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