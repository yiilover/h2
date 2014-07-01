<?php

class member_interface {
private $db;
public function __construct() {
$this->db = h5_base::load_model('member_model');
}
public function get_member_info($mix,$type=1) {
$mix = safe_replace($mix);
if($type==1) {
$userinfo = $this->db->get_one(array('userid'=>$mix));
}elseif($type==2) {
$userinfo = $this->db->get_one(array('username'=>$mix));
}elseif($type==3) {
if(!$this->_is_email($mix)) {
return -4;
}
$userinfo = $this->db->get_one(array('email'=>$mix));
}
if($userinfo) {
return $userinfo;
}else {
return -1;
}
}
public function add_favorite($cid,$userid,$title) {
$cid = intval($cid);
$userid = intval($userid);
$title = safe_replace($title);
$this->favorite_db = h5_base::load_model('favorite_model');
$id = $this->favorite_db->insert(array('title'=>$title,'userid'=>$userid,'cid'=>$cid,'adddate'=>SYS_TIME),1);
if($id) {
return $id;
}else {
return -1;
}
}
public function add_point($userid,$point) {
$point = intval($point);
return $this->db->update(array('point'=>"+=$point"),array('userid'=>$userid));
}
}?>