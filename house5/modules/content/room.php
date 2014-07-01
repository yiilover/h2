<?php

defined('IN_HOUSE5') or exit('No permission resources.');
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
define('RELATION_HTML',true);
h5_base::load_app_class('admin','admin',0);
h5_base::load_sys_class('form','',0);
h5_base::load_app_func('util');
h5_base::load_sys_class('format','',0);
class room extends admin {
private $db,$avgdb,$priv_db;
public $siteid,$categorys;
public function __construct() {
parent::__construct();
$this->db = h5_base::load_model('content_model');
$this->avg_db = h5_base::load_model('community_avgprice_model');
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
if(isset($_GET['keyword_lp']) &&!empty($_GET['keyword_lp'])) {
$keyword_lp = trim($_GET['keyword_lp']);
$this->db->set_model(13);
$table_name = $this->db->table_name;
$rs = $this->db->query("SELECT id FROM `$table_name` where `title` like '%$keyword_lp%'");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
}
$ids = implode(',',$ids);
}
if($ids)
{
$this->db->set_model(29);
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$rs = $this->db->query("SELECT id FROM `$table_name` where `relation` in ($ids)");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$idss[]= $r[id];
}
$idss = implode(',',$idss);
}
if(isset($_GET['keyword_ld']) &&!empty($_GET['keyword_ld'])) {
$keyword_ld = trim($_GET['keyword_ld']);
$rs2 = $this->db->query("SELECT id FROM `$tablename` where `id` in ($idss) AND `title` like '%$keyword_ld%'");
$result2 = $this->db->fetch_array($rs2);
if($result2)
{
foreach($result2 as $r2)
{
$idst[]= $r2[id];
}
$idss = implode(',',$idst);
}
else
{
showmessage(L('information_does_not_exist'));
}
}
if($idss)
{
$this->db->set_model(30);
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$rs = $this->db->query("SELECT id FROM `$table_name` where `relation` in ($idss)");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$idsss[]= $r[id];
}
$idsss = implode(',',$idsss);
$where .= " AND `id` in ($idsss)";
}
if(isset($_GET['keyword_room']) &&!empty($_GET['keyword_room'])) {
$keyword_room = trim($_GET['keyword_room']);
$where .= " AND `title` like '%$keyword_room%'";
}
}
else
{
showmessage(L('information_does_not_exist'));
}
}
else
{
showmessage(L('information_does_not_exist'));
}
}
if(isset($_GET['keyword_ld']) &&!empty($_GET['keyword_ld']) &&empty($_GET['keyword_lp'])) {
$keyword_ld = trim($_GET['keyword_ld']);
$this->db->set_model(29);
$table_name = $this->db->table_name;
$rs = $this->db->query("SELECT id FROM `$table_name` where `title` like '%$keyword_ld%'");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
}
$ids = implode(',',$ids);
}
if($ids)
{
$this->db->set_model(30);
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$rs = $this->db->query("SELECT id FROM `$table_name` where `relation` in ($ids)");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$idss[]= $r[id];
}
$idss = implode(',',$idss);
$where .= " AND `id` in ($idss)";
}
if(isset($_GET['keyword_room']) &&!empty($_GET['keyword_room'])) {
$keyword_room = trim($_GET['keyword_room']);
$where .= " AND `title` like '%$keyword_room%'";
}
}
else
{
showmessage(L('information_does_not_exist'));
}
}
if(isset($_GET['keyword_room']) &&!empty($_GET['keyword_room']) &&empty($_GET['keyword_lp']) &&empty($_GET['keyword_ld'])) {
$keyword_room = trim($_GET['keyword_room']);
$where .= " AND `title` like '%$keyword_room%'";
}
if(isset($_GET['posids']) &&!empty($_GET['posids'])) {
$posids = $_GET['posids']==1 ?intval($_GET['posids']) : 0;
$where .= " AND `posids` = '$posids'";
}
$datas = $this->db->listinfo($where,'id desc',$_GET['page']);
$pages = $this->db->pages;
include $this->admin_tpl('content_room_list');
}
}
?>