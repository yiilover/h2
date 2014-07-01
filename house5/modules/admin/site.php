<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
class site extends admin {
private $db;
public function __construct() {
$this->db = h5_base::load_model('site_model');
parent::__construct();
}
public function init() {
$total = $this->db->count();
$page = isset($_GET['page']) &&intval($_GET['page']) ?intval($_GET['page']) : 1;
$pagesize = 20;
$offset = ($page -1) * $pagesize;
$list = $this->db->select('','*',$offset.','.$pagesize);
$pages = pages($total,$page,$pagesize);
$show_dialog = true;
include $this->admin_tpl('site_list');
}
public function add() {
header("Cache-control: private");
if (isset($_GET['show_header'])) $show_header = 1;
if (isset($_POST['dosubmit'])) {
$name = isset($_POST['name']) &&trim($_POST['name']) ?trim($_POST['name']) : showmessage(L('site_name').L('empty'));
$dirname = isset($_POST['dirname']) &&trim($_POST['dirname']) ?strtolower(trim($_POST['dirname'])) : showmessage(L('site_dirname').L('empty'));
$domain = isset($_POST['domain']) &&trim($_POST['domain']) ?trim($_POST['domain']) : '';
$site_title = isset($_POST['site_title']) &&trim($_POST['site_title']) ?trim($_POST['site_title']) : '';
$keywords = isset($_POST['keywords']) &&trim($_POST['keywords']) ?trim($_POST['keywords']) : '';
$description = isset($_POST['description']) &&trim($_POST['description']) ?trim($_POST['description']) : '';
$release_point = isset($_POST['release_point']) ?$_POST['release_point'] : '';
$template = isset($_POST['template']) &&!empty($_POST['template']) ?$_POST['template'] : showmessage(L('please_select_a_style'));
$default_style = isset($_POST['default_style']) &&!empty($_POST['default_style']) ?$_POST['default_style'] : showmessage(L('please_choose_the_default_style'));
if ($this->db->get_one(array('name'=>$name),'siteid')) {
showmessage(L('site_name').L('exists'));
}
if (!preg_match('/^\\w+$/i',$dirname)) {
showmessage(L('site_dirname').L('site_dirname_err_msg'));
}
if ($this->db->get_one(array('dirname'=>$dirname),'siteid')) {
showmessage(L('site_dirname').L('exists'));
}
if (!empty($domain) &&!preg_match('/http:\/\/(.+)\/$/i',$domain)) {
showmessage(L('site_domain').L('site_domain_ex2'));
}
if (!empty($domain) &&$this->db->get_one(array('domain'=>$domain),'siteid')) {
showmessage(L('site_domain').L('exists'));
}
if (!empty($release_point) &&is_array($release_point)) {
if (count($release_point) >4) {
showmessage(L('release_point_configuration').L('most_choose_four'));
}
$s = '';
foreach ($release_point as $key=>$val) {
if($val) $s.= $s ?",$val": $val;
}
$release_point = $s;
unset($s);
}else {
$release_point = '';
}
if (!empty($template) &&is_array($template)) {
$template = implode(',',$template);
}else {
$template = '';
}
$_POST['setting']['watermark_img'] = IMG_PATH.'water/'.$_POST['setting']['watermark_img'];
$setting = trim(array2string($_POST['setting']));
if ($this->db->insert(array('name'=>$name,'dirname'=>$dirname,'domain'=>$domain,'site_title'=>$site_title,'keywords'=>$keywords,'description'=>$description,'release_point'=>$release_point,'template'=>$template,'setting'=>$setting,'default_style'=>$default_style))) {
$class_site = h5_base::load_app_class('sites');
$class_site->set_cache();
showmessage(L('operation_success'),'?s=admin/site/init','','add');
}else {
showmessage(L('operation_failure'));
}
}else {
$release_point_db = h5_base::load_model('release_point_model');
$release_point_list = $release_point_db->select('','id, name');
$show_validator = $show_scroll = $show_header = true;
$template_list = template_list();
include $this->admin_tpl('site_add');
}
}
public function del() {
$siteid = isset($_GET['siteid']) &&intval($_GET['siteid']) ?intval($_GET['siteid']) : showmessage(L('illegal_parameters'),HTTP_REFERER);
if($siteid==1) showmessage(L('operation_failure'),HTTP_REFERER);
if ($this->db->get_one(array('siteid'=>$siteid))) {
if ($this->db->delete(array('siteid'=>$siteid))) {
$class_site = h5_base::load_app_class('sites');
$class_site->set_cache();
showmessage(L('operation_success'),HTTP_REFERER);
}else {
showmessage(L('operation_failure'),HTTP_REFERER);
}
}else {
showmessage(L('notfound'),HTTP_REFERER);
}
}
public function edit() {
$siteid = isset($_GET['siteid']) &&intval($_GET['siteid']) ?intval($_GET['siteid']) : showmessage(L('illegal_parameters'),HTTP_REFERER);
if ($data = $this->db->get_one(array('siteid'=>$siteid))) {
if (isset($_POST['dosubmit'])) {
$name = isset($_POST['name']) &&trim($_POST['name']) ?trim($_POST['name']) : showmessage(L('site_name').L('empty'));
$dirname = isset($_POST['dirname']) &&trim($_POST['dirname']) ?strtolower(trim($_POST['dirname'])) : ($siteid == 1 ?'':showmessage(L('site_dirname').L('empty')));
$domain = isset($_POST['domain']) &&trim($_POST['domain']) ?trim($_POST['domain']) : '';
$site_title = isset($_POST['site_title']) &&trim($_POST['site_title']) ?trim($_POST['site_title']) : '';
$keywords = isset($_POST['keywords']) &&trim($_POST['keywords']) ?trim($_POST['keywords']) : '';
$description = isset($_POST['description']) &&trim($_POST['description']) ?trim($_POST['description']) : '';
$copyright = isset($_POST['copyright']) &&trim($_POST['copyright']) ?trim($_POST['copyright']) : '';
$default_city = isset($_POST['default_city']) &&trim($_POST['default_city']) ?trim($_POST['default_city']) : '';
$city_map = isset($_POST['city_map']) &&trim($_POST['city_map']) ?trim($_POST['city_map']) : '';
$map_key = isset($_POST['map_key']) &&trim($_POST['map_key']) ?trim($_POST['map_key']) : '';
$release_point = isset($_POST['release_point']) ?$_POST['release_point'] : '';
$template = isset($_POST['template']) &&!empty($_POST['template']) ?$_POST['template'] : showmessage(L('please_select_a_style'));
$default_style = isset($_POST['default_style']) &&!empty($_POST['default_style']) ?$_POST['default_style'] : showmessage(L('please_choose_the_default_style'));
if ($data['name'] != $name &&$this->db->get_one(array('name'=>$name),'siteid')) {
showmessage(L('site_name').L('exists'));
}
if ($siteid != 1) {
if (!preg_match('/^\\w+$/i',$dirname)) {
showmessage(L('site_dirname').L('site_dirname_err_msg'));
}
if ($data['dirname'] != $dirname &&$this->db->get_one(array('dirname'=>$dirname),'siteid')) {
showmessage(L('site_dirname').L('exists'));
}
}
if (!empty($domain) &&!preg_match('/http:\/\/(.+)\/$/i',$domain)) {
showmessage(L('site_domain').L('site_domain_ex2'));
}
if (!empty($domain) &&$data['domain'] != $domain &&$this->db->get_one(array('domain'=>$domain),'siteid')) {
showmessage(L('site_domain').L('exists'));
}
if (!empty($release_point) &&is_array($release_point)) {
if (count($release_point) >4) {
showmessage(L('release_point_configuration').L('most_choose_four'));
}
$s = '';
foreach ($release_point as $key=>$val) {
if($val) $s.= $s ?",$val": $val;
}
$release_point = $s;
unset($s);
}else {
$release_point = '';
}
if (!empty($template) &&is_array($template)) {
$template = implode(',',$template);
}else {
$template = '';
}
$_POST['setting']['watermark_img'] = 'statics/images/water/'.$_POST['setting']['watermark_img'];
$setting = trim(array2string($_POST['setting']));
$sql = array('name'=>$name,'dirname'=>$dirname,'domain'=>$domain,'site_title'=>$site_title,'keywords'=>$keywords,'description'=>$description,'copyright'=>$copyright,'default_city'=>$default_city,'city_map'=>$city_map,'map_key'=>$map_key,'release_point'=>$release_point,'template'=>$template,'setting'=>$setting,'default_style'=>$default_style);
if ($siteid == 1) unset($sql['dirname']);
if ($this->db->update($sql,array('siteid'=>$siteid))) {
$class_site = h5_base::load_app_class('sites');
$class_site->set_cache();
showmessage(L('operation_success'),'','','edit');
}else {
showmessage(L('operation_failure'));
}
}else {
$show_validator = true;
$show_header = true;
$show_scroll = true;
$template_list = template_list();
$setting = string2array($data['setting']);
$setting['watermark_img'] = str_replace('statics/images/water/','',$setting['watermark_img']);
$release_point_db = h5_base::load_model('release_point_model');
$release_point_list = $release_point_db->select('','id, name');
include $this->admin_tpl('site_edit');
}
}else {
showmessage(L('notfound'),HTTP_REFERER);
}
}
public function public_name() {
$name = isset($_GET['name']) &&trim($_GET['name']) ?(h5_base::load_config('system','charset') == 'gbk'?iconv('utf-8','gbk',trim($_GET['name'])) : trim($_GET['name'])) : exit('0');
$siteid = isset($_GET['siteid']) &&intval($_GET['siteid']) ?intval($_GET['siteid']) : '';
$data = array();
if ($siteid) {
$data = $this->db->get_one(array('siteid'=>$siteid),'name');
if (!empty($data) &&$data['name'] == $name) {
exit('1');
}
}
if ($this->db->get_one(array('name'=>$name),'siteid')) {
exit('0');
}else {
exit('1');
}
}
public function public_dirname() {
$dirname = isset($_GET['dirname']) &&trim($_GET['dirname']) ?(h5_base::load_config('system','charset') == 'gbk'?iconv('utf-8','gbk',trim($_GET['dirname'])) : trim($_GET['dirname'])) : exit('0');
$siteid = isset($_GET['siteid']) &&intval($_GET['siteid']) ?intval($_GET['siteid']) : '';
$data = array();
if ($siteid) {
$data = $this->db->get_one(array('siteid'=>$siteid),'dirname');
if (!empty($data) &&$data['dirname'] == $dirname) {
exit('1');
}
}
if ($this->db->get_one(array('dirname'=>$dirname),'siteid')) {
exit('0');
}else {
exit('1');
}
}
private function check_gd() {
if(!function_exists('imagepng') &&!function_exists('imagejpeg') &&!function_exists('imagegif')) {
$gd = L('gd_unsupport');
}else {
$gd = L('gd_support');
}
return $gd;
}
}?>