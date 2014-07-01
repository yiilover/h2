<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('foreground');
h5_base::load_sys_class('format','',0);
h5_base::load_sys_class('form','',0);
class index extends foreground {
private $times_db;
function __construct() {
parent::__construct();
$this->http_user_agent = $_SERVER['HTTP_USER_AGENT'];
}
public function init() {
$memberinfo = $this->memberinfo;
$phpsso_api_url = $this->_init_phpsso();
$avatar = $this->client->ps_getavatar($this->memberinfo['phpssouid']);
$grouplist = getcache('grouplist');
$memberinfo['groupname'] = $grouplist[$memberinfo[groupid]]['name'];
include template('member','index');
}
public function register() {
$this->_session_start();
$member_setting = getcache('member_setting');
if(!$member_setting['allowregister']) {
showmessage(L('deny_register'),'index.php?s=member/index/login');
}
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
if (!defined('SITEID')) {
define('SITEID',$siteid);
}
header("Cache-control: private");
if(isset($_POST['dosubmit'])) {
if (empty($_SESSION['connectid']) &&$_SESSION['code'] != strtolower($_POST['code'])) {
showmessage(L('code_error'));
}
$userinfo = array();
$userinfo['encrypt'] = create_randomstr(6);
$userinfo['username'] = (isset($_POST['username']) &&is_username($_POST['username'])) ?$_POST['username'] : exit('0');
$userinfo['nickname'] = (isset($_POST['nickname']) &&is_username($_POST['nickname'])) ?$_POST['nickname'] : '';
$userinfo['email'] = (isset($_POST['email']) &&is_email($_POST['email'])) ?$_POST['email'] : exit('0');
$userinfo['password'] = isset($_POST['password']) ?$_POST['password'] : exit('0');
$userinfo['email'] = (isset($_POST['email']) &&is_email($_POST['email'])) ?$_POST['email'] : exit('0');
$userinfo['modelid'] = isset($_POST['modelid']) ?intval($_POST['modelid']) : 10;
$userinfo['regip'] = ip();
$userinfo['point'] = $member_setting['defualtpoint'] ?$member_setting['defualtpoint'] : 0;
$userinfo['amount'] = $member_setting['defualtamount'] ?$member_setting['defualtamount'] : 0;
$userinfo['regdate'] = $userinfo['lastdate'] = SYS_TIME;
$userinfo['siteid'] = $siteid;
$userinfo['connectid'] = isset($_SESSION['connectid']) ?$_SESSION['connectid'] : '';
$userinfo['from'] = isset($_SESSION['from']) ?$_SESSION['from'] : '';
unset($_SESSION['connectid'],$_SESSION['from']);
if($member_setting['enablemailcheck']) {
$userinfo['groupid'] = 7;
}elseif($member_setting['registerverify']) {
$userinfo['modelinfo'] = isset($_POST['info']) ?array2string($_POST['info']) : '';
$this->verify_db = h5_base::load_model('member_verify_model');
unset($userinfo['lastdate'],$userinfo['connectid'],$userinfo['from']);
$this->verify_db->insert($userinfo);
showmessage(L('operation_success'),'index.php?s=member/index/register/t/3');
}else {
$model_field_cache = getcache('model_field_'.$userinfo['modelid'],'model');
if(isset($model_field_cache['mobile']) &&$model_field_cache['mobile']['disabled']==0) {
$mobile = $_POST['info']['mobile'];
if(!preg_match('/^1([0-9]{10})/',$mobile)) showmessage(L('input_right_mobile'));
$sms_report_db = h5_base::load_model('sms_report_model');
$posttime = SYS_TIME-300;
$where = "`mobile`='$mobile' AND `posttime`>'$posttime'";
$r = $sms_report_db->get_one($where);
if(!$r ||$r['id_code']!=$_POST['mobile_verify']) showmessage(L('error_sms_code'));
}
$userinfo['groupid'] = $this->_get_usergroup_bypoint($userinfo['point']);
}
if(h5_base::load_config('system','phpsso')) {
$this->_init_phpsso();
$status = $this->client->ps_member_register($userinfo['username'],$userinfo['password'],$userinfo['email'],$userinfo['regip'],$userinfo['encrypt']);
if($status >0) {
$userinfo['phpssouid'] = $status;
$password = $userinfo['password'];
$userinfo['password'] = password($userinfo['password'],$userinfo['encrypt']);
$userid = $this->db->insert($userinfo,1);
if($member_setting['choosemodel']) {
require_once CACHE_MODEL_PATH.'member_input.class.php';
require_once CACHE_MODEL_PATH.'member_update.class.php';
$member_input = new member_input($userinfo['modelid']);
$user_model_info = $member_input->get($_POST['info']);
$user_model_info['userid'] = $userid;
$this->db->set_model($userinfo['modelid']);
$this->db->insert($user_model_info);
}
if($userid >0) {
if(!$cookietime) $get_cookietime = param::get_cookie('cookietime');
$_cookietime = $cookietime ?intval($cookietime) : ($get_cookietime ?$get_cookietime : 0);
$cookietime = $_cookietime ?TIME +$_cookietime : 0;
if($userinfo['groupid'] == 7) {
param::set_cookie('_username',$userinfo['username'],$cookietime);
param::set_cookie('email',$userinfo['email'],$cookietime);
}else {
$house5_auth_key = md5(h5_base::load_config('system','auth_key').$this->http_user_agent);
$house5_auth = sys_auth($userid."\t".$userinfo['password'],'ENCODE',$house5_auth_key);
param::set_cookie('auth',$house5_auth,$cookietime);
param::set_cookie('_userid',$userid,$cookietime);
param::set_cookie('_username',$userinfo['username'],$cookietime);
param::set_cookie('_nickname',$userinfo['nickname'],$cookietime);
param::set_cookie('_groupid',$userinfo['groupid'],$cookietime);
param::set_cookie('cookietime',$_cookietime,$cookietime);
}
}
if($member_setting['enablemailcheck']) {
h5_base::load_sys_func('mail');
$house5_auth_key = md5(h5_base::load_config('system','auth_key'));
$code = sys_auth($userid.'|'.$house5_auth_key,'ENCODE',$house5_auth_key);
$url = APP_PATH."index.php?s=member/index/register/code/$code/verify/1";
$message = $member_setting['registerverifymessage'];
$message = str_replace(array('{click}','{url}','{username}','{email}','{password}'),array('<a href="'.$url.'">'.L('please_click').'</a>',$url,$userinfo['username'],$userinfo['email'],$password),$message);
sendmail($userinfo['email'],L('reg_verify_email'),$message);
param::set_cookie('_regusername',$userinfo['username'],$cookietime);
param::set_cookie('_reguserid',$userid,$cookietime);
param::set_cookie('_reguseruid',$userinfo['phpssouid'],$cookietime);
showmessage(L('operation_success'),'index.php?s=member/index/register/t/2');
}else {
$synloginstr = $this->client->ps_member_synlogin($userinfo['phpssouid']);
showmessage(L('operation_success').$synloginstr,'index.php?s=member/index/init');
}
}
}else {
showmessage(L('enable_register').L('enable_phpsso'),'index.php?s=member/index/login');
}
showmessage(L('operation_failure'),HTTP_REFERER);
}else {
if(!h5_base::load_config('system','phpsso')) {
showmessage(L('enable_register').L('enable_phpsso'),'index.php?s=member/index/login');
}
if(!empty($_GET['verify'])) {
$code = isset($_GET['code']) ?trim($_GET['code']) : showmessage(L('operation_failure'),'index.php?s=member/index');
$house5_auth_key = md5(h5_base::load_config('system','auth_key'));
$code_res = sys_auth($code,'DECODE',$house5_auth_key);
$code_arr = explode('|',$code_res);
$userid = isset($code_arr[0]) ?$code_arr[0] : '';
$userid = is_numeric($userid) ?$userid : showmessage(L('operation_failure'),'index.php?s=member/index');
$this->db->update(array('groupid'=>$this->_get_usergroup_bypoint()),array('userid'=>$userid));
showmessage(L('operation_success'),'index.php?s=member/index');
}elseif(!empty($_GET['protocol'])) {
include template('member','protocol');
}else {
$modellist = getcache('member_model','commons');
foreach($modellist as $k=>$v) {
if($v['siteid']!=$siteid ||$v['disabled']) {
unset($modellist[$k]);
}
}
if(empty($modellist)) {
showmessage(L('site_have_no_model').L('deny_register'),HTTP_REFERER);
}
if($member_setting['choosemodel']) {
$first_model = array_pop(array_reverse($modellist));
$modelid = isset($_GET['modelid']) &&in_array($_GET['modelid'],array_keys($modellist)) ?intval($_GET['modelid']) : $first_model['modelid'];
if(array_key_exists($modelid,$modellist)) {
require CACHE_MODEL_PATH.'member_form.class.php';
$member_form = new member_form($modelid);
$this->db->set_model($modelid);
$forminfos = $forminfos_arr = $member_form->get();
foreach($forminfos as $field=>$info) {
if($info['isomnipotent']) {
unset($forminfos[$field]);
}else {
if($info['formtype']=='omnipotent') {
foreach($forminfos_arr as $_fm=>$_fm_value) {
if($_fm_value['isomnipotent']) {
$info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
}
}
$forminfos[$field]['form'] = $info['form'];
}
}
}
$formValidator = $member_form->formValidator;
}
}
$description = $modellist[$modelid]['description'];
include template('member','register');
}
}
}
public function send_newmail() {
$_username = param::get_cookie('_regusername');
$_userid = param::get_cookie('_reguserid');
$_ssouid = param::get_cookie('_reguseruid');
$newemail = $_GET['newemail'];
if($newemail==''){
return '2';
}
$this->_init_phpsso();
$status = $this->client->ps_checkemail($newemail);
if($status=='-5'){
exit('-1');
}
if ($status==-1) {
$status = $this->client->ps_get_member_info($newemail,3);
if($status) {
$status = unserialize($status);
if (!isset($status['uid']) ||$status['uid'] != intval($_ssouid)) {
exit('-1');
}
}else {
exit('-1');
}
}
h5_base::load_sys_func('mail');
$house5_auth_key = md5(h5_base::load_config('system','auth_key'));
$code = sys_auth($_userid.'|'.$house5_auth_key,'ENCODE',$house5_auth_key);
$url = APP_PATH."index.php?s=member/index/register/code/$code/verify/1";
$member_setting = getcache('member_setting');
$message = $member_setting['registerverifymessage'];
$message = str_replace(array('{click}','{url}','{username}','{email}','{password}'),array('<a href="'.$url.'">'.L('please_click').'</a>',$url,$_username,$newemail,$password),$message);
if(sendmail($newemail,L('reg_verify_email'),$message)){
$this->db->update(array('email'=>$newemail),array('userid'=>$_userid));
$this->client->ps_member_edit($_username,$newemail,'','',$_ssouid);
$return = '1';
}else{
$return = '2';
}
echo $return;
}
public function account_manage() {
$memberinfo = $this->memberinfo;
$phpsso_api_url = $this->_init_phpsso();
$avatar = $this->client->ps_getavatar($this->memberinfo['phpssouid']);
$grouplist = getcache('grouplist');
$member_model = getcache('member_model','commons');
$this->db->set_model($this->memberinfo['modelid']);
$member_modelinfo_arr = $this->db->get_one(array('userid'=>$this->memberinfo['userid']));
$model_info = getcache('model_field_'.$this->memberinfo['modelid'],'model');
foreach($model_info as $k=>$v) {
if($v['formtype'] == 'omnipotent') continue;
if($v['formtype'] == 'image') {
$member_modelinfo[$v['name']] = "<a href='$member_modelinfo_arr[$k]' target='_blank'><img src='$member_modelinfo_arr[$k]' height='40' widht='40' onerror=\"this.src='$phpsso_api_url/statics/images/member/nophoto.gif'\"></a>";
}elseif($v['formtype'] == 'datetime'&&$v['fieldtype'] == 'int') {
$member_modelinfo[$v['name']] = format::date($member_modelinfo_arr[$k],$v['format'] == 'Y-m-d H:i:s'?1 : 0);
}elseif($v['formtype'] == 'images') {
$tmp = string2array($member_modelinfo_arr[$k]);
$member_modelinfo[$v['name']] = '';
if(is_array($tmp)) {
foreach ($tmp as $tv) {
$member_modelinfo[$v['name']] .= " <a href='$tv[url]' target='_blank'><img src='$tv[url]' height='40' widht='40' onerror=\"this.src='$phpsso_api_url/statics/images/member/nophoto.gif'\"></a>";
}
unset($tmp);
}
}elseif($v['formtype'] == 'box') {
$tmp = explode("\n",$v['options']);
if(is_array($tmp)) {
foreach($tmp as $boxv) {
$box_tmp_arr = explode('|',trim($boxv));
if(is_array($box_tmp_arr) &&isset($box_tmp_arr[1]) &&isset($box_tmp_arr[0])) {
$box_tmp[$box_tmp_arr[1]] = $box_tmp_arr[0];
$tmp_key = intval($member_modelinfo_arr[$k]);
}
}
}
if(isset($box_tmp[$tmp_key])) {
$member_modelinfo[$v['name']] = $box_tmp[$tmp_key];
}else {
$member_modelinfo[$v['name']] = $member_modelinfo_arr[$k];
}
unset($tmp,$tmp_key,$box_tmp,$box_tmp_arr);
}elseif($v['formtype'] == 'linkage') {
$tmp = string2array($v['setting']);
$tmpid = $tmp['linkageid'];
$linkagelist = getcache($tmpid,'linkage');
$fullname = $this->_get_linkage_fullname($member_modelinfo_arr[$k],$linkagelist);
$member_modelinfo[$v['name']] = substr($fullname,0,-1);
unset($tmp,$tmpid,$linkagelist,$fullname);
}else {
$member_modelinfo[$v['name']] = $member_modelinfo_arr[$k];
}
}
include template('member','account_manage');
}
public function account_manage_avatar() {
$memberinfo = $this->memberinfo;
$phpsso_api_url = $this->_init_phpsso();
$ps_auth_key = h5_base::load_config('system','phpsso_auth_key');
$auth_data = $this->client->auth_data(array('uid'=>$this->memberinfo['phpssouid'],'ps_auth_key'=>$ps_auth_key),'',$ps_auth_key);
$upurl = base64_encode($phpsso_api_url.'/index.php?m=phpsso&c=index&a=uploadavatar&auth_data='.$auth_data);
$avatar = $this->client->ps_getavatar($this->memberinfo['phpssouid']);
include template('member','account_manage_avatar');
}
public function account_manage_security() {
$memberinfo = $this->memberinfo;
include template('member','account_manage_security');
}
public function account_manage_info() {
if(isset($_POST['dosubmit'])) {
$nickname = isset($_POST['nickname']) &&trim($_POST['nickname']) ?trim($_POST['nickname']) : '';
if($nickname) {
$this->db->update(array('nickname'=>$nickname),array('userid'=>$this->memberinfo['userid']));
if(!isset($cookietime)) {
$get_cookietime = param::get_cookie('cookietime');
}
$_cookietime = $cookietime ?intval($cookietime) : ($get_cookietime ?$get_cookietime : 0);
$cookietime = $_cookietime ?TIME +$_cookietime : 0;
param::set_cookie('_nickname',$nickname,$cookietime);
}
require_once CACHE_MODEL_PATH.'member_input.class.php';
require_once CACHE_MODEL_PATH.'member_update.class.php';
$member_input = new member_input($this->memberinfo['modelid']);
$modelinfo = $member_input->get($_POST['info']);
$this->db->set_model($this->memberinfo['modelid']);
$membermodelinfo = $this->db->get_one(array('userid'=>$this->memberinfo['userid']));
if(!empty($membermodelinfo)) {
$this->db->update($modelinfo,array('userid'=>$this->memberinfo['userid']));
}else {
$modelinfo['userid'] = $this->memberinfo['userid'];
$this->db->insert($modelinfo);
}
showmessage(L('operation_success'),HTTP_REFERER);
}else {
$memberinfo = $this->memberinfo;
require CACHE_MODEL_PATH.'member_form.class.php';
$member_form = new member_form($this->memberinfo['modelid']);
$this->db->set_model($this->memberinfo['modelid']);
$membermodelinfo = $this->db->get_one(array('userid'=>$this->memberinfo['userid']));
$forminfos = $forminfos_arr = $member_form->get($membermodelinfo);
foreach($forminfos as $field=>$info) {
if($info['isomnipotent']) {
unset($forminfos[$field]);
}else {
if($info['formtype']=='omnipotent') {
foreach($forminfos_arr as $_fm=>$_fm_value) {
if($_fm_value['isomnipotent']) {
$info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
}
}
$forminfos[$field]['form'] = $info['form'];
}
}
}
$formValidator = $member_form->formValidator;
include template('member','account_manage_info');
}
}
public function account_manage_password() {
if(isset($_POST['dosubmit'])) {
if(!is_password($_POST['info']['password'])) {
showmessage(L('password_format_incorrect'),HTTP_REFERER);
}
if($this->memberinfo['password'] != password($_POST['info']['password'],$this->memberinfo['encrypt'])) {
showmessage(L('old_password_incorrect'),HTTP_REFERER);
}
if($this->memberinfo['email'] != $_POST['info']['email'] &&is_email($_POST['info']['email'])) {
$email = $_POST['info']['email'];
$updateinfo['email'] = $_POST['info']['email'];
}else {
$email = '';
}
$newpassword = password($_POST['info']['newpassword'],$this->memberinfo['encrypt']);
$updateinfo['password'] = $newpassword;
$this->db->update($updateinfo,array('userid'=>$this->memberinfo['userid']));
if(h5_base::load_config('system','phpsso')) {
$this->_init_phpsso();
$res = $this->client->ps_member_edit('',$email,$_POST['info']['password'],$_POST['info']['newpassword'],$this->memberinfo['phpssouid'],$this->memberinfo['encrypt']);
}
showmessage(L('operation_success'),HTTP_REFERER);
}else {
$show_validator = true;
$memberinfo = $this->memberinfo;
include template('member','account_manage_password');
}
}
public function account_manage_upgrade() {
$memberinfo = $this->memberinfo;
$grouplist = getcache('grouplist');
if(empty($grouplist[$memberinfo['groupid']]['allowupgrade'])) {
showmessage(L('deny_upgrade'),HTTP_REFERER);
}
if(isset($_POST['upgrade_type']) &&intval($_POST['upgrade_type']) <0) {
showmessage(L('operation_failure'),HTTP_REFERER);
}
if(isset($_POST['upgrade_date']) &&intval($_POST['upgrade_date']) <0) {
showmessage(L('operation_failure'),HTTP_REFERER);
}
if(isset($_POST['dosubmit'])) {
$groupid = isset($_POST['groupid']) ?intval($_POST['groupid']) : showmessage(L('operation_failure'),HTTP_REFERER);
$upgrade_type = isset($_POST['upgrade_type']) ?intval($_POST['upgrade_type']) : showmessage(L('operation_failure'),HTTP_REFERER);
$upgrade_date = !empty($_POST['upgrade_date']) ?intval($_POST['upgrade_date']) : showmessage(L('operation_failure'),HTTP_REFERER);
$typearr = array($grouplist[$groupid]['price_y'],$grouplist[$groupid]['price_m'],$grouplist[$groupid]['price_d']);
$typedatearr = array('366','31','1');
$cost = $typearr[$upgrade_type]*$upgrade_date;
$buydate = $typedatearr[$upgrade_type]*$upgrade_date*86400;
$overduedate = $memberinfo['overduedate'] >SYS_TIME ?($memberinfo['overduedate']+$buydate) : (SYS_TIME+$buydate);
if($memberinfo['amount'] >= $cost) {
$this->db->update(array('groupid'=>$groupid,'overduedate'=>$overduedate,'vip'=>1),array('userid'=>$memberinfo['userid']));
h5_base::load_app_class('spend','pay',0);
spend::amount($cost,L('allowupgrade'),$memberinfo['userid'],$memberinfo['username']);
showmessage(L('operation_success'),'index.php?s=member/index/init');
}else {
showmessage(L('operation_failure'),HTTP_REFERER);
}
}else {
$groupid = isset($_GET['groupid']) ?intval($_GET['groupid']) : '';
$phpsso_api_url = $this->_init_phpsso();
$avatar = $this->client->ps_getavatar($this->memberinfo['phpssouid']);
$memberinfo['groupname'] = $grouplist[$memberinfo[groupid]]['name'];
$memberinfo['grouppoint'] = $grouplist[$memberinfo[groupid]]['point'];
unset($grouplist[$memberinfo['groupid']]);
include template('member','account_manage_upgrade');
}
}
public function login() {
$this->_session_start();
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
if (!defined('SITEID')) {
define('SITEID',$siteid);
}
if(isset($_POST['dosubmit'])) {
if(empty($_SESSION['connectid'])) {
$code = isset($_POST['code']) &&trim($_POST['code']) ?trim($_POST['code']) : showmessage(L('input_code'),HTTP_REFERER);
if ($_SESSION['code'] != strtolower($code)) {
showmessage(L('code_error'),HTTP_REFERER);
}
}
$username = isset($_POST['username']) &&trim($_POST['username']) ?trim($_POST['username']) : showmessage(L('username_empty'),HTTP_REFERER);
$password = isset($_POST['password']) &&trim($_POST['password']) ?trim($_POST['password']) : showmessage(L('password_empty'),HTTP_REFERER);
$cookietime = intval($_POST['cookietime']);
$synloginstr = '';
if(h5_base::load_config('system','phpsso')) {
$this->_init_phpsso();
$status = $this->client->ps_member_login($username,$password);
$memberinfo = unserialize($status);
if(isset($memberinfo['uid'])) {
$r = $this->db->get_one(array('phpssouid'=>$memberinfo['uid']));
if(!$r) {
$info = array(
'phpssouid'=>$memberinfo['uid'],
'username'=>$memberinfo['username'],
'password'=>$memberinfo['password'],
'encrypt'=>$memberinfo['random'],
'email'=>$memberinfo['email'],
'regip'=>$memberinfo['regip'],
'regdate'=>$memberinfo['regdate'],
'lastip'=>$memberinfo['lastip'],
'lastdate'=>$memberinfo['lastdate'],
'groupid'=>$this->_get_usergroup_bypoint(),
'modelid'=>10,
);
if(!empty($_SESSION['connectid'])) {
$userinfo['connectid'] = $_SESSION['connectid'];
}
if(!empty($_SESSION['from'])) {
$userinfo['from'] = $_SESSION['from'];
}
unset($_SESSION['connectid'],$_SESSION['from']);
$this->db->insert($info);
unset($info);
$r = $this->db->get_one(array('phpssouid'=>$memberinfo['uid']));
}
$password = $r['password'];
$synloginstr = $this->client->ps_member_synlogin($r['phpssouid']);
}else {
if($status == -1) {
showmessage(L('user_not_exist'),'index.php?s=member/index/login');
}elseif($status == -2) {
showmessage(L('password_error'),'index.php?s=member/index/login');
}else {
showmessage(L('login_failure'),'index.php?s=member/index/login');
}
}
}else {
$this->times_db = h5_base::load_model('times_model');
$rtime = $this->times_db->get_one(array('username'=>$username));
if($rtime['times'] >4) {
$minute = 60 -floor((SYS_TIME -$rtime['logintime']) / 60);
showmessage(L('wait_1_hour',array('minute'=>$minute)));
}
$r = $this->db->get_one(array('username'=>$username));
if(!$r) showmessage(L('user_not_exist'),'index.php?s=member/index/login');
$password = md5(md5(trim($password)).$r['encrypt']);
if($r['password'] != $password) {
$ip = ip();
if($rtime &&$rtime['times'] <5) {
$times = 5 -intval($rtime['times']);
$this->times_db->update(array('ip'=>$ip,'times'=>'+=1'),array('username'=>$username));
}else {
$this->times_db->insert(array('username'=>$username,'ip'=>$ip,'logintime'=>SYS_TIME,'times'=>1));
$times = 5;
}
showmessage(L('password_error',array('times'=>$times)),'index.php?s=member/index/login',3000);
}
$this->times_db->delete(array('username'=>$username));
}
if($r['islock']) {
showmessage(L('user_is_lock'));
}
$userid = $r['userid'];
$groupid = $r['groupid'];
$username = $r['username'];
$nickname = empty($r['nickname']) ?$username : $r['nickname'];
$updatearr = array('lastip'=>ip(),'lastdate'=>SYS_TIME);
if($r['overduedate'] <SYS_TIME) {
$updatearr['vip'] = 0;
}
if($r['point'] >= 0 &&!in_array($r['groupid'],array('1','7','8')) &&empty($r[vip])) {
$grouplist = getcache('grouplist');
if(!empty($grouplist[$r['groupid']]['allowupgrade'])) {
$check_groupid = $this->_get_usergroup_bypoint($r['point']);
if($check_groupid != $r['groupid']) {
$updatearr['groupid'] = $groupid = $check_groupid;
}
}
}
if(!empty($_SESSION['connectid'])) {
$updatearr['connectid'] = $_SESSION['connectid'];
}
if(!empty($_SESSION['from'])) {
$updatearr['from'] = $_SESSION['from'];
}
unset($_SESSION['connectid'],$_SESSION['from']);
$this->db->update($updatearr,array('userid'=>$userid));
if(!isset($cookietime)) {
$get_cookietime = param::get_cookie('cookietime');
}
$_cookietime = $cookietime ?intval($cookietime) : ($get_cookietime ?$get_cookietime : 0);
$cookietime = $_cookietime ?SYS_TIME +$_cookietime : 0;
$house5_auth_key = md5(h5_base::load_config('system','auth_key').$this->http_user_agent);
$house5_auth = sys_auth($userid."\t".$password,'ENCODE',$house5_auth_key);
param::set_cookie('auth',$house5_auth,$cookietime);
param::set_cookie('_userid',$userid,$cookietime);
param::set_cookie('_username',$username,$cookietime);
param::set_cookie('_groupid',$groupid,$cookietime);
param::set_cookie('_nickname',$nickname,$cookietime);
$forward = isset($_POST['forward']) &&!empty($_POST['forward']) ?urldecode($_POST['forward']) : 'index.php?s=member/index';
showmessage(L('login_success').$synloginstr,$forward);
}else {
$setting = h5_base::load_config('system');
$forward = isset($_GET['forward']) &&trim($_GET['forward']) ?urlencode($_GET['forward']) : '';
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$siteinfo = siteinfo($siteid);
include template('member','login');
}
}
public function logout() {
$setting = h5_base::load_config('system');
if($setting['snda_enable'] &&param::get_cookie('_from')=='snda') {
param::set_cookie('_from','');
$forward = isset($_GET['forward']) &&trim($_GET['forward']) ?urlencode($_GET['forward']) : '';
$logouturl = 'https://cas.sdo.com/cas/logout?url='.urlencode(APP_PATH.'index.php?s=member/index/logout/forward/'.$forward);
header('Location: '.$logouturl);
}else {
$synlogoutstr = '';
if(h5_base::load_config('system','phpsso')) {
$this->_init_phpsso();
$synlogoutstr = $this->client->ps_member_synlogout();
}
param::set_cookie('auth','');
param::set_cookie('_userid','');
param::set_cookie('_username','');
param::set_cookie('_groupid','');
param::set_cookie('_nickname','');
param::set_cookie('cookietime','');
$forward = isset($_GET['forward']) &&trim($_GET['forward']) ?$_GET['forward'] : 'index.php?s=member/index/login';
showmessage(L('logout_success').$synlogoutstr,$forward);
}
}
public function favorite() {
$this->favorite_db = h5_base::load_model('favorite_model');
$memberinfo = $this->memberinfo;
if(isset($_GET['id']) &&trim($_GET['id'])) {
$this->favorite_db->delete(array('userid'=>$memberinfo['userid'],'id'=>intval($_GET['id'])));
showmessage(L('operation_success'),HTTP_REFERER);
}else {
$page = isset($_GET['page']) &&trim($_GET['page']) ?intval($_GET['page']) : 1;
$favoritelist = $this->favorite_db->listinfo(array('userid'=>$memberinfo['userid']),'id DESC',$page,10);
$pages = $this->favorite_db->pages;
include template('member','favorite_list');
}
}
public function friend() {
$memberinfo = $this->memberinfo;
$this->friend_db = h5_base::load_model('friend_model');
if(isset($_GET['friendid'])) {
$this->friend_db->delete(array('userid'=>$memberinfo['userid'],'friendid'=>intval($_GET['friendid'])));
showmessage(L('operation_success'),HTTP_REFERER);
}else {
$phpsso_api_url = $this->_init_phpsso();
$page = isset($_GET['page']) ?intval($_GET['page']) : 1;
$friendids = $this->friend_db->listinfo(array('userid'=>$memberinfo['userid']),'',$page,10);
$pages = $this->friend_db->pages;
foreach($friendids as $k=>$v) {
$friendlist[$k]['friendid'] = $v['friendid'];
$friendlist[$k]['avatar'] = $this->client->ps_getavatar($v['phpssouid']);
$friendlist[$k]['is'] = $v['is'];
}
include template('member','friend_list');
}
}
public function change_credit() {
$memberinfo = $this->memberinfo;
$member_setting = getcache('member_setting');
$this->_init_phpsso();
$setting = $this->client->ps_getcreditlist();
$outcredit = unserialize($setting);
$setting = $this->client->ps_getapplist();
$applist = unserialize($setting);
if(isset($_POST['dosubmit'])) {
$fromvalue = intval($_POST['fromvalue']);
$from = $_POST['from'];
$toappid_to = explode('_',$_POST['to']);
$toappid = $toappid_to[0];
$to = $toappid_to[1];
if($from == 1) {
if($memberinfo['point'] <$fromvalue) {
showmessage(L('need_more_point'),HTTP_REFERER);
}
}elseif($from == 2) {
if($memberinfo['amount'] <$fromvalue) {
showmessage(L('need_more_amount'),HTTP_REFERER);
}
}else {
showmessage(L('credit_setting_error'),HTTP_REFERER);
}
$status = $this->client->ps_changecredit($memberinfo['phpssouid'],$from,$toappid,$to,$fromvalue);
if($status == 1) {
if($from == 1) {
$this->db->update(array('point'=>"-=$fromvalue"),array('userid'=>$memberinfo['userid']));
}elseif($from == 2) {
$this->db->update(array('amount'=>"-=$fromvalue"),array('userid'=>$memberinfo['userid']));
}
showmessage(L('operation_success'),HTTP_REFERER);
}else {
showmessage(L('operation_failure'),HTTP_REFERER);
}
}elseif(isset($_POST['buy'])) {
if(!is_numeric($_POST['money']) ||$_POST['money'] <0) {
showmessage(L('money_error'),HTTP_REFERER);
}else {
$money = intval($_POST['money']);
}
if($memberinfo['amount'] <$money) {
showmessage(L('short_of_money'),HTTP_REFERER);
}
$point = $money*$member_setting['rmb_point_rate'];
$this->db->update(array('point'=>"+=$point"),array('userid'=>$memberinfo['userid']));
h5_base::load_app_class('spend','pay',0);
spend::amount($money,L('buy_point'),$memberinfo['userid'],$memberinfo['username']);
showmessage(L('operation_success'),HTTP_REFERER);
}else {
$credit_list = h5_base::load_config('credit');
include template('member','change_credit');
}
}
public function mini() {
$_username = param::get_cookie('_username');
$_userid = param::get_cookie('_userid');
$siteid = isset($_GET['siteid']) ?intval($_GET['siteid']) : '';
if (!defined('SITEID')) {
define('SITEID',$siteid);
}
$snda_enable = h5_base::load_config('system','snda_enable');
include template('member','mini');
}
private function _init_phpsso() {
h5_base::load_app_class('client','',0);
define('APPID',h5_base::load_config('system','phpsso_appid'));
$phpsso_api_url = h5_base::load_config('system','phpsso_api_url');
$phpsso_auth_key = h5_base::load_config('system','phpsso_auth_key');
$this->client = new client($phpsso_api_url,$phpsso_auth_key);
return $phpsso_api_url;
}
protected function _checkname($username) {
$username =  trim($username);
if ($this->db->get_one(array('username'=>$username))){
return false;
}
return true;
}
private function _session_start() {
$session_storage = 'session_'.h5_base::load_config('system','session_storage');
h5_base::load_sys_class($session_storage);
}
protected function _get_linkage_fullname($linkageid,$linkagelist) {
$fullname = '';
if($linkagelist['data'][$linkageid]['parentid'] != 0) {
$fullname = $this->_get_linkage_fullname($linkagelist['data'][$linkageid]['parentid'],$linkagelist);
}
$return = $fullname.$linkagelist['data'][$linkageid]['name'].'>';
return $return;
}
protected function _get_usergroup_bypoint($point=0) {
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
public function public_checkname_ajax() {
$username = isset($_GET['username']) &&trim($_GET['username']) ?trim($_GET['username']) : exit(0);
if(CHARSET != 'utf-8') {
$username = iconv('utf-8',CHARSET,$username);
$username = addslashes($username);
}
$this->verify_db = h5_base::load_model('member_verify_model');
if($this->verify_db->get_one(array('username'=>$username))) {
exit('0');
}
$this->_init_phpsso();
$status = $this->client->ps_checkname($username);
if($status == -4 ||$status == -1) {
exit('0');
}else {
exit('1');
}
}
public function public_checknickname_ajax() {
$nickname = isset($_GET['nickname']) &&trim($_GET['nickname']) ?trim($_GET['nickname']) : exit('0');
if(CHARSET != 'utf-8') {
$nickname = iconv('utf-8',CHARSET,$nickname);
$nickname = addslashes($nickname);
}
$this->verify_db = h5_base::load_model('member_verify_model');
if($this->verify_db->get_one(array('nickname'=>$nickname))) {
exit('0');
}
if(isset($_GET['userid'])) {
$userid = intval($_GET['userid']);
$info = get_memberinfo($userid);
if($info['nickname'] == $nickname){
exit('1');
}else{
$where = array('nickname'=>$nickname);
$res = $this->db->get_one($where);
if($res) {
exit('0');
}else {
exit('1');
}
}
}else {
$where = array('nickname'=>$nickname);
$res = $this->db->get_one($where);
if($res) {
exit('0');
}else {
exit('1');
}
}
}
public function public_checkemail_ajax() {
$this->_init_phpsso();
$email = isset($_GET['email']) &&trim($_GET['email']) ?trim($_GET['email']) : exit(0);
$status = $this->client->ps_checkemail($email);
if($status == -5) {
exit('0');
}elseif($status == -1) {
if(isset($_GET['phpssouid'])) {
$status = $this->client->ps_get_member_info($email,3);
if($status) {
$status = unserialize($status);
if (isset($status['uid']) &&$status['uid'] == intval($_GET['phpssouid'])) {
exit('1');
}else {
exit('0');
}
}else {
exit('0');
}
}else {
exit('0');
}
}else {
exit('1');
}
}
public function public_sina_login() {
define('WB_AKEY',h5_base::load_config('system','sina_akey'));
define('WB_SKEY',h5_base::load_config('system','sina_skey'));
h5_base::load_app_class('weibooauth','',0);
$this->_session_start();
if(isset($_GET['callback']) &&trim($_GET['callback'])) {
$o = new WeiboOAuth(WB_AKEY,WB_SKEY,$_SESSION['keys']['oauth_token'],$_SESSION['keys']['oauth_token_secret']);
$_SESSION['last_key'] = $o->getAccessToken($_REQUEST['oauth_verifier']);
$c = new WeiboClient(WB_AKEY,WB_SKEY,$_SESSION['last_key']['oauth_token'],$_SESSION['last_key']['oauth_token_secret']);
$me = $c->verify_credentials();
if(CHARSET != 'utf-8') {
$me['name'] = iconv('utf-8',CHARSET,$me['name']);
$me['location'] = iconv('utf-8',CHARSET,$me['location']);
$me['description'] = iconv('utf-8',CHARSET,$me['description']);
$me['screen_name'] = iconv('utf-8',CHARSET,$me['screen_name']);
}
if(!empty($me['id'])) {
$where = array('connectid'=>$me['id'],'from'=>'sina');
$r = $this->db->get_one($where);
if(!empty($r)) {
$password = $r['password'];
$this->_init_phpsso();
$synloginstr = $this->client->ps_member_synlogin($r['phpssouid']);
$userid = $r['userid'];
$groupid = $r['groupid'];
$username = $r['username'];
$nickname = empty($r['nickname']) ?$username : $r['nickname'];
$this->db->update(array('lastip'=>ip(),'lastdate'=>SYS_TIME,'nickname'=>$me['name']),array('userid'=>$userid));
if(!$cookietime) $get_cookietime = param::get_cookie('cookietime');
$_cookietime = $cookietime ?intval($cookietime) : ($get_cookietime ?$get_cookietime : 0);
$cookietime = $_cookietime ?TIME +$_cookietime : 0;
$house5_auth_key = md5(h5_base::load_config('system','auth_key').$this->http_user_agent);
$house5_auth = sys_auth($userid."\t".$password,'ENCODE',$house5_auth_key);
param::set_cookie('auth',$house5_auth,$cookietime);
param::set_cookie('_userid',$userid,$cookietime);
param::set_cookie('_username',$username,$cookietime);
param::set_cookie('_groupid',$groupid,$cookietime);
param::set_cookie('cookietime',$_cookietime,$cookietime);
param::set_cookie('_nickname',$nickname,$cookietime);
$forward = isset($_GET['forward']) &&!empty($_GET['forward']) ?$_GET['forward'] : 'index.php?s=member/index';
showmessage(L('login_success').$synloginstr,$forward);
}else {
$_SESSION = array();
$_SESSION['connectid'] = $me['id'];
$_SESSION['from'] = 'sina';
$connect_username = $me['name'];
$member_setting = getcache('member_setting');
if(!$member_setting['allowregister']) {
showmessage(L('deny_register'),'index.php?s=member/index/login');
}
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$modellist = getcache('member_model','commons');
foreach($modellist as $k=>$v) {
if($v['siteid']!=$siteid ||$v['disabled']) {
unset($modellist[$k]);
}
}
if(empty($modellist)) {
showmessage(L('site_have_no_model').L('deny_register'),HTTP_REFERER);
}
$modelid = 10;
if(array_key_exists($modelid,$modellist)) {
require CACHE_MODEL_PATH.'member_form.class.php';
$member_form = new member_form($modelid);
$this->db->set_model($modelid);
$forminfos = $forminfos_arr = $member_form->get();
foreach($forminfos as $field=>$info) {
if($info['isomnipotent']) {
unset($forminfos[$field]);
}else {
if($info['formtype']=='omnipotent') {
foreach($forminfos_arr as $_fm=>$_fm_value) {
if($_fm_value['isomnipotent']) {
$info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
}
}
$forminfos[$field]['form'] = $info['form'];
}
}
}
$formValidator = $member_form->formValidator;
}
include template('member','connect');
}
}else {
showmessage(L('login_failure'),'index.php?s=member/index/login');
}
}else {
$o = new WeiboOAuth(WB_AKEY,WB_SKEY);
$keys = $o->getRequestToken();
$aurl = $o->getAuthorizeURL($keys['oauth_token'] ,false ,APP_PATH.'index.php?s=member/index/public_sina_login/callback/1');
$_SESSION['keys'] = $keys;
include template('member','connect_sina');
}
}
public function public_snda_login() {
define('SNDA_AKEY',h5_base::load_config('system','snda_akey'));
define('SNDA_SKEY',h5_base::load_config('system','snda_skey'));
define('SNDA_CALLBACK',urlencode(APP_PATH.'index.php?s=member/index/public_snda_login/callback/1'));
h5_base::load_app_class('OauthSDK','',0);
$this->_session_start();
if(isset($_GET['callback']) &&trim($_GET['callback'])) {
$o = new OauthSDK(SNDA_AKEY,SNDA_SKEY,SNDA_CALLBACK);
$code = $_REQUEST['code'];
$accesstoken = $o->getAccessToken($code);
if(is_numeric($accesstoken['sdid'])) {
$userid = $accesstoken['sdid'];
}else {
showmessage(L('login_failure'),'index.php?s=member/index/login');
}
if(!empty($userid)) {
$where = array('connectid'=>$userid,'from'=>'snda');
$r = $this->db->get_one($where);
if(!empty($r)) {
$password = $r['password'];
$this->_init_phpsso();
$synloginstr = $this->client->ps_member_synlogin($r['phpssouid']);
$userid = $r['userid'];
$groupid = $r['groupid'];
$username = $r['username'];
$nickname = empty($r['nickname']) ?$username : $r['nickname'];
$this->db->update(array('lastip'=>ip(),'lastdate'=>SYS_TIME,'nickname'=>$me['name']),array('userid'=>$userid));
if(!$cookietime) $get_cookietime = param::get_cookie('cookietime');
$_cookietime = $cookietime ?intval($cookietime) : ($get_cookietime ?$get_cookietime : 0);
$cookietime = $_cookietime ?TIME +$_cookietime : 0;
$house5_auth_key = md5(h5_base::load_config('system','auth_key').$this->http_user_agent);
$house5_auth = sys_auth($userid."\t".$password,'ENCODE',$house5_auth_key);
param::set_cookie('auth',$house5_auth,$cookietime);
param::set_cookie('_userid',$userid,$cookietime);
param::set_cookie('_username',$username,$cookietime);
param::set_cookie('_groupid',$groupid,$cookietime);
param::set_cookie('cookietime',$_cookietime,$cookietime);
param::set_cookie('_nickname',$nickname,$cookietime);
param::set_cookie('_from','snda');
$forward = isset($_GET['forward']) &&!empty($_GET['forward']) ?$_GET['forward'] : 'index.php?s=member/index';
showmessage(L('login_success').$synloginstr,$forward);
}else {
$_SESSION = array();
$_SESSION['connectid'] = $userid;
$_SESSION['from'] = 'snda';
$connect_username = $userid;
include template('member','connect');
}
}
}else {
$o = new OauthSDK(SNDA_AKEY,SNDA_SKEY,SNDA_CALLBACK);
$accesstoken = $o->getSystemToken();
$aurl = $o->getAuthorizeURL();
include template('member','connect_snda');
}
}
public function public_qq_loginnew(){
$appid = h5_base::load_config('system','qq_appid');
$appkey = h5_base::load_config('system','qq_appkey');
$callback = h5_base::load_config('system','qq_callback');
h5_base::load_app_class('qqapi','',0);
$info = new qqapi($appid,$appkey,$callback);
$this->_session_start();
if(!isset($_GET['oauth_token'])){
$info->redirect_to_login();
}else{
$info->get_openid();
if(!empty($_SESSION['openid'])){
$r = $this->db->get_one(array('connectid'=>$_SESSION['openid'],'from'=>'qq'));
if(!empty($r)){
$password = $r['password'];
$this->_init_phpsso();
$synloginstr = $this->client->ps_member_synlogin($r['phpssouid']);
$userid = $r['userid'];
$groupid = $r['groupid'];
$username = $r['username'];
$nickname = empty($r['nickname']) ?$username : $r['nickname'];
$this->db->update(array('lastip'=>ip(),'lastdate'=>SYS_TIME,'nickname'=>$me['name']),array('userid'=>$userid));
if(!$cookietime) $get_cookietime = param::get_cookie('cookietime');
$_cookietime = $cookietime ?intval($cookietime) : ($get_cookietime ?$get_cookietime : 0);
$cookietime = $_cookietime ?TIME +$_cookietime : 0;
$house5_auth_key = md5(h5_base::load_config('system','auth_key').$this->http_user_agent);
$house5_auth = sys_auth($userid."\t".$password,'ENCODE',$house5_auth_key);
param::set_cookie('auth',$house5_auth,$cookietime);
param::set_cookie('_userid',$userid,$cookietime);
param::set_cookie('_username',$username,$cookietime);
param::set_cookie('_groupid',$groupid,$cookietime);
param::set_cookie('cookietime',$_cookietime,$cookietime);
param::set_cookie('_nickname',$nickname,$cookietime);
$forward = isset($_GET['forward']) &&!empty($_GET['forward']) ?$_GET['forward'] : 'index.php?s=member/index';
showmessage(L('login_success').$synloginstr,$forward);
}else{
$user = $info->get_user_info();
$_SESSION['connectid'] = $_SESSION['openid'];
$_SESSION['from'] = 'qq';
if(CHARSET != 'utf-8') {
$connect_username = iconv('utf-8',CHARSET,$user['nickname']);
}
include template('member','connect');
}
}
}
}
public function public_qq_login() {
define('QQ_AKEY',h5_base::load_config('system','qq_akey'));
define('QQ_SKEY',h5_base::load_config('system','qq_skey'));
h5_base::load_app_class('qqoauth','',0);
$this->_session_start();
if(isset($_GET['callback']) &&trim($_GET['callback'])) {
$o = new WeiboOAuth(QQ_AKEY,QQ_SKEY,$_SESSION['keys']['oauth_token'],$_SESSION['keys']['oauth_token_secret']);
$_SESSION['last_key'] = $o->getAccessToken($_REQUEST['oauth_verifier']);
if(!empty($_SESSION['last_key']['name'])) {
$where = array('connectid'=>$_REQUEST['openid'],'from'=>'qq');
$r = $this->db->get_one($where);
if(!empty($r)) {
$password = $r['password'];
$this->_init_phpsso();
$synloginstr = $this->client->ps_member_synlogin($r['phpssouid']);
$userid = $r['userid'];
$groupid = $r['groupid'];
$username = $r['username'];
$nickname = empty($r['nickname']) ?$username : $r['nickname'];
$this->db->update(array('lastip'=>ip(),'lastdate'=>SYS_TIME,'nickname'=>$me['name']),array('userid'=>$userid));
if(!$cookietime) $get_cookietime = param::get_cookie('cookietime');
$_cookietime = $cookietime ?intval($cookietime) : ($get_cookietime ?$get_cookietime : 0);
$cookietime = $_cookietime ?TIME +$_cookietime : 0;
$house5_auth_key = md5(h5_base::load_config('system','auth_key').$this->http_user_agent);
$house5_auth = sys_auth($userid."\t".$password,'ENCODE',$house5_auth_key);
param::set_cookie('auth',$house5_auth,$cookietime);
param::set_cookie('_userid',$userid,$cookietime);
param::set_cookie('_username',$username,$cookietime);
param::set_cookie('_groupid',$groupid,$cookietime);
param::set_cookie('cookietime',$_cookietime,$cookietime);
param::set_cookie('_nickname',$nickname,$cookietime);
param::set_cookie('_from','snda');
$forward = isset($_GET['forward']) &&!empty($_GET['forward']) ?$_GET['forward'] : 'index.php?s=member/index';
showmessage(L('login_success').$synloginstr,$forward);
}else {
$_SESSION = array();
$_SESSION['connectid'] = $_REQUEST['openid'];
$_SESSION['from'] = 'qq';
$connect_username = $_SESSION['last_key']['name'];
$member_setting = getcache('member_setting');
if(!$member_setting['allowregister']) {
showmessage(L('deny_register'),'index.php?s=member/index/login');
}
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$modellist = getcache('member_model','commons');
foreach($modellist as $k=>$v) {
if($v['siteid']!=$siteid ||$v['disabled']) {
unset($modellist[$k]);
}
}
if(empty($modellist)) {
showmessage(L('site_have_no_model').L('deny_register'),HTTP_REFERER);
}
$modelid = 10;
if(array_key_exists($modelid,$modellist)) {
require CACHE_MODEL_PATH.'member_form.class.php';
$member_form = new member_form($modelid);
$this->db->set_model($modelid);
$forminfos = $forminfos_arr = $member_form->get();
foreach($forminfos as $field=>$info) {
if($info['isomnipotent']) {
unset($forminfos[$field]);
}else {
if($info['formtype']=='omnipotent') {
foreach($forminfos_arr as $_fm=>$_fm_value) {
if($_fm_value['isomnipotent']) {
$info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
}
}
$forminfos[$field]['form'] = $info['form'];
}
}
}
$formValidator = $member_form->formValidator;
}
include template('member','connect');
}
}else {
showmessage(L('login_failure'),'index.php?s=member/index/login');
}
}else {
$oauth_callback = APP_PATH.'index.php?s=member/index/public_qq_login/callback/1';
$oauth_nonce = md5(SYS_TIME);
$oauth_signature_method = 'HMAC-SHA1';
$oauth_timestamp = SYS_TIME;
$oauth_version = '1.0';
$url = "https://open.t.qq.com/cgi-bin/request_token?oauth_callback=$oauth_callback&oauth_consumer_key=".QQ_AKEY."&oauth_nonce=$oauth_nonce&oauth_signature=".QQ_SKEY."&oauth_signature_method=HMAC-SHA1&oauth_timestamp=$oauth_timestamp&oauth_version=$oauth_version";
$o = new WeiboOAuth(QQ_AKEY,QQ_SKEY);
$keys = $o->getRequestToken(array('callback'=>$oauth_callback));
$_SESSION['keys'] = $keys;
$aurl = $o->getAuthorizeURL($keys['oauth_token'] ,false ,$oauth_callback);
include template('member','connect_qq');
}
}
public function public_qq_login2(){
$appid = h5_base::load_config('system','qq_appid');
$appkey = h5_base::load_config('system','qq_appkey');
$callback = h5_base::load_config('system','qq_callback');
h5_base::load_app_class('qqapi','',0);
$info = new qqapi($appid,$appkey,$callback);
$this->_session_start();
if(!isset($_GET['oauth_token'])){
$info->redirect_to_login();
}else{
$info->get_openid();
if(!empty($_SESSION['openid'])){
$r = $this->db->get_one(array('connectid'=>$_SESSION['openid'],'from'=>'qq'));
if(!empty($r)){
$password = $r['password'];
$this->_init_phpsso();
$synloginstr = $this->client->ps_member_synlogin($r['phpssouid']);
$userid = $r['userid'];
$groupid = $r['groupid'];
$username = $r['username'];
$nickname = empty($r['nickname']) ?$username : $r['nickname'];
$this->db->update(array('lastip'=>ip(),'lastdate'=>SYS_TIME,'nickname'=>$me['name']),array('userid'=>$userid));
if(!$cookietime) $get_cookietime = param::get_cookie('cookietime');
$_cookietime = $cookietime ?intval($cookietime) : ($get_cookietime ?$get_cookietime: 0);
$cookietime = $_cookietime ?TIME +$_cookietime : 0;
$house5_auth_key = md5(h5_base::load_config('system','auth_key').$this->http_user_agent);
$house5_auth = sys_auth($userid."\t".$password,'ENCODE',$house5_auth_key);
param::set_cookie('auth',$house5_auth,$cookietime);
param::set_cookie('_userid',$userid,$cookietime);
param::set_cookie('_username',$username,$cookietime);
param::set_cookie('_groupid',$groupid,$cookietime);
param::set_cookie('cookietime',$_cookietime,$cookietime);
param::set_cookie('_nickname',$nickname,$cookietime);
$forward = isset($_GET['forward']) &&!empty($_GET['forward']) ?$_GET['forward'] : 'index.php?s=member/index';
showmessage(L('login_success').$synloginstr,$forward);
}else{
$user = $info->get_user_info();
$_SESSION['connectid'] = $_SESSION['openid'];
$_SESSION['from'] = 'qq';
$connect_username = $user['nickname'];
include template('member','connect');
}
}
}
}
public function public_forget_password () {
$email_config = getcache('common','commons');
if($email_config['mail_type'] == '1'){
if(empty($email_config['mail_user']) ||empty($email_config['mail_password'])) {
showmessage(L('email_config_empty'),HTTP_REFERER);
}
}
$this->_session_start();
$member_setting = getcache('member_setting');
if(isset($_POST['dosubmit'])) {
if ($_SESSION['code'] != strtolower($_POST['code'])) {
showmessage(L('code_error'),HTTP_REFERER);
}
$memberinfo = $this->db->get_one(array('email'=>$_POST['email']));
if(!empty($memberinfo['email'])) {
$email = $memberinfo['email'];
}else {
showmessage(L('email_error'),HTTP_REFERER);
}
h5_base::load_sys_func('mail');
$house5_auth_key = md5(h5_base::load_config('system','auth_key').$this->http_user_agent);
$code = sys_auth($memberinfo['userid']."\t".SYS_TIME,'ENCODE',$house5_auth_key);
$url = APP_PATH."index.php?s=member/index/public_forget_password/code/$code";
$message = $member_setting['forgetpassword'];
$message = str_replace(array('{click}','{url}'),array('<a href="'.$url.'">'.L('please_click').'</a>',$url),$message);
$sitelist = getcache('sitelist','commons');
if(isset($sitelist[$memberinfo['siteid']]['name'])) {
$sitename = $sitelist[$memberinfo['siteid']]['name'];
}else {
$sitename = 'house5_V9_MAIL';
}
sendmail($email,L('forgetpassword'),$message,'','',$sitename);
showmessage(L('operation_success'),'index.php?s=member/index/login');
}elseif($_GET['code']) {
$house5_auth_key = md5(h5_base::load_config('system','auth_key').$this->http_user_agent);
$hour = date('y-m-d h',SYS_TIME);
$code = sys_auth($_GET['code'],'DECODE',$house5_auth_key);
$code = explode("\t",$code);
if(is_array($code) &&is_numeric($code[0]) &&date('y-m-d h',SYS_TIME) == date('y-m-d h',$code[1])) {
$memberinfo = $this->db->get_one(array('userid'=>$code[0]));
if(empty($memberinfo['phpssouid'])) {
showmessage(L('operation_failure'),'index.php?s=member/index/login');
}
$password = random(8);
$updateinfo['password'] = password($password,$memberinfo['encrypt']);
$this->db->update($updateinfo,array('userid'=>$code[0]));
if(h5_base::load_config('system','phpsso')) {
$this->_init_phpsso();
$this->client->ps_member_edit('',$email,'',$password,$memberinfo['phpssouid'],$memberinfo['encrypt']);
}
showmessage(L('operation_success').L('newpassword').':'.$password);
}else {
showmessage(L('operation_failure'),'index.php?s=member/index/login');
}
}else {
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$siteinfo = siteinfo($siteid);
include template('member','forget_password');
}
}
}
?>