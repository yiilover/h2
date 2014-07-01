<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
h5_base::load_sys_class('format','',0);
class esf_setting extends admin {
private $db;
function __construct() {
parent::__construct();
$this->db = h5_base::load_model('module_model');
}
function manage() {
if(isset($_POST['dosubmit'])) {
$member_setting = array2string($_POST['info']);
$this->db->update(array('module'=>'member','setting'=>$member_setting),array('module'=>'member'));
setcache('member_setting',$_POST['info']);
showmessage(L('operation_success'),HTTP_REFERER);
}else {
$show_scroll = true;
$member_setting = $this->db->get_one(array('module'=>'member'),'setting');
$member_setting = string2array($member_setting['setting']);
$email_config = getcache('common','commons');
if(empty($email_config['mail_user']) ||empty($email_config['mail_password'])) {
$mail_disabled = 1;
}
include $this->admin_tpl('content_esf_setting');
}
}
}
?>