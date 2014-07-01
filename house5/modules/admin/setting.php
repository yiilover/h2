<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
class setting extends admin {
private $db;
function __construct() {
parent::__construct();
$this->db = h5_base::load_model('module_model');
h5_base::load_app_func('global');
}
public function init() {
$show_validator = true;
$setconfig = h5_base::load_config('system');
extract($setconfig);
if(!function_exists('ob_gzhandler')) $gzip = 0;
$info = $this->db->get_one(array('module'=>'admin'));
extract(string2array($info['setting']));
$show_header = true;
$show_validator = 1;
include $this->admin_tpl('setting');
}
public function save() {
$setting = array();
$setting['admin_email'] = is_email($_POST['setting']['admin_email']) ?trim($_POST['setting']['admin_email']) : showmessage(L('email_illegal'),HTTP_REFERER);
$setting['maxloginfailedtimes'] = intval($_POST['setting']['maxloginfailedtimes']);
$setting['minrefreshtime'] = intval($_POST['setting']['minrefreshtime']);
$setting['mail_type'] = intval($_POST['setting']['mail_type']);
$setting['mail_server'] = trim($_POST['setting']['mail_server']);
$setting['mail_port'] = intval($_POST['setting']['mail_port']);
$setting['category_ajax'] = intval(abs($_POST['setting']['category_ajax']));
$setting['mail_user'] = trim($_POST['setting']['mail_user']);
$setting['mail_auth'] = intval($_POST['setting']['mail_auth']);
$setting['mail_from'] = trim($_POST['setting']['mail_from']);
$setting['mail_password'] = trim($_POST['setting']['mail_password']);
$setting['errorlog_size'] = trim($_POST['setting']['errorlog_size']);
$setting['ftp_enable'] = intval($_POST['setconfig']['ftp_enable']);
$setting['ftp_host'] = trim($_POST['setconfig']['ftp_host']);
$setting['ftp_user'] = trim($_POST['setconfig']['ftp_user']);
$setting['ftp_password'] = $_POST['setconfig']['ftp_password'];
$setting['ftp_port'] = intval($_POST['setconfig']['ftp_port']);
$setting['ftp_pasv'] = intval($_POST['setconfig']['ftp_pasv']);
$setting['ftp_path'] = trim($_POST['setconfig']['ftp_path']);
$setting['ftp_upload_url'] = trim($_POST['setconfig']['ftp_upload_url']);
$setting = array2string($setting);
$this->db->update(array('setting'=>$setting),array('module'=>'admin'));
$snda_error = '';
if($_POST['setconfig']['snda_akey'] ||$_POST['setconfig']['snda_skey']) {
if(function_exists('curl_init') == FALSE) {
$snda_error = L('snda_need_curl_init');
$_POST['setconfig']['snda_enable'] = 0;
}
}
set_config($_POST['setconfig']);
$this->setcache();
showmessage(L('setting_succ').$snda_error,HTTP_REFERER);
}
public function public_test_mail() {
h5_base::load_sys_func('mail');
$subject = 'house5 test mail';
$message = 'this is a test mail from House5 Team';
$mail= Array (
'mailsend'=>2,
'maildelimiter'=>1,
'mailusername'=>1,
'server'=>$_POST['mail_server'],
'port'=>intval($_POST['mail_port']),
'mail_type'=>intval($_POST['mail_type']),
'auth'=>intval($_POST['mail_auth']),
'from'=>$_POST['mail_from'],
'auth_username'=>$_POST['mail_user'],
'auth_password'=>$_POST['mail_password']
);
if(sendmail($_GET['mail_to'],$subject,$message,$_POST['mail_from'],$mail)) {
echo L('test_email_succ').$_GET['mail_to'];
}else {
echo L('test_email_faild');
}
}
private function setcache() {
$result = $this->db->get_one(array('module'=>'admin'));
$setting = string2array($result['setting']);
setcache('common',$setting,'commons');
}
}
?>