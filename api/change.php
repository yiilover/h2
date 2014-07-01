<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$db = '';
$db = h5_base::load_model('content_model');
$category = getcache('category_content_1','commons');
$catid='14';
$modelid = $category[$catid]['modelid'];
if(!$modelid) return '';
$db = h5_base::load_model('content_model');
$db->set_model($modelid);
$tablename = $db->table_name;
$rs = $db->query("SELECT id,title FROM $tablename where status='99'");
$result = $db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$title = iconv("GBK","UTF-8",$r[title]);
$id = $r[id];
$ename = pingyinFirstChar($title);
$db->update( array('ename'=>$ename),array('id'=>$id));
}
}
function pingyinFirstChar($sourcestr){
$returnstr='';
$i=0;
$n=0;
$str_length=strlen($sourcestr);
while ($i<=$str_length) {
$temp_str=substr($sourcestr,$i,1);
$ascnum=Ord($temp_str);
if ($ascnum>=224){
$returnstr=$returnstr.getHanziInitial(substr($sourcestr,$i,3));
$i=$i+3;
}else if($ascnum>=192){
$returnstr=$returnstr.getHanziInitial(substr($sourcestr,$i,2));
$i=$i+2;
}else if($ascnum>=65 &&$ascnum<=90){
$returnstr=$returnstr.substr($sourcestr,$i,1);
$i=$i+1;
}else{
$returnstr=$returnstr.strtoupper(substr($sourcestr,$i,1));
$i=$i+1;
}
}
return $returnstr;
}
function getHanziInitial($s0){
if(ord($s0) >= "1"and ord($s0) <= ord("z")){
return strtoupper($s0);
}
$s = iconv("UTF-8","gbk//IGNORE",$s0);
$asc = @ord($s{0}) * 256 +@ord($s{1})-65536;
if($asc >= -20319 and $asc <= -20284)return "A";
if($asc >= -20283 and $asc <= -19776)return "B";
if($asc >= -19775 and $asc <= -19219)return "C";
if($asc >= -19218 and $asc <= -18711)return "D";
if($asc >= -18710 and $asc <= -18527)return "E";
if($asc >= -18526 and $asc <= -18240)return "F";
if($asc >= -18239 and $asc <= -17923)return "G";
if($asc >= -17922 and $asc <= -17418)return "H";
if($asc >= -17417 and $asc <= -16475)return "J";
if($asc >= -16474 and $asc <= -16213)return "K";
if($asc >= -16212 and $asc <= -15641)return "L";
if($asc >= -15640 and $asc <= -15166)return "M";
if($asc >= -15165 and $asc <= -14923)return "N";
if($asc >= -14922 and $asc <= -14915)return "O";
if($asc >= -14914 and $asc <= -14631)return "P";
if($asc >= -14630 and $asc <= -14150)return "Q";
if($asc >= -14149 and $asc <= -14091)return "R";
if($asc >= -14090 and $asc <= -13319)return "S";
if($asc >= -13318 and $asc <= -12839)return "T";
if($asc >= -12838 and $asc <= -12557)return "W";
if($asc >= -12556 and $asc <= -11848)return "X";
if($asc >= -11847 and $asc <= -11056)return "Y";
if($asc >= -11055 and $asc <= -10247)return "Z";
return $s0;
}
?>