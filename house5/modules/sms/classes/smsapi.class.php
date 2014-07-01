<?php
 
class smsapi {
public $userid;
public $statuscode;
private $productid,$sms_key,$smsapi_url;
public function __construct($userid = '',$productid = '',$sms_key = '') {
$this->smsapi_url = 'http://sms.phpcms.cn/api.php?';
$this->userid = $userid;
$this->productid = $productid;
$this->sms_key = $sms_key;
}
public function get_price() {
$this->param = array('op'=>'sms_get_productlist');
$res = $this->h5_file_get_contents();
return !empty($res) ?json_decode($res,1) : array();
}
public function get_buyurl($productid = 0) {
return 'http://sms.phpcms.cn/index.php?s=sms_service/center/buy&sms_pid='.$this->productid.'&productid='.$productid;
}
public function get_smsinfo() {
$this->param = array('op'=>'sms_get_info');
$res = $this->h5_file_get_contents();
return !empty($res) ?json_decode($res,1) : array();
}
public function get_buyhistory() {
$this->param = array('op'=>'sms_get_paylist');
$res = $this->h5_file_get_contents();
return !empty($res) ?json_decode($res,1) : array();
}
public function get_payhistory($page=1) {
$this->param = array('op'=>'sms_get_report','page'=>$page);
$res = $this->h5_file_get_contents();
return !empty($res) ?json_decode($res,1) : array();
}
public function send_sms($mobile='',$content='',$send_time='',$charset='gbk',$id_code = '') {
$status = $this->_sms_status();
if(is_array($mobile)){
$mobile = implode(",",$mobile);
}
$content = safe_replace($content);
if(strtolower($charset)=='utf-8') {
$content = iconv('utf-8','gbk',$content);
}
$send_time = strtotime($send_time);
$data = array(
'sms_pid'=>$this->productid,
'sms_passwd'=>$this->sms_key,
'sms_uid'=>$this->userid,
'charset'=>CHARSET,
'send_txt'=>urlencode($content),
'mobile'=>$mobile,
'send_time'=>$send_time,
);
$post = '';
foreach($data as $k=>$v) {
$post .= $k.'='.$v.'&';
}
$smsapi_senturl = $this->smsapi_url.'op=sms_service';
$return = $this->_post($smsapi_senturl,0,$post);
$arr = explode('#',$return);
$this->statuscode = $arr[0];
$sms_report_db = h5_base::load_model('sms_report_model');
$send_userid = param::get_cookie('_userid') ?intval(param::get_cookie('_userid')) : 0;
$ip = ip();
if(isset($this->statuscode)) {
$sms_report_db->insert(array('mobile'=>$mobile,'posttime'=>SYS_TIME,'id_code'=>$id_code,'send_userid'=>$send_userid,'status'=>$this->statuscode,'msg'=>$content,'return_id'=>$return,'ip'=>$ip));
}else {
$sms_report_db->insert(array('mobile'=>$mobile,'posttime'=>SYS_TIME,'send_userid'=>$send_userid,'status'=>'-2','msg'=>$content,'ip'=>$ip));
}
return isset($status[$arr[0]]) ?$status[$arr[0]] : '-2';
}
public function h5_file_get_contents($timeout=30) {
$this->setting = array(
'sms_uid'=>$this->userid,
'sms_pid'=>$this->productid,
'sms_passwd'=>$this->sms_key,
);
$this->param = array_merge($this->param,$this->setting);
$url = $this->smsapi_url.http_build_query($this->param);
$stream = stream_context_create(array('http'=>array('timeout'=>$timeout)));
return @file_get_contents($url,0,$stream);
}
private function _post($url,$limit = 0,$post = '',$cookie = '',$ip = '',$timeout = 15,$block = true) {
$return = '';
$matches = parse_url($url);
$host = $matches['host'];
$path = $matches['path'] ?$matches['path'].($matches['query'] ?'?'.$matches['query'] : '') : '/';
$port = !empty($matches['port']) ?$matches['port'] : 80;
$siteurl = $this->_get_url();
if($post) {
$out = "POST $path HTTP/1.1\r\n";
$out .= "Accept: */*\r\n";
$out .= "Referer: ".$siteurl."\r\n";
$out .= "Accept-Language: zh-cn\r\n";
$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
$out .= "Host: $host\r\n";
$out .= 'Content-Length: '.strlen($post)."\r\n";
$out .= "Connection: Close\r\n";
$out .= "Cache-Control: no-cache\r\n";
$out .= "Cookie: $cookie\r\n\r\n";
$out .= $post ;
}else {
$out = "GET $path HTTP/1.1\r\n";
$out .= "Accept: */*\r\n";
$out .= "Referer: ".$siteurl."\r\n";
$out .= "Accept-Language: zh-cn\r\n";
$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
$out .= "Host: $host\r\n";
$out .= "Connection: Close\r\n";
$out .= "Cookie: $cookie\r\n\r\n";
}
$fp = @stream_socket_client("tcp://".($ip ?$ip : $host).":".$port,$errno,$errstr,$timeout);
if(!$fp) return '';
stream_set_blocking($fp,$block);
stream_set_timeout($fp,$timeout);
@fwrite($fp,$out);
$status = stream_get_meta_data($fp);
if($status['timed_out']) return '';
while (!feof($fp)) {
if(($header = @fgets($fp)) &&($header == "\r\n"||$header == "\n"))  break;
}
$stop = false;
while(!feof($fp) &&!$stop) {
$data = fread($fp,($limit == 0 ||$limit >8192 ?8192 : $limit));
$return .= $data;
if($limit) {
$limit -= strlen($data);
$stop = $limit <= 0;
}
}
@fclose($fp);
$return_arr = explode("\n",$return);
if(isset($return_arr[1])) {
$return = trim($return_arr[1]);
}
unset($return_arr);
return $return;
}
private function _get_url() {
$sys_protocal = isset($_SERVER['SERVER_PORT']) &&$_SERVER['SERVER_PORT'] == '443'?'https://': 'http://';
$php_self = $_SERVER['PHP_SELF'] ?$this->_safe_replace($_SERVER['PHP_SELF']) : $this->_safe_replace($_SERVER['SCRIPT_NAME']);
$path_info = isset($_SERVER['PATH_INFO']) ?$this->_safe_replace($_SERVER['PATH_INFO']) : '';
$relate_url = isset($_SERVER['REQUEST_URI']) ?$this->_safe_replace($_SERVER['REQUEST_URI']) : $php_self.(isset($_SERVER['QUERY_STRING']) ?'?'.$this->_safe_replace($_SERVER['QUERY_STRING']) : $path_info);
return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ?$_SERVER['HTTP_HOST'] : '').$relate_url;
}
private function _safe_replace($string) {
$string = str_replace('%20','',$string);
$string = str_replace('%27','',$string);
$string = str_replace('%2527','',$string);
$string = str_replace('*','',$string);
$string = str_replace('"','&quot;',$string);
$string = str_replace("'",'',$string);
$string = str_replace('"','',$string);
$string = str_replace(';','',$string);
$string = str_replace('<','&lt;',$string);
$string = str_replace('>','&gt;',$string);
$string = str_replace("{",'',$string);
$string = str_replace('}','',$string);
$string = str_replace('\\','',$string);
return $string;
}
private function _sms_status() {
h5_base::load_app_func('global','sms');
return sms_status(0,1);
}
}
?>