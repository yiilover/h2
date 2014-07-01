<?php

defined('IN_HOUSE5') or exit('No permission resources.');
define('MODEL_PATH',H5_PATH.'modules'.DIRECTORY_SEPARATOR.'formguide'.DIRECTORY_SEPARATOR.'fields'.DIRECTORY_SEPARATOR);
define('CACHE_MODEL_PATH',HOUSE5_PATH.'caches'.DIRECTORY_SEPARATOR.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
class formguide {
public function __construct() {
}
public function public_cache() {
require MODEL_PATH.'fields.inc.php';
$classtypes = array('form','input','update','output');
foreach($classtypes as $classtype) {
$cache_data = file_get_contents(MODEL_PATH.'formguide_'.$classtype.'.class.php');
$cache_data = str_replace('}?>','',$cache_data);
foreach($fields as $field=>$fieldvalue) {
if(file_exists(MODEL_PATH.$field.DIRECTORY_SEPARATOR.$classtype.'.inc.php')) {
$cache_data .= file_get_contents(MODEL_PATH.$field.DIRECTORY_SEPARATOR.$classtype.'.inc.php');
}
}
$cache_data .= "\r\n } \r\n?>";
file_put_contents(CACHE_MODEL_PATH.'formguide_'.$classtype.'.class.php',$cache_data);
@chmod(CACHE_MODEL_PATH.'formguide_'.$classtype.'.class.php',0777);
}
return true;
}
}
?>