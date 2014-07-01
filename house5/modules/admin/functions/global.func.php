<?php
 
function template_list($siteid = '',$disable = 0) {
$list = glob(H5_PATH.'templates'.DIRECTORY_SEPARATOR.'*',GLOB_ONLYDIR);
$arr = $template = array();
if ($siteid) {
$site = h5_base::load_app_class('sites','admin');
$info = $site->get_by_id($siteid);
if($info['template']) $template = explode(',',$info['template']);
}
foreach ($list as $key=>$v) {
$dirname = basename($v);
if ($siteid &&!in_array($dirname,$template)) continue;
if (file_exists($v.DIRECTORY_SEPARATOR.'config.php')) {
$arr[$key] = include $v.DIRECTORY_SEPARATOR.'config.php';
if (!$disable &&isset($arr[$key]['disable']) &&$arr[$key]['disable'] == 1) {
unset($arr[$key]);
continue;
}
}else {
$arr[$key]['name'] = $dirname;
}
$arr[$key]['dirname']=$dirname;
}
return $arr;
}
function set_config($config,$filename="system") {
$configfile = CACHE_PATH.'configs'.DIRECTORY_SEPARATOR.$filename.'.php';
if(!is_writable($configfile)) showmessage('Please chmod '.$configfile.' to 0777 !');
$pattern = $replacement = array();
$str = file_get_contents($configfile);
foreach($config as $k=>$v) {
if(in_array($k,array('js_path','css_path','img_path','attachment_stat','admin_log','gzip','errorlog','house_domain','connect_enable','upload_url','sina_akey','sina_skey','snda_enable','snda_status','snda_akey','snda_skey','qq_akey','qq_skey','qq_appid','qq_appkey','qq_callback','admin_url','member_path','bbs_path','house_path','esf_path','tuan_path','relative_path','weixin_token','weixin_reply'))) {
$v = trim($v);
$configs[$k] = $v;
$pattern[$k] = "/'".$k."'\s*=>\s*([']?)[^']*([']?)(\s*),/is";
$replacement[$k] = "'".$k."' => \${1}".$v."\${2}\${3},";
if(strpos($str,$k)===false)
{
$flag = strpos($str,');');
$str = substr($str,0,$flag)."'".$k."' =>'',\n);
?>";
}
}
}
$str = preg_replace($pattern,$replacement,$str);
return h5_base::load_config('system','lock_ex') ?file_put_contents($configfile,$str,LOCK_EX) : file_put_contents($configfile,$str);
}
function get_sysinfo() {
$sys_info['os']             = PHP_OS;
$sys_info['zlib']           = function_exists('gzclose');
$sys_info['safe_mode']      = (boolean) ini_get('safe_mode');
$sys_info['safe_mode_gid']  = (boolean) ini_get('safe_mode_gid');
$sys_info['timezone']       = function_exists("date_default_timezone_get") ?date_default_timezone_get() : L('no_setting');
$sys_info['socket']         = function_exists('pfsockopen') ;
$sys_info['web_server']     = $_SERVER['SERVER_SOFTWARE'];
$sys_info['phpv']           = phpversion();
$sys_info['fileupload']     = @ini_get('file_uploads') ?ini_get('upload_max_filesize') :'unknown';
return $sys_info;
}
function dir_writeable($dir) {
$writeable = 0;
if(is_dir($dir)) {
if($fp = @fopen("$dir/chkdir.test",'w')) {
@fclose($fp);
@unlink("$dir/chkdir.test");
$writeable = 1;
}else {
$writeable = 0;
}
}
return $writeable;
}
function errorlog_size() {
$logfile = CACHE_PATH.'error_log.php';
if(file_exists($logfile)) {
return $logsize = h5_base::load_config('system','errorlog') ?round(filesize($logfile) / 1048576 * 100) / 100 : 0;
}
return 0;
}
?>