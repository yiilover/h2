<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_sys_class('model','',0);
class comment_data_model extends model {
public $table_name;
public function __construct() {
$this->db_config = h5_base::load_config('database');
$this->db_setting = 'comment';
$this->table_name = '';
parent::__construct();
}
public function table_name($id) {
$this->table_name = $this->db_config[$this->db_setting]['tablepre'].'comment_data_'.$id;
return $this->table_name;
}
}
?>