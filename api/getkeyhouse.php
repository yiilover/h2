<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$modelid = '13';
$db = '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$keyword = iconv('utf-8','gbk',trim($_GET['keyword']));
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
$sql = "map<>'' and title like '%$keyword%'";
$result = $db->select($sql,'id,title,xszt,address,map',$limit,$order,'','id');
if($result)
{
$num=count($result);
$json = array();
foreach($result AS $k=>$v) {
list($lngX,$latY,$zoom) = explode('|',$v['map']);
$title = iconv('GBK','UTF-8',$v['title']);
$title = unicode_encode($title);
$address = iconv('GBK','UTF-8',$v['address']);
$address = unicode_encode($address);
$r = array('floorId'=>$v['id'],'floor'=>$title,'saleCount'=>0,'address'=>$address,'sellSchedule'=>$v['xszt'],'bmapx'=>$lngX,'bmapy'=>$latY,'current'=>0);
$json[] = JSON($r);
}
$json_str ="{\"newHouses\":";
$json_str .= implode(',',$json);
$json_str .= "}";
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
function JSON($array) {
arrayRecursive($array,'urlencode',true);
$json = json_encode($array);
return urldecode($json);
}
?>