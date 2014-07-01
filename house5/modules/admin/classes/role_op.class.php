<?php

defined('IN_HOUSE5') or exit('No permission resources.');
define('IN_ADMIN',true);
class role_op {
public function __construct() {
$this->db = h5_base::load_model('admin_role_model');
$this->priv_db = h5_base::load_model('admin_role_priv_model');
}
public function get_rolename($roleid) {
$roleid = intval($roleid);
$search_field = '`roleid`,`rolename`';
$info = $this->db->get_one(array('roleid'=>$roleid),$search_field);
return $info;
}
public function checkname($name) {
$info = $this->db->get_one(array('rolename'=>$name),'roleid');
if($info[roleid]){
return true;
}
return false;
}
public function get_menuinfo($menuid,$menu_info) {
$menuid = intval($menuid);
unset($menu_info[$menuid][id]);
return $menu_info[$menuid];
}
public function is_checked($data,$roleid,$siteid,$priv_data) {
$priv_arr = array('m','c','a','data');
if($data['m'] == '') return false;
foreach($data as $key=>$value){
if(!in_array($key,$priv_arr)) unset($data[$key]);
}
$data['roleid'] = $roleid;
$data['siteid'] = $siteid;
$info = in_array($data,$priv_data);
if($info){
return true;
}else {
return false;
}
}
public function is_setting($siteid,$roleid) {
$siteid = intval($siteid);
$roleid = intval($roleid);
$sqls = "`siteid`='$siteid' AND `roleid` = '$roleid' AND `m` != ''";
$result = $this->priv_db->get_one($sqls);
return $result ?true : false;
}
public function get_level($id,$array=array(),$i=0) {
foreach($array as $n=>$value){
if($value['id'] == $id)
{
if($value['parentid']== '0') return $i;
$i++;
return $this->get_level($value['parentid'],$array,$i);
}
}
}
}
?>