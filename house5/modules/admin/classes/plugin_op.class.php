<?php

defined('IN_HOUSE5') or exit('No permission resources.');
define('IN_ADMIN',true);
class plugin_op {
private $db,$db_var;
public function __construct(){
$this->db_var = h5_base::load_model('plugin_var_model');
$this->db = h5_base::load_model('plugin_var_model');
}
public function plugin_tpl($file,$identification) {
return H5_PATH.'plugin'.DIRECTORY_SEPARATOR.$identification.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.$file.'.tpl.php';
}
public function getpluginvar($pluginid){
if(empty($pluginid)) return flase;
if($info_var = $this->db_var->select(array('pluginid'=>$pluginid))) {
foreach ($info_var as $var) {
$pluginvar[$var['fieldname']] = $var['value'];
}
}
return 	$pluginvar;
}
function getplugincfg($pluginid) {
$info = $this->db->get_one(array('pluginid'=>$pluginid));
return $info;
}
}
?>