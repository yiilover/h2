<?php

defined('IN_HOUSE5') or exit('No permission resources.');
class message_tag {
private $message_db;
public function __construct() {
$this->message_db = h5_base::load_model('message_model');
$this->message_group_db = h5_base::load_model('message_group_model');
$this->message_data_db = h5_base::load_model('message_data_model');
$this->_username = param::get_cookie('_username');
$this->_userid = param::get_cookie('_userid');
$this->_groupid = get_memberinfo($this->_userid,'groupid');
}
public function check_new(){
$where = array('send_to_id'=>$this->_username,'folder'=>'inbox','status'=>'1');
$new_count = $this->message_db->count($where);
$group_num = 0;
$group_where = array('typeid'=>'1','groupid'=>$this->_groupid,'status'=>'1');
$group_arr = $this->message_group_db->select($group_where);
foreach ($group_arr as $groupid=>$group){
$group_message_id = $group['id'];
$where = array('group_message_id'=>$group_message_id,'userid'=>$this->_userid);
$result = $this->message_data_db->select($where);
if(!$result) $group_num++;
}
$new_arr = array();
$new_arr['new_count'] = $new_count;
$new_arr['new_group_count'] = $group_num;
return $new_arr;
}
}
?>