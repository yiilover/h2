<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$modelid = '13';
$db = '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$region = intval($_GET['region']);
$pricecatid = 11;
$tablename = $db->table_name;
$table_name = $tablename.'_data';
$order = $data['order'];
$where = "where `status`=99";
$arrchildid = get_arrchildid('3360',$region);
$where.=" and `region` in ($arrchildid)";
$rs = $db->query("SELECT id,title,price,priceunit FROM `$tablename` $where ORDER BY `id` DESC LIMIT 30,80");
$result = $db->fetch_array($rs);
if($result)
{
foreach($result as $k=>$r)
{
$result[$k]['trend'] = 0;
$relation= $r[id];
$db->set_model('15');
$where = "`relation` = '$relation'";
$tablename = $db->table_name;
$db->table_name = $tablename.'_data';
$re = $db->get_one($where,'id','id desc','');
if($re)
{
$theid = $re['id'];
$where = "`id` = '$theid'";
$db->table_name = $tablename;
$res = $db->get_one($where,'price,trend','','');
if($res['trend']=='0')
$img = 'line';
elseif($res['trend']=='1')
{
$img = 'up';
}
else
{
$img = 'down';
}
$title = iconv('GBK','UTF-8',$r['title']);
$title = unicode_encode($title);
$r = array('gid'=>$r['id'],'price_avr'=>$res['price'],'priceunit'=>$r['priceunit'],'subject'=>$title,'subject_short'=>$title,'img'=>$img);
$json[] = JSON($r);
}
}
$json_str ="{\"content\":[";
$json_str .= implode(',',$json);
$json_str .= "],\"msg\":\"ok\"}";
echo $json_str;
}
else
{
$json_str ="{\"content\":[";
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
function unicode_decode($name)
{
$pattern = '/([\w]+)|(\\\u([\w]{4}))/i';
preg_match_all($pattern,$name,$matches);
if (!empty($matches))
{
$name = '';
for ($j = 0;$j <count($matches[0]);$j++)
{
$str = $matches[0][$j];
if (strpos($str,'\\u') === 0)
{
$code = base_convert(substr($str,2,2),16,10);
$code2 = base_convert(substr($str,4),16,10);
$c = chr($code).chr($code2);
$c = iconv('UCS-2','UTF-8',$c);
$name .= $c;
}
else
{
$name .= $str;
}
}
}
return $name;
}
?>