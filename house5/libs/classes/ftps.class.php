<?php

class ftps {
private $link;
public $link_time;
private $err_code = 0;
public $mode = FTP_BINARY;
public function connect($host,$username = '',$password = '',$port = '21',$pasv = false,$ssl = false,$timeout = 30) {
$start = time();
if ($ssl) {
if (!$this->link = @ftp_ssl_connect($host,$port,$timeout)) {
$this->err_code = 1;
return false;
}
}else {
if (!$this->link = @ftp_connect($host,$port,$timeout)) {
$this->err_code = 1;
return false;
}
}
if (@ftp_login($this->link,$username,$password)) {
if ($pasv) ftp_pasv($this->link,true);
$this->link_time = time()-$start;
return true;
}else {
$this->err_code = 1;
return false;
}
register_shutdown_function(array(&$this,'close'));
}
public function mkdir($dirname) {
if (!$this->link) {
$this->err_code = 2;
return false;
}
$dirname = $this->ck_dirname($dirname);
$nowdir = '/';
foreach ($dirname as $v) {
if ($v &&!$this->chdir($nowdir.$v)) {
if ($nowdir) $this->chdir($nowdir);
@ftp_mkdir($this->link,$v);
}
if($v) $nowdir .= $v.'/';
}
return true;
}
public function put($remote,$local) {
if (!$this->link) {
$this->err_code = 2;
return false;
}
$dirname = pathinfo($remote,PATHINFO_DIRNAME);
if (!$this->chdir($dirname)) {
$this->mkdir($dirname);
}
if (@ftp_put($this->link,$remote,$local,$this->mode)) {
return true;
}else {
$this->err_code = 7;
return false;
}
}
public function rmdir($dirname,$enforce = false) {
if (!$this->link) {
$this->err_code = 2;
return false;
}
$list = $this->nlist($dirname);
if ($list &&$enforce) {
$this->chdir($dirname);
foreach ($list as $v) {
$this->f_delete($v);
}
}elseif ($list &&!$enforce) {
$this->err_code = 3;
return false;
}
@ftp_rmdir($this->link,$dirname);
return true;
}
public function f_delete($filename) {
if (!$this->link) {
$this->err_code = 2;
return false;
}
if (@ftp_delete($this->link,$filename)) {
return true;
}else {
$this->err_code = 4;
return false;
}
}
public function nlist($dirname) {
if (!$this->link) {
$this->err_code = 2;
return false;
}
if ($list = @ftp_nlist($this->link,$dirname)) {
return $list;
}else {
$this->err_code = 5;
return false;
}
}
public function chdir($dirname) {
if (!$this->link) {
$this->err_code = 2;
return false;
}
if (@ftp_chdir($this->link,$dirname)) {
return true;
}else {
$this->err_code = 6;
return false;
}
}
public function get_error() {
if (!$this->err_code) return false;
$err_msg = array(
'1'=>'Server can not connect',
'2'=>'Not connect to server',
'3'=>'Can not delete non-empty folder',
'4'=>'Can not delete file',
'5'=>'Can not get file list',
'6'=>'Can not change the current directory on the server',
'7'=>'Can not upload files'
);
return $err_msg[$this->err_code];
}
private function ck_dirname($url) {
$url = str_replace('\\','/',$url);
$urls = explode('/',$url);
return $urls;
}
public function close() {
return @ftp_close($this->link);
}
}?>