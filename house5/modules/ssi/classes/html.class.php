<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_sys_func('dir');
class html {
private $siteid,$url,$html_root;
public function __construct() {
define('HTML',true);
self::set_siteid();
$this->html_root = h5_base::load_config('system','html_root');
$this->sitelist = getcache('sitelist','commons');
}
public function ssi($posid=11,$name='') {
if($name==''){$name=$posid;}
$file = HOUSE5_PATH.'/ssi/'.$name.'.html';
$style = $this->sitelist[$siteid]['default_style'];
ob_start();
print_r($file);
include template('ssi','ssi_'.$posid,$style);
return $this->createhtml($file,1);
}
private function createhtml($file,$copyjs = '') {
$data = ob_get_contents();
ob_clean();
$dir = dirname($file);
if(!is_dir($dir)) {
mkdir($dir,0777,1);
}
if ($copyjs &&!file_exists($dir.'/js.html')) {
@copy(H5_PATH.'modules/content/templates/js.html',$dir.'/js.html');
}
$strlen = file_put_contents($file,$data);
@chmod($file,0777);
if(!is_writable($file)) {
$file = str_replace(HOUSE5_PATH,'',$file);
showmessage(L('file').'£º'.$file.'<br>'.L('not_writable'));
}
return $strlen;
}
private function set_siteid() {
if(defined('IN_ADMIN')) {
$this->siteid = $GLOBALS['siteid'] = get_siteid();
}else {
if (param::get_cookie('siteid')) {
$this->siteid = $GLOBALS['siteid'] = param::get_cookie('siteid');
}else {
$this->siteid = $GLOBALS['siteid'] = 1;
}
}
}
}?>