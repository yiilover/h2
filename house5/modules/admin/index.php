<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
class index extends admin {
public function __construct() {
parent::__construct();
$this->db = h5_base::load_model('admin_model');
$this->menu_db = h5_base::load_model('menu_model');
$this->panel_db = h5_base::load_model('admin_panel_model');
}
public function init () {
$userid = $_SESSION['userid'];
$admin_username = param::get_cookie('admin_username');
$roles = getcache('role','commons');
$rolename = $roles[$_SESSION['roleid']];
$site = h5_base::load_app_class('sites');
$sitelist = $site->get_list($_SESSION['roleid']);
$currentsite = $this->get_siteinfo(param::get_cookie('siteid'));
$adminpanel = $this->panel_db->select(array('userid'=>$userid),"*",20 ,'datetime');
include $this->admin_tpl('index');
}
public function login() {
if(isset($_GET['dosubmit'])) {
global $INI;
if (!isset($_GET['card'])) {
$username = isset($_POST['username']) ?trim($_POST['username']) : showmessage(L('nameerror'),HTTP_REFERER);
}else {
if (!isset($_SESSION['card_verif']) ||$_SESSION['card_verif'] != 1) {
showmessage(L('your_password_card_is_not_validate'),'?s=admin/index/public_card');
}
$username = $_SESSION['card_username'] ?$_SESSION['card_username'] :  showmessage(L('nameerror'),HTTP_REFERER);
}
$this->times_db = h5_base::load_model('times_model');
$rtime = $this->times_db->get_one(array('username'=>$username,'isadmin'=>1));
$maxloginfailedtimes = getcache('common','commons');
$maxloginfailedtimes = (int)$maxloginfailedtimes['maxloginfailedtimes'];
if($rtime['times'] >$maxloginfailedtimes) {
$minute = 60-floor((SYS_TIME-$rtime['logintime'])/60);
showmessage(L('wait_1_hour',array('minute'=>$minute)));
}
$r = $this->db->get_one(array('username'=>$username));
if(!$r) showmessage(L('user_not_exist'),'?s=admin/index/login');
$password = md5(md5(trim((!isset($_GET['card']) ?$_POST['password'] : $_SESSION['card_password']))).$r['encrypt']);
if($r['password'] != $password) {
$ip = ip();
if($rtime &&$rtime['times'] <$maxloginfailedtimes) {
$times = $maxloginfailedtimes-intval($rtime['times']);
$this->times_db->update(array('ip'=>$ip,'isadmin'=>1,'times'=>'+=1'),array('username'=>$username));
}else {
$this->times_db->delete(array('username'=>$username,'isadmin'=>1));
$this->times_db->insert(array('username'=>$username,'ip'=>$ip,'isadmin'=>1,'logintime'=>SYS_TIME,'times'=>1));
$times = $maxloginfailedtimes;
}
showmessage(L('password_error',array('times'=>$times)),'?s=admin/index/login',3000);
}
if($r['disabled'])
{
showmessage(L('user_disabled'),'?s=admin/index/login');
}
$this->times_db->delete(array('username'=>$username));
if (!isset($_GET['card']) &&$r['card'] &&h5_base::load_config('system','safe_card') == 1) {
$_SESSION['card_username'] = $username;
$_SESSION['card_password'] = $_POST['password'];
header("location:?s=admin/index/public_card");
exit;
}elseif (isset($_GET['card']) &&h5_base::load_config('system','safe_card') == 1 &&$r['card']) {
isset($_SESSION['card_username']) ?$_SESSION['card_username'] = '': '';
isset($_SESSION['card_password']) ?$_SESSION['card_password'] = '': '';
isset($_SESSION['card_password']) ?$_SESSION['card_verif'] = '': '';
}
$this->db->update(array('lastloginip'=>ip(),'lastlogintime'=>SYS_TIME),array('userid'=>$r['userid']));
$_SESSION['userid'] = $r['userid'];
$_SESSION['roleid'] = $r['roleid'];
$_SESSION['h5_hash'] = random(6,'abcdefghigklmnopqrstuvwxwyABCDEFGHIGKLMNOPQRSTUVWXWY0123456789');
$_SESSION['lock_screen'] = 0;
$default_siteid = self::return_siteid();
$cookie_time = SYS_TIME+86400*30;
if(!$r['lang']) $r['lang'] = 'zh-cn';
param::set_cookie('admin_username',$username,$cookie_time);
param::set_cookie('siteid',$default_siteid,$cookie_time);
param::set_cookie('userid',$r['userid'],$cookie_time);
param::set_cookie('admin_email',$r['email'],$cookie_time);
param::set_cookie('sys_lang',$r['lang'],$cookie_time);
showmessage(L('login_success'),'?s=admin/index/init');
}else {
h5_base::load_sys_class('form','',0);
include $this->admin_tpl('login');
}
}
public function public_card() {
$username = $_SESSION['card_username'] ?$_SESSION['card_username'] :  showmessage(L('nameerror'),HTTP_REFERER);
$r = $this->db->get_one(array('username'=>$username));
if(!$r) showmessage(L('user_not_exist'),'?s=admin/index/login');
if (isset($_GET['dosubmit'])) {
h5_base::load_app_class('card','admin',0);
$result = card::verification($r['card'],$_POST['code'],$_POST['rand']);
$_SESSION['card_verif'] = 1;
header("location:?s=admin/index/login&dosubmit=1&card=1");
exit;
}
h5_base::load_app_class('card','admin',0);
$rand = card::authe_rand($r['card']);
include $this->admin_tpl('login_card');
}
public function public_logout() {
$_SESSION['userid'] = 0;
$_SESSION['roleid'] = 0;
param::set_cookie('admin_username','');
param::set_cookie('userid',0);
$phpsso_api_url = h5_base::load_config('system','phpsso_api_url');
$phpsso_logout = '<script type="text/javascript" src="'.$phpsso_api_url.'/api.php?op=logout" reload="1"></script>';
showmessage(L('logout_success').$phpsso_logout,'?s=admin/index/login');
}
public function public_menu_left() {
$menuid = intval($_GET['menuid']);
$datas = admin::admin_menu($menuid);
if (isset($_GET['parentid']) &&$parentid = intval($_GET['parentid']) ?intval($_GET['parentid']) : 10) {
foreach($datas as $_value) {
if($parentid==$_value['id']) {
echo '<li id="_M'.$_value['id'].'" class="on top_menu"><a href="javascript:_M('.$_value['id'].',\'?s='.$_value['m'].'/'.$_value['c'].'/'.$_value['a'].'\')" hidefocus="true" style="outline:none;">'.L($_value['name']).'</a></li>';
}else {
echo '<li id="_M'.$_value['id'].'" class="top_menu"><a href="javascript:_M('.$_value['id'].',\'?s='.$_value['m'].'/'.$_value['c'].'/'.$_value['a'].'\')"  hidefocus="true" style="outline:none;">'.L($_value['name']).'</a></li>';
}
}
}else {
include $this->admin_tpl('left');
}
}
public function public_current_pos() {
echo admin::current_pos($_GET['menuid']);
exit;
}
public function public_set_siteid() {
$siteid = isset($_GET['siteid']) &&intval($_GET['siteid']) ?intval($_GET['siteid']) : exit('0');
param::set_cookie('siteid',$siteid);
exit('1');
}
public function public_ajax_add_panel() {
$menuid = isset($_POST['menuid']) ?$_POST['menuid'] : exit('0');
$menuarr = $this->menu_db->get_one(array('id'=>$menuid));
$url = '?s='.$menuarr['m'].'/'.$menuarr['c'].'/'.$menuarr['a'].'&'.$menuarr['data'];
$data = array('menuid'=>$menuid,'userid'=>$_SESSION['userid'],'name'=>$menuarr['name'],'url'=>$url,'datetime'=>SYS_TIME);
$this->panel_db->insert($data,'',1);
$panelarr = $this->panel_db->listinfo(array('userid'=>$_SESSION['userid']),"datetime");
foreach($panelarr as $v) {
echo "<span><a onclick='paneladdclass(this);' target='right' href='".$v['url'].'&menuid='.$v['menuid']."&h5_hash=".$_SESSION['h5_hash']."'>".L($v['name'])."</a>  <a class='panel-delete' href='javascript:delete_panel(".$v['menuid'].");'></a></span>";
}
exit;
}
public function public_ajax_delete_panel() {
$menuid = isset($_POST['menuid']) ?$_POST['menuid'] : exit('0');
$this->panel_db->delete(array('menuid'=>$menuid,'userid'=>$_SESSION['userid']));
$panelarr = $this->panel_db->listinfo(array('userid'=>$_SESSION['userid']),"datetime");
foreach($panelarr as $v) {
echo "<span><a onclick='paneladdclass(this);' target='right' href='".$v['url']."&h5_hash=".$_SESSION['h5_hash']."'>".L($v['name'])."</a> <a class='panel-delete' href='javascript:delete_panel(".$v['menuid'].");'></a></span>";
}
exit;
}
public function public_main() {
h5_base::load_app_func('global');
h5_base::load_app_func('admin');
define('h5_VERSION',h5_base::load_config('version','h5_version'));
define('h5_RELEASE',h5_base::load_config('version','h5_release'));
$admin_username = param::get_cookie('admin_username');
$roles = getcache('role','commons');
$userid = $_SESSION['userid'];
$rolename = $roles[$_SESSION['roleid']];
$r = $this->db->get_one(array('userid'=>$userid));
$logintime = $r['lastlogintime'];
$loginip = $r['lastloginip'];
$sysinfo = get_sysinfo();
$sysinfo['mysqlv'] = mysql_get_server_info();
$show_header = $show_h5_hash = 1;
$h5_writeable = is_writable(H5_PATH.'base.php');
$common_cache = getcache('common','commons');
$logsize_warning = errorlog_size() >$common_cache['errorlog_size'] ?'1': '0';
$adminpanel = $this->panel_db->select(array('userid'=>$userid),'*',20 ,'datetime');
$product_copyright = base64_decode('zf66o7/G0bbI7bz+09DP3rmry74=');
ob_start();
include $this->admin_tpl('main');
$data = ob_get_contents();
ob_end_clean();
system_information($data);
}
public function public_session_life() {
$userid = $_SESSION['userid'];
return true;
}
public function public_lock_screen() {
$_SESSION['lock_screen'] = 1;
}
public function public_login_screenlock() {
if(empty($_GET['lock_password'])) showmessage(L('password_can_not_be_empty'));
$this->times_db = h5_base::load_model('times_model');
$username = param::get_cookie('admin_username');
$maxloginfailedtimes = getcache('common','commons');
$maxloginfailedtimes = (int)$maxloginfailedtimes['maxloginfailedtimes'];
$rtime = $this->times_db->get_one(array('username'=>$username,'isadmin'=>1));
if($rtime['times'] >$maxloginfailedtimes-1) {
$minute = 60-floor((SYS_TIME-$rtime['logintime'])/60);
exit('3');
}
$r = $this->db->get_one(array('userid'=>$_SESSION['userid']));
$password = md5(md5($_GET['lock_password']).$r['encrypt']);
if($r['password'] != $password) {
$ip = ip();
if($rtime &&$rtime['times']<$maxloginfailedtimes) {
$times = $maxloginfailedtimes-intval($rtime['times']);
$this->times_db->update(array('ip'=>$ip,'isadmin'=>1,'times'=>'+=1'),array('username'=>$username));
}else {
$this->times_db->insert(array('username'=>$username,'ip'=>$ip,'isadmin'=>1,'logintime'=>SYS_TIME,'times'=>1));
$times = $maxloginfailedtimes;
}
exit('2|'.$times);
}
$this->times_db->delete(array('username'=>$username));
$_SESSION['lock_screen'] = 0;
exit('1');
}
public function public_map() {
$array = admin::admin_menu(0);
$menu = array();
foreach ($array as $k=>$v) {
$menu[$v['id']] = $v;
$menu[$v['id']]['childmenus'] = admin::admin_menu($v['id']);
}
$show_header = true;
include $this->admin_tpl('map');
}
}
?>