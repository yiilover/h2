<?php

defined('IN_HOUSE5') or exit('No permission resources.');
class spend {
protected static $db;
public static $msg;
protected  static function connect() {
self::$db = h5_base::load_model("pay_spend_model");
}
public static function spend_time($userid,$time,$logo) {
if (empty(self::$db)) {
self::connect();
}
return self::$db->get_one("`userid` = '$userid' AND `creat_at` BETWEEN '$time' AND '".SYS_TIME."' AND `logo` = '$logo'");
}
public static function amount($value,$msg,$userid = '',$username = '',$op_userid = '',$op_username = '',$logo = '') {
return self::_add(array('username'=>$username,'userid'=>$userid,'type'=>1,'value'=>$value,'op_userid'=>$op_userid,'op_username'=>$op_username,'msg'=>$msg,'logo'=>$logo));
}
public static function point($value,$msg,$userid = '',$username = '',$op_userid = '',$op_username = '',$logo = '') {
return self::_add(array('username'=>$username,'userid'=>$userid,'type'=>2,'value'=>$value,'op_userid'=>$op_userid,'op_username'=>$op_username,'msg'=>$msg,'logo'=>$logo));
}
private static function _add($data) {
$data['userid'] = isset($data['userid']) &&intval($data['userid']) ?intval($data['userid']) : 0;
$data['username'] = isset($data['username']) ?trim($data['username']) : '';
$data['op_userid'] = isset($data['op_userid']) &&intval($data['op_userid']) ?intval($data['op_userid']) : 0;
$data['op_username'] = isset($data['op_username']) ?trim($data['op_username']) : '';
$data['type'] = isset($data['type']) &&intval($data['type']) ?intval($data['type']) : 0;
$data['value'] = isset($data['value']) &&intval($data['value']) ?abs(intval($data['value'])) : 0;
$data['msg'] = isset($data['msg']) ?trim($data['msg']) : '';
$data['logo'] = isset($data['logo']) ?trim($data['logo']) : '';
$data['creat_at'] = SYS_TIME;
if (!in_array($data['type'],array(1,2))) {
return false;
}
if (empty($data['msg'])) {
self::$msg = 1;
return false;
}
if (empty($data['value'])) {
self::$msg = 2;
return false;
}
if (empty($data['userid']) ||empty($data['username'])) {
if (defined('IN_ADMIN')) {
self::$msg = 3;
return false;
}elseif (!$data['userid'] = param::get_cookie('_userid') ||!$data['username'] = param::get_cookie('_username')) {
self::$msg = 3;
return false;
}else {
self::$msg = 3;
return false;
}
}
if (defined('IN_ADMIN') &&(empty($data['op_userid']) ||empty($data['op_username']))) {
$data['op_username'] = param::get_cookie('admin_username');
$data['op_userid'] = param::get_cookie('userid');
}
if (empty(self::$db)) {
self::connect();
}
$member_db = h5_base::load_model('member_model');
if (!self::_check_user($data['userid'],$data['type'],$data['value'],$member_db)) {
self::$msg = 6;
return false;
}
$sql = array();
if ($data['type'] == 1) {
$sql = array('amount'=>"-=".$data['value']);
}elseif ($data['type'] == 2) {
$sql = array('point'=>'-='.$data['value']);
}else {
self::$msg = 7;
return false;
}
if ($member_db->update($sql,array('userid'=>$data['userid'],'username'=>$data['username'])) &&self::$db->insert($data)) {
self::$msg = 0;
return true;
}else {
self::$msg = 8;
return false;
}
}
private static function _check_user($userid,$type,$value,&$db) {
if ($user = $db->get_one(array('userid'=>$userid),'`amount`, `point`')) {
if ($type == 1) {
if ($user['amount'] <$value) {
return false;
}else {
return true;
}
}elseif ($type == 2) {
if ($user['point'] <$value) {
return false;
}else {
return true;
}
}else {
return false;
}
}else {
return false;
}
}
public static function get_msg() {
$msg = self::$msg;
$arr = array(
'1'=>L('spend_msg_1','','pay'),
'2'=>L('spend_msg_2','','pay'),
'3'=>L('spend_msg_3','','pay'),
'6'=>L('spend_msg_6','','pay'),
'7'=>L('spend_msg_7','','pay'),
'8'=>L('spend_msg_8','','pay'),
);
return isset($arr[$msg]) ?$arr[$msg] : false;
}
}?>