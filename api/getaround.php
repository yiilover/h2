<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$modelid = '13';
$db = '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$x1 = $_GET['minY'];
$x2 = $_GET['maxY'];
$y1 = $_GET['minX'];
$y2 = $_GET['maxX'];
$sql = "map<>''";
$opentime = $_POST['opentime'];
$sale = $_POST['sale'];
if (isset($sale) &&!empty($sale))
{
$sql.=" and `xszt` in ($sale)";
}
$districts = $_POST['districts'];
$params = $_POST['params'];
$purposes = intval($_POST['purposes']);
$sort = $_POST['sort'];
if (isset($sort) &&!empty($sort))
{
if($sort=="pa")
{
$order = "price asc";
}
elseif($sort=="pd")
{
$order = "price desc";
}
}
$random = $_POST['random'];
if (isset($purposes) &&!empty($purposes))
{
$sql.=" and `type` like '%$purposes%'";
}
$result = $db->select($sql,'id,title,type,xszt,address,price,priceunit,tel,thumb,opentime,map',$limit,$order,'','id');
if($result)
{
$num=0;
$json = array();
foreach($result AS $k=>$v) {
list($lngX,$latY,$zoom) = explode('|',$v['map']);
if(($lngX>$x1) &&($lngX<$x2) &&($latY>$y1) &&($latY<$y2))
{
$title = iconv('GBK','UTF-8',$v['title']);
$title = unicode_encode($title);
$address = iconv('GBK','UTF-8',$v['address']);
$address = unicode_encode($address);
$r = array('lat'=>$latY,'lng'=>$lngX,'title'=>$title,'address'=>$address,'raw_id'=>$v['id']
);
$json[] = JSON($r);
}
else
{
continue;
}
}
$json_str .= "[";
$json_str .= implode(',',$json);
$json_str .= "]";
echo $json_str;
}
else
{
$json_str ="{status:\"1\",allnum:\"0\",maxpage:\"0\",pagenow:\"0\",hits:{";
$json_str .= "hit:[";
$json_str .= "]}}";
echo $json_str;
}
function arrayRecursive(&$array,$function,$apply_to_keys_also = false)
{
foreach ($array as $key =>$value) {
if (is_array($value)) {
arrayRecursive($array[$key],$function,$apply_to_keys_also);
}else {
$array[$key] = $function($value);
}
if ($apply_to_keys_also &&is_string($key)) {
$new_key = $function($key);
if ($new_key != $key) {
$array[$new_key] = $array[$key];
unset($array[$key]);
}
}
}
}
function JSON($array) {
arrayRecursive($array,'urlencode',true);
$json = json_encode($array);
return urldecode($json);
}
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