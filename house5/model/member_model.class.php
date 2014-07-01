<?php

defined('IN_HOUSE5') or exit('No permission resources.');
if(!defined('CACHE_MODEL_PATH')) define('CACHE_MODEL_PATH',HOUSE5_PATH.'caches'.DIRECTORY_SEPARATOR.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
h5_base::load_sys_class('model','',0);
class member_model extends model {
public function __construct() {
$this->db_config = h5_base::load_config('database');
$this->db_setting = 'default';
$this->table_name = 'member';
parent::__construct();
}
public function set_model($modelid = '') {
if($modelid) {
$model = getcache('member_model','commons');
$this->table_name = $this->db_tablepre.$model[$modelid]['tablename'];
}else {
$this->table_name = $this->db_tablepre.'member';
}
}
}
?>