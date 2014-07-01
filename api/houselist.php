<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$type = trim($_GET['type']);
if($type=='rent')
{
$modelid = '41';
}
else
{
$modelid = '39';
}
$db = '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$tablename = $db->table_name;
$db->table_name = $tablename.'_data';
$communityid = intval($_GET['communityid']);
$page = intval($_GET['curpage']);
$perpage = 6;
if(in_array($_GET['priceorder'],array('ASC','DESC')))
{
$order = "CAST(price AS SIGNED) ".$_GET['priceorder'];
}
elseif(in_array($_GET['areaorder'],array('ASC','DESC')))
{
$order = "CAST(total_area AS SIGNED) ".$_GET['areaorder'];
}
else
{
$order = 'listorder desc,updatetime desc';
}
$range = intval($_GET['price']);
$roomtype = intval($_GET['roomtype']);
$area_range = intval($_GET['area']);
$project = intval($_GET['project']);
$result = $db->select(array('relation'=>$communityid),'id');
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
}
$sql = "`status`=99";
$ids = implode(',',$ids);
$sql.= " and `id` in ($ids)";
if($range)
{
$sql.= " and `range`='$range'";
}
if($roomtype)
{
$sql.= " and `huxingshi`='$roomtype'";
}
if (isset($area_range) &&!empty($area_range))
{
$sql.=" and `area_range` = '$area_range'";
}
if (isset($project) &&!empty($project))
{
$sql.=" and `type` = '$project'";
}
$db->table_name = $tablename;
$num = $db->count($sql);
$pages = ceil($num / $perpage);
$key_array = $db->listinfo($sql,$order,$page,$perpage);
if($key_array)
{
$json = array();
foreach($key_array AS $k=>$v) {
$title = iconv('GBK','UTF-8',$v['title']);
$title = unicode_encode($title);
$pictag = 0;
if(strpos($v['flag'],'5')!==false)
{
$pictag = 1;
}
$v['thumb'] = str_replace('/','\/',$v['thumb']);
$r = array('hid'=>$v['id'],'title'=>$title,'titlepic'=>$v['thumb'],'room'=>$v['huxingshi'],'hall'=>$v['huxingting'],'floor'=>$v['floor'],'totalfloor'=>$v['zonglouceng'],'price'=>$v['price'],'area'=>$v['total_area'],'pictag'=>$pictag);
$json[] = JSON($r);
}
if($num>0)
{
$json_str = "{\"price\":{\"1\":{\"fid\":\"1\",\"name\":\"30\u4e07\u4ee5\u4e0b\",\"nums\":3},\"3\":{\"fid\":\"3\",\"name\":\"40-50\u4e07\",\"nums\":13},\"4\":{\"fid\":\"4\",\"name\":\"50-60\u4e07\",\"nums\":14},\"5\":{\"fid\":\"5\",\"name\":\"60-80\u4e07\",\"nums\":22},\"6\":{\"fid\":\"6\",\"name\":\"80-100\u4e07\",\"nums\":2},\"7\":{\"fid\":\"7\",\"name\":\"100-150\u4e07\",\"nums\":2},\"8\":{\"fid\":\"8\",\"name\":\"150-200\u4e07\",\"nums\":1}},\"room\":{\"1\":{\"fid\":\"1\",\"name\":\"\u4e00\u5ba4\",\"nums\":5},\"2\":{\"fid\":\"2\",\"name\":\"\u4e8c\u5ba4\",\"nums\":29},\"3\":{\"fid\":\"3\",\"name\":\"\u4e09\u5ba4\",\"nums\":30},\"4\":{\"fid\":\"4\",\"name\":\"\u56db\u5ba4\",\"nums\":5},\"5\":{\"fid\":\"5\",\"name\":\"\u5176\u5b83\",\"nums\":4}}";
$json_str .=",\"house\":[";
$json_str .= implode(',',$json);
$json_str .= "],\"communityid\":".$communityid.",\"curpage\":".$page.",\"totalpage\":".$pages.",\"nums\":\"".$num."\"}";
}
else
{
$json_str ="{\"house\":null}";
}
echo $json_str;
}
else
{
$json_str ="{\"house\":null}";
echo $json_str;
}
}
else
{
$json_str ="{\"house\":null}";
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