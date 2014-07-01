<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_sys_class('model','',0);
class sitemodel_field_model extends model {
public $table_name = '';
public function __construct() {
$this->db_config = h5_base::load_config('database');
$this->db_setting = 'default';
$this->table_name = 'model_field';
parent::__construct();
}
public function drop_field($tablename,$field) {
$this->table_name = $this->db_tablepre.$tablename;
$fields = $this->get_fields();
if(in_array($field,array_keys($fields))) {
return $this->db->query("ALTER TABLE `$this->table_name` DROP `$field`;");
}else {
return false;
}
}
public function change_table($tablename = '') {
if (!$tablename) return false;
$this->table_name = $this->db_tablepre.$tablename;
return true;
}
}
?>