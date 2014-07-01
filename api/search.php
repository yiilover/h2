<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$modelid = '13';
$db = '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$x1 = $_POST['hdx1'];
$x2 = $_POST['hdx2'];
$y1 = $_POST['hdy1'];
$y2 = $_POST['hdy2'];
$newcode = intval($_POST['newcode']);
$newcode_list = $_POST['newcode_list'];
$sql = "map<>''";
$price = $_POST['price'];
$price = preg_match ( '/([0-9]+),([0-9]+)?/',$price,$matches ) ?$matches : '';
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
if(isset($newcode_list) &&!empty($newcode_list))
{
$sql.=" and id in ($newcode_list)";
}
if(isset($newcode) &&!empty($newcode))
{
$sql.=" and id = $newcode";
}
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
if(isset($newcode_list) &&!empty($newcode_list))
{
list($lngX,$latY,$zoom) = explode('|',$v['map']);
$num++;
$typename = get_typename($v['type']);
$tablename = $db->table_name;
$db->table_name = $tablename.'_data';
$r = $db->get_one(array('id'=>$v['id']),'developer');
$developer = getcompany_name($r[developer],12);
$db->table_name = $tablename;
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
$r = array('title'=>$v['title'],'tel'=>$v['tel'],'picAddress'=>$v['thumb'],'saling'=>$v['xszt'],'developer'=>$developer,'address'=>$v['address'],'district'=>$v['region'],'startTime'=>$v['opentime'],'price_type'=>'价格','price_num'=>$v['price'],'price_unit'=>$priceunit,'purpose'=>$typename,'x'=>$lngX,'y'=>$latY,'newCode'=>$v['id']
);
$json[] = JSON($r);
}
else if(isset($newcode) &&!empty($newcode))
{
list($lngX,$latY,$zoom) = explode('|',$v['map']);
$num++;
$typename = get_typename($v['type']);
$tablename = $db->table_name;
$db->table_name = $tablename.'_data';
$r = $db->get_one(array('id'=>$v['id']),'developer');
$developer = getcompany_name($r[developer],12);
$db->table_name = $tablename;
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
$r = array('title'=>$v['title'],'tel'=>$v['tel'],'picAddress'=>$v['thumb'],'saling'=>$v['xszt'],'developer'=>$developer,'address'=>$v['address'],'district'=>$v['region'],'startTime'=>$v['opentime'],'price_type'=>'价格','price_num'=>$v['price'],'price_unit'=>$priceunit,'purpose'=>$typename,'x'=>$lngX,'y'=>$latY,'newCode'=>$v['id']
);
$json[] = JSON($r);
}
else 
{
list($lngX,$latY,$zoom) = explode('|',$v['map']);
if(($lngX>$x1) &&($lngX<$x2) &&($latY>$y1) &&($latY<$y2))
{
$num++;
$typename = get_typename($v['type']);
$tablename = $db->table_name;
$db->table_name = $tablename.'_data';
$r = $db->get_one(array('id'=>$v['id']),'developer');
$developer = getcompany_name($r[developer],12);
$db->table_name = $tablename;
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
$r = array('title'=>$v['title'],'tel'=>$v['tel'],'picAddress'=>$v['thumb'],'saling'=>$v['xszt'],'developer'=>$developer,'address'=>$v['address'],'district'=>$v['region'],'startTime'=>$v['opentime'],'price_type'=>'价格','price_num'=>$v['price'],'price_unit'=>$priceunit,'purpose'=>$typename,'x'=>$lngX,'y'=>$latY,'newCode'=>$v['id']
);
$json[] = JSON($r);
}
else
{
continue;
}
}
}
$json_str ="{status:\"1\",allnum:\"$num\",maxpage:\"1\",pagenow:\"0\",hits:{";
$json_str .= "hit:[";
$json_str .= implode(',',$json);
$json_str .= "]}}";
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
?>