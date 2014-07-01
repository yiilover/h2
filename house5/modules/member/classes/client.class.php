<?php

class client {
private $ps_api_url,$auth_key;
public function __construct($ps_api_url='127.0.0.1',$auth_key='') {
$this->ps_api_url = $ps_api_url;
$this->auth_key = $auth_key;
}
function sys_auth($string,$operation = 'ENCODE',$key = '',$expiry = 0) {
$key_length = 4;
$key = md5($key != ''?$key : $this->auth_key);
$fixedkey = hash('md5',$key);
$egiskeys = md5(substr($fixedkey,16,16));
$runtokey = $key_length ?($operation == 'ENCODE'?substr(hash('md5',microtime(true)),-$key_length) : substr($string,0,$key_length)) : '';
$keys = hash('md5',substr($runtokey,0,16) .substr($fixedkey,0,16) .substr($runtokey,16) .substr($fixedkey,16));
$string = $operation == 'ENCODE'?sprintf('%010d',$expiry ?$expiry +time() : 0).substr(md5($string.$egiskeys),0,16) .$string : base64_decode(substr($string,$key_length));
$i = 0;$result = '';
$string_length = strlen($string);
for ($i = 0;$i <$string_length;$i++){
$result .= chr(ord($string{$i}) ^ord($keys{$i %32}));
}
if($operation == 'ENCODE') {
return $runtokey .str_replace('=','',base64_encode($result));
}else {
if((substr($result,0,10) == 0 ||substr($result,0,10) -time() >0) &&substr($result,10,16) == substr(md5(substr($result,26).$egiskeys),0,16)) {
return substr($result,26);
}else {
return '';
}
}
}
public function ps_getavatar($uid) {
$dir1 = ceil($uid / 10000);
$dir2 = ceil($uid %10000 / 1000);
$url = $this->ps_api_url.'/uploadfile/avatar/'.$dir1.'/'.$dir2.'/'.$uid.'/';
$avatar = array('180'=>$url.'180x180.jpg','90'=>$url.'90x90.jpg','45'=>$url.'45x45.jpg','30'=>$url.'30x30.jpg');
return $avatar;
}
public function ps_deleteavatar($uid) {
if(isset($uid)) {
$this->uid = $uid;
}else {
return 0;
}
$dir1 = ceil($this->uid / 10000);
$dir2 = ceil($this->uid %10000 / 1000);
$avatarfile = h5_base::load_config('system','upload_path').'avatar/';
$dir = $avatarfile.$dir1.'/'.$dir2.'/'.$this->uid.'/';
if(!file_exists($dir)) {
return 1;
}else {
if($handle = opendir($dir)) {
while(false !== ($file = readdir($handle))) {
if($file !== '.'&&$file !== '..') {
@unlink($dir.$file);
}
}
closedir($handle);
@rmdir($dir);
return 1;
}
}
}
public function array2string($data,$isformdata = 1) {
if($data == '') return '';
if($isformdata) $data = new_stripslashes($data);
return var_export($data,TRUE);
}
public function auth_data($data) {
$s = $sep = '';
foreach($data as $k =>$v) {
if(is_array($v)) {
$s2 = $sep2 = '';
foreach($v as $k2 =>$v2) {
$s2 .= "$sep2{$k}[$k2]=".$this->_ps_stripslashes($v2);
$sep2 = '&';
}
$s .= $sep.$s2;
}else {
$s .= "$sep$k=".$this->_ps_stripslashes($v);
}
$sep = '&';
}
$auth_s = '&data='.urlencode($this->sys_auth($s));
return $auth_s;
}
private function _ps_stripslashes($string) {
!defined('MAGIC_QUOTES_GPC') &&define('MAGIC_QUOTES_GPC',get_magic_quotes_gpc());
if(MAGIC_QUOTES_GPC) {
return stripslashes($string);
}else {
return $string;
}
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
private function _is_email($email) {
return strlen($email) >6 &&preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/",$email);
}
}
?>