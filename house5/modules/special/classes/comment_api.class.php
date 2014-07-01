<?php

defined('IN_HOUSE5') or exit('No permission resources.');
if (!module_exists('comment')) showmessage(L('module_not_exists'));
class comment_api {
private $db;
function __construct() {
$this->db = h5_base::load_model('special_model');
}
function get_info($module,$contentid,$siteid) {
if ($module=='special') {
$r = $this->db->get_one(array('id'=>$contentid,'siteid'=>$siteid),'title, url');
return array('title'=>$r['title'],'url'=>$r['url']);
}elseif ($module=='special_content') {
$this->db = h5_base::load_model('special_content_model');
$r = $this->db->get_one(array('id'=>$contentid),'title, url');
if ($r) {
return array('title'=>$r['title'],'url'=>$r['url']);
}else {
return false;
}
}
}
}?>