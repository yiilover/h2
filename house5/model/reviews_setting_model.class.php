<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_sys_class('model','',0);
class reviews_setting_model extends model {
public $table_name;
public function __construct() {
$this->db_config = h5_base::load_config('database');
$this->db_setting = 'reviews';
$this->table_name = 'reviews_setting';
parent::__construct();
}
public function site($siteid) {
return $this->get_one(array('siteid'=>$siteid));
}
}
?>