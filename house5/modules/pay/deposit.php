<?php
 
defined('IN_HOUSE5') or exit('No permission resources.');
$session_storage = 'session_'.h5_base::load_config('system','session_storage');
h5_base::load_sys_class($session_storage);
h5_base::load_app_class('foreground','member');
h5_base::load_sys_class('format','',0);
h5_base::load_sys_class('form','',0);
h5_base::load_app_func('global');
class deposit extends foreground {
private $pay_db,$member_db,$account_db;
function __construct() {
if (!module_exists(ROUTE_M)) showmessage(L('module_not_exists'));
parent::__construct();
$this->pay_db = h5_base::load_model('pay_payment_model');
$this->account_db = h5_base::load_model('pay_account_model');
$this->_username = param::get_cookie('_username');
$this->_userid = intval(param::get_cookie('_userid'));
$this->handle = h5_base::load_app_class('pay_deposit');
}
public function init() {
$memberinfo = $this->memberinfo;
$grouplist = getcache('grouplist','member');
$memberinfo['groupname'] = $grouplist[$memberinfo[groupid]]['name'];
$memberinfo['groupicon'] = $grouplist[$memberinfo[groupid]]['icon'];
h5_base::load_app_class('pay_factory','',0);
$where = '';
$page = $_GET['page'] ?intval($_GET['page']) : '1';
$type = $_GET['type'] ?intval($_GET['type']) : '0';
$where = "AND `userid` = '$this->_userid'";
$start = $end = $status = '';
$now = time();
$status = $_GET['info']['status'];
if($type==0)
{
$today = mktime(0,0,0,date('m'),date('d'),date('Y'));
$where.= "AND `addtime` > $today";
}
elseif($type==1)
{
$time = strtotime('-2 day',$now);
$start = strtotime(date('Y-m-d 00:00:00',$time));
$end = strtotime(date('Y-m-d 23:59:59',$now));
$where.=" AND `addtime` >= '$start' AND  `addtime` <= '$end'";
}
elseif($type==2)
{
$time = strtotime('-6 day',$now);
$start = strtotime(date('Y-m-d 00:00:00',$time));
$end = strtotime(date('Y-m-d 23:59:59',$now));
$where.=" AND `addtime` >= '$start' AND  `addtime` <= '$end'";
}
elseif($type==3)
{
$time = strtotime('-14 day',$now);
$start = strtotime(date('Y-m-d 00:00:00',$time));
$end = strtotime(date('Y-m-d 23:59:59',$now));
$where.=" AND `addtime` >= '$start' AND  `addtime` <= '$end'";
}
elseif($type==4)
{
$time = strtotime('-29 day',$now);
$start = strtotime(date('Y-m-d 00:00:00',$time));
$end = strtotime(date('Y-m-d 23:59:59',$now));
$where.=" AND `addtime` >= '$start' AND  `addtime` <= '$end'";
}
elseif($type==4)
{
$time = strtotime('-59 day',$now);
$start = strtotime(date('Y-m-d 00:00:00',$time));
$end = strtotime(date('Y-m-d 23:59:59',$now));
$where.=" AND `addtime` >= '$start' AND  `addtime` <= '$end'";
}
if($status) $where .= "AND `status` LIKE '%$status%' ";
if($where) $where = substr($where,3);
$infos = $this->account_db->listinfo($where,'addtime DESC',$page,'15');
if (is_array($infos) &&!empty($infos)) {
foreach($infos as $key=>$info) {
if($info['status']=='unpay'&&$info['pay_id']!= 0 &&$info['pay_id']) {
$payment = $this->handle->get_payment($info['pay_id']);
$cfg = unserialize_config($payment['config']);
$pay_name = ucwords($payment['pay_code']);
$pay_fee = pay_fee($info['money'],$payment['pay_fee'],$payment['pay_method']);
$logistics_fee = $info['logistics_fee'];
$discount = $info['discount'];
$info['price'] = $info['money'] +$pay_fee +$logistics_fee +$discount;
$order_info['id']	= $info['trade_sn'];
$order_info['quantity']	= $info['quantity'];
$order_info['buyer_email']	= $info['email'];
$order_info['order_time']	= $info['addtime'];
$product_info['name'] = $info['contactname'];
$product_info['body'] = $info['usernote'];
$product_info['price'] = $info['price'];
$customerinfo['telephone'] = $info['telephone'];
if($payment['is_online'] === '1') {
$payment_handler = new pay_factory($pay_name,$cfg);
$payment_handler->set_productinfo($product_info)->set_orderinfo($order_info)->set_customerinfo($customer_info);
$infos[$key]['pay_btn'] = $payment_handler->get_code('value="'.L('pay_btn').'" class="pay-btn"');
}
}else {
$infos[$key]['pay_btn'] = '';
}
}
}
foreach(L('select') as $key=>$value) {
$trade_status[$key] = $value;
}
$pages = $this->account_db->pages;
include template('pay','pay_list');
}
public function pay() {
$memberinfo = $this->memberinfo;
$pay_types = $this->handle->get_paytype();
$trade_sn = create_sn();
param::set_cookie('trade_sn',$trade_sn);
$show_validator = 1;
include template('pay','deposit');
}
public function pay_recharge() {
if(isset($_POST['dosubmit'])) {
$code = isset($_POST['code']) &&trim($_POST['code']) ?trim($_POST['code']) : showmessage(L('input_code'),HTTP_REFERER);
if ($_SESSION['code'] != strtolower($code)) {
showmessage(L('code_error'),HTTP_REFERER);
}
$pay_id = $_POST['pay_type'];
if(!$pay_id) showmessage(L('illegal_pay_method'));
$_POST['info']['name'] = safe_replace($_POST['info']['name']);
$payment = $this->handle->get_payment($pay_id);
$cfg = unserialize_config($payment['config']);
$pay_name = ucwords($payment['pay_code']);
if(!param::get_cookie('trade_sn')) {showmessage(L('illegal_creat_sn'));}
$trade_sn	= param::get_cookie('trade_sn');
if(preg_match('![^a-zA-Z0-9/+=]!',$trade_sn)) showmessage(L('illegal_creat_sn'));
$usernote = $_POST['info']['usernote'] ?$_POST['info']['name'].'['.$trade_sn.']'.'-'.new_html_special_chars(trim($_POST['info']['usernote'])) : $_POST['info']['name'].'['.$trade_sn.']';
$surplus = array(
'userid'=>$this->_userid,
'username'=>$this->_username,
'money'=>trim(floatval($_POST['info']['price'])),
'quantity'=>$_POST['quantity'] ?trim(intval($_POST['quantity'])) : 1,
'telephone'=>preg_match('/[^0-9\-]+/',$_POST['info']['telephone']) ?'': trim($_POST['info']['telephone']),
'contactname'=>$_POST['info']['name'] ?trim($_POST['info']['name']).L('recharge') : $this->_username.L('recharge'),
'email'=>is_email($_POST['info']['email']) ?trim($_POST['info']['email']) : '',
'addtime'=>SYS_TIME,
'ip'=>ip(),
'pay_type'=>'recharge',
'pay_id'=>$payment['pay_id'],
'payment'=>trim($payment['pay_name']),
'ispay'=>'1',
'usernote'=>$usernote,
'trade_sn'=>$trade_sn,
);
$recordid = $this->handle->set_record($surplus);
$factory_info = $this->handle->get_record($recordid);
if(!$factory_info) showmessage(L('order_closed_or_finish'));
$pay_fee = pay_fee($factory_info['money'],$payment['pay_fee'],$payment['pay_method']);
$logistics_fee = $factory_info['logistics_fee'];
$discount = $factory_info['discount'];
$factory_info['price'] = $factory_info['money'] +$pay_fee +$logistics_fee +$discount;
$order_info['id']	= $factory_info['trade_sn'];
$order_info['quantity']	= $factory_info['quantity'];
$order_info['buyer_email']	= $factory_info['email'];
$order_info['order_time']	= $factory_info['addtime'];
$product_info['name'] = $factory_info['contactname'];
$product_info['body'] = $factory_info['usernote'];
$product_info['price'] = $factory_info['price'];
$customerinfo['telephone'] = $factory_info['telephone'];
if($payment['is_online'] === '1') {
h5_base::load_app_class('pay_factory','',0);
$payment_handler = new pay_factory($pay_name,$cfg);
$payment_handler->set_productinfo($product_info)->set_orderinfo($order_info)->set_customerinfo($customer_info);
$code = $payment_handler->get_code('value="'.L('confirm_pay').'" class="button"');
}else {
$this->account_db->update(array('status'=>'waitting','pay_type'=>'offline'),array('id'=>$recordid));
$code = '<div class="point">'.L('pay_tip').'</div>';
}
}
include template('pay','payment_cofirm');
}
public function public_checkcode() {
$code = $_GET['code'];
if($_SESSION['code'] != strtolower($code)) {
exit('0');
}else {
exit('1');
}
}
}
?>