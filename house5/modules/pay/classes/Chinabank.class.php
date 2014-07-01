<?php
 
if (isset($set_modules) &&$set_modules == TRUE)
{
$i = isset($modules) ?count($modules) : 0;
$modules[$i]['code']    = basename(__FILE__,'.class.php');
$modules[$i]['name']    = L('chinabank','','pay');
$modules[$i]['desc']    = L('chinabank_tip','','pay');
$modules[$i]['is_cod']  = '0';
$modules[$i]['is_online']  = '1';
$modules[$i]['author']  = 'HOUSE5开发团队';
$modules[$i]['website'] = 'http://www.chinabank.com.cn';
$modules[$i]['version'] = '1.0.0';
$modules[$i]['config']  = array(
array('name'=>'chinabank_account','type'=>'text','value'=>''),
array('name'=>'chinabank_key','type'=>'text','value'=>''),
);
return;
}
h5_base::load_app_class('pay_abstract','','0');
class Chinabank extends paymentabstract{
public function __construct($config = array()) {
if (!empty($config)) $this->set_config($config);
$this->config['gateway_url'] = 'https://pay3.chinabank.com.cn/PayGate';
$this->config['gateway_method'] = 'POST';
$this->config['return_url'] = return_url('chinabank');
h5_base::load_app_func('alipay');
}
public function getpreparedata() {
$prepare_data['v_mid'] = $this->config['chinabank_account'];
$prepare_data['v_url'] = $this->config['return_url'];
$prepare_data['v_moneytype'] = 'CNY';
$prepare_data['return_url'] = $this->config['return_url'];
$prepare_data['v_rcvname'] = $this->product_info['name'];
$prepare_data['v_amount'] = $this->product_info['price'];
$prepare_data['v_oid'] = $this->order_info['id'];
$prepare_data['v_rcvmobile'] = $this->customer_info['telephone'];
$prepare_data['v_rcvemail'] = $this->order_info['buyer_email'];
$prepare_data['remark1'] = $this->product_info['body'];
$data =$prepare_data['v_amount'].$prepare_data['v_moneytype'].$prepare_data['v_oid'].$prepare_data['v_mid'].$prepare_data['v_url'].$this->config['chinabank_key'];
$prepare_data['v_md5info'] = strtoupper(md5($data));
return $prepare_data;
}
public function receive() {
$receive_data = $this->filterParameter($_POST);
$receive_data = arg_sort($receive_data);
if ($receive_data) {
$v_oid     =trim($receive_data['v_oid']);
$v_pmode   =trim($receive_data['v_pmode']);
$v_pstatus =trim($receive_data['v_pstatus']);
$v_pstring =trim($receive_data['v_pstring']);
$v_amount  =trim($receive_data['v_amount']);
$v_moneytype  =trim($receive_data['v_moneytype']);
$remark1   =trim($receive_data['remark1']);
$remark2   =trim($receive_data['remark2']);
$v_md5str  =trim($receive_data['v_md5str']);
$md5string=strtoupper(md5($v_oid.$v_pstatus.$v_amount.$v_moneytype.$this->config['chinabank_key']));
if ($v_md5str==$md5string) {
$return_data['order_id'] = $v_oid;
$return_data['order_total'] = $v_amount;
$return_data['price'] = $v_amount;
if($v_pstatus=="20") {
$return_data['order_status'] = 0;
return $return_data;
}else {
error_log(date('m-d H:i:s',SYS_TIME).'| chinabank GET: order_status=30 |'."\r\n",3,CACHE_PATH.'pay_error_log.php');
return false;
}
}else {
showmessage(L('illegal_sign'));
return false;
}
}else {
error_log(date('m-d H:i:s',SYS_TIME).'| GET: no return |'."\r\n",3,CACHE_PATH.'pay_error_log.php');
showmessage(L('illegal_return'));
return false;
}
}
public function notify() {
$receive_data = $this->filterParameter($_POST);
$receive_data = arg_sort($receive_data);
if ($receive_data) {
$v_oid     =trim($receive_data['v_oid']);
$v_pmode   =trim($receive_data['v_pmode']);
$v_pstatus =trim($receive_data['v_pstatus']);
$v_pstring =trim($receive_data['v_pstring']);
$v_amount  =trim($receive_data['v_amount']);
$v_moneytype  =trim($receive_data['v_moneytype']);
$remark1   =trim($receive_data['remark1']);
$remark2   =trim($receive_data['remark2']);
$v_md5str  =trim($receive_data['v_md5str']);
$md5string=strtoupper(md5($v_oid.$v_pstatus.$v_amount.$v_moneytype.$this->config['chinabank_key']));
if ($v_md5str==$md5string) {
$return_data['order_id'] = $v_oid;
$return_data['order_total'] = $v_amount;
$return_data['price'] = $v_amount;
if($v_pstatus=="20") {
$return_data['order_status'] = 0;
}else {
error_log(date('m-d H:i:s',SYS_TIME).'| chinabank notify: order_status=30 |'."\r\n",3,CACHE_PATH.'pay_error_log.php');
return false;
}
}else {
return false;
}
}else {
error_log(date('m-d H:i:s',SYS_TIME).'| notify: no return |'."\r\n",3,CACHE_PATH.'pay_error_log.php');
return false;
}
}
public function response($result) {
if (FALSE == $result) echo 'ok';
else echo 'success';
}
private function filterParameter($parameter)
{
$para = array();
foreach ($parameter as $key =>$value)
{
if ('sign'== $key ||'sign_type'== $key ||''== $value ||'m'== $key  ||'a'== $key  ||'c'== $key   ||'code'== $key ) continue;
else $para[$key] = $value;
}
return $para;
}
}
?>