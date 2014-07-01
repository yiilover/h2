<?php

defined('IN_HOUSE5') or exit('No permission resources.');
class index {
function __construct() {
h5_base::load_app_func('global');
$this->vote = h5_base::load_model('vote_subject_model');
$this->vote_option = h5_base::load_model('vote_option_model');
$this->vote_data = h5_base::load_model('vote_data_model');
$this->username = param::get_cookie('_username');
$this->userid = param::get_cookie('_userid');
$this->groupid = param::get_cookie('_groupid');
$this->ip = ip();
$siteid = isset($_GET['siteid']) ?intval($_GET['siteid']) : get_siteid();
define("SITEID",$siteid);
}
public function init() {
$siteid = SITEID;
$page = intval($_GET['page']);
if($page<=0){
$page = 1;
}
include template('vote','list_new');
}
public function lists() {
$siteid = SITEID;
$page = intval($_GET['page']);
if($page<=0){
$page = 1;
}
include template('vote','list_new');
}
public function show(){
$type = intval($_GET['type']);
$subjectid = abs(intval($_GET['subjectid']));
if(!$subjectid) showmessage(L('vote_novote'),'blank');
$subject_arr = $this->vote->get_subject($subjectid);
$siteid = $subject_arr['siteid'];
if(!is_array($subject_arr)) {
if(isset($_GET['action']) &&$_GET['action'] == 'js') {
exit;
}else {
showmessage(L('vote_novote'),'blank');
}
}
extract($subject_arr);
$template = $template ?$template: 'vote_tp';
$options = $this->vote_option->get_options($subjectid);
$total = 0;
$vote_data =array();
$vote_data['total'] = 0 ;
$vote_data['votes'] = 0 ;
$infos = $this->vote_data->select(array('subjectid'=>$subjectid),'data');
foreach($infos as $subjectid_arr) {
extract($subjectid_arr);
$arr = string2array($data);
foreach($arr as $key =>$values){
$vote_data[$key]+=1;
}
$total += array_sum($arr);
$vote_data['votes']++;
}
$vote_data['total'] = $total ;
if(date("Y-m-d",SYS_TIME)>$todate){
$check_status = 'disabled';
$display = 'display:none;';
}else {
$check_status = '';
}
if($_GET['action']=='js'){
if(!function_exists('ob_gzhandler')) ob_clean();
ob_start();
$template = $subject_arr['template'];
switch ($type){
case 3:
$true_template = 'vote_tp_3';
break;
case 2:
$true_template = 'vote_tp_2';
break;
default:
$true_template = $template;
}
include template('vote',$true_template);
$data=ob_get_contents();
ob_clean();
exit(format_js($data));
}
$SEO = seo(SITEID,'',$subject,$description,$subject);
if($_GET['show_type']==1){
include template('vote','vote_tp');
}else {
include template('vote',$template);
}
}
public function post(){
$subjectid = intval($_POST['subjectid']);
if(!$subjectid)	showmessage(L('vote_novote'),'blank');
$siteid = SITEID;
$return = $this->check($subjectid);
switch ($return) {
case 0:
showmessage(L('vote_voteyes'),"?s=vote/index/result&subjectid=$subjectid&siteid=$siteid");
break;
case -1:
showmessage(L('vote_voteyes'),"?s=vote/index/result&subjectid=$subjectid&siteid=$siteid");
break;
}
if(!is_array($_POST['radio'])) showmessage(L('vote_nooption'),'blank');
$time = SYS_TIME;
$data_arr = array();
foreach($_POST['radio'] as $radio){
$data_arr[$radio]='1';
}
$new_data = array2string($data_arr);
$this->vote_data->insert(array('userid'=>$this->userid,'username'=>$this->username,'subjectid'=>$subjectid,'time'=>$time,'ip'=>$this->ip,'data'=>$new_data));
$vote_arr = $this->vote->get_one(array('subjectid'=>$subjectid));
h5_base::load_app_class('receipts','pay',0);
receipts::point($vote_arr['credit'],$this->userid,$this->username,'','selfincome',L('vote_post_point'));
$this->vote->update(array('votenumber'=>'+=1'),array('subjectid'=>$subjectid));
showmessage(L('vote_votesucceed'),"?s=vote/index/result&subjectid=$subjectid&siteid=$siteid");
}
public function result(){
$siteid = SITEID;
$subjectid = abs(intval($_GET['subjectid']));
if(!$subjectid)	showmessage(L('vote_novote'),'blank');
$subject_arr = $this->vote->get_subject($subjectid);
if(!is_array($subject_arr)) showmessage(L('vote_novote'),'blank');
extract($subject_arr);
$options = $this->vote_option->get_options($subjectid);
$total = 0;
$vote_data =array();
$vote_data['total'] = 0 ;
$vote_data['votes'] = 0 ;
$infos = $this->vote_data->select(array('subjectid'=>$subjectid),'data');
foreach($infos as $subjectid_arr) {
extract($subjectid_arr);
$arr = string2array($data);
foreach($arr as $key =>$values){
$vote_data[$key]+=1;
}
$total += array_sum($arr);
$vote_data['votes']++;
}
$vote_data['total'] = $total ;
$SEO = seo(SITEID,'',$subject,$description,$subject);
include template('vote','vote_result');
}
public function check($subjectid){
$siteid = SITEID;
$subject_arr = $this->vote->get_subject($subjectid);
if($subject_arr['enabled']==0){
showmessage(L('vote_votelocked'),"?s=vote/index/result&subjectid=$subjectid&siteid=$siteid");
}
if(date("Y-m-d",SYS_TIME)>$subject_arr['todate']){
showmessage(L('vote_votepassed'),"?s=vote/index/result&subjectid=$subjectid&siteid=$siteid");
}
if($subject_arr['allowguest']==0 ){
if(!$this->username){
showmessage(L('vote_votenoguest'),"?s=vote/index/result&subjectid=$subjectid&siteid=$siteid");
}elseif($this->groupid == '7'){
showmessage('对不起，不允许邮件待验证用户投票！',"?s=vote/index/result&subjectid=$subjectid&siteid=$siteid");
}
}
$user_info = $this->vote_data->select(array('subjectid'=>$subjectid,'ip'=>$this->ip,'username'=>$this->username),'*','1',' time DESC');
if(!$user_info){
return 1;
}else {
if($subject_arr['interval']==0){
return -1;
}
if($subject_arr['interval']>0){
$condition = (SYS_TIME -$user_info[0]['time'])/(24*3600)>$subject_arr['interval'] ?1	: 0;
return $condition;
}
}
}
}
?>