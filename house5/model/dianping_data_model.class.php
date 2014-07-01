<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_sys_class('model','',0);
class dianping_data_model extends model {
function __construct() {
$this->db_config = h5_base::load_config('database');
$this->db_setting = 'default';
$this->table_name = 'dianping_data';
parent::__construct();
}
function get_subject($subjectid)
{
if(!$subjectid) return FALSE;
return $this->get_one(array('subjectid'=>$subjectid));
}
}
?>