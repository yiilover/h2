<?php
 
defined('IN_HOUSE5') or exit('No permission resources.');
function dbsource_cache() {
$db = h5_base::load_model('dbsource_model');
$list = $db->select();
$data = array();
if ($list) {
foreach ($list as $val) {
$data[$val['name']] = array('hostname'=>$val['host'].':'.$val['port'],'database'=>$val['dbname'] ,'db_tablepre'=>$val['dbtablepre'],'username'=>$val['username'],'password'=>$val['password'],'charset'=>$val['charset'],'debug'=>0,'pconnect'=>0,'autoconnect'=>0);
}
}else {
return false;
}
return setcache('dbsource',$data,'commons');
}
function h5_tag_class ($module) {
$filepath = H5_PATH.'modules'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.$module.'_tag.class.php';
if (file_exists($filepath)) {
$h5_tag = h5_base::load_app_class($module.'_tag',$module);
if (!method_exists($h5_tag,'h5_tag')) {
showmessage(L('the_module_will_not_support_the_operation'));
}
$html  = $h5_tag->h5_tag();
}else {
showmessage(L('the_module_will_not_support_the_operation'),HTTP_REFERER);
}
return $html;
}
function template_url($id) {
$filepath = CACHE_PATH.'caches_template'.DIRECTORY_SEPARATOR.'dbsource'.DIRECTORY_SEPARATOR.$id.'.php';
if (!file_exists($filepath)) {
$datacall = h5_base::load_model('datacall_model');
$str = $datacall->get_one(array('id'=>$id),'template');
$dir = dirname($filepath);
if(!is_dir($dir)) {
mkdir($dir,0777,true);
}
$tpl = h5_base::load_sys_class('template_cache');
$str = $tpl->template_parse($str['template']);
@file_put_contents($filepath,$str);
}
return $filepath;
}
?>