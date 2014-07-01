<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$modelid = '13';
$db = '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$regionSubway = intval($_GET['regionSubway']);
$keyword = trim($_GET['keyword']);
$housetype = intval($_GET['housetype']);
$price = intval($_GET['price']);
$page = intval($_GET['page'])?intval($_GET['page']):1;
$pagesize = 8;
$offset = ($page -1) * $pagesize;
$limit = "$offset,$pagesize";
$sql = "status='99'";
if(!empty($regionSubway))
{
$arrchildid = get_arrchildid('3360',$regionSubway);
$sql.=" and `region` in ($arrchildid)";
}
if(!empty($keyword))
{
$sql.= " and title like '%$keyword%'";
}
if(!empty($housetype ))
{
$sql.=" and `type` like '%$housetype%'";
}
if(!empty($price ))
{
$sql.=" and `range`=$price";
}
$order = "id desc";
$result = $db->select($sql,'title,id,thumb,price,priceunit,region,character,dzinfo',$limit,$order,'','id');
if($result)
{
foreach($result AS $k=>$r) {
$title = iconv('GBK','UTF-8',$r['title']);
$title = unicode_encode($title);
$menu_info = menu_info('3360',$r[region]);
$regionname = iconv('GBK','UTF-8',$menu_info[0]);
$regionid = $menu_info[1];
$regionname = unicode_encode($regionname);
$featureString = iconv('GBK','UTF-8',get_charactername($r['character']));
$featureString = unicode_encode($featureString);
$r['thumb'] = thumb($r['thumb'],130,90,0);
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
if(empty($r['dzinfo']))
{
$r['dzinfo'] = '暂无资料';
}
$dzinfo = iconv('GBK','UTF-8',$r['dzinfo']);
$dzinfo = unicode_encode($dzinfo);
$r = array('FId'=>$r['id'],'FName'=>$title,'FRegionId'=>$regionid,'FRegionName'=>$regionname,'FCover'=>$r['thumb'],'FPriceDisplayStr'=>$price,'FShortDiscount'=>$dzinfo,'isXFD'=>false,'isGroupbuy'=>false,'featureString'=>$featureString);
$json[] = JSON($r);
}
$json_str .= implode(',',$json);
}
$num = $db->count($sql);
$totalpage = ceil($num/8);
echo 'var kftSearchResultJson = {"totalPage":'.$totalpage.',"totalNum":'.$num.',"curPage":'.$page.',"curPageData":['.$json_str.']};';
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