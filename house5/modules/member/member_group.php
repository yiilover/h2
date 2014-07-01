<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
h5_base::load_sys_class('form','',0);
class member_group extends admin {
private $db;
function __construct() {
parent::__construct();
$this->db = h5_base::load_model('member_group_model');
}
function init() {
include $this->admin_tpl('member_init');
}
function manage() {
$page = isset($_GET['page']) ?intval($_GET['page']) : 1;
$modelid = isset($_GET['modelid']) ?intval($_GET['modelid']) : '';
$where = '';
if($modelid)
{
$add = '/modelid/'.$modelid;
$where = array('modelid'=>$modelid);
}
else
{
$where = "modelid='10' or modelid=0";
}
$member_group_list = $this->db->listinfo($where,'sort ASC',$page,15);
$this->member_db = h5_base::load_model('member_model');
foreach ($member_group_list as $k=>$v) {
$membernum = $this->member_db->count(array('groupid'=>$v['groupid']));
$member_group_list[$k]['membernum'] = $membernum;
}
$pages = $this->db->pages;
$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?s=member/member_group/add'.$add.'\', title:\'添加组\', width:\'700\', height:\'500\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);','添加组');
include $this->admin_tpl('member_group_list');
}
function add() {
if(isset($_POST['dosubmit'])) {
$info = array();
if(!$this->_checkname($_POST['info']['name'])){
showmessage('会员组名称已经存在');
}
$info = $_POST['info'];
$info['modelid'] = !empty($info['modelid']) ?intval($info['modelid']) : '10';
$info['allowpost'] = $info['allowpost'] ?1 : 0;
$info['allowupgrade'] = $info['allowupgrade'] ?1 : 0;
$info['allowpostverify'] = $info['allowpostverify'] ?1 : 0;
$info['allowsendmessage'] = $info['allowsendmessage'] ?1 : 0;
$info['allowattachment'] = $info['allowattachment'] ?1 : 0;
$info['allowsearch'] = $info['allowsearch'] ?1 : 0;
$info['allowvisit'] = $info['allowvisit'] ?1 : 0;
$this->db->insert($info);
if($this->db->insert_id()){
$this->_updatecache();
showmessage(L('operation_success'),'?s=member/member_group/manage','','add');
}
}else {
$show_header = $show_scroll = true;
include $this->admin_tpl('member_group_add');
}
}
function edit() {
if(isset($_POST['dosubmit'])) {
$info = array();
$info = $_POST['info'];
$info['allowpost'] = isset($info['allowpost']) ?1 : 0;
$info['allowupgrade'] = isset($info['allowupgrade']) ?1 : 0;
$info['allowpostverify'] = isset($info['allowpostverify']) ?1 : 0;
$info['allowsendmessage'] = isset($info['allowsendmessage']) ?1 : 0;
$info['allowattachment'] = isset($info['allowattachment']) ?1 : 0;
$info['allowsearch'] = isset($info['allowsearch']) ?1 : 0;
$info['allowvisit'] = isset($info['allowvisit']) ?1 : 0;
$this->db->update($info,array('groupid'=>$info['groupid']));
$this->_updatecache();
showmessage(L('operation_success'),'?s=member/member_group/manage','','edit');
}else {
$show_header = $show_scroll = true;
$groupid = isset($_GET['groupid']) ?$_GET['groupid'] : showmessage(L('illegal_parameters'),HTTP_REFERER);
$groupinfo = $this->db->get_one(array('groupid'=>$groupid));
$siteid = get_siteid();
$member_model_cache = getcache('member_model','commons');
foreach($member_model_cache as $_key=>$_value) {
if($siteid == $_value['siteid']) {
$modellist[$_key] = $_value['name'];
}
}
$modelid = !empty($_GET['modelid']) ?intval($_GET['modelid']) : $groupinfo['modelid'];
include $this->admin_tpl('member_group_edit');
}
}
function sort() {
if(isset($_POST['sort'])) {
foreach($_POST['sort'] as $k=>$v) {
$this->db->update(array('sort'=>$v),array('groupid'=>$k));
}
$this->_updatecache();
showmessage(L('operation_success'),HTTP_REFERER);
}else {
showmessage(L('operation_failure'),HTTP_REFERER);
}
}
function delete() {
$groupidarr = isset($_POST['groupid']) ?$_POST['groupid'] : showmessage(L('illegal_parameters'),HTTP_REFERER);
$where = to_sqls($groupidarr,'','groupid');
if ($this->db->delete($where)) {
$this->_updatecache();
showmessage(L('operation_success'),HTTP_REFERER);
}else {
showmessage(L('operation_failure'),HTTP_REFERER);
}
}
private function _checkname($name = NULL) {
if(empty($name)) return false;
if ($this->db->get_one(array('name'=>$name),'groupid')){
return false;
}
return true;
}
private function _updatecache() {
$grouplist = $this->db->listinfo('','',1,1000,'groupid');
setcache('grouplist',$grouplist);
}
public function public_checkname_ajax() {
$name = isset($_GET['name']) &&trim($_GET['name']) ?trim($_GET['name']) : exit(0);
$name = iconv('utf-8',CHARSET,$name);
$oldgroupname = $_GET['oldgroupname'];
if($name==$oldgroupname) exit('1');
if ($this->db->get_one(array('name'=>$name),'groupid')){
exit('0');
}else {
exit('1');
}
}
}
?>