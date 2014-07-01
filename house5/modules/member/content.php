<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('foreground');
h5_base::load_sys_class('format','',0);
h5_base::load_sys_class('form','',0);
class content extends foreground {
private $times_db;
function __construct() {
parent::__construct();
}
public function publish() {
$memberinfo = $this->memberinfo;
$grouplist = getcache('grouplist');
if(!$grouplist[$memberinfo['groupid']]['allowpost']) {
showmessage(L('member_group').L('publish_deny'),HTTP_REFERER);
}
$this->content_check_db = h5_base::load_model('content_check_model');
$todaytime = strtotime(date('y-m-d',SYS_TIME));
$_username = $this->memberinfo['username'];
$allowpostnum = $this->content_check_db->count("`inputtime` > $todaytime AND `username`='$_username'");
if($grouplist[$memberinfo['groupid']]['allowpostnum'] >0 &&$allowpostnum >= $grouplist[$memberinfo['groupid']]['allowpostnum']) {
showmessage(L('allowpostnum_deny').$grouplist[$memberinfo['groupid']]['allowpostnum'],HTTP_REFERER);
}
$siteids = getcache('category_content','commons');
header("Cache-control: private");
if(isset($_POST['dosubmit'])) {
$catid = intval($_POST['info']['catid']);
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
$category = $CATEGORYS[$catid];
$modelid = $category['modelid'];
if(!$modelid) showmessage(L('illegal_parameters'),HTTP_REFERER);
$this->content_db = h5_base::load_model('content_model');
$this->content_db->set_model($modelid);
$table_name = $this->content_db->table_name;
$fields_sys = $this->content_db->get_fields();
$this->content_db->table_name = $table_name.'_data';
$fields_attr = $this->content_db->get_fields();
$fields = array_merge($fields_sys,$fields_attr);
$fields = array_keys($fields);
$info = array();
foreach($_POST['info'] as $_k=>$_v) {
if(in_array($_k,$fields)) $info[$_k] = $_v;
}
$post_fields = array_keys($_POST['info']);
$post_fields = array_intersect_assoc($fields,$post_fields);
$setting = string2array($category['setting']);
if($setting['presentpoint'] <0 &&$memberinfo['point'] <abs($setting['presentpoint']))
showmessage(L('points_less_than',array('point'=>$memberinfo['point'],'need_point'=>abs($setting['presentpoint']))),APP_PATH.'index.php?s=pay/deposit/pay/exchange/point',3000);
if($grouplist[$memberinfo['groupid']]['allowpostverify'] ||!$setting['workflowid']) {
$info['status'] = 99;
}else {
$info['status'] = 1;
}
$info['username'] = $memberinfo['username'];
$this->content_db->siteid = $siteid;
$id = $this->content_db->add_content($info);
if ($info['status']==99) {
$flag = $catid.'_'.$id;
if($setting['presentpoint']>0) {
h5_base::load_app_class('receipts','pay',0);
receipts::point($setting['presentpoint'],$memberinfo['userid'],$memberinfo['username'],$flag,'selfincome',L('contribute_add_point'),$memberinfo['username']);
}else {
h5_base::load_app_class('spend','pay',0);
spend::point($setting['presentpoint'],L('contribute_del_point'),$memberinfo['userid'],$memberinfo['username'],'','',$flag);
}
}
$model_cache = getcache('model','commons');
$infos = array();
foreach ($model_cache as $modelid=>$model) {
if($model['siteid']==$siteid) {
$datas = array();
$this->content_db->set_model($modelid);
$datas = $this->content_db->select(array('username'=>$memberinfo['username'],'sysadd'=>0),'id,catid,title,url,username,sysadd,inputtime,status',100,'id DESC');
if($datas) $infos = array_merge($infos,$datas);
}
}
setcache('member_'.$memberinfo['userid'].'_'.$siteid,$infos,'content');
if($info['status']==99) {
showmessage(L('contributors_success'),APP_PATH.'index.php?s=member/content/published');
}else {
showmessage(L('contributors_checked'),APP_PATH.'index.php?s=member/content/published');
}
}else {
$show_header = $show_dialog = $show_validator = '';
$temp_language = L('news','','content');
$sitelist = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
if(!isset($_GET['siteid']) &&count($sitelist)>1) {
include template('member','content_publish_select_model');
exit;
}
param::set_cookie('module','content');
$siteid = intval($_GET['siteid']);
if(!$siteid) $siteid = 1;
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
$priv_db = h5_base::load_model('category_priv_model');
foreach ($CATEGORYS as $catid=>$cat) {
if($cat['siteid']==$siteid &&$cat['child']==0 &&$cat['type']==0 &&$priv_db->get_one(array('catid'=>$catid,'roleid'=>$memberinfo['groupid'],'is_admin'=>0,'action'=>'add'))) break;
}
$catid = $_GET['catid'] ?intval($_GET['catid']) : $catid;
if (!$catid) showmessage(L('category').L('publish_deny'),APP_PATH.'index.php?s=member');
if (!$priv_db->get_one(array('catid'=>$catid,'roleid'=>$memberinfo['groupid'],'is_admin'=>0,'action'=>'add'))) showmessage(L('category').L('publish_deny'),APP_PATH.'index.php?s=member');
$category = $CATEGORYS[$catid];
if($category['siteid']!=$siteid) showmessage(L('site_no_category'),'?s=member/content/publish');
$setting = string2array($category['setting']);
if($setting['presentpoint'] <0 &&$memberinfo['point'] <abs($setting['presentpoint']))
showmessage(L('points_less_than',array('point'=>$memberinfo['point'],'need_point'=>abs($setting['presentpoint']))),APP_PATH.'index.php?s=pay/deposit/pay&exchange=point',3000);
if($category['type']!=0) showmessage(L('illegal_operation'));
$modelid = $category['modelid'];
require CACHE_MODEL_PATH.'content_form.class.php';
$content_form = new content_form($modelid,$catid,$CATEGORYS);
$forminfos_data = $content_form->get();
$forminfos = array();
foreach($forminfos_data as $_fk=>$_fv) {
if($_fv['isomnipotent']) continue;
if($_fv['formtype']=='omnipotent') {
foreach($forminfos_data as $_fs=>$_fm_value) {
if($_fm_value['isomnipotent']) {
$_fv['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$_fv['form']);
}
}
}
$forminfos[$_fk] = $_fv;
}
$formValidator = $content_form->formValidator;
unset($forminfos['catid']);
$workflowid = $setting['workflowid'];
header("Cache-control: private");
include template('member','content_publish');
}
}
public function published() {
$memberinfo = $this->memberinfo;
$sitelist = getcache('sitelist','commons');
if(!isset($_GET['siteid']) &&count($sitelist)>1) {
include template('member','content_publish_select_model');
exit;
}
$_username = $this->memberinfo['username'];
$_userid = $this->memberinfo['userid'];
$siteid = intval($_GET['siteid']);
if(!$siteid) $siteid = 1;
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
$siteurl = siteurl($siteid);
$pagesize = 20;
$page = max(intval($_GET['page']),1);
$workflows = getcache('workflow_'.$siteid,'commons');
$this->content_check_db = h5_base::load_model('content_check_model');
$infos = $this->content_check_db->listinfo(array('username'=>$_username,'siteid'=>$siteid),'inputtime DESC',$page);
$datas = array();
foreach($infos as $_v) {
$arr_checkid = explode('-',$_v['checkid']);
$_v['id'] = $arr_checkid[1];
$_v['modelid'] = $arr_checkid[2];
$_v['url'] = $_v['status']==99 ?go($_v['catid'],$_v['id']) : APP_PATH.'index.php?s=content/index/show&catid='.$_v['catid'].'&id='.$_v['id'];
if(!isset($setting[$_v['catid']])) $setting[$_v['catid']] = string2array($CATEGORYS[$_v['catid']]['setting']);
$workflowid = $setting[$_v['catid']]['workflowid'];
$_v['flag'] = $workflows[$workflowid]['flag'];
$datas[] = $_v;
}
$pages = $this->content_check_db->pages;
include template('member','content_published');
}
public function edit() {
$_username = $this->memberinfo['username'];
if(isset($_POST['dosubmit'])) {
$catid = $_POST['info']['catid'] = intval($_POST['info']['catid']);
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
$category = $CATEGORYS[$catid];
if($category['type']==0) {
$id = intval($_POST['id']);
$catid = $_POST['info']['catid'] = intval($_POST['info']['catid']);
$this->content_db = h5_base::load_model('content_model');
$modelid = $category['modelid'];
$this->content_db->set_model($modelid);
$memberinfo = $this->memberinfo;
$grouplist = getcache('grouplist');
$setting = string2array($category['setting']);
if(!$grouplist[$memberinfo['groupid']]['allowpostverify'] ||$setting['workflowid']) {
$_POST['info']['status'] = 1;
}
$this->content_db->edit_content($_POST['info'],$id);
$forward = $_POST['forward'];
showmessage(L('update_success'),$forward);
}
}else {
$show_header = $show_dialog = $show_validator = '';
$temp_language = L('news','','content');
param::set_cookie('module','content');
$id = intval($_GET['id']);
if(isset($_GET['catid']) &&$_GET['catid']) {
$catid = $_GET['catid'] = intval($_GET['catid']);
param::set_cookie('catid',$catid);
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
$category = $CATEGORYS[$catid];
if($category['type']==0) {
$modelid = $category['modelid'];
$this->model = getcache('model','commons');
$this->content_db = h5_base::load_model('content_model');
$this->content_db->set_model($modelid);
$this->content_db->table_name = $this->content_db->db_tablepre.$this->model[$modelid]['tablename'];
$r = $this->content_db->get_one(array('id'=>$id,'username'=>$_username,'sysadd'=>0));
if(!$r) showmessage(L('illegal_operation'));
if($r['status']==99) showmessage(L('has_been_verified'));
$this->content_db->table_name = $this->content_db->table_name.'_data';
$r2 = $this->content_db->get_one(array('id'=>$id));
$data = array_merge($r,$r2);
require CACHE_MODEL_PATH.'content_form.class.php';
$content_form = new content_form($modelid,$catid,$CATEGORYS);
$forminfos_data = $content_form->get($data);
$forminfos = array();
foreach($forminfos_data as $_fk=>$_fv) {
if($_fv['isomnipotent']) continue;
if($_fv['formtype']=='omnipotent') {
foreach($forminfos_data as $_fs=>$_fm_value) {
if($_fm_value['isomnipotent']) {
$_fv['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$_fv['form']);
}
}
}
$forminfos[$_fk] = $_fv;
}
$formValidator = $content_form->formValidator;
include template('member','content_publish');
}
}
header("Cache-control: private");
}
}
public function delete(){
$id = intval($_GET['id']);
if(!$id){
return false;
}
$username = param::get_cookie('_username');
$userid = param::get_cookie('_userid');
$siteid = get_siteid();
$checkid = 'c-'.$id.'-'.$siteid;
$where = " checkid='$checkid' and username='$username' and status!=99 ";
$check_pushed_db = h5_base::load_model('content_check_model');
$array = $check_pushed_db->get_one($where);
if(!$array){
showmessage(L('operation_failure'),HTTP_REFERER);
}else{
$CATEGORY = getcache('category_content_'.$siteid,'commons');
if(!$CATEGORY[$array['catid']]){
showmessage(L('operation_failure'),HTTP_REFERER);
}
$modelid = $CATEGORY[$array['catid']]['modelid'];
$content_db = h5_base::load_model('content_model');
$content_db->set_model($modelid);
$table_name = $content_db->table_name;
$content_db->delete_content($id);
$check_pushed_db->delete(array('checkid'=>$checkid));
showmessage(L('operation_success'),HTTP_REFERER);
}
}
public function info_publish() {
$memberinfo = $this->memberinfo;
$grouplist = getcache('grouplist');
$SEO['title'] = L('info_publish','','info');
if(!$grouplist[$memberinfo['groupid']]['allowpost']) {
showmessage(L('member_group').L('publish_deny'),HTTP_REFERER);
}
$this->content_check_db = h5_base::load_model('content_check_model');
$todaytime = strtotime(date('y-m-d',SYS_TIME));
$_username = $memberinfo['username'];
$allowpostnum = $this->content_check_db->count("`inputtime` > $todaytime AND `username`='$_username'");
if($grouplist[$memberinfo['groupid']]['allowpostnum'] >0 &&$allowpostnum >= $grouplist[$memberinfo['groupid']]['allowpostnum']) {
showmessage(L('allowpostnum_deny').$grouplist[$memberinfo['groupid']]['allowpostnum'],HTTP_REFERER);
}
$siteids = getcache('category_content','commons');
header("Cache-control: private");
if(isset($_POST['dosubmit'])) {
$catid = intval($_POST['info']['catid']);
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
$category = $CATEGORYS[$catid];
$modelid = $category['modelid'];
if(!$modelid) showmessage(L('illegal_parameters'),HTTP_REFERER);
$this->content_db = h5_base::load_model('content_model');
$this->content_db->set_model($modelid);
$table_name = $this->content_db->table_name;
$fields_sys = $this->content_db->get_fields();
$this->content_db->table_name = $table_name.'_data';
$fields_attr = $this->content_db->get_fields();
$fields = array_merge($fields_sys,$fields_attr);
$fields = array_keys($fields);
$info = array();
foreach($_POST['info'] as $_k=>$_v) {
if(in_array($_k,$fields)) $info[$_k] = $_v;
}
$post_fields = array_keys($_POST['info']);
$post_fields = array_intersect_assoc($fields,$post_fields);
$setting = string2array($category['setting']);
if($setting['presentpoint'] <0 &&$memberinfo['point'] <abs($setting['presentpoint']))
showmessage(L('points_less_than',array('point'=>$memberinfo['point'],'need_point'=>abs($setting['presentpoint']))),APP_PATH.'index.php?s=pay/deposit/pay/exchange/point',3000);
if($grouplist[$memberinfo['groupid']]['allowpostverify'] ||!$setting['workflowid']) {
$info['status'] = 99;
}else {
$info['status'] = 1;
}
$info['username'] = $memberinfo['username'];
$this->content_db->siteid = $siteid;
$id = $this->content_db->add_content($info);
$flag = $catid.'_'.$id;
if($setting['presentpoint']>0) {
h5_base::load_app_class('receipts','pay',0);
receipts::point($setting['presentpoint'],$memberinfo['userid'],$memberinfo['username'],$flag,'selfincome',L('contribute_add_point'),$memberinfo['username']);
}else {
h5_base::load_app_class('spend','pay',0);
spend::point($setting['presentpoint'],L('contribute_del_point'),$memberinfo['userid'],$memberinfo['username'],'','',$flag);
}
$model_cache = getcache('model','commons');
$infos = array();
foreach ($model_cache as $modelid=>$model) {
if($model['siteid']==$siteid) {
$datas = array();
$this->content_db->set_model($modelid);
$datas = $this->content_db->select(array('username'=>$memberinfo['username'],'sysadd'=>0),'id,catid,title,url,username,sysadd,inputtime,status',100,'id DESC');
}
}
setcache('member_'.$memberinfo['userid'].'_'.$siteid,$infos,'content');
if($info['status']==99) {
showmessage(L('contributors_success'),APP_PATH.'index.php?s=member/content/info_top/id/'.$id.'/catid/'.$catid.'/msg/1');
}else {
showmessage(L('contributors_checked'),APP_PATH.'index.php?s=member/content/info_top/id/'.$id.'/catid/'.$catid.'/msg/1');
}
}else {
$show_header = $show_dialog = $show_validator = '';
$step = $step_1 = $step_2 = $step_3 = $step_4;
$temp_language = L('news','','content');
$sitelist = getcache('sitelist','commons');
param::set_cookie('module','content');
$siteid = intval($_GET['siteid']);
$info_linkageid = getinfocache('info_linkageid');
$cityid = getcity(trim($_GET['city']),'linkageid');
$cityname = getcity(trim($_GET['city']),'name');
$citypinyin = getcity(trim($_GET['city']),'pinyin');
$zone = intval($_GET['zone']);
$zone_name = get_linkage($zone,$info_linkageid,'',0);
if(!$siteid) $siteid = 1;
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
$priv_db = h5_base::load_model('category_priv_model');
foreach ($CATEGORYS as $catid=>$cat) {
if($cat['siteid']==$siteid &&$cat['child']==0 &&$cat['type']==0 &&$priv_db->get_one(array('catid'=>$catid,'roleid'=>$memberinfo['groupid'],'is_admin'=>0,'action'=>'add'))) break;
}
$catid = $_GET['catid'] ?intval($_GET['catid']) : $catid;
if (!$catid) showmessage(L('category').L('publish_deny'),APP_PATH.'index.php?s=member');
if (!$priv_db->get_one(array('catid'=>$catid,'roleid'=>$memberinfo['groupid'],'is_admin'=>0,'action'=>'add'))) showmessage(L('category').L('publish_deny'),APP_PATH.'index.php?s=member');
$category = $CATEGORYS[$catid];
if($category['siteid']!=$siteid) showmessage(L('site_no_category'),'?s=member/content/info_publish');
$setting = string2array($category['setting']);
if($zone == 0 &&!isset($_GET['catid'])) {
$step = 1;
include template('member','info_content_publish_select');
exit;
}elseif($zone == 0 &&$category['child']) {
$step = 2;
$step_1 = '<a href="'.APP_PATH.'index.php?s=member/content/info_publish/siteid/'.$siteid.'/city/'.$citypinyin.'">'.$category['catname'].'</a>';
include template('member','info_content_publish_select');
exit;
}elseif($zone == 0 &&isset($_GET['catid'])) {
$step = 3;
$step_1 = '<a href="'.APP_PATH.'index.php?s=member/content/info_publish/siteid/'.$siteid.'">'.$CATEGORYS[$category['parentid']]['catname'].'</a>';
$step_2 = '<a href="'.APP_PATH.'index.php?s=member/content/info_publish/siteid/'.$siteid.'/city/'.$citypinyin.'/catid/'.$category['parentid'].'">'.$category['catname'].'</a>';
$zone_arrchild = show_linkage($info_linkageid,$cityid,$cityid);
include template('member','info_content_publish_select');
exit;
}elseif($zone !== 0 &&get_linkage_level($info_linkageid,$zone,'child') &&!$_GET['jumpstep']) {
$step = 4;
$step_1 = '<a href="'.APP_PATH.'index.php?s=member/content/info_publish/siteid/'.$siteid.'/city/'.$citypinyin.'">'.$CATEGORYS[$category['parentid']]['catname'].'</a>';
$step_2 = '<a href="'.APP_PATH.'index.php?s=member/content/info_publish/siteid/'.$siteid.'/city/'.$citypinyin.'/catid/'.$category['parentid'].'">'.$category['catname'].'</a>';
$step_3 = '<a href="'.APP_PATH.'index.php?s=member/content/info_publish/siteid/'.$siteid.'/city/'.$citypinyin.'/catid/'.$catid.'">'.$zone_name.'</a>';
$zone_arrchild = get_linkage_level($info_linkageid,$zone,'arrchildinfo');
include template('member','info_content_publish_select');
exit;
}
if($setting['presentpoint'] <0 &&$memberinfo['point'] <abs($setting['presentpoint']))
showmessage(L('points_less_than',array('point'=>$memberinfo['point'],'need_point'=>abs($setting['presentpoint']))),APP_PATH.'index.php?s=pay/deposit/pay/exchange/point',3000);
if($category['type']!=0) showmessage(L('illegal_operation'));
$modelid = $category['modelid'];
require CACHE_MODEL_PATH.'content_form.class.php';
$content_form = new content_form($modelid,$catid,$CATEGORYS);
$data = array('zone'=>$zone,'city'=>$cityid);
$forminfos_data = $content_form->get($data);
$forminfos = array();
foreach($forminfos_data as $_fk=>$_fv) {
if($_fv['isomnipotent']) continue;
if($_fv['formtype']=='omnipotent') {
foreach($forminfos_data as $_fs=>$_fm_value) {
if($_fm_value['isomnipotent']) {
$_fv['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$_fv['form']);
}
}
}
$forminfos[$_fk] = $_fv;
}
$formValidator = $content_form->formValidator;
unset($forminfos['catid']);
$workflowid = $setting['workflowid'];
header("Cache-control: private");
include template('member','info_content_publish');
}
}
function info_top() {
$exist_posids = array();
$memberinfo = $this->memberinfo;
$_username = $this->memberinfo['username'];
$id = intval($_GET['id']);
$catid = $_GET['catid'];
$pos_data = h5_base::load_model('position_data_model');
if(!$id ||!$catid) showmessage(L('illegal_parameters'),HTTP_REFERER);
if(isset($catid) &&$catid) {
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
$category = $CATEGORYS[$catid];
if($category['type']==0) {
$modelid = $category['modelid'];
$this->model = getcache('model','commons');
$this->content_db = h5_base::load_model('content_model');
$this->content_db->set_model($modelid);
$this->content_db->table_name = $this->content_db->db_tablepre.$this->model[$modelid]['tablename'];
$r = $this->content_db->get_one(array('id'=>$id,'username'=>$_username,'sysadd'=>0));
if(!$r) showmessage(L('illegal_operation'));
$catid = $CATEGORYS[$r['catid']]['catid'];
$modelid = $CATEGORYS[$catid]['modelid'];
require_once CACHE_MODEL_PATH.'content_output.class.php';
$content_output = new content_output($modelid,$catid,$CATEGORYS);
$data = $content_output->get($r);
extract($data);
}
}
$infos = getcache('info_setting','commons');
$toptype_posid = array('1'=>$infos['top_city_posid'],
'2'=>$infos['top_zone_posid'],
'3'=>$infos['top_district_posid'],
);
foreach($toptype_posid as $_k =>$_v) {
if($pos_data->get_one(array('id'=>$id,'catid'=>$catid,'posid'=>$_v))) {
$exist_posids[$_k] = 1;
}
}
include template('member','info_top');
}
function info_top_cost() {
$amount = $msg = '';
$memberinfo = $this->memberinfo;
$_username = $this->memberinfo['username'];
$_userid = $this->memberinfo['userid'];
$infos = getcache('info_setting','commons');
$toptype_arr = array(1,2,3);
$toptype_price = array('1'=>$infos['top_city'],
'2'=>$infos['top_zone'],
'3'=>$infos['top_district'],
);
$toptype_posid = array('1'=>$infos['top_city_posid'],
'2'=>$infos['top_zone_posid'],
'3'=>$infos['top_district_posid'],
);
if(isset($_POST['dosubmit'])) {
$posids = array();
$push_api = h5_base::load_app_class('push_api','admin');
$pos_data = h5_base::load_model('position_data_model');
$catid = intval($_POST['catid']);
$id = intval($_POST['id']);
$flag = $catid.'_'.$id;
$toptime = intval($_POST['toptime']);
if($toptime == 0 ||empty($_POST['toptype'])) showmessage(L('info_top_not_setting_toptime'));
if(is_array($_POST['toptype']) &&!empty($_POST['toptype'])) {
foreach($_POST['toptype'] as $r) {
if(is_numeric($r) &&in_array($r,$toptype_arr)) {
$posids[] = $toptype_posid[$r];
$amount += $toptype_price[$r];
$msg .= $r.'-';
}
}
}
$amount = $amount * $toptime;
h5_base::load_app_class('spend','pay',0);
$pay_status = spend::point($amount,L('info_top').$msg,$_userid,$_username,'','',$flag);
if($pay_status == false) {
$msg = spend::get_msg();
showmessage($msg);
}
$expiration = SYS_TIME +$toptime * 3600;
if(isset($catid) &&$catid) {
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
$category = $CATEGORYS[$catid];
if($category['type']==0) {
$modelid = $category['modelid'];
$this->model = getcache('model','commons');
$this->content_db = h5_base::load_model('content_model');
$this->content_db->set_model($modelid);
$this->content_db->table_name = $this->content_db->db_tablepre.$this->model[$modelid]['tablename'];
$r = $this->content_db->get_one(array('id'=>$id,'username'=>$_username,'sysadd'=>0));
}
}
if(!$r) showmessage(L('illegal_operation'));
$push_api->position_update($id,$modelid,$catid,$posids,$r,$expiration,1);
$refer = $_POST['msg'] ?$r['url'] : '';
if($_POST['msg']) showmessage(L('ding_success'),$refer);
else showmessage(L('ding_success'),'','','top');
}else {
$toptype = trim($_POST['toptype']);
$toptime = trim($_POST['toptime']);
$types = explode('_',$toptype);
if(is_array($types) &&!empty($types)) {
foreach($types as $r) {
if(is_numeric($r) &&in_array($r,$toptype_arr)) {
$amount += $toptype_price[$r];
}
}
}
$amount = $amount * $toptime;
echo $amount;
}
}
}
?>