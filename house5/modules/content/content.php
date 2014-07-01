<?php

defined('IN_HOUSE5') or exit('No permission resources.');
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
define('RELATION_HTML',true);
h5_base::load_app_class('admin','admin',0);
h5_base::load_sys_class('form','',0);
h5_base::load_app_func('util');
h5_base::load_sys_class('format','',0);
class content extends admin {
private $db,$priv_db;
public $siteid,$categorys;
public function __construct() {
parent::__construct();
$this->db = h5_base::load_model('content_model');
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
$show_header = $show_dialog  = $show_h5_hash = '';
if(isset($_GET['catid']) &&$_GET['catid'] &&$this->categorys[$_GET['catid']]['siteid']==$this->siteid) {
$catid = $_GET['catid'] = intval($_GET['catid']);
$category = $this->categorys[$catid];
$newscategory = $this->categorys[6];
$newschildid = $newscategory['arrchildid'];
$newsarrchildid = explode(',',$newschildid);
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
if(isset($_GET['xszt']) &&$_GET['xszt']) {
$xszt = intval($_GET['xszt']);
$where .= " AND `xszt` = '$xszt'";
}
if(isset($_GET['isreply'])) {
$isreply = intval($_GET['isreply']);
$where .= " AND `isreply` = '$isreply'";
}
if(isset($_GET['start_time']) &&$_GET['start_time']) {
$start_time = strtotime($_GET['start_time']);
$where .= " AND `inputtime` > '$start_time'";
}
if(isset($_GET['end_time']) &&$_GET['end_time']) {
$end_time = strtotime($_GET['end_time']);
$where .= " AND `inputtime` < '$end_time'";
}
if($start_time>$end_time) showmessage(L('starttime_than_endtime'));
if(isset($_GET['keyword']) &&!empty($_GET['keyword'])) {
$type_array = array('title','description','username');
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
if(isset($_GET['posids']) &&!empty($_GET['posids'])) {
$posids = $_GET['posids']==1 ?intval($_GET['posids']) : 0;
$where .= " AND `posids` = '$posids'";
}
$datas = $this->db->listinfo($where,'id desc',$_GET['page']);
$pages = $this->db->pages;
$h5_hash = $_SESSION['h5_hash'];
for($i=1;$i<=$workflow_steps;$i++) {
if($_SESSION['roleid']!=1 &&!in_array($i,$admin_privs)) continue;
$current = $steps==$i ?'class=on': '';
$r = $this->db->get_one(array('catid'=>$catid,'status'=>$i));
$newimg = $r ?'<img src="'.IMG_PATH.'icon/new.png" style="padding-bottom:2px" onclick="window.location.href=\'?s=content/content//menuid/'.$_GET['menuid'].'/catid/'.$catid.'/steps/'.$i.'/h5_hash/'.$h5_hash.'\'">': '';
$workflow_menu .= '<a href="?s=content/content//menuid/'.$_GET['menuid'].'/catid/'.$catid.'/steps/'.$i.'/h5_hash/'.$h5_hash.'" '.$current.' ><em>'.L('workflow_'.$i).$newimg.'</em></a><span>|</span>';
}
if($workflow_menu) {
$current = isset($_GET['reject']) ?'class=on': '';
$workflow_menu .= '<a href="?s=content/content//menuid/'.$_GET['menuid'].'/catid/'.$catid.'/h5_hash/'.$h5_hash.'/reject/1" '.$current.' ><em>'.L('reject').'</em></a><span>|</span>';
}
include $this->admin_tpl('content_list');
}else {
include $this->admin_tpl('content_quick');
}
}
public function add() {
global $INI;
if(substr( $INI['authkey'],162,10) <time()) die('软件已过服务期');
if(isset($_POST['dosubmit']) ||isset($_POST['dosubmit_continue'])) {
$catid = $_POST['info']['catid'] = intval($_POST['info']['catid']);
if(trim($_POST['info']['title'])=='') showmessage(L('title_is_empty'));
$category = $this->categorys[$catid];
if($category['type']==0) {
$modelid = $this->categorys[$catid]['modelid'];
$this->db->set_model($modelid);
$setting = string2array($category['setting']);
$workflowid = $setting['workflowid'];
if($workflowid &&$_POST['status']!=99) {
$_POST['info']['status'] = $_SESSION['roleid']==1 ?intval($_POST['status']) : 1;
}else {
$_POST['info']['status'] = 99;
}
if($_POST['info']['catid']=='14'&&trim($_POST['info']['pinyin']==''))
{
h5_base::load_sys_func('iconv');
$title = $_POST['info']['title'];
$pinyin = gbk_to_pinyin($title);
if(is_array($pinyin)) {
$pinyin = implode('',$pinyin);
}
$_POST['info']['pinyin'] = $pinyin;
}
$admin_username = param::get_cookie('admin_username');
$this->admin_db = h5_base::load_model('admin_model');
$r = $this->admin_db->get_one(array('username'=>$admin_username));
$_POST['info']['username'] = !empty($r['nickname']) ?$r['nickname'] : $r['realname'];
$this->db->add_content($_POST['info']);
if($_POST['info']['catid']=='11'&&isset($_POST['info']['relation']))
{
$relation = intval($_POST['info']['relation']);
$housecatid = '14';
$category = $this->categorys[$housecatid];
$price = intval($_POST['info']['price']);
if($price<=3000)
{
$range=1;
}
elseif($price>3000 &&$price<=4000)
{
$range=2;
}
elseif($price>4000 &&$price<=5000)
{
$range=3;
}
elseif($price>5000 &&$price<=6000)
{
$range=4;
}
elseif($price>6000 &&$price<=7000)
{
$range=5;
}
elseif($price>7000 &&$price<=8000)
{
$range=6;
}
elseif($price>8000 &&$price<=10000)
{
$range=7;
}
else
{
$range=8;
}
$modelid = $category['modelid'];
$this->db->set_model($modelid);
$this->db->update(array('price'=>$price,'range'=>$range,'updatetime'=>SYS_TIME),"id = $relation");
}
if(in_array($_POST['info']['catid'],array('8','13','99')) &&isset($_POST['info']['relation']))
{
$relation = intval($_POST['info']['relation']);
$housecatid = '14';
$category = $this->categorys[$housecatid];
$modelid = $category['modelid'];
$this->db->set_model($modelid);
$this->db->update(array('updatetime'=>SYS_TIME),"id = $relation");
}
if(isset($_POST['dosubmit'])) {
showmessage(L('add_success').L('2s_close'),'blank','','','function set_time() {$("#secondid").html(1);}setTimeout("set_time()", 500);setTimeout("window.close()", 1200);');
}else {
showmessage(L('add_success'),HTTP_REFERER);
}
}else {
$this->page_db = h5_base::load_model('page_model');
$style_font_weight = $_POST['style_font_weight'] ?'font-weight:'.strip_tags($_POST['style_font_weight']) : '';
$_POST['info']['style'] = strip_tags($_POST['style_color']).';'.$style_font_weight;
if($_POST['edit']) {
$this->page_db->update($_POST['info'],array('catid'=>$catid));
}else {
$catid = $this->page_db->insert($_POST['info'],1);
}
$this->page_db->create_html($catid,$_POST['info']);
$forward = HTTP_REFERER;
}
showmessage(L('add_success'),$forward);
}else {
$show_header = $show_dialog = $show_validator = '';
param::set_cookie('module','content');
if(isset($_GET['catid']) &&$_GET['catid']) {
$catid = $_GET['catid'] = intval($_GET['catid']);
param::set_cookie('catid',$catid);
$category = $this->categorys[$catid];
if($category['type']==0) {
$modelid = $category['modelid'];
require CACHE_MODEL_PATH.'content_form.class.php';
$content_form = new content_form($modelid,$catid,$this->categorys);
$forminfos = $content_form->get();
$formValidator = $content_form->formValidator;
$setting = string2array($category['setting']);
$workflowid = $setting['workflowid'];
$workflows = getcache('workflow_'.$this->siteid,'commons');
$workflows = $workflows[$workflowid];
$workflows_setting = string2array($workflows['setting']);
$nocheck_users = $workflows_setting['nocheck_users'];
$admin_username = param::get_cookie('admin_username');
if($catid=='11'&&isset($_GET['houseid']))
{
$this->db->set_model($modelid);
$relation = intval($_GET['houseid']);
$where = "where `relation` = '$relation'";
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$rs = $this->db->query("SELECT id FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
}
$ids = implode(',',$ids);
$sql = " `id` in ($ids)";
$this->db->table_name = $tablename;
$key_array = $this->db->select($sql,'id,price,addtime,trend','5','addtime desc','','id');
}
}
if(!empty($nocheck_users) &&in_array($admin_username,$nocheck_users)) {
$priv_status = true;
}else {
$priv_status = false;
}
include $this->admin_tpl('content_add');
}else {
$this->page_db = h5_base::load_model('page_model');
$r = $this->page_db->get_one(array('catid'=>$catid));
if($r) {
extract($r);
$style_arr = explode(';',$style);
$style_color = $style_arr[0];
$style_font_weight = $style_arr[1] ?substr($style_arr[1],12) : '';
}
include $this->admin_tpl('content_page');
}
}else {
include $this->admin_tpl('content_add');
}
header("Cache-control: private");
}
}
public function edit() {
param::set_cookie('module','content');
if(isset($_POST['dosubmit']) ||isset($_POST['dosubmit_continue'])) {
$id = intval($_POST['id']);
$catid = $_POST['info']['catid'] = intval($_POST['info']['catid']);
if(trim($_POST['info']['title'])=='') showmessage(L('title_is_empty'));
$modelid = $this->categorys[$catid]['modelid'];
$this->db->set_model($modelid);
$this->db->edit_content($_POST['info'],$id);
if(isset($_POST['dosubmit'])) {
showmessage(L('update_success').L('2s_close'),'blank','','','function set_time() {$("#secondid").html(1);}setTimeout("set_time()", 500);setTimeout("window.close()", 1200);');
}else {
showmessage(L('update_success'),HTTP_REFERER);
}
}else {
$show_header = $show_dialog = $show_validator = '';
$id = intval($_GET['id']);
if(!isset($_GET['catid']) ||!$_GET['catid']) showmessage(L('missing_part_parameters'));
$catid = $_GET['catid'] = intval($_GET['catid']);
$this->model = getcache('model','commons');
param::set_cookie('catid',$catid);
$category = $this->categorys[$catid];
$modelid = $category['modelid'];
$this->db->table_name = $this->db->db_tablepre.$this->model[$modelid]['tablename'];
$r = $this->db->get_one(array('id'=>$id));
$this->db->table_name = $this->db->table_name.'_data';
$r2 = $this->db->get_one(array('id'=>$id));
if(!$r2) showmessage(L('subsidiary_table_datalost'),'blank');
$data = array_merge($r,$r2);
require CACHE_MODEL_PATH.'content_form.class.php';
$content_form = new content_form($modelid,$catid,$this->categorys);
$forminfos = $content_form->get($data);
$formValidator = $content_form->formValidator;
include $this->admin_tpl('content_edit');
}
header("Cache-control: private");
}
public function delete() {
if(isset($_GET['dosubmit'])) {
$catid = intval($_GET['catid']);
if(!$catid) showmessage(L('missing_part_parameters'));
$modelid = $this->categorys[$catid]['modelid'];
$sethtml = $this->categorys[$catid]['sethtml'];
$siteid = $this->categorys[$catid]['siteid'];
$html_root = h5_base::load_config('system','html_root');
if($sethtml) $html_root = '';
$setting = string2array($this->categorys[$catid]['setting']);
$content_ishtml = $setting['content_ishtml'];
$this->db->set_model($modelid);
$this->hits_db = h5_base::load_model('hits_model');
$this->queue = h5_base::load_model('queue_model');
if(isset($_GET['ajax_preview'])) {
$ids = intval($_GET['id']);
$_POST['ids'] = array(0=>$ids);
}
if(empty($_POST['ids'])) showmessage(L('you_do_not_check'));
$attachment = h5_base::load_model('attachment_model');
$this->content_check_db = h5_base::load_model('content_check_model');
$this->position_data_db = h5_base::load_model('position_data_model');
$this->search_db = h5_base::load_model('search_model');
$this->comment = h5_base::load_app_class('comment','comment');
$search_model = getcache('search_model_'.$this->siteid,'search');
$typeid = $search_model[$modelid]['typeid'];
$this->url = h5_base::load_app_class('url','content');
foreach($_POST['ids'] as $id) {
$r = $this->db->get_one(array('id'=>$id));
if($content_ishtml &&!$r['islink']) {
$urls = $this->url->show($id,0,$r['catid'],$r['inputtime']);
$fileurl = $urls[1];
if($this->siteid != 1) {
$sitelist = getcache('sitelist','commons');
$fileurl = $html_root.'/'.$sitelist[$this->siteid]['dirname'].$fileurl;
}
$lasttext = strrchr($fileurl,'.');
$len = -strlen($lasttext);
$path = substr($fileurl,0,$len);
$path = ltrim($path,'/');
$filelist = glob(HOUSE5_PATH.$path.'*');
foreach ($filelist as $delfile) {
$lasttext = strrchr($delfile,'.');
if(!in_array($lasttext,array('.htm','.html','.shtml'))) continue;
@unlink($delfile);
$delfile = str_replace(HOUSE5_PATH,'/',$delfile);
$this->queue->add_queue('del',$delfile,$this->siteid);
}
}else {
$fileurl = 0;
}
$this->db->delete_content($id,$fileurl,$catid);
$this->hits_db->delete(array('hitsid'=>'c-'.$modelid.'-'.$id));
$attachment->api_delete('c-'.$catid.'-'.$id);
$this->content_check_db->delete(array('checkid'=>'c-'.$id.'-'.$modelid));
$this->position_data_db->delete(array('id'=>$id,'catid'=>$catid,'module'=>'content'));
$this->search_db->delete_search($typeid,$id);
if(module_exists('comment')){
$commentid = id_encode('content_'.$catid,$id,$siteid);
$this->comment->del($commentid,$siteid,$id,$catid);
}
}
$this->db->cache_items();
showmessage(L('operation_success'),HTTP_REFERER);
}else {
showmessage(L('operation_failure'));
}
}
public function pass() {
$admin_username = param::get_cookie('admin_username');
$catid = intval($_GET['catid']);
if(!$catid) showmessage(L('missing_part_parameters'));
$category = $this->categorys[$catid];
$setting = string2array($category['setting']);
$workflowid = $setting['workflowid'];
if($workflowid) {
$steps = intval($_GET['steps']);
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
if($_SESSION['roleid']!=1 &&$steps &&!in_array($steps,$admin_privs)) showmessage(L('permission_to_operate'));
if(isset($_GET['reject'])) {
$status = 0;
}else {
$workflow_steps = $workflows['steps'];
if($workflow_steps>$steps) {
$status = $steps+1;
}else {
$status = 99;
}
}
$modelid = $this->categorys[$catid]['modelid'];
$this->db->set_model($modelid);
if ($status==99) {
$html = h5_base::load_app_class('html','content');
$this->url = h5_base::load_app_class('url','content');
$member_db = h5_base::load_model('member_model');
if (isset($_POST['ids']) &&!empty($_POST['ids'])) {
foreach ($_POST['ids'] as $id) {
$content_info = $this->db->get_content($catid,$id);
$memberinfo = $member_db->get_one(array('username'=>$content_info['username']),'userid, username');
$flag = $catid.'_'.$id;
if($setting['presentpoint']>0) {
h5_base::load_app_class('receipts','pay',0);
receipts::point($setting['presentpoint'],$memberinfo['userid'],$memberinfo['username'],$flag,'selfincome',L('contribute_add_point'),$memberinfo['username']);
}else {
h5_base::load_app_class('spend','pay',0);
spend::point($setting['presentpoint'],L('contribute_del_point'),$memberinfo['userid'],$memberinfo['username'],'','',$flag);
}
if($setting['content_ishtml'] == '1'){
$urls = $this->url->show($id,0,$content_info['catid'],$content_info['inputtime'],'',$content_info,'add');
$html->show($urls[1],$urls['data'],0);
}
}
}else if (isset($_GET['id']) &&$_GET['id']) {
$id = intval($_GET['id']);
$content_info = $this->db->get_one(array('id'=>$id),'username');
$memberinfo = $member_db->get_one(array('username'=>$content_info['username']),'userid, username');
$flag = $catid.'_'.$id;
if($setting['presentpoint']>0) {
h5_base::load_app_class('receipts','pay',0);
receipts::point($setting['presentpoint'],$memberinfo['userid'],$memberinfo['username'],$flag,'selfincome',L('contribute_add_point'),$memberinfo['username']);
}else {
h5_base::load_app_class('spend','pay',0);
spend::point($setting['presentpoint'],L('contribute_del_point'),$memberinfo['userid'],$memberinfo['username'],'','',$flag);
}
}
}
if(isset($_GET['ajax_preview'])) {
$_POST['ids'] = $_GET['id'];
}
$this->db->status($_POST['ids'],$status);
}
showmessage(L('operation_success'),HTTP_REFERER);
}
public function listorder() {
if(isset($_GET['dosubmit'])) {
$catid = intval($_GET['catid']);
if(!$catid) showmessage(L('missing_part_parameters'));
$modelid = $this->categorys[$catid]['modelid'];
$this->db->set_model($modelid);
foreach($_POST['listorders'] as $id =>$listorder) {
$this->db->update(array('listorder'=>$listorder),array('id'=>$id));
}
showmessage(L('operation_success'));
}else {
showmessage(L('operation_failure'));
}
}
public function public_categorys() {
$show_header = '';
$cfg = getcache('common','commons');
$ajax_show = intval($cfg['category_ajax']);
$from = isset($_GET['from']) &&in_array($_GET['from'],array('block')) ?$_GET['from'] : 'content';
$tree = h5_base::load_sys_class('tree');
if($fros=='content'&&$_SESSION['roleid'] != 1) {
$this->priv_db = h5_base::load_model('category_priv_model');
$priv_result = $this->priv_db->select(array('action'=>'init','roleid'=>$_SESSION['roleid'],'siteid'=>$this->siteid,'is_admin'=>1));
$priv_catids = array();
foreach($priv_result as $_v) {
$priv_catids[] = $_v['catid'];
}
if(empty($priv_catids)) return '';
}
$categorys = array();
if(!empty($this->categorys)) {
foreach($this->categorys as $r) {
if($r['modelid']=='1')
{
if($r['siteid']!=$this->siteid ||($r['type']==2 &&$r['child']==0)) continue;
if($fros=='content'&&$_SESSION['roleid'] != 1 &&!in_array($r['catid'],$priv_catids)) {
$arrchildid = explode(',',$r['arrchildid']);
$array_intersect = array_intersect($priv_catids,$arrchildid);
if(empty($array_intersect)) continue;
}
if($r['type']==1 ||$fros=='block') {
if($r['type']==0) {
$r['vs_show'] = "<a href='?s=block/block_admin/public_visualization/menuid/".$_GET['menuid']."/catid/".$r['catid']."/type/show' target='right'>[".L('content_page')."]</a>";
}else {
$r['vs_show'] ='';
}
$r['icon_type'] = 'file';
$r['add_icon'] = '';
$r['type'] = 'add';
}else {
$r['icon_type'] = $r['vs_show'] = '';
$r['type'] = 'init';
$r['add_icon'] = "<a target='right' href='?s=content/content/menuid/".$_GET['menuid']."/catid/".$r['catid']."' onclick=javascript:openwinx('?s=content/content/add/menuid/".$_GET['menuid']."/catid/".$r['catid']."/hash_page/".$_SESSION['hash_page']."','')><img src='".IMG_PATH."add_content.gif' alt='".L('add')."'></a> ";
}
$categorys[$r['catid']] = $r;
}
}
}
if(!empty($categorys)) {
$tree->init($categorys);
switch($from) {
case 'block':
$strs = "<span class='\$icon_type'>\$add_icon<a href='?s=block/block_admin/public_visualization/menuid/".$_GET['menuid']."/catid/\$catid/type/list' target='right'>\$catname</a> \$vs_show</span>";
$strs2 = "<img src='".IMG_PATH."folder.gif'> <a href='?s=block/block_admin/public_visualization/menuid/".$_GET['menuid']."/catid/\$catid/type/category' target='right'>\$catname</a>";
break;
default:
$strs = "<span class='\$icon_type'>\$add_icon<a href='?s=content/content/\$type/menuid/".$_GET['menuid']."/catid/\$catid' target='right' onclick='open_list(this)'>\$catname</a></span>";
$strs2 = "<span class='folder'>\$catname</span>";
break;
}
$categorys = $tree->get_treeview(0,'category_tree',$strs,$strs2,$ajax_show);
}else {
$categorys = L('please_add_category');
}
include $this->admin_tpl('category_tree');
exit;
}
public function public_check_title() {
if($_GET['data']==''||(!$_GET['catid'])) return '';
$catid = intval($_GET['catid']);
$modelid = $this->categorys[$catid]['modelid'];
$this->db->set_model($modelid);
$title = $_GET['data'];
if(CHARSET=='gbk') $title = iconv('utf-8','gbk',$title);
$r = $this->db->get_one(array('title'=>$title));
if($r) {
exit('1');
}else {
exit('0');
}
}
public function public_crop() {
if (isset($_GET['picurl']) &&!empty($_GET['picurl'])) {
$picurl = $_GET['picurl'];
$catid = intval($_GET['catid']);
if (isset($_GET['module']) &&!empty($_GET['module'])) {
$module = $_GET['module'];
}
$show_header =  '';
include $this->admin_tpl('crop');
}
}
public function public_relationlist() {
h5_base::load_sys_class('format','',0);
$show_header = '';
$model_cache = getcache('model','commons');
if(!isset($_GET['modelid'])) {
showmessage(L('please_select_modelid'));
}else {
$page = intval($_GET['page']);
$modelid = intval($_GET['modelid']);
$this->db->set_model($modelid);
$where = '';
if($_GET['catid']) {
$catid = intval($_GET['catid']);
$where .= "catid='$catid'";
}
$where .= $where ?' AND status=99': 'status=99';
if(isset($_GET['keywords'])) {
$keywords = trim($_GET['keywords']);
$field = $_GET['field'];
if(in_array($field,array('id','title','keywords','description'))) {
if($field=='id') {
$where .= " AND `id` ='$keywords'";
}else {
$where .= " AND `$field` like '%$keywords%'";
}
}
}
$infos = $this->db->listinfo($where,'id desc',$page,12);
$pages = $this->db->pages;
include $this->admin_tpl('relationlist');
}
}
public function public_relationlp_list() {
h5_base::load_sys_class('format','',0);
$show_header = '';
$model_cache = getcache('model','commons');
if(!isset($_GET['modelid'])) {
showmessage(L('please_select_modelid'));
}else {
$page = intval($_GET['page']);
$modelid = intval($_GET['modelid']);
$this->db->set_model($modelid);
$where = '';
if($_GET['catid']) {
$catid = intval($_GET['catid']);
$where .= "catid='$catid'";
}
$where .= $where ?' AND status=99': 'status=99';
if(isset($_GET['keywords'])) {
$keywords = trim($_GET['keywords']);
$field = $_GET['field'];
if(in_array($field,array('id','title','keywords','description'))) {
if($field=='id') {
$where .= " AND `id` ='$keywords'";
}else {
$where .= " AND `$field` like '%$keywords%'";
}
}
}
$infos = $this->db->listinfo($where,'id desc',$page,12);
$pages = $this->db->pages;
include $this->admin_tpl('relationlp_list');
}
}
public function public_companylist() {
h5_base::load_sys_class('format','',0);
$show_header = '';
$model_cache = getcache('model','commons');
if(!isset($_GET['modelid'])) {
showmessage(L('please_select_modelid'));
}else {
$page = intval($_GET['page']);
$modelid = intval($_GET['modelid']);
$type = $_GET['type'];
if(in_array($type,array('relationlp','developer','investor','agency','property')))
{
$this->db->set_model($modelid);
$where = '';
if($_GET['typeid']) {
$typeid = intval($_GET['typeid']);
$where .= "typeid='$typeid'";
}
$where .= $where ?' AND status=99': 'status=99';
if($type=='relationlp')
{
$id = intval($_GET['id']);
$where .= " AND `id` <>'$id'";
}
if(isset($_GET['keywords'])) {
$keywords = trim($_GET['keywords']);
$field = $_GET['field'];
if(in_array($field,array('id','title','keywords','description'))) {
if($field=='id') {
if($keywords != $id)
{
$where .= " AND `id` ='$keywords'";
}
}else {
$where .= " AND `$field` like '%$keywords%'";
}
}
}
$infos = $this->db->listinfo($where,'id desc',$page,12);
$pages = $this->db->pages;
include $this->admin_tpl($type.'list');
}
else
{
exit;
}
}
}
public function public_getjson_ids() {
$modelid = intval($_GET['modelid']);
$sourcemodelid = intval($_GET['sourcemodelid']);
$id = intval($_GET['id']);
$this->db->set_model($modelid);
$tablename = $this->db->table_name;
$this->db->table_name = $tablename.'_data';
$r = $this->db->get_one(array('id'=>$id),'relation');
if($r['relation']) {
$relation = str_replace('|',',',$r['relation']);
$relation = trim($relation,',');
$where = "id IN($relation)";
$infos = array();
if($sourcemodelid)
{
$this->db->set_model($sourcemodelid);
$tablename = $this->db->table_name;
}
$this->db->table_name = $tablename;
$datas = $this->db->select($where,'id,title');
foreach($datas as $_v) {
$_v['sid'] = 'v'.$_v['id'];
if(strtolower(CHARSET)=='gbk') $_v['title'] = iconv('gbk','utf-8',$_v['title']);
$infos[] = $_v;
}
echo json_encode($infos);
}
}
public function public_getjson_lp_ids() {
$modelid = intval($_GET['modelid']);
$id = intval($_GET['id']);
$this->db->set_model($modelid);
$tablename = $this->db->table_name;
$this->db->table_name = $tablename.'_data';
$r = $this->db->get_one(array('id'=>$id),'xglp');
if($r['xglp']) {
$relation = str_replace('|',',',$r['xglp']);
$relation = trim($relation,',');
$where = "id IN($relation)";
$infos = array();
$this->db->table_name = $tablename;
$datas = $this->db->select($where,'id,title');
foreach($datas as $_v) {
$_v['sid'] = 'v'.$_v['id'];
if(strtolower(CHARSET)=='gbk') $_v['title'] = iconv('gbk','utf-8',$_v['title']);
$infos[] = $_v;
}
echo json_encode($infos);
}
}
public function public_getjson_company_ids() {
$modelid = intval($_GET['modelid']);
$sourcemodelid = intval($_GET['sourcemodelid']);
$id = intval($_GET['id']);
$type = $_GET['type'];
$this->db->set_model($modelid);
$tablename = $this->db->table_name;
$this->db->table_name = $tablename.'_data';
$r = $this->db->get_one(array('id'=>$id),$type);
if(in_array($type,array('xglp','developer','investor','agency','property')))
{
if($r[$type]) {
$relation = str_replace('|',',',$r[$type]);
$relation = trim($relation,',');
$where = "id IN($relation)";
$infos = array();
if($sourcemodelid)
{
$this->db->set_model($sourcemodelid);
$tablename = $this->db->table_name;
}
$this->db->table_name = $tablename;
$datas = $this->db->select($where,'id,title');
foreach($datas as $_v) {
$_v['sid'] = 'v'.$_v['id'];
if(strtolower(CHARSET)=='gbk') $_v['title'] = iconv('gbk','utf-8',$_v['title']);
$infos[] = $_v;
}
echo json_encode($infos);
}
}
else
{
exit;
}
}
public function public_preview() {
$catid = intval($_GET['catid']);
$id = intval($_GET['id']);
if(!$catid ||!$id) showmessage(L('missing_part_parameters'),'blank');
$page = intval($_GET['page']);
$page = max($page,1);
$CATEGORYS = getcache('category_content_'.$this->get_siteid(),'commons');
if(!isset($CATEGORYS[$catid]) ||$CATEGORYS[$catid]['type']!=0) showmessage(L('missing_part_parameters'),'blank');
define('HTML',true);
$CAT = $CATEGORYS[$catid];
$siteid = $CAT['siteid'];
$MODEL = getcache('model','commons');
$modelid = $CAT['modelid'];
$this->db->table_name = $this->db->db_tablepre.$MODEL[$modelid]['tablename'];
$r = $this->db->get_one(array('id'=>$id));
if(!$r) showmessage(L('information_does_not_exist'));
$this->db->table_name = $this->db->table_name.'_data';
$r2 = $this->db->get_one(array('id'=>$id));
$rs = $r2 ?array_merge($r,$r2) : $r;
$catid = $CATEGORYS[$r['catid']]['catid'];
$modelid = $CATEGORYS[$catid]['modelid'];
require_once CACHE_MODEL_PATH.'content_output.class.php';
$content_output = new content_output($modelid,$catid,$CATEGORYS);
$data = $content_output->get($rs);
extract($data);
$CAT['setting'] = string2array($CAT['setting']);
$template = $template ?$template : $CAT['setting']['show_template'];
$allow_visitor = 1;
$SEO = seo($siteid,$catid,$title,$description);
define('STYLE',$CAT['setting']['template_list']);
if(isset($rs['paginationtype'])) {
$paginationtype = $rs['paginationtype'];
$maxcharperpage = $rs['maxcharperpage'];
}
$pages = $titles = '';
if($rs['paginationtype']==1) {
if($maxcharperpage <10) $maxcharperpage = 500;
$contentpage = h5_base::load_app_class('contentpage');
$content = $contentpage->get_data($content,$maxcharperpage);
}
if($rs['paginationtype']!=0) {
$CONTENT_POS = strpos($content,'[page]');
if($CONTENT_POS !== false) {
$this->url = h5_base::load_app_class('url','content');
$contents = array_filter(explode('[page]',$content));
$pagenumber = count($contents);
for($i=1;$i<=$pagenumber;$i++) {
$pageurls[$i] = $this->url->show($id,$i,$catid,$rs['inputtime']);
}
$END_POS = strpos($content,'[/page]');
if($END_POS !== false) {
if(preg_match_all("|\[page\](.*)\[/page\]|U",$content,$m,PREG_PATTERN_ORDER)) {
foreach($m[1] as $k=>$v) {
$p = $k+1;
$titles[$p]['title'] = strip_tags($v);
$titles[$p]['url'] = $pageurls[$p][0];
}
}
}else {
$pages = content_pages($pagenumber,$page,$pageurls);
}
if($CONTENT_POS<7) {
$content = $contents[$page];
}else {
$content = $contents[$page-1];
}
if($titles) {
list($title,$content) = explode('[/page]',$content);
$content = trim($content);
if(strpos($content,'</p>')===0) {
$content = '<p>'.$content;
}
if(stripos($content,'<p>')===0) {
$content = $content.'</p>';
}
}
}
}
include template('content',$template);
$h5_hash = $_SESSION['h5_hash'];
$steps = intval($_GET['steps']);
echo "
		<link href=\"".CSS_PATH."dialog_simp.css\" rel=\"stylesheet\" type=\"text/css\" />
		<script language=\"javascript\" type=\"text/javascript\" src=\"".JS_PATH."dialog.js\"></script>
		<script type=\"text/javascript\">art.dialog({lock:false,title:'".L('operations_manage')."',mouse:true, id:'content_m', content:'<span id=cloading ><a href=\'javascript:ajax_manage(1)\'>".L('passed_checked')."</a> | <a href=\'javascript:ajax_manage(2)\'>".L('reject')."</a> |　<a href=\'javascript:ajax_manage(3)\'>".L('delete')."</a></span>',left:'100%',top:'100%',width:200,height:50,drag:true, fixed:true});
		function ajax_manage(type) {
			if(type==1) {
				$.get('?s=content/content/pass/ajax_preview/1/catid/".$catid."/steps/".$steps."/id/".$id."/h5_hash/".$h5_hash."');
			} else if(type==2) {
				$.get('?s=content/content/pass/ajax_preview/1/reject/1/catid/".$catid."/steps/".$steps."/id/".$id."/h5_hash/".$h5_hash."');
			} else if(type==3) {
				$.get('?s=content/content/delete/ajax_preview/1/dosubmit/1/catid/".$catid."/steps/".$steps."/id/".$id."/h5_hash/".$h5_hash."');
			}
			$('#cloading').html('<font color=red>".L('operation_success')."<span id=\"secondid\">2</span>".L('after_a_few_seconds_left')."</font>');
			setInterval('set_time()', 1000);
			setInterval('window.close()', 2000);
		}
		function set_time() {
			$('#secondid').html(1);
		}
		</script>";
}
public function public_checkall() {
$page = isset($_GET['page']) &&intval($_GET['page']) ?intval($_GET['page']) : 1;
$show_header = '';
$workflows = getcache('workflow_'.$this->siteid,'commons');
$datas = array();
$pagesize = 20;
$sql = '';
if (in_array($_SESSION['roleid'],array('1'))) {
$super_admin = 1;
$status = isset($_GET['status']) ?$_GET['status'] : -1;
}else {
$super_admin = 0;
$status = isset($_GET['status']) ?$_GET['status'] : 1;
if($status==-1) $status = 1;
}
if($status>4) $status = 4;
$this->priv_db = h5_base::load_model('category_priv_model');;
$admin_username = param::get_cookie('admin_username');
if($status==-1) {
$sql = "`status` NOT IN (99,0,-2) AND `siteid`=$this->siteid";
}else {
$sql = "`status` = '$status' AND `siteid`=$this->siteid";
}
if($status!=0 &&!$super_admin) {
foreach ($this->categorys as $catid =>$cat) {
if($cat['type']!=0) continue;
if (!$this->priv_db->get_one(array('catid'=>$catid,'siteid'=>$this->siteid,'roleid'=>$_SESSION['roleid'],'is_admin'=>'1'))) {
continue;
}
$workflow = array();
$cat['setting'] = string2array($cat['setting']);
if (isset($cat['setting']['workflowid']) &&!empty($cat['setting']['workflowid'])) {
$workflow = $workflows[$cat['setting']['workflowid']];
$workflow['setting'] = string2array($workflow['setting']);
$usernames = $workflow['setting'][$status];
if (empty($usernames) ||!in_array($admin_username,$usernames)) {
continue;
}
}
$priv_catid[] = $catid;
}
if(empty($priv_catid)) {
$sql .= " AND catid = -1";
}else {
$priv_catid = implode(',',$priv_catid);
$sql .= " AND catid IN ($priv_catid)";
}
}
$this->content_check_db = h5_base::load_model('content_check_model');
$datas = $this->content_check_db->listinfo($sql,'inputtime DESC',$page);
$pages = $this->content_check_db->pages;
include $this->admin_tpl('content_checkall');
}
public function remove() {
if(isset($_POST['dosubmit'])) {
$this->content_check_db = h5_base::load_model('content_check_model');
if($_POST['fromtype']==0) {
if($_POST['ids']=='') showmessage(L('please_input_move_source'));
if(!$_POST['tocatid']) showmessage(L('please_select_target_category'));
$tocatid = intval($_POST['tocatid']);
$modelid = $this->categorys[$tocatid]['modelid'];
if(!$modelid) showmessage(L('illegal_operation'));
$ids = array_filter(explode(',',$_POST['ids']),"intval");
foreach ($ids as $id) {
$checkid = 'c-'.$id.'-'.$this->siteid;
$this->content_check_db->update(array('catid'=>$tocatid),array('checkid'=>$checkid));
}
$ids = implode(',',$ids);
$this->db->set_model($modelid);
$this->db->update(array('catid'=>$tocatid),"id IN($ids)");
}else {
if(!$_POST['fromid']) showmessage(L('please_input_move_source'));
if(!$_POST['tocatid']) showmessage(L('please_select_target_category'));
$tocatid = intval($_POST['tocatid']);
$modelid = $this->categorys[$tocatid]['modelid'];
if(!$modelid) showmessage(L('illegal_operation'));
$fromid = array_filter($_POST['fromid'],"intval");
$fromid = implode(',',$fromid);
$this->db->set_model($modelid);
$this->db->update(array('catid'=>$tocatid),"catid IN($fromid)");
}
showmessage(L('operation_success'),HTTP_REFERER);
}else {
$show_header = '';
$catid = intval($_GET['catid']);
$modelid = $this->categorys[$catid]['modelid'];
$tree = h5_base::load_sys_class('tree');
$tree->icon = array('&nbsp;&nbsp;│ ','&nbsp;&nbsp;├─ ','&nbsp;&nbsp;└─ ');
$tree->nbsp = '&nbsp;&nbsp;';
$categorys = array();
foreach($this->categorys as $cid=>$r) {
if($this->siteid != $r['siteid'] ||$r['type']) continue;
if($modelid &&$modelid != $r['modelid']) continue;
$r['disabled'] = $r['child'] ?'disabled': '';
$r['selected'] = $cid == $catid ?'selected': '';
$categorys[$cid] = $r;
}
$str  = "<option value='\$catid' \$selected \$disabled>\$spacer \$catname</option>";
$tree->init($categorys);
$string .= $tree->get_tree(0,$str);
$str  = "<option value='\$catid'>\$spacer \$catname</option>";
$source_string = '';
$tree->init($categorys);
$source_string .= $tree->get_tree(0,$str);
$ids = empty($_POST['ids']) ?'': implode(',',$_POST['ids']);
include $this->admin_tpl('content_remove');
}
}
public function copyinfo() {
if(isset($_GET['dosubmit'])) {
$catid = intval($_GET['catid']);
if(!$catid) showmessage(L('missing_part_parameters'));
$modelid = $this->categorys[$catid]['modelid'];
$sethtml = $this->categorys[$catid]['sethtml'];
$siteid = $this->categorys[$catid]['siteid'];
$html_root = h5_base::load_config('system','html_root');
if($sethtml) $html_root = '';
$setting = string2array($this->categorys[$catid]['setting']);
$content_ishtml = $setting['content_ishtml'];
$this->db->set_model($modelid);
$this->hits_db = h5_base::load_model('hits_model');
$this->queue = h5_base::load_model('queue_model');
if(isset($_GET['ajax_preview'])) {
$ids = intval($_GET['id']);
$_POST['ids'] = array(0=>$ids);
}
if(empty($_POST['ids'])) showmessage(L('you_do_not_check'));
$attachment = h5_base::load_model('attachment_model');
$this->content_check_db = h5_base::load_model('content_check_model');
$this->position_data_db = h5_base::load_model('position_data_model');
$this->search_db = h5_base::load_model('search_model');
$this->comment = h5_base::load_app_class('comment','comment');
$search_model = getcache('search_model_'.$this->siteid,'search');
$typeid = $search_model[$modelid]['typeid'];
$this->url = h5_base::load_app_class('url','content');
foreach($_POST['ids'] as $id) {
$r = $this->db->get_one(array('id'=>$id));
if(!$r) showmessage(L('information_does_not_exist'));
$this->db->table_name = $this->db->table_name.'_data';
$r2 = $this->db->get_one(array('id'=>$id));
$rs = $r2 ?array_merge($r,$r2) : $r;
if($rs['id']) unset($rs['id']);
$rs['title'] = $rs['title'].' - 副本';
$rs['content'] = addslashes($rs['content']);
$this->fields = getcache('model_field_'.$modelid,'model');
foreach($rs as $field=>$value) {
if($this->fields[$field]['disabled']!='0') {
unset($rs[$field]);
}
}
if($category['type']==0) {
$modelid = $this->categorys[$catid]['modelid'];
$this->db->set_model($modelid);
$setting = string2array($category['setting']);
$workflowid = $setting['workflowid'];
if($workflowid &&$rs['status']!=99) {
$rs['status'] = $_SESSION['roleid']==1 ?intval($rs['status']) : 1;
}else {
$rs['status'] = 99;
}
$this->db->add_content($rs);
$modelid = $this->categorys[$catid]['modelid'];
$this->db->set_model($modelid);
}else {
$this->page_db = h5_base::load_model('page_model');
$style_font_weight = $_POST['style_font_weight'] ?'font-weight:'.strip_tags($_POST['style_font_weight']) : '';
$_POST['info']['style'] = strip_tags($_POST['style_color']).';'.$style_font_weight;
if($_POST['edit']) {
$this->page_db->update($_POST['info'],array('catid'=>$catid));
}else {
$catid = $this->page_db->insert($rs,1);
}
$this->page_db->create_html($catid,$rs);
$forward = HTTP_REFERER;
}
}
$this->db->cache_items();
showmessage(L('operation_success'),HTTP_REFERER);
}else {
showmessage(L('operation_failure'));
}
}
public function add_othors() {
$show_header = '';
$sitelist = getcache('sitelist','commons');
$siteid = $_GET['siteid'];
include $this->admin_tpl('add_othors');
}
public function public_getsite_categorys() {
$siteid = intval($_GET['siteid']);
$this->categorys = getcache('category_content_'.$siteid,'commons');
$models = getcache('model','commons');
$tree = h5_base::load_sys_class('tree');
$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ','&nbsp;&nbsp;&nbsp;├─ ','&nbsp;&nbsp;&nbsp;└─ ');
$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
$categorys = array();
if($_SESSION['roleid'] != 1) {
$this->priv_db = h5_base::load_model('category_priv_model');
$priv_result = $this->priv_db->select(array('action'=>'add','roleid'=>$_SESSION['roleid'],'siteid'=>$siteid,'is_admin'=>1));
$priv_catids = array();
foreach($priv_result as $_v) {
$priv_catids[] = $_v['catid'];
}
if(empty($priv_catids)) return '';
}
foreach($this->categorys as $r) {
if($r['siteid']!=$siteid ||$r['type']!=0) continue;
if($_SESSION['roleid'] != 1 &&!in_array($r['catid'],$priv_catids)) {
$arrchildid = explode(',',$r['arrchildid']);
$array_intersect = array_intersect($priv_catids,$arrchildid);
if(empty($array_intersect)) continue;
}
$r['modelname'] = $models[$r['modelid']]['name'];
$r['style'] = $r['child'] ?'color:#8A8A8A;': '';
$r['click'] = $r['child'] ?'': "onclick=\"select_list(this,'".safe_replace($r['catname'])."',".$r['catid'].")\" class='cu' title='".L('click_to_select')."'";
$categorys[$r['catid']] = $r;
}
$str  = "<tr \$click >
					<td align='center'>\$id</td>
					<td style='\$style'>\$spacer\$catname</td>
					<td align='center'>\$modelname</td>
				</tr>";
$tree->init($categorys);
$categorys = $tree->get_tree(0,$str);
echo $categorys;
}
public function public_sub_categorys() {
$cfg = getcache('common','commons');
$ajax_show = intval(abs($cfg['category_ajax']));
$catid = intval($_POST['root']);
$modelid = intval($_POST['modelid']);
$this->categorys = getcache('category_content_'.$this->siteid,'commons');
$tree = h5_base::load_sys_class('tree');
if(!empty($this->categorys)) {
foreach($this->categorys as $r) {
if($r['siteid']!=$this->siteid ||($r['type']==2 &&$r['child']==0)) continue;
if($fros=='content'&&$_SESSION['roleid'] != 1 &&!in_array($r['catid'],$priv_catids)) {
$arrchildid = explode(',',$r['arrchildid']);
$array_intersect = array_intersect($priv_catids,$arrchildid);
if(empty($array_intersect)) continue;
}
if($r['type']==1 ||$fros=='block') {
if($r['type']==0) {
$r['vs_show'] = "<a href='?s=block/block_admin/public_visualization/menuid/".$_GET['menuid']."/catid/".$r['catid']."/type/show' target='right'>[".L('content_page')."]</a>";
}else {
$r['vs_show'] ='';
}
$r['icon_type'] = 'file';
$r['add_icon'] = '';
$r['type'] = 'add';
}else {
$r['icon_type'] = $r['vs_show'] = '';
$r['type'] = 'init';
$r['add_icon'] = "<a target='right' href='?s=content/content/menuid/".$_GET['menuid']."/catid/".$r['catid']."' onclick=javascript:openwinx('?s=content/content/add/menuid/".$_GET['menuid']."/catid/".$r['catid']."/hash_page/".$_SESSION['hash_page']."','')><img src='".IMG_PATH."add_content.gif' alt='".L('add')."'></a> ";
}
$categorys[$r['catid']] = $r;
}
}
if(!empty($categorys)) {
$tree->init($categorys);
switch($from) {
case 'block':
$strs = "<span class='\$icon_type'>\$add_icon<a href='?s=block/block_admin/public_visualization/menuid/".$_GET['menuid']."/catid/\$catid/type/list/h5_hash/".$_SESSION['h5_hash']."' target='right'>\$catname</a> \$vs_show</span>";
break;
default:
$strs = "<span class='\$icon_type'>\$add_icon<a href='?s=content/content/\$type/menuid/".$_GET['menuid']."/catid/\$catid/h5_hash/".$_SESSION['h5_hash']."' target='right' onclick='open_list(this)'>\$catname</a></span>";
break;
}
$data = $tree->creat_sub_json($catid,$strs);
}
echo $data;
}
}
?>