<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
class admin_announce extends admin {
private $db;public $username;
public function __construct() {
parent::__construct();
$this->username = param::get_cookie('admin_username');
$this->db = h5_base::load_model('announce_model');
}
public function init() {
$sql = '';
$_GET['status'] = $_GET['status'] ?intval($_GET['status']) : 1;
$sql = '`siteid`=\''.$this->get_siteid().'\'';
switch($_GET['s']) {
case '1': $sql .= ' AND `passed`=\'1\' AND (`endtime` >= \''.date('Y-m-d').'\' or `endtime`=\'0000-00-00\')';break;
case '2': $sql .= ' AND `passed`=\'0\'';break;
case '3': $sql .= ' AND `passed`=\'1\' AND `endtime`!=\'0000-00-00\' AND `endtime` <\''.date('Y-m-d').'\' ';break;
}
$page = max(intval($_GET['page']),1);
$data = $this->db->listinfo($sql,'`aid` DESC',$page);
$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?s=announce/admin_announce/add\', title:\''.L('announce_add').'\', width:\'700\', height:\'500\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);',L('announce_add'));
include $this->admin_tpl('announce_list');
}
public function add() {
if(isset($_POST['dosubmit'])) {
$_POST['announce'] = $this->check($_POST['announce']);
if($this->db->insert($_POST['announce'])) showmessage(L('announcement_successful_added'),HTTP_REFERER,'','add');
}else {
h5_base::load_app_func('global','admin');
$siteid = $this->get_siteid();
$template_list = template_list($siteid,0);
$site = h5_base::load_app_class('sites','admin');
$info = $site->get_by_id($siteid);
foreach ($template_list as $k=>$v) {
$template_list[$v['dirname']] = $v['name'] ?$v['name'] : $v['dirname'];
unset($template_list[$k]);
}
$show_header = $show_validator = $show_scroll = 1;
h5_base::load_sys_class('form','',0);
include $this->admin_tpl('announce_add');
}
}
public function edit() {
$_GET['aid'] = intval($_GET['aid']);
if(!$_GET['aid']) showmessage(L('illegal_operation'));
if(isset($_POST['dosubmit'])) {
$_POST['announce'] = $this->check($_POST['announce'],'edit');
if($this->db->update($_POST['announce'],array('aid'=>$_GET['aid']))) showmessage(L('announced_a'),HTTP_REFERER,'','edit');
}else {
$where = array('aid'=>$_GET['aid']);
$an_info = $this->db->get_one($where);
h5_base::load_sys_class('form','',0);
h5_base::load_app_func('global','admin');
$template_list = template_list($this->siteid,0);
foreach ($template_list as $k=>$v) {
$template_list[$v['dirname']] = $v['name'] ?$v['name'] : $v['dirname'];
unset($template_list[$k]);
}
$show_header = $show_validator = $show_scroll = 1;
include $this->admin_tpl('announce_edit');
}
}
public function public_check_title() {
if (!$_GET['title']) exit(0);
if (CHARSET=='gbk') {
$_GET['title'] = iconv('UTF-8','GBK',$_GET['title']);
}
$title = $_GET['title'];
if ($_GET['aid']) {
$r = $this->db->get_one(array('aid'=>$_GET['aid']));
if ($r['title'] == $title) {
exit('1');
}
}
$r = $this->db->get_one(array('siteid'=>$this->get_siteid(),'title'=>$title),'aid');
if($r['aid']) {
exit('0');
}else {
exit('1');
}
}
public function public_approval($aid = 0) {
if((!isset($_POST['aid']) ||empty($_POST['aid'])) &&!$aid) {
showmessage(L('illegal_operation'));
}else {
if(is_array($_POST['aid']) &&!$aid) {
array_map(array($this,'public_approval'),$_POST['aid']);
showmessage(L('announce_passed'),HTTP_REFERER);
}elseif($aid) {
$aid = intval($aid);
$this->db->update(array('passed'=>$_GET['passed']),array('aid'=>$aid));
return true;
}
}
}
public function delete($aid = 0) {
if((!isset($_POST['aid']) ||empty($_POST['aid'])) &&!$aid) {
showmessage(L('illegal_operation'));
}else {
if(is_array($_POST['aid']) &&!$aid) {
array_map(array($this,'delete'),$_POST['aid']);
showmessage(L('announce_deleted'),HTTP_REFERER);
}elseif($aid) {
$aid = intval($aid);
$this->db->delete(array('aid'=>$aid));
}
}
}
private function check($data = array(),$a = 'add') {
if($data['title']=='') showmessage(L('title_cannot_empty'));
if($data['content']=='') showmessage(L('announcements_cannot_be_empty'));
$r = $this->db->get_one(array('title'=>$data['title']));
if (strtotime($data['endtime'])<strtotime($data['starttime'])) {
$data['endtime'] = '';
}
if ($a=='add') {
if (is_array($r) &&!empty($r)) {
showmessage(L('announce_exist'),HTTP_REFERER);
}
$data['siteid'] = $this->get_siteid();
$data['addtime'] = SYS_TIME;
$data['username'] = $this->username;
if ($data['starttime'] == '') $announce['starttime'] = date('Y-m-d');
}else {
if ($r['aid'] &&($r['aid']!=$_GET['aid'])) {
showmessage(L('announce_exist'),HTTP_REFERER);
}
}
return $data;
}
}
?>