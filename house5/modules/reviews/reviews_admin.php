<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
h5_base::load_sys_class('form','',0);
class reviews_admin extends admin {
private $reviews_setting_db,$reviews_data_db,$reviews_db,$siteid;
public function __construct() {
parent::__construct();
$this->reviews_setting_db = h5_base::load_model('reviews_setting_model');
$this->reviews_data_db = h5_base::load_model('reviews_data_model');
$this->reviews_db = h5_base::load_model('reviews_model');
$this->siteid = $this->get_siteid();
}
public function lists() {
$hot =  isset($_GET['hot']) &&intval($_GET['hot']) ?intval($_GET['hot']) : 0;
$startype =  isset($_GET['startype']) &&intval($_GET['startype']) ?intval($_GET['startype']) : '';
$reviews = $this->reviews_db->get_one(array('siteid'=>$this->siteid));
if (empty($reviews)) showmessage(L('no_comment').'<script>window.top.$("#display_center_id").css("display","none");</script>');
h5_base::load_app_func('global');
h5_base::load_sys_class('format','',0);
$page = isset($_GET['page']) &&intval($_GET['page']) ?intval($_GET['page']) : 1;
$this->reviews_data_db->table_name($reviews['tableid']);
$desc = 'id desc';
if ($hot == 1) {
$desc = 'support desc, id desc';
}
$where .="siteid=".$this->siteid;
if (!empty($startype))  {
$where .=" and startype=".$startype;
}
$list = $this->reviews_data_db->listinfo($where,$desc,$_GET['page']);
$pages = $this->reviews_data_db->pages;
include $this->admin_tpl('reviews_data_list');
}
public function setting () {
$data = $this->reviews_setting_db->get_one(array('siteid'=>$this->siteid));
if (isset($_POST['dosubmit'])) {
$guest = isset($_POST['guest']) &&intval($_POST['guest']) ?intval($_POST['guest']) : 0;
$check = isset($_POST['check']) &&intval($_POST['check']) ?intval($_POST['check']) : 0;
$code = isset($_POST['code']) &&intval($_POST['code']) ?intval($_POST['code']) : 0;
$add_point = isset($_POST['add_point']) &&abs(intval($_POST['add_point'])) ?intval($_POST['add_point']) : 0;
$del_point = isset($_POST['del_point']) &&abs(intval($_POST['del_point'])) ?intval($_POST['del_point']) : 0;
$sql = array('guest'=>$guest,'check'=>$check,'code'=>$code,'add_point'=>$add_point,'del_point'=>$del_point);
if ($data) {
$this->reviews_setting_db->update($sql,array('siteid'=>$this->siteid));
}else {
$sql['siteid'] = $this->siteid;
$this->reviews_setting_db->insert($sql);
}
showmessage(L('operation_success'),HTTP_REFERER);
}else {
include $this->admin_tpl('reviews_setting');
}
}
}
?>