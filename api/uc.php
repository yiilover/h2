<?php

error_reporting(0);
define('HOUSE5_PATH',dirname(__FILE__).'/../');
include HOUSE5_PATH.'/house5/base.php';
define('UC_KEY',h5_base::load_config('uc','uc_key'));
define('UC_CLIENT_VERSION','1.6.0');
define('UC_CLIENT_RELEASE','20110501');
define('API_RETURN_SUCCEED','1');
define('API_RETURN_FAILED','-1');
define('API_UPDATEAPPS',1);
define('API_RETURN_FORBIDDEN','-2');
define('UC_CLIENT_ROOT','./uc_client');
$get = $post = array();
$code = @$_GET['code'];
parse_str(authcode($code,'DECODE',UC_KEY),$get);
if(SYS_TIME -$get['time'] >3600) exit('Authracation has expiried');
if(empty($get)) exit('Invalid Request');
include dirname(__FILE__).'/uc_client/lib/xml.class.php';
$post = xml_unserialize(file_get_contents('php://input'));
$action = $get['action'];
if(in_array($get['action'],array('test','deleteuser','renameuser','gettag','synlogin','synlogout','updatepw','updatebadwords','updatehosts','updateapps','updateclient','updatecredit','getcreditsettings','updatecreditsettings'))) {
$uc_note = new uc_note();
header('Content-type: text/html; charset='.h5_base::load_config('system','charset'));
echo $uc_note->$get['action']($get,$post);
exit();
}else {
exit(API_RETURN_FAILED);
}
class uc_note {
var $dbconfig = '';
var $db = '';
var $tablepre = '';
var $appdir = '';
public function test() {
return API_RETURN_SUCCEED;
}
public function deleteuser($get,$post) {
h5_base::load_app_func('global','admin');
h5_base::load_app_class('messagequeue','admin',0);
$ids = new_stripslashes($get['ids']);
$ids = array_map('intval',explode(',',$ids));
$ids = implode(',',$ids);
$s = $this->member_db->select("ucuserid in ($ids)","uid");
$this->member_db->delete("ucuserid in ($ids)");
$noticedata['uids'] = array();
if ($s) {
foreach ($s as $key=>$v) {
$noticedata['uids'][$key] = $v['uid'];
}
}else {
return API_RETURN_FAILED;
}
messagequeue::add('member_delete',$noticedata);
return API_RETURN_SUCCEED;
}
public function updatepw($get,$post) {
$username = $get['username'];
$r = $this->uc_db->get_one(array('username'=>$username));
if ($r) {
$this->member_db->update(array('password'=>$r['password'],'random'=>$r['salt']),array('username'=>$username));
}
return API_RETURN_SUCCEED;
}
public function renameuser($get,$post) {
return API_RETURN_SUCCEED;
}
public function synlogin($get,$post) {
header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
$uid = intval($get['uid']);
$username = $get['username'];
if (empty($uid)) return API_RETURN_FAILED;
$member_db = h5_base::load_model('member_model');
$data = $member_db->get_one(array('username'=>$username));
if(is_array($data))
{
$_cookietime = 31536000;
$cookietime = $_cookietime ?SYS_TIME +$_cookietime : 0;
$userid = $data['userid'];
$password = $data['password'];
$nickname = $data['nickname'];
$house5_auth_key = md5(h5_base::load_config('system','auth_key').$_SERVER['HTTP_USER_AGENT']);
$house5_auth = sys_auth($userid."\t".$password,'ENCODE',$house5_auth_key);
h5_base::load_sys_class('param','',0);
param::set_cookie('auth',$house5_auth,$cookietime);
param::set_cookie('_userid',$userid,$cookietime);
param::set_cookie('_username',$username,$cookietime);
param::set_cookie('_groupid',$groupid,$cookietime);
param::set_cookie('_nickname',$nickname,$cookietime);
}
}
public function synlogout($get,$post) {
header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');
h5_base::load_sys_class('param','',0);
param::set_cookie('auth','');
param::set_cookie('_userid','');
param::set_cookie('_username','');
param::set_cookie('_groupid','');
param::set_cookie('_nickname','');
param::set_cookie('cookietime','');
}
public function updateapps($get,$post) {
if(!API_UPDATEAPPS)
{
return API_RETURN_FORBIDDEN;
}
$UC_API = $post['UC_API'];
$cachefile = UC_CLIENT_ROOT.'/data/cache/apps.php';
$fp = fopen($cachefile,'w');
$s = "<?php\r\n";
$s .= '$_CACHE[\'apps\'] = '.var_export($post,TRUE).";\r\n";
fwrite($fp,$s);
fclose($fp);
return API_RETURN_SUCCEED;
}
}
function authcode($string,$operation = 'DECODE',$key = '',$expiry = 0) {
$ckey_length = 4;
$key = md5($key ?$key : UC_KEY);
$keya = md5(substr($key,0,16));
$keyb = md5(substr($key,16,16));
$keyc = $ckey_length ?($operation == 'DECODE'?substr($string,0,$ckey_length): substr(md5(microtime()),-$ckey_length)) : '';
$cryptkey = $keya.md5($keya.$keyc);
$key_length = strlen($cryptkey);
$string = $operation == 'DECODE'?base64_decode(substr($string,$ckey_length)) : sprintf('%010d',$expiry ?$expiry +time() : 0).substr(md5($string.$keyb),0,16).$string;
$string_length = strlen($string);
$result = '';
$box = range(0,255);
$rndkey = array();
for($i = 0;$i <= 255;$i++) {
$rndkey[$i] = ord($cryptkey[$i %$key_length]);
}
for($j = $i = 0;$i <256;$i++) {
$j = ($j +$box[$i] +$rndkey[$i]) %256;
$tmp = $box[$i];
$box[$i] = $box[$j];
$box[$j] = $tmp;
}
for($a = $j = $i = 0;$i <$string_length;$i++) {
$a = ($a +1) %256;
$j = ($j +$box[$a]) %256;
$tmp = $box[$a];
$box[$a] = $box[$j];
$box[$j] = $tmp;
$result .= chr(ord($string[$i]) ^($box[($box[$a] +$box[$j]) %256]));
}
if($operation == 'DECODE') {
if((substr($result,0,10) == 0 ||substr($result,0,10) -time() >0) &&substr($result,10,16) == substr(md5(substr($result,26).$keyb),0,16)) {
return substr($result,26);
}else {
return '';
}
}else {
return $keyc.str_replace('=','',base64_encode($result));
}
}
function uc_serialize($arr,$htmlon = 0) {
include_once UC_CLIENT_ROOT.'./lib/xml.class.php';
return xml_serialize($arr,$htmlon);
}
function uc_unserialize($s) {
include_once UC_CLIENT_ROOT.'./lib/xml.class.php';
return xml_unserialize($s);
}
?>