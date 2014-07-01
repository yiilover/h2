<?php
 
defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_func('global');
h5_base::load_sys_class('format','',0);
class index {
function __construct() {
$this->db = h5_base::load_model('content_model');
$this->siteid = isset($_GET['siteid']) &&(intval($_GET['siteid']) >0) ?intval(trim($_GET['siteid'])) : (param::get_cookie('siteid') ?param::get_cookie('siteid') : 1);
param::set_cookie('siteid',$this->siteid);
$this->wap_site = getcache('wap_site','wap');
$this->types = getcache('wap_type','wap');
$this->wap = $this->wap_site[$this->siteid];
define('WAP_SITEURL',$this->wap['domain'] ?$this->wap['domain'] : APP_PATH.'index.php?s=wap&siteid='.$this->siteid);
if($this->wap['status']!=1) exit(L('wap_close_status'));
}
public function init() {
$WAP = $this->wap;
$TYPE = $this->types;
$WAP_SETTING = string2array($WAP['setting']);
$GLOBALS['siteid'] = $siteid = max($this->siteid,1);
$template = $WAP_SETTING['index_template'] ?$WAP_SETTING['index_template'] : 'index';
include template('wap',$template);
}
public function lists() {
$parentids = array();
$WAP = $this->wap;
$TYPE = $this->types;
$WAP_SETTING = string2array($WAP['setting']);
$GLOBALS['siteid'] = $siteid = max($this->siteid,1);
$typeid = intval($_GET['typeid']);
$catid = intval($_GET['catid']);
if(!$typeid &&!$catid) exit(L('parameter_error'));
if(!$catid)
{
$catid = $this->types[$typeid]['cat'];
}
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
if(!isset($CATEGORYS[$catid])) exit(L('parameter_error'));
$CAT = $CATEGORYS[$catid];
$siteid = $GLOBALS['siteid'] = $CAT['siteid'];
extract($CAT);
foreach($TYPE as $_t) $parentids[] = $_t['parentid'];
if($catid=='14')
{
$template = 'house';
define('URLRULE','list{$lst}-g{$page}.html');
}
else
{
$template = ($TYPE[$typeid]['parentid']==0 &&in_array($typeid,array_unique($parentids))) ?$WAP_SETTING['category_template'] : $WAP_SETTING['list_template'];
define('URLRULE','index.php?s=wap/index/lists&typeid={$typeid}~index.php?s=wap/index/lists&typeid={$typeid}&page={$page}');
}
$MODEL = getcache('model','commons');
$modelid = $CAT['modelid'];
$tablename = $this->db->table_name = $this->db->db_tablepre.$MODEL[$modelid]['tablename'];
$total = $this->db->count(array('status'=>'99','catid'=>$catid));
$page = isset($_GET['page']) &&intval($_GET['page']) ?intval($_GET['page']) : 1;
$pagesize = $WAP_SETTING['listnum'] ?intval($WAP_SETTING['listnum']) : 20 ;
$offset = ($page -1) * $pagesize;
$list = $this->db->select(array('status'=>'99','catid'=>$catid),'*',$offset.','.$pagesize,'inputtime DESC');
$GLOBALS['URL_ARRAY'] = array('typeid'=>$typeid);
$pages = wpa_pages($total,$page,$pagesize);
include template('wap',$template);
}
public function show() {
$WAP = $this->wap;
$WAP_SETTING = string2array($WAP['setting']);
$TYPE = $this->types;
$GLOBALS['siteid'] = $siteid = max($this->siteid,1);
$typeid = $type_tmp = intval($_GET['typeid']);
$catid = $_GET['catid'];
$id = intval($_GET['id']);
if(!$catid ||!$id) exit(L('parameter_error'));
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
$page = intval($_GET['page']);
$page = max($page,1);
if(!isset($CATEGORYS[$catid]) ||$CATEGORYS[$catid]['type']!=0) exit(L('information_does_not_exist','','content'));
$this->category = $CAT = $CATEGORYS[$catid];
$this->category_setting = $CAT['setting'] = string2array($this->category['setting']);
$siteid = $GLOBALS['siteid'] = $CAT['siteid'];
$MODEL = getcache('model','commons');
$modelid = $CAT['modelid'];
$tablename = $this->db->table_name = $this->db->db_tablepre.$MODEL[$modelid]['tablename'];
$r = $this->db->get_one(array('id'=>$id));
if(!$r ||$r['status'] != 99) showmessage(L('info_does_not_exists'),'blank');
$this->db->table_name = $tablename.'_data';
$r2 = $this->db->get_one(array('id'=>$id));
$rs = $r2 ?array_merge($r,$r2) : $r;
$catid = $CATEGORYS[$r['catid']]['catid'];
$modelid = $CATEGORYS[$catid]['modelid'];
require_once CACHE_MODEL_PATH.'content_output.class.php';
$content_output = new content_output($modelid,$catid,$CATEGORYS);
$data = $content_output->get($rs);
extract($data);
$typeid = $type_tmp;
if(strpos($content,'[/page]')!==false) {
$content = preg_replace("|\[page\](.*)\[/page\]|U",'',$content);
}elseif (strpos($content,'[page]')!==false) {
$content = str_replace('[page]','',$content);
}
if($maxcharperpage <10) $maxcharperpage = $WAP_SETTING['c_num'];
$contentpage = h5_base::load_app_class('contentpage','content');
if($pictureurls) {
$pictureurl = pic_pages($pictureurls);
$isshow = 0;
$PIC_POS = strpos($pictureurl,'[page]');
if($PIC_POS !== false) {
$this->url = h5_base::load_app_class('wap_url','wap');
$pictureurls = array_filter(explode('[page]',$pictureurl));
$pagenumber = count($pictureurls);
if (strpos($pictureurl,'[/page]')!==false &&($CONTENT_POS<7)) {
$pagenumber--;
}
for($i=1;$i<=$pagenumber;$i++) {
$pageurls[$i] = $this->url->show($id,$i,$catid,$typeid);
}
$END_POS = strpos($pictureurl,'[/page]');
if($END_POS !== false) {
if(preg_match_all("|\[page\](.*)\[/page\]|U",$pictureurl,$m,PREG_PATTERN_ORDER)) {
foreach($m[1] as $k=>$v) {
$p = $k+1;
$titles[$p]['title'] = strip_tags($v);
$titles[$p]['url'] = $pageurls[$p][0];
}
}
}
$pages = content_pages($pagenumber,$page,$pageurls,0);
if($CONTENT_POS<7) {
$pictureurl = $pictureurls[$page];
}else {
if ($page==1 &&!empty($titles)) {
$pictureurl = $title.'[/page]'.$pictureurls[$page-1];
}else {
$pictureurl = $pictureurls[$page-1];
}
}
}
}
$CONTENT_POS = strpos($content,'[page]');
if($CONTENT_POS !== false) {
$this->url = h5_base::load_app_class('wap_url','wap');
$contents = array_filter(explode('[page]',$content));
$pagenumber = count($contents);
if (strpos($content,'[/page]')!==false &&($CONTENT_POS<7)) {
$pagenumber--;
}
for($i=1;$i<=$pagenumber;$i++) {
$pageurls[$i] = $this->url->show($id,$i,$catid,$typeid);
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
}
$pages = content_pages($pagenumber,$page,$pageurls);
if($CONTENT_POS<7) {
$content = $contents[$page];
}else {
if ($page==1 &&!empty($titles)) {
$content = $title.'[/page]'.$contents[$page-1];
}else {
$content = $contents[$page-1];
}
}
if($_GET['remains']=='true') {
$content = $pages ='';
for($i=$page;$i<=$pagenumber;$i++) {
$content .=$contents[$i-1];
}
}
}
$content = content_strip(wml_strip($content));
$template = $WAP_SETTING['show_template'] ?$WAP_SETTING['show_template'] : 'show';
include template('wap',$template);
}
function comment() {
$WAP = $this->wap;
$TYPE = $this->types;
if($_POST['dosumbit']) {
$comment = h5_base::load_app_class('comment','comment');
h5_base::load_app_func('global','comment');
$username = $this->wap['sitename'].L('house5_friends');
$userid = param::get_cookie('_userid');
$catid = intval($_POST['catid']);
$typeid = intval($_POST['typeid']);
$contentid = intval($_POST['id']);
$msg = trim($_POST['msg']);
$commentid = trim($_POST['commentid']);
$title = $_POST['title'];
$url = $_POST['url'];
if (!$data = get_comment_api($commentid)) {
exit(L('parameter_error'));
}else {
$title = $data['title'];
$url = $data['url'];
unset($data);
}
$data = array('userid'=>$userid,'username'=>$username,'content'=>$msg);
$comment->add($commentid,$this->siteid,$data,$id,$title,$url);
echo L('wap_guestbook').'<br/><a href="'.show_url($catid,$contentid,$typeid).'">'.L('wap_goback').'</a>';
}
}
function comment_list() {
$WAP = $this->wap;
$TYPE = $this->types;
$comment = h5_base::load_app_class('comment','comment');
h5_base::load_app_func('global','comment');
$typeid  = intval($_GET['typeid']);
$GLOBALS['siteid'] = max($this->siteid,1);
$commentid = isset($_GET['commentid']) &&trim(addslashes(urldecode($_GET['commentid']))) ?trim(addslashes(urldecode($_GET['commentid']))) : exit(L('illegal_parameters'));
if(!preg_match("/^[a-z0-9_\-]+$/i",$commentid)) exit(L('illegal_parameters'));
list($modules,$contentid,$siteid) = decode_commentid($commentid);
list($module,$catid) = explode('_',$modules);
$comment_setting_db = h5_base::load_model('comment_setting_model');
$setting = $comment_setting_db->get_one(array('siteid'=>$this->siteid));
if (!$data = get_comment_api($commentid)) {
exit(L('illegal_parameters'));
}else {
$title = $data['title'];
$url = $data['url'];
unset($data);
}
include template('wap','comment_list');
}
function maps() {
$WAP = $this->wap;
$TYPE = $this->types;
$WAP_SETTING = string2array($WAP['setting']);
$GLOBALS['siteid'] = max($this->siteid,1);
include template('wap','maps');
}
function big_image() {
$WAP = $this->wap;
$TYPE = $this->types;
$WAP_SETTING = string2array($WAP['setting']);
$GLOBALS['siteid'] = max($this->siteid,1);
$url=base64_decode(trim($_GET['url']));
$width = $_GET['w'] ?trim(intval($_GET['w'])) : 320 ;
$new_url = thumb($url,$width,0);
include template('wap','big_image');
}
public function loupan() {
global $INI;
if(substr( $INI['authkey'],162,10) <time()) die('����ѹ�������');
domain_verify();
$catid = intval($_GET['catid']);
$id = intval($_GET['id']);
$t = trim($_GET['t']);
if(!$catid ||!$id) showmessage(L('information_does_not_exist'),'blank');
$_userid = $this->_userid;
$_username = $this->_username;
$_groupid = $this->_groupid;
$page = intval($_GET['page']);
$page = max($page,1);
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
if(!isset($CATEGORYS[$catid]) ||$CATEGORYS[$catid]['type']!=0) showmessage(L('information_does_not_exist'),'blank');
$this->category = $CAT = $CATEGORYS[$catid];
$this->category_setting = $CAT['setting'] = string2array($this->category['setting']);
$siteid = $GLOBALS['siteid'] = $CAT['siteid'];
$MODEL = getcache('model','commons');
$modelid = $CAT['modelid'];
$tablename = $this->db->table_name = $this->db->db_tablepre.$MODEL[$modelid]['tablename'];
$r = $this->db->get_one(array('id'=>$id));
if(!$r ||$r['status'] != 99) showmessage(L('info_does_not_exists'),'blank');
$this->db->table_name = $tablename.'_data';
$r2 = $this->db->get_one(array('id'=>$id));
$rs = $r2 ?array_merge($r,$r2) : $r;
$catid = $CATEGORYS[$r['catid']]['catid'];
$modelid = $CATEGORYS[$catid]['modelid'];
require_once CACHE_MODEL_PATH.'content_output.class.php';
$content_output = new content_output($modelid,$catid,$CATEGORYS);
$data = $content_output->get($rs);
extract($data);
if(module_exists('comment')) {
$allow_comment = isset($allow_comment) ?$allow_comment : 1;
}else {
$allow_comment = 0;
}
$arrparentid = explode(',',$CAT['arrparentid']);
$top_parentid = $arrparentid[1] ?$arrparentid[1] : $catid;
if($t=="detail")
{
$template = 'house_detail';
}
elseif($t=="news")
{
$template = 'house_news';
}
elseif($t=="huxing")
{
if($_GET['pid'])
{
$template = 'show_house_hx';
}
else
{
$template = 'house_huxing';
}
}
elseif($t=="pic")
{
if($_GET['pid'])
{
$template = 'show_house_pic';
}
else
{
$template = 'house_pic';
}
}
elseif($t=="comment")
{
$template = 'house_comment';
}
elseif($t=="device")
{
$template = 'house_device';
}
elseif($t=="cal")
{
$template = 'house_cal';
}
else
{
showmessage(L('information_does_not_exist'),'blank');
}
if(!$title1)
{
$title1 = $title;
}
$seo_keywords = '';
if(!empty($keywords)) $seo_keywords = $keywords;
$seo_keywords = $seo_keywords.','.$this->category_setting['meta_keywords'];
$SEO = seo($siteid,$catid,$title1,$description,$seo_keywords);
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
define('STYLE',$CAT['setting']['template_list']);
if(isset($rs['paginationtype'])) {
$paginationtype = $rs['paginationtype'];
$maxcharperpage = $rs['maxcharperpage'];
}
$pages = $titles = '';
include template('wap',$template);
}
public function tools()
{
$catid = intval($_GET['catid']);
$t = trim($_GET['t']);
if($t=='maplist')
{
$allid = $_POST['allid'];
$result = explode(',',$allid);
if(count($result)>3)
{
$weizhi = '��ǰλ�ã�'.$result[2];
$find = $result[0].','.$result[1].','.$result[2].',';
$allid = str_replace($find,'',$allid);
$where = "id in ($allid)";
$num = count(explode(',',$allid));
}
else
{
$where = '';
}
}
if(in_array($t,array('top','calcul','dk','pg','tq','sf','news','map','maplist')))
{
if($t=='dk')
{
$t='calcul';
}
elseif($t=='news')
{
$t='list_news';
}
$template = $t;
}
$WAP = $this->wap;
$TYPE = $this->types;
$WAP_SETTING = string2array($WAP['setting']);
$GLOBALS['siteid'] = $siteid = max($this->siteid,1);
include template('wap',$template);
}
}
?>