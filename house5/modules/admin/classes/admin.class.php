<?php

defined('IN_HOUSE5') or exit('No permission resources.');
$session_storage = 'session_'.h5_base::load_config('system','session_storage');
h5_base::load_sys_class($session_storage);
if(param::get_cookie('sys_lang')) {
define('SYS_STYLE',param::get_cookie('sys_lang'));
}else {
define('SYS_STYLE','zh-cn');
}
define('IN_ADMIN',true);
class admin {
public $userid;
public $username;
public function __construct() {
self::check_admin();
self::check_priv();
h5_base::load_app_func('global','admin');
if (!module_exists(ROUTE_M)) showmessage(L('module_not_exists'));
self::manage_log();
self::check_ip();
self::lock_screen();
self::check_hash();
if(h5_base::load_config('system','admin_url') &&$_SERVER["HTTP_HOST"]!= h5_base::load_config('system','admin_url')) {
Header("http/1.1 403 Forbidden");
exit('No permission resources.');
}
}
final public function check_admin() {
if(ROUTE_M =='admin'&&ROUTE_C =='index'&&in_array(ROUTE_A,array('login','public_card'))) {
return true;
}else {
$userid = param::get_cookie('userid');
if(!isset($_SESSION['userid']) ||!isset($_SESSION['roleid']) ||!$_SESSION['userid'] ||!$_SESSION['roleid']) showmessage(L('admin_login'),'?s=admin/index/login');
}
}
final public static function admin_tpl($file,$m = '') {
$m = empty($m) ?ROUTE_M : $m;
if(empty($m)) return false;
return H5_PATH.'modules'.DIRECTORY_SEPARATOR.$m.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$file.'.tpl.php';
}
final public static function admin_menu($parentid,$with_self = 0) {
$parentid = intval($parentid);
$menudb = h5_base::load_model('menu_model');
$result =$menudb->select(array('parentid'=>$parentid,'display'=>1),'*',1000,'listorder ASC');
if($with_self) {
$result2[] = $menudb->get_one(array('id'=>$parentid));
$result = array_merge($result2,$result);
}
if($_SESSION['roleid'] == 1) return $result;
$array = array();
$privdb = h5_base::load_model('admin_role_priv_model');
$siteid = param::get_cookie('siteid');
foreach($result as $v) {
$action = $v['a'];
if(preg_match('/^public_/',$action)) {
$array[] = $v;
}else {
if(preg_match('/^ajax_([a-z]+)_/',$action,$_match)) $action = $_match[1];
$r = $privdb->get_one(array('m'=>$v['m'],'c'=>$v['c'],'a'=>$action,'roleid'=>$_SESSION['roleid'],'siteid'=>$siteid));
if($r) $array[] = $v;
}
}
return $array;
}
final public static function submenu($parentid = '',$big_menu = false) {
if(empty($parentid)) {
$menudb = h5_base::load_model('menu_model');
$r = $menudb->get_one(array('m'=>ROUTE_M,'c'=>ROUTE_C,'a'=>ROUTE_A));
$parentid = $_GET['menuid'] = $r['id'];
}
$array = self::admin_menu($parentid,1);
$numbers = count($array);
if($numbers==1 &&!$big_menu) return '';
$string = '';
$h5_hash = $_SESSION['h5_hash'];
foreach($array as $_value) {
if (!isset($_GET['s'])) {
$classname = ROUTE_M == $_value['m'] &&ROUTE_C == $_value['c'] &&ROUTE_A == $_value['a'] ?'class="on"': '';
}else {
$_s = !empty($_value['data']) ?str_replace('=','',strstr($_value['data'],'=')) : '';
$classname = ROUTE_M == $_value['m'] &&ROUTE_C == $_value['c'] &&ROUTE_A == $_value['a'] &&$_GET['s'] == $_s ?'class="on"': '';
}
if($_value['parentid'] == 0 ||$_value['m']=='') continue;
if($classname) {
$string .= "<a href='javascript:;' $classname><em>".L($_value['name'])."</em></a><span>|</span>";
}else {
$string .= "<a href='?s=".$_value['m']."/".$_value['c']."/".$_value['a']."/menuid/$parentid/h5_hash/$h5_hash".'/'.$_value['data']."' $classname><em>".L($_value['name'])."</em></a><span>|</span>";
}
}
$string = substr($string,0,-14);
return $string;
}
final public static function current_pos($id) {
$menudb = h5_base::load_model('menu_model');
$r =$menudb->get_one(array('id'=>$id),'id,name,parentid');
$str = '';
if($r['parentid']) {
$str = self::current_pos($r['parentid']);
}
return $str.L($r['name']).' > ';
}
final public static function get_siteid() {
return get_siteid();
}
final public static function get_siteinfo($siteid = '') {
if ($siteid == '') $siteid = self::get_siteid();
if (empty($siteid)) return false;
$sites = h5_base::load_app_class('sites','admin');
return $sites->get_by_id($siteid);
}
final public static function return_siteid() {
$sites = h5_base::load_app_class('sites','admin');
$siteid = explode(',',$sites->get_role_siteid($_SESSION['roleid']));
return current($siteid);
}
final public function check_priv() {
if(ROUTE_M =='admin'&&ROUTE_C =='index'&&in_array(ROUTE_A,array('login','init','public_card'))) return true;
if($_SESSION['roleid'] == 1) return true;
$siteid = param::get_cookie('siteid');
$action = ROUTE_A;
$privdb = h5_base::load_model('admin_role_priv_model');
if(preg_match('/^public_/',ROUTE_A)) return true;
if(preg_match('/^ajax_([a-z]+)_/',ROUTE_A,$_match)) {
$action = $_match[1];
}
$r =$privdb->get_one(array('m'=>ROUTE_M,'c'=>ROUTE_C,'a'=>$action,'roleid'=>$_SESSION['roleid'],'siteid'=>$siteid));
if(!$r) showmessage('您没有权限操作该项','blank');
}
final private function manage_log() {
$setconfig = h5_base::load_config('system');
extract($setconfig);
if($admin_log==1){
$action = ROUTE_A;
if($action == ''||strchr($action,'public') ||$action == 'init'||$action=='public_current_pos') {
return false;
}else {
$ip = ip();
$log = h5_base::load_model('log_model');
$username = param::get_cookie('admin_username');
$userid = isset($_SESSION['userid']) ?$_SESSION['userid'] : '';
$time = date('Y-m-d H-i-s',SYS_TIME);
$url = '?s='.ROUTE_M.'/'.ROUTE_C.'/'.ROUTE_A;
$log->insert(array('module'=>ROUTE_M,'username'=>$username,'userid'=>$userid,'action'=>ROUTE_C,'querystring'=>$url,'time'=>$time,'ip'=>$ip));
}
}
}
final private function check_ip(){
$this->ipbanned = h5_base::load_model('ipbanned_model');
$this->ipbanned->check_ip();
}
final private function lock_screen() {
if(isset($_SESSION['lock_screen']) &&$_SESSION['lock_screen']==1) {
if(preg_match('/^public_/',ROUTE_A) ||(ROUTE_M == 'content'&&ROUTE_C == 'create_html') ||(ROUTE_M == 'release') ||(ROUTE_A == 'login') ||(ROUTE_M == 'search'&&ROUTE_C == 'search_admin'&&ROUTE_A=='createindex')) return true;
showmessage(L('admin_login'),'?s=admin/index/login');
}
}
final private function check_hash() {
if(preg_match('/^public_/',ROUTE_A) ||ROUTE_M =='admin'&&ROUTE_C =='index'||in_array(ROUTE_A,array('login'))) {
return true;
}
if(isset($_GET['h5_hash']) &&$_SESSION['h5_hash'] != ''&&($_SESSION['h5_hash'] == $_GET['h5_hash'])) {
return true;
}elseif(isset($_POST['h5_hash']) &&$_SESSION['h5_hash'] != ''&&($_SESSION['h5_hash'] == $_POST['h5_hash'])) {
return true;
}else {
showmessage(L('hash_check_false'),HTTP_REFERER);
}
}
}?>