<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
class index extends admin {
private $_filearr = array('api','house5','statics','');
private $_upgrademd5 = 'http://www.house5.net/upgrademd5/';
private $_patchurl = 'http://update.house5.net/v1/1.0/patch/';
public function __construct() {
parent::__construct();
}
public function init() {
global $INI;
if(substr( $INI['authkey'],162,10) <time()) die('软件已过服务期');
domain_verify();
$show_header = '';
$patch_charset = str_replace('-','',CHARSET);
$upgrade_path_base = $this->_patchurl.$patch_charset.'/';
$current_version = h5_base::load_config('version');
$pathlist_str = @file_get_contents($upgrade_path_base);
$pathlist = $allpathlist = array();
$key = -1;
preg_match_all("/\"(patch_[\w_]+\.zip)\"/",$pathlist_str,$allpathlist);
$allpathlist = $allpathlist[1];
foreach($allpathlist as $k=>$v) {
if(strstr($v,'patch_'.$current_version['h5_release'])) {
$key = $k;
break;
}
}
$key = $key <0 ?9999 : $key;
foreach($allpathlist as $k=>$v) {
if($k >= $key) {
$pathlist[$k] = $v;
$desc[$k] = $this->load_txt($upgrade_path_base.'about.php',str_replace('.zip','',$v));
}
}
if(!empty($_GET['s'])&&intval($_GET['s'])>0) {
if(empty($_GET['do'])) {
showmessage(L('upgradeing'),'?s=upgrade/index/init/s/1/do/1/cover/'.$_GET['cover']);
}
if(empty($pathlist)) {
showmessage(L('upgrade_success'),'?s=upgrade/index/init');
}
if(!file_exists(CACHE_PATH.'caches_upgrade')) {
@mkdir(CACHE_PATH.'caches_upgrade');
}
h5_base::load_app_class('pclzip','upgrade',0);
foreach($pathlist as $k=>$v) {
$upgradezip_url = $upgrade_path_base.$v;
$upgradezip_path = CACHE_PATH.'caches_upgrade'.DIRECTORY_SEPARATOR.$v;
$upgradezip_source_path = CACHE_PATH.'caches_upgrade'.DIRECTORY_SEPARATOR.basename($v,".zip");
@file_put_contents($upgradezip_path,@file_get_contents($upgradezip_url));
$archive = new PclZip($upgradezip_path);
if($archive->extract(PCLZIP_OPT_PATH,$upgradezip_source_path,PCLZIP_OPT_REPLACE_NEWER) == 0) {
die("Error : ".$archive->errorInfo(true));
}
$copy_from = $upgradezip_source_path.DIRECTORY_SEPARATOR.$patch_charset.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR;
$copy_to = HOUSE5_PATH;
$this->copyfailnum = 0;
$this->copydir($copy_from,$copy_to,$_GET['cover']);
if($this->copyfailnum >0) {
@file_put_contents(CACHE_PATH.'configs'.DIRECTORY_SEPARATOR.'version.php','<?php return '.var_export($current_version,true).';?>');
showmessage(L('please_check_filepri'));
}
$sql_path = CACHE_PATH.'caches_upgrade'.DIRECTORY_SEPARATOR.basename($v,".zip").DIRECTORY_SEPARATOR.$patch_charset.DIRECTORY_SEPARATOR.'upgrade'.DIRECTORY_SEPARATOR.'ext'.DIRECTORY_SEPARATOR;
$file_list = glob($sql_path.'*');
if(!empty($file_list)) {
foreach ($file_list as $fk=>$fv) {
if(in_array(strtolower(substr($fv,-3,3)),array('php','sql'))) {
if (strtolower(substr($file_list[$fk],-3,3)) == 'sql'&&$data = file_get_contents($file_list[$fk])) {
$model_name = substr(basename($fv),0,-4);
if (!$db = h5_base::load_model($model_name.'_model')) {
showmessage($model_name.L('lost'),'?s=upgrade/index/init/s/1');
}
$mysql_server_version = $db->version();
$dbcharset = h5_base::load_config('database','default');
$dbcharset = $dbcharset['charset'];
$sqls = explode(';',$data);
foreach ($sqls as $sql) {
if (empty($sql)) continue;
if(mysql_get_server_info >'4.1'&&$dbcharset) {
$sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/","TYPE=\\1 DEFAULT CHARSET=".$dbcharset,$sql);
}
$db->query($sql);
}
}elseif (strtolower(substr($file_list[$fk],-3,3)) == 'php'&&file_exists($file_list[$fk])) {
include $file_list[$fk];
if (strtolower(basename($file_list[$fk])) == 'system_menu.lang.php'&&file_exists($file_list[$fk])) {
include $file_list[$fk];
$new_lan = $LANG;
unset($LANG);
$lang = h5_base::load_config('system','lang');
$menu_lan_file = H5_PATH.'languages'.DIRECTORY_SEPARATOR.$lang.DIRECTORY_SEPARATOR.'system_menu.lang.php';
include $menu_lan_file;
$original_lan = $LANG;
unset($LANG);
$diff_lan = array_diff($new_lan,$original_lan);
$content = file_get_contents($menu_lan_file);
$content = substr($content,0,-2);
$data = '';
foreach ($diff_lan as $lk =>$l) {
$data .= "\$LANG['".$lk."'] = '".$l."';\n\r";
}
$data = $content.$data."?>";
file_put_contents($menu_lan_file,$data);
}
}
}
}
}
$configpath = CACHE_PATH.'caches_upgrade'.DIRECTORY_SEPARATOR.basename($v,".zip").DIRECTORY_SEPARATOR.$patch_charset.DIRECTORY_SEPARATOR.'upgrade'.DIRECTORY_SEPARATOR.'config.php';
if(file_exists($configpath)) {
$config_arr = include $configpath;
$version_arr = array('h5_version'=>$config_arr['to_version'],'h5_release'=>$config_arr['to_release']);
$version_filepath = CACHE_PATH.'configs'.DIRECTORY_SEPARATOR.'version.php';
@file_put_contents($version_filepath,'<?php return '.var_export($version_arr,true).';?>');
}
@unlink($upgradezip_path);
$this->deletedir($upgradezip_source_path);
$tmp_k = $k +1;
if(!empty($pathlist[$tmp_k])) {
$next_update = '<br />'.L('upgradeing').basename($pathlist[$tmp_k],".zip");
}else {
$next_update;
}
showmessage(basename($v,".zip").L('upgrade_success').$next_update,'?s=upgrade/index/init/s/1/do/1/cover/'.$_GET['cover']);
}
}else {
include $this->admin_tpl('upgrade_index');
}
}
public function checkfile() {
if(!empty($_GET['do'])) {
$this->md5_arr = array();
$this->_h5_readdir(".");
$current_version = h5_base::load_config('version');
$house5_md5 = @file_get_contents($this->_upgrademd5.$current_version['h5_release'].'_'.CHARSET.".php");
$house5_md5_arr = json_decode($house5_md5,1);
$diff = array_diff($house5_md5_arr,$this->md5_arr);
$lostfile = array();
foreach($house5_md5_arr as $k=>$v) {
if(!in_array($k,array_keys($this->md5_arr))) {
$lostfile[] = $k;
unset($diff[$k]);
}
}
$unknowfile = array_diff(array_keys($this->md5_arr),array_keys($house5_md5_arr));
include $this->admin_tpl('check_file');
}else {
showmessage(L('begin_checkfile'),'?s=upgrade/index/checkfile&do=1&menuid='.$_GET['menuid']);
}
}
public function load_txt($file,$key = '')
{
$configs = json_decode(base64_decode(@file_get_contents($file)),true);
$configs = array_iconv($configs,'utf-8','gbk');
if (empty($key)) {
return $configs;
}elseif (isset($configs[$key])) {
return $configs[$key];
}
}
private function _h5_readdir($path='') {
$dir_arr = explode('/',dirname($path));
if(is_dir($path)) {
$handler = opendir($path);
while(($filename = @readdir($handler)) !== false) {
if(substr($filename,0,1) != ".") {
$this->_h5_readdir($path.'/'.$filename);
}
}
closedir($handler);
}else {
if (dirname($path) == '.'||(isset($dir_arr[1]) &&in_array($dir_arr[1],$this->_filearr))) {
$this->md5_arr[base64_encode($path)] = md5_file($path);
}
}
}
public function copydir($dirfrom,$dirto,$cover='') {
if(is_file($dirto)){
die(L('have_no_pri').$dirto);
}
if(!file_exists($dirto)){
mkdir($dirto);
}
$handle = opendir($dirfrom);
while(false !== ($file = readdir($handle))) {
if($file != '.'&&$file != '..'){
$filefrom = $dirfrom.DIRECTORY_SEPARATOR.$file;
$fileto = $dirto.DIRECTORY_SEPARATOR.$file;
if(is_dir($filefrom)){
$this->copydir($filefrom,$fileto,$cover);
}else {
if(!empty($cover)) {
if(!copy($filefrom,$fileto)) {
$this->copyfailnum++;
echo L('copy').$filefrom.L('to').$fileto.L('failed')."<br />";
}
}else {
if(fileext($fileto) == 'html'&&file_exists($fileto)) {
}else {
if(!copy($filefrom,$fileto)) {
$this->copyfailnum++;
echo L('copy').$filefrom.L('to').$fileto.L('failed')."<br />";
}
}
}
}
}
}
}
function deletedir($dirname){
$result = false;
if(!is_dir($dirname)){
echo " $dirname is not a dir!";
exit(0);
}
$handle = opendir($dirname);
while(($file = readdir($handle)) !== false) {
if($file != '.'&&$file != '..'){
$dir = $dirname.DIRECTORY_SEPARATOR.$file;
is_dir($dir) ?$this->deletedir($dir) : unlink($dir);
}
}
closedir($handle);
$result = rmdir($dirname) ?true : false;
return $result;
}
}?>