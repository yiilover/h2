<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_sys_class('model','',0);
class search_model extends model {
public $table_name = '';
public function __construct() {
$this->db_config = h5_base::load_config('database');
$this->db_setting = 'default';
$this->table_name = 'search';
parent::__construct();
}
public function update_search($typeid ,$id = 0,$data = '',$text = '',$adddate = 0,$iscreateindex=0) {
$segment = h5_base::load_sys_class('segment');
$fulltext_data = $segment->get_keyword($segment->split_result($data));
$fulltext_data = $text.' '.$fulltext_data;
if(!$iscreateindex) {
$r = $this->get_one(array('typeid'=>$typeid,'id'=>$id),'searchid');
}
if($r) {
$searchid = $r['searchid'];
$this->update(array('data'=>$fulltext_data,'adddate'=>$adddate),array('typeid'=>$typeid,'id'=>$id));
}else {
$siteid = param::get_cookie('siteid');
$searchid = $this->insert(array('typeid'=>$typeid,'id'=>$id,'adddate'=>$adddate,'data'=>$fulltext_data,'siteid'=>$siteid),true);
}
return $searchid;
}
public function delete_search($typeid ,$id) {
$this->delete(array('typeid'=>$typeid,'id'=>$id));
}
}
?>