<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$dname = iconv('utf-8','gbk',trim($_POST['dname']));
$random = $_POST['random'];
$linkageid = '3360';
$datas = getcache($linkageid,'linkage');
$infos = $datas['data'];
$xml_str = "";
foreach($infos AS $k=>$v) {
if($v['name'] == $dname) {
if($v['description']<>"")
{
$xml_str = $v['description'];
}
}
}
header('Content-Type: text/xml; charset=gb2312');
if ($xml_str) {
list($lngX,$latY) = explode('|',$xml_str);
echo '<?xml version="1.0" encoding="gb2312"?'.">\n";
echo "<result>\n";
echo "<status><![CDATA[1]]></status>\n";
echo "<x><![CDATA[$lngX]]></x>\n";
echo "<y><![CDATA[$latY]]></y>\n";
echo "</result>";
die();
}else {
echo '<?xml version="1.0" encoding="utf-8"?'.">\n";
echo "<result>\n";
echo "<status><![CDATA[0]]></status>\n";
echo "<msg><![CDATA[get empty]]></msg>\n";
echo "</result>";
}
?>