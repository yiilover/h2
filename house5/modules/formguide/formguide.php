<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
h5_base::load_sys_class('form','','');
class formguide extends admin {
private $db,$tablename,$m_db,$M;
public function __construct() {
parent::__construct();
$this->tablename = '';
$setting = new_html_special_chars(getcache('formguide','commons'));
$this->M = $setting[$this->get_siteid()];
$this->db = h5_base::load_model('sitemodel_model');
}
public function init() {
$page = max(intval($_GET['page']),1);
$data = $this->db->listinfo(array('type'=>3,'siteid'=>$this->get_siteid()),'`modelid` DESC',$page);
$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?s=formguide/formguide/add\', title:\''.L('formguide_add').'\', width:\'700\', height:\'500\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);',L('formguide_add'));
include $this->admin_tpl('formguide_list');
}
public function add() {
if (isset($_POST['dosubmit'])) {
if ($_POST['setting']['starttime']) {
$_POST['setting']['starttime'] = strtotime($_POST['setting']['starttime']);
}
if ($_POST['setting']['endtime']) {
$_POST['setting']['endtime'] = strtotime($_POST['setting']['endtime']);
}
$_POST['info'] = $this->check_info($_POST['info']);
$_POST['info']['setting'] = array2string($_POST['setting']);
$_POST['info']['siteid'] = $this->get_siteid();
$_POST['info']['addtime'] = SYS_TIME;
$_POST['info']['js_template'] = $_POST['info']['show_js_template'];
$_POST['info']['type'] = 3;
unset($_POST['info']['show_js_template']);
$this->tablename = $_POST['info']['tablename'];
$formid = $this->db->insert($_POST['info'],true);
define('MODEL_PATH',H5_PATH.'modules'.DIRECTORY_SEPARATOR.'formguide'.DIRECTORY_SEPARATOR.'fields'.DIRECTORY_SEPARATOR);
$create_sql = file_get_contents(MODEL_PATH.'create.sql');
$this->m_db = h5_base::load_model('sitemodel_field_model');
$this->sql_execute($create_sql);
$form_public_field_array = getcache('form_public_field_array','model');
if (is_array($form_public_field_array)) {
foreach ($form_public_field_array as $k =>$v) {
$v['info']['modelid'] = $formid;
$this->m_db->insert($v['info']);
$sql = str_replace('formguide_table',$this->m_db->db_tablepre.'form_'.$_POST['info']['tablename'],$v['sql']);
$this->m_db->query($sql);
}
}
showmessage(L('add_success'),'?s=formguide/formguide_field/init/formid/'.$formid,'','add');
}else {
$siteid = $this->get_siteid();
$template_list = template_list($siteid,0);
$site = h5_base::load_app_class('sites','admin');
$info = $site->get_by_id($siteid);
foreach ($template_list as $k=>$v) {
$template_list[$v['dirname']] = $v['name'] ?$v['name'] : $v['dirname'];
unset($template_list[$k]);
}
$formid = intval($_GET['formid']);
h5_base::load_sys_class('form','',false);
$show_header = $show_validator = $show_scroll = 1;
include $this->admin_tpl('formguide_add');
}
}
public function edit() {
if (!isset($_GET['formid']) ||empty($_GET['formid'])) {
showmessage(L('illegal_operation'),HTTP_REFERER);
}
$formid = intval($_GET['formid']);
if (isset($_POST['dosubmit'])) {
if ($_POST['setting']['starttime']) {
$_POST['setting']['starttime'] = strtotime($_POST['setting']['starttime']);
}
if ($_POST['setting']['endtime']) {
$_POST['setting']['endtime'] = strtotime($_POST['setting']['endtime']);
}
$_POST['info'] = $this->check_info($_POST['info'],$formid);
$_POST['info']['setting'] = array2string($_POST['setting']);
$_POST['info']['js_template'] = $_POST['info']['show_js_template'];
unset($_POST['info']['show_js_template']);
$this->db->update($_POST['info'],array('modelid'=>$formid));
showmessage(L('update_success'),'?s=formguide/formguide/init/formid/'.$formid,'','edit');
}else {
$siteid = $this->get_siteid();
$template_list = template_list($siteid,0);
$site = h5_base::load_app_class('sites','admin');
$info = $site->get_by_id($siteid);
foreach ($template_list as $k=>$v) {
$template_list[$v['dirname']] = $v['name'] ?$v['name'] : $v['dirname'];
unset($template_list[$k]);
}
$data = $this->db->get_one(array('modelid'=>$formid));
$data['setting'] = string2array($data['setting']);
h5_base::load_sys_class('form','',false);
$show_header = $show_validator = $show_scroll = 1;
include $this->admin_tpl('formguide_edit');
}
}
public function disabled() {
if (!isset($_GET['formid']) ||empty($_GET['formid'])) {
showmessage(L('illegal_operation'),HTTP_REFERER);
}
$formid = intval($_GET['formid']);
$val = $_GET['val'] ?intval($_GET['val']) : 0;
$this->db->update(array('disabled'=>$val),array('modelid'=>$formid,'siteid'=>$this->get_siteid()));
showmessage(L('operation_success'),HTTP_REFERER);
}
public function public_preview() {
if (!isset($_GET['formid']) ||empty($_GET['formid'])) {
showmessage(L('illegal_operation'),HTTP_REFERER);
}
$formid = intval($_GET['formid']);
$f_info = $this->db->get_one(array('modelid'=>$formid,'siteid'=>$this->get_siteid()),'name');
define('CACHE_MODEL_PATH',HOUSE5_PATH.'caches'.DIRECTORY_SEPARATOR.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
require CACHE_MODEL_PATH.'formguide_form.class.php';
$formguide_form = new formguide_form($formid);
$forminfos_data = $formguide_form->get();
$show_header = 1;
include $this->admin_tpl('formguide_preview');
}
public function public_checktable() {
if (isset($_GET['formid']) &&!empty($_GET['formid'])) {
$formid = intval($_GET['formid']);
}
$r = $this->db->get_one(array('tablename'=>$_GET['tablename']),'tablename, modelid');
if (!$r['modelid']) {
exit('1');
}elseif ($r['modelid'] &&($r['modelid']==$formid)) {
exit('1');
}else {
exit('0');
}
}
private function check_info($data = array(),$formid = 0) {
if (empty($data) ||$data['name']=='') {
showmessage(L('input_form_title'),HTTP_REFERER);
}
if ($data['tablename']=='') {
showmessage(L('please_input_tallename'),HTTP_REFERER);
}
$r = $this->db->get_one(array('tablename'=>$data['tablename']),'tablename, modelid');
if ($r['modelid'] &&(($r['modelid']!=$formid) ||!$formid)) {
showmessage(L('tablename_existed'),HTTP_REFERER);
}
return $data;
}
public function delete() {
$siteid = $this->get_siteid();
if (isset($_GET['formid']) &&!empty($_GET['formid'])) {
$formid = intval($_GET['formid']);
$m_db = h5_base::load_model('sitemodel_field_model');
$m_db->delete(array('modelid'=>$formid,'siteid'=>$siteid));
$m_info = $this->db->get_one(array('modelid'=>$formid),'tablename');
$tablename = $m_db->db_tablepre.'form_'.$m_info['tablename'];
$m_db->query("DROP TABLE `$tablename`");
$this->db->delete(array('modelid'=>$formid,'siteid'=>$siteid));
showmessage(L('operation_success'),HTTP_REFERER);
}elseif (isset($_POST['formid']) &&!empty($_POST['formid'])) {
$m_db = h5_base::load_model('sitemodel_field_model');
$m_db->delete(array('modelid'=>$formid,'siteid'=>$siteid));
if (is_array($_POST['formid'])) {
foreach ($_POST['formid'] as $fid) {
$m_info = $this->db->get_one(array('modelid'=>$fid),'tablename');
$tablename = $m_db->db_tablepre.'form_'.$m_info['tablename'];
$m_db->query("DROP TABLE `$tablename`");
$this->db->delete(array('modelid'=>$fid,'siteid'=>$siteid));
}
}
showmessage(L('operation_success'),HTTP_REFERER);
}else {
showmessage(L('illegal_operation'),HTTP_REFERER);
}
}
public function stat() {
if (!isset($_GET['formid']) ||empty($_GET['formid'])) {
showmessage(L('illegal_operation'),HTTP_REFERER);
}
$formid = intval($_GET['formid']);
$fields = getcache('formguide_field_'.$formid,'model');
$f_info = $this->db->get_one(array('modelid'=>$formid,'siteid'=>$this->get_siteid()),'tablename');
$tablename = 'form_'.$f_info['tablename'];
$m_db = h5_base::load_model('sitemodel_field_model');
$result = $m_db->select(array('modelid'=>$formid,'formtype'=>'box'),'field, setting');
$m_db->change_table($tablename);
$datas = $m_db->select(array(),'*');
$total = count($datas);
include $this->admin_tpl('formguide_stat');
}
public function setting() {
if (isset($_POST['dosubmit'])) {
$setting = getcache('formguide','commons');
$setting[$this->get_siteid()] = $_POST['setting'];
setcache('formguide',$setting,'commons');
$m_db = h5_base::load_model('module_model');
$setting = array2string($_POST['setting']);
$m_db->update(array('setting'=>$setting),array('module'=>ROUTE_M));
showmessage(L('setting_updates_successful'),HTTP_REFERER,'','setting');
}else {
@extract($this->M);
include $this->admin_tpl('setting');
}
}
private function sql_execute($sql) {
$sqls = $this->sql_split($sql);
if (is_array($sqls)) {
foreach ($sqls as $sql) {
if (trim($sql) != '') {
$this->m_db->query($sql);
}
}
}else {
$this->m_db->query($sqls);
}
return true;
}
private function sql_split($sql) {
$database = h5_base::load_config('database');
$dbcharset = $database['default']['charset'];
if($this->m_db->version() >'4.1'&&$dbcharset) {
$sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/","ENGINE=\\1 DEFAULT CHARSET=".$dbcharset,$sql);
}
$sql = str_replace("house5_form_table",$this->m_db->db_tablepre.'form_'.$this->tablename,$sql);
$ret = array();
$num = 0;
$queriesarray = explode(";\n",trim($sql));
unset($sql);
foreach ($queriesarray as $query) {
$ret[$num] = '';
$queries = explode("\n",trim($query));
$queries = array_filter($queries);
foreach ($queries as $query) {
$str1 = substr($query,0,1);
if($str1 != '#'&&$str1 != '-') $ret[$num] .= $query;
}
$num++;
}
return $ret;
}
}
?>