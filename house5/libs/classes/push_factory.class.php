<?php

final class push_factory {
private static $push_factory;
protected $api_list = array();
public static function get_instance() {
if(push_factory::$push_factory == '') {
push_factory::$push_factory = new push_factory();
}
return push_factory::$push_factory;
}
public function get_api($module = 'admin') {
if(!isset($this->api_list[$module]) ||!is_object($this->api_list[$module])) {
$this->api_list[$module] = h5_base::load_app_class('push_api',$module);
}
return $this->api_list[$module];
}
}?>