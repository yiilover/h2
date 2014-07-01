<?php

define('IN_HOUSE5',true);
define('H5_PATH',dirname(__FILE__).DIRECTORY_SEPARATOR);
if(!defined('HOUSE5_PATH')) define('HOUSE5_PATH',H5_PATH.'..'.DIRECTORY_SEPARATOR);
define('CACHE_PATH',HOUSE5_PATH.'caches'.DIRECTORY_SEPARATOR);
define('SITE_PROTOCOL',isset($_SERVER['SERVER_PORT']) &&$_SERVER['SERVER_PORT'] == '443'?'https://': 'http://');
define('SITE_URL',(isset($_SERVER['HTTP_HOST']) ?$_SERVER['HTTP_HOST'] : ''));
define('HTTP_REFERER',isset($_SERVER['HTTP_REFERER']) ?$_SERVER['HTTP_REFERER'] : '');
define('SYS_START_TIME',microtime());
h5_base::load_sys_func('global');
h5_base::load_sys_func('extention');
h5_base::auto_load_func();
h5_base::load_config('system','errorlog') ?set_error_handler('my_error_handler') : error_reporting(E_ERROR |E_WARNING |E_PARSE);
function_exists('date_default_timezone_set') &&date_default_timezone_set(h5_base::load_config('system','timezone'));
define('CHARSET',h5_base::load_config('system','charset'));
header('Content-type: text/html; charset='.CHARSET);
define('SYS_TIME',time());
define('WEB_PATH',h5_base::load_config('system','web_path'));
define('JS_PATH',h5_base::load_config('system','js_path'));
define('CSS_PATH',h5_base::load_config('system','css_path'));
define('IMG_PATH',h5_base::load_config('system','img_path'));
define('APP_PATH',h5_base::load_config('system','app_path'));
define('UP_PATH',h5_base::load_config('system','up_path'));
define('HOUSE_PATH',h5_base::load_config('system','house_path'));
define('ESF_PATH',h5_base::load_config('system','esf_path'));
define('MEMBER_PATH',h5_base::load_config('system','member_path'));
define('TUAN_PATH',h5_base::load_config('system','tuan_path'));
define('BBS_PATH',h5_base::load_config('system','bbs_path'));
define('ADMIN_PATH','http://'.h5_base::load_config('system','admin_url').'/');
define('ADMIN_JS_PATH',WEB_PATH.'statics/js/');
define('PLUGIN_STATICS_PATH',WEB_PATH.'statics/plugin/');
if(!h5_base::load_config('dcer','key')) die('没有授权文件');
if(h5_base::load_config('system','gzip') &&function_exists('ob_gzhandler')) {
ob_start('ob_gzhandler');
}else {
ob_start();
}
class h5_base {
public static function creat_app() {
return self::load_sys_class('application');
}
public static function load_sys_class($classname,$path = '',$initialize = 1) {
return self::_load_class($classname,$path,$initialize);
}
public static function load_app_class($classname,$m = '',$initialize = 1) {
$m = empty($m) &&defined('ROUTE_M') ?ROUTE_M : $m;
if (empty($m)) return false;
return self::_load_class($classname,'modules'.DIRECTORY_SEPARATOR.$m.DIRECTORY_SEPARATOR.'classes',$initialize);
}
public static function load_model($classname) {
return self::_load_class($classname,'model');
}
private static function _load_class($classname,$path = '',$initialize = 1) {
static $classes = array();
if (empty($path)) $path = 'libs'.DIRECTORY_SEPARATOR.'classes';
$key = md5($path.$classname);
if (isset($classes[$key])) {
if (!empty($classes[$key])) {
return $classes[$key];
}else {
return true;
}
}
if (file_exists(H5_PATH.$path.DIRECTORY_SEPARATOR.$classname.'.class.php')) {
include H5_PATH.$path.DIRECTORY_SEPARATOR.$classname.'.class.php';
$name = $classname;
if ($my_path = self::my_path(H5_PATH.$path.DIRECTORY_SEPARATOR.$classname.'.class.php')) {
include $my_path;
$name = 'MY_'.$classname;
}
if ($initialize) {
$classes[$key] = new $name;
}else {
$classes[$key] = true;
}
return $classes[$key];
}else {
return false;
}
}
public static function load_sys_func($func) {
return self::_load_func($func);
}
public static function auto_load_func($path='') {
return self::_auto_load_func($path);
}
public static function load_app_func($func,$m = '') {
$m = empty($m) &&defined('ROUTE_M') ?ROUTE_M : $m;
if (empty($m)) return false;
return self::_load_func($func,'modules'.DIRECTORY_SEPARATOR.$m.DIRECTORY_SEPARATOR.'functions');
}
public static function load_plugin_class($classname,$identification = '',$initialize = 1) {
$identification = empty($identification) &&defined('PLUGIN_ID') ?PLUGIN_ID : $identification;
if (empty($identification)) return false;
return h5_base::load_sys_class($classname,'plugin'.DIRECTORY_SEPARATOR.$identification.DIRECTORY_SEPARATOR.'classes',$initialize);
}
public static function load_plugin_func($func,$identification) {
static $funcs = array();
$identification = empty($identification) &&defined('PLUGIN_ID') ?PLUGIN_ID : $identification;
if (empty($identification)) return false;
$path = 'plugin'.DIRECTORY_SEPARATOR.$identification.DIRECTORY_SEPARATOR.'functions'.DIRECTORY_SEPARATOR.$func.'.func.php';
$key = md5($path);
if (isset($funcs[$key])) return true;
if (file_exists(H5_PATH.$path)) {
include H5_PATH.$path;
}else {
$funcs[$key] = false;
return false;
}
$funcs[$key] = true;
return true;
}
public static function load_plugin_model($classname,$identification) {
$identification = empty($identification) &&defined('PLUGIN_ID') ?PLUGIN_ID : $identification;
$path = 'plugin'.DIRECTORY_SEPARATOR.$identification.DIRECTORY_SEPARATOR.'model';
return self::_load_class($classname,$path);
}
private static function _load_func($func,$path = '') {
static $funcs = array();
if (empty($path)) $path = 'libs'.DIRECTORY_SEPARATOR.'functions';
$path .= DIRECTORY_SEPARATOR.$func.'.func.php';
$key = md5($path);
if (isset($funcs[$key])) return true;
if (file_exists(H5_PATH.$path)) {
include H5_PATH.$path;
}else {
$funcs[$key] = false;
return false;
}
$funcs[$key] = true;
return true;
}
private static function _auto_load_func($path = '') {
if (empty($path)) $path = 'libs'.DIRECTORY_SEPARATOR.'functions'.DIRECTORY_SEPARATOR.'autoload';
$path .= DIRECTORY_SEPARATOR.'*.func.php';
$auto_funcs = glob(H5_PATH.DIRECTORY_SEPARATOR.$path);
if(!empty($auto_funcs) &&is_array($auto_funcs)) {
foreach($auto_funcs as $func_path) {
include $func_path;
}
}
}
public static function my_path($filepath) {
$path = pathinfo($filepath);
if (file_exists($path['dirname'].DIRECTORY_SEPARATOR.'MY_'.$path['basename'])) {
return $path['dirname'].DIRECTORY_SEPARATOR.'MY_'.$path['basename'];
}else {
return false;
}
}
public static function load_config($file,$key = '',$default = '',$reload = false) {
static $configs = array();
if (!$reload &&isset($configs[$file])) {
if (empty($key)) {
return $configs[$file];
}elseif (isset($configs[$file][$key])) {
return $configs[$file][$key];
}else {
return $default;
}
}
$path = CACHE_PATH.'configs'.DIRECTORY_SEPARATOR.$file.'.php';
if (file_exists($path)) {
$configs[$file] = include $path;
}
if (empty($key)) {
return $configs[$file];
}elseif (isset($configs[$file][$key])) {
return $configs[$file][$key];
}else {
return $default;
}
}
}?>