<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
class log extends admin {
function __construct() {
parent::__construct();
$this->db = h5_base::load_model('log_model');
h5_base::load_sys_class('form');
$admin_username = param::get_cookie('admin_username');
$userid = $_SESSION['userid'];
}
function init () {
$page = isset($_GET['page']) &&intval($_GET['page']) ?intval($_GET['page']) : 1;
$infos = $this->db->listinfo($where = '',$order = 'logid DESC',$page,$pages = '13');
$pages = $this->db->pages;
$module_arr = array();
$modules = getcache('modules','commons');
$default = L('open_module');
foreach($modules as $module=>$m) $module_arr[$m['module']] = $m['module'];
include $this->admin_tpl('log_list');
}
function delete() {
$week = intval($_GET['week']);
if($week){
$where = '';
$start = SYS_TIME -$week*7*24*3600;
$d = date("Y-m-d",$start);
$where .= "`time` <= '$d'";
$this->db->delete($where);
showmessage(L('operation_success'),'?s=admin/log/init');
}else {
return false;
}
}
public function search_log() {
$where = '';
extract($_GET['search']);
if($username){
$where .= $where ?" AND username='$username'": " username='$username'";
}
if ($module){
$where .= $where ?" AND module='$module'": " module='$module'";
}
if($start_time &&$end_time) {
$start = $start_time;
$end = $end_time;
$where .= "AND `time` >= '$start' AND `time` <= '$end' ";
}
$page = isset($_GET['page']) &&intval($_GET['page']) ?intval($_GET['page']) : 1;
$infos = $this->db->listinfo($where,$order = 'logid DESC',$page,$pages = '12');
$pages = $this->db->pages;
$module_arr = array();
$modules = getcache('modules','commons');
$default = $module ?$module : L('open_module');
foreach($modules as $module=>$m) $module_arr[$m['module']] = $m['module'];
include $this->admin_tpl('log_search_list');
}
}
?>