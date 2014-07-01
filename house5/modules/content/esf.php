<?php

defined('IN_HOUSE5') or exit('No permission resources.');
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
define('RELATION_HTML',true);
h5_base::load_app_class('admin','admin',0);
h5_base::load_sys_class('form','',0);
h5_base::load_app_func('util');
h5_base::load_sys_class('format','',0);
class esf extends admin {
private $db,$priv_db;
public $siteid,$categorys;
public function __construct() {
parent::__construct();
$this->db = h5_base::load_model('content_model');
$this->siteid = $this->get_siteid();
$this->categorys = getcache('category_content_'.$this->siteid,'commons');
if(isset($_GET['catid']) &&$_SESSION['roleid'] != 1 &&ROUTE_A !='pass'&&strpos(ROUTE_A,'public_')===false) {
$catid = intval($_GET['catid']);
$this->priv_db = h5_base::load_model('category_priv_model');
$action = $this->categorys[$catid]['type']==0 ?ROUTE_A : 'init';
$priv_datas = $this->priv_db->get_one(array('catid'=>$catid,'is_admin'=>1,'action'=>$action));
if(!$priv_datas) showmessage(L('permission_to_operate'),'blank');
}
}
public function init() {
$where = '';
$show_header = '';
$h5_hash = $_SESSION['h5_hash'];
$catid = $_GET['catid'] = intval($_GET['catid']);
$category = $this->categorys[$catid];
$modelid = $category['modelid'];
$admin_username = param::get_cookie('admin_username');
$setting = string2array($category['setting']);
$workflowid = $setting['workflowid'];
$workflows = getcache('workflow_'.$this->siteid,'commons');
$workflows = $workflows[$workflowid];
$workflows_setting = string2array($workflows['setting']);
$admin_privs = array();
foreach($workflows_setting as $_k=>$_v) {
if(empty($_v)) continue;
foreach($_v as $_value) {
if($_value==$admin_username) $admin_privs[$_k] = $_k;
}
}
$workflow_steps = $workflows['steps'];
$workflow_menu = '';
$steps = isset($_GET['steps']) ?intval($_GET['steps']) : 0;
if($_SESSION['roleid']!=1 &&$steps &&!in_array($steps,$admin_privs)) showmessage(L('permission_to_operate'));
$this->db->set_model($modelid);
if($this->db->table_name==$this->db->db_tablepre) showmessage(L('model_table_not_exists'));;
$status = $steps ?$steps : 99;
if(isset($_GET['reject'])) $status = 0;
if(strpos($category['arrchildid'],',')===false)
{
$where = 'catid='.$catid.' AND status='.$status;
}
else
{
$where = 'catid in ('.$category['arrchildid'].') AND status='.$status;
}
if(isset($_GET['house_status']) &&$_GET['house_status']) {
$house_status = intval($_GET['house_status']);
$where .= " AND `house_status` = '$house_status'";
}
if(isset($_GET['isreply'])) {
$isreply = intval($_GET['isreply']);
$where .= " AND `isreply` = '$isreply'";
}
if(isset($_GET['start_time']) &&$_GET['start_time']) {
$start_time = strtotime($_GET['start_time']);
$where .= " AND `inputtime` > '$start_time'";
}
if(isset($_GET['end_time']) &&$_GET['end_time']) {
$end_time = strtotime($_GET['end_time']);
$where .= " AND `inputtime` < '$end_time'";
}
if($start_time>$end_time) showmessage(L('starttime_than_endtime'));
if(isset($_GET['keyword']) &&!empty($_GET['keyword'])) {
$type_array = array('title','description','username');
$searchtype = intval($_GET['searchtype']);
if($searchtype <3) {
$searchtype = $type_array[$searchtype];
$keyword = strip_tags(trim($_GET['keyword']));
$where .= " AND `$searchtype` like '%$keyword%'";
}elseif($searchtype==3) {
$keyword = intval($_GET['keyword']);
$where .= " AND `id`='$keyword'";
}
}
if(isset($_GET['posids']) &&!empty($_GET['posids'])) {
$posids = $_GET['posids']==1 ?intval($_GET['posids']) : 0;
$where .= " AND `posids` = '$posids'";
}
$datas = $this->db->listinfo($where,'id desc',$_GET['page']);
$pages = $this->db->pages;
include $this->admin_tpl('content_esf_list');
}
}
?>