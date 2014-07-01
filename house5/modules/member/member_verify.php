<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
h5_base::load_sys_class('format','',0);
class member_verify extends admin {
private $db,$member_db;
function __construct() {
parent::__construct();
$this->db = h5_base::load_model('member_verify_model');
$this->_init_phpsso();
}
function init() {
include $this->admin_tpl('member_init');
}
function manage() {
$status = !empty($_GET['s']) ?$_GET['s'] : 0;
$where = array('status'=>$status);
$page = isset($_GET['page']) ?intval($_GET['page']) : 1;
$memberlist = $this->db->listinfo($where,'regdate DESC',$page,10);
$pages = $this->db->pages;
$member_model = getcache('member_model','commons');
include $this->admin_tpl('member_verify');
}
function modelinfo() {
$userid = !empty($_GET['userid']) ?intval($_GET['userid']) : showmessage(L('illegal_parameters'),HTTP_REFERER);
$modelid = !empty($_GET['modelid']) ?intval($_GET['modelid']) : showmessage(L('illegal_parameters'),HTTP_REFERER);
$memberinfo = $this->db->get_one(array('userid'=>$userid));
$this->member_field_db = h5_base::load_model('sitemodel_field_model');
$model_fieldinfo = $this->member_field_db->select(array('modelid'=>$modelid),"*",100);
$member_fieldinfo = string2array($memberinfo['modelinfo']);
foreach($model_fieldinfo as $v) {
if(array_key_exists($v['field'],$member_fieldinfo)) {
$tmp = $member_fieldinfo[$v['field']];
unset($member_fieldinfo[$v['field']]);
$member_fieldinfo[$v['name']] = $tmp;
unset($tmp);
}
}
include $this->admin_tpl('member_verify_modelinfo');
}
function pass() {
if (isset($_POST['userid'])) {
$this->member_db = h5_base::load_model('member_model');
$uidarr = isset($_POST['userid']) ?$_POST['userid'] : showmessage(L('illegal_parameters'),HTTP_REFERER);
$where = to_sqls($uidarr,'','userid');
$userarr = $this->db->listinfo($where);
$success_uids = $info = array();
foreach($userarr as $v) {
$info['password'] = password($v['password'],$v['encrypt']);
$info['regdate'] = $info['lastdate'] = $v['regdate'];
$info['username'] = $v['username'];
$info['nickname'] = $v['nickname'];
$info['email'] = $v['email'];
$info['regip'] = $v['regip'];
$info['point'] = $v['point'];
$info['groupid'] = $this->_get_usergroup_bypoint($v['point']);
$info['typeid'] = $v['typeid'];;
$info['amount'] = $v['amount'];
$info['encrypt'] = $v['encrypt'];
$info['modelid'] = $v['modelid'] ?$v['modelid'] : 10;
$userid = $this->member_db->insert($info,1);
if($v['modelinfo']) {
$user_model_info = string2array($v['modelinfo']);
$user_model_info['userid'] = $userid;
$this->member_db->set_model($info['modelid']);
$this->member_db->insert($user_model_info);
}
if($userid) {
$success_uids[] = $v['userid'];
}
if(h5_base::load_config('uc','ucuse')) {
$this->_init_ucenter();
if(defined('UC_API') &&require_once './api/uc_client/client.php')
{
$uid = uc_user_register($v['username'],$v['password'],$v['email']);
if($uid >0) $ucsynlogin = uc_user_synlogin($uid);
}
}
}
$where = to_sqls($success_uids,'','userid');
$this->db->update(array('status'=>1,'message'=>$_POST['message']),$where);
$fail_uids = array_diff($uidarr,$success_uids);
if (!empty($fail_uids)) {
$where = to_sqls($fail_uids,'','userid');
$this->db->update(array('status'=>5,'message'=>$_POST['message']),$where);
}
if($_POST['sendemail']) {
$memberinfo = $this->db->select($where);
h5_base::load_sys_func('mail');
foreach ($memberinfo as $v) {
sendmail($v['email'],L('reg_pass'),$_POST['message']);
}
}
showmessage(L('pass').L('operation_success'),HTTP_REFERER);
}else {
showmessage(L('operation_failure'),HTTP_REFERER);
}
}
function delete() {
if(isset($_POST['userid'])) {
$uidarr = isset($_POST['userid']) ?$_POST['userid'] : showmessage(L('illegal_parameters'),HTTP_REFERER);
$message = stripslashes($_POST['message']);
$where = to_sqls($uidarr,'','userid');
$this->db->delete($where);
showmessage(L('delete').L('operation_success'),HTTP_REFERER);
}else {
showmessage(L('operation_failure'),HTTP_REFERER);
}
}
function reject() {
if(isset($_POST['userid'])) {
$uidarr = isset($_POST['userid']) ?$_POST['userid'] : showmessage(L('illegal_parameters'),HTTP_REFERER);
$where = to_sqls($uidarr,'','userid');
$res = $this->db->update(array('status'=>4,'message'=>$_POST['message']),$where);
if($res) {
if($_POST['sendemail']) {
$memberinfo = $this->db->select($where);
h5_base::load_sys_func('mail');
foreach ($memberinfo as $v) {
sendmail($v['email'],L('reg_reject'),$_POST['message']);
}
}
}
showmessage(L('reject').L('operation_success'),HTTP_REFERER);
}else {
showmessage(L('operation_failure'),HTTP_REFERER);
}
}
function ignore() {
if(isset($_POST['userid'])) {
$uidarr = isset($_POST['userid']) ?$_POST['userid'] : showmessage(L('illegal_parameters'),HTTP_REFERER);
$where = to_sqls($uidarr,'','userid');
$res = $this->db->update(array('status'=>2,'message'=>$_POST['message']),$where);
if($res) {
if($_POST['sendemail']) {
$memberinfo = $this->db->select($where);
h5_base::load_sys_func('mail');
foreach ($memberinfo as $v) {
sendmail($v['email'],L('reg_ignore'),$_POST['message']);
}
}
}
showmessage(L('ignore').L('operation_success'),HTTP_REFERER);
}else {
showmessage(L('operation_failure'),HTTP_REFERER);
}
}
function _edit_password($userid,$password){
$userid = intval($userid);
if($userid <1) return false;
if(!is_password($password))
{
showmessage(L('password_format_incorrect'));
return false;
}
$passwordinfo = password($password);
return $this->db->update($passwordinfo,array('userid'=>$userid));
}
private function _checkuserinfo($data,$is_edit=0) {
if(!is_array($data)){
showmessage(L('need_more_param'));return false;
}elseif (!is_username($data['username']) &&!$is_edit){
showmessage(L('username_format_incorrect'));return false;
}elseif (!isset($data['userid']) &&$is_edit) {
showmessage(L('username_format_incorrect'));return false;
}elseif (empty($data['email']) ||!is_email($data['email'])){
showmessage(L('email_format_incorrect'));return false;
}
return $data;
}
private function _checkpasswd($password){
if (!is_password($password)){
return false;
}
return true;
}
private function _checkname($username) {
$username =  trim($username);
if ($this->db->get_one(array('username'=>$username))){
return false;
}
return true;
}
private function _get_usergroup_bypoint($point=0) {
$groupid = 2;
if(empty($point)) {
$member_setting = getcache('member_setting');
$point = $member_setting['defualtpoint'] ?$member_setting['defualtpoint'] : 0;
}
$grouplist = getcache('grouplist');
foreach ($grouplist as $k=>$v) {
$grouppointlist[$k] = $v['point'];
}
arsort($grouppointlist);
if($point >max($grouppointlist)) {
$groupid = key($grouppointlist);
}else {
foreach ($grouppointlist as $k=>$v) {
if($point >= $v) {
$groupid = $tmp_k;
break;
}
$tmp_k = $k;
}
}
return $groupid;
}
private function _init_phpsso() {
h5_base::load_app_class('client','',0);
$auth_key = h5_base::load_config('system','auth_key');
$this->client = new client(APP_PATH,$auth_key);
return APP_PATH;
}
private function _init_ucenter() {
define('UC_API',h5_base::load_config('uc','uc_api'));
define('UC_CONNECT','mysql');
define('UC_DBHOST',h5_base::load_config('uc','uc_dbhost'));
define('UC_DBUSER',h5_base::load_config('uc','uc_dbuser'));
define('UC_DBPW',h5_base::load_config('uc','uc_dbpw'));
define('UC_DBCHARSET',h5_base::load_config('uc','uc_dbcharset'));
define('UC_DBNAME',h5_base::load_config('uc','uc_dbname'));
define('UC_DBTABLEPRE',h5_base::load_config('uc','uc_dbtablepre'));
define('UC_KEY',h5_base::load_config('uc','uc_key'));
define('UC_DBCONNECT','0');
define('UC_CHARSET',h5_base::load_config('uc','uc_dbcharset'));
define('UC_IP',h5_base::load_config('uc','uc_ip'));
define('UC_APPID',h5_base::load_config('uc','uc_appid'));
define('UC_PPP','20');
return UC_API;
}
public function checkname_ajax() {
$username = isset($_GET['username']) &&trim($_GET['username']) ?trim($_GET['username']) : exit(0);
$username = iconv('utf-8',CHARSET,$username);
$status = $this->client->ps_checkname($username);
if($status == -4) {
exit('0');
}
$status = $this->client->ps_get_member_info($username,2);
if (is_array($status)) {
exit('0');
}else {
exit('1');
}
}
public function checkemail_ajax() {
$email = isset($_GET['email']) &&trim($_GET['email']) ?trim($_GET['email']) : exit(0);
$status = $this->client->ps_checkemail($email);
if($status == -5) {
exit('0');
}
$status = $this->client->ps_get_member_info($email,3);
if(isset($_GET['phpssouid']) &&isset($status['uid'])) {
if ($status['uid'] == intval($_GET['phpssouid'])) {
exit('1');
}
}
if (is_array($status)) {
exit('0');
}else {
exit('1');
}
}
}
?>