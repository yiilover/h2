<?php
 
defined('IN_HOUSE5') or exit('No permission resources.');
class ssi_tag {
private $db;
public function __construct() {
$this->db = h5_base::load_model('ssi_model');
}
public function h5_tag($data) {
$siteid = isset($data['siteid']) &&intval($data['siteid']) ?intval($data['siteid']) : get_siteid();
$r = $this->db->select(array('pos'=>$data['pos'],'siteid'=>$siteid));
$str = '';
if (!empty($r) &&is_array($r)) foreach ($r as $v) {
if (defined('IN_ADMIN') &&!defined('HTML')) $str .= '<div id="block_id_'.$v['id'].'" class="admin_block" blockid="'.$v['id'].'">';
if ($v['type'] == '2') {
extract($v,EXTR_OVERWRITE);
$data = string2array($data);
if (!defined('HTML'))  {
ob_start();
include $this->template_url($id);
$str .= ob_get_contents();
ob_clean();
}else {
include $this->template_url($id);
}
}else {
$str .= $v['data'];
}
if (defined('IN_ADMIN')  &&!defined('HTML')) $str .= '</div>';
}
return $str;
}
public function template_url($id,$template = '') {
$filepath = CACHE_PATH.'caches_template'.DIRECTORY_SEPARATOR.'block'.DIRECTORY_SEPARATOR.$id.'.php';
$dir = dirname($filepath);
if ($template) {
if(!is_dir($dir)) {
mkdir($dir,0777,true);
}
$tpl = h5_base::load_sys_class('template_cache');
$str = $tpl->template_parse(new_stripslashes($template));
@file_put_contents($filepath,$str);
}else {
if (!file_exists($filepath)) {
if(!is_dir($dir)) {
mkdir($dir,0777,true);
}
$tpl = h5_base::load_sys_class('template_cache');
$str = $this->db->get_one(array('id'=>$id),'template');
$str = $tpl->template_parse($str['template']);
@file_put_contents($filepath,$str);
}
}
return $filepath;
}
public function createhtml($file,$data = '') {
$dir = dirname($file);
if(!is_dir($dir)) {
mkdir($dir,0777,1);
}
$strlen = h5_base::load_config('system','lock_ex') ?file_put_contents($file,$data,LOCK_EX) : file_put_contents($file,$data);
@chmod($file,0777);
if(!is_writable($file)) {
$file = str_replace(HOUSE5_PATH,'',$file);
return '0';
}
return '1';
}
}
?>