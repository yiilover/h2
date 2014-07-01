<?php

$myLat = $_POST['xposition'];
$myLng = $_POST['yposition'];
$range = 180 / pi() * 2 / 6372.797;
$lngR = $range / cos($myLat * pi() / 180);
$maxLat = $myLat +$range;
$minLat = $myLat -$range;
$maxLng = $myLng +$lngR;
$minLng = $myLng -$lngR;
$modelid = '13';
$db = '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$sql = "map<>'' and status=99";
$result = $db->select($sql,'id,title,thumb,address,price,priceunit,map',$limit,'id desc');
if($result)
{
$num=0;
foreach($result AS $k=>$v) {
list($lngX,$latY,$zoom) = explode('|',$v['map']);
if(($lngX>$minLng) &&($lngX<=$maxLng) &&($latY>$minLat) &&($latY<=$maxLat))
{
$v['title'] = iconv('GBK','UTF-8',$v['title']);
if (!empty($v['price']) &&$v['price']!="一房一价")
{
if($v['priceunit']=="0")
{
$v['price'] = $v['price'].'元/平米';
}
elseif($v['priceunit']=="2")
{
$v['price'] = price_short($v['price']).'/套';
}
}
else
$v['price'] ='一房一价';
$v['price'] = iconv('GBK','UTF-8',$v['price']);
$v['title'] = unicode_encode($v['title']);
$v['price'] = unicode_encode($v['price']);
$v['address'] = iconv('GBK','UTF-8',$v['address']);
$v['address'] = unicode_encode($v['address']);
$v['thumb'] = thumb($v['thumb'],100,100,0);
$v['thumb'] = str_replace('/','\/',$v['thumb']);
$title[] = "[\\\"".$lngX."\\\",\\\"".$latY."\\\",\\\"".$v['title']."\\\",\\\"".$v['price']."\\\",\\\"".$v['address']."\\\",\\\"\\\",\\\"".$v['thumb']."\\\",\\\"".$v['id']."\\\"]";
}
}
$xml_str = implode(',',$title);
}
echo '["'.$xml_str.'"]';
function unicode_encode($name)
{
$name = urldecode($name);
$name = iconv('UTF-8','UCS-2',$name);
$len = strlen($name);
$str = '';
for ($i = 0;$i <$len -1;$i = $i +2)
{
$c = $name[$i];
$c2 = $name[$i +1];
if (ord($c) >0)
{
$str .= '\u'.base_convert(ord($c),10,16).str_pad(base_convert(ord($c2),10,16),2,0,STR_PAD_LEFT);
}
else
{
$str .= $c2;
}
}
return $str;
}
?>