<?php
 
define('HOUSE5_PATH',dirname(__FILE__).DIRECTORY_SEPARATOR);
include HOUSE5_PATH.'house5/base.php';
$param = h5_base::load_sys_class('param');
$op = isset($_GET['op']) &&trim($_GET['op']) ?trim($_GET['op']) : exit('Operation can not be empty');
if (isset($_GET['callback']) &&!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]+$/',$_GET['callback']))  unset($_GET['callback']);
if (!preg_match('/([^a-z_]+)/i',$op) &&file_exists(HOUSE5_PATH.'api/'.$op.'.php')) {
include HOUSE5_PATH.'api/'.$op.'.php';
}else {
exit('API handler does not exist');
}
?>