<?php

defined('IN_HOUSE5') or exit('No permission resources.');
if($_GET['action']=='id_code') {
$sms_report_db = h5_base::load_model('sms_report_model');
$mobile_verify = $_GET['mobile_verify'];
if(!$mobile_verify) exit();
$mobile = $_GET['mobile'];
if(!preg_match('/^1([0-9]{9})/',$mobile)) exit('check phone error');
$posttime = SYS_TIME-360;
$where = "`mobile`='$mobile' AND `posttime`>'$posttime'";
$r = $sms_report_db->get_one($where,'id_code','id DESC');
if($r &&$r['id_code']==$mobile_verify) exit('1');
}?>