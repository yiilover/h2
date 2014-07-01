<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$modelid = '13';
$db = '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$id_list = intval($_GET['id_list']);
$keyword = trim($_GET['keyword']);
if(!empty($id_list))
{
$sql = "id= $id_list";
}
if(!empty($keyword))
{
$keyword = iconv('UTF-8','GBK',$keyword);
$sql = "title like '%$keyword%'";
}
$result = $db->select($sql,'title,id,thumb,price,priceunit,region,character,dzinfo','10');
if($result)
{
foreach($result AS $k=>$r) {
$title = iconv('GBK','UTF-8',$r['title']);
$title = unicode_encode($title);
$menu_info = menu_info('3360',$r[region]);
$regionname = iconv('GBK','UTF-8',$menu_info[0]);
$regionname = unicode_encode($regionname);
$featureString = iconv('GBK','UTF-8',get_charactername($r['character']));
$featureString = unicode_encode($featureString);
$r['thumb'] = str_replace('/','\/',$r['thumb']);
if (!empty($r[price]) &&$r[price]!="一房一价")
{
if($r[priceunit]=="0")
{
$price = '均价：'.$r[price].'元/平米';
}
elseif($r[priceunit]=="2")
{
$price = price_short($r[price]).'/套';
}
}
else
$price ='一房一价';
$price = iconv('GBK','UTF-8',$price);
$price = unicode_encode($price);
$dzinfo = iconv('GBK','UTF-8',$r['dzinfo']);
$dzinfo = unicode_encode($dzinfo);
$r = array('FId'=>$r['id'],'FName'=>$title,'FRegionId'=>$r['region'],'FRegionName'=>$regionname,'FCover'=>$r['thumb'],'FPriceDisplayStr'=>$price,'FShortDiscount'=>$dzinfo,'isXFD'=>false,'isGroupbuy'=>false,'featureString'=>$featureString);
$json[] = JSON($r);
}
$json_str .= implode(',',$json);
}
echo 'var kftSearchResultJson = {"totalPage":1,"totalNum":1,"curPage":1,"curPageData":['.$json_str.']};';
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