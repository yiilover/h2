<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$areaid = intval($_GET['areaid']);
$datas = getcache('3360','linkage');
$infos = $datas['data'];
$where_id = intval($areaid);
$str = '<select name="circleid_com" id="circleid_com">';
$str.= '<option value="">ÇëÑ¡Ôñ</option>';
foreach($infos AS $k=>$v) {
if($v['parentid'] == $where_id) {
$str.='<option  value="'.$v['linkageid'].'">'.$v['name'].'</option>';
}
}
$str.='</select>';
echo $str;
?>