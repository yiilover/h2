<?php

defined('IN_HOUSE5') or exit('No permission resources.');
class index {
function __construct() {
h5_base::load_app_func('global');
$siteid = isset($_GET['siteid']) ?intval($_GET['siteid']) : get_siteid();
define("SITEID",$siteid);
}
public function init() {
$siteid = SITEID;
$setting = getcache('link','commons');
$SEO = seo(SITEID,'',L('link'),'','');
include template('link','index');
}
public function list_type() {
$siteid = SITEID;
$type_id = trim(urldecode($_GET['type_id']));
$type_id = intval($type_id);
if($type_id==""){
$type_id ='0';
}
$setting = getcache('link','commons');
$SEO = seo(SITEID,'',L('link'),'','');
include template('link','list_type');
}
public function register() {
$siteid = SITEID;
if(isset($_POST['dosubmit'])){
if($_POST['name']==""){
showmessage(L('sitename_noempty'),"?s=link/index/register/siteid/$siteid");
}
if($_POST['url']==""){
showmessage(L('siteurl_not_empty'),"?s=link/index/register/siteid/$siteid");
}
if(!in_array($_POST['linktype'],array('0','1'))){
$_POST['linktype'] = '0';
}
$link_db = h5_base::load_model(link_model);
$_POST['logo'] =new_html_special_chars($_POST['logo']);
$logo = safe_replace($_POST['logo']);
$name = safe_replace($_POST['name']);
$url = safe_replace($_POST['url']);
if($_POST['linktype']=='0'){
$sql = array('siteid'=>$siteid,'typeid'=>intval($_POST['typeid']),'linktype'=>intval($_POST['linktype']),'name'=>$name,'url'=>$url);
}else{
$sql = array('siteid'=>$siteid,'typeid'=>intval($_POST['typeid']),'linktype'=>intval($_POST['linktype']),'name'=>$name,'url'=>$url,'logo'=>$logo);
}
$link_db->insert($sql);
showmessage(L('add_success'),"?s=link/index/siteid/$siteid");
}else {
$setting = getcache('link','commons');
$setting = $setting[$siteid];
if($setting['is_post']=='0'){
showmessage(L('suspend_application'),HTTP_REFERER);
}
$this->type = h5_base::load_model('type_model');
$types = $this->type->get_types($siteid);
h5_base::load_sys_class('form','',0);
$SEO = seo(SITEID,'',L('application_links'),'','');
include template('link','register');
}
}
}
?>