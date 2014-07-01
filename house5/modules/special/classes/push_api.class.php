<?php

defined('IN_HOUSE5') or exit('No permission resources.');
class push_api {
private $special_api;
public function __construct() {
$this->special_api = h5_base::load_app_class('special_api','special');
}
public function _push_special($param = array(),$arr = array()) {
return $this->special_api->_get_special($param,$arr);
}
public function _get_type($specialid) {
return $this->special_api->_get_type($specialid);
}
}
?>