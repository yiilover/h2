<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
h5_base::load_sys_class('form','',0);
h5_base::load_sys_class('format','',0);
h5_base::load_app_func('global','sms');
class sms extends admin {
function __construct() {
$this->log_db = h5_base::load_model('sms_report_model');
$this->module_db = h5_base::load_model('module_model');
$this->member_db = h5_base::load_model('member_model');
$siteid = get_siteid();
$this->sms_setting_arr = getcache('sms');
if(!empty($this->sms_setting_arr[$siteid])) {
$this->sms_setting = $this->sms_setting_arr[$siteid];
}else {
$this->sms_setting = array('userid'=>'','productid'=>'','sms_key'=>'');
}
h5_base::load_app_class('smsapi','',0);
$this->smsapi = new smsapi($this->sms_setting['userid'],$this->sms_setting['productid'],$this->sms_setting['sms_key']);
}
public function init() {
$show_h5_hash = 1;
$smsprice_arr = $this->smsapi->get_price();
if(CHARSET != 'utf-8') {
if(is_array($smsprice_arr)) {
foreach ($smsprice_arr as $k=>$v) {
$smsprice_arr[$k]['name'] = iconv('utf-8',CHARSET,$smsprice_arr[$k]['name']);
$smsprice_arr[$k]['description'] = iconv('utf-8',CHARSET,$smsprice_arr[$k]['description']);
}
}
}
$smsinfo_arr = $this->smsapi->get_smsinfo();
include $this->admin_tpl('index');
}
public function sms_buy_history() {
$payinfo_arr = $this->smsapi->get_buyhistory();
if(CHARSET != 'utf-8') {
if(is_array($payinfo_arr)) foreach ($payinfo_arr as $k=>$v) {
$payinfo_arr[$k]['name'] = iconv('utf-8',CHARSET,$payinfo_arr[$k]['name']);
$payinfo_arr[$k]['description'] = iconv('utf-8',CHARSET,$payinfo_arr[$k]['description']);
}
}
include $this->admin_tpl('sms_buy_history');
}
public function sms_pay_history() {
$page = isset($_GET['page']) ?intval($_GET['page']) : 1;
$paylist_apiarr = $this->smsapi->get_payhistory($page);
$paylist_arr = !empty($paylist_apiarr['datas']) ?$paylist_apiarr['datas'] : array();
$payhistoryinfo_total = !empty($paylist_apiarr['total']) ?$paylist_apiarr['total'] : 0;
$pages = pages($payhistoryinfo_total,$page,20);
include $this->admin_tpl('sms_pay_history');
}
public function sms_setting() {
$siteid = get_siteid();
if(isset($_POST['dosubmit'])) {
$this->sms_setting_arr[$siteid] = $_POST['setting'];
$setting = array2string($this->sms_setting);
setcache('sms',$this->sms_setting_arr);
$this->module_db->update(array('setting'=>$setting),array('module'=>'sms'));
showmessage(L('operation_success'),HTTP_REFERER);
}else {
$show_h5_hash = '';
include $this->admin_tpl('sms_setting');
}
}
public function sms_api() {
include $this->admin_tpl('sms_api');
}
public function sms_sent() {
if(!$this->sms_setting['sms_enable']) showmessage(L('please_open_sms_platform_status'));
if(empty($this->smsapi->userid)) {
showmessage(L('need_band'),'index.php?s=sms/sms/sms_setting&menuid='.$_GET[menuid].'&h5_hash='.$_SESSION['h5_hash']);
}
if($this->sms_setting['sms_key']) {
$smsinfo = $this->smsapi->get_smsinfo();
}
if(isset($_POST['dosubmit'])) {
$content = $_POST['content'];
$mobile = explode("\r\n",trim($_POST['mobile'],"\r\n"));
$mobile = array_unique($mobile);
foreach ($mobile as $k=>$v) {
if(!preg_match('/^1([0-9]{9})/',$v)) {
unset($mobile[$k]);
}
}
if($smsinfo['surplus'] <count($mobile)) {
showmessage(L('need_more_surplus'));
}
$return = $this->smsapi->send_sms($mobile,$content,$_POST['sendtime'],CHARSET);
showmessage($return,HTTP_REFERER);
}else {
$smsinfo_arr = $this->smsapi->get_smsinfo();
if(!empty($smsinfo_arr['allow_send_ip']) &&!in_array($_SERVER["SERVER_ADDR"],$smsinfo_arr['allow_send_ip'])) {
showmessage(L('this_server_does_not_allow_send_sms'));
}
$start_time = date('Y-m-d',SYS_TIME-date('t',SYS_TIME)*86400);
$end_time = date('Y-m-d',SYS_TIME);
$grouplist = getcache('grouplist','member');
foreach($grouplist as $k=>$v) {
$grouplist[$k] = $v['name'];
}
$modellistarr = getcache('member_model','commons');
foreach ($modellistarr as $k=>$v) {
$modellist[$k] = $v['name'];
}
include $this->admin_tpl('sms_sent');
}
}
public function exportmobile() {
$start_time = isset($_POST['start_time']) ?$_POST['start_time'] : '';
$end_time = isset($_POST['end_time']) ?$_POST['end_time'] : date('Y-m-d',SYS_TIME);
$where_start_time = strtotime($start_time) ?strtotime($start_time) : 0;
$where_end_time = strtotime($end_time) +86400;
$groupid = isset($_POST['groupid']) &&!empty($_POST['groupid']) ?$_POST['groupid'] : '';
$modelid = isset($_POST['modelid']) &&!empty($_POST['modelid']) ?$_POST['modelid'] : 10;
if($where_start_time >$where_end_time) {
$tmp = $where_start_time;
$where_start_time = $where_end_time;
$where_end_time = $tmp;
$tmptime = $start_time;
$start_time = $end_time;
$end_time = $tmptime;
unset($tmp,$tmptime);
}
$where = '';
if($groupid) {
$where .= "`groupid` = '$groupid' AND ";
}
if($modelid) {
$where .= "`modelid` = '$modelid' AND ";
}
$where .= "`regdate` BETWEEN '$where_start_time' AND '$where_end_time'";
$total = $this->member_db->count($where);
$str = '';
$perpage = 10;
for($i=0;$i<=floor($total/$perpage);$i++) {
$start = $i*$perpage;
$data = $this->member_db->select($where,'userid',"$start, $perpage");
$userid_arr = array();
foreach ($data as $v) {
$userid_arr[] = $v['userid'];
}
$uids = to_sqls($userid_arr,'','userid');
$this->member_db->set_model($modelid);
$data = $this->member_db->select($uids);
foreach ($data as $v) {
if(!empty($v['mobile'])) {
$str .= $v['mobile']."\r\n";
}
}
$this->member_db->set_model();
}
header("Content-type:application/octet-stream");
header("Content-Disposition: attachment; filename=mobile.txt");
echo $str;
}
}
?>