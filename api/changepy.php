<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$db = '';
$db = h5_base::load_model('content_model');
$category = getcache('category_content_1','commons');
h5_base::load_sys_func('iconv');
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
$pinyin = gbk_to_pinyin($r[title]);
if(is_array($pinyin)) {
$pinyin = implode('',$pinyin);
}
$id = $r[id];
$db->update( array('pinyin'=>$pinyin),array('id'=>$id));
}
}
?>