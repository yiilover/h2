<?php

defined('IN_HOUSE5') or exit('No permission resources.');
define('CACHE_MODEL_PATH',HOUSE5_PATH.'caches'.DIRECTORY_SEPARATOR.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
class index {
private $db,$m_db,$M;
function __construct() {
$this->db = h5_base::load_model('sitemodel_model');
$this->m_db = h5_base::load_model('sitemodel_field_model');
$this->M = new_html_special_chars(getcache('formguide','commons'));
$this->siteid = intval($_GET[siteid]) ?intval($_GET[siteid]) : get_siteid();
$this->M = $this->M[$this->siteid];
}
public function index() {
$siteid = $this->siteid;
$SEO = seo($this->siteid,'',L('formguide_list'));
$page = max(intval($_GET['page']),1);
$r = $this->db->get_one(array('siteid'=>$this->siteid,'type'=>3,'disabled'=>0),'COUNT(`modelid`) AS sum');
$total = $r['sum'];
$pages = pages($total,$page,20);
$offset = ($page-1)*20;
$datas = $this->db->select(array('siteid'=>$this->siteid,'type'=>3,'disabled'=>0),'modelid, name, addtime',$offset.',20','`modelid` DESC');
include template('formguide','index');
}
public function show() {
if (!isset($_GET['formid']) ||empty($_GET['formid'])) {
$_GET['action'] ?exit : showmessage(L('form_no_exist'),HTTP_REFERER);
}
$siteid = $_GET['siteid'] ?intval($_GET['siteid']) : 1;
$formid = intval($_GET['formid']);
$r = $this->db->get_one(array('modelid'=>$formid,'siteid'=>$siteid,'disabled'=>0),'tablename, setting');
if (!$r) {
$_GET['action'] ?exit : showmessage(L('form_no_exist'),HTTP_REFERER);
}
$setting = string2array($r['setting']);
if ($setting['enabletime']) {
if ($setting['starttime']>SYS_TIME ||($setting['endtime']+3600*24)<SYS_TIME) {
$_GET['action'] ?exit : showmessage(L('form_expired'),APP_PATH.'index.php?s=formguide/index/index');
}
}
$userid = param::get_cookie('_userid');
if ($setting['allowunreg']==0 &&!$userid &&$_GET['action']!='js') showmessage(L('please_login_in'),APP_PATH.'index.php?s=member/index/login&forward='.urlencode(HTTP_REFERER));
if (isset($_POST['dosubmit'])) {
$tablename = 'form_'.$r['tablename'];
$this->m_db->change_table($tablename);
if($_GET['flag']=='act'&&!empty($_GET['flag']))
{
$_POST['info']['name'] = $_POST['truename'];
$_POST['info']['tel'] = $_POST['phone'];
$_POST['info']['gender'] = $_POST['sex'];
$_POST['info']['num'] = $_POST['num'];
$_POST['info']['qq'] = $_POST['qq'];
$_POST['info']['relatedid'] = $_POST['relatedid'];
$_POST['info']['description'] = $_POST['description'];
$_POST['info']['type'] = 1;
$_POST['info']['from'] = $_POST['from'];
$_POST['info']['fromurl'] = $_POST['fromurl'];
}
elseif($_GET['flag']=='lp'&&!empty($_GET['flag']))
{
$_POST['info']['name'] = $_POST['truename'];
$_POST['info']['tel'] = $_POST['phone'];
$_POST['info']['gender'] = $_POST['sex'];
$_POST['info']['num'] = 1;
$_POST['info']['qq'] = $_POST['qq'];
$_POST['info']['relation'] = $_POST['relation'];
$_POST['info']['regionid'] = $_POST['regionid'];
$_POST['info']['subject'] = $_POST['subject'];
$_POST['info']['region'] = $_POST['region'];
$_POST['info']['price'] = $_POST['price'];
$_POST['info']['type'] = 0;
$_POST['info']['from'] = $_POST['from'];
}
$data = array();
require CACHE_MODEL_PATH.'formguide_input.class.php';
$formguide_input = new formguide_input($formid);
$data = new_addslashes($_POST['info']);
$data = $formguide_input->get($data);
$data['userid'] = $userid;
$data['username'] = param::get_cookie('_username');
$data['datetime'] = SYS_TIME;
$data['ip'] = ip();
$dataid = $this->m_db->insert($data,true);
$fromurl = $_POST['info']['from'];
if(empty($fromurl))
{
$fromurl = HOUSE_PATH;
}
if ($dataid) {
if ($setting['sendmail']) {
h5_base::load_sys_func('mail');
$mails = explode(',',$setting['mails']);
if (is_array($mails)) {
foreach ($mails as $m) {
sendmail($m,L('tips'),$this->M['mailmessage']);
}
}
}
$this->db->update(array('items'=>'+=1'),array('modelid'=>$formid,'siteid'=>$this->siteid));
}
if($data['relation'] &&empty($_GET['flag']))
{
showmessage(L('thanks'),$fromurl.$data['relation']);
}
if(($_GET['flag']=='act'||$_GET['flag']=='lp')&&!empty($_GET['flag']))
{
showmessage(L('thanks'),$fromurl);
}
}else {
if ($setting['allowunreg']==0 &&!$userid &&$_GET['action']=='js') {
$no_allowed = 1;
}
h5_base::load_sys_class('form','','');
$f_info = $this->db->get_one(array('modelid'=>$formid,'siteid'=>$this->siteid));
extract($f_info);
$tablename = 'form_'.$r['tablename'];
$this->m_db->change_table($tablename);
$ip = ip();
$where = array();
if ($userid) $where = array('userid'=>$userid);
else $where = array('ip'=>$ip);
$re = $this->m_db->get_one($where,'datetime');
$setting = string2array($setting);
if (($setting['allowmultisubmit']==0 &&$re['datetime']) ||((SYS_TIME-$re['datetime'])<$this->M['interval']*60)) {
$_GET['action'] ?exit : showmessage(L('had_participate'),APP_PATH.'index.php?s=formguide/index/index');
}
require CACHE_MODEL_PATH.'formguide_form.class.php';
$formguide_form = new formguide_form($formid,$no_allowed);
$forminfos_data = $formguide_form->get();
$SEO = seo($this->siteid,L('formguide'),$name);
if (isset($_GET['action']) &&$_GET['action']=='js') {
if(!function_exists('ob_gzhandler')) ob_clean();
ob_start();
}
$template = ($_GET['action']=='js') ?$js_template : $show_template;
include template('formguide',$template,$default_style);
if (isset($_GET['action']) &&$_GET['action']=='js') {
$data=ob_get_contents();
ob_clean();
exit(format_js($data));
}
}
}
public function show_js() {
$siteid = $_GET['siteid'] ?intval($_GET['siteid']) : 1;
$formid = intval($_GET['formid']) ?intval($_GET['formid']) : 17;
$r = $this->db->get_one(array('modelid'=>$formid,'siteid'=>$siteid,'disabled'=>0),'tablename, setting');
if (!$r) {
$_GET['action'] ?exit : showmessage(L('form_no_exist'),HTTP_REFERER);
}
$setting = string2array($r['setting']);
if ($setting['enabletime']) {
if ($setting['starttime']>SYS_TIME ||($setting['endtime']+3600*24)<SYS_TIME) {
$_GET['action'] ?exit : showmessage(L('form_expired'),APP_PATH.'index.php?s=formguide/index/index');
}
}
$userid = param::get_cookie('_userid');
if ($setting['allowunreg']==0 &&!$userid &&$_GET['action']!='js') showmessage(L('please_login_in'),APP_PATH.'index.php?s=member/index/login&forward='.urlencode(HTTP_REFERER));
$tablename = 'form_'.$r['tablename'];
$this->m_db->change_table($tablename);
$_POST['info']['name'] = iconv( "UTF-8","gb2312",$_POST['name']);
$_POST['info']['tel'] = $_POST['phone'];
$_POST['info']['gender'] = $_POST['sex'];
$_POST['info']['description'] = iconv( "UTF-8","gb2312",$_POST['content']);
$_POST['info']['num'] = 1;
$_POST['info']['qq'] = iconv( "UTF-8","gb2312",$_POST['qq']);
$_POST['info']['relation'] = $_POST['cid'];
$_POST['info']['regionid'] = $_POST['regionid'];
$_POST['info']['subject'] = iconv( "UTF-8","gb2312",$_POST['subject']);
$_POST['info']['region'] =iconv( "UTF-8","gb2312",$_POST['region']);
$_POST['info']['price'] = iconv( "UTF-8","gb2312",$_POST['price']);
$_POST['info']['type'] = 0;
$data = array();
require CACHE_MODEL_PATH.'formguide_input.class.php';
$formguide_input = new formguide_input($formid);
$data = new_addslashes($_POST['info']);
$data = $formguide_input->get($data);
$data['userid'] = $userid;
$data['username'] = param::get_cookie('_username');
$data['datetime'] = SYS_TIME;
$data['ip'] = ip();
$dataid = $this->m_db->insert($data,true);
$fromurl = $_POST['info']['from'];
if(empty($fromurl))
{
$fromurl = HOUSE_PATH;
}
if ($dataid) {
if ($setting['sendmail']) {
h5_base::load_sys_func('mail');
$mails = explode(',',$setting['mails']);
if (is_array($mails)) {
foreach ($mails as $m) {
sendmail($m,L('tips'),$this->M['mailmessage']);
}
}
}
$this->db->update(array('items'=>'+=1'),array('modelid'=>$formid,'siteid'=>$this->siteid));
}
echo '报名成功';
}
public function show_list() {
$siteid = $_GET['siteid'] ?intval($_GET['siteid']) : 1;
$formid = intval($_GET['formid']) ?intval($_GET['formid']) : 17;
$r = $this->db->get_one(array('modelid'=>$formid,'siteid'=>$siteid,'disabled'=>0),'tablename, setting');
if (!$r) {
$_GET['action'] ?exit : showmessage(L('form_no_exist'),HTTP_REFERER);
}
$setting = string2array($r['setting']);
if ($setting['enabletime']) {
if ($setting['starttime']>SYS_TIME ||($setting['endtime']+3600*24)<SYS_TIME) {
$_GET['action'] ?exit : showmessage(L('form_expired'),APP_PATH.'index.php?s=formguide/index/index');
}
}
$userid = param::get_cookie('_userid');
if ($setting['allowunreg']==0 &&!$userid &&$_GET['action']!='js') showmessage(L('please_login_in'),APP_PATH.'index.php?s=member/index/login&forward='.urlencode(HTTP_REFERER));
$tablename = 'form_'.$r['tablename'];
$this->m_db->change_table($tablename);
$relation = intval($_POST['cid']);
$page = max(intval($_POST['page']),1);
$perpage = max(intval($_POST['perpage']),10);
$nextpage = $page+1;
$prepage = $page-1;
if(!$relation)
{
showmessage('楼盘信息错误',HTTP_REFERER);
}
$offset = ($page-1)*$perpage;
$r = $this->m_db->get_one(array('relation'=>$relation,'type'=>0),'COUNT(`dataid`) AS sum');
$total = $r['sum'];
$pages = ceil($total / $perpage);
$datas = $this->m_db->select(array('relation'=>$relation,'type'=>0),'datetime,tel,subject,name,qq,description',$offset.','.$perpage,'datetime DESC');
echo '<div class="fix tgMes_List_tbody">';
foreach($datas as $key =>$v)
{
$key++;
echo ' <div class="fix clear tgMes_List_tr">
                    	<span class="tgMes_td tgMes_tdNum">'.$key.'</span>
                        <span class="tgMes_td tgMes_tdName">'.hidden($v[name]).'</span>
                        <span class="tgMes_td tgMes_tdPhone"><em class="en">'.hidden($v[tel],1).'</em></span>
                        <span class="tgMes_td tgMes_tdMes">'.str_cut($v[description],40).'</span>
                        <span class="tgMes_td tgMes_tdDate"><em class="en">'.date('Y-m-d',$v[datetime]).'</em></span>         	         	                                        
                    </div>';
}
echo '</div>
                                <div class="fix page">
                	<span class="fl">共有<em class="en">'.$total.'</em>人已报名</span>';
if($pages>1)
{
echo '<ul class="fr page_list">';
if($prepage>0)
{
echo '<li class="prev"><a href="javascript:initTg('.$prepage.');" title="上一页">上一页</a></li>';
}
else
{
echo '<li class="prev"><a href="javascript:;" title="上一页">上一页</a></li>';
}
if($nextpage<=$pages)
{
echo '<li class="next"><a href="javascript:initTg('.$nextpage.');" title="下一页">下一页</a></li>';
}
else
{
echo '<li class="next"><a href="javascript:;" title="下一页">下一页</a></li>';
}
echo ' </ul>';
}
echo '</div>';
}
}
?>