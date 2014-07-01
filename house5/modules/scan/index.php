<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
class index extends admin {
protected $safe = array ('file_type'=>'php|js','code'=>'','func'=>'com|system|exec|eval|escapeshell|cmd|passthru|base64_decode|gzuncompress','dir'=>'','md5_file'=>'');
public function __construct() {
parent::__construct();
}
public function init() {
$list = glob(HOUSE5_PATH.'*');
if (file_exists(CACHE_PATH.'caches_scan'.DIRECTORY_SEPARATOR.'caches_data')) {
$md5_file_list = glob(CACHE_PATH.'caches_scan'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR.'md5_*.php');
if(is_array($md5_file_list)) {
foreach ($md5_file_list as $k=>$v) {
$md5_file_list[$v] = basename($v);
unset($md5_file_list[$k]);
}
}
}
$scan = getcache('scan_config','scan');
if (is_array($scan)) {
$scan = array_merge($this->safe,$scan);
}else {
$scan = $this->safe;
}
$scan['dir'] = string2array($scan['dir']);
h5_base::load_sys_class('form','',0);
include $this->admin_tpl('scan_index');
}
public function public_update_config() {
$info = isset($_POST['info']) ?$_POST['info'] : showmessage(L('illegal_action'),HTTP_REFERER);
$dir = isset($_POST['dir']) ?new_stripslashes($_POST['dir']) : '';
if (empty($dir)) {
showmessage(L('please_select_the_content'),'?s=scan/index/init');
}
$info['dir'] = var_export($dir,true);
setcache('scan_config',$info,'scan');
showmessage(L('configuration_file_save_to_the'),'?s=scan/index/public_file_count');
}
public function public_file_count() {
$scan = getcache('scan_config','scan');
h5_base::load_app_func('global');
set_time_limit(120);
$scan['dir'] = string2array($scan['dir']);
$scan['file_type'] = explode('|',$scan['file_type']);
$list = array();
foreach ($scan['dir'] as $v) {
if (is_dir($v)) {
foreach ($scan['file_type'] as $k ) {
$list = array_merge($list,scan_file_lists($v.DIRECTORY_SEPARATOR,1,$k,0,1,1));
}
}else {
$list = array_merge($list,array(str_replace(HOUSE5_PATH,'',$v)=>md5_file($v)));
}
}
setcache('scan_list',$list,'scan');
showmessage(L('documents_to_file_the_statistics'),'?s=scan/index/public_file_filter');
}
public function public_file_filter() {
$scan_list = getcache('scan_list','scan');
$scan = getcache('scan_config','scan');
if (file_exists($scan['md5_file'])) {
$old_md5 = include $scan['md5_file'];
foreach ($scan_list as $k=>$v) {
if ($v == $old_md5[$k]) {
unset($scan_list[$k]);
}
}
}
setcache('scan_list',$scan_list,'scan');
showmessage(L('file_through_a_feature_the_function_is'),'?s=scan/index/public_file_func');
}
public function public_file_func() {
@set_time_limit(600);
$file_list = getcache('scan_list','scan');
$scan = getcache('scan_config','scan');
if (isset($scan['func']) &&!empty($scan['func'])) {
foreach ($file_list as $key=>$val) {
$html = file_get_contents(HOUSE5_PATH.$key);
if(stristr($key,'.php.') != false ||preg_match_all('/[^a-z]?('.$scan['func'].')\s*\(/i',$html,$state,PREG_SET_ORDER)) {
$badfiles[$key]['func'] = $state;
}
}
}
if(!isset($badfiles)) $badfiles = array();
setcache('scan_bad_file',$badfiles,'scan');
showmessage(L('feature_function_complete_a_code_used_by_filtration'),'?s=scan/index/public_file_code');
}
public function public_file_code() {
@set_time_limit(600);
$file_list = getcache('scan_list','scan');
$scan = getcache('scan_config','scan');
$badfiles = getcache('scan_bad_file','scan');
if (isset($scan['code']) &&!empty($scan['code'])) {
foreach ($file_list as $key=>$val) {
$html = file_get_contents(HOUSE5_PATH.$key);
if(stristr($key,'.php.') != false ||preg_match_all('/[^a-z]?('.$scan['code'].')/i',$html,$state,PREG_SET_ORDER)) {
$badfiles[$key]['code'] = $state;
}
if(strtolower(substr($key,-4)) == '.php'&&function_exists('zend_loader_file_encoded') &&zend_loader_file_encoded(HOUSE5_PATH.$key)) {
$badfiles[$key]['zend'] = 'zend encoded';
}
}
}
setcache('scan_bad_file',$badfiles,'scan');
showmessage(L('scan_completed'),'?s=scan/index/scan_report&menuid=1005');
}
public function scan_report() {
$badfiles = getcache('scan_bad_file','scan');
if (empty($badfiles)) {
showmessage(L('scan_to_find_a_result_please_to_scan'),'?s=scan/index/init');
}
include $this->admin_tpl('scan_report');
}
public function view() {
$url = isset($_GET['url']) &&trim($_GET['url']) ?new_stripslashes(urldecode(trim($_GET['url']))) : showmessage(L('illegal_action'),HTTP_REFERER);
$url = str_replace("..","",$url);
if (!file_exists(HOUSE5_PATH.$url)) {
showmessage(L('file_not_exists'));
}
$html = file_get_contents(HOUSE5_PATH.$url);
$basename = basename($url);
if($basename == "database.php"){
showmessage(L('��Ҫ�ļ������������߲鿴��'));
}
$file_list = getcache('scan_bad_file','scan');
if (isset($file_list[$url]['func']) &&is_array($file_list[$url]['func']) &&!empty($file_list[$url]['func'])) foreach ($file_list[$url]['func'] as $key=>$val)
{
$func[$key] = strtolower($val[1]);
}
if (isset($file_list[$url]['code']) &&is_array($file_list[$url]['code']) &&!empty($file_list[$url]['code'])) foreach ($file_list[$url]['code'] as $key=>$val)
{
$code[$key] = strtolower($val[1]);
}
if (isset($func)) $func = array_unique($func);
if (isset($code)) $code = array_unique($code);
$show_header = true;
include $this->admin_tpl('public_view');
}
public function md5_creat() {
set_time_limit(120);
$pro = isset($_GET['pro']) &&intval($_GET['pro']) ?intval($_GET['pro']) : 1;
h5_base::load_app_func('global');
switch ($pro) {
case '1':
$msg = L('please_wait');
ob_start();
include $this->admin_tpl('md5_creat');
ob_flush();
ob_clean();
$list = scan_file_lists(HOUSE5_PATH,1,'php',0,1);
setcache('md5_'.date('Y-m-d'),$list,'scan');
echo '<script type="text/javascript">location.href="?s=scan/index/md5_creat&pro=2&h5_hash='.$_SESSION['h5_hash'].'"</script>';
break;
case '2':
showmessage(L('viewreporttrue'),'?s=scan/index/init');
break;
}
}
}?>