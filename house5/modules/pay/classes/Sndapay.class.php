<?php
 
if (isset($set_modules) &&$set_modules == TRUE)
{
$i = isset($modules) ?count($modules) : 0;
$modules[$i]['code']    = basename(__FILE__,'.class.php');
$modules[$i]['name']    = L('sndapay','','pay');
$modules[$i]['desc']    = L('sndapay_tip','','pay');
$modules[$i]['is_cod']  = '0';
$modules[$i]['is_online']  = '1';
$modules[$i]['author']  = 'HOUSE5开发团队';
$modules[$i]['website'] = 'http://www.sdo.com';
$modules[$i]['version'] = '1.0.0';
$modules[$i]['config']  = array(
array('name'=>'sndapay_account','type'=>'text','value'=>''),
array('name'=>'sndapay_key','type'=>'text','value'=>''),
);
return;
}
h5_base::load_app_class('pay_abstract','','0');
class Sndapay extends paymentabstract{
public function __construct($config = array()) {
if (!empty($config)) $this->set_config($config);
$this->config['gateway_url'] = 'http://netpay.sdo.com/paygate/default.aspx';
$this->config['gateway_method'] = 'POST';
$this->config['notify_url'] = return_url('sndapay',1);
$this->config['return_url'] = return_url('sndapay');
}
public function getpreparedata() {
$prepare_data['Version'] = '3.0';
$prepare_data['CurrencyType'] = 'RMB';
$prepare_data['NotifyUrlType'] = 'http';
$prepare_data['MerchantNo'] = $this->config['sndapay_account'];
$prepare_data['MerchantUserId'] = '';
$prepare_data['SignType'] = '2';
$prepare_data['NotifyUrl'] = $this->config['notify_url'];
$prepare_data['PostBackUrl'] = $this->config['return_url'];
$prepare_data['BackUrl'] = '';
$prepare_data['PayChannel'] = '';
$prepare_data['DefaultChannel'] = '04';
$prepare_data['ProductDesc'] = $this->product_info['name'];
$prepare_data['Amount'] = $this->product_info['price'];
$prepare_data['ProductNo'] = '';
$prepare_data['ProductUrl'] = '';
$prepare_data['OrderNo'] = $this->order_info['id'];
$prepare_data['OrderTime'] = date('YmdHis',$this->order_info['order_time']);
$prepare_data['Remark1'] = $this->product_info['body'];
$data = $prepare_data['Version'].$prepare_data['Amount'].$prepare_data['OrderNo'].$prepare_data['MerchantNo'].$prepare_data['MerchantUserId'].$prepare_data['PayChannel'].$prepare_data['PostBackUrl'].$prepare_data['NotifyUrl'].$prepare_data['BackUrl'].$prepare_data['OrderTime'].$prepare_data['CurrencyType'].$prepare_data['NotifyUrlType'].$prepare_data['SignType'].$prepare_data['ProductNo'].$prepare_data['ProductDesc'].$prepare_data['Remark1'].$prepare_data['DefaultChannel'].$prepare_data['ProductUrl'];
$prepare_data['MAC'] = md5($data.$this->config['sndapay_key']);
return $prepare_data;
}
public function receive() {
$amount=$_POST["Amount"];
$payamount=$_POST["PayAmount"];
$orderid=$_POST["OrderNo"];
$serialno=$_POST["serialno"];
$status=$_POST["Status"];
$merid=$_POST["MerchantNo"];
$paychannel=$_POST["PayChannel"];
$discount=$_POST["Discount"];
$signtype=$_POST["SignType"];
$paytime=$_POST["PayTime"];
$ctype=$_POST["CurrencyType"];
$prono=$_POST["ProductNo"];
$prodesc=$_POST["ProductDesc"];
$remark1=$_POST["Remark1"];
$remark2=$_POST["Remark2"];
$ex=$_POST["ExInfo"];
$mac=$_POST["MAC"];
$signString=$amount."|".$payamount."|".$orderid."|".$serialno."|".$status."|".$merid."|".$paychannel."|".$discount."|".$signtype."|".$paytime."|".$ctype."|".$prono."|".$prodesc."|".$remark1."|".$remark2."|".$ex;
if($signtype=="2") {
$md5key=$this->config['sndapay_key'];
$mac2 =md5($signString."|".$md5key);
$ok = (strtoupper($mac)==strtoupper($mac2));
}
if ($ok == 1) {
$return_data['order_id'] = $orderid;
$return_data['order_total'] = $amount;
$return_data['price'] = $payamount;
$return_data['order_status'] = 0;
return $return_data;
}elseif ($ok == 0) {
showmessage(L('illegal_notice'));
return false;
}else {
error_log(date('m-d H:i:s',SYS_TIME).'| GET: illegality notice : flase |'."\r\n",3,CACHE_PATH.'pay_error_log.php');
showmessage(L('illegal_sign'));
return false;
}
}
public function notify() {
$amount=$_POST["Amount"];
$payamount=$_POST["PayAmount"];
$orderid=$_POST["OrderNo"];
$serialno=$_POST["serialno"];
$status=$_POST["Status"];
$merid=$_POST["MerchantNo"];
$paychannel=$_POST["PayChannel"];
$discount=$_POST["Discount"];
$signtype=$_POST["SignType"];
$paytime=$_POST["PayTime"];
$ctype=$_POST["CurrencyType"];
$prono=$_POST["ProductNo"];
$prodesc=$_POST["ProductDesc"];
$remark1=$_POST["Remark1"];
$remark2=$_POST["Remark2"];
$ex=$_POST["ExInfo"];
$mac=$_POST["MAC"];
$signString=$amount."|".$payamount."|".$orderid."|".$serialno."|".$status."|".$merid."|".$paychannel."|".$discount."|".$signtype."|".$paytime."|".$ctype."|".$prono."|".$prodesc."|".$remark1."|".$remark2."|".$ex;
if($signtype=="2") {
$md5key=$this->config['sndapay_key'];
$mac2 =md5($signString."|".$md5key);
$ok = (strtoupper($mac)==strtoupper($mac2));
}
if ($ok == 1) {
$return_data['order_id'] = $orderid;
$return_data['order_total'] = $amount;
$return_data['price'] = $payamount;
$return_data['order_status'] = 0;
return $return_data;
}elseif ($ok == 0) {
return false;
}else {
error_log(date('m-d H:i:s',SYS_TIME).'| POST: illegality notice : flase |'."\r\n",3,CACHE_PATH.'pay_error_log.php');
return false;
}
}
public function response($result) {
if (FALSE == $result) echo 'bad';
else echo 'ok';
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