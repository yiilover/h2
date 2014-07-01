<?php

class param {
private $route_config = '';
public function __construct() {
if(!get_magic_quotes_gpc()) {
$_POST = new_addslashes($_POST);
$_GET = new_addslashes($_GET);
$_REQUEST = new_addslashes($_REQUEST);
$_COOKIE = new_addslashes($_COOKIE);
}
$this->route_config = h5_base::load_config('route',SITE_URL) ?h5_base::load_config('route',SITE_URL) : h5_base::load_config('route','default');
if(isset($this->route_config['data']['POST']) &&is_array($this->route_config['data']['POST'])) {
foreach($this->route_config['data']['POST'] as $_key =>$_value) {
if(!isset($_POST[$_key])) $_POST[$_key] = $_value;
}
}
if(isset($this->route_config['data']['GET']) &&is_array($this->route_config['data']['GET'])) {
foreach($this->route_config['data']['GET'] as $_key =>$_value) {
if(!isset($_GET[$_key])) $_GET[$_key] = $_value;
}
}
if(isset($_GET['page'])) {
$_GET['page'] = max(intval($_GET['page']),1);
$_GET['page'] = min($_GET['page'],1000000000);
}
return true;
}
public function route_s($f) {
$s = isset($_GET['s']) &&!empty($_GET['s']) ?$_GET['s'] : (isset($_POST['s']) &&!empty($_POST['s']) ?$_POST['s'] : '');
$str = explode("/",$s);
$num = count($str);
if($f=='m')
{
if(empty($s))
{
return 'content';
}
return $str[0];
}
if($f=='c')
{
if(empty($s))
{
return 'index';
}
if($num>1&&!empty($str[1]))
{
return $str[1];
}
else
{
return 'index';
}
}
if($f=='a')
{
if($num>3&&!empty($str[3]))
{
for($i=3;$i<$num;$i=$i+2)
{
$_GET[$str[$i]] = $str[$i+1];
}
}
if($num>2&&!empty($str[2]))
{
return $str[2];
}
else
{
return 'init';
}
}
}
public function route_m() {
$m = isset($_GET['m']) &&!empty($_GET['m']) ?$_GET['m'] : (isset($_POST['m']) &&!empty($_POST['m']) ?$_POST['m'] : '');
$m = $this->safe_deal($m);
if (empty($m)) {
return $this->route_config['m'];
}else {
return $m;
}
}
public function route_c() {
$c = isset($_GET['c']) &&!empty($_GET['c']) ?$_GET['c'] : (isset($_POST['c']) &&!empty($_POST['c']) ?$_POST['c'] : '');
$c = $this->safe_deal($c);
if (empty($c)) {
return $this->route_config['c'];
}else {
return $c;
}
}
public function route_a() {
$a = isset($_GET['a']) &&!empty($_GET['a']) ?$_GET['a'] : (isset($_POST['a']) &&!empty($_POST['a']) ?$_POST['a'] : '');
$a = $this->safe_deal($a);
if (empty($a)) {
return $this->route_config['a'];
}else {
return $a;
}
}
public static function set_cookie($var,$value = '',$time = 0) {
$time = $time >0 ?$time : ($value == ''?SYS_TIME -3600 : 0);
$s = $_SERVER['SERVER_PORT'] == '443'?1 : 0;
$var = h5_base::load_config('system','cookie_pre').$var;
$_COOKIE[$var] = $value;
if (is_array($value)) {
foreach($value as $k=>$v) {
setcookie($var.'['.$k.']',sys_auth($v,'ENCODE'),$time,h5_base::load_config('system','cookie_path'),h5_base::load_config('system','cookie_domain'),$s);
}
}else {
setcookie($var,sys_auth($value,'ENCODE'),$time,h5_base::load_config('system','cookie_path'),h5_base::load_config('system','cookie_domain'),$s);
}
}
public static function get_cookie($var,$default = '') {
$var = h5_base::load_config('system','cookie_pre').$var;
return isset($_COOKIE[$var]) ?sys_auth($_COOKIE[$var],'DECODE') : $default;
}
private function safe_deal($str) {
return str_replace(array('/','.'),'',$str);
}
}
?>