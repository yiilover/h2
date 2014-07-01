<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
class formguide_info extends admin {
private $db,$f_db,$tablename;
public function __construct() {
parent::__construct();
$this->db = h5_base::load_model('sitemodel_field_model');
$this->f_db = h5_base::load_model('sitemodel_model');
if (isset($_GET['formid']) &&!empty($_GET['formid'])) {
$formid = intval($_GET['formid']);
$this->cache_field($formid);
$f_info = $this->f_db->get_one(array('modelid'=>$formid,'siteid'=>$this->get_siteid()),'tablename');
$this->tablename = 'form_'.$f_info['tablename'];
$this->db->change_table($this->tablename);
}
}
public function init() {
if (!isset($_GET['formid']) ||empty($_GET['formid'])) {
showmessage(L('illegal_operation'),HTTP_REFERER);
}
$formid = intval($_GET['formid']);
if (!$this->tablename) {
$f_info = $this->f_db->get_one(array('modelid'=>$formid,'siteid'=>$this->get_siteid()),'tablename');
$this->tablename = 'form_'.$f_info['tablename'];
$this->db->change_table($this->tablename);
}
$page = max(intval($_GET['page']),1);
$type = intval($_GET['type']);
$where = "`type`='$type'";
if(in_array($formid,array('17','20')))
{
if(isset($_GET['keyword']) &&!empty($_GET['keyword'])) {
$type_array = array('subject','tel','name');
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
}
$r = $this->db->get_one($where,"COUNT(dataid) sum");
$total = $r['sum'];
$this->f_db->update(array('items'=>$total),array('modelid'=>$formid));
$pages = pages($total,$page,20);
$offset = ($page-1)*20;
$datas = $this->db->select($where,'*',$offset.', 20','`dataid` DESC');
if(in_array($formid,array('17','20')))
{
$show_header = false;
include $this->admin_tpl('formguide_info_tuanlist');
}
else
{
$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?s=formguide/formguide/add\', title:\''.L('formguide_add').'\', width:\'700\', height:\'500\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);',L('formguide_add'));
include $this->admin_tpl('formguide_info_list');
}
}
public function public_view() {
if (!$this->tablename ||!isset($_GET['did']) ||empty($_GET['did'])) showmessage(L('illegal_operation'),HTTP_REFERER);
$did = intval($_GET['did']);
$formid = intval($_GET['formid']);
$info = $this->db->get_one(array('dataid'=>$did));
h5_base::load_sys_class('form','','');
define('CACHE_MODEL_PATH',HOUSE5_PATH.'caches'.DIRECTORY_SEPARATOR.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
require CACHE_MODEL_PATH.'formguide_output.class.php';
$formguide_output = new formguide_output($formid);
$forminfos_data = $formguide_output->get($info);
$fields = $formguide_output->fields;
if($formid=='17')
{
$relation = intval($_GET['houseid']);
$sql = "`dataid` = '$did'";
$this->db->table_name = 'h5_tuangou_mark';
$key_array = $this->db->select($sql,'*','5','addtime desc','','id');
}
if(in_array($formid,array('17','20')))
{
include $this->admin_tpl('formguide_info_tuanview');
}
else
{
include $this->admin_tpl('formguide_info_view');
}
}
public function public_call(){
include $this->admin_tpl('formguide_call');
}
public function public_delete() {
$formid = intval($_GET['formid']);
if (isset($_GET['did']) &&!empty($_GET['did'])) {
$did = intval($_GET['did']);
$this->db->delete(array('dataid'=>$did));
$this->f_db->update(array('items'=>'-=1'),array('modelid'=>$formid));
showmessage(L('operation_success'),HTTP_REFERER);
}else if(is_array($_POST['did']) &&!empty($_POST['did'])) {
foreach ($_POST['did'] as $did) {
$did = intval($did);
$this->db->delete(array('dataid'=>$did));
$this->f_db->update(array('items'=>'-=1'),array('modelid'=>$formid));
}
showmessage(L('operation_success'),HTTP_REFERER);
}else {
showmessage(L('illegal_operation'),HTTP_REFERER);
}
}
public function public_tuanmark() {
if ($_POST['marksubmit']<>"") {
$this->db->table_name = 'h5_tuangou_mark';
$_POST['info']['username'] = param::get_cookie('admin_username');
$_POST['info']['dataid'] = $_POST['dataid'];
$_POST['info']['addtime'] = SYS_TIME;
$_POST['info']['content'] = safe_replace(htmlspecialchars($_POST['mark']));
if(empty($_POST['info']['content']))
{
showmessage('ÇëÊäÈë±¸×¢',HTTP_REFERER);
}
$formid = $this->db->insert($_POST['info'],true);
showmessage(L('update_success'),'?s=formguide/formguide/init/formid/17','','edit');
}else {
showmessage(L('illegal_operation'),HTTP_REFERER);
}
}
public function cache_field($formid = 0,$disabled = 0) {
$field_array = array();
$fields = $this->db->select(array('modelid'=>$formid,'disabled'=>$disabled),'*',100,'listorder ASC');
foreach($fields as $_value) {
$setting = string2array($_value['setting']);
$_value = array_merge($_value,$setting);
$field_array[$_value['field']] = $_value;
}
setcache('formguide_field_'.$formid,$field_array,'model');
return true;
}
}
?>