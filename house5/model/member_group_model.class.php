<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_sys_class('model','',0);
class member_group_model extends model {
public function __construct() {
$this->db_config = h5_base::load_config('database');
$this->db_setting = 'default';
$this->table_name = 'member_group';
parent::__construct();
}
}
?>