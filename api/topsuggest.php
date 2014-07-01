<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$modelid = '13';
$db = '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$keyword = trim($_GET['k']);
$random = $_GET['random'];
$p = '/^[a-z]+$/i';
if(preg_match($p,$keyword))
{
$sql = "ename like '%$keyword%' or pinyin like '%$keyword%'";
}
else
{
$sql = "title like '%$keyword%'";
}
$result = $db->select($sql,'title,id','10');
if($result)
{
foreach($result AS $k=>$v) {
$title[] = "{\"hl\":\"".$v['id']."\",\"ht\":\"".$v['title']."\"}";
}
$xml_str = implode(',',$title);
}
echo '['.$xml_str.']';
?>