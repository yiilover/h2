<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$modelid = '40';
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
$price = $_POST['price'];
$price = preg_match ( '/([0-9]+),([0-9]?)/',$price,$matches ) ?$matches : '';
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
$result = $db->select($sql,'id,title,type,address,price,thumb,opentime,map',$limit,$order,'','id');
if($result)
{
$num=0;
$json = array();
foreach($result AS $k=>$v) {
if (isset($keyword) &&!empty($keyword))
{
list($lngX,$latY,$zoom) = explode('|',$v['map']);
$num++;
$typename = get_typename($v['type']);
$tablename = $db->table_name;
$db->table_name = $tablename.'_data';
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
$title = iconv('GBK','UTF-8',$v['title']);
$title = unicode_encode($title);
if($type=='rent')
{
$db->set_model('41');
}
else
{
$db->set_model('39');
}
$tablename = $db->table_name;
$table_name = $tablename.'_data';
$where = "where `relation` = '$v[id]'";
$rs = $db->query("SELECT id FROM `$table_name` $where");
$result = $db->fetch_array($rs);
$ids = array();
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
}
$ids = implode(',',$ids);
$sql= "`status`=99 and `id` in ($ids)";
$db->table_name = $tablename;
$key_array = $db->select($sql,'id',$limit,$order,'','id');
$housenums = count($key_array);
}
else
{
continue;
}
if($housenums)
{
$r = array('communityid'=>$v['id'],'communityname'=>$title,'housenums'=>$housenums,'sellprice'=>$v['price'],'bmapx'=>$lngX,'bmapy'=>$latY);
$json[] = JSON($r);
}
}
}
if($num>0)
{
$json_str ="{\"xiaoqu\":";
$json_str .= implode(',',$json);
$json_str .= "}";
}
else
{
$json_str ="{\"xiaoqu\":null}";
}
echo $json_str;
}
else
{
$json_str ="{\"xiaoqu\":null}";
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