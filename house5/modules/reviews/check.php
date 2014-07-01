<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
class check extends admin {
private $reviews_check_db,$reviews_db,$reviews;
function __construct() {
$this->reviews_data_db = h5_base::load_model('reviews_data_model');
$this->reviews_check_db = h5_base::load_model('reviews_check_model');
$this->reviews = h5_base::load_app_class('reviews');
}
public function checks() {
$total = $this->reviews_check_db->count(array('siteid'=>$this->get_siteid()));
$reviews_check_data = $this->reviews_check_db->select(array('siteid'=>$this->get_siteid()),'*','20','id desc');
if (empty($reviews_check_data)) showmessage(L('no_check_reviews').'<script>window.top.$("#display_center_id").css("display","none");</script>');
h5_base::load_sys_class('format','',0);
include $this->admin_tpl('reviews_check');
}
public function ajax_checks() {
$id =  isset($_GET['id']) &&$_GET['id'] ?$_GET['id'] : exit('0');
$type =  isset($_GET['type']) &&intval($_GET['type']) ?intval($_GET['type']) : exit('0');
$reviewsid =  isset($_GET['reviewsid']) &&trim($_GET['reviewsid']) ?trim($_GET['reviewsid']) : exit('0');
if (is_array($id)) {
foreach ($id as $v) {
if (!$v = intval($v)) {
continue;
}
$this->reviews->status($reviewsid,$v,$type);
}
showmessage(L('operation_success'),HTTP_REFERER);
}else {
$id = intval($id) ?intval($id) : exit('0');
$this->reviews->status($reviewsid,$id,$type);
}
if ($reviews->msg_code != 0) {
exit($reviews->get_error());
}else {
exit('1');
}
}
public function public_get_one() {
$total = $this->reviews_check_db->count(array('siteid'=>$this->get_siteid()));
$reviews_check_data = $this->reviews_check_db->select(array('siteid'=>$this->get_siteid()),'*','19,1','id desc');
$reviews_check_data = $reviews_check_data[0];
$r = array();
if (is_array($reviews_check_data) &&!empty($reviews_check_data)) {
$this->reviews_data_db->table_name($reviews_check_data['tableid']);
$r = $this->reviews_data_db->get_one(array('id'=>$reviews_check_data['reviews_data_id'],'siteid'=>$this->get_siteid()));
h5_base::load_sys_class('format','',0);
$r['creat_at'] = format::date($r['creat_at'],1);
if (h5_base::load_config('system','charset')=='gbk') {
foreach ($r as $k=>$v) {
$r[$k] = iconv('gbk','utf-8',$v);
}
}
}
echo json_encode(array('total'=>$total,'data'=>$r));
}
}?>