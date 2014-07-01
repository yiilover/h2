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
$grouplist = getcache('grouplist');
$broker_type_cache = getcache('broker_typelist');
$memberinfo['groupname'] = $grouplist[$memberinfo[groupid]]['name'];
$memberinfo['groupicon'] = $grouplist[$memberinfo[groupid]]['icon'];
if($memberinfo['modelid']=='42')
{
$memberinfo['allowpost'] = $broker_type_cache[$memberinfo['typeid']]['total_nums'];
}
else
{
$memberinfo['allowpost'] = $grouplist[$memberinfo['groupid']]['total_nums'];
}
$this->_db = h5_base::load_model('content_model');
$this->_db->table_name = $this->_db->db_tablepre.'member_broker_identity';
$identityinfo = $this->_db->get_one(array('broker_id'=>$this->memberinfo['userid'],'idtype'=>'identity'));
if(!empty($identityinfo) &&$identityinfo['status']) {
$idcard_status=1;
}
$certificateinfo = $this->_db->get_one(array('broker_id'=>$this->memberinfo['userid'],'idtype'=>'certificate'));
if(!empty($certificateinfo) &&$certificateinfo['status']) {
$certificate_status=1;
}
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('member','index');
}
public function register() {
$this->_session_start();
$member_setting = getcache('member_setting');
if(!$member_setting['allowregister']) {
showmessage(L('deny_register'),'index.php?s=member/index/login');
}
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$sitelist  = getcache('sitelist','commons');
$default_style = $sitelist[$siteid]['default_style'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
$copyright = $sitelist[$siteid]['copyright'];
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
$_POST['username'] = safe_replace(trim($_POST['username']));
$_POST['nickname'] = safe_replace(trim($_POST['nickname']));
$userinfo['username'] = (isset($_POST['username']) &&is_username($_POST['username'])) ?$_POST['username'] : exit('0');
$userinfo['nickname'] = (isset($_POST['nickname']) &&is_username($_POST['nickname'])) ?$_POST['nickname'] : '';
$userinfo['email'] = (isset($_POST['email']) &&is_email($_POST['email'])) ?$_POST['email'] : exit('0');
$userinfo['password'] = isset($_POST['password']) ?$_POST['password'] : exit('0');
$userinfo['email'] = (isset($_POST['email']) &&is_email($_POST['email'])) ?$_POST['email'] : exit('0');
$userinfo['modelid'] = isset($_POST['modelid']) ?intval($_POST['modelid']) : 10;
if($userinfo['modelid']=='42')
{
$userinfo['typeid'] = 1;
}
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
}elseif($member_setting['broker_check'] &&$userinfo['modelid']=='42') {
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
$userinfo['groupid'] = $this->_get_usergroup_bypoint($userinfo['point'],$userinfo['modelid']);
}
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
$cookietime = $_cookietime ?SYS_TIME +$_cookietime : 0;
if($userinfo['groupid'] == 7) {
param::set_cookie('_username',$userinfo['username'],$cookietime);
param::set_cookie('email',$userinfo['email'],$cookietime);
}else {
if(h5_base::load_config('uc','ucuse')) {
$this->_init_ucenter();
if(defined('UC_API') &&require_once './api/uc_client/client.php')
{
$uid = uc_user_register($userinfo['username'],$password,$userinfo['email']);
if($uid >0) $ucsynlogin = uc_user_synlogin($uid);
}
}
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
$code = sys_auth($userid.'|'.$password.'|'.$house5_auth_key,'ENCODE',$house5_auth_key);
$url = APP_PATH."index.php?s=member/index/register/code/$code/verify/1";
$message = $member_setting['registerverifymessage'];
$message = str_replace(array('{click}','{url}','{username}','{email}','{password}'),array('<a href="'.$url.'">'.L('please_click').'</a>',$url,$userinfo['username'],$userinfo['email'],$password),$message);
sendmail($userinfo['email'],L('reg_verify_email'),$message);
param::set_cookie('_regusername',$userinfo['username'],$cookietime);
param::set_cookie('_reguserid',$userid,$cookietime);
showmessage(L('operation_success'),'index.php?s=member/index/register/t/2');
}else {
showmessage(L('operation_success').$ucsynlogin,'index.php?s=member/index/init');
}
showmessage(L('operation_failure'),HTTP_REFERER);
}else {
if(!empty($_GET['verify'])) {
$code = isset($_GET['code']) ?trim($_GET['code']) : showmessage(L('operation_failure'),'index.php?s=member/index');
$house5_auth_key = md5(h5_base::load_config('system','auth_key'));
$code_res = sys_auth($code,'DECODE',$house5_auth_key);
$code_arr = explode('|',$code_res);
$userid = isset($code_arr[0]) ?$code_arr[0] : '';
$password = isset($code_arr[1]) ?$code_arr[1] : '';
$userid = is_numeric($userid) ?$userid : showmessage(L('operation_failure'),'index.php?s=member/index');
$r = $this->db->get_one(array('userid'=>$userid));
$this->db->update(array('groupid'=>$this->_get_usergroup_bypoint()),array('userid'=>$userid));
$house5_auth_key = md5(h5_base::load_config('system','auth_key').$this->http_user_agent);
$house5_auth = sys_auth($userid."\t".$r['password'],'ENCODE',$house5_auth_key);
$cookietime = SYS_TIME +31536000;
param::set_cookie('auth',$house5_auth,$cookietime);
param::set_cookie('_userid',$userid,$cookietime);
param::set_cookie('_username',$r['username'],$cookietime);
param::set_cookie('_nickname',$r['nickname'],$cookietime);
param::set_cookie('_groupid',$r['groupid'],$cookietime);
if(h5_base::load_config('uc','ucuse')) {
$this->_init_ucenter();
if(defined('UC_API') &&require_once './api/uc_client/client.php')
{
if($r)
{
$uid = uc_user_register($r['username'],$password,$r['email']);
if($uid >0) $ucsynlogin = uc_user_synlogin($uid);
}
}
}
showmessage(L('operation_success').$ucsynlogin,'index.php?s=member/index/login');
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
foreach($forminfos_arr as $_fs=>$_fm_value) {
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
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
$phpsso_api_url = $this->_init_phpsso();
$avatar = $this->client->ps_getavatar($this->memberinfo['userid']);
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
public function esf()
{
$modelid = '39';
$catid = '112';
$fields = getcache('model_field_'.$modelid,'model');
foreach($fields as $field=>$v) {
if($field == 'house_pic')
{
$upload_allowext = $v['upload_allowext'];
$upload_number = $v['upload_number'];
$isselectimage = $v['isselectimage'];
}
}
$memberinfo = $this->memberinfo;
if($memberinfo['modelid']=='43')
{
showmessage('中介公司禁止发布房源，请以经纪人身份发布',HTTP_REFERER);
}
$username = $memberinfo['nickname'] ?$memberinfo['nickname'] : param::get_cookie('_username');
$usertel = $memberinfo['tel'];
$authkey = upload_key("$upload_number,$upload_allowext,$isselectimage");
$template = 'post_sell';
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('member',$template);
}
public function delete()
{
$catid = intval($_GET['catid']);
$id = intval($_GET['id']);
if(!$catid) showmessage(L('missing_part_parameters'));
if(empty($id)) showmessage(L('you_do_not_check'));
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$this->db = h5_base::load_model('content_model');
$this->categorys = getcache('category_content_'.$siteid,'commons');
$category = $this->categorys[$catid];
$this->model = getcache('model','commons');
$modelid = $category['modelid'];
$this->db->set_model($modelid);
$attachment = h5_base::load_model('attachment_model');
$this->hits_db = h5_base::load_model('hits_model');
$this->db->delete_content($id,$fileurl,$catid);
$this->hits_db->delete(array('hitsid'=>'c-'.$modelid.'-'.$id));
$attachment->api_delete('c-'.$catid.'-'.$id);
showmessage(L('operation_success'),HTTP_REFERER);
}
public function editsell()
{
$modelid = '39';
$catid = '112';
$fields = getcache('model_field_'.$modelid,'model');
foreach($fields as $field=>$v) {
if($field == 'house_pic')
{
$upload_allowext = $v['upload_allowext'];
$upload_number = $v['upload_number'];
$isselectimage = $v['isselectimage'];
}
}
$authkey = upload_key("$upload_number,$upload_allowext,$isselectimage");
$template = 'edit_sell';
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
$this->db = h5_base::load_model('content_model');
$this->categorys = getcache('category_content_'.$siteid,'commons');
$category = $this->categorys[$catid];
$this->model = getcache('model','commons');
$modelid = $category['modelid'];
$this->db->set_model($modelid);
$memberinfo = $this->memberinfo;
if($_POST['dosubmit'])
{
$id = intval($_POST['id']);
if(($_POST['action']=='edit')&&$id>0)
{
$name = safe_replace(htmlspecialchars($_POST['title']));
$content = trim($_POST['content']);
$price = trim($_POST['price']);
if($price<=30)
{
$range=1;
}
elseif($price>30 &&$price<=40)
{
$range=2;
}
elseif($price>40 &&$price<=50)
{
$range=3;
}
elseif($price>50 &&$price<=60)
{
$range=4;
}
elseif($price>60 &&$price<=80)
{
$range=5;
}
elseif($price>80 &&$price<=100)
{
$range=6;
}
elseif($price>100 &&$price<=150)
{
$range=7;
}
elseif($price>150 &&$price<=200)
{
$range=8;
}
else
{
$range=0;
}
$area = trim($_POST['area']);
if($area<=70)
{
$area_range=1;
}
elseif($area>70 &&$area<=90)
{
$area_range=3;
}
elseif($area>90 &&$area<=120)
{
$area_range=4;
}
elseif($area>120 &&$area<=150)
{
$area_range=5;
}
elseif($area>150 &&$area<=200)
{
$area_range=6;
}
elseif($area>200 &&$area<=300)
{
$area_range=7;
}
elseif($area>300)
{
$area_range=8;
}
$_POST['info']['range'] = $range;
$_POST['info']['mprice'] = ceil($_POST['price']*10000/$_POST['area']);
$_POST['info']['area_range'] = $area_range;
$_POST['info']['title'] = $name;
$_POST['info']['catid'] = $catid;
$_POST['info']['content'] = $content;
$_POST['info']['type'] = $_POST['property'];
$_POST['info']['total_area'] = trim($_POST['area']);
$_POST['info']['house_toward'] = $_POST['aspect'];
$_POST['info']['fix'] = $_POST['decorate'];
$_POST['info']['huxingwei'] = $_POST['toilet'];
$_POST['info']['huxingting'] = $_POST['hall'];
$_POST['info']['huxingshi'] = $_POST['room'];
$_POST['info']['assort'] = $_POST['assort'];
$_POST['info']['floor'] = $_POST['floor'];
$_POST['info']['zonglouceng'] = $_POST['totalfloor'];
$_POST['info']['price'] = $_POST['price'];
$_POST['info']['house_status'] = $_POST['status'];
$_POST['info']['house_age'] = $_POST['houseage'];
$_POST['info']['houseno'] = trim($_POST['internalnumber']);
$_POST['info']['remarks'] = safe_replace(htmlspecialchars($_POST['remarks']));
$_POST['info']['house_pic'] = getimages('house_pic');
$_POST['info']['house_room'] = getimages('house_room');
$_POST['info']['house_outdoor'] = getimages('house_outdoor');
if(empty($_POST['titlepic'])&&count(string2array(stripslashes($_POST['info']['house_room'])))>0)
{
$house_pic_arr =  string2array(stripslashes($_POST['info']['house_room']));
$_POST['info']['thumb'] = $house_pic_arr[0]['url'];
}
else
{
$_POST['info']['thumb'] = trim($_POST['titlepic']);
}
$_POST['info']['inputtime'] = $_POST['inputtime'];
$_POST['info']['updatetime'] = $_POST['updatetime'];
$_POST['info']['username'] = $_POST['username'];
$_POST['info']['tel'] = trim($_POST['usertel']);
$pic_num = count(string2array(stripslashes($_POST['info']['house_pic'])))+count(string2array(stripslashes($_POST['info']['house_room'])))+count(string2array(stripslashes($_POST['info']['house_outdoor'])));
if($pic_num>=4)
{
$r = $this->db->get_one(array('id'=>$id),'flag');
if(empty($r['flag']))
{
$_POST['info']['flag'] = '5';
}
elseif(strpos($r['flag'],'5')===false)
{
$_POST['info']['flag']= $r['flag'].',5';
}
}
$url = ESF_PATH.'show-'.$id.'.html';
$return = $this->db->edit_content($_POST['info'],$id);
$this->db->table_name = $this->db->db_tablepre.$this->model[$modelid]['tablename'];
$this->db->update(array('url'=>$url),"id = $id");
if($return)
{
showmessage(L('修改成功~'),'index.php?s=member/index/manage_sell');
}
else
{
showmessage(L('修改失败~'),'blank');
}
}
}
$id = intval($_GET['id']);
$this->db->table_name = $this->db->db_tablepre.$this->model[$modelid]['tablename'];
$r = $this->db->get_one(array('id'=>$id));
$this->db->table_name = $this->db->table_name.'_data';
$r2 = $this->db->get_one(array('id'=>$id));
if(!$r2) showmessage(L('subsidiary_table_datalost'),'blank');
$data = array_merge($r,$r2);
include template('member',$template);
}
public function rent()
{
$modelid = '41';
$catid = '113';
$fields = getcache('model_field_'.$modelid,'model');
foreach($fields as $field=>$v) {
if($field == 'house_pic')
{
$upload_allowext = $v['upload_allowext'];
$upload_number = $v['upload_number'];
$isselectimage = $v['isselectimage'];
}
}
$authkey = upload_key("$upload_number,$upload_allowext,$isselectimage");
$memberinfo = $this->memberinfo;
if($memberinfo['modelid']=='43')
{
showmessage('中介公司禁止发布房源，请以经纪人身份发布',HTTP_REFERER);
}
$username = $memberinfo['nickname'] ?$memberinfo['nickname'] : param::get_cookie('_username');
$usertel = $memberinfo['tel'];
$template = 'post_rent';
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$site_title = $sitelist[$siteid]['name'];
include template('member',$template);
}
public function editrent()
{
$modelid = '41';
$catid = '113';
$fields = getcache('model_field_'.$modelid,'model');
foreach($fields as $field=>$v) {
if($field == 'house_pic')
{
$upload_allowext = $v['upload_allowext'];
$upload_number = $v['upload_number'];
$isselectimage = $v['isselectimage'];
}
}
$authkey = upload_key("$upload_number,$upload_allowext,$isselectimage");
$template = 'edit_rent';
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
$this->db = h5_base::load_model('content_model');
$this->categorys = getcache('category_content_'.$siteid,'commons');
$category = $this->categorys[$catid];
$this->model = getcache('model','commons');
$modelid = $category['modelid'];
$this->db->set_model($modelid);
$memberinfo = $this->memberinfo;
if($_POST['dosubmit'])
{
$id = intval($_POST['id']);
if(($_POST['action']=='edit')&&$id>0)
{
$name = safe_replace(htmlspecialchars($_POST['title']));
$content = trim($_POST['content']);
$price = trim($_POST['price']);
if($price<=500)
{
$range=1;
}
elseif($price>500 &&$price<=600)
{
$range=2;
}
elseif($price>600 &&$price<=700)
{
$range=3;
}
elseif($price>700 &&$price<=800)
{
$range=4;
}
elseif($price>800 &&$price<=1000)
{
$range=5;
}
elseif($price>1000 &&$price<=1200)
{
$range=6;
}
elseif($price>1200 &&$price<=1500)
{
$range=7;
}
elseif($price>1500 &&$price<=2000)
{
$range=8;
}
else
{
$range=9;
}
$area = trim($_POST['area']);
if($area<=70)
{
$area_range=1;
}
elseif($area>70 &&$area<=90)
{
$area_range=3;
}
elseif($area>90 &&$area<=120)
{
$area_range=4;
}
elseif($area>120 &&$area<=150)
{
$area_range=5;
}
elseif($area>150 &&$area<=200)
{
$area_range=6;
}
elseif($area>200 &&$area<=300)
{
$area_range=7;
}
elseif($area>300)
{
$area_range=8;
}
$_POST['info']['range'] = $range;
$_POST['info']['area_range'] = $area_range;
$_POST['info']['rent_type'] = $_POST['renttype'];
if($_POST['info']['rent_type']=='2')
{
$_POST['info']['roomtype'] = $_POST['roomtype'];
$_POST['info']['limitsex'] = $_POST['limitsex'];
}
$_POST['info']['paytype1'] = $_POST['paytype'];
$_POST['info']['paytype2'] = $_POST['paytype2'];
$_POST['info']['title'] = $name;
$_POST['info']['catid'] = $catid;
$_POST['info']['content'] = $content;
$_POST['info']['type'] = $_POST['property'];
$_POST['info']['total_area'] = trim($_POST['area']);
$_POST['info']['encode'] = trim($_POST['encode']);
$_POST['info']['house_toward'] = $_POST['aspect'];
$_POST['info']['fix'] = $_POST['decorate'];
$_POST['info']['huxingwei'] = $_POST['toilet'];
$_POST['info']['huxingting'] = $_POST['hall'];
$_POST['info']['huxingshi'] = $_POST['room'];
$_POST['info']['assort'] = $_POST['assort'];
$_POST['info']['floor'] = $_POST['floor'];
$_POST['info']['zonglouceng'] = $_POST['totalfloor'];
$_POST['info']['price'] = $price;
$_POST['info']['house_status'] = $_POST['status'];
$_POST['info']['house_age'] = $_POST['houseage'];
$_POST['info']['communityname'] = $_POST['communityname'];
$_POST['info']['relation'] = intval($_POST['cid']);
$_POST['info']['houseno'] = trim($_POST['internalnumber']);
$_POST['info']['remarks'] = safe_replace(htmlspecialchars($_POST['remarks']));
$_POST['info']['house_pic'] = getimages('house_pic');
$_POST['info']['house_room'] = getimages('house_room');
$_POST['info']['house_outdoor'] = getimages('house_outdoor');
$_POST['info']['inputtime'] = $_POST['inputtime'];
$_POST['info']['updatetime'] = $_POST['updatetime'];
$_POST['info']['username'] = $_POST['username'];
$_POST['info']['tel'] = trim($_POST['usertel']);
if(empty($_POST['titlepic'])&&count(string2array(stripslashes($_POST['info']['house_room'])))>0)
{
$house_pic_arr =  string2array(stripslashes($_POST['info']['house_room']));
$_POST['info']['thumb'] = $house_pic_arr[0]['url'];
}
else
{
$_POST['info']['thumb'] = trim($_POST['titlepic']);
}
$pic_num = count(string2array(stripslashes($_POST['info']['house_pic'])))+count(string2array(stripslashes($_POST['info']['house_room'])))+count(string2array(stripslashes($_POST['info']['house_outdoor'])));
if($pic_num>=4)
{
$r = $this->db->get_one(array('id'=>$id),'flag');
if(empty($r['flag']))
{
$_POST['info']['flag'] = '5';
}
elseif(strpos($r['flag'],'5')===false)
{
$_POST['info']['flag']= $r['flag'].',5';
}
}
$url = ESF_PATH.'rent-show-'.$id.'.html';
$return = $this->db->edit_content($_POST['info'],$id);
$this->db->table_name = $this->db->db_tablepre.$this->model[$modelid]['tablename'];
$this->db->update(array('url'=>$url),"id = $id");
if($return)
{
showmessage(L('修改成功~'),'index.php?s=member/index/manage_rent');
}
else
{
showmessage(L('修改失败~'),'blank');
}
}
}
$id = intval($_GET['id']);
$this->db->table_name = $this->db->db_tablepre.$this->model[$modelid]['tablename'];
$r = $this->db->get_one(array('id'=>$id));
$this->db->table_name = $this->db->table_name.'_data';
$r2 = $this->db->get_one(array('id'=>$id));
if(!$r2) showmessage(L('subsidiary_table_datalost'),'blank');
$data = array_merge($r,$r2);
include template('member',$template);
}
public function esf_save()
{
if (isset($_POST['dosubmit'])) {
global $INI;
if(substr( $INI['authkey'],162,10) <time()) die('软件已过服务期');
domain_verify();
$catid = '112';
$this->db = h5_base::load_model('content_model');
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
if(!isset($CATEGORYS[$catid]) ||$CATEGORYS[$catid]['type']!=0) showmessage(L('information_does_not_exist'),'blank');
$this->category = $CAT = $CATEGORYS[$catid];
$this->category_setting = $CAT['setting'] = string2array($this->category['setting']);
$siteid = $GLOBALS['siteid'] = $CAT['siteid'];
$MODEL = getcache('model','commons');
$modelid = $CAT['modelid'];
$member_setting = getcache('member_setting');
$db = '';
$db = h5_base::load_model('content_model');
$name = safe_replace(htmlspecialchars($_POST['title']));
$content = trim($_POST['content']);
$db->set_model('40');
$r = $db->get_one(array('id'=>$_POST['cid']),'region');
$region = $r['region'];
$db->set_model($modelid);
$price = trim($_POST['price']);
if($price<=30)
{
$range=1;
}
elseif($price>30 &&$price<=40)
{
$range=2;
}
elseif($price>40 &&$price<=50)
{
$range=3;
}
elseif($price>50 &&$price<=60)
{
$range=4;
}
elseif($price>60 &&$price<=80)
{
$range=5;
}
elseif($price>80 &&$price<=100)
{
$range=6;
}
elseif($price>100 &&$price<=150)
{
$range=7;
}
elseif($price>150 &&$price<=200)
{
$range=8;
}
else
{
$range=0;
}
$area = trim($_POST['area']);
if($area<=70)
{
$area_range=1;
}
elseif($area>70 &&$area<=90)
{
$area_range=3;
}
elseif($area>90 &&$area<=120)
{
$area_range=4;
}
elseif($area>120 &&$area<=150)
{
$area_range=5;
}
elseif($area>150 &&$area<=200)
{
$area_range=6;
}
elseif($area>200 &&$area<=300)
{
$area_range=7;
}
elseif($area>300)
{
$area_range=8;
}
$_POST['info']['range'] = $range;
$_POST['info']['mprice'] = ceil($_POST['price']*10000/$_POST['area']);
$_POST['info']['area_range'] = $area_range;
$_POST['info']['title'] = $name;
$_POST['info']['catid'] = $catid;
$_POST['info']['content'] = $content;
$_POST['info']['region'] = $region;
$_POST['info']['type'] = $_POST['property'];
$_POST['info']['total_area'] = trim($_POST['area']);
$_POST['info']['encode'] = trim($_POST['encode']);
$_POST['info']['house_toward'] = $_POST['aspect'];
$_POST['info']['fix'] = $_POST['decorate'];
$_POST['info']['huxingwei'] = $_POST['toilet'];
$_POST['info']['huxingting'] = $_POST['hall'];
$_POST['info']['huxingshi'] = $_POST['room'];
$_POST['info']['assort'] = $_POST['assort'];
$_POST['info']['floor'] = $_POST['floor'];
$_POST['info']['zonglouceng'] = $_POST['totalfloor'];
$_POST['info']['price'] = $_POST['price'];
$_POST['info']['house_status'] = $_POST['status'];
$username = param::get_cookie('_username');
$userid = param::get_cookie('_userid');
if($_POST['info']['house_status']=='1')
{
$check_allow_nums = 0;
if($this->memberinfo['modelid']=='42')
{
$check_allow_nums = $this->check_allow_post($catid,$userid,42,$this->memberinfo['typeid']);
}
else
{
$check_allow_nums = $this->check_allow_post($catid,$userid,10,$this->memberinfo['groupid']);
}
if(!$check_allow_nums)
{
$_POST['info']['house_status']=2;
}
}
$_POST['info']['house_downtime'] = time();
$_POST['info']['house_age'] = $_POST['houseage'];
$_POST['info']['communityname'] = $_POST['communityname'];
$_POST['info']['relation'] = intval($_POST['cid']);
$_POST['info']['houseno'] = trim($_POST['internalnumber']);
$_POST['info']['remarks'] = safe_replace(htmlspecialchars($_POST['remarks']));
$_POST['info']['house_pic'] = getimages('house_pic');
$_POST['info']['house_room'] = getimages('house_room');
$_POST['info']['house_outdoor'] = getimages('house_outdoor');
if(empty($_POST['titlepic'])&&count(string2array(stripslashes($_POST['info']['house_room'])))>0)
{
$house_pic_arr =  string2array(stripslashes($_POST['info']['house_room']));
$_POST['info']['thumb'] = $house_pic_arr[0]['url'];
}
else
{
$_POST['info']['thumb'] = trim($_POST['titlepic']);
}
$pic_num = count(string2array(stripslashes($_POST['info']['house_pic'])))+count(string2array(stripslashes($_POST['info']['house_room'])))+count(string2array(stripslashes($_POST['info']['house_outdoor'])));
if($pic_num>=4)
{
$_POST['info']['flag'] = '5';
}
if(empty($_POST['usertel']))
{
$_POST['info']['tel'] = $this->memberinfo['tel'];
}
else
{
$_POST['info']['tel'] = trim($_POST['usertel']);
}
if($this->memberinfo['modelid']=='42')
{
$_POST['info']['isbroker'] = 1;
}
if(isset($userid)&&!empty($username))
{
if($member_setting['esf_check']==0 ||$this->memberinfo['modelid']=='42')
{
$_POST['info']['status'] = '99';
}
else
{
$_POST['info']['status'] = '1';
}
}
else
{
$_POST['info']['status'] = '1';
}
$_POST['info']['uid'] = $userid;
if(empty($_POST['username']))
{
$_POST['info']['username'] = $username;
}
else
{
$_POST['info']['username'] = trim($_POST['username']);
}
$id = $db->add_content($_POST['info']);
if($id)
{
$db->set_model($modelid);
$url = ESF_PATH.'show-'.$id.'.html';
$db->update(array('url'=>$url),"id = $id");
}
$this->db->table_name = $this->db->table_name.'_data';
$this->db->insert($moreinfo);
showmessage(L('发布成功~'),ESF_PATH.'list.html');
}
}
public function rent_save()
{
if (isset($_POST['dosubmit'])) {
global $INI;
if(substr( $INI['authkey'],162,10) <time()) die('软件已过服务期');
$catid = '113';
$this->db = h5_base::load_model('content_model');
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
if(!isset($CATEGORYS[$catid]) ||$CATEGORYS[$catid]['type']!=0) showmessage(L('information_does_not_exist'),'blank');
$this->category = $CAT = $CATEGORYS[$catid];
$this->category_setting = $CAT['setting'] = string2array($this->category['setting']);
$siteid = $GLOBALS['siteid'] = $CAT['siteid'];
$MODEL = getcache('model','commons');
$modelid = $CAT['modelid'];
$member_setting = getcache('member_setting');
$db = '';
$db = h5_base::load_model('content_model');
$name = safe_replace(htmlspecialchars($_POST['title']));
$content = trim($_POST['content']);
$db->set_model('40');
$r = $db->get_one(array('id'=>$_POST['cid']),'region');
$region = $r['region'];
$db->set_model($modelid);
$price = trim($_POST['price']);
if($price<=500)
{
$range=1;
}
elseif($price>500 &&$price<=600)
{
$range=2;
}
elseif($price>600 &&$price<=700)
{
$range=3;
}
elseif($price>700 &&$price<=800)
{
$range=4;
}
elseif($price>800 &&$price<=1000)
{
$range=5;
}
elseif($price>1000 &&$price<=1200)
{
$range=6;
}
elseif($price>1200 &&$price<=1500)
{
$range=7;
}
elseif($price>1500 &&$price<=2000)
{
$range=8;
}
else
{
$range=9;
}
$area = trim($_POST['area']);
if($area<=70)
{
$area_range=1;
}
elseif($area>70 &&$area<=90)
{
$area_range=3;
}
elseif($area>90 &&$area<=120)
{
$area_range=4;
}
elseif($area>120 &&$area<=150)
{
$area_range=5;
}
elseif($area>150 &&$area<=200)
{
$area_range=6;
}
elseif($area>200 &&$area<=300)
{
$area_range=7;
}
elseif($area>300)
{
$area_range=8;
}
$_POST['info']['range'] = $range;
$_POST['info']['area_range'] = $area_range;
$_POST['info']['rent_type'] = $_POST['renttype'];
if($_POST['info']['rent_type']=='2')
{
$_POST['info']['roomtype'] = $_POST['roomtype'];
$_POST['info']['limitsex'] = $_POST['limitsex'];
}
$_POST['info']['paytype1'] = $_POST['paytype'];
$_POST['info']['paytype2'] = $_POST['paytype2'];
$_POST['info']['title'] = $name;
$_POST['info']['catid'] = $catid;
$_POST['info']['content'] = $content;
$_POST['info']['region'] = $region;
$_POST['info']['type'] = $_POST['property'];
$_POST['info']['total_area'] = trim($_POST['area']);
$_POST['info']['encode'] = trim($_POST['encode']);
$_POST['info']['house_toward'] = $_POST['aspect'];
$_POST['info']['fix'] = $_POST['decorate'];
$_POST['info']['huxingwei'] = $_POST['toilet'];
$_POST['info']['huxingting'] = $_POST['hall'];
$_POST['info']['huxingshi'] = $_POST['room'];
$_POST['info']['assort'] = $_POST['assort'];
$_POST['info']['floor'] = $_POST['floor'];
$_POST['info']['zonglouceng'] = $_POST['totalfloor'];
$_POST['info']['price'] = $_POST['price'];
$_POST['info']['house_status'] = $_POST['status'];
$username = param::get_cookie('_username');
$userid = param::get_cookie('_userid');
if($_POST['info']['house_status']=='1')
{
$check_allow_nums = 0;
if($this->memberinfo['modelid']=='42')
{
$check_allow_nums = $this->check_allow_post($catid,$userid,42,$this->memberinfo['typeid']);
}
else
{
$check_allow_nums = $this->check_allow_post($catid,$userid,10,$this->memberinfo['groupid']);
}
if(!$check_allow_nums)
{
$_POST['info']['house_status']=2;
}
}
$_POST['info']['house_downtime'] = time();
$_POST['info']['house_age'] = $_POST['houseage'];
$_POST['info']['communityname'] = $_POST['communityname'];
$_POST['info']['relation'] = intval($_POST['cid']);
$_POST['info']['houseno'] = trim($_POST['internalnumber']);
$_POST['info']['remarks'] = safe_replace(htmlspecialchars($_POST['remarks']));
$_POST['info']['house_pic'] = getimages('house_pic');
$_POST['info']['house_room'] = getimages('house_room');
$_POST['info']['house_outdoor'] = getimages('house_outdoor');
if(empty($_POST['titlepic'])&&count(string2array(stripslashes($_POST['info']['house_room'])))>0)
{
$house_pic_arr =  string2array(stripslashes($_POST['info']['house_room']));
$_POST['info']['thumb'] = $house_pic_arr[0]['url'];
}
else
{
$_POST['info']['thumb'] = trim($_POST['titlepic']);
}
$pic_num = count(string2array(stripslashes($_POST['info']['house_pic'])))+count(string2array(stripslashes($_POST['info']['house_room'])))+count(string2array(stripslashes($_POST['info']['house_outdoor'])));
if($pic_num>=4)
{
$_POST['info']['flag'] = '5';
}
if(isset($userid)&&!empty($username))
{
if($member_setting['esf_check']==0 ||$this->memberinfo['modelid']=='42')
{
$_POST['info']['status'] = '99';
}
else
{
$_POST['info']['status'] = '1';
}
}
else
{
$_POST['info']['status'] = '1';
}
if(empty($_POST['usertel']))
{
$_POST['info']['tel'] = $this->memberinfo['tel'];
}
else
{
$_POST['info']['tel'] = trim($_POST['usertel']);
}
if($this->memberinfo['modelid']=='42')
{
$_POST['info']['isbroker'] = 1;
}
if(empty($_POST['username']))
{
$_POST['info']['username'] = $username;
}
else
{
$_POST['info']['username'] = trim($_POST['username']);
}
$_POST['info']['uid'] = $userid;
$id = $db->add_content($_POST['info']);
if($id)
{
$db->set_model($modelid);
$url = ESF_PATH.'rent-show-'.$id.'.html';
$db->update(array('url'=>$url),"id = $id");
}
$this->db->table_name = $this->db->table_name.'_data';
$this->db->insert($moreinfo);
showmessage(L('发布成功~'),ESF_PATH.'rent-list.html');
}
}
public function manage_sell() {
$memberinfo = $this->memberinfo;
$catid = 112;
$this->dorefresh($catid);
$this->db = h5_base::load_model('content_model');
$this->siteid = get_siteid();
$this->categorys = getcache('category_content_'.$this->siteid,'commons');
$category = $this->categorys[$catid];
$modelid = $category['modelid'];
$this->db->set_model($modelid);
if($this->db->table_name==$this->db->db_tablepre) showmessage(L('model_table_not_exists'));
$userid = param::get_cookie('_userid');
if($_POST['doupdate']<>"")
{
$failnum=0;
$oknum=0;
foreach($_POST['hid'] as $key=>$value) {
$info = $this->db->get_one(array('id'=>$key),'refresh');
if($info['refresh']<=0)
{
$failnum++;
}
else
{
$count = $info['refresh']-1;
$where = "id=$key and uid=$userid";
$this->db->update(array('refresh'=>$count,'updatetime'=>time()),$where);
$oknum++;
}
}
if($oknum)
{
$add1 = '成功刷新'.$oknum.'条数据';
}
if($failnum)
{
if($add1)
{
$add2='，';
}
$add2.='刷新失败'.$failnum.'条';
}
showmessage($add1.$add2,HTTP_REFERER);
exit();
}
if($_POST['dodown']<>"")
{
$oknum=0;
foreach($_POST['hid'] as $key=>$value) {
$where = "id=$key and uid=$userid";
$info = $this->db->get_one(array('id'=>$key),'flag');
$flag = $info['flag'];
if(strpos($flag,'5')!==false)
{
$flag = '5';
}
else
{
$flag = '';
}
$this->db->update(array('house_status'=>'2','house_downtime'=>time(),'flag'=>$flag,'listorder'=>0),$where);
$oknum++;
}
if($oknum)
{
$add1 = '成功下架'.$oknum.'条数据';
}
showmessage($add1,HTTP_REFERER);
exit();
}
if($_POST['doup']<>"")
{
$oknum=0;
$failnum=0;
foreach($_POST['hid'] as $key=>$value) {
$check_allow_nums = 0;
if($this->memberinfo['modelid']=='42')
{
$check_allow_nums = $this->check_allow_post($catid,$userid,42,$this->memberinfo['typeid']);
}
else
{
$check_allow_nums = $this->check_allow_post($catid,$userid,10,$this->memberinfo['groupid']);
}
if($check_allow_nums)
{
$where = "id=$key and uid=$userid";
$this->db->update(array('house_status'=>'1','updatetime'=>time()),$where);
$oknum++;
}
else
{
$failnum++;
}
}
if($oknum)
{
$add1 = '成功上架'.$oknum.'条数据';
}
if($failnum)
{
$add1.='失败'.$failnum.'条';
}
showmessage($add1,HTTP_REFERER);
exit();
}
if($_POST['doxintui']<>"")
{
$oknum=0;
$broker_typelist = getcache('broker_typelist','member');
$xintui_num = $broker_typelist[$memberinfo['typeid']]['xintui'];
if($xintui_num==0)
{
showmessage('您当前没有权限使用新推',HTTP_REFERER);
exit();
}
$where = "uid=$userid";
$arr = $this->db->get_one($where." and flag like '%1%'",'count(id) as num');
$nowxintui = $arr['num'];
if($nowxintui>=$xintui_num)
{
showmessage('您已用完'.$xintui_num.'个新推',HTTP_REFERER);
exit();
}
foreach($_POST['hid'] as $key=>$value) {
if($nowxintui<=$xintui_num)
{
$where= "uid=$userid and id=$key ";
$info = $this->db->get_one(array('id'=>$key),'flag');
$flag = $info['flag'];
if(empty($flag))
{
$flag=1;
$nowxintui++;
$oknum++;
$this->db->update(array('flag'=>$flag),$where);
}
elseif(strpos($flag,'1')===false)
{
$flag= $flag.',1';
$this->db->update(array('flag'=>$flag),$where);
$nowxintui++;
$oknum++;
}
else
{
continue;
}
}
}
if($oknum)
{
showmessage('成功设置'.$oknum.'个新推房源',HTTP_REFERER);
exit();
}
}
if($_POST['dojishou']<>"")
{
$oknum=0;
$broker_typelist = getcache('broker_typelist','member');
$jishou_num = $broker_typelist[$memberinfo['typeid']]['jishou'];
if($jishou_num==0)
{
showmessage('您当前没有权限使用急售',HTTP_REFERER);
exit();
}
$where = "uid=$userid";
$arr = $this->db->get_one($where." and flag like '%2%'",'count(id) as num');
$nowjishou = $arr['num'];
if($nowjishou>=$jishou_num)
{
showmessage('您已用完'.$jishou_num.'个急售',HTTP_REFERER);
exit();
}
foreach($_POST['hid'] as $key=>$value) {
if($nowjishou<=$jishou_num)
{
$where= "uid=$userid and id=$key ";
$info = $this->db->get_one(array('id'=>$key),'flag');
$flag = $info['flag'];
if(empty($flag))
{
$flag=3;
$nowjishou++;
$oknum++;
$this->db->update(array('flag'=>$flag),$where);
}
elseif(strpos($flag,'2')===false)
{
$flag= $flag.',2';
$this->db->update(array('flag'=>$flag),$where);
$nowjishou++;
$oknum++;
}
else
{
continue;
}
}
}
if($oknum)
{
showmessage('成功设置'.$oknum.'个急售房源',HTTP_REFERER);
exit();
}
}
if($_POST['dotuijian']<>"")
{
$oknum=0;
$broker_typelist = getcache('broker_typelist','member');
$tuijian_num = $broker_typelist[$memberinfo['typeid']]['tuijian'];
if($tuijian_num==0)
{
showmessage('您当前没有权限使用推荐',HTTP_REFERER);
exit();
}
$where = "uid=$userid";
$arr = $this->db->get_one($where." and flag like '%3%'",'count(id) as num');
$nowtuijian = $arr['num'];
if($nowtuijian>=$tuijian_num)
{
showmessage('您已用完'.$tuijian_num.'个推荐',HTTP_REFERER);
exit();
}
foreach($_POST['hid'] as $key=>$value) {
if($nowtuijian<=$tuijian_num)
{
$where= "uid=$userid and id=$key ";
$info = $this->db->get_one(array('id'=>$key),'flag');
$flag = $info['flag'];
if(empty($flag))
{
$flag=3;
$nowtuijian++;
$oknum++;
$this->db->update(array('flag'=>$flag),$where);
}
elseif(strpos($flag,'3')===false)
{
$flag= $flag.',3';
$this->db->update(array('flag'=>$flag),$where);
$nowtuijian++;
$oknum++;
}
else
{
continue;
}
}
}
if($oknum)
{
showmessage('成功设置'.$oknum.'个推荐房源',HTTP_REFERER);
exit();
}
}
if($_POST['dozhiding']<>"")
{
$oknum=0;
$broker_typelist = getcache('broker_typelist','member');
$zhiding_num = $broker_typelist[$memberinfo['typeid']]['zhiding'];
if($zhiding_num==0)
{
showmessage('您当前没有权限使用置顶',HTTP_REFERER);
exit();
}
$where = "uid=$userid";
$arr = $this->db->get_one($where." and listorder=1",'count(id) as num');
$nowzhiding = $arr['num'];
if($nowzhiding>=$zhiding_num)
{
showmessage('您已用完'.$zhiding_num.'个置顶',HTTP_REFERER);
exit();
}
foreach($_POST['hid'] as $key=>$value) {
if($nowzhiding<=$zhiding_num)
{
$where= "uid=$userid and id=$key ";
$info = $this->db->get_one(array('id'=>$key),'listorder');
$listorder = $info['listorder'];
if($listorder==0)
{
$nowzhiding++;
$oknum++;
$this->db->update(array('listorder'=>1),$where);
}
else
{
continue;
}
}
}
if($oknum)
{
showmessage('成功设置'.$oknum.'个置顶房源',HTTP_REFERER);
exit();
}
}
if($_POST['dorecomm']<>"")
{
$oknum=0;
foreach($_POST['hid'] as $key=>$value) {
$where= "uid=$userid and id=$key ";
$info = $this->db->get_one(array('id'=>$key),'recommend');
$recommend = $info['recommend'];
if($recommend==0)
{
$oknum++;
$this->db->update(array('recommend'=>1),$where);
}
}
if($oknum)
{
showmessage('成功设置'.$oknum.'个店铺推荐房源',HTTP_REFERER);
exit();
}
}
if($_POST['dodel']<>"")
{
$oknum=0;
foreach($_POST['hid'] as $id=>$value) {
$this->db->delete_content($id,$fileurl,$catid);
$attachment = h5_base::load_model('attachment_model');
$this->hits_db = h5_base::load_model('hits_model');
$this->hits_db->delete(array('hitsid'=>'c-'.$modelid.'-'.$id));
$attachment->api_delete('c-'.$catid.'-'.$id);
$oknum++;
}
if($oknum)
{
$add1 = '成功删除'.$oknum.'条数据';
}
showmessage($add1,HTTP_REFERER);
exit();
}
$_username = $this->memberinfo['username'];
$_userid = $this->memberinfo['userid'];
$siteid = intval($_GET['siteid']);
if(!$siteid) $siteid = 1;
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
$siteurl = siteurl($siteid);
$pagesize = 20;
$page = max(intval($_GET['page']),1);
$workflows = getcache('workflow_'.$siteid,'commons');
$house_status = intval($_GET['status']) ?intval($_GET['status']) :1 ;
$where = " `uid` = '$_userid' AND `house_status` = '$house_status'";
$place = intval($_GET['place']);
$number = trim($_GET['number']);
$village = trim($_GET['village']);
if(!empty($place))
{
$arrchildid = get_arrchildid('3360',$place);
$where.=" and `region` in ($arrchildid)";
}
if(!empty($number))
{
$where.=" and `houseno` like '%$number%'";
}
if(!empty($village))
{
$where.=" and `communityname` like '%$village%'";
}
$datas = $this->db->listinfo($where,'id DESC',$page,'10');
$pages = $this->db->pages;
include template('member','lists_sell');
}
public function manage_rent() {
$memberinfo = $this->memberinfo;
$catid = 113;
$this->dorefresh($catid,'time2');
$this->db = h5_base::load_model('content_model');
$this->siteid = get_siteid();
$this->categorys = getcache('category_content_'.$this->siteid,'commons');
$category = $this->categorys[$catid];
$modelid = $category['modelid'];
$this->db->set_model($modelid);
if($this->db->table_name==$this->db->db_tablepre) showmessage(L('model_table_not_exists'));
$userid = param::get_cookie('_userid');
if($_POST['doupdate']<>"")
{
$failnum=0;
$oknum=0;
foreach($_POST['hid'] as $key=>$value) {
$info = $this->db->get_one(array('id'=>$key),'refresh');
if($info['refresh']<=0)
{
$failnum++;
}
else
{
$count = $info['refresh']-1;
$where = "id=$key and uid=$userid";
$this->db->update(array('refresh'=>$count,'updatetime'=>time()),$where);
$oknum++;
}
}
if($oknum)
{
$add1 = '成功刷新'.$oknum.'条数据';
}
if($failnum)
{
if($add1)
{
$add2='，';
}
$add2.='刷新失败'.$failnum.'条';
}
showmessage($add1.$add2,HTTP_REFERER);
exit();
}
if($_POST['dodown']<>"")
{
$oknum=0;
foreach($_POST['hid'] as $key=>$value) {
$where = "id=$key and uid=$userid";
$info = $this->db->get_one(array('id'=>$key),'flag');
$flag = $info['flag'];
if(strpos($flag,'5')!==false)
{
$flag = '5';
}
else
{
$flag = '';
}
$this->db->update(array('house_status'=>'2','house_downtime'=>time(),'flag'=>$flag,'listorder'=>0),$where);
$oknum++;
}
if($oknum)
{
$add1 = '成功下架'.$oknum.'条数据';
}
showmessage($add1,HTTP_REFERER);
exit();
}
if($_POST['doup']<>"")
{
$oknum=0;
$failnum=0;
foreach($_POST['hid'] as $key=>$value) {
$check_allow_nums = 0;
if($this->memberinfo['modelid']=='42')
{
$check_allow_nums = $this->check_allow_post($catid,$userid,42,$this->memberinfo['typeid']);
}
else
{
$check_allow_nums = $this->check_allow_post($catid,$userid,10,$this->memberinfo['groupid']);
}
if($check_allow_nums)
{
$where = "id=$key and uid=$userid";
$this->db->update(array('house_status'=>'1','updatetime'=>time()),$where);
$oknum++;
}
else
{
$failnum++;
}
}
if($oknum)
{
$add1 = '成功上架'.$oknum.'条数据';
}
if($failnum)
{
$add1.='失败'.$failnum.'条';
}
showmessage($add1,HTTP_REFERER);
exit();
}
if($_POST['doresub']<>"")
{
$oknum=0;
foreach($_POST['hid'] as $key=>$value) {
$where = "id=$key and uid=$userid";
$this->db->update(array('house_status'=>'1','updatetime'=>time()),$where);
$oknum++;
}
if($oknum)
{
$add1 = '成功重新发布'.$oknum.'条数据';
}
showmessage($add1,HTTP_REFERER);
exit();
}
if($_POST['doxintui']<>"")
{
$oknum=0;
$broker_typelist = getcache('broker_typelist','member');
$xintui_num = $broker_typelist[$memberinfo['typeid']]['xintui'];
if($xintui_num==0)
{
showmessage('您当前没有权限使用新推',HTTP_REFERER);
exit();
}
$where = "uid=$userid";
$arr = $this->db->get_one($where." and flag like '%1%'",'count(id) as num');
$nowxintui = $arr['num'];
if($nowxintui>=$xintui_num)
{
showmessage('您已用完'.$xintui_num.'个新推',HTTP_REFERER);
exit();
}
foreach($_POST['hid'] as $key=>$value) {
if($nowxintui<=$xintui_num)
{
$where= "uid=$userid and id=$key ";
$info = $this->db->get_one(array('id'=>$key),'flag');
$flag = $info['flag'];
if(empty($flag))
{
$flag=1;
$nowxintui++;
$oknum++;
$this->db->update(array('flag'=>$flag),$where);
}
elseif(strpos($flag,'1')===false)
{
$flag= $flag.',1';
$this->db->update(array('flag'=>$flag),$where);
$nowxintui++;
$oknum++;
}
else
{
continue;
}
}
}
if($oknum)
{
showmessage('成功设置'.$oknum.'个新推房源',HTTP_REFERER);
exit();
}
}
if($_POST['dojishou']<>"")
{
$oknum=0;
$broker_typelist = getcache('broker_typelist','member');
$jishou_num = $broker_typelist[$memberinfo['typeid']]['jishou'];
if($jishou_num==0)
{
showmessage('您当前没有权限使用急售',HTTP_REFERER);
exit();
}
$where = "uid=$userid";
$arr = $this->db->get_one($where." and flag like '%2%'",'count(id) as num');
$nowjishou = $arr['num'];
if($nowjishou>=$jishou_num)
{
showmessage('您已用完'.$jishou_num.'个急售',HTTP_REFERER);
exit();
}
foreach($_POST['hid'] as $key=>$value) {
if($nowjishou<=$jishou_num)
{
$where= "uid=$userid and id=$key ";
$info = $this->db->get_one(array('id'=>$key),'flag');
$flag = $info['flag'];
if(empty($flag))
{
$flag=3;
$nowjishou++;
$oknum++;
$this->db->update(array('flag'=>$flag),$where);
}
elseif(strpos($flag,'2')===false)
{
$flag= $flag.',2';
$this->db->update(array('flag'=>$flag),$where);
$nowjishou++;
$oknum++;
}
else
{
continue;
}
}
}
if($oknum)
{
showmessage('成功设置'.$oknum.'个急售房源',HTTP_REFERER);
exit();
}
}
if($_POST['dotuijian']<>"")
{
$oknum=0;
$broker_typelist = getcache('broker_typelist','member');
$tuijian_num = $broker_typelist[$memberinfo['typeid']]['tuijian'];
if($tuijian_num==0)
{
showmessage('您当前没有权限使用推荐',HTTP_REFERER);
exit();
}
$where = "uid=$userid";
$arr = $this->db->get_one($where." and flag like '%3%'",'count(id) as num');
$nowtuijian = $arr['num'];
if($nowtuijian>=$tuijian_num)
{
showmessage('您已用完'.$tuijian_num.'个推荐',HTTP_REFERER);
exit();
}
foreach($_POST['hid'] as $key=>$value) {
if($nowtuijian<=$tuijian_num)
{
$where= "uid=$userid and id=$key ";
$info = $this->db->get_one(array('id'=>$key),'flag');
$flag = $info['flag'];
if(empty($flag))
{
$flag=3;
$nowtuijian++;
$oknum++;
$this->db->update(array('flag'=>$flag),$where);
}
elseif(strpos($flag,'3')===false)
{
$flag= $flag.',3';
$this->db->update(array('flag'=>$flag),$where);
$nowtuijian++;
$oknum++;
}
else
{
continue;
}
}
}
if($oknum)
{
showmessage('成功设置'.$oknum.'个推荐房源',HTTP_REFERER);
exit();
}
}
if($_POST['dozhiding']<>"")
{
$oknum=0;
$broker_typelist = getcache('broker_typelist','member');
$zhiding_num = $broker_typelist[$memberinfo['typeid']]['zhiding'];
if($zhiding_num==0)
{
showmessage('您当前没有权限使用置顶',HTTP_REFERER);
exit();
}
$where = "uid=$userid";
$arr = $this->db->get_one($where." and listorder=1",'count(id) as num');
$nowzhiding = $arr['num'];
if($nowzhiding>=$zhiding_num)
{
showmessage('您已用完'.$zhiding_num.'个置顶',HTTP_REFERER);
exit();
}
foreach($_POST['hid'] as $key=>$value) {
if($nowzhiding<=$zhiding_num)
{
$where= "uid=$userid and id=$key ";
$info = $this->db->get_one(array('id'=>$key),'listorder');
$listorder = $info['listorder'];
if($listorder==0)
{
$nowzhiding++;
$oknum++;
$this->db->update(array('listorder'=>1),$where);
}
else
{
continue;
}
}
}
if($oknum)
{
showmessage('成功设置'.$oknum.'个置顶房源',HTTP_REFERER);
exit();
}
}
if($_POST['dorecomm']<>"")
{
$oknum=0;
foreach($_POST['hid'] as $key=>$value) {
$where= "uid=$userid and id=$key ";
$info = $this->db->get_one(array('id'=>$key),'recommend');
$recommend = $info['recommend'];
if($recommend==0)
{
$oknum++;
$this->db->update(array('recommend'=>1),$where);
}
}
if($oknum)
{
showmessage('成功设置'.$oknum.'个店铺推荐房源',HTTP_REFERER);
exit();
}
}
if($_POST['dodel']<>"")
{
$oknum=0;
foreach($_POST['hid'] as $id=>$value) {
$this->db->delete_content($id,$fileurl,$catid);
$attachment = h5_base::load_model('attachment_model');
$this->hits_db = h5_base::load_model('hits_model');
$this->hits_db->delete(array('hitsid'=>'c-'.$modelid.'-'.$id));
$attachment->api_delete('c-'.$catid.'-'.$id);
$oknum++;
}
if($oknum)
{
$add1 = '成功删除'.$oknum.'条数据';
}
showmessage($add1,HTTP_REFERER);
exit();
}
$_username = $this->memberinfo['username'];
$_userid = $this->memberinfo['userid'];
$siteid = intval($_GET['siteid']);
if(!$siteid) $siteid = 1;
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
$siteurl = siteurl($siteid);
$pagesize = 20;
$page = max(intval($_GET['page']),1);
$workflows = getcache('workflow_'.$siteid,'commons');
$house_status = intval($_GET['status']) ?intval($_GET['status']) :1 ;
$where = " `uid` = '$_userid' AND `house_status` = '$house_status'";
$place = intval($_GET['place']);
$number = trim($_GET['number']);
$village = trim($_GET['village']);
if(!empty($place))
{
$arrchildid = get_arrchildid('3360',$place);
$where.=" and `region` in ($arrchildid)";
}
if(!empty($number))
{
$where.=" and `houseno` like '%$number%'";
}
if(!empty($village))
{
$where.=" and `communityname` like '%$village%'";
}
$datas = $this->db->listinfo($where,'id DESC',$page,'10');
$pages = $this->db->pages;
include template('member','lists_rent');
}
public function doupdate() {
$catid = intval($_POST['catid']);
$id = intval($_POST['hid']);
$this->db = h5_base::load_model('content_model');
$this->siteid = get_siteid();
$this->categorys = getcache('category_content_'.$this->siteid,'commons');
$category = $this->categorys[$catid];
$modelid = $category['modelid'];
$this->db->set_model($modelid);
$info = $this->db->get_one(array('id'=>$id),'refresh');
if($info['refresh']<=0)
{
echo 2;
}
else
{
$count = $info['refresh']-1;
$where = "id=$id";
$this->db->update(array('refresh'=>$count,'updatetime'=>time()),$where);
echo 1;
}
}
public function dorefresh($catid,$field='time') {
$member_setting = getcache('member_setting');
$refresh_times = $member_setting['refresh_times']?$member_setting['refresh_times'] : 2;
$today = mktime(0,0,0,date('m'),date('d'),date('Y'));
$data = $this->getDotime($field);
if($today != $data) {
$this->db = h5_base::load_model('content_model');
$this->siteid = get_siteid();
$this->categorys = getcache('category_content_'.$this->siteid,'commons');
$category = $this->categorys[$catid];
$modelid = $category['modelid'];
$this->db->set_model($modelid);
$this->db->update(array('refresh'=>$refresh_times),'1=1');
$this->db->table_name = 'h5_dotime';
$this->db->update(array($field=>$today),'1=1');
}
}
public function getDotime($field = 'time') {
$this->db = h5_base::load_model('content_model');
$this->db->table_name = 'h5_dotime';
$res = $this->db->get_one();
return $res[$field];
}
public function account_manage_avatar() {
$memberinfo = $this->memberinfo;
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
$auth_key = h5_base::load_config('system','auth_key');
$this->_init_phpsso();
$auth_data = $this->client->auth_data(array('uid'=>$this->memberinfo['userid'],'auth_key'=>$auth_key),'',$auth_key);
$upurl = base64_encode(APP_PATH.'index.php?s=member/index/uploadavatar&auth_data='.$auth_data);
$uid = $memberinfo['userid'];
$dir1 = ceil($uid / 10000);
$dir2 = ceil($uid %10000 / 1000);
$url = '/uploadfile/avatar/'.$dir1.'/'.$dir2.'/'.$uid.'/';
$avatar = array('180'=>$url.'180x180.jpg','90'=>$url.'90x90.jpg','45'=>$url.'45x45.jpg','30'=>$url.'30x30.jpg');
include template('member','account_manage_avatar');
}
public function uploadavatar() {
if(isset($this->data['uid']) &&isset($this->data['avatardata'])) {
$this->uid = $this->data['uid'];
$this->avatardata = $this->data['avatardata'];
}else {
exit('0');
}
$dir1 = ceil($this->uid / 10000);
$dir2 = ceil($this->uid %10000 / 1000);
$avatarfile = h5_base::load_config('system','upload_path').'avatar/';
$dir = $avatarfile.$dir1.'/'.$dir2.'/'.$this->uid.'/';
if(!file_exists($dir)) {
mkdir($dir,0777,true);
}
$filename = $dir.$this->uid.'.zip';
file_put_contents($filename,$this->avatardata);
h5_base::load_app_class('pclzip','upgrade',0);
$archive = new PclZip($filename);
if ($archive->extract(PCLZIP_OPT_PATH,$dir) == 0) {
die("Error : ".$archive->errorInfo(true));
}
$avatararr = array('180x180.jpg','30x30.jpg','45x45.jpg','90x90.jpg');
if($handle = opendir($dir)) {
while(false !== ($file = readdir($handle))) {
if($file !== '.'&&$file !== '..') {
if(!in_array($file,$avatararr)) {
@unlink($dir.$file);
}else {
$info = @getimagesize($dir.$file);
if(!$info ||$info[2] !=2) {
@unlink($dir.$file);
}
}
}
}
closedir($handle);
}
$this->db->update(array('avatar'=>APP_PATH.$dir.'180x180.jpg'),array('userid'=>$this->uid));
exit('1');
}
public function account_manage_security() {
$memberinfo = $this->memberinfo;
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
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
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
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
foreach($forminfos_arr as $_fs=>$_fm_value) {
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
public function notice(){
if(isset($_POST['dosubmit'])) {
$notice = isset($_POST['notice']) &&trim($_POST['notice']) ?safe_replace(htmlspecialchars(trim($_POST['notice']))) : '';
$_POST['info']['notice'] = $notice;
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
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('member','notice');
}
}
public function remail(){
if(isset($_POST['dosubmit'])) {
if(!is_password($_POST['password'])) {
showmessage(L('password_format_incorrect'),HTTP_REFERER);
}
if($this->memberinfo['password'] != password($_POST['password'],$this->memberinfo['encrypt'])) {
showmessage(L('old_password_incorrect'),HTTP_REFERER);
}
$newmail = isset($_POST['email']) &&trim($_POST['newmail']) ?trim($_POST['newmail']) : '';
if(is_email($newmail))
{
$updateinfo['email'] = $newmail;
$this->db->update($updateinfo,array('userid'=>$this->memberinfo['userid']));
}
else
{
showmessage('请输入正确的邮箱',HTTP_REFERER);
}
showmessage(L('operation_success'),HTTP_REFERER);
}else {
$memberinfo = $this->memberinfo;
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('member','remail');
}
}
public function identity(){
if(isset($_POST['dosubmit'])) {
$identity_num = isset($_POST['identity_num']) &&trim($_POST['identity_num']) ?trim($_POST['identity_num']) : '';
if(strlen($identity_num)!=15 &&strlen($identity_num)!=18)
{
showmessage('请输入正确的身份证号码',HTTP_REFERER);
}
if($_FILES['upload']['type']=="image/pjpeg"||$_FILES['upload']['type']=="image/jpeg"){
$im = imageCreateFromJPEG($_FILES['upload']['tmp_name']);
}elseif($_FILES['upload']['type']=="image/x-png"){
$im = imageCreateFromPNG($_FILES['upload']['tmp_name']);
}elseif($_FILES['upload']['type']=="image/gif"){
$im = imageCreateFromGIF($_FILES['upload']['tmp_name']);
}else
{
showmessage('上传的不是图片，只允许上传gif,jpg,png类型的图片，上传文件已经被服务器删除！',HTTP_REFERER);
unlink($_FILES['upload']['tmp_name']);
exit;
}
$pic_b = strftime("%Y%m%d").time().".jpg";
if($im)
{
$width  = imagesx($im);
$height = imagesy($im);
$cover_width  = 640;
$cover_height = 480;
$avatarfile = h5_base::load_config('system','upload_path').'broker/';
$dir = $avatarfile.'identity/';
if(!file_exists($dir)) {
mkdir($dir,0777,true);
}
if(($cover_width &&$width>$cover_width) ||($cover_height &&$height>$cover_height)){
$newim = ResizeImage($im,$cover_width,$cover_height,$pic_b);
ImageJpeg ($newim,$dir.$pic_b,100);
ImageDestroy ($newim);
}else{
ImageJpeg ($im,$dir.$pic_b,100);
}
}
require_once CACHE_MODEL_PATH.'member_input.class.php';
require_once CACHE_MODEL_PATH.'member_update.class.php';
$member_input = new member_input($this->memberinfo['modelid']);
$modelinfo = $member_input->get($_POST['info']);
$this->db = h5_base::load_model('content_model');
$this->db->table_name = $this->db->db_tablepre.'member_broker_identity';
$membermodelinfo = $this->db->get_one(array('broker_id'=>$this->memberinfo['userid'],'idtype'=>'identity'));
if(!empty($membermodelinfo)) {
$modelinfo['idcard'] = $identity_num;
$modelinfo['idcard_pic'] = h5_base::load_config('system','upload_path').'broker/identity/'.$pic_b;
$this->db->update($modelinfo,array('broker_id'=>$this->memberinfo['userid'],'idtype'=>'identity'));
}else {
$modelinfo['broker_id'] = $this->memberinfo['userid'];
$modelinfo['idcard'] = $identity_num;
$modelinfo['idtype'] = 'identity';
$modelinfo['idcard_pic'] = h5_base::load_config('system','upload_path').'broker/identity/'.$pic_b;
$modelinfo['add_time'] = SYS_TIME;
$this->db->insert($modelinfo);
}
showmessage(L('operation_success'),HTTP_REFERER);
}else {
$this->db = h5_base::load_model('content_model');
$this->db->table_name = $this->db->db_tablepre.'member_broker_identity';
$membermodelinfo = $this->db->get_one(array('broker_id'=>$this->memberinfo['userid'],'idtype'=>'identity'));
if(!empty($membermodelinfo)) {
$idcard = $membermodelinfo['idcard'];
$idcard_pic = $membermodelinfo['idcard_pic'];
$check_status = $membermodelinfo['status'];
}
$memberinfo = $this->memberinfo;
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('member','identity');
}
}
public function certificate(){
if(isset($_POST['dosubmit'])) {
$certificate_num = isset($_POST['certificate_num']) &&trim($_POST['certificate_num']) ?trim($_POST['certificate_num']) : '';
if(strlen($certificate_num)==0)
{
showmessage('请输入正确的资格证号',HTTP_REFERER);
}
if($_FILES['upload']['type']=="image/pjpeg"||$_FILES['upload']['type']=="image/jpeg"){
$im = imageCreateFromJPEG($_FILES['upload']['tmp_name']);
}elseif($_FILES['upload']['type']=="image/x-png"){
$im = imageCreateFromPNG($_FILES['upload']['tmp_name']);
}elseif($_FILES['upload']['type']=="image/gif"){
$im = imageCreateFromGIF($_FILES['upload']['tmp_name']);
}else
{
showmessage('上传的不是图片，只允许上传gif,jpg,png类型的图片，上传文件已经被服务器删除！',HTTP_REFERER);
unlink($_FILES['upload']['tmp_name']);
exit;
}
$pic_b = strftime("%Y%m%d").time().".jpg";
if($im)
{
$width  = imagesx($im);
$height = imagesy($im);
$cover_width  = 640;
$cover_height = 480;
$avatarfile = h5_base::load_config('system','upload_path').'broker/';
$dir = $avatarfile.'certificate/';
if(!file_exists($dir)) {
mkdir($dir,0777,true);
}
if(($cover_width &&$width>$cover_width) ||($cover_height &&$height>$cover_height)){
$newim = ResizeImage($im,$cover_width,$cover_height,$pic_b);
ImageJpeg ($newim,$dir.$pic_b,100);
ImageDestroy ($newim);
}else{
ImageJpeg ($im,$dir.$pic_b,100);
}
}
require_once CACHE_MODEL_PATH.'member_input.class.php';
require_once CACHE_MODEL_PATH.'member_update.class.php';
$member_input = new member_input($this->memberinfo['modelid']);
$modelinfo = $member_input->get($_POST['info']);
$this->db = h5_base::load_model('content_model');
$this->db->table_name = $this->db->db_tablepre.'member_broker_identity';
$membermodelinfo = $this->db->get_one(array('broker_id'=>$this->memberinfo['userid'],'idtype'=>'certificate'));
if(!empty($membermodelinfo)) {
$modelinfo['idcard'] = $certificate_num;
$modelinfo['idcard_pic'] = h5_base::load_config('system','upload_path').'broker/certificate/'.$pic_b;
$this->db->update($modelinfo,array('broker_id'=>$this->memberinfo['userid'],'idtype'=>'certificate'));
}else {
$modelinfo['broker_id'] = $this->memberinfo['userid'];
$modelinfo['idcard'] = $certificate_num;
$modelinfo['idtype'] = 'certificate';
$modelinfo['idcard_pic'] = h5_base::load_config('system','upload_path').'broker/certificate/'.$pic_b;
$modelinfo['add_time'] = SYS_TIME;
$this->db->insert($modelinfo);
}
showmessage(L('operation_success'),HTTP_REFERER);
}else {
$this->db = h5_base::load_model('content_model');
$this->db->table_name = $this->db->db_tablepre.'member_broker_identity';
$membermodelinfo = $this->db->get_one(array('broker_id'=>$this->memberinfo['userid'],'idtype'=>'certificate'));
if(!empty($membermodelinfo)) {
$idcard = $membermodelinfo['idcard'];
$idcard_pic = $membermodelinfo['idcard_pic'];
$check_status = $membermodelinfo['status'];
}
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('member','certificate');
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
if(h5_base::load_config('uc','ucuse')) {
$this->_init_ucenter();
if(defined('UC_API') &&require_once './api/uc_client/client.php')
{
$username = param::get_cookie('_username');
$ucresult = uc_user_edit($username,$_POST['info']['password'],$_POST['info']['newpassword'],$email,1);
}
}
showmessage(L('operation_success'),HTTP_REFERER);
}else {
$show_validator = true;
$memberinfo = $this->memberinfo;
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
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
$avatar = $this->client->ps_getavatar($this->memberinfo['userid']);
$memberinfo['groupname'] = $grouplist[$memberinfo[groupid]]['name'];
$memberinfo['grouppoint'] = $grouplist[$memberinfo[groupid]]['point'];
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
unset($grouplist[$memberinfo['groupid']]);
include template('member','account_manage_upgrade');
}
}
public function login() {
$this->_session_start();
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$sitelist  = getcache('sitelist','commons');
$default_style = $sitelist[$siteid]['default_style'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
$copyright = $sitelist[$siteid]['copyright'];
if (!defined('SITEID')) {
define('SITEID',$siteid);
}
if(isset($_POST['dosubmit'])) {
if(empty($_SESSION['connectid']) &&(!isset($_GET['inajax'])||($_GET['inajax']<>'yes'))) {
$code = isset($_POST['code']) &&trim($_POST['code']) ?trim($_POST['code']) : showmessage(L('input_code'),HTTP_REFERER);
if ($_SESSION['code'] != strtolower($code)) {
showmessage(L('code_error'),HTTP_REFERER);
}
}
$_POST['username'] = safe_replace(trim($_POST['username']));
$username = isset($_POST['username']) &&trim($_POST['username']) ?trim($_POST['username']) : showmessage(L('username_empty'),HTTP_REFERER);
$password = isset($_POST['password']) &&trim($_POST['password']) ?trim($_POST['password']) : showmessage(L('password_empty'),HTTP_REFERER);
$cookietime = intval($_POST['cookietime']);
$ucsynlogin = '';
if(h5_base::load_config('uc','ucuse')) {
$this->_init_ucenter();
if(defined('UC_API') &&require_once './api/uc_client/client.php')
{
$r = $this->db->get_one(array('username'=>$username));
list($uid,$username,$password,$email) = uc_user_login($username,$password);
if($uid >0) {
$password = md5($password);
if(!$r) {
$info = array(
'username'=>$username,
'password'=>$password,
'encrypt'=>create_randomstr(6),
'email'=>$email,
'regip'=>ip(),
'regdate'=>SYS_TIME,
'lastip'=>ip(),
'lastdate'=>SYS_TIME,
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
$r = $this->db->get_one(array('username'=>$username));
}
$password = $r['password'];
$ucsynlogin = uc_user_synlogin($uid);
}else {
if($r) {
$password = md5(md5(trim($password)).$r['encrypt']);
if($r['password'] == $password) {
$uid = uc_user_register($r['username'],$_POST['password'],$r['email']);
if($uid >0) $ucsynlogin = uc_user_synlogin($uid);
}
else
{
showmessage(L('password_error'),'index.php?s=member/index/login',3000);
}
}else {
showmessage(L('user_not_exist'),'index.php?s=member/index/login');
}
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
$check_groupid = $this->_get_usergroup_bypoint($r['point'],$r['modelid']);
if($check_groupid != $r['groupid']) {
$updatearr['groupid'] = $groupid = $check_groupid;
}
}
}
if(empty($_SESSION['connectid'])) {
$qc_token = param::get_cookie('qc_token');
if(!empty($qc_token))
{
$_SESSION['connectid'] = $qc_token;
$_SESSION['from'] = 'qq';
}
}
if(!empty($_SESSION['connectid'])) {
$updatearr['connectid'] = $_SESSION['connectid'];
}
if(!empty($_SESSION['from'])) {
$updatearr['from'] = $_SESSION['from'];
}
unset($_SESSION['connectid'],$_SESSION['from']);
$member_setting = getcache('member_setting');
$firstloginpoint = $member_setting['firstloginpoint'] ?$member_setting['firstloginpoint'] : 0;
$lastdate = $r['lastdate'];
$today = mktime(0,0,0,date('m'),date('d'),date('Y'));
if($firstloginpoint &&$lastdate<$today)
{
h5_base::load_app_class('receipts','pay',0);
receipts::point($firstloginpoint,$userid,$username,'','selfincome','当天首次登录');
}
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
showmessage(L('login_success').$ucsynlogin,$forward);
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
if(h5_base::load_config('uc','ucuse')) {
$this->_init_ucenter();
if(defined('UC_API') &&require_once './api/uc_client/client.php')
{
$ucsynlogin = uc_user_synlogout();
}
}
param::set_cookie('auth','');
param::set_cookie('_userid','');
param::set_cookie('_username','');
param::set_cookie('_groupid','');
param::set_cookie('_nickname','');
param::set_cookie('cookietime','');
$forward = isset($_GET['forward']) &&trim($_GET['forward']) ?$_GET['forward'] : 'index.php?s=member/index/login';
showmessage(L('logout_success').$ucsynlogin,$forward);
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
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('member','favorite_list');
}
}
public function follow() {
$this->favorite_db = h5_base::load_model('follow_model');
$memberinfo = $this->memberinfo;
if(isset($_GET['id']) &&trim($_GET['id'])) {
$this->favorite_db->delete(array('userid'=>$memberinfo['userid'],'id'=>intval($_GET['id'])));
showmessage(L('operation_success'),HTTP_REFERER);
}else {
$page = isset($_GET['page']) &&trim($_GET['page']) ?intval($_GET['page']) : 1;
$followlist = $this->favorite_db->listinfo(array('userid'=>$memberinfo['userid']),'id DESC',$page,10);
$pages = $this->favorite_db->pages;
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('member','follow_list');
}
}
public function friend() {
$memberinfo = $this->memberinfo;
$this->friend_db = h5_base::load_model('friend_model');
if(isset($_GET['friendid'])) {
$this->friend_db->delete(array('userid'=>$memberinfo['userid'],'friendid'=>intval($_GET['friendid'])));
showmessage(L('operation_success'),HTTP_REFERER);
}else {
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
$phpsso_api_url = $this->_init_phpsso();
$page = isset($_GET['page']) ?intval($_GET['page']) : 1;
$friendids = $this->friend_db->listinfo(array('userid'=>$memberinfo['userid']),'',$page,10);
$pages = $this->friend_db->pages;
foreach($friendids as $k=>$v) {
$friendlist[$k]['friendid'] = $v['friendid'];
$friendlist[$k]['avatar'] = $this->client->ps_getavatar($v['userid']);
$friendlist[$k]['is'] = $v['is'];
}
include template('member','friend_list');
}
}
public function change_credit() {
$memberinfo = $this->memberinfo;
$member_setting = getcache('member_setting');
$this->_init_phpsso();
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
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
if($from == 1) {
$this->db->update(array('point'=>"-=$fromvalue"),array('userid'=>$memberinfo['userid']));
}elseif($from == 2) {
$this->db->update(array('amount'=>"-=$fromvalue"),array('userid'=>$memberinfo['userid']));
}
showmessage(L('operation_success'),HTTP_REFERER);
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
include template('member','mini');
}
public function loginbar() {
$_username = param::get_cookie('_username');
$_userid = param::get_cookie('_userid');
$siteid = isset($_GET['siteid']) ?intval($_GET['siteid']) : '';
if (!defined('SITEID')) {
define('SITEID',$siteid);
}
$memberinfo = $this->memberinfo;
$callback = trim($_GET['callback']);
if($_username)
{
if($memberinfo['typeid'])
{
$typeword = '\u60a8\u597d\uff0c\u7ecf\u7eaa\u4eba\u7528\u6237';
}
else
{
$typeword = '\u60a8\u597d\uff0c\u4e2a\u4eba\u7528\u6237';
}
echo $callback.'({"html":"'.$typeword.' <b style=\"color:#ff6600;\">'.get_nickname().'<\/b> [<a href=\"\/index.php?s=member\/index\/\" target=\"_blank\">\u7528\u6237\u4e2d\u5fc3<\/a>] [<a href=\"\/index.php?s=member\/index\/logout\">\u5b89\u5168\u9000\u51fa<\/a>]"})';
}
else
{
echo $callback.'({"html":"<form action=\"\/index.php?s=member\/index\/login\/inajax\/yes\" method=\"post\"><input type=\"hidden\" value=\"\" name=\"referer\">\u5e10\u53f7\uff1a<input name=\"username\" type=\"text\" required=\"required\"> \u5bc6\u7801\uff1a<input name=\"password\" type=\"password\" required=\"required\"> <button name=\"dosubmit\" type=\"submit\"><\/button><a href=\"\/register.html\" rel=\"nofollow\">\u6ce8\u518c<\/a> | <a href=\"\/forget_password.html\" rel=\"nofollow\">\u627e\u56de\u5bc6\u7801<\/a><\/form>"})';
}
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
protected function _get_usergroup_bypoint($point=0,$modelid=10) {
$groupid = 2;
if(empty($point)) {
$member_setting = getcache('member_setting');
$point = $member_setting['defualtpoint'] ?$member_setting['defualtpoint'] : 0;
}
$grouplist = getcache('grouplist');
foreach ($grouplist as $k=>$v) {
if($v['modelid']==$modelid)
{
$grouppointlist[$k] = $v['point'];
}
}
arsort($grouppointlist);
if($point >max($grouppointlist)) {
$groupid = key($grouppointlist);
}elseif($point <= min($grouppointlist))
{
end($grouppointlist);
$groupid = key($grouppointlist);
}
else{
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
if(h5_base::load_config('uc','ucuse')) {
$this->_init_ucenter();
if(defined('UC_API') &&require_once './api/uc_client/client.php')
{
$ucresult = uc_user_checkname($username);
if($ucresult >0)
{
exit('1');
}
elseif($ucresult == -1)
{
exit('0');
}
elseif($ucresult == -2)
{
exit('0');
}
elseif($ucresult == -3)
{
exit('0');
}
}
}
else
{
$this->verify_db = h5_base::load_model('member_verify_model');
if($this->verify_db->get_one(array('username'=>$username))) {
exit('0');
}
$where = array('username'=>$username);
$res = $this->db->get_one($where);
if($res) {
exit('0');
}else {
exit('1');
}
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
$email = isset($_GET['email']) &&trim($_GET['email']) ?trim($_GET['email']) : exit(0);
if(isset($_GET['userid'])) {
$userid = intval($_GET['userid']);
$info = get_memberinfo($userid);
if($info['email'] == $email){
exit('1');
}
}
if(h5_base::load_config('uc','ucuse')) {
$this->_init_ucenter();
if(defined('UC_API') &&require_once './api/uc_client/client.php')
{
$ucresult = uc_user_checkemail($email);
if($ucresult >0) {
exit('1');
}elseif($ucresult == -4) {
exit(0);
}elseif($ucresult == -5) {
exit(0);
}elseif($ucresult == -6) {
exit(0);
}
}
}
else
{
$this->verify_db = h5_base::load_model('member_verify_model');
if($this->verify_db->get_one(array('email'=>$email))) {
exit('0');
}
$where = array('email'=>$email);
$res = $this->db->get_one($where);
if($res) {
exit('0');
}else {
exit('1');
}
}
exit();
}
public function public_sina_login() {
define('WB_AKEY',h5_base::load_config('system','sina_akey'));
define('WB_SKEY',h5_base::load_config('system','sina_skey'));
h5_base::load_app_class('weibooauth','',0);
$this->_session_start();
$o = new SaeTOAuthV2( WB_AKEY ,WB_SKEY );
if(isset($_GET['callback']) &&trim($_GET['callback'])) {
if (isset($_REQUEST['code'])) {
$keys = array();
$keys['code'] = $_REQUEST['code'];
$keys['redirect_uri'] = APP_PATH.'index.php?s=member/index/public_sina_login/callback/1';
try {
$token = $o->getAccessToken( 'code',$keys ) ;
}catch (OAuthException $e) {
}
}
if ($token) {
$_SESSION['token'] = $token;
}
$c = new SaeTClientV2( WB_AKEY ,WB_SKEY ,$_SESSION['token']['access_token'] );
$ms  = $c->home_timeline();
$uid_get = $c->get_uid();
$uid = $uid_get['uid'];
$me = $c->show_user_by_id( $uid);
if(CHARSET != 'utf-8') {
$me['name'] = iconv('utf-8',CHARSET,$me['name']);
$me['location'] = iconv('utf-8',CHARSET,$me['location']);
$me['description'] = iconv('utf-8',CHARSET,$me['description']);
$me['screen_name'] = iconv('utf-8',CHARSET,$me['screen_name']);
}
if(!empty($me['id'])) {
$where = array('connectid'=>$me['id'],'from'=>'sina');
$r = $this->db->get_one($where);
$me['profile_image_url'] = str_replace('/50/','/180/',$me['profile_image_url']);
if(!empty($r)) {
$password = $r['password'];
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
param::set_cookie('_profile_image',$me['profile_image_url'],$cookietime);
param::set_cookie('_token',$me['_token'],$cookietime);
$forward = isset($_GET['forward']) &&!empty($_GET['forward']) ?$_GET['forward'] : 'index.php?s=member/index';
showmessage(L('login_success'),$forward);
}else {
$_SESSION = array();
$_SESSION['connectid'] = $me['id'];
$_SESSION['from'] = 'sina';
$connect_username = $me['name'];
$_SESSION['profile_image_url'] = $me['profile_image_url'];
if(!$cookietime) $get_cookietime = param::get_cookie('cookietime');
$_cookietime = $cookietime ?intval($cookietime) : ($get_cookietime ?$get_cookietime : 0);
$cookietime = $_cookietime ?TIME +$_cookietime : 0;
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
foreach($forminfos_arr as $_fs=>$_fm_value) {
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
$o = new SaeTOAuthV2( WB_AKEY ,WB_SKEY );
$aurl = $o->getAuthorizeURL(APP_PATH.'index.php?s=member/index/public_sina_login/forward/'.urlencode($_GET['forward']).'/callback/1');
header('Location: '.$aurl);
}
}
public function public_qq_loginnew(){
$appid = h5_base::load_config('system','qq_appid');
$appkey = h5_base::load_config('system','qq_appkey');
$callback = h5_base::load_config('system','qq_callback');
$forward = isset($_GET['forward']) &&!empty($_GET['forward']) ?$_GET['forward'] : APP_PATH.'index.php?s=member/index';
if (strpos($callback,'{$forward}')!==false)
{
$callback = str_replace('{$forward}',urlencode($forward),$callback);
}
h5_base::load_app_class('qqOAuth2','',0);
$info = new qqOAuth2($appid,$appkey,$callback);
$this->_session_start();
if (!isset($_GET['code'])){
$info->redirect_to_login();
}else{
$code = $_GET['code'];
$token2 = $info->get_openid($code);
param::set_cookie('qq_access_token',$_SESSION["qq_access_token"],$cookietime);
param::set_cookie('openid',$token2,$cookietime);
$nickname = $info->get_user_info();
$figureurl = $info->get_user_head();
if(CHARSET != 'utf-8') {
$nickname = iconv('utf-8',CHARSET,$nickname);
}
param::set_cookie('_nickname',$nickname,$cookietime);
param::set_cookie('_profile_image',$figureurl,$cookietime);
if(!empty($token2)){
$r = $this->db->get_one(array('connectid'=>$token2,'from'=>'qq'));
if(!empty($r)){
$password = $r['password'];
$userid = $r['userid'];
$groupid = $r['groupid'];
$username = $r['username'];
$roleid = intval($r['roleid']);
$nickname = empty($r['nickname']) ?$username : $r['nickname'];
$this->db->update(array('lastip'=>ip(),'lastdate'=>SYS_TIME),array('userid'=>$userid));
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
param::set_cookie('qc_token',$token2,$cookietime);
$forward = $_GET['forward'];
showmessage(L('login_success'),$forward,'1000');
}else{
$_SESSION = array();
$_SESSION['profile_image_url'] = $figureurl;
$_SESSION['connectid'] = $token2;
$_SESSION['from'] = 'qq';
$connect_username = $nickname;
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
foreach($forminfos_arr as $_fs=>$_fm_value) {
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
$sitename = 'house5';
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
if(empty($memberinfo['userid'])) {
showmessage(L('operation_failure'),'index.php?s=member/index/login');
}
$password = random(8);
$updateinfo['password'] = password($password,$memberinfo['encrypt']);
$this->db->update($updateinfo,array('userid'=>$code[0]));
if(h5_base::load_config('uc','ucuse')) {
$this->_init_ucenter();
if(defined('UC_API') &&require_once './api/uc_client/client.php')
{
$username = $memberinfo['username'];
$ucresult = uc_user_edit($username,$password,$password,$memberinfo['email'],1);
}
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
public function public_member_companylist(){
h5_base::load_sys_class('format','',0);
$show_header = '';
$page = intval($_GET['page']);
$type = $_GET['type'];
if(in_array($type,array('company')))
{
$where = '';
if($_GET['typeid']) {
$typeid = intval($_GET['typeid']);
$where .= "typeid='$typeid'";
}
$where .= $where ?' AND modelid=43': 'modelid=43';
if(isset($_GET['keywords'])) {
$keywords = trim($_GET['keywords']);
$field = $_GET['field'];
if(in_array($field,array('username'))) {
if($field=='id') {
if($keywords != $id)
{
$where .= " AND `id` ='$keywords'";
}
}else {
$where .= " AND `$field` like '%$keywords%'";
}
}
}
$infos = $this->db->listinfo($where,'userid desc',$page,12);
$pages = $this->db->pages;
include template('member','member_company_list');
}
else
{
exit;
}
}
public function ajax_login()
{
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
$ucsynlogin = '';
if(h5_base::load_config('uc','ucuse')) {
$this->_init_ucenter();
if(defined('UC_API') &&require_once './api/uc_client/client.php')
{
$r = $this->db->get_one(array('username'=>$username));
list($uid,$username,$password,$email) = uc_user_login($username,$password);
if($uid >0) {
$password = md5($password);
if(!$r) {
$info = array(
'username'=>$username,
'password'=>$password,
'encrypt'=>create_randomstr(6),
'email'=>$email,
'regip'=>ip(),
'regdate'=>SYS_TIME,
'lastip'=>ip(),
'lastdate'=>SYS_TIME,
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
$r = $this->db->get_one(array('username'=>$username));
}
$password = $r['password'];
$ucsynlogin = uc_user_synlogin($uid);
}else {
if($r) {
$password = md5(md5(trim($password)).$r['encrypt']);
if($r['password'] == $password) {
$uid = uc_user_register($r['username'],$_POST['password'],$r['email']);
if($uid >0) $ucsynlogin = uc_user_synlogin($uid);
}
else
{
showmessage(L('password_error'),'index.php?s=member/index/login',3000);
}
}else {
showmessage(L('user_not_exist'),'index.php?s=member/index/login');
}
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
if(!$r) showmessage(L('user_not_exist'),'index.php?s=member/index/ajax_login');
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
showmessage(L('password_error',array('times'=>$times)),'index.php?s=member/index/ajax_login',3000);
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
$check_groupid = $this->_get_usergroup_bypoint($r['point'],$r['modelid']);
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
$_cookietime = 31536000;
$cookietime = $_cookietime ?SYS_TIME +$_cookietime : 0;
$house5_auth_key = md5(h5_base::load_config('system','auth_key').$this->http_user_agent);
$house5_auth = sys_auth($userid."\t".$password,'ENCODE',$house5_auth_key);
param::set_cookie('auth',$house5_auth,$cookietime);
param::set_cookie('_userid',$userid,$cookietime);
param::set_cookie('_username',$username,$cookietime);
param::set_cookie('_groupid',$groupid,$cookietime);
param::set_cookie('_nickname',$nickname,$cookietime);
$forward = isset($_POST['forward']) &&!empty($_POST['forward']) ?urldecode($_POST['forward']) : 'index.php?s=member/index';
showmessage(L('login_success').$ucsynlogin,$forward,'1000','login');
}else {
$setting = h5_base::load_config('system');
$forward = isset($_GET['forward']) &&trim($_GET['forward']) ?urlencode($_GET['forward']) : '';
$siteid = isset($_REQUEST['siteid']) &&trim($_REQUEST['siteid']) ?intval($_REQUEST['siteid']) : 1;
$siteinfo = siteinfo($siteid);
include template('member','ajax_login');
}
}
public function check_allow_post($catid,$userid,$modelid,$groupid)
{
$grouplist = getcache('grouplist');
$broker_type_cache = getcache('broker_typelist');
if($modelid=='42')
{
$allowpost_num = $broker_type_cache[$groupid]['total_nums'];
}
else
{
$allowpost_num = $grouplist[$groupid]['total_nums'];
}
$this->db = h5_base::load_model('content_model');
$sql = "`status`=99 and house_status=1";
$sql.= " and `uid` = $userid";
$return = $this->db->get_one($sql,"COUNT(*) AS num",$limit,$order);
if($allowpost_num>0)
{
$already_post = intval($return['num']);
if($already_post<$allowpost_num)
{
return 1;
}
}
return 0;
}
}
?>