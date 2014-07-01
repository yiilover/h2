<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$modelid = '13';
$db = '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$keyword = trim($_GET['q']);
$sn = trim($_GET['sn']);
$random = $_GET['random'];
$p = '/^[a-z]+$/i';
if(preg_match($p,$keyword))
{
$sql = "ename like '%$keyword%' or pinyin like '%$keyword%'";
}
else
{
$keyword = iconv('UTF-8','GBK',$keyword);
$sql = "title like '%$keyword%'";
}
$result = $db->select($sql,'title,id','10');
if($result)
{
foreach($result AS $k=>$v) {
$v['title'] = iconv('GBK','UTF-8',$v['title']);
$v['title'] = unicode_encode($v['title']);
$title[] = "{\"houseId\":\"".$v['id']."\",\"houseName\":\"".$v['title']."\",\"houseDomain\":\"\"}";
}
$xml_str = implode(',',$title);
}
echo 'var smartbox_data_json = ['.$xml_str.'];var smartbox_sn = '.$sn.';';
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