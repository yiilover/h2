<?php
defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_sys_class('model', '', 0);
class video_data_model extends model {
	public $table_name = '';
	public function __construct() {
		$this->db_config = h5_base::load_config('database');
		$this->db_setting = 'default';
		$this->table_name = 'video_data';
		parent::__construct();
	}

}
?>