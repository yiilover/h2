<?php

defined('IN_HOUSE5') or exit('No permission resources.');
define('H5INC',HOUSE5_PATH.'house5/libs/classes/');
include HOUSE5_PATH.'house5/libs/classes/splitword.class.php';
$cfg_soft_lang='gbk';
$number = intval($_GET['number']);
$data = $_POST['data'];
echo get_keywords($data,$number);
function get_keywords($data,$number = 3) {
global $cfg_soft_lang;
$data = trim(strip_tags($data));
$data = iconv('utf-8','gbk',$data);
if(empty($data)) return '';
if(strlen($data)>7)
{
$sp = new SplitWord($cfg_soft_lang,$cfg_soft_lang);
$sp->SetSource($data,$cfg_soft_lang,$cfg_soft_lang);
$sp->SetResultType(2);
$sp->StartAnalysis(TRUE);
$keywords = $sp->GetFinallyResult(' ',$number);
$keywords = preg_replace("/[ ]{1,}/"," ",trim($keywords));
}
else
{
$keywords = $data;
}
return $keywords;
}
?>