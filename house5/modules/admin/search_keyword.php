<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
class search_keyword extends admin {
function __construct() {
$this->db = h5_base::load_model('search_keyword_model');
parent::__construct();
}
function init () {
$page = $_GET['page'] ?intval($_GET['page']) : '1';
$infos = $this->db->listinfo('','searchnums DESC',$page ,'20');
$pages = $this->db->pages;
$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?s=admin/search_keyword/add\', title:\''.L('search_word_add').'\', width:\'450\', height:\'150\'}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);',L('search_word_add'));
include $this->admin_tpl('search_keyword_list');
}
function add() {
if(isset($_POST['dosubmit'])){
if(empty($_POST['info']['keyword']) ||empty($_POST['info']['pinyin']) ||empty($_POST['info']['searchnums'])){
echo L('search_word_error_input');
return false;
}
$this->db->insert($_POST['info']);
showmessage(L('operation_success'),'?s=admin/search_keyword/add','','add');
}else{
$show_validator = $show_scroll = $show_header = true;
include $this->admin_tpl('search_keyword_add');
}
}
function edit() {
if(isset($_POST['dosubmit'])){
$keywordid = intval($_GET['keywordid']);
if(empty($_POST['info']['keyword']) ||empty($_POST['info']['pinyin']) ||empty($_POST['info']['searchnums'])){
echo L('search_word_error_input');
return false;
}
$this->db->update($_POST['info'],array('keywordid'=>$keywordid));
showmessage(L('operation_success'),'?s=admin/search_keyword/edit','','edit');
}else{
$show_validator = $show_scroll = $show_header = true;
$info = $this->db->get_one(array('keywordid'=>$_GET['keywordid']));
if(!$info) showmessage(L('specified_word_not_exist'));
extract($info);
include $this->admin_tpl('search_keyword_edit');
}
}
function delete() {
if(is_array($_POST['keywordid'])){
foreach($_POST['keywordid'] as $keywordid_arr) {
$this->db->delete(array('keywordid'=>$keywordid_arr));
}
showmessage(L('operation_success'),'?s=admin/search_keyword/init');
}else {
$keywordid = intval($_GET['keywordid']);
if($keywordid <1) return false;
$result = $this->db->delete(array('keywordid'=>$keywordid));
if($result){
showmessage(L('operation_success'),'?s=admin/search_keyword/init');
}else {
showmessage(L("operation_failure"),'?s=admin/search_keyword/init');
}
}
}
}
?>