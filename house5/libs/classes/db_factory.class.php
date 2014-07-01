<?php

final class db_factory {
private static $db_factory;
protected $db_config = array();
protected $db_list = array();
public function __construct() {
}
public static function get_instance($db_config = '') {
if($db_config == '') {
$db_config = h5_base::load_config('database');
}
if(db_factory::$db_factory == '') {
db_factory::$db_factory = new db_factory();
}
if($db_config != ''&&$db_config != db_factory::$db_factory->db_config) db_factory::$db_factory->db_config = array_merge($db_config,db_factory::$db_factory->db_config);
return db_factory::$db_factory;
}
public function get_database($db_name) {
if(!isset($this->db_list[$db_name]) ||!is_object($this->db_list[$db_name])) {
$this->db_list[$db_name] = $this->connect($db_name);
}
return $this->db_list[$db_name];
}
public function connect($db_name) {
$object = null;
switch($this->db_config[$db_name]['type']) {
case 'mysql':
h5_base::load_sys_class('mysql','',0);
$object = new mysql();
break;
case 'mysqli':
$object = h5_base::load_sys_class('mysqli');
break;
case 'access':
$object = h5_base::load_sys_class('db_access');
break;
default :
h5_base::load_sys_class('mysql','',0);
$object = new mysql();
}
$object->open($this->db_config[$db_name]);
return $object;
}
protected function close() {
foreach($this->db_list as $db) {
$db->close();
}
}
public function __destruct() {
$this->close();
}
}
?>