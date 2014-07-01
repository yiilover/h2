<?php
 
defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
h5_base::load_app_func('global','poster');
class poster extends admin {
private $db,$s_db;
function __construct() {
parent::__construct();
$this->s_db = h5_base::load_model('poster_space_model');
$this->db = h5_base::load_model('poster_model');
$setting = new_html_special_chars(getcache('poster','commons'));
$this->M = $setting[$this->get_siteid()];
}
public function init() {
$spaceid = $_GET['spaceid'] ?intval($_GET['spaceid']) : 0;
if (!isset($spaceid) ||empty($spaceid)) {
showmessage(L('illegal_action'),HTTP_REFERER);
}
$page = max($_GET['page'],1);
$infos = $this->db->listinfo(array('spaceid'=>$spaceid,'siteid'=>$this->get_siteid()),'`listorder` ASC, `id` DESC',$page);
h5_base::load_sys_class('format','',0);
$types = array('images'=>L('photo'),'flash'=>L('flash'),'text'=>L('title'));
$show_dialog = $show_header = true;
$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?s=poster/space/add\', title:\''.L('add_space').'\', width:\'540\', height:\'320\'}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);',L('add_space'));
include $this->admin_tpl('poster_list');
}
public function add() {
if (isset($_POST['dosubmit'])) {
$poster = $this->check($_POST['poster']);
$setting = $this->check_setting($_POST['setting'],$poster['type']);
$poster['siteid'] = $this->get_siteid();
$poster['setting'] = array2string($setting);
$poster['addtime'] = SYS_TIME;
$id = $this->db->insert($poster,true);
if ($id) {
$this->s_db->update(array('items'=>'+=1'),array('spaceid'=>$poster['spaceid'],'siteid'=>$this->get_siteid()));
$this->create_js($poster['spaceid']);
foreach ($setting['images'] as $im) {
$imgs[] = $im['imageurl'];
}
if (h5_base::load_config('system','attachment_stat')) {
$this->attachment_db = h5_base::load_model('attachment_model');
$this->attachment_db->api_update($imgs,'poster-'.$id,1);
}
showmessage(L('add_ads_success'),'index.php?s=poster/space/init');
}else {
showmessage(L('operation_failure'),'index.php?s=poster/space/init');
}
}else {
$spaceid = intval($_GET['spaceid']);
$sinfo = $this->s_db->get_one(array('spaceid'=>$spaceid,'siteid'=>$this->get_siteid()),'name, type');
$setting = $this->get_setting($sinfo['type']);
$TYPES = get_types();
$default = count($setting)>0 ?L('please_select').'&nbsp;&nbsp;&nbsp;&nbsp;': '';
}
$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?s=poster/space/add\', title:\''.L('add_space').'\', width:\'540\', height:\'320\'}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);',L('add_space'));
h5_base::load_sys_class('form','',0);
include $this->admin_tpl('poster_add');
}
public function edit() {
$_GET['id'] = intval($_GET['id']);
if (!$_GET['id']) showmessage(L('illegal_action'),HTTP_REFERER);
if (isset($_POST['dosubmit'])) {
$poster = $this->check($_POST['poster']);
$setting = $this->check_setting($_POST['setting'],$poster['type']);
$poster['setting'] = array2string($setting);
$this->db->update($poster,array('id'=>$_GET['id'],'siteid'=>$this->get_siteid()));
$this->create_js(intval($_GET['spaceid']));
foreach ($setting as $im) {
$imgs[] = $im['imageurl'];
}
if(h5_base::load_config('system','attachment_stat')) {
$this->attachment_db = h5_base::load_model('attachment_model');
$this->attachment_db->api_update($imgs,'poster-'.$_GET['id'],1);
}
showmessage(L('edit_ads_success'),'index.php?s=poster/poster/init/spaceid/'.$_GET['spaceid']);
}else {
$info = $this->db->get_one(array('id'=>$_GET['id'],'siteid'=>$this->get_siteid()));
$sinfo = $this->s_db->get_one(array('spaceid'=>$info['spaceid'],'siteid'=>$this->get_siteid()),'name, type');
$setting = $this->get_setting($sinfo['type']);
$TYPES = get_types();
$info['setting'] = string2array($info['setting']);
$default = count($setting)>0 ?L('please_select').'&nbsp;&nbsp;&nbsp;&nbsp;': '';
$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?s=poster/space/add\', title:\''.L('add_space').'\', width:\'540\', height:\'320\'}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);',L('add_space'));
h5_base::load_sys_class('form','',0);
include $this->admin_tpl('poster_edit');
}
}
public function listorder() {
if (isset($_POST['listorder']) &&is_array($_POST['listorder'])) {
$listorder = $_POST['listorder'];
foreach ($listorder as $k =>$v) {
$this->db->update(array('listorder'=>$v),array('id'=>$k));
}
}
showmessage(L('operation_success'),HTTP_REFERER);
}
private function create_js($id = 0) {
$html = h5_base::load_app_class('html');
if (!$html->create_js($id)) showmessge($html->msg,HTTP_REFERER);
return true;
}
public function public_approval() {
if (!isset($_POST['id']) ||!is_array($_POST['id'])) {
showmessage(L('illegal_parameters'),HTTP_REFERER);
}else {
array_map(array($this,_approval),$_POST['id']);
}
showmessage(L('operation_success'),HTTP_REFERER);
}
private function _approval($id = 0) {
$id = intval($id);
if (!$id) return false;
$_GET['passed'] = intval($_GET['passed']);
$this->db->update(array('disabled'=>$_GET['passed'] ),array('id'=>$id,'siteid'=>$this->get_siteid()));
return true;
}
public function delete() {
if (!isset($_POST['id']) ||!is_array($_POST['id'])) {
showmessage(L('illegal_parameters'),HTTP_REFERER);
}else {
array_map(array($this,_del),$_POST['id']);
}
showmessage(L('operation_success'),HTTP_REFERER);
}
private function _del($id = 0) {
$id = intval($id);
if (!$id) return false;
$r = $this->db->get_one(array('id'=>$id,'siteid'=>$this->get_siteid()),'spaceid');
$this->s_db->update(array('items'=>'-=1'),array('spaceid'=>$r['spaceid'],'siteid'=>$this->get_siteid()));
$this->db->delete(array('id'=>$id,'siteid'=>$this->get_siteid()));
if (h5_base::load_config('system','attachment_stat')) {
$this->attachment_db = h5_base::load_model('attachment_model');
$keyid = 'poster-'.$id;
$this->attachment_db->api_delete($keyid);
}
return true;
}
public function stat() {
$_GET['id'] = intval($_GET['id']);
$info = $this->db->get_one(array('id'=>$_GET['id']),'spaceid');
if (!$_GET['id']) showmessage(L('illegal_operation'));
$sdb = h5_base::load_model('poster_stat_model');
$year = date('Y',SYS_TIME);
$month = date('m',SYS_TIME);
$day = date('d',SYS_TIME);
$where = $group = $order = '';
$fields = '*';
$where = "`pid`='".$_GET['id']."' AND `siteid`='".$this->get_siteid()."'";
if ($_GET['range'] == 2) {
$fromtime = mktime(0,0,0,$month,$day-2,$year);
$totime = mktime(0,0,0,$month,$day-1,$year);
$where .= " AND `clicktime`>='".$fromtime."'";
$where .= " AND `clicktime`<='".$totime."'";
}elseif(is_numeric($_GET['range'])) {
$fromtime = mktime(0,0,0,$month,$day-$_GET['range'],$year);
$where .= " AND `clicktime`>='".$fromtime."'";
}
$order = '`clicktime` DESC';
$_GET['click'] = isset($_GET['click']) ?intval($_GET['click']) : 0;
if (is_numeric($_GET['click'])) {
$_GET['click'] = intval($_GET['click']);
$where .= " AND `type`='".$_GET['click']."'";
if ($_GET['group']) {
$group = " `".$_GET['group']."`";
$fields = "*, COUNT(".$_GET['group'].") AS num";
$order = " `num` DESC";
}
$r = $sdb->get_one($where,'COUNT(*) AS num','',$group);
}else {
$r = $sdb->get_one($where,'COUNT(*) AS num');
}
$page = max(intval($_GET['page']),1);
$curr_page = 20;
$limit = ($page-1)*$curr_page.','.$curr_page;
$pages = pages($r['num'],$page,20);
$data = $sdb->select($where,$fields,$limit,$order,$group);
$selectstr = $sdb->get_list($_GET['year']);
h5_base::load_sys_class('format','',0);
$show_header = true;
unset($r);
include $this->admin_tpl('poster_stat');
}
private function get_setting($type) {
$data = $poster_template = array();
$poster_template = getcache('poster_template_'.$this->get_siteid(),'commons');
if (is_array($poster_template) &&!empty($poster_template)) {
$data = $poster_template[$type];
}else {
switch($type) {
case 'banner':
$data['type'] = array('images'=>L('photo'),'flash'=>L('flash'));
$data['num'] = 1;
break;
case 'fixure':
$data['type'] = array('images'=>L('photo'),'flash'=>L('flash'));
$data['num'] = 1;
break;
case 'float':
$data['type'] = array('images'=>L('photo'),'flash'=>L('flash'));
$data['num'] = 1;
break;
case 'couplet':
$data['type'] = array('images'=>L('photo'),'flash'=>L('flash'));
$data['num'] = 2;
break;
case 'imagechange':
$data['type'] = array('images'=>L('photo'));
$data['num'] = 1;
break;
case 'imagelist':
$data['type'] = array('images'=>L('photo'));
$data['num'] = 1;
break;
case 'text':
$data['type'] = array('text'=>L('title'));
break;
case 'code':
$data['type'] = array('text'=>L('title'));
break;
default :
$data['type'] = array('images'=>L('photo'),'flash'=>L('flash'));
$data['num'] = 1;
}
}
return $data;
}
private function check($data) {
if (!isset($data['name']) ||empty($data['name'])) showmessage(L('adsname_no_empty'),HTTP_REFERER);
if (!isset($data['type']) ||empty($data['type'])) showmessage(L('no_ads_type'),HTTP_REFERER);
$data['startdate'] = $data['startdate'] ?strtotime($data['startdate']) : SYS_TIME;
$data['enddate'] = $data['enddate'] ?strtotime($data['enddate']) : strtotime('next month',$data['startdate']);
if($data['startdate']>=$data['enddate']) $data['enddate'] = strtotime('next month',$data['startdate']);
return $data;
}
private function check_setting($setting = array(),$type = 'images') {
switch ($type) {
case 'images':
unset($setting['flash'],$setting['text']);
if(is_array($setting['images'])) {
$tag = 0;
foreach ($setting['images'] as $k =>$s) {
if($s['linkurl']=='http://') {
$setting['images'][$k]['linkurl'] = '';
}
if (!$s['imageurl']) unset($setting['images'][$k]);
else $tag = 1;
}
if (!$tag) showmessage(L('no_setting_photo'),HTTP_REFERER);
}
break;
case 'flash':
unset($setting['images'],$setting['text']);
if (is_array($setting['flash'])) {
$tag = 0;
foreach ($setting['flash'] as $k =>$s) {
if (!$s['flashurl']) unset($setting['flash'][$k]);
else $tag = 1;
}
if (!$tag) showmessage(L('no_flash_path'),HTTP_REFERER);
}
break;
case 'text':
unset($setting['images'],$setting['flash']);
if ((!isset($setting['text'][1]['title']) ||empty($setting['text'][1]['title'])) &&(!isset($setting['text']['code']) ||empty($setting['text']['code']))) {
showmessage(L('no_title_info'),HTTP_REFERER);
}
break;
}
return $setting[$type];
}
public function public_check_poster() {
if (!$_GET['name']) exit(0);
if (CHARSET=='gbk') {
$_GET['name'] = safe_replace(iconv('UTF-8','GBK',$_GET['name']));
}
if ($_GET['id']) {
$spaceid = intval($_GET['spaceid']);
$r = $this->db->get_one(array('id'=>$id));
if($r['name'] == $_GET['name']) {
exit('1');
}
}
$r = $this->db->get_one(array('siteid'=>$this->get_siteid(),'name'=>$_GET['name']),'id');
if ($r['id']) {
exit('0');
}else {
exit('1');
}
}
}
?>