<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_func('global','pay');
class receipts {
protected static $db;
protected  static function connect() {
self::$db = h5_base::load_model("pay_account_model");
}
public static function amount($value,$userid = '',$username = '',$trade_sn = '',$pay_type = '',$payment = '',$op_username = '',$status = 'succ',$note = '') {
return self::_add(array('username'=>$username,'userid'=>$userid,'money'=>$value,'trade_sn'=>$trade_sn,'pay_type'=>$pay_type,'payment'=>$payment,'status'=>$status,'type'=>1,'adminnote'=>$op_username,'usernote'=>$note));
}
public static function point($value,$userid = '',$username = '',$trade_sn = '',$pay_type = '',$payment = '',$op_username = '',$status = 'succ',$note = '') {
return self::_add(array('username'=>$username,'userid'=>$userid,'money'=>$value,'trade_sn'=>$trade_sn,'pay_type'=>$pay_type,'payment'=>$payment,'status'=>$status,'type'=>2,'adminnote'=>$op_username,'usernote'=>$note));
}
private static function _add($data) {
$data['money'] = isset($data['money']) &&floatval($data['money']) ?floatval($data['money']) : 0;
$data['userid'] = isset($data['userid']) &&intval($data['userid']) ?intval($data['userid']) : 0;
$data['username'] = isset($data['username']) ?trim($data['username']) : '';
$data['trade_sn'] = (isset($data['trade_sn']) &&$data['trade_sn']) ?trim($data['trade_sn']) : create_sn();
$data['pay_type'] = isset($data['pay_type']) ?trim($data['pay_type']) : 'selfincome';
$data['payment'] = isset($data['payment']) ?trim($data['payment']) : '';
$data['adminnote'] = isset($data['op_username']) ?trim($data['op_username']) : '';
$data['usernote'] = isset($data['usernote']) ?trim($data['usernote']) : '';
$data['status'] = isset($data['status']) ?trim($data['status']) : 'succ';
$data['type'] = isset($data['type']) &&intval($data['type']) ?intval($data['type']) : 0;
$data['addtime'] = SYS_TIME;
$data['ip'] = ip();
if (!in_array($data['type'],array(1,2))) {
return false;
}
if (!in_array($data['pay_type'],array('offline','recharge','selfincome'))) {
return false;
}
if (!in_array($data['status'],array('succ','error','failed'))) {
return false;
}
if (empty($data['payment'])) {
return false;
}
if (empty($data['money'])) {
return false;
}
if (empty($data['userid']) ||empty($data['username'])) {
if (defined('IN_ADMIN')) {
return false;
}elseif (!$data['userid'] = param::get_cookie('_userid') ||!$data['username'] = param::get_cookie('_username')) {
return false;
}else {
return false;
}
}
if (defined('IN_ADMIN') &&empty($data['adminnote'])) {
$data['adminnote'] = param::get_cookie('admin_username');
}
if (empty(self::$db)) {
self::connect();
}
$member_db = h5_base::load_model('member_model');
$sql = array();
if ($data['type'] == 1) {
$sql = array('amount'=>"+=".$data['money']);
}elseif ($data['type'] == 2) {
$sql = array('point'=>'+='.$data['money']);
}else {
return false;
}
$insertid = self::$db->insert($data,true);
if($insertid &&$data['status'] == 'succ') {
return $member_db->update($sql,array('userid'=>$data['userid'],'username'=>$data['username'])) ?true : false;
}else {
return false;
}
}
}?>