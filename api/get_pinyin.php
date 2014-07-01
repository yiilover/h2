<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$data = $_POST['data'];
$data = trim(strip_tags($data));
echo get_pinyin($data);
function get_pinyin($data) {
$data = trim(strip_tags($data));
if(empty($data)) return '';
h5_base::load_sys_func('iconv');
if(CHARSET != 'utf-8') {
$data = iconv('utf-8',CHARSET,$data);
}else {
$data = iconv('utf-8','gbk',$data);
}
$pinyin = gbk_to_pinyin($data);
if(is_array($pinyin)) {
$pinyin = implode('',$pinyin);
}
return $pinyin;
}
?>