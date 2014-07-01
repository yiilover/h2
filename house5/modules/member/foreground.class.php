<?php

class foreground {
public $db,$memberinfo;
private $_member_modelinfo;
public function __construct() {
self::check_ip();
$this->db = h5_base::load_model('member_model');
if(substr(ROUTE_A,0,7) != 'public_') {
self::check_member();
}
}
final public function check_member() {
$house5_auth = param::get_cookie('auth');
$forward = isset($_GET['forward']) &&trim($_GET['forward']) ?$_GET['forward'] : 'index.php?s=member/index';
if(ROUTE_M =='member'&&ROUTE_C =='index'&&in_array(ROUTE_A,array('login','register','mini','send_newmail'))) {
if ($house5_auth &&ROUTE_A != 'mini') {
header('Location: '.$forward);
}else {
return true;
}
}else {
if ($house5_auth) {
$auth_key = $auth_key = md5(h5_base::load_config('system','auth_key').$_SERVER['HTTP_USER_AGENT']);
list($userid,$password) = explode("\t",sys_auth($house5_auth,'DECODE',$auth_key));
$this->memberinfo = $this->db->get_one(array('userid'=>$userid));
$this->db->set_model($this->memberinfo['modelid']);
$this->_member_modelinfo = $this->db->get_one(array('userid'=>$userid));
$this->_member_modelinfo = $this->_member_modelinfo ?$this->_member_modelinfo : array();
$this->db->set_model();
if(is_array($this->memberinfo)) {
$this->memberinfo = array_merge($this->memberinfo,$this->_member_modelinfo);
}
if($this->memberinfo &&$this->memberinfo['password'] === $password) {
if (!defined('SITEID')) {
define('SITEID',$this->memberinfo['siteid']);
}
if($this->memberinfo['groupid'] == 1) {
param::set_cookie('auth','');
param::set_cookie('_userid','');
param::set_cookie('_username','');
param::set_cookie('_groupid','');
showmessage(L('userid_banned_by_administrator','','member'),'index.php?s=member/index/login');
}elseif($this->memberinfo['groupid'] == 7) {
param::set_cookie('auth','');
param::set_cookie('_userid','');
param::set_cookie('_groupid','');
param::set_cookie('_regusername',$this->memberinfo['username']);
param::set_cookie('_reguserid',$this->memberinfo['userid']);
param::set_cookie('_reguseruid',$this->memberinfo['phpssouid']);
param::set_cookie('email',$this->memberinfo['email']);
showmessage(L('need_emial_authentication','','member'),'index.php?s=member/index/register/t/2');
}
}else {
param::set_cookie('auth','');
param::set_cookie('_userid','');
param::set_cookie('_username','');
param::set_cookie('_groupid','');
}
unset($userid,$password,$house5_auth,$auth_key);
}else {
$forward= isset($_GET['forward']) ?urlencode($_GET['forward']) : urlencode(get_url());
showmessage(L('please_login','','member'),'index.php?s=member/index/login/forward/'.$forward);
}
}
}
final private function check_ip(){
$this->ipbanned = h5_base::load_model('ipbanned_model');
$this->ipbanned->check_ip();
}
}?>