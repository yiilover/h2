<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$modelid = '13';
$db = '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$purposes = $_POST['item_0'];
$price = $_POST['item_1'];
$regionid = $_POST['item_2'];
$limit = intval($_POST['limit']);
$sql = "xszt<>'4'";
if(!empty($regionid))
{
if(!empty($_POST['item_3']))
{
$regionid = intval($_POST['item_3']);
$sql.=" and `region` = '$regionid'";
}
else
{
$arrchildid = get_arrchildid('3360',$regionid);
$sql.=" and `region` in ($arrchildid)";
}
}
$character = $_POST['item_4'];
$price = preg_match ( '/([0-9]+),([0-9]+)/',$price,$matches ) ?$matches : '';
if (isset($price) &&!empty($price))
{
$minprice = $price[1];
$maxprice = $price[2];
if(isset($minprice) &&!empty($minprice))
{
$sql.=" and CAST(price AS SIGNED) >'$minprice'";
}
if(isset($maxprice) &&!empty($maxprice))
{
$sql.=" and CAST(price AS SIGNED) <'$maxprice'";
}
}
if (isset($purposes) &&!empty($purposes))
{
$sql.=" and `type` like '%$purposes%'";
}
if (isset($character) &&!empty($character))
{
$sql.=" and `character` like '%$character%'";
}
$order = "id desc";
$result = $db->select($sql,'id,title,type,address,price,priceunit,thumb,url',$limit,$order,'','id');
if($result)
{
$num=0;
$json = array();
foreach($result AS $k=>$v) {
$num++;
$typename = get_typename($v['type']);
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
$r = array('BuildingName'=>$v['title'],'BuildingID'=>$v['id'],'BuildingUrl'=>$v['url'],'BuildDefaultPic'=>$v['thumb'],'Address'=>$v['address'],'AvgPrice'=>$v['price'],'AvgPriceUnit'=>$priceunit
);
$json[] = JSON($r);
}
$json_str ="{\"totalCount\":\"$num\",\"Rows\":[";
$json_str .= implode(',',$json);
$json_str .= "]}";
echo $json_str;
}
else
{
$json_str ="{\"totalCount\":\"0\",\"Rows\":[";
$json_str .= "]}";
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
?>