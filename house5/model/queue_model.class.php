<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_sys_class('model','',0);
class queue_model extends model {
public function __construct() {
$this->db_config = h5_base::load_config('database');
$this->db_setting = 'default';
$this->table_name = 'queue';
parent::__construct();
}
final public function add_queue($type = 'add',$path,$siteid = '') {
if (empty($siteid)) $siteid = get_siteid();
$sites = h5_base::load_app_class('sites','admin');
$site = $sites->get_by_id($siteid);
if (empty($site['release_point'])) return false;
if ($r = $this->get_one(array('type'=>$type,'path'=>$path,'siteid'=>$siteid),'id')) {
if ($this->update(array('status1'=>'0','status2'=>'0','status3'=>'0','status4'=>'0','times'=>SYS_TIME),array('id'=>$r['id']))) {
return true;
}else {
return false;
}
}else {
if ($this->insert(array('type'=>$type,'path'=>$path,'siteid'=>$siteid,'times'=>SYS_TIME))) {
return true;
}else {
return false;
}
}
}
}
?>