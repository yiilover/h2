<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_sys_class('model','',0);
class message_group_model extends model {
function __construct() {
$this->db_config = h5_base::load_config('database');
$this->db_setting = 'default';
$this->table_name = 'message_group';
$this->_username = param::get_cookie('_username');
$this->_userid = param::get_cookie('_userid');
parent::__construct();
}
}
?>