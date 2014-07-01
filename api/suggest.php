<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$modelid = '13';
$db = '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$keyword = iconv('utf-8','gbk',trim($_POST['q']));
$random = $_POST['random'];
$p = '/^[a-z]+$/i';
if(preg_match($p,$keyword))
{
$sql = "map<>'' and (ename like '%$keyword%' or pinyin like '%$keyword%')";
}
else
{
$sql = "map<>'' and title like '%$keyword%'";
}
$result = $db->select($sql,'title','10');
if($result)
{
foreach($result AS $k=>$v) {
$title[] = $v['title'];
}
$xml_str = implode(',',$title);
}
header('Content-Type: text/xml; charset=gb2312');
echo '<?xml version="1.0" encoding="gb2312"?'.">\n";
echo "<result>\n";
echo "<status>1</status>\n";
echo "<msg><![CDATA[$xml_str]]></msg>\n";
echo "</result>";
?>