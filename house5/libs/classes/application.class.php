<?php

class application {
public function __construct() {
$param = h5_base::load_sys_class('param');
define('ROUTE_M',$param->route_s('m'));
define('ROUTE_C',$param->route_s('c'));
define('ROUTE_A',$param->route_s('a'));
$this->init();
}
private function init() {
$controller = $this->load_controller();
if (method_exists($controller,ROUTE_A)) {
if (preg_match('/^[_]/i',ROUTE_A)) {
exit('You are visiting the action is to protect the private action');
}else {
call_user_func(array($controller,ROUTE_A));
}
}else {
exit('Action does not exist.');
}
}
private function load_controller($filename = '',$m = '') {
if (empty($filename)) $filename = ROUTE_C;
if (empty($m)) $m = ROUTE_M;
$filepath = H5_PATH.'modules'.DIRECTORY_SEPARATOR.$m.DIRECTORY_SEPARATOR.$filename.'.php';
if (file_exists($filepath)) {
$classname = $filename;
include $filepath;
if ($mypath = h5_base::my_path($filepath)) {
$classname = 'MY_'.$filename;
include $mypath;
}
if(class_exists($classname)){
return new $classname;
}else{
exit('Controller does not exist.');
}
}else {
exit('Controller does not exist.');
}
}
}?>