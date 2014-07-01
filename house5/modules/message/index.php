<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('foreground','member');
h5_base::load_sys_class('format','',0);
h5_base::load_sys_class('form','',0);
class index extends foreground {
function __construct() {
parent::__construct();
$this->message_db = h5_base::load_model('message_model');
$this->message_group_db = h5_base::load_model('message_group_model');
$this->message_data_db = h5_base::load_model('message_data_model');
$this->_username = param::get_cookie('_username');
$this->_userid = param::get_cookie('_userid');
$this->_groupid = get_memberinfo($this->_userid,'groupid');
h5_base::load_app_func('global');
$siteid = isset($_GET['siteid']) ?intval($_GET['siteid']) : get_siteid();
define("SITEID",$siteid);
}
public function init() {
$page = isset($_GET['page']) ?intval($_GET['page']) : 1;
$where = array('send_to_id'=>$this->_username,'replyid'=>'0');
$infos = $this->message_db->listinfo($where,$order = 'messageid DESC',$page,10);
$infos = new_html_special_chars($infos);
$pages = $this->message_db->pages;
include template('message','inbox');
}
public function send() {
if(isset($_POST['dosubmit'])) {
$username = $this->_username;
$tousername = $_POST['info']['send_to_id'];
$subject = new_html_special_chars($_POST['info']['subject']);
$content = new_html_special_chars($_POST['info']['content']);
$this->message_db->add_message($tousername,$username,$subject,$content,true);
showmessage(L('operation_success'),HTTP_REFERER);
}else {
$this->message_db->messagecheck($this->_userid);
$show_validator = $show_scroll = $show_header = true;
include template('message','send');
}
}
public function public_name() {
$username = isset($_GET['username']) &&trim($_GET['username']) ?(h5_base::load_config('system','charset') == 'gbk'?iconv('utf-8','gbk',trim($_GET['username'])) : trim($_GET['username'])) : exit('0');
$member_interface = h5_base::load_app_class('member_interface','member');
if ($username) {
$username = safe_replace($username);
if($username == $this->_username){
exit('0');
}
$data = $member_interface->get_member_info($username,2);
if ($data!='-1') {
exit('1');
}else {
exit('0');
}
}else {
exit('0');
}
}
public function outbox() {
$where = array('send_from_id'=>$this->_username,'del_type'=>'0');
$page = isset($_GET['page']) &&intval($_GET['page']) ?intval($_GET['page']) : 1;
$infos = $this->message_db->listinfo($where,$order = 'messageid DESC',$page,$pages = '8');
$infos = new_html_special_chars($infos);
$pages = $this->message_db->pages;
include template('message','outbox');
}
public function inbox() {
$where = array('send_to_id'=>$this->_username,'folder'=>'inbox');
$page = isset($_GET['page']) &&intval($_GET['page']) ?intval($_GET['page']) : 1;
$infos = $this->message_db->listinfo($where,$order = 'messageid DESC',$page,$pages = '8');
$infos = new_html_special_chars($infos);
if (is_array($infos) &&!empty($infos)) {
foreach ($infos as $infoid=>$info){
$reply_num = $this->message_db->count(array("replyid"=>$info['messageid']));
$infos[$infoid]['reply_num'] = $reply_num;
}
}
$pages = $this->message_db->pages;
include template('message','inbox');
}
public function group() {
$where = array('typeid'=>1,'groupid'=>$this->_groupid,'status'=>1);
$page = isset($_GET['page']) &&intval($_GET['page']) ?intval($_GET['page']) : 1;
$infos = $this->message_group_db->listinfo($where,$order = 'id DESC',$page,$pages = '8');
$infos = new_html_special_chars($infos);
$status = array();
if (is_array($infos) &&!empty($infos)) {
foreach ($infos as $info){
$d = $this->message_data_db->select(array('userid'=>$this->_userid,'group_message_id'=>$info['id']));
if(!$d){
$status[$info['id']] = 0;
}else {
$status[$info['id']] = 1;
}
}
}
$pages = $this->message_group_db->pages;
include template('message','group');
}
public function delete() {
if((!isset($_GET['messageid']) ||empty($_GET['messageid'])) &&(!isset($_POST['messageid']) ||empty($_POST['messageid']))) {
showmessage(L('illegal_parameters'),HTTP_REFERER);
}else {
if(is_array($_POST['messageid'])){
foreach($_POST['messageid'] as $messageid_arr) {
$messageid_arr = intval($messageid_arr);
$this->message_db->update(array('folder'=>'outbox'),array('messageid'=>$messageid_arr,'send_to_id'=>$this->_username));
}
showmessage(L('operation_success'),HTTP_REFERER);
}
}
}
public function del_type() {
if((!isset($_POST['messageid']) ||empty($_POST['messageid']))) {
showmessage(L('illegal_parameters'),HTTP_REFERER);
}else {
if(is_array($_POST['messageid'])){
foreach($_POST['messageid'] as $messageid_arr) {
$messageid_arr = intval($messageid_arr);
$this->message_db->update(array('del_type'=>'1'),array('messageid'=>$messageid_arr,'send_from_id'=>$this->_username));
}
showmessage(L('operation_success'),HTTP_REFERER);
}
}
}
public function check_user($messageid,$where){
$username = $this->_username;
$messageid = intval($messageid);
if($where=="to"){
$result = $this->message_db->get_one(array("send_to_id"=>$username,"messageid"=>$messageid));
}else{
$result = $this->message_db->get_one(array("send_from_id"=>$username,"messageid"=>$messageid));
}
if(!$result){
showmessage('请勿非法访问！',HTTP_REFERER);echo '0';
}
}
public function read() {
if((!isset($_GET['messageid']) ||empty($_GET['messageid'])) &&(!isset($_POST['messageid']) ||empty($_POST['messageid']))) return false;
$messageid = $_GET['messageid'] ?$_GET['messageid'] : $_POST['messageid'];
$messageid = intval($messageid);
$check_user = $this->check_user($messageid,'to');
$this->message_db->update(array('status'=>'0'),array('messageid'=>$messageid));
$infos = $this->message_db->get_one(array('messageid'=>$messageid));
if($infos['send_from_id']!='SYSTEM') $infos = new_html_special_chars($infos);
$where = array('replyid'=>$infos['messageid']);
$reply_infos = $this->message_db->listinfo($where,$order = 'messageid ASC',$page,$pages = '10');
$show_validator = $show_scroll = $show_header = true;
include template('message','read');
}
public function read_only() {
$messageid = $_GET['messageid'] ?$_GET['messageid'] : $_POST['messageid'];
$messageid = intval($messageid);
if(!$messageid ||empty($messageid)){
showmessage('请勿非法访问！',HTTP_REFERER);
}
$check_user = $this->check_user($messageid,'from');
$infos = $this->message_db->get_one(array('messageid'=>$messageid));
$infos = new_html_special_chars($infos);
$where = array('replyid'=>$infos['messageid']);
$reply_infos = $this->message_db->listinfo($where,$order = 'messageid ASC',$page,$pages = '10');
$show_validator = $show_scroll = $show_header = true;
include template('message','read_only');
}
public function read_group(){
if((!isset($_GET['group_id']) ||empty($_GET['group_id'])) &&(!isset($_POST['group_id']) ||empty($_POST['group_id']))) return false;
$infos = $this->message_group_db->get_one(array('id'=>$_GET['group_id']));
$infos = new_html_special_chars($infos);
if(!is_array($infos))showmessage(L('message_not_exist'),'blank');
$check = $this->message_data_db->select(array('userid'=>$this->_userid,'group_message_id'=>$_GET['group_id']));
if(!$check){
$this->message_data_db->insert(array('userid'=>$this->_userid,'group_message_id'=>$_GET['group_id']));
}
include template('message','read_group');
}
public function reply() {
if(isset($_POST['dosubmit'])) {
$messageid = intval($_POST['info']['replyid']);
$this->message_db->messagecheck($this->_userid);
$this->check_user($messageid,'to');
$_POST['info']['send_from_id'] = $this->_username;
$_POST['info']['message_time'] = SYS_TIME;
$_POST['info']['status'] = '1';
$_POST['info']['folder'] = 'inbox';
if(empty($_POST['info']['send_to_id'])) {
showmessage(L('user_noempty'),HTTP_REFERER);
}
$messageid = $this->message_db->insert($_POST['info'],true);
if(!$messageid) return FALSE;
showmessage(L('operation_success'),HTTP_REFERER);
}else {
$show_validator = $show_scroll = $show_header = true;
include template('message','send');
}
}
}
;echo '	';?>