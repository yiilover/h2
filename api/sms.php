<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('smsapi','sms',0);
$sms_report_db = h5_base::load_model('sms_report_model');
$mobile = $_GET['mobile'];
$siteid = get_siteid() ?get_siteid() : 1 ;
$sms_setting = getcache('sms','sms');
$sitelist = getcache('sitelist','commons');
$sitename = $sitelist[$siteid]['name'];
if(!preg_match('/^1([0-9]{9})/',$mobile)) exit('mobile phone error');
$posttime = SYS_TIME-86400;
$where = "`mobile`='$mobile' AND `posttime`>'$posttime'";
$num = $sms_report_db->count($where);
if($num >2) {
exit('-1');
}
$allow_max_ip = 10;
$ip = ip();
$where = "`ip`='$ip' AND `posttime`>'$posttime'";
$num = $sms_report_db->count($where);
if($num >= $allow_max_ip) {
exit('-3');
}
if(intval($sms_setting[$siteid]['sms_enable']) == 0) exit('-99');
$sms_uid = $sms_setting[$siteid]['userid'];
$sms_pid = $sms_setting[$siteid]['productid'];
$sms_passwd = $sms_setting[$siteid]['sms_key'];
$id_code = random(6);
$send_txt = '尊敬的用户您好，您在'.$sitename.'的注册验证码为：'.$id_code.'，验证码有效期为5分钟。';
$send_userid = intval($_GET['send_userid']);
$smsapi = new smsapi($sms_uid,$sms_pid,$sms_passwd);
$smsapi->get_price();
$mobile = explode(',',$mobile);
$content = safe_replace($send_txt);
$sent_time = intval($_POST['sendtype']) == 2 &&!empty($_POST['sendtime'])  ?trim($_POST['sendtime']) : date('Y-m-d H:i:s',SYS_TIME);
$smsapi->send_sms($mobile,$content,$sent_time,CHARSET,$id_code);
echo $smsapi->statuscode;
?>