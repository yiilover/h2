<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$modelid = '13';
$db = '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$type = trim($_GET['type']);
$x1 = $_GET['minY'];
$x2 = $_GET['maxY'];
$y1 = $_GET['minX'];
$y2 = $_GET['maxX'];
$newcode = intval($_POST['newcode']);
$newcode_list = $_POST['newcode_list'];
$keyword = safe_replace(iconv('utf-8','gbk',trim($_GET['keywords'])));
$sql = "map<>''";
$price = intval($_GET['price']);
$huxingshi = intval($_GET['roomtype']);
$area_range = intval($_GET['area']);
$projecttype = intval($_GET['projecttype']);
if (isset($keyword) &&!empty($keyword))
{
$sql.=" and `title` like '%$keyword%'";
}
$opentime = $_POST['opentime'];
$sale = $_POST['sale'];
if (isset($sale) &&!empty($sale))
{
$sql.=" and `xszt` in ($sale)";
}
if (isset($price) &&!empty($price))
{
$sql.=" and `range` = $price";
}
$districts = $_POST['districts'];
$params = $_POST['params'];
$buildfeature = intval($_GET['buildfeature']);
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
if (isset($buildfeature) &&!empty($buildfeature))
{
$sql.=" and `character` like '%$buildfeature%'";
}
if (isset($projecttype) &&!empty($projecttype))
{
$sql.=" and `type` like '%$projecttype%'";
}
$result = $db->select($sql,'id,title,type,address,price,thumb,opentime,map,xszt',$limit,$order,'','id');
if($result)
{
$num=0;
$json = array();
foreach($result AS $k=>$v) {
if (isset($keyword) &&!empty($keyword))
{
list($lngX,$latY,$zoom) = explode('|',$v['map']);
$num++;
if(($v['priceunit']=="0")||empty($v['priceunit']))
{
$priceunit = '元/平方米';
}
else
{
$priceunit = '元/套';
}
if(empty($v['price'])||($v['price']=='一房一价')||($v['price']==''))
{
$v['price'] = '一房一价';
$priceunit = '';
}
$title = iconv('GBK','UTF-8',$v['title']);
$title = unicode_encode($title);
$address = iconv('GBK','UTF-8',$v['address']);
$address = unicode_encode($address);
$r = array('floorId'=>$v['id'],'floor'=>$title,'address'=>$address,'saleCount'=>$v['price'],'bmapx'=>$lngX,'bmapy'=>$latY,'sellSchedule'=>$v['xszt']);
$json[] = JSON($r);
}
else 
{
list($lngX,$latY,$zoom) = explode('|',$v['map']);
if(($lngX>$x1) &&($lngX<$x2) &&($latY>$y1) &&($latY<$y2))
{
$num++;
if(($v['priceunit']=="0")||empty($v['priceunit']))
{
$priceunit = '元/平方米';
}
else
{
$priceunit = '元/套';
}
if(empty($v['price'])||($v['price']=='一房一价')||($v['price']==''))
{
$v['price'] = '一房一价';
$priceunit = '';
}
$title = iconv('GBK','UTF-8',$v['title']);
$title = unicode_encode($title);
$address = iconv('GBK','UTF-8',$v['address']);
$address = unicode_encode($address);
$r = array('floorId'=>$v['id'],'floor'=>$title,'address'=>$address,'saleCount'=>$v['price'],'bmapx'=>$lngX,'bmapy'=>$latY,'sellSchedule'=>$v['xszt']);
$json[] = JSON($r);
}
else
{
continue;
}
}
}
if($num>0)
{
$json_str ="{\"newHouses\":[";
$json_str .= implode(',',$json);
$json_str .= "]}";
}
else
{
$json_str ="{\"newHouses\":null}";
}
echo $json_str;
}
else
{
$json_str ="{\"newHouses\":null}";
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