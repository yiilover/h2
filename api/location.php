<?php

$x = $_GET['geox'];
$y = $_GET['geoy'];
$url = 'http://maps.google.com/maps/api/geocode/xml?latlng='.$x.','.$y.'&language=zh-CN&sensor=false';
$doc = new DOMDocument();
$doc->load($url);
$books = $doc->getElementsByTagName( "GeocodeResponse");
foreach( $books as $book )
{
$status1 = $book->getElementsByTagName( "status");
$status = $status1->item(0)->nodeValue;
if($status=='OK')
{
$formatted_address = $book->getElementsByTagName( "formatted_address");
$address = $formatted_address->item(0)->nodeValue;
$address = iconv('utf-8','gbk',$address);
$find = stripos($address,' ');
if($find!==false)
{
$address = substr($address,0,$find);
}
$address = str_replace('ÖÐ¹ú','',$address);
$json_str ="{\"root\":";
$json_str .= "{\"encity\":\"\",\"city\":\"\",\"addr\":\"".$address."\"}}";
echo $json_str;
die;
}
}
?>