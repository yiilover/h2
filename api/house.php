<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$modelid = '13';
$db = '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$keyword = safe_replace(trim($_GET['key']));
$callback = trim($_GET['callback']);
$pn = intval($_GET['pn']);
$sql = "1=1";
$p = '/^[a-z]+$/i';
if(preg_match($p,$keyword))
{
$sql.= " and (ename like '%$keyword%' or pinyin like '%$keyword%')";
}
else
{
$keyword = iconv('UTF-8','GBK',$keyword);
$sql.= " and (title like '%$keyword%' or address like '%$keyword%')";
}
$result = $db->select($sql,'title,id,address',$pn);
if($result)
{
foreach($result AS $k=>$v) {
$v['title'] = iconv('GBK','UTF-8',$v['title']);
$v['title'] = unicode_encode($v['title']);
$v['address'] = iconv('GBK','UTF-8',$v['address']);
$v['address'] = unicode_encode($v['address']);
$r = array('hid'=>$v['id'],'name'=>$v['title'],'address'=>$v['address']);
$json[] = JSON($r);
}
$json_str = implode(',',$json);
}
echo $callback."([".$json_str."])";
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