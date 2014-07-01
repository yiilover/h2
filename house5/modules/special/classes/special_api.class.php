<?php
 
defined('IN_HOUSE5') or exit('No permission resources.');
class special_api {
private $db,$type_db,$c_db,$data_db;
public $pages;
public function __construct() {
$this->db = h5_base::load_model('special_model');
$this->type_db = h5_base::load_model('type_model');
$this->c_db = h5_base::load_model('special_content_model');
$this->data_db = h5_base::load_model('special_c_data_model');
}
public function _update_type($specialid,$type,$a = 'add') {
$specialid = intval($specialid);
if (!$specialid) return false;
$special_info = $this->db->get_one(array('id'=>$specialid));
$app_path = substr(APP_PATH,0,-1);
foreach ($type as $k =>$v) {
if (!$v['name'] ||!$v['typedir']) continue;
$siteid = get_siteid();
if ($a == 'add'&&!$v['del']) {
$typeid = $this->type_db->insert(array('siteid'=>$siteid,'module'=>'special','name'=>$v['name'],'listorder'=>$v['listorder'],'typedir'=>$v['typedir'],'parentid'=>$specialid,'listorder'=>$k),true);
if ($siteid>1) {
$site = h5_base::load_app_class('sites','admin');
$site_info = $site->get_by_id($siteid);
if ($special_info['ishtml']) {
$url = $site_info['domain'].'special/'.$special_info['filename'].'/'.$v['typedir'].'/'.'type-'.$typeid.'.html';
}else {
$url = $site_info['domain'].'index.php?s=special/index/type&specialid='.$specialid.'&typeid='.$typeid;
}
}else {
if($special_info['ishtml']) $url = addslashes($app_path.h5_base::load_config('system','html_root').'/special/'.$special_info['filename'].'/'.$v['typedir'].'/'.'type-'.$typeid.'.html');
else $url = APP_PATH.'index.php?s=special/index/type&specialid='.$specialid.'&typeid='.$typeid;
}
$this->type_db->update(array('url'=>$url),array('typeid'=>$typeid));
}elseif ($a == 'edit') {
if ((!isset($v['typeid']) ||empty($v['typeid'])) &&(!isset($v['del']) ||empty($v['del']))) {
$typeid = $this->type_db->insert(array('siteid'=>$siteid,'module'=>'special','name'=>$v['name'],'listorder'=>$v['listorder'],'typedir'=>$v['typedir'],'parentid'=>$specialid,'listorder'=>$k),true);
if ($siteid>1) {
$site = h5_base::load_app_class('sites','admin');
$site_info = $site->get_by_id($siteid);
if ($special_info['ishtml']) {
$url = $site_info['domain'].'special/'.$special_info['filename'].'/'.$v['typedir'].'/'.'type-'.$typeid.'.html';
}else {
$url = $site_info['domain'].'index.php?s=special/index/type&specialid='.$specialid.'&typeid='.$typeid;
}
}else {
if($special_info['ishtml']) $url = addslashes($app_path.h5_base::load_config('system','html_root').'/special/'.$special_info['filename'].'/'.$v['typedir'].'/'.'type-'.$typeid.'.html');
else $url = APP_PATH.'index.php?s=special/index/type&specialid='.$specialid.'&typeid='.$typeid;
}
$v['url'] = $url;
$this->type_db->update($v,array('typeid'=>$typeid));
}
if ((!isset($v['del']) ||empty($v['del'])) &&$v['typeid']) {
$this->type_db->update(array('name'=>$v['name'],'typedir'=>$v['typedir'],'listorder'=>$v['listorder']),array('typeid'=>$r['typeid']));
if ($siteid>1) {
$site = h5_base::load_app_class('sites','admin');
$site_info = $site->get_by_id($siteid);
if ($special_info['ishtml']) {
$url = $site_info['domain'].'special/'.$special_info['filename'].'/'.$v['typedir'].'/'.'type-'.$v['typeid'].'.html';
}else {
$url = $site_info['domain'].'index.php?s=special/index/type&specialid='.$specialid.'&typeid='.$v['typeid'];
}
}else {
if($special_info['ishtml']) $url = addslashes($app_path.h5_base::load_config('system','html_root').'/special/'.$special_info['filename'].'/'.$v['typedir'].'/'.'type-'.$v['typeid'].'.html');
else $url = APP_PATH.'index.php?s=special/index/type&specialid='.$specialid.'&typeid='.$v['typeid'];
}
$v['url'] = $url;
$typeid = $v['typeid'];
unset($v['typeid']);
$this->type_db->update($v,array('typeid'=>$typeid));
}
if ($v['typeid'] &&$v['del']) {
$this->delete_type($v['typeid'],$siteid,$special_info['ishtml']);
}
}
}
return true;
}
public function _get_import_data($modelid = 0,$where = '',$page) {
$c = h5_base::load_model('content_model');
if(!$modelid) return '';
$c->set_model($modelid);
$data = $c->listinfo($where,'`id`  DESC',$page);
$this->pages = $c->pages;
return $data;
}
public function _get_special($param = array(),$arr = array()) {
if ($arr['dosubmit']) {
foreach ($param as $id =>$v) {
if (!$arr['specialid'] ||!$arr['typeid']) continue;
if (!$this->c_db->get_one(array('title'=>$v['title'],'specialid'=>$arr['specialid']))) {
$info['specialid'] = $arr['specialid'];
$info['typeid'] = $arr['typeid'];
$info['title'] = $v['title'];
$info['thumb'] = $v['thumb'];
$info['url'] = $v['url'];
$info['curl'] = $v['id'].'|'.$v['catid'];
$info['description'] = $v['description'];
$info['userid'] = $v['userid'];
$info['username'] = $v['username'];
$info['inputtime'] = $v['inputtime'];
$info['updatetime'] = $v['updatetime'];
$info['islink'] = 1;
$this->c_db->insert($info,true);
}
}
return true;
}else {
$datas = getcache('special','commons');
$special = array(L('please_select'));
if (is_array($datas)) {
foreach ($datas as $sid =>$d) {
if ($d['siteid']==get_siteid()) {
$special[$sid] = $d['title'];
}
}
}
return array(
'specialid'=>array('name'=>L('special_list','','special'),'htmltype'=>'select','data'=>$special,'ajax'=>array('name'=>L('for_type','','special'),'action'=>'_get_type','m'=>'special','id'=>'typeid')),
'validator'=>'$(\'#specialid\').formValidator({autotip:true,onshow:"'.L('please_choose_special','','special').'",oncorrect:"'.L('true','','special').'"}).inputValidator({min:1,onerror:"'.L('please_choose_special','','special').'"});$(\'#typeid\').formValidator({autotip:true,onshow:"'.L('please_choose_type','','special').'",oncorrect:"'.L('true','','special').'"}).inputValidator({min:1,onerror:"'.L('please_choose_type','','special').'"});',
);
}
}
public function _get_type($specialid = 0) {
$type_db = h5_base::load_model('type_model');
$data = $arr = array();
$data = $type_db->select(array('module'=>'special','parentid'=>$specialid));
h5_base::load_sys_class('form','',0);
foreach ($data as $r) {
$arr[$r['typeid']] = $r['name'];
}
return form::select($arr,'','name="typeid", id="typeid"',L('please_select'));
}
public function _get_types($specialid = 0) {
if (!$specialid) return false;
$rs = $this->type_db->select(array('parentid'=>$specialid,'siteid'=>get_siteid()),'typeid, name');
$types = array();
foreach ($rs as $r) {
$types[$r['typeid']] = $r['name'];
}
return $types;
}
public function _del_special($id = 0) {
$id = intval($id);
if (!$id) return false;
$rs = $this->c_db->select(array('specialid'=>$id),'id');
$info = $this->db->get_one(array('id'=>$id,'siteid'=>get_siteid()),'siteid, ispage, filename, ishtml');
if (is_array($rs) &&!empty($rs)) {
foreach ($rs as $r) {
$this->_delete_content($r['id'],$info['siteid'],$info['ishtml']);
}
}
$type_info = $this->type_db->select(array('module'=>'special','parentid'=>$id,'siteid'=>get_siteid()),'`typeid`');
if (is_array($type_info) &&!empty($type_info)) {
foreach ($type_info as $t) {
$this->delete_type($t['typeid'],$info['siteid'],$info['ishtml']);
}
}
h5_base::load_sys_func('dir');
$this->db->delete(array('id'=>$id,'siteid'=>get_siteid()));
if ($info['siteid']>1) {
if ($info['ishtml']) {
$queue = h5_base::load_model('queue_model');
$site = h5_base::load_app_class('sites','admin');
$site_info = $site->get_by_id($info['siteid']);
$file = h5_base::load_config('system','html_root').'/'.$site_info['dirname'].'/special/'.$info['filename'].'/index.html';
if ($info['ispage']) {
for ($i==1;$i>0;$i++) {
if ($i>1) {
$file = str_replace('.html','-'.$i.'.html',$file);
}
if (!file_exists(HOUSE5_PATH.$file)) {
break;
}else {
$queue->add_queue('del',$file,$info['siteid']);
unlink(HOUSE5_PATH.$file);
}
}
}else {
$queue->add_queue('del',$file,$info['siteid']);
unlink(HOUSE5_PATH.$file);
}
$queue->add_queue('del',h5_base::load_config('system','html_root').'/'.$site_info['dirname'].'/special/'.$info['filename'].'/',$info['siteid']);
dir_delete(h5_base::load_config('system','html_root').'/'.$site_info['dirname'].'/special/'.$info['filename']);
}
}else {
if ($info['ishtml']) {
dir_delete(HOUSE5_PATH.h5_base::load_config('system','html_root').DIRECTORY_SEPARATOR.'special'.DIRECTORY_SEPARATOR.$info['filename']);
}
}
if(h5_base::load_config('system','attachment_stat')) {
$keyid = 'special-'.$id;
$this->attachment_db = h5_base::load_model('attachment_model');
$this->attachment_db->api_delete($keyid);
}
return true;
}
public function _import($modelid,$specialid,$id,$typeid,$listorder = 0) {
if (!$specialid ||!$id ||!$typeid) return false;
$c = h5_base::load_model('content_model');
$c->set_model($modelid);
$info = $c->get_one(array('id'=>$id,'status'=>99),'`id`, `catid`, `title`, `thumb`, `url`, `description`, `username`, `inputtime`, `updatetime`');
if ($info) {
$info['curl'] = $info['id'].'|'.$info['catid'];
unset($info['id'],$info['catid']);
if(!$this->c_db->get_one(array('title'=>addslashes($info['title']),'specialid'=>$specialid,'typeid'=>$typeid))) {
$info['specialid'] = $specialid;
$info['typeid'] = $typeid;
$info['islink'] = 1;
$info['listorder'] = $listorder;
$info = new_addslashes($info);
return $this->c_db->insert($info,true);
}
}
return false;
}
private function delete_type($typeid = 0,$siteid = 0,$ishtml = 0) {
$typeid = intval($typeid);
if (!$typeid) return false;
h5_base::load_sys_func('dir');
$info = $this->type_db->get_one(array('typeid'=>$typeid));
if ($ishtml) {
$siteid = $siteid ?intval($siteid) : get_siteid();
if ($siteid>1) {
$site = h5_base::load_app_class('sites','admin');
$site_info = $site->get_by_id($siteid);
$queue = h5_base::load_model('queue_model');
for ($i = 1;$i>0;$i++) {
if ($i==1) $file = str_replace($site_info['domain'],h5_base::load_config('system','html_root').'/'.$site_info['dirname'].'/',$info['url']);
else $file = str_replace(array($site_info['domain'],'.html'),array(h5_base::load_config('system','html_root').'/'.$site_info['dirname'].'/','-'.$i.'.html'),$info['url']);
if (!file_exists(HOUSE5_PATH.$file)) {
break;
}else {
$queue->add_queue('del',$file,$siteid);
unlink(HOUSE5_PATH.$file);
}
}
}else {
for ($i = 1;$i>0;$i++) {
if ($i==1) $file = str_replace(APP_PATH,'',$info['url']);
else $file = str_replace(array(APP_PATH,'.html'),array('','-'.$i.'.html'),$info['url']);
if (!file_exists(HOUSE5_PATH.$file)) {
break;
}else {
unlink(HOUSE5_PATH.$file);
}
}
}
}
$this->type_db->delete(array('typeid'=>$typeid));
return true;
}
public function _delete_content($cid = 0,$siteid = 0,$ishtml = 0) {
$info = $this->c_db->get_one(array('id'=>$cid),'inputtime, isdata');
if ($info['isdata']) {
if ($ishtml) {
h5_base::load_app_func('global','special');
$siteid = $siteid ?intval($siteid) : get_siteid();
if ($siteid>1) {
$site = h5_base::load_app_class('sites','admin');
$site_info = $site->get_by_id($siteid);
$queue = h5_base::load_model('queue_model');
for ($i = 1;$i>0;$i++) {
$file = content_url($cid,$i,$info['inputtime'],'html',$site_info);
if (!file_exists(HOUSE5_PATH.$file[1])) {
break;
}else {
$queue->add_queue('del',$file[1],$siteid);
unlink(HOUSE5_PATH.$file[1]);
}
}
}else {
for ($i = 1;$i>0;$i++) {
$file = content_url($cid,$i,$info['inputtime']);
if (!file_exists(HOUSE5_PATH.$file[1])) {
break;
}else {
unlink(HOUSE5_PATH.$file[1]);
}
}
}
}
$this->search_api($cid,'','','delete');
$count = h5_base::load_model('hits_model');
$hitsid = 'special-c-'.$info['specialid'].'-'.$cid;
$count->delete(array('hitsid'=>$hitsid));
$this->data_db->delete(array('id'=>$cid));
}
$this->c_db->delete(array('id'=>$cid));
return true;
}
private function search_api($id = 0,$data = array(),$title,$action = 'update') {
$this->search_db = h5_base::load_model('search_model');
$siteid = get_siteid();
$type_arr = getcache('type_module_'.$siteid,'search');
$typeid = $type_arr['special'];
if($action == 'update') {
$fulltextcontent = $data['content'];
return $this->search_db->update_search($typeid ,$id,$fulltextcontent,$title);
}elseif($action == 'delete') {
$this->search_db->delete_search($typeid ,$id);
}
}
}
?>