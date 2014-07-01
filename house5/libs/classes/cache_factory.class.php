<?php

final class cache_factory {
private static $cache_factory;
protected $cache_config = array();
protected $cache_list = array();
public function __construct() {
}
public static function get_instance($cache_config = '') {
if(cache_factory::$cache_factory == ''||$cache_config !='') {
cache_factory::$cache_factory = new cache_factory();
if(!empty($cache_config)) {
cache_factory::$cache_factory->cache_config = $cache_config;
}
}
return cache_factory::$cache_factory;
}
public function get_cache($cache_name) {
if(!isset($this->cache_list[$cache_name]) ||!is_object($this->cache_list[$cache_name])) {
$this->cache_list[$cache_name] = $this->load($cache_name);
}
return $this->cache_list[$cache_name];
}
public function load($cache_name) {
$object = null;
if(isset($this->cache_config[$cache_name]['type'])) {
switch($this->cache_config[$cache_name]['type']) {
case 'file':
$object = h5_base::load_sys_class('cache_file');
break;
case 'memcache':
define('MEMCACHE_HOST',$this->cache_config[$cache_name]['hostname']);
define('MEMCACHE_PORT',$this->cache_config[$cache_name]['port']);
define('MEMCACHE_TIMEOUT',$this->cache_config[$cache_name]['timeout']);
define('MEMCACHE_DEBUG',$this->cache_config[$cache_name]['debug']);
$object = h5_base::load_sys_class('cache_memcache');
break;
case 'apc':
$object = h5_base::load_sys_class('cache_apc');
break;
default :
$object = h5_base::load_sys_class('cache_file');
}
}else {
$object = h5_base::load_sys_class('cache_file');
}
return $object;
}
}
?>