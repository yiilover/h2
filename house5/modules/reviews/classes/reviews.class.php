<?php

class reviews {
private $reviews_db,$reviews_setting_db,$reviews_data_db,$reviews_table_db,$reviews_check_db;
public $msg_code = 0;
public function __construct() {
$this->reviews_db = h5_base::load_model('reviews_model');
$this->reviews_setting_db = h5_base::load_model('reviews_setting_model');
$this->reviews_data_db = h5_base::load_model('reviews_data_model');
$this->reviews_table_db = h5_base::load_model('reviews_table_model');
$this->reviews_check_db = h5_base::load_model('reviews_check_model');
}
public function add($reviewsid,$siteid,$data,$id = '',$title = '',$url = '') {
if (!$reviews = $this->reviews_db->get_one(array('reviewsid'=>$reviewsid,'siteid'=>$siteid),'tableid, reviewsid')) {
$r = $this->reviews_table_db->get_one('','tableid, total','tableid desc');
$tableid = $r['tableid'];
if ($r['total'] >= 1000000) {
if (!$tableid = $this->reviews_table_db->creat_table()) {
$this->msg_code = 4;
return false;
}
}
$reviews_data = array('reviewsid'=>$reviewsid,'siteid'=>$siteid,'tableid'=>$tableid);
if (!empty($title)) $reviews_data['title'] = $title;
if (!empty($url)) $reviews_data['url'] = $url;
if (!$this->reviews_db->insert($reviews_data)) {
$this->msg_code = 5;
return false;
}
}else {
$tableid = $reviews['tableid'];
}
if (empty($tableid)) {
$this->msg_code = 1;
return false;
}
$this->reviews_data_db->table_name($tableid);
if (!$this->reviews_data_db->table_exists('reviews_data_'.$tableid)) {
if (!$tableid = $this->reviews_table_db->creat_table($tableid)) {
$this->msg_code = 2;
return false;
}
}
$data['reviewsid'] = $reviewsid;
$data['siteid'] = $siteid;
$data['ip'] = ip();
$data['status'] = 1;
$data['creat_at'] = SYS_TIME;
$data['advantage'] = strip_tags($data['advantage']);
$data['disadvantage'] = strip_tags($data['disadvantage']);
$data['content'] = strip_tags($data['content']);
$badword = h5_base::load_model('badword_model');
$data['advantage'] = $badword->replace_badword($data['advantage']);
$data['disadvantage'] = $badword->replace_badword($data['disadvantage']);
$data['content'] = $badword->replace_badword($data['content']);
if ($id) {
$r = $this->reviews_data_db->get_one(array('id'=>$id));
if ($r) {
h5_base::load_sys_class('format','',0);
if ($r['reply']) {
$data['content'] = '<div class="content">'.str_replace('<span></span>','<span class="blue f12">'.$r['username'].' '.L('chez').' '.format::date($r['creat_at'],1).L('release').'</span>',$r['content']).'</div><span></span>'.$data['content'];
}else {
$data['content'] = '<div class="content"><span class="blue f12">'.$r['username'].' '.L('chez').' '.format::date($r['creat_at'],1).L('release').'</span><pre>'.$r['content'].'</pre></div><span></span>'.$data['content'];
}
$data['reply'] = 1;
}
}
$site = $this->reviews_setting_db->site($siteid);
if ($site['check']) {
$data['status'] = 0;
}
if ($reviews_data_id = $this->reviews_data_db->insert($data,true)) {
if ($data['status']==0) {
$this->reviews_check_db->insert(array('reviews_data_id'=>$reviews_data_id,'siteid'=>$siteid,'tableid'=>$tableid));
}elseif (!empty($data['userid']) &&!empty($site['add_point']) &&module_exists('pay')) {
h5_base::load_app_class('receipts','pay',0);
receipts::point($site['add_point'],$data['userid'],$data['username'],'','selfincome','reviews');
}
$this->reviews_table_db->edit_total($tableid,'+=1');
$sql['lastupdate'] = SYS_TIME;
if ($data['status'] == 1) {
$sql['total'] = '+=1';
$sql['star1'] = '+='.$data['star1'];
$sql['star2'] = '+='.$data['star2'];
$sql['star3'] = '+='.$data['star3'];
$sql['star4'] = '+='.$data['star4'];
$sql['star5'] = '+='.$data['star5'];
$sql['star6'] = '+='.$data['star6'];
$sql['starnum'] = $data['starnum'];
$sql['startype'] = $data['startype'];
$reviews = $this->reviews_db->get_one(array('reviewsid'=>$reviewsid));
$sql['allstar'] = $reviews['allstar'] +$data['star1'] +$data['star2'] +$data['star3']+$data['star4']+$data['star5']+$data['star6'];
}
$this->reviews_db->update($sql,array('reviewsid'=>$reviewsid));
if ($site['check']) {
$this->msg_code = 7;
}else {
$this->msg_code = 0;
}
return true;
}else {
$this->msg_code = 3;
return false;
}
}
public function addyx($siteid,$data,$id = '',$title = '',$url = '') {
$this->reviews_db->table_name = 'h5_impression';
$data['siteid'] = $siteid;
$data['ip'] = ip();
$data['inputtime'] = SYS_TIME;
$data['impression'] = strip_tags($data['impression']);
$badword = h5_base::load_model('badword_model');
$data['impression'] = $badword->replace_badword($data['impression']);
if ($reviews_data_id = $this->reviews_db->insert($data,true)) {
{
$this->msg_code = 0;
}
return true;
}else {
$this->msg_code = 3;
return false;
}
}
public function support($reviewsid,$id) {
if ($data = $this->reviews_db->get_one(array('reviewsid'=>$reviewsid),'tableid')) {
$this->reviews_data_db->table_name($data['tableid']);
if ($this->reviews_data_db->update(array('support'=>'+=1'),array('id'=>$id))) {
$this->msg_code = 0;
return true;
}else {
$this->msg_code = 3;
return false;
}
}else {
$this->msg_code = 6;
return false;
}
}
public function status($reviewsid,$id,$status = -1) {
if (!$reviews = $this->reviews_db->get_one(array('reviewsid'=>$reviewsid),'tableid, reviewsid')) {
$this->msg_code = 6;
return false;
}
$this->reviews_data_db->table_name($reviews['tableid']);
if (!$reviews_data = $this->reviews_data_db->get_one(array('id'=>$id,'reviewsid'=>$reviewsid))) {
$this->msg_code = 6;
return false;
}
$site = $this->reviews_setting_db->get_one(array('siteid'=>$reviews_data['siteid']));
if ($status == 1) {
$sql['total'] = '+=1';
$sql['star1'] = '+='.$reviews_data['star1'];
$sql['star2'] = '+='.$reviews_data['star2'];
$sql['star3'] = '+='.$reviews_data['star3'];
$sql['star4'] = '+='.$reviews_data['star4'];
$sql['star5'] = '+='.$reviews_data['star5'];
$sql['star6'] = '+='.$reviews_data['star6'];
$reviews = $this->reviews_db->get_one(array('reviewsid'=>$reviewsid));
$sql['allstar'] = $reviews['allstar'] +$reviews_data['star1'] +$reviews_data['star2'] +$reviews_data['star3']+$reviews_data['star4']+$reviews_data['star5']+$reviews_data['star6'];
$this->reviews_db->update($sql,array('reviewsid'=>$reviews['reviewsid']));
$this->reviews_data_db->update(array('status'=>$status),array('id'=>$id,'reviewsid'=>$reviewsid));
if (!empty($reviews_data['userid']) &&!empty($site['add_point']) &&module_exists('pay')) {
h5_base::load_app_class('receipts','pay',0);
receipts::point($site['add_point'],$reviews_data['userid'],$reviews_data['username'],'','selfincome','reviews');
}
}elseif ($status == -1) {
if ($reviews_data['status'] == 1) {
$sql['total'] = '-=1';
$sql['star1'] = '-='.$reviews_data['star1'];
$sql['star2'] = '-='.$reviews_data['star2'];
$sql['star3'] = '-='.$reviews_data['star3'];
$sql['star4'] = '-='.$reviews_data['star4'];
$sql['star5'] = '-='.$reviews_data['star5'];
$sql['star6'] = '-='.$reviews_data['star6'];
$reviews = $this->reviews_db->get_one(array('reviewsid'=>$reviewsid));
$sql['allstar'] = $reviews['allstar'] -$reviews_data['star1'] -$reviews_data['star2'] -$reviews_data['star3']-$reviews_data['star4']-$reviews_data['star5']-$reviews_data['star6'];
$this->reviews_db->update($sql,array('reviewsid'=>$reviews['reviewsid']));
}
$this->reviews_data_db->delete(array('id'=>$id,'reviewsid'=>$reviewsid));
$this->reviews_table_db->edit_total($reviews['tableid'],'-=1');
if (!empty($reviews_data['userid']) &&!empty($site['del_point']) &&module_exists('pay')) {
h5_base::load_app_class('spend','pay',0);
$op_userid = param::get_cookie('userid');
$op_username = param::get_cookie('admin_username');
spend::point($site['del_point'],L('reviews_point_del','','reviews'),$reviews_data['userid'],$reviews_data['username'],$op_userid,$op_username);
}
}
$this->reviews_check_db->delete(array('reviews_data_id'=>$id));
$this->msg_code = 0;
return true;
}
public function get_error() {
$msg = array('0'=>L('operation_success'),
'1'=>L('coment_class_php_1'),
'2'=>L('coment_class_php_2'),
'3'=>L('coment_class_php_3'),
'4'=>L('coment_class_php_4'),
'5'=>L('coment_class_php_5'),
'6'=>L('coment_class_php_6'),
'7'=>L('coment_class_php_7'),
);
return $msg[$this->msg_code];
}
}?>