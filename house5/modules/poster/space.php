<?php
 
defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
h5_base::load_sys_class('form','',0);
class space extends admin {
private $M,$db;
function __construct() {
parent::__construct();
$setting = new_html_special_chars(getcache('poster','commons'));
$this->M = $setting[$this->get_siteid()];
$this->db = h5_base::load_model('poster_space_model');
}
public function init() {
$TYPES = $this->template_type();
$page = max(intval($_GET['page']),1);
$infos = $this->db->listinfo(array('siteid'=>$this->get_siteid()),'`spaceid`',$page);
$pages = $this->db->pages;
$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?s=poster/space/add\', title:\''.L('add_space').'\', width:\'540\', height:\'320\'}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);',L('add_space'));
include $this->admin_tpl('space_list');
}
public function add() {
if (isset($_POST['dosubmit'])) {
$space = $this->check($_POST['space']);
$space['setting'] = array2string($_POST['setting']);
$space['siteid'] = $this->get_siteid();
$spaceid = $this->db->insert($space,true);
if ($spaceid) {
if ($space['type']=='code') {
$path = '{show_ad('.$space['siteid'].', '.$spaceid.')}';
}else {
$path = 'poster_js/'.$spaceid.'.js';
}
$this->db->update(array('path'=>$path),array('siteid'=>$this->get_siteid(),'spaceid'=>$spaceid));
showmessage(L('added_successful'),'?s=poster/space','','add');
}
}else {
$TYPES = $this->template_type();
$poster_template = getcache('poster_template_'.$this->get_siteid(),'commons');
$show_header = $show_validator = true;
include $this->admin_tpl('space_add');
}
}
public function edit() {
$_GET['spaceid'] = intval($_GET['spaceid']);
if (!$_GET['spaceid']) showmessage(L('illegal_operation'),HTTP_REFERER);
if (isset($_POST['dosubmit'])) {
$space = $this->check($_POST['space']);
$space['setting'] = array2string($_POST['setting']);
if ($space['type']=='code') {
$space['path'] = '{show_ad('.$this->get_siteid().', '.$_GET['spaceid'].')}';
}else {
$space['path'] = 'poster_js/'.$_GET['spaceid'].'.js';
}
if (isset($_POST['old_type']) &&$_POST['old_type']!=$space['type']) {
$poster_db = h5_base::load_model('poster_model');
$poster_db->delete(array('spaceid'=>$_GET['spaceid']));
$space['items'] = 0;
}
if ($this->db->update($space,array('spaceid'=>$_GET['spaceid']))) showmessage(L('edited_successful'),'?s=poster/space','','testIframe'.$_GET['spaceid']);
}else {
$info = $this->db->get_one(array('spaceid'=>$_GET['spaceid']));
$setting = string2array($info['setting']);
$TYPES = $this->template_type();
$poster_template = getcache('poster_template_'.$this->get_siteid(),'commons');
$show_header = $show_validator = true;
include $this->admin_tpl('space_edit');
}
}
public function public_call() {
$_GET['sid'] = intval($_GET['sid']);
if (!$_GET['sid']) showmessage(L('illegal_action'),HTTP_REFERER,'','call');
$r = $this->db->get_one(array('spaceid'=>$_GET['sid'],'siteid'=>$this->get_siteid()));
include $this->admin_tpl('space_call');
}
public function public_preview() {
if (is_numeric($_GET['spaceid'])) {
$_GET['spaceid'] = intval($_GET['spaceid']);
$r = $this->db->get_one(array('spaceid'=>$_GET['spaceid'],'siteid'=>$this->get_siteid()));
$scheme = $_SERVER['SERVER_PORT'] == '443'?'https://': 'http://';
if ($r['type']=='code') {
$db = h5_base::load_model('poster_model');
$rs = $db->get_one(array('spaceid'=>$r['spaceid'],'siteid'=>$this->get_siteid()),'setting','`id` ASC');
if ($rs['setting']) {
$d = string2array($rs['setting']);
$data = $d['code'];
}
}else {
$path = APP_PATH.'caches/'.$r['path'];
}
include $this->admin_tpl('space_preview');
}
}
private function template_type() {
h5_base::load_app_func('global','poster');
return get_types();
}
public function delete() {
if ((!isset($_GET['spaceid']) ||empty($_GET['spaceid'])) &&(!isset($_POST['spaceid']) ||empty($_POST['spaceid']))) {
showmessage(L('illegal_parameters'),HTTP_REFERER);
}else {
if (is_array($_POST['spaceid'])) {
array_map(array($this,_del),$_POST['spaceid']);
}elseif($_GET['spaceid']) {
$_GET['spaceid'] = intval($_GET['spaceid']);
$db = h5_base::load_model('poster_model');
$db->delete(array('siteid'=>$this->get_siteid(),'spaceid'=>$_GET['spaceid']));
$this->db->delete(array('siteid'=>$this->get_siteid(),'spaceid'=>$_GET['spaceid']));
}
showmessage(L('operation_success'),HTTP_REFERER);
}
}
private function _del($spaceid = 0) {
$spaceid = intval($spaceid);
if (!$spaceid) return false;
$db = h5_base::load_model('poster_model');
$db->delete(array('siteid'=>$this->get_siteid(),'spaceid'=>$spaceid));
$this->db->delete(array('siteid'=>$this->get_siteid(),'spaceid'=>$spaceid));
return true;
}
public function setting() {
if (isset($_POST['dosubmit'])) {
$setting = getcache('poster','commons');
$setting[$this->get_siteid()] = $_POST['setting'];
setcache('poster',$setting,'commons');
$m_db = h5_base::load_model('module_model');
$setting = array2string($_POST['setting']);
$m_db->update(array('setting'=>$setting),array('module'=>ROUTE_M));
showmessage(L('setting_updates_successful'),HTTP_REFERER,'','setting');
}else {
@extract($this->M);
include $this->admin_tpl('setting');
}
}
public function poster_template() {
$tpl_root = h5_base::load_config('system','tpl_root');
$templatedir = H5_PATH.$tpl_root.h5_base::load_config('system','tpl_name').DIRECTORY_SEPARATOR.'poster'.DIRECTORY_SEPARATOR;
$poster_template = getcache('poster_template_'.get_siteid(),'commons');
$templates = glob($templatedir.'*.html');
if (is_array($templates) &&!empty($templates)) {
foreach ($templates as $k =>$tem) {
$templates[$k] = basename($tem,".html");
}
}
$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?s=poster/space/add\', title:\''.L('add_space').'\', width:\'540\', height:\'320\'}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);',L('add_space'));
include $this->admin_tpl('poster_template');
}
public function public_tempate_del() {
if (!isset($_GET['id'])) showmessage(L('illegal_parameters'),HTTP_REFERER);
$siteid = $this->get_siteid();
$poster_template = getcache('poster_template_'.$siteid,'commons');
if ($poster_template[$_GET['id']]) {
unset($poster_template[$_GET['id']]);
}
setcache('poster_template_'.$siteid,$poster_template,'commons');
showmessage(L('operation_success'),HTTP_REFERER);
}
public function public_tempate_setting() {
$siteid = $this->get_siteid();
$poster_template = getcache('poster_template_'.$siteid,'commons');
if (isset($_POST['dosubmit'])) {
if (is_array($_POST['info']['type']) &&!empty($_POST['info']['type'])) {
$type2name = array('images'=>L('photo'),'flash'=>L('flash'),'text'=>L('title'));
$type = array();
foreach ($_POST['info']['type'] as $t) {
if (in_array($t,array('images','flash','text'))) {
$type[$t] = $type2name[$t];
}else {
continue;
}
}
}
unset($_POST['info']['type']);
$_POST['info']['type'] = $type;
$poster_template[$_POST['template']] = $_POST['info'];
setcache('poster_template_'.$siteid,$poster_template,'commons');
showmessage(L('setting_success'),'','','testIframe');
}else {
if (!isset($_GET['template'])) {
showmessage(L('illegal_parameters'));
}else {
$template = $_GET['template'];
}
if ($poster_template[$template]) {
$info = $poster_template[$template];
if (is_array($info['type']) &&!empty($info['type'])) {
$type = array();
$type = array_keys($info['type']);
unset($info['type']);
$info['type'] = $type;
}
}
include $this->admin_tpl('template_setting');
}
}
public function create_js($page = 0) {
$page = max(intval($_GET['page']),1);
if ($page==1) {
$result = $this->db->get_one(array('disabled'=>0,'siteid'=>get_siteid()),'COUNT(*) AS num');
if ($result['num']) {
$total = $result['num'];
$pages = ceil($total/20);
}
}else {
$pages = $_GET['pages'] ?intval($_GET['pages']) : 0;
}
$offset = ($page-1)*20;
$data = $this->db->listinfo(array('disabled'=>0,'siteid'=>get_siteid()),'spaceid ASC',$page);
$html = h5_base::load_app_class('html');
foreach ($data as $d) {
if ($d['type']!='code') {
$html->create_js($d['spaceid']);
}else {
continue;
}
}
$page++;
if ($page>$pages) {
showmessage(L('update_js_success'),'?s=poster/space/init');
}else {
showmessage(L('update_js').'<font style="color:red">'.($page-1).'/'.$pages.'</font>','?s=poster/space/create_js/page/'.$page.'/pages/'.$pages);
}
}
public function public_check_space() {
if (!$_GET['name']) exit(0);
if (h5_base::load_config('system','charset')=='gbk') {
$_GET['name'] = iconv('UTF-8','GBK',$_GET['name']);
}
$name = $_GET['name'];
if ($_GET['spaceid']) {
$spaceid = intval($_GET['spaceid']);
$r = $this->db->get_one(array('spaceid'=>$spaceid,'siteid'=>$this->get_siteid()));
if ($r['name'] == $name) {
exit('1');
}
}
$r = $this->db->get_one(array('siteid'=>$this->get_siteid(),'name'=>$name),'spaceid');
if ($r['spaceid']) {
exit('0');
}else {
exit('1');
}
}
private function check($data = array()) {
if ($data['name'] == '') showmessage(L('name_plates_not_empty'));
$info = $this->db->get_one(array('name'=>$data['name'],'siteid'=>$this->get_siteid()),'spaceid');
if (($info['spaceid'] &&$info['spaceid']!=$_GET['spaceid']) ||($info['spaceid'] &&!isset($_GET['spaceid']))) {
showmessage(L('space_exist'),HTTP_REFERER);
}
if ((!isset($data['width']) ||$data['width']==0) &&in_array($data['type'],array('banner','fixure','float','couplet','imagechange','imagelist'))) {
showmessage(L('plate_width_not_empty'),HTTP_REFERER);
}else {
$data['width'] = intval($data['width']);
}
if ((!isset($data['height']) ||$data['height']==0) &&in_array($data['type'],array('banner','fixure','float','couplet','imagechange','imagelist'))) {
showmessage(L('plate_height_not_empty'),HTTP_REFERER);
}else {
$data['height'] = intval($data['height']);
}
$TYPES = $this->template_type();
return $data;
}
}
?>