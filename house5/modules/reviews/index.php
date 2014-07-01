<?php

defined('IN_HOUSE5') or exit('No permission resources.');
class index {
protected  $reviewsid,$modules,$siteid,$format;
function __construct() {
h5_base::load_app_func('global');
h5_base::load_sys_class('format','',0);
$this->reviewsid = isset($_GET['reviewsid']) &&trim(urldecode($_GET['reviewsid'])) ?trim(urldecode($_GET['reviewsid'])) : $this->_show_msg(L('illegal_parameters'));
$this->format = isset($_GET['format']) ?$_GET['format'] : '';
list($this->modules,$contentid,$this->siteid) = decode_reviewsid($this->reviewsid);
define('SITEID',$this->siteid);
}
public function init() {
$hot = isset($_GET['hot']) &&intval($_GET['hot']) ?intval($_GET['hot']) : 0;
h5_base::load_sys_class('form');
$reviewsid =&$this->reviewsid;
$modules =&$this->modules;
$contentid =&$this->contentid;
$siteid =&$this->siteid;
$username = param::get_cookie('_username',L('house5_friends'));
$userid = param::get_cookie('_userid');
$reviews_setting_db = h5_base::load_model('reviews_setting_model');
$setting = $reviews_setting_db->get_one(array('siteid'=>$this->siteid));
$SEO = seo($siteid,'',$title);
if (!$data = get_comment_api($reviewsid)) {
$this->_show_msg(L('illegal_parameters'));
}else {
$title = $data['title'];
$url = $data['url'];
if (isset($data['allow_reviews']) &&empty($data['allow_reviews'])) {
showmessage(L('canot_allow_comment'));
}
unset($data);
}
if (isset($_GET['iframe'])) {
if (strpos($url,APP_PATH) === 0) {
$domain = APP_PATH;
}else {
$urls = parse_url($url);
$domain = $urls['scheme'].'://'.$urls['host'].(isset($urls['port']) &&!empty($urls['port']) ?":".$urls['port'] : '').'/';
}
if ($_GET['iframe'] ==1) {
include template('reviews','show_list');
}
else{
include template('reviews','show_list');
}
}else {
include template('reviews','show_list');
}
}
public function post() {
$reviews = h5_base::load_app_class('reviews');
$id = isset($_GET['id']) &&intval($_GET['id']) ?intval($_GET['id']) : '';
$SITE = siteinfo($this->siteid);
$username = param::get_cookie('_username',$SITE['name'].L('house5_friends'));
$userid = param::get_cookie('_userid');
$reviews_setting_db = h5_base::load_model('reviews_setting_model');
$setting = $reviews_setting_db->get_one(array('siteid'=>$this->siteid));
if (!empty($setting)) {
if (!$setting['guest']) {
if (!$username ||!$userid) {
$this->_show_msg(L('landing_users_to_comment'),HTTP_REFERER);
}
}
if ($setting['code']) {
$session_storage = 'session_'.h5_base::load_config('system','session_storage');
h5_base::load_sys_class($session_storage);
session_start();
$code = isset($_POST['code']) &&trim($_POST['code']) ?strtolower(trim($_POST['code'])) : $this->_show_msg(L('please_enter_code'),HTTP_REFERER);
if ($code != $_SESSION['code']) {
$this->_show_msg(L('code_error'),HTTP_REFERER);
}
}
}
if (!$data = get_comment_api($this->reviewsid)) {
$this->_show_msg(L('illegal_parameters'));
}else {
$title = $data['title'];
$url = $data['url'];
unset($data);
}
if (strpos($url,APP_PATH) === 0) {
$domain = APP_PATH;
}else {
$urls = parse_url($url);
$domain = $urls['scheme'].'://'.$urls['host'].(isset($urls['port']) &&!empty($urls['port']) ?":".$urls['port'] : '').'/';
}
$maxlength = '200';
$advantage = isset($_POST['advantage']) &&trim($_POST['advantage']) ?trim($_POST['advantage']) : '';
$disadvantage = isset($_POST['disadvantage']) &&trim($_POST['disadvantage']) ?trim($_POST['disadvantage']) : '';
$content = isset($_POST['content']) &&trim($_POST['content']) ?trim($_POST['content']) : '';
$advantage_length = empty($advantage) ?0 : strlen($advantage);
if($maxlength &&$advantage_length >$maxlength) {
showmessage("优点不得超过 $maxlength 个字符！");
}
$disadvantage_length = empty($disadvantage) ?0 : strlen($disadvantage);
if($maxlength &&$disadvantage_length >$maxlength) {
showmessage("缺点不得超过 $maxlength 个字符！");
}
$length = empty($content) ?0 : strlen($content);
if($maxlength &&$length >$maxlength) {
showmessage("总结不得超过 $maxlength 个字符！");
}
$star1 = isset($_POST['star1']) &&intval($_POST['star1']) ?intval($_POST['star1']) : '';
$star2 = isset($_POST['star2']) &&intval($_POST['star2']) ?intval($_POST['star2']) : '';
$star3 = isset($_POST['star3']) &&intval($_POST['star3']) ?intval($_POST['star3']) : '';
$star4 = isset($_POST['star4']) &&intval($_POST['star4']) ?intval($_POST['star4']) : '';
$star5 = isset($_POST['star5']) &&intval($_POST['star5']) ?intval($_POST['star5']) : '';
$star6 = isset($_POST['star6']) &&intval($_POST['star6']) ?intval($_POST['star6']) : '';
$startype = isset($_POST['startype']) &&intval($_POST['startype']) ?intval($_POST['startype']) : '';
$starnum = isset($_POST['starnum']) &&intval($_POST['starnum']) ?intval($_POST['starnum']) : '';
if (!$star1 ||!$star2 ||!$star3 ||!$star4) 
{
showmessage("请给楼盘打分！");
}
$data = array('userid'=>$userid,'username'=>$username,'advantage'=>$advantage,'disadvantage'=>$disadvantage,'content'=>$content,'star1'=>$star1,'star2'=>$star2,'star3'=>$star3,'star4'=>$star4,'star5'=>$star5,'star6'=>$star6,'startype'=>$startype,'starnum'=>$starnum);
$session_storage = 'session_'.h5_base::load_config('system','session_storage');
h5_base::load_sys_class($session_storage);
session_start();
if(!empty($_SESSION['token']['access_token']))
{
define('WB_AKEY',h5_base::load_config('system','sina_akey'));
define('WB_SKEY',h5_base::load_config('system','sina_skey'));
h5_base::load_app_class('weibooauth','member',0);
$c = new SaeTClientV2( WB_AKEY ,WB_SKEY ,$_SESSION['token']['access_token'] );
$weibotext = "我刚刚在发表了我对#".$title."#楼盘的点评！优点：".$advantage."；缺点：".$disadvantage."；总结：".$content.$url;
$weibotext = iconv("GBK","UTF-8",$weibotext);
$c->update($weibotext);
}
$reviews->add($this->reviewsid,$this->siteid,$data,$id,$title,$url);
$this->_show_msg($reviews->get_error()."<iframe width='0' id='top_src' height='0' src='$domain/js.html?200'></iframe>",(in_array($reviews->msg_code,array(0,7)) ?HTTP_REFERER : ''),(in_array($reviews->msg_code,array(0,7)) ?1 : 0));
}
public function impression()
{
$reviews = h5_base::load_app_class('reviews');
$id = isset($_GET['id']) &&intval($_GET['id']) ?intval($_GET['id']) : '';
$reviewsid = $this->reviewsid;
$reviewsid_arr = explode('-',$reviewsid);
$houseid = intval($reviewsid_arr[1]);
$SITE = siteinfo($this->siteid);
$username = param::get_cookie('_username',$SITE['name'].L('house5_friends'));
$userid = param::get_cookie('_userid');
$reviews_setting_db = h5_base::load_model('reviews_setting_model');
$setting = $reviews_setting_db->get_one(array('siteid'=>$this->siteid));
if (!empty($setting)) {
if (!$setting['guest']) {
if (!$username ||!$userid) {
$this->_show_msg(L('landing_users_to_comment'),HTTP_REFERER);
}
}
if ($setting['code']) {
$session_storage = 'session_'.h5_base::load_config('system','session_storage');
h5_base::load_sys_class($session_storage);
session_start();
$code = isset($_POST['code']) &&trim($_POST['code']) ?strtolower(trim($_POST['code'])) : $this->_show_msg(L('please_enter_code'),HTTP_REFERER);
if ($code != $_SESSION['code']) {
$this->_show_msg(L('code_error'),HTTP_REFERER);
}
}
}
if (!$data = get_comment_api($this->reviewsid)) {
$this->_show_msg(L('illegal_parameters'));
}else {
$title = $data['title'];
$url = $data['url'];
unset($data);
}
if (strpos($url,APP_PATH) === 0) {
$domain = APP_PATH;
}else {
$urls = parse_url($url);
$domain = $urls['scheme'].'://'.$urls['host'].(isset($urls['port']) &&!empty($urls['port']) ?":".$urls['port'] : '').'/';
}
$impression = isset($_POST['impression']) &&trim($_POST['impression']) ?trim($_POST['impression']) : '';
if (!$impression) 
{
$this->_show_msg(L('fill_all_info'),HTTP_REFERER);
}
$data = array('houseid'=>$houseid,'impression'=>$impression);
$session_storage = 'session_'.h5_base::load_config('system','session_storage');
h5_base::load_sys_class($session_storage);
session_start();
if(!empty($_SESSION['token']['access_token']))
{
define('WB_AKEY',h5_base::load_config('system','sina_akey'));
define('WB_SKEY',h5_base::load_config('system','sina_skey'));
h5_base::load_app_class('weibooauth','member',0);
$c = new SaeTClientV2( WB_AKEY ,WB_SKEY ,$_SESSION['token']['access_token'] );
$weibotext = "我刚刚在发表了我对#".$title."#楼盘的印象是#".$impression."# ".$url;
$weibotext = iconv("GBK","UTF-8",$weibotext);
$c->update($weibotext);
}
$reviews->addyx($this->siteid,$data,$id,$title,$url);
$this->_show_msg($reviews->get_error()."<iframe width='0' id='top_src' height='0' src='$domain/js.html?200'></iframe>",(in_array($reviews->msg_code,array(0,7)) ?HTTP_REFERER : ''),(in_array($reviews->msg_code,array(0,7)) ?1 : 0));
}
public function support() {
$id = isset($_GET['id']) &&intval($_GET['id']) ?intval($_GET['id']) : $this->_show_msg(L('illegal_parameters'),HTTP_REFERER);
if (param::get_cookie('reviews_'.$id)) {
$this->_show_msg(L('dragonforce'),HTTP_REFERER);
}
$reviews = h5_base::load_app_class('reviews');
if ($reviews->support($this->reviewsid,$id)) {
param::set_cookie('reviews_'.$id,$id,SYS_TIME+3600);
}
$this->_show_msg($reviews->get_error(),($reviews->msg_code == 0 ?HTTP_REFERER : ''),($reviews->msg_code == 0 ?1 : 0));
}
public function ajax() {
$reviewsid =&$this->reviewsid;
$siteid =&$this->siteid;
$num = isset($_GET['num']) &&intval($_GET['num']) ?intval($_GET['num']) : 20;
$star1 = isset($_GET['star1']) &&intval($_GET['star1']) ?intval($_GET['star1']) : 0;
$star2 = isset($_GET['star2']) &&intval($_GET['star2']) ?intval($_GET['star2']) : 0;
$star3 = isset($_GET['star3']) &&intval($_GET['star3']) ?intval($_GET['star3']) : 0;
$star4 = isset($_GET['star4']) &&intval($_GET['star4']) ?intval($_GET['star4']) : 0;
$star5 = isset($_GET['star5']) &&intval($_GET['star5']) ?intval($_GET['star5']) : 0;
$star6 = isset($_GET['star6']) &&intval($_GET['star6']) ?intval($_GET['star6']) : 0;
$startype = isset($_GET['startype']) &&intval($_GET['startype']) ?intval($_GET['startype']) : 1;
$starnum = isset($_GET['starnum']) &&intval($_GET['starnum']) ?intval($_GET['starnum']) : 4;
$h5_tag = h5_base::load_app_class('reviews_tag');
$reviews = array();
if ($reviews = $h5_tag->get_reviews(array('reviewsid'=>$reviewsid))) {
$page = isset($_GET['page']) &&intval($_GET['page']) ?intval($_GET['page']) : 1;
$offset = ($page-1)*$num;
$data = array('reviewsid'=>$reviewsid,'site'=>$siteid,'limit'=>$offset.','.$num,'star1'=>$star1,'star2'=>$star2,'star3'=>$star3,'star4'=>$star4,'star5'=>$star5,'star6'=>$star6,'startype'=>$startype);
$reviews['data'] = $h5_tag->lists($data);
h5_base::load_sys_class('format','',0);
foreach ($reviews['data'] as $k=>$v) {
$reviews['data'][$k]['format_time'] = format::date($v['creat_at'],1);
}
$reviews['pages'] = pages($total,$page,$num,'javascript:reviews_next_page({$page})');
if (h5_base::load_config('system','charset') == 'gbk') {
$reviews = array_iconv($reviews,'gbk','utf-8');
}
echo json_encode($reviews);
}else {
exit('0');
}
}
protected function _show_msg($msg,$url = '',$status = 0) {
switch ($this->format) {
case 'json':
$msg = h5_base::load_config('system','charset') == 'gbk'?iconv('gbk','utf-8',$msg) : $msg;
echo json_encode(array('msg'=>$msg,'status'=>$status));
exit;
break;
case 'jsonp':
$msg = h5_base::load_config('system','charset') == 'gbk'?iconv('gbk','utf-8',$msg) : $msg;
echo $_GET['callback'].'('.json_encode(array('msg'=>$msg,'status'=>$status)).')';
exit;
break;
default:
showmessage($msg,$url);
break;
}
}
}
?>