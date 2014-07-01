<?php

defined('IN_HOUSE5') or exit('No permission resources.');
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
h5_base::load_app_func('util','content');
class index {
private $db;
function __construct() {
$this->db = h5_base::load_model('content_model');
$this->_userid = param::get_cookie('_userid');
$this->_username = param::get_cookie('_username');
$this->_groupid = param::get_cookie('_groupid');
}
public function init() {
if(isset($_GET['siteid'])) {
$siteid = intval($_GET['siteid']);
}else {
$siteid = 1;
}
$siteid = $GLOBALS['siteid'] = max($siteid,1);
define('SITEID',$siteid);
$_userid = $this->_userid;
$_username = $this->_username;
$_groupid = $this->_groupid;
$SEO = seo($siteid);
$sitelist  = getcache('sitelist','commons');
$default_style = $sitelist[$siteid]['default_style'];
$default_city = $sitelist[$siteid]['default_city'];
$wap_site = getcache('wap_site','wap');
$wap = $wap_site[$siteid];
$wap_siteurl = $wap['domain'] ?$wap['domain'] : APP_PATH.'index.php?s=wap&siteid='.$siteid;
$site_title = $sitelist[$siteid]['name'];
$copyright = $sitelist[$siteid]['copyright'];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
include template('content','index',$default_style);
}
public function show() {
$catid = intval($_GET['catid']);
$housecatid = intval($_GET['housecatid']);
$id = intval($_GET['id']);
if(!$catid ||!$id) showmessage(L('information_does_not_exist'),'blank');
$_userid = $this->_userid;
$_username = $this->_username;
$_groupid = $this->_groupid;
$page = intval($_GET['page']);
$page = max($page,1);
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$sitelist  = getcache('sitelist','commons');
$default_style = $sitelist[$siteid]['default_style'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
$copyright = $sitelist[$siteid]['copyright'];
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
if($groupids_view &&is_array($groupids_view)) {
$_groupid = param::get_cookie('_groupid');
$_groupid = intval($_groupid);
if(!$_groupid) {
$forward = urlencode(get_url());
showmessage(L('login_website'),APP_PATH.'index.php?s=member/index/login/forward/'.$forward);
}
if(!in_array($_groupid,$groupids_view)) showmessage(L('no_priv'));
}else {
$_priv_data = $this->_category_priv($catid);
if($_priv_data=='-1') {
$forward = urlencode(get_url());
showmessage(L('login_website'),APP_PATH.'index.php?s=member/index/login/forward/'.$forward);
}elseif($_priv_data=='-2') {
showmessage(L('no_priv'));
}
}
if(module_exists('comment')) {
$allow_comment = isset($allow_comment) ?$allow_comment : 1;
}else {
$allow_comment = 0;
}
$paytype = $rs['paytype'];
$readpoint = $rs['readpoint'];
$allow_visitor = 1;
if($readpoint ||$this->category_setting['defaultchargepoint']) {
if(!$readpoint) {
$readpoint = $this->category_setting['defaultchargepoint'];
$paytype = $this->category_setting['paytype'];
}
$allow_visitor = self::_check_payment($catid.'_'.$id,$paytype);
if(!$allow_visitor) {
$http_referer = urlencode(get_url());
$allow_visitor = sys_auth($catid.'_'.$id.'|'.$readpoint.'|'.$paytype).'/http_referer/'.$http_referer;
}else {
$allow_visitor = 1;
}
}
$arrparentid = explode(',',$CAT['arrparentid']);
$top_parentid = $arrparentid[1] ?$arrparentid[1] : $catid;
$template = $template ?$template : $CAT['setting']['show_template'];
if(!$template) $template = 'show';
$seo_keywords = '';
if(!empty($keywords)) $seo_keywords = implode(',',$keywords);
$SEO = seo($siteid,$catid,$title,$description,$seo_keywords);
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
$thecontent = $content;
if($rs['paginationtype']!=0) {
$CONTENT_POS = strpos($content,'[page]');
if($CONTENT_POS !== false) {
$this->url = h5_base::load_app_class('url','content');
$contents = array_filter(explode('[page]',$content));
$pagenumber = count($contents);
if (strpos($content,'[/page]')!==false &&($CONTENT_POS<7)) {
$pagenumber--;
}
for($i=1;$i<=$pagenumber;$i++) {
if(is_mobile()!==false)
{
$pageurls[$i] = 'http://news.venfang.com/showinfo-'.$catid.'-'.$id.'-p'.$i.'.html';
}
else
{
$pageurls[$i] = $this->url->show($id,$i,$catid,$rs['inputtime']);
}
}
$END_POS = strpos($content,'[/page]');
if($END_POS !== false) {
if($CONTENT_POS>7) {
$content = '[page]'.$title.'[/page]'.$content;
}
if(preg_match_all("|\[page\](.*)\[/page\]|U",$content,$m,PREG_PATTERN_ORDER)) {
foreach($m[1] as $k=>$v) {
$p = $k+1;
$titles[$p]['title'] = strip_tags($v);
$titles[$p]['url'] = $pageurls[$p][0];
}
}
}
if(is_mobile()!==false)
{
$pages = content_pages_mobile($pagenumber,$page,$pageurls);
}
else
{
$pages = content_pages($pagenumber,$page,$pageurls);
}
if($CONTENT_POS<7) {
$content = $contents[$page];
}else {
if ($page==1 &&!empty($titles)) {
$content = $title.'[/page]'.$contents[$page-1];
}else {
$content = $contents[$page-1];
}
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
if(intval($_GET['showall']==1) &&(is_mobile()!==false))
{
$thecontent = str_replace('[page]','',$thecontent);
$content = str_replace('[/page]','',$thecontent);
$pages = '';
}
$this->db->table_name = $tablename;
$previous_page = $this->db->get_one("`catid` = '$catid' AND `id`<'$id' AND `status`=99",'*','id DESC');
$next_page = $this->db->get_one("`catid`= '$catid' AND `id`>'$id' AND `status`=99");
if(empty($previous_page)) {
$previous_page = array('title'=>L('first_page'),'thumb'=>IMG_PATH.'nopic_small.gif','url'=>'javascript:alert(\''.L('first_page').'\');');
}
if(empty($next_page)) {
$next_page = array('title'=>L('last_page'),'thumb'=>IMG_PATH.'nopic_small.gif','url'=>'javascript:alert(\''.L('last_page').'\');');
}
include template('content',$template);
}
public function lists() {
$catid = intval($_GET['catid']);
$housecatid = intval($_GET['housecatid']);
$_priv_data = $this->_category_priv($catid);
if($_priv_data=='-1') {
$forward = urlencode(get_url());
showmessage(L('login_website'),APP_PATH.'index.php?s=member/index/login&forward='.$forward);
}elseif($_priv_data=='-2') {
showmessage(L('no_priv'));
}
$_userid = $this->_userid;
$_username = $this->_username;
$_groupid = $this->_groupid;
h5_base::load_sys_class('format','',0);
if(!$catid) showmessage(L('category_not_exists'),'blank');
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
if(!isset($CATEGORYS[$catid])) showmessage(L('category_not_exists'),'blank');
$CAT = $CATEGORYS[$catid];
$siteid = $GLOBALS['siteid'] = $CAT['siteid'];
extract($CAT);
$setting = string2array($setting);
if(!$setting['meta_title']) $setting['meta_title'] = $catname;
$SEO = seo($siteid,'',$setting['meta_title'],$setting['meta_description'],$setting['meta_keywords']);
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
$page = intval($_GET['page']);
$template = $setting['category_template'] ?$setting['category_template'] : 'category';
$template_list = $setting['list_template'] ?$setting['list_template'] : 'list';
if (isset($_COOKIE['recentlyHouse'.$siteid]))
{
$recentlyHouse = explode(',',$_COOKIE['recentlyHouse'.$siteid]);
}
if (isset($_COOKIE['recentlyEsf'.$siteid]))
{
$recentlyEsf = explode(',',$_COOKIE['recentlyEsf'.$siteid]);
}
if (isset($_COOKIE['recentlyEsfrent'.$siteid]))
{
$recentlyEsfrent = explode(',',$_COOKIE['recentlyEsfrent'.$siteid]);
}
if (isset($_COOKIE['recentlyXiaoqu'.$siteid]))
{
$recentlyXiaoqu = explode(',',$_COOKIE['recentlyXiaoqu'.$siteid]);
}
if($type==0) {
$template = $child ?$template : $template_list;
$arrparentid = explode(',',$arrparentid);
$top_parentid = $arrparentid[1] ?$arrparentid[1] : $catid;
$array_child = array();
$self_array = explode(',',$arrchildid);
foreach ($self_array as $arr) {
if($arr!=$catid &&$CATEGORYS[$arr][parentid]==$catid) {
$array_child[] = $arr;
}
}
$arrchildid = implode(',',$array_child);
$urlrules = getcache('urlrules','commons');
$urlrules = str_replace('|','~',$urlrules[$category_ruleid]);
$tmp_urls = explode('~',$urlrules);
$tmp_urls = isset($tmp_urls[1]) ?$tmp_urls[1] : $tmp_urls[0];
preg_match_all('/{\$([a-z0-9_]+)}/i',$tmp_urls,$_urls);
if(!empty($_urls[1])) {
foreach($_urls[1] as $_v) {
$GLOBALS['URL_ARRAY'][$_v] = $_GET[$_v];
}
}
define('URLRULE',$urlrules);
$GLOBALS['URL_ARRAY']['categorydir'] = $categorydir;
$GLOBALS['URL_ARRAY']['catdir'] = $catdir;
$GLOBALS['URL_ARRAY']['catid'] = $catid;
include template('content',$template);
}else {
$this->page_db = h5_base::load_model('page_model');
$r = $this->page_db->get_one(array('catid'=>$catid));
if($r) extract($r);
$template = $setting['page_template'] ?$setting['page_template'] : 'page';
$arrchild_arr = $CATEGORYS[$parentid]['arrchildid'];
if($arrchild_arr=='') $arrchild_arr = $CATEGORYS[$catid]['arrchildid'];
$arrchild_arr = explode(',',$arrchild_arr);
array_shift($arrchild_arr);
$keywords = $keywords ?$keywords : $setting['meta_keywords'];
$SEO = seo($siteid,0,$title,$setting['meta_description'],$keywords);
include template('content',$template);
}
}
public function json_list() {
if($_GET['type']=='keyword'&&$_GET['modelid'] &&$_GET['keywords']) {
$modelid = intval($_GET['modelid']);
$id = intval($_GET['id']);
$MODEL = getcache('model','commons');
if(isset($MODEL[$modelid])) {
$keywords = safe_replace(htmlspecialchars($_GET['keywords']));
$keywords = addslashes(iconv('utf-8','gbk',$keywords));
$this->db->set_model($modelid);
$result = $this->db->select("keywords LIKE '%$keywords%'",'id,title,url',10);
if(!empty($result)) {
$data = array();
foreach($result as $rs) {
if($rs['id']==$id) continue;
if(CHARSET=='gbk') {
foreach($rs as $key=>$r) {
$rs[$key] = iconv('gbk','utf-8',$r);
}
}
$data[] = $rs;
}
if(count($data)==0) exit('0');
echo json_encode($data);
}else {
exit('0');
}
}
}
}
protected function _check_payment($flag,$paytype) {
$_userid = $this->_userid;
$_username = $this->_username;
if(!$_userid) return false;
h5_base::load_app_class('spend','pay',0);
$setting = $this->category_setting;
$repeatchargedays = intval($setting['repeatchargedays']);
if($repeatchargedays) {
$fromtime = SYS_TIME -86400 * $repeatchargedays;
$r = spend::spend_time($_userid,$fromtime,$flag);
if($r['id']) return true;
}
return false;
}
protected function _category_priv($catid) {
$catid = intval($catid);
if(!$catid) return '-2';
$_groupid = $this->_groupid;
$_groupid = intval($_groupid);
if($_groupid==0) $_groupid = 8;
$this->category_priv_db = h5_base::load_model('category_priv_model');
$result = $this->category_priv_db->select(array('catid'=>$catid,'is_admin'=>0,'action'=>'visit'));
if($result) {
if(!$_groupid) return '-1';
foreach($result as $r) {
if($r['roleid'] == $_groupid) return '1';
}
return '-2';
}else {
return '1';
}
}
public function loupan() {
global $INI;
if(substr( $INI['authkey'],162,10) <time()) die('软件已过服务期');
$catid = intval($_GET['catid']);
$id = intval($_GET['id']);
$t = trim($_GET['t']);
$page = intval($_GET['page']);
$page = max($page,1);
if(preg_match ( '/wenfang-p(\d*)/',$t,$matchs))
{
$t = 'wenfang';
$page = intval($matchs[1]);
}
$domain1 = trim($_GET['domain']);
if(!$catid ||( !$id &&!$domain1)) showmessage(L('information_does_not_exist'),'blank');
$_userid = $this->_userid;
$_username = $this->_username;
$_groupid = $this->_groupid;
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
if(!empty($domain1))
{
$r = $this->db->get_one(array('domain'=>$domain1));
if($r)
{
$id = $r['id'];
}
else
{
showmessage(L('information_does_not_exist'),'blank');
}
}
$house_domain = h5_base::load_config('system','house_domain');
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
if(in_array($t,array('zhuye','xinxi','dongtai','jiage','zixun','huxing','xiangce','dianping','peitao','wenfang')))
{
define('MAX_ITEMS',10);
if (isset($_COOKIE['recentlyHouse'.$siteid]))
{
$history = explode(',',$_COOKIE['recentlyHouse'.$siteid]);
array_unshift($history,$id);
$history = array_unique($history);
while (count($history) >MAX_ITEMS)
{
array_pop($history);
}
setcookie('recentlyHouse'.$siteid,implode(',',$history),time() +3600 * 24 ,'/');
}
else
{
setcookie('recentlyHouse'.$siteid,$id,time() +3600 * 24 ,'/');
}
}
if (isset($_COOKIE['recentlyHouse'.$siteid]))
{
$recentlyHouse = explode(',',$_COOKIE['recentlyHouse'.$siteid]);
}
if($t=="zhuye")
{
if(is_mobile()==false)
{
$template = 'show_house';
}
else
{
$wap_site = getcache('wap_site','wap');
$types = getcache('wap_type','wap');
$wap = $wap_site[$siteid];
header('location:'.$wap['domain'].'detail/'.$id.'/');
}
if(empty($domain1)&&!empty($domain)&&!empty($house_domain))
{
$domainlink = 'http://'.$domain.'.'.$house_domain;
header('location:'.$domainlink.'/');
}
$title1 = $title.'楼盘信息';
$keywords = $title.','.$title.'楼盘,'.$title.'业主论坛,';
$description = $title.'，楼盘频道为您介绍'.$title.'楼盘最新动态，包括开盘日期、售楼处销售电话、'.$title.'房价走势、户型图、样板间、周边交通等相关信息。';
if($siteid=="1")
{
$qrfile = 'caches/caches_content/caches_house/mobile_houseqrcode/'.$siteid.'/'.$id.'.png';
if(!file_exists($qrfile) ||$_SESSION['roleid']==1) {
require_once 'house5/plugin/mobile/qrcode.class.php';
QRcode::png($url,$qrfile);
}
}
list($lngX,$latY,$zoom) = explode('|',$map);
}
elseif($t=="xinxi")
{
$template = 'show_house_xinxi';
$title1 = $title.'楼盘详细信息';
$keywords = $title.','.$title.'楼盘,'.$title.'详细信息';
$description = $title.'详细信息，楼盘详细信息频道为您介绍'.$title.'楼盘类型、面积、入住时间、配套设施及售楼电话，开发商等详细信息。'.$title.'楼盘位于'.$address;
if(empty($domain1)&&!empty($domain)&&!empty($house_domain))
{
$domainlink = 'http://'.$domain.'.'.$house_domain;
header('location:'.$domainlink.'/xinxi.html');
}
}
elseif($t=="dongtai")
{
$template = 'show_house_dongtai';
$title1 = $title.'楼盘动态';
$keywords = $title.','.$title.'楼盘,'.$title.'最新动态';
$description = $title.'楼盘动态，楼盘动态频道为您介绍'.$title.'楼盘最新动态信息，包括'.$title.'楼盘施工进度图，项目新闻，户型介绍，楼盘建设实景照片等详细信息。';
if(empty($domain1)&&!empty($domain)&&!empty($house_domain))
{
$domainlink = 'http://'.$domain.'.'.$house_domain;
header('location:'.$domainlink.'/dongtai.html');
}
}
elseif($t=="tuan")
{
$template = 'show_house_tuan';
$title1 = $title.'楼盘团购';
if(empty($domain1)&&!empty($domain)&&!empty($house_domain))
{
$domainlink = 'http://'.$domain.'.'.$house_domain;
header('location:'.$domainlink.'/tuan.html');
}
}
elseif($t=="shapan")
{
$template = 'show_house_shapan';
$title1 = $title.'网络沙盘';
if(empty($domain1)&&!empty($domain)&&!empty($house_domain))
{
$domainlink = 'http://'.$domain.'.'.$house_domain;
header('location:'.$domainlink.'/shapan.html');
}
}
elseif($t=="jiage")
{
$template = 'show_house_jiage';
$title1 = $title.','.$title.'楼盘,'.$title.'历史价格,'.$title.'价格分析';
$description =$title.'均价，价格明细频道为您介绍'.$title.'楼盘房价走势最新动态，包括'.$title.'楼盘均价，'.$title.'房价走势图，'.$title.'房价开盘价格、售楼处销售电话等相关信息。';
if(empty($domain1)&&!empty($domain)&&!empty($house_domain))
{
$domainlink = 'http://'.$domain.'.'.$house_domain;
header('location:'.$domainlink.'/jiage.html');
}
}
elseif($t=="zixun")
{
$template = 'show_house_zixun';
$title1 = $title.','.$title.'楼盘,'.$title.'楼盘资讯,'.$title.'楼盘新闻';
if(empty($domain1)&&!empty($domain)&&!empty($house_domain))
{
$domainlink = 'http://'.$domain.'.'.$house_domain;
header('location:'.$domainlink.'/zixun.html');
}
}
elseif($t=="huxing")
{
$template = 'show_house_huxing';
$title1 = $title.'户型图';
$keywords = $title.','.$title.'楼盘,'.$title.'户型图';
$description = $title.'户型图,户型图频道为您介绍'.$title.'楼盘一居室、二居室、三居室、外观、交通、样板间、配套设施等相关图片，更多'.$title.'户型图，尽在';
if(empty($domain1)&&!empty($domain)&&!empty($house_domain)&&empty($_GET['lid']))
{
$domainlink = 'http://'.$domain.'.'.$house_domain;
header('location:'.$domainlink.'/huxing.html');
}
}
elseif($t=="xiangce")
{
$template = 'show_house_xiangce';
$title1 = $title.'楼盘相册';
$keywords = $title.','.$title.'楼盘,'.$title.'楼盘相册';
$description = $title.'楼盘相册,户型图频道为您介绍'.$title.'楼盘一居室、二居室、三居室、外观、交通、样板间、配套设施等相关图片，更多'.$title.'楼盘图片，尽在';
if(empty($domain1)&&!empty($domain)&&!empty($house_domain)&&empty($_GET['lid']))
{
$domainlink = 'http://'.$domain.'.'.$house_domain;
header('location:'.$domainlink.'/xiangce.html');
}
}
elseif($t=="dianping")
{
$template = 'show_house_dianping';
$title1 = $title.'楼盘好吗？'.$title.'楼盘怎么样？'.$title.'楼盘点评_楼盘印象_楼盘评分';
$keywords = $title.'楼盘点评-'.$title.'楼盘印象';
$description = $title.'怎么样,楼盘点评频道为您介绍网友及用户对'.$title.'的综合评价，包括'.$title.'优势、不足之处，配套设施建设，周边交通是否便利等详细信息。';
if(empty($domain1)&&!empty($domain)&&!empty($house_domain))
{
$domainlink = 'http://'.$domain.'.'.$house_domain;
header('location:'.$domainlink.'/dianping.html');
}
}
elseif($t=="peitao")
{
$template = 'show_house_peitao';
$title1 = $title.'周边配套';
$keywords = $title.','.$title.'楼盘,'.$title.'周边配套设施,周边环境指数,周边设施,周边指数';
$description = '楼盘地图，让您详细了解'.$title.'周边配套设施情况，帮助你选房。';
if(empty($domain1)&&!empty($domain)&&!empty($house_domain))
{
$domainlink = 'http://'.$domain.'.'.$house_domain;
header('location:'.$domainlink.'/peitao.html');
}
}
elseif($t=="wenfang")
{
$urlrules = 'wenfang-p{$page}.html';
define('URLRULE',$urlrules);
$template = 'show_house_wenfang';
$title1 = $title.' 网友提问';
$keywords = $title.'问房,'.$title.'问答,'.$title.'最新问答,'.$title.'信息咨询';
$description = $title.'问房,'.$title.'问答,'.$title.'最新问答,'.$title.'信息咨询';
if(empty($domain1)&&!empty($domain)&&!empty($house_domain))
{
$domainlink = 'http://'.$domain.'.'.$house_domain;
header('location:'.$domainlink.'/wenfang-p'.$page.'.html');
}
}
elseif($t=="showpic")
{
$template = 'show_house_showpic';
$title1 = $title.'_户型图';
$keywords = $title.','.$title.'楼盘,'.$title.'户型图';
$description = $title.'户型图,户型图频道为您介绍'.$title.'楼盘一居室、二居室、三居室、外观、交通、样板间、配套设施等相关图片，更多'.$title.'户型图，尽在';
}
elseif($t=="showphoto")
{
$template = 'show_house_showphoto';
$title1 = $title.' 楼盘相册_实景图_效果图_样板间_配套图浏览';
$keywords = $title.','.$title.'楼盘,'.$title.'楼盘相册';
$description = $title.'楼盘相册,户型图频道为您介绍'.$title.'楼盘一居室、二居室、三居室、外观、交通、样板间、配套设施等相关图片，更多'.$title.'楼盘图片，尽在';
}
elseif($t=="company")
{
$housecatid = intval($_GET['housecatid']);
$template = 'show_company';
$keywords = $title;
$description = $title;
}
elseif($t=="fangyuan")
{
$fcatid = intval($_GET['fcatid']);
$template = 'list_fangyuan';
$keywords = $title;
$description = $title;
}
elseif($t=="showfangyuan")
{
$fcatid = intval($_GET['fcatid']);
$template = 'show_fangyuan';
$keywords = $title;
$description = $title;
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
if(isset($rs['paginationtype'])) {
$paginationtype = $rs['paginationtype'];
$maxcharperpage = $rs['maxcharperpage'];
}
$pages = $titles = '';
include template('content',$template);
}
public function lp_duibi()
{
$catid = intval($_GET['catid']);
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$sitelist  = getcache('sitelist','commons');
$default_style = $sitelist[$siteid]['default_style'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
$copyright = $sitelist[$siteid]['copyright'];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
$this->category = $CAT = $CATEGORYS[$catid];
$CAT['setting'] = string2array($this->category['setting']);
$houseid = $_GET['houseid'];
$houseid = explode('_',$houseid);
foreach($houseid as $_v) {
if($_v)
{
$allinfo[] = $this->getinfo(intval($_v),$catid);
}
}
foreach($allinfo as $info)
{
if(!empty($title))
{
$title=$title.'PK'.$info['title'];
}
else
{
$title = $info['title'];
}
}
$template = 'lp_duibi';
$keywords = '楼盘PK,楼盘对比,楼盘比较,价格比较,楼盘点评,楼盘优缺点,户型比较';
$description = '楼盘PK为为网友开发的楼盘对比工具，它可以将网友关注的楼盘进行详细的对比，里面汇集了编辑们实地考察楼盘后精编的楼盘优缺点，同时还包括网友角度对楼盘的点评及评分，帮助网友多角度清晰的了解楼盘，并最终挑选到满意和适合自己的房子及户型。';
$seo_keywords = '';
if(!empty($keywords)) $seo_keywords = $keywords;
$SEO = seo($siteid,$catid,$title.'楼盘对比',$description,$seo_keywords);
if(isset($rs['paginationtype'])) {
$paginationtype = $rs['paginationtype'];
$maxcharperpage = $rs['maxcharperpage'];
}
$pages = $titles = '';
include template('content',$template);
}
public function getinfo($id,$catid)
{
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
if(!$data['id']) $data['id']=$id;
return $data;
}
public function lp_post()
{
if (isset($_POST['dosubmit'])) {
$catid = intval($_GET['catid']);
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
if(!isset($CATEGORYS[$catid]) ||$CATEGORYS[$catid]['type']!=0) showmessage(L('information_does_not_exist'),'blank');
$this->category = $CAT = $CATEGORYS[$catid];
$this->category_setting = $CAT['setting'] = string2array($this->category['setting']);
$siteid = $GLOBALS['siteid'] = $CAT['siteid'];
$MODEL = getcache('model','commons');
$modelid = $CAT['modelid'];
$this->db->table_name = $this->db->db_tablepre.$MODEL[$modelid]['tablename'];
$info = $_POST['info'];
$data['catid'] = $catid;
$data['title'] = safe_replace(htmlspecialchars($info['region'].'$$'.$info['subject'].'$$'.$info['question']));
$data['name'] = trim($info['name']);
$data['tel'] = trim($info['tel']);
$data['xglp'] = intval($info['relation']);
$data['region'] = intval($info['regionid']);
$data['housename'] = safe_replace(htmlspecialchars($info['subject']));
$data['inputtime'] = SYS_TIME;
$data['status'] = '99';
$data['ip'] = ip();
if(empty($info['question']))
{
showmessage('请认真填写问题。');
}
$id = $moreinfo['id'] = $this->db->insert($data,true);
$moreinfo['question'] = safe_replace(htmlspecialchars($info['question']));
$fromurl = $info['from'];
if(empty($fromurl))
{
$fromurl = HOUSE_PATH;
}
$this->db->table_name = $this->db->table_name.'_data';
$this->db->insert($moreinfo);
showmessage(L('您的问题已提交~'),$fromurl.$info['relation'].'/wenfang-p1.html');
}
}
public function lp_post_js()
{
$catid = 15;
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
if(!isset($CATEGORYS[$catid]) ||$CATEGORYS[$catid]['type']!=0) showmessage(L('information_does_not_exist'),'blank');
$this->category = $CAT = $CATEGORYS[$catid];
$this->category_setting = $CAT['setting'] = string2array($this->category['setting']);
$siteid = $GLOBALS['siteid'] = $CAT['siteid'];
$MODEL = getcache('model','commons');
$modelid = $CAT['modelid'];
$this->db->table_name = $this->db->db_tablepre.$MODEL[$modelid]['tablename'];
$_POST['region'] = iconv( "UTF-8","gb2312",$_POST['region']);
$_POST['cname'] = iconv( "UTF-8","gb2312",$_POST['cname']);
$_POST['subject'] = iconv( "UTF-8","gb2312",$_POST['subject']);
$_POST['content'] = iconv( "UTF-8","gb2312",$_POST['content']);
$data['catid'] = $catid;
$data['title'] = safe_replace(htmlspecialchars($_POST['region'].'$$'.$_POST['subject'].'$$'.$_POST['content']));
$data['name'] = trim($_POST['cname']);
$data['tel'] = trim($_POST['tel']);
$data['xglp'] = intval($_POST['cid']);
$data['region'] = intval($_POST['regionid']);
$data['housename'] = safe_replace(htmlspecialchars($_POST['subject']));
$data['inputtime'] = SYS_TIME;
$data['status'] = '99';
$data['ip'] = ip();
if(empty($_POST['content']))
{
echo '请认真填写问题.';
exit();
}
$id = $moreinfo['id'] = $this->db->insert($data,true);
$moreinfo['question'] = safe_replace(htmlspecialchars($_POST['content']));
$this->db->table_name = $this->db->table_name.'_data';
$this->db->insert($moreinfo);
echo '在线提问成功.';
}
public function lp_show_list() {
$catid = 15;
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
if(!isset($CATEGORYS[$catid]) ||$CATEGORYS[$catid]['type']!=0) showmessage(L('information_does_not_exist'),'blank');
$this->category = $CAT = $CATEGORYS[$catid];
$this->category_setting = $CAT['setting'] = string2array($this->category['setting']);
$siteid = $GLOBALS['siteid'] = $CAT['siteid'];
$MODEL = getcache('model','commons');
$modelid = $CAT['modelid'];
$this->db->table_name = $this->db->db_tablepre.$MODEL[$modelid]['tablename'];
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
$r = $this->db->get_one(array('xglp'=>$relation,'isreply'=>1),'COUNT(`id`) AS sum');
$total = $r['sum'];
$pages = ceil($total / $perpage);
$return = $this->db->select(array('xglp'=>$relation,'isreply'=>1),'id,inputtime,name',$offset.','.$perpage,'id DESC','','id');
$ids = array();
foreach ($return as $v) {
if (isset($v['id']) &&!empty($v['id'])) {
$ids[] = $v['id'];
}else {
continue;
}
}
if (!empty($ids)) {
$this->db->table_name = $this->db->table_name.'_data';
$ids = implode('\',\'',$ids);
$r = $this->db->select("`id` IN ('$ids')",'*','','','','id');
if (!empty($r)) {
foreach ($r as $k=>$v) {
if (isset($return[$k])) $return[$k] = array_merge($v,$return[$k]);
}
}
}
foreach($return as $key =>$r)
{
$key++;
echo ' <div class="LP_FAQ_table">
            	<div class="clear LP_FAQ_tr">
                    <div class="fl LP_FAQ_th">发布时间</div>
                    <div class="fl LP_FAQ_td LP_FAQ_td_date"><b class="en">'.date('Y年m月d日',$r[inputtime]).'</b></div>
                    <div class="fl LP_FAQ_th LP_FAQ_th_id">发布ID</div>
                    <div class="fl LP_FAQ_td LP_FAQ_td_id"><b class="en">'.$r[id].'</b></div>
                </div>
            	<div class="clear LP_FAQ_tr">
                    <div class="fl LP_FAQ_th">内容</div>
                    <div class="fl LP_FAQ_td">'.$r[question].'</div>
                </div>
                <div class="clear LP_FAQ_tr">
                    <div class="fl LP_FAQ_th">在线回答</div>
                    <div class="fl LP_FAQ_td c_blue">'.$r[content].'</div>
                </div>
             </div>';
}
echo '
                                <div class="fix page">
                	<span class="fl">共有<em class="en">'.$total.'</em>人在线提问</span>';
if($pages>1)
{
echo '<ul class="fr page_list">';
if($prepage>0)
{
echo '<li class="prev"><a href="javascript:initTw('.$prepage.');" title="上一页">上一页</a></li>';
}
else
{
echo '<li class="prev"><a href="javascript:;" title="上一页">上一页</a></li>';
}
if($nextpage<=$pages)
{
echo '<li class="next"><a href="javascript:initTw('.$nextpage.');" title="下一页">下一页</a></li>';
}
else
{
echo '<li class="next"><a href="javascript:;" title="下一页">下一页</a></li>';
}
echo ' </ul>';
}
echo '</div>';
}
public function qqqun_lists() {
$catid = intval($_GET['catid']);
$_priv_data = $this->_category_priv($catid);
if($_priv_data=='-1') {
$forward = urlencode(get_url());
showmessage(L('login_website'),APP_PATH.'index.php?s=member/index/login&forward='.$forward);
}elseif($_priv_data=='-2') {
showmessage(L('no_priv'));
}
$_userid = $this->_userid;
$_username = $this->_username;
$_groupid = $this->_groupid;
if(!$catid) showmessage(L('category_not_exists'),'blank');
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
if(!isset($CATEGORYS[$catid])) showmessage(L('category_not_exists'),'blank');
$CAT = $CATEGORYS[$catid];
$siteid = $GLOBALS['siteid'] = $CAT['siteid'];
extract($CAT);
$setting = string2array($setting);
$setting['meta_title'] = '业主QQ群-'.$setting['meta_title'];
$SEO = seo($siteid,'',$setting['meta_title'],$setting['meta_description'],$setting['meta_keywords']);
$page = $_GET['page'];
$template = 'list_qqqun';
if (isset($_COOKIE['recentlyHouse'.$siteid]))
{
$recentlyHouse = explode(',',$_COOKIE['recentlyHouse'.$siteid]);
}
$urlrules = 'qqqun-p{$page}.html';
define('URLRULE',$urlrules);
$GLOBALS['URL_ARRAY']['categorydir'] = $categorydir;
$GLOBALS['URL_ARRAY']['catdir'] = $catdir;
$GLOBALS['URL_ARRAY']['catid'] = $catid;
include template('content',$template);
}
public function house_index() {
$catid = intval($_GET['catid']);
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
$this->category = $CAT = $CATEGORYS[$catid];
$setting = $CAT['setting'] = string2array($this->category['setting']);
$template = 'house_index';
if(!$setting['meta_title']) $setting['meta_title'] = $default_city.'新楼盘,'.$default_city.'新房,'.$default_city.'房价,'.$default_city.'楼盘信息,地图找房';
$SEO = seo($siteid,'',$setting['meta_title'],$setting['meta_description'],$setting['meta_keywords']);
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('content',$template);
}
public function zimulists()
{
$catid = intval($_GET['catid']);
$keyword = trim(strtoupper($_GET['ename']));
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
$this->category = $CAT = $CATEGORYS[$catid];
$setting = $CAT['setting'] = string2array($this->category['setting']);
$template = 'list_zimu';
if(!$setting['meta_title']) $setting['meta_title'] = $default_city.'首字母'.$keyword.'楼盘索引,汇总';
$SEO = seo($siteid,'',$setting['meta_title'],$setting['meta_description'],$setting['meta_keywords']);
include template('content',$template);
}
public function ybj_lists() {
$catid = intval($_GET['catid']);
$_priv_data = $this->_category_priv($catid);
if($_priv_data=='-1') {
$forward = urlencode(get_url());
showmessage(L('login_website'),APP_PATH.'index.php?s=member/index/login&forward='.$forward);
}elseif($_priv_data=='-2') {
showmessage(L('no_priv'));
}
$_userid = $this->_userid;
$_username = $this->_username;
$_groupid = $this->_groupid;
if(!$catid) showmessage(L('category_not_exists'),'blank');
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
if(!isset($CATEGORYS[$catid])) showmessage(L('category_not_exists'),'blank');
$CAT = $CATEGORYS[$catid];
$siteid = $GLOBALS['siteid'] = $CAT['siteid'];
extract($CAT);
$setting = string2array($setting);
$setting['meta_title'] = $default_city.'楼盘样板间';
$SEO = seo($siteid,'',$setting['meta_title'],$setting['meta_description'],$setting['meta_keywords']);
$page = $_GET['page'];
$template = 'list_ybj';
$urlrules = 'ybjlist-p{$page}.html';
define('URLRULE',$urlrules);
$GLOBALS['URL_ARRAY']['categorydir'] = $categorydir;
$GLOBALS['URL_ARRAY']['catdir'] = $catdir;
$GLOBALS['URL_ARRAY']['catid'] = $catid;
include template('content',$template);
}
public function baojialists()
{
$catid = intval($_GET['catid']);
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$sitelist  = getcache('sitelist','commons');
$default_city = $sitelist[$siteid]['default_city'];
$copyright = $sitelist[$siteid]['copyright'];
$site_title = $sitelist[$siteid]['name'];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
$this->category = $CAT = $CATEGORYS[$catid];
$setting = $CAT['setting'] = string2array($this->category['setting']);
$template = 'list_baojia';
if(!$setting['meta_title']) $setting['meta_title'] = $default_city.'房价走势_房价趋势_'.$default_city.'房价走势图';
$setting['meta_description'] = '';
$SEO = seo($siteid,'',$setting['meta_title'],$setting['meta_description'],$setting['meta_keywords']);
include template('content',$template);
}
public function search()
{
$keyword = trim($_GET['keyword']);
$page = intval($_GET['page']);
$template = 'list_search_mobile';
if(is_mobile()!==false)
{
include template('content',$template);
}
}
public function topsearch()
{
$next = intval($_GET['next']);
if($next)
{
$template = 'list_topsearch_next';
}
else
{
$template = 'list_topsearch';
}
include template('content',$template);
}
public function sitemap()
{
$template = 'list_sitemap';
$siteids = getcache('category_content','commons');
$siteid = 1;
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('content',$template);
}
public function esf()
{
$modelid = '39';
$catid = '112';
$grouplist = getcache('grouplist','member');
if($this->_userid &&$grouplist[$this->_groupid]['modelid']=='42')
{
header('location:'.APP_PATH.'index.php?s=member/index/esf');
}
$fields = getcache('model_field_'.$modelid,'model');
foreach($fields as $field=>$v) {
if($field == 'house_pic')
{
$upload_allowext = $v['upload_allowext'];
$upload_number = $v['upload_number'];
$isselectimage = $v['isselectimage'];
}
}
$authkey = upload_key("$upload_number,$upload_allowext,$isselectimage");
$template = 'esf_post';
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('content',$template);
}
public function esf_sale()
{
$modelid = '39';
$catid = '112';
$grouplist = getcache('grouplist','member');
if($this->_userid &&$grouplist[$this->_groupid]['modelid']=='42')
{
header('location:'.APP_PATH.'index.php?s=member/index/esf');
}
$fields = getcache('model_field_'.$modelid,'model');
foreach($fields as $field=>$v) {
if($field == 'house_pic')
{
$upload_allowext = $v['upload_allowext'];
$upload_number = $v['upload_number'];
$isselectimage = $v['isselectimage'];
}
}
$authkey = upload_key("$upload_number,$upload_allowext,$isselectimage");
$template = 'esf_post';
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('content',$template);
}
public function esf_search()
{
$keyword = trim($_POST['keyword']);
$keyword = iconv('gbk','utf-8',$keyword);
$type = $_GET['t'];
if($type=='rent')
{
$list='rent-list';
}
elseif($type=='xiaoqu')
{
$list='xiaoqu-list';
}
else
{
$list='list';
}
if(!empty($keyword))
{
header('location:'.ESF_PATH.$list.'-k'.$keyword.'.html');
}
else
{
header('location:'.ESF_PATH.$list.'.html');
}
}
public function esf_rent()
{
$modelid = '41';
$catid = '113';
$grouplist = getcache('grouplist','member');
if($this->_userid &&$grouplist[$this->_groupid]['modelid']=='42')
{
header('location:'.APP_PATH.'index.php?s=member/index/rent');
}
$fields = getcache('model_field_'.$modelid,'model');
foreach($fields as $field=>$v) {
if($field == 'house_pic')
{
$upload_allowext = $v['upload_allowext'];
$upload_number = $v['upload_number'];
$isselectimage = $v['isselectimage'];
}
}
$authkey = upload_key("$upload_number,$upload_allowext,$isselectimage");
$template = 'esf_rent_post';
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$site_title = $sitelist[$siteid]['name'];
include template('content',$template);
}
public function esfshow()
{
global $INI;
if(substr( $INI['authkey'],162,10) <time()) die('软件已过服务期');
h5_base::load_sys_class('format','',0);
$catid = intval($_GET['catid']);
$id = intval($_GET['id']);
if(!$catid ||!$id) showmessage(L('information_does_not_exist'),'blank');
$_userid = $this->_userid;
$_username = $this->_username;
$_groupid = $this->_groupid;
$this->_db = h5_base::load_model('content_model');
$this->_db->table_name = $this->_db->db_tablepre.'member_broker_identity';
$identityinfo = $this->_db->get_one(array('broker_id'=>$this->memberinfo['userid'],'idtype'=>'identity'));
if(!empty($identityinfo) &&$identityinfo['status']) {
$idcard_status=1;
}
$certificateinfo = $this->_db->get_one(array('broker_id'=>$this->memberinfo['userid'],'idtype'=>'certificate'));
if(!empty($certificateinfo) &&$certificateinfo['status']) {
$certificate_status=1;
}
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
$relationxq = get_relationxq($id,$catid,110);
if($r['uid'])
{
$member_db = h5_base::load_model('member_model');
$memberinfo = $member_db->get_one(array('userid'=>$r['uid']));
$member_db->set_model($memberinfo['modelid']);
$member_modelinfo = $member_db->get_one(array('userid'=>$r['uid']));
$member_modelinfo = $member_modelinfo ?$member_modelinfo : array();
if(is_array($memberinfo)) {
$memberinfo = array_merge($memberinfo,$member_modelinfo);
}
$grouplist = getcache('grouplist','member');
$memberinfo['groupname'] = $grouplist[$memberinfo['groupid']]['name'];
$memberinfo['groupicon'] = $grouplist[$memberinfo['groupid']]['icon'];
$this->_db = h5_base::load_model('content_model');
$this->_db->table_name = $this->_db->db_tablepre.'member_broker_identity';
$identityinfo = $this->_db->get_one(array('broker_id'=>$r['uid'],'idtype'=>'identity'));
if(!empty($identityinfo) &&$identityinfo['status']) {
$idcard_status=1;
}
$certificateinfo = $this->_db->get_one(array('broker_id'=>$r['uid'],'idtype'=>'certificate'));
if(!empty($certificateinfo) &&$certificateinfo['status']) {
$certificate_status=1;
}
}
$menu_info = menu_info('3360',$region);
if(module_exists('comment')) {
$allow_comment = isset($allow_comment) ?$allow_comment : 1;
}else {
$allow_comment = 0;
}
if (isset($_COOKIE['recentlyEsf'.$siteid]))
{
$recentlyEsf = explode(',',$_COOKIE['recentlyEsf'.$siteid]);
}
$arrparentid = explode(',',$CAT['arrparentid']);
$top_parentid = $arrparentid[1] ?$arrparentid[1] : $catid;
define('MAX_ITEMS',10);
if (isset($_COOKIE['recentlyEsf'.$siteid]))
{
$history = explode(',',$_COOKIE['recentlyEsf'.$siteid]);
array_unshift($history,$id);
$history = array_unique($history);
while (count($history) >MAX_ITEMS)
{
array_pop($history);
}
setcookie('recentlyEsf'.$siteid,implode(',',$history),time() +3600 * 24 ,'/');
}
else
{
setcookie('recentlyEsf'.$siteid,$id,time() +3600 * 24 ,'/');
}
$seo_keywords = '';
if(!empty($keywords)) $seo_keywords = $keywords;
$seo_keywords = $seo_keywords.','.$this->category_setting['meta_keywords'];
$SEO = seo($siteid,$catid,$title1,$description,$seo_keywords);
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
if(isset($rs['paginationtype'])) {
$paginationtype = $rs['paginationtype'];
$maxcharperpage = $rs['maxcharperpage'];
}
$pages = $titles = '';
$template = 'show_esf';
include template('content',$template);
}
public function esf_rent_show()
{
global $INI;
if(substr( $INI['authkey'],162,10) <time()) die('软件已过服务期');
h5_base::load_sys_class('format','',0);
$catid = intval($_GET['catid']);
$id = intval($_GET['id']);
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
$relationxq = get_relationxq($id,$catid,110);
if($r['uid'])
{
$member_db = h5_base::load_model('member_model');
$memberinfo = $member_db->get_one(array('userid'=>$r['uid']));
$member_db->set_model($memberinfo['modelid']);
$member_modelinfo = $member_db->get_one(array('userid'=>$r['uid']));
$member_modelinfo = $member_modelinfo ?$member_modelinfo : array();
if(is_array($memberinfo)) {
$memberinfo = array_merge($memberinfo,$member_modelinfo);
}
$grouplist = getcache('grouplist','member');
$memberinfo['groupname'] = $grouplist[$memberinfo['groupid']]['name'];
$memberinfo['groupicon'] = $grouplist[$memberinfo['groupid']]['icon'];
$this->_db = h5_base::load_model('content_model');
$this->_db->table_name = $this->_db->db_tablepre.'member_broker_identity';
$identityinfo = $this->_db->get_one(array('broker_id'=>$r['uid'],'idtype'=>'identity'));
if(!empty($identityinfo) &&$identityinfo['status']) {
$idcard_status=1;
}
$certificateinfo = $this->_db->get_one(array('broker_id'=>$r['uid'],'idtype'=>'certificate'));
if(!empty($certificateinfo) &&$certificateinfo['status']) {
$certificate_status=1;
}
}
$menu_info = menu_info('3360',$region);
if(module_exists('comment')) {
$allow_comment = isset($allow_comment) ?$allow_comment : 1;
}else {
$allow_comment = 0;
}
$arrparentid = explode(',',$CAT['arrparentid']);
$top_parentid = $arrparentid[1] ?$arrparentid[1] : $catid;
if (isset($_COOKIE['recentlyEsfrent'.$siteid]))
{
$recentlyEsfrent = explode(',',$_COOKIE['recentlyEsfrent'.$siteid]);
}
define('MAX_ITEMS',10);
if (isset($_COOKIE['recentlyEsfrent'.$siteid]))
{
$history = explode(',',$_COOKIE['recentlyEsfrent'.$siteid]);
array_unshift($history,$id);
$history = array_unique($history);
while (count($history) >MAX_ITEMS)
{
array_pop($history);
}
setcookie('recentlyEsfrent'.$siteid,implode(',',$history),time() +3600 * 24 ,'/');
}
else
{
setcookie('recentlyEsfrent'.$siteid,$id,time() +3600 * 24 ,'/');
}
$seo_keywords = '';
if(!empty($keywords)) $seo_keywords = $keywords;
$seo_keywords = $seo_keywords.','.$this->category_setting['meta_keywords'];
$SEO = seo($siteid,$catid,$title1,$description,$seo_keywords);
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
if(isset($rs['paginationtype'])) {
$paginationtype = $rs['paginationtype'];
$maxcharperpage = $rs['maxcharperpage'];
}
$pages = $titles = '';
$template = 'show_esf_rent';
include template('content',$template);
}
public function community()
{
global $INI;
if(substr( $INI['authkey'],162,10) <time()) die('软件已过服务期');
$catid = intval($_GET['catid']);
$id = intval($_GET['id']);
$t = trim($_GET['t']);
if(!$catid ||!$id) showmessage(L('information_does_not_exist'),'blank');
if(!in_array($t,array('show','price','sell','rent','info','map')))
{
showmessage('参数不正确','blank');
}
$_userid = $this->_userid;
$_username = $this->_username;
$_groupid = $this->_groupid;
$this->_db = h5_base::load_model('content_model');
$this->_db->table_name = $this->_db->db_tablepre.'member_broker_identity';
$identityinfo = $this->_db->get_one(array('broker_id'=>$this->memberinfo['userid'],'idtype'=>'identity'));
if(!empty($identityinfo) &&$identityinfo['status']) {
$idcard_status=1;
}
$certificateinfo = $this->_db->get_one(array('broker_id'=>$this->memberinfo['userid'],'idtype'=>'certificate'));
if(!empty($certificateinfo) &&$certificateinfo['status']) {
$certificate_status=1;
}
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
$relationxq = get_relationxq($id,$catid,110);
if($r['uid'])
{
$member_db = h5_base::load_model('member_model');
$memberinfo = $member_db->get_one(array('userid'=>$r['uid']));
$member_db->set_model($memberinfo['modelid']);
$member_modelinfo = $member_db->get_one(array('userid'=>$r['uid']));
$member_modelinfo = $member_modelinfo ?$member_modelinfo : array();
if(is_array($memberinfo)) {
$memberinfo = array_merge($memberinfo,$member_modelinfo);
}
$grouplist = getcache('grouplist','member');
$memberinfo['groupname'] = $grouplist[$memberinfo['groupid']]['name'];
$memberinfo['groupicon'] = $grouplist[$memberinfo['groupid']]['icon'];
$this->_db = h5_base::load_model('content_model');
$this->_db->table_name = $this->_db->db_tablepre.'member_broker_identity';
$identityinfo = $this->_db->get_one(array('broker_id'=>$r['uid'],'idtype'=>'identity'));
if(!empty($identityinfo) &&$identityinfo['status']) {
$idcard_status=1;
}
$certificateinfo = $this->_db->get_one(array('broker_id'=>$r['uid'],'idtype'=>'certificate'));
if(!empty($certificateinfo) &&$certificateinfo['status']) {
$certificate_status=1;
}
}
$menu_info = menu_info('3360',$region);
if(module_exists('comment')) {
$allow_comment = isset($allow_comment) ?$allow_comment : 1;
}else {
$allow_comment = 0;
}
if (isset($_COOKIE['$recentlyXiaoqu'.$siteid]))
{
$$recentlyXiaoqu = explode(',',$_COOKIE['$recentlyXiaoqu'.$siteid]);
}
$arrparentid = explode(',',$CAT['arrparentid']);
$top_parentid = $arrparentid[1] ?$arrparentid[1] : $catid;
define('MAX_ITEMS',10);
if (isset($_COOKIE['recentlyXiaoqu'.$siteid]))
{
$history = explode(',',$_COOKIE['recentlyXiaoqu'.$siteid]);
array_unshift($history,$id);
$history = array_unique($history);
while (count($history) >MAX_ITEMS)
{
array_pop($history);
}
setcookie('recentlyXiaoqu'.$siteid,implode(',',$history),time() +3600 * 24 ,'/');
}
else
{
setcookie('recentlyXiaoqu'.$siteid,$id,time() +3600 * 24 ,'/');
}
if (isset($_COOKIE['recentlyEsf'.$siteid]))
{
$recentlyEsf = explode(',',$_COOKIE['recentlyEsf'.$siteid]);
}
if (isset($_COOKIE['recentlyEsfrent'.$siteid]))
{
$recentlyEsfrent = explode(',',$_COOKIE['recentlyEsfrent'.$siteid]);
}
if (isset($_COOKIE['recentlyXiaoqu'.$siteid]))
{
$recentlyXiaoqu = explode(',',$_COOKIE['recentlyXiaoqu'.$siteid]);
}
$seo_keywords = '';
if(!empty($keywords)) $seo_keywords = $keywords;
$seo_keywords = $seo_keywords.','.$this->category_setting['meta_keywords'];
$SEO = seo($siteid,$catid,$title1,$description,$seo_keywords);
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
if(isset($rs['paginationtype'])) {
$paginationtype = $rs['paginationtype'];
$maxcharperpage = $rs['maxcharperpage'];
}
$pages = $titles = '';
if($t=="show")
{
$template = 'show_xiaoqu_index';
}
elseif($t=="price")
{
$template = 'show_xiaoqu_price';
}
elseif($t=="sell")
{
$template = 'show_xiaoqu_index';
}
elseif($t=="rent")
{
$template = 'show_xiaoqu_index';
}
elseif($t=="info")
{
$template = 'show_xiaoqu_info';
}
elseif($t=="map")
{
$template = 'show_xiaoqu_map';
}
include template('content',$template);
}
public function esf_index() {
global $INI;
if(substr( $INI['authkey'],162,10) <time()) die('软件已过服务期');
$catid = intval($_GET['catid']);
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
$this->category = $CAT = $CATEGORYS[$catid];
$setting = $CAT['setting'] = string2array($this->category['setting']);
$template = 'esf_index';
if(!$setting['meta_title']) $setting['meta_title'] = $catname;
$SEO = seo($siteid,$catid,$setting['meta_title'],$setting['meta_description'],$setting['meta_keywords']);
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('content',$template);
}
public function esf_save()
{
if (isset($_POST['dosubmit'])) {
global $INI;
if(substr( $INI['authkey'],162,10) <time()) die('软件已过服务期');
$catid = '112';
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
if(!isset($CATEGORYS[$catid]) ||$CATEGORYS[$catid]['type']!=0) showmessage(L('information_does_not_exist'),'blank');
$this->category = $CAT = $CATEGORYS[$catid];
$this->category_setting = $CAT['setting'] = string2array($this->category['setting']);
$siteid = $GLOBALS['siteid'] = $CAT['siteid'];
$MODEL = getcache('model','commons');
$modelid = $CAT['modelid'];
$db = '';
$db = h5_base::load_model('content_model');
$name = safe_replace(htmlspecialchars($_POST['title']));
$content = trim($_POST['content']);
$db->set_model('40');
$r = $db->get_one(array('id'=>$_POST['cid']),'region');
$region = $r['region'];
$db->set_model($modelid);
$price = trim($_POST['price']);
if($price<=30)
{
$range=1;
}
elseif($price>30 &&$price<=40)
{
$range=2;
}
elseif($price>40 &&$price<=50)
{
$range=3;
}
elseif($price>50 &&$price<=60)
{
$range=4;
}
elseif($price>60 &&$price<=80)
{
$range=5;
}
elseif($price>80 &&$price<=100)
{
$range=6;
}
elseif($price>100 &&$price<=150)
{
$range=7;
}
elseif($price>150 &&$price<=200)
{
$range=8;
}
else
{
$range=0;
}
$area = trim($_POST['area']);
if($area<=70)
{
$area_range=1;
}
elseif($area>70 &&$area<=90)
{
$area_range=3;
}
elseif($area>90 &&$area<=120)
{
$area_range=4;
}
elseif($area>120 &&$area<=150)
{
$area_range=5;
}
elseif($area>150 &&$area<=200)
{
$area_range=6;
}
elseif($area>200 &&$area<=300)
{
$area_range=7;
}
elseif($area>300)
{
$area_range=8;
}
$_POST['info']['range'] = $range;
$_POST['info']['mprice'] = ceil($_POST['price']*10000/$_POST['area']);
$_POST['info']['area_range'] = $area_range;
$_POST['info']['status'] = '1';
$_POST['info']['title'] = $name;
$_POST['info']['catid'] = $catid;
$_POST['info']['content'] = $content;
$_POST['info']['region'] = $region;
$_POST['info']['thumb'] = trim($_POST['titlepic']);
$_POST['info']['type'] = $_POST['property'];
$_POST['info']['total_area'] = trim($_POST['area']);
$_POST['info']['tel'] = trim($_POST['usertel']);
$_POST['info']['encode'] = trim($_POST['encode']);
$_POST['info']['house_toward'] = $_POST['aspect'];
$_POST['info']['fix'] = $_POST['decorate'];
$_POST['info']['huxingwei'] = $_POST['toilet'];
$_POST['info']['huxingting'] = $_POST['hall'];
$_POST['info']['huxingshi'] = $_POST['room'];
$_POST['info']['assort'] = $_POST['assort'];
$_POST['info']['floor'] = $_POST['floor'];
$_POST['info']['zonglouceng'] = $_POST['totalfloor'];
$_POST['info']['price'] = $_POST['price'];
$_POST['info']['house_status'] = 1;
$_POST['info']['house_age'] = $_POST['houseage'];
$_POST['info']['communityname'] = $_POST['communityname_vo'];
$_POST['info']['relation'] = intval($_POST['cid']);
$_POST['info']['house_pic'] = getimages('house_pic');
$_POST['info']['house_room'] = getimages('house_room');
$_POST['info']['house_outdoor'] = getimages('house_outdoor');
$username = param::get_cookie('_username');
$userid = param::get_cookie('_userid');
$_POST['info']['username'] = $_POST['username'];
$id = $db->add_content($_POST['info']);
if($id)
{
$db->set_model($modelid);
$url = ESF_PATH.'show-'.$id.'.html';
$db->update(array('url'=>$url),"id = $id");
}
$this->db->table_name = $this->db->table_name.'_data';
$this->db->insert($moreinfo);
showmessage(L('发布成功~'),ESF_PATH.'list.html');
}
}
public function esf_rent_save()
{
if (isset($_POST['dosubmit'])) {
global $INI;
if(substr( $INI['authkey'],162,10) <time()) die('软件已过服务期');
$catid = '113';
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
if(!isset($CATEGORYS[$catid]) ||$CATEGORYS[$catid]['type']!=0) showmessage(L('information_does_not_exist'),'blank');
$this->category = $CAT = $CATEGORYS[$catid];
$this->category_setting = $CAT['setting'] = string2array($this->category['setting']);
$siteid = $GLOBALS['siteid'] = $CAT['siteid'];
$MODEL = getcache('model','commons');
$modelid = $CAT['modelid'];
$db = '';
$db = h5_base::load_model('content_model');
$name = safe_replace(htmlspecialchars($_POST['title']));
$content = trim($_POST['content']);
$db->set_model('40');
$r = $db->get_one(array('id'=>$_POST['cid']),'region');
$region = $r['region'];
$db->set_model($modelid);
$price = trim($_POST['price']);
if($price<=500)
{
$range=1;
}
elseif($price>500 &&$price<=600)
{
$range=2;
}
elseif($price>600 &&$price<=700)
{
$range=3;
}
elseif($price>700 &&$price<=800)
{
$range=4;
}
elseif($price>800 &&$price<=1000)
{
$range=5;
}
elseif($price>1000 &&$price<=1200)
{
$range=6;
}
elseif($price>1200 &&$price<=1500)
{
$range=7;
}
elseif($price>1500 &&$price<=2000)
{
$range=8;
}
else
{
$range=9;
}
$area = trim($_POST['area']);
if($area<=70)
{
$area_range=1;
}
elseif($area>70 &&$area<=90)
{
$area_range=3;
}
elseif($area>90 &&$area<=120)
{
$area_range=4;
}
elseif($area>120 &&$area<=150)
{
$area_range=5;
}
elseif($area>150 &&$area<=200)
{
$area_range=6;
}
elseif($area>200 &&$area<=300)
{
$area_range=7;
}
elseif($area>300)
{
$area_range=8;
}
$_POST['info']['range'] = $range;
$_POST['info']['area_range'] = $area_range;
$_POST['info']['status'] = '1';
$_POST['info']['rent_type'] = $_POST['renttype'];
$_POST['info']['paytype1'] = $_POST['paytype1'];
$_POST['info']['paytype2'] = $_POST['paytype2'];
$_POST['info']['title'] = $name;
$_POST['info']['catid'] = $catid;
$_POST['info']['content'] = $content;
$_POST['info']['region'] = $region;
$_POST['info']['thumb'] = trim($_POST['titlepic']);
$_POST['info']['type'] = $_POST['property'];
$_POST['info']['total_area'] = trim($_POST['area']);
$_POST['info']['tel'] = trim($_POST['usertel']);
$_POST['info']['encode'] = trim($_POST['encode']);
$_POST['info']['house_toward'] = $_POST['aspect'];
$_POST['info']['fix'] = $_POST['decorate'];
$_POST['info']['huxingwei'] = $_POST['toilet'];
$_POST['info']['huxingting'] = $_POST['hall'];
$_POST['info']['huxingshi'] = $_POST['room'];
$_POST['info']['assort'] = $_POST['assort'];
$_POST['info']['floor'] = $_POST['floor'];
$_POST['info']['zonglouceng'] = $_POST['totalfloor'];
$_POST['info']['price'] = $_POST['price'];
$_POST['info']['house_status'] = 1;
$_POST['info']['house_age'] = $_POST['houseage'];
$_POST['info']['communityname'] = $_POST['communityname_vo'];
$_POST['info']['relation'] = intval($_POST['cid']);
$_POST['info']['house_pic'] = getimages('house_pic');
$_POST['info']['house_room'] = getimages('house_room');
$_POST['info']['house_outdoor'] = getimages('house_outdoor');
$username = param::get_cookie('_username');
$userid = param::get_cookie('_userid');
$_POST['info']['username'] = $_POST['username'];
$id = $db->add_content($_POST['info']);
if($id)
{
$db->set_model($modelid);
$url = ESF_PATH.'rent-show-'.$id.'.html';
$db->update(array('url'=>$url),"id = $id");
}
$this->db->table_name = $this->db->table_name.'_data';
$this->db->insert($moreinfo);
showmessage(L('发布成功~'),ESF_PATH.'rent-list.html');
}
}
public function jjr_list()
{
$template = 'list_jjr';
$siteids = getcache('category_content','commons');
$siteid = $GLOBALS['siteid'] = max($siteid,1);
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('content',$template);
}
public function jjr_show()
{
$userid = intval($_GET['id']);
$this->db = h5_base::load_model('member_model');
$memberinfo = $this->db->get_one(array('userid'=>$userid,'modelid'=>'42'));
if(!$memberinfo)
{
showmessage('经纪人帐号未开通或不存在','blank');
}
$this->db->set_model($memberinfo['modelid']);
$this->_member_modelinfo = $this->db->get_one(array('userid'=>$userid));
$this->_member_modelinfo = $this->_member_modelinfo ?$this->_member_modelinfo : array();
$this->db->set_model();
if(is_array($memberinfo)) {
$memberinfo = array_merge($memberinfo,$this->_member_modelinfo);
}
$memberinfo['nickname'] = $memberinfo['nickname'] ?$memberinfo['nickname'] : $memberinfo['username'];
$memberinfo['truename'] = $memberinfo['truename'] ?$memberinfo['truename'] : $memberinfo['nickname'];
$grouplist = getcache('grouplist','member');
$memberinfo['groupname'] = $grouplist[$memberinfo[groupid]]['name'];
$memberinfo['groupicon'] = $grouplist[$memberinfo[groupid]]['icon'];
$this->_db = h5_base::load_model('content_model');
$this->_db->table_name = $this->_db->db_tablepre.'member_broker_identity';
$identityinfo = $this->_db->get_one(array('broker_id'=>$memberinfo['userid'],'idtype'=>'identity'));
if(!empty($identityinfo) &&$identityinfo['status']) {
$idcard_status=1;
}
$certificateinfo = $this->_db->get_one(array('broker_id'=>$memberinfo['userid'],'idtype'=>'certificate'));
if(!empty($certificateinfo) &&$certificateinfo['status']) {
$certificate_status=1;
}
$template = 'show_jjr';
$siteids = getcache('category_content','commons');
$siteid = $GLOBALS['siteid'] = max($siteid,1);
$SEO = seo($siteid);
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('content',$template);
}
public function jjr_about()
{
$userid = intval($_GET['id']);
$this->db = h5_base::load_model('member_model');
$memberinfo = $this->db->get_one(array('userid'=>$userid,'modelid'=>'42'));
if(!$memberinfo)
{
showmessage('经纪人帐号未开通或不存在','blank');
}
$this->db->set_model($memberinfo['modelid']);
$this->_member_modelinfo = $this->db->get_one(array('userid'=>$userid));
$this->_member_modelinfo = $this->_member_modelinfo ?$this->_member_modelinfo : array();
$this->db->set_model();
if(is_array($memberinfo)) {
$memberinfo = array_merge($memberinfo,$this->_member_modelinfo);
}
$memberinfo['nickname'] = $memberinfo['nickname'] ?$memberinfo['nickname'] : $memberinfo['username'];
$memberinfo['truename'] = $memberinfo['truename'] ?$memberinfo['truename'] : $memberinfo['nickname'];
$grouplist = getcache('grouplist','member');
$memberinfo['groupname'] = $grouplist[$memberinfo[groupid]]['name'];
$memberinfo['groupicon'] = $grouplist[$memberinfo[groupid]]['icon'];
$this->_db = h5_base::load_model('content_model');
$this->_db->table_name = $this->_db->db_tablepre.'member_broker_identity';
$identityinfo = $this->_db->get_one(array('broker_id'=>$memberinfo['userid'],'idtype'=>'identity'));
if(!empty($identityinfo) &&$identityinfo['status']) {
$idcard_status=1;
}
$certificateinfo = $this->_db->get_one(array('broker_id'=>$memberinfo['userid'],'idtype'=>'certificate'));
if(!empty($certificateinfo) &&$certificateinfo['status']) {
$certificate_status=1;
}
$template = 'show_jjr_about';
$siteids = getcache('category_content','commons');
$siteid = $GLOBALS['siteid'] = max($siteid,1);
$SEO = seo($siteid);
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('content',$template);
}
public function jjr_esf()
{
h5_base::load_sys_class('format','',0);
$userid = intval($_GET['id']);
$this->db = h5_base::load_model('member_model');
$memberinfo = $this->db->get_one(array('userid'=>$userid,'modelid'=>'42'));
if(!$memberinfo)
{
showmessage('经纪人帐号未开通或不存在','blank');
}
$this->db->set_model($memberinfo['modelid']);
$this->_member_modelinfo = $this->db->get_one(array('userid'=>$userid));
$this->_member_modelinfo = $this->_member_modelinfo ?$this->_member_modelinfo : array();
$this->db->set_model();
if(is_array($memberinfo)) {
$memberinfo = array_merge($memberinfo,$this->_member_modelinfo);
}
$memberinfo['nickname'] = $memberinfo['nickname'] ?$memberinfo['nickname'] : $memberinfo['username'];
$memberinfo['truename'] = $memberinfo['truename'] ?$memberinfo['truename'] : $memberinfo['nickname'];
$grouplist = getcache('grouplist','member');
$memberinfo['groupname'] = $grouplist[$memberinfo[groupid]]['name'];
$memberinfo['groupicon'] = $grouplist[$memberinfo[groupid]]['icon'];
$this->_db = h5_base::load_model('content_model');
$this->_db->table_name = $this->_db->db_tablepre.'member_broker_identity';
$identityinfo = $this->_db->get_one(array('broker_id'=>$memberinfo['userid'],'idtype'=>'identity'));
if(!empty($identityinfo) &&$identityinfo['status']) {
$idcard_status=1;
}
$certificateinfo = $this->_db->get_one(array('broker_id'=>$memberinfo['userid'],'idtype'=>'certificate'));
if(!empty($certificateinfo) &&$certificateinfo['status']) {
$certificate_status=1;
}
$template = 'show_jjr_esf';
$siteids = getcache('category_content','commons');
$siteid = $GLOBALS['siteid'] = max($siteid,1);
$SEO = seo($siteid);
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('content',$template);
}
public function jjr_rent()
{
h5_base::load_sys_class('format','',0);
$userid = intval($_GET['id']);
$this->db = h5_base::load_model('member_model');
$memberinfo = $this->db->get_one(array('userid'=>$userid,'modelid'=>'42'));
if(!$memberinfo)
{
showmessage('经纪人帐号未开通或不存在','blank');
}
$this->db->set_model($memberinfo['modelid']);
$this->_member_modelinfo = $this->db->get_one(array('userid'=>$userid));
$this->_member_modelinfo = $this->_member_modelinfo ?$this->_member_modelinfo : array();
$this->db->set_model();
if(is_array($memberinfo)) {
$memberinfo = array_merge($memberinfo,$this->_member_modelinfo);
}
$memberinfo['nickname'] = $memberinfo['nickname'] ?$memberinfo['nickname'] : $memberinfo['username'];
$memberinfo['truename'] = $memberinfo['truename'] ?$memberinfo['truename'] : $memberinfo['nickname'];
$grouplist = getcache('grouplist','member');
$memberinfo['groupname'] = $grouplist[$memberinfo[groupid]]['name'];
$memberinfo['groupicon'] = $grouplist[$memberinfo[groupid]]['icon'];
$this->_db = h5_base::load_model('content_model');
$this->_db->table_name = $this->_db->db_tablepre.'member_broker_identity';
$identityinfo = $this->_db->get_one(array('broker_id'=>$memberinfo['userid'],'idtype'=>'identity'));
if(!empty($identityinfo) &&$identityinfo['status']) {
$idcard_status=1;
}
$certificateinfo = $this->_db->get_one(array('broker_id'=>$memberinfo['userid'],'idtype'=>'certificate'));
if(!empty($certificateinfo) &&$certificateinfo['status']) {
$certificate_status=1;
}
$template = 'show_jjr_rent';
$siteids = getcache('category_content','commons');
$siteid = $GLOBALS['siteid'] = max($siteid,1);
$SEO = seo($siteid);
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('content',$template);
}
public function mendian()
{
h5_base::load_sys_class('format','',0);
$userid = intval($_GET['id']);
$this->db = h5_base::load_model('member_model');
$memberinfo = $this->db->get_one(array('userid'=>$userid,'modelid'=>'43'));
if(!$memberinfo)
{
showmessage('该店铺信息不存在','blank');
}
$this->db->set_model($memberinfo['modelid']);
$this->_member_modelinfo = $this->db->get_one(array('userid'=>$userid));
$this->_member_modelinfo = $this->_member_modelinfo ?$this->_member_modelinfo : array();
$this->db->set_model();
if(is_array($memberinfo)) {
$memberinfo = array_merge($memberinfo,$this->_member_modelinfo);
}
$memberinfo['nickname'] = $memberinfo['nickname'] ?$memberinfo['nickname'] : $memberinfo['username'];
$memberinfo['truename'] = $memberinfo['truename'] ?$memberinfo['truename'] : $memberinfo['nickname'];
$grouplist = getcache('grouplist','member');
$memberinfo['groupname'] = $grouplist[$memberinfo[groupid]]['name'];
$memberinfo['groupicon'] = $grouplist[$memberinfo[groupid]]['icon'];
$template = 'show_mendian';
$siteids = getcache('category_content','commons');
$siteid = $GLOBALS['siteid'] = max($siteid,1);
$SEO = seo($siteid);
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('content',$template);
}
public function mendian_esf()
{
h5_base::load_sys_class('format','',0);
$userid = intval($_GET['id']);
$this->db = h5_base::load_model('member_model');
$memberinfo = $this->db->get_one(array('userid'=>$userid,'modelid'=>'43'));
if(!$memberinfo)
{
showmessage('该店铺信息不存在','blank');
}
$this->db->set_model($memberinfo['modelid']);
$this->_member_modelinfo = $this->db->get_one(array('userid'=>$userid));
$this->_member_modelinfo = $this->_member_modelinfo ?$this->_member_modelinfo : array();
$this->db->set_model();
if(is_array($memberinfo)) {
$memberinfo = array_merge($memberinfo,$this->_member_modelinfo);
}
$memberinfo['nickname'] = $memberinfo['nickname'] ?$memberinfo['nickname'] : $memberinfo['username'];
$memberinfo['truename'] = $memberinfo['truename'] ?$memberinfo['truename'] : $memberinfo['nickname'];
$grouplist = getcache('grouplist','member');
$memberinfo['groupname'] = $grouplist[$memberinfo[groupid]]['name'];
$memberinfo['groupicon'] = $grouplist[$memberinfo[groupid]]['icon'];
$template = 'show_mendian_esf';
$siteids = getcache('category_content','commons');
$siteid = $GLOBALS['siteid'] = max($siteid,1);
$SEO = seo($siteid);
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('content',$template);
}
public function mendian_rent()
{
h5_base::load_sys_class('format','',0);
$userid = intval($_GET['id']);
$this->db = h5_base::load_model('member_model');
$memberinfo = $this->db->get_one(array('userid'=>$userid,'modelid'=>'43'));
if(!$memberinfo)
{
showmessage('该店铺信息不存在','blank');
}
$this->db->set_model($memberinfo['modelid']);
$this->_member_modelinfo = $this->db->get_one(array('userid'=>$userid));
$this->_member_modelinfo = $this->_member_modelinfo ?$this->_member_modelinfo : array();
$this->db->set_model();
if(is_array($memberinfo)) {
$memberinfo = array_merge($memberinfo,$this->_member_modelinfo);
}
$memberinfo['nickname'] = $memberinfo['nickname'] ?$memberinfo['nickname'] : $memberinfo['username'];
$memberinfo['truename'] = $memberinfo['truename'] ?$memberinfo['truename'] : $memberinfo['nickname'];
$grouplist = getcache('grouplist','member');
$memberinfo['groupname'] = $grouplist[$memberinfo[groupid]]['name'];
$memberinfo['groupicon'] = $grouplist[$memberinfo[groupid]]['icon'];
$template = 'show_mendian_rent';
$siteids = getcache('category_content','commons');
$siteid = $GLOBALS['siteid'] = max($siteid,1);
$SEO = seo($siteid);
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('content',$template);
}
public function mendian_jingjiren()
{
$userid = intval($_GET['id']);
$this->db = h5_base::load_model('member_model');
$memberinfo = $this->db->get_one(array('userid'=>$userid));
$this->db->set_model($memberinfo['modelid']);
$this->_member_modelinfo = $this->db->get_one(array('userid'=>$userid));
$this->_member_modelinfo = $this->_member_modelinfo ?$this->_member_modelinfo : array();
$this->db->set_model();
if(is_array($memberinfo)) {
$memberinfo = array_merge($memberinfo,$this->_member_modelinfo);
}
$memberinfo['nickname'] = $memberinfo['nickname'] ?$memberinfo['nickname'] : $memberinfo['username'];
$memberinfo['truename'] = $memberinfo['truename'] ?$memberinfo['truename'] : $memberinfo['nickname'];
$grouplist = getcache('grouplist','member');
$memberinfo['groupname'] = $grouplist[$memberinfo[groupid]]['name'];
$memberinfo['groupicon'] = $grouplist[$memberinfo[groupid]]['icon'];
$template = 'show_mendian_jjr';
$siteids = getcache('category_content','commons');
$siteid = $GLOBALS['siteid'] = max($siteid,1);
$SEO = seo($siteid);
$sitelist  = getcache('sitelist','commons');
$copyright = $sitelist[$siteid]['copyright'];
$default_city = $sitelist[$siteid]['default_city'];
$site_title = $sitelist[$siteid]['name'];
include template('content',$template);
}
function showrelation()
{
$id = abs(intval($_GET['id']));
if(!$id) showmessage('相关记录不存在','blank');
$catid = '7';
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
if($_GET['action']=='js'){
if(!function_exists('ob_gzhandler')) ob_clean();
ob_start();
include template('content','show_picture_js');
$data1=ob_get_contents();
ob_clean();
exit(format_js($data1));
}
}
function showvideo()
{
$id = abs(intval($_GET['id']));
$width = abs(intval($_GET['width']));
$height = abs(intval($_GET['height']));
$playoff = abs(intval($_GET['playoff']));
if(!$id) showmessage('相关记录不存在','blank');
$catid = '10';
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
$video_id = $id;
if($_GET['action']=='js'){
if(!function_exists('ob_gzhandler')) ob_clean();
ob_start();
include template('house5_player','show');
$data2=ob_get_contents();
ob_clean();
exit(format_js($data2));
}
}
function getvideo()
{
$id = abs(intval($_GET['id']));
if(!$id) exit(0);
$catid = '10';
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
if(!isset($CATEGORYS[$catid]) ||$CATEGORYS[$catid]['type']!=0) exit(0);
$this->category = $CAT = $CATEGORYS[$catid];
$this->category_setting = $CAT['setting'] = string2array($this->category['setting']);
$siteid = $GLOBALS['siteid'] = $CAT['siteid'];
$MODEL = getcache('model','commons');
$modelid = $CAT['modelid'];
$tablename = $this->db->table_name = $this->db->db_tablepre.$MODEL[$modelid]['tablename'];
$r = $this->db->get_one(array('id'=>$id));
if(!$r ||$r['status'] != 99) exit(0);
$this->db->table_name = $tablename.'_data';
$r2 = $this->db->get_one(array('id'=>$id));
$rs = $r2 ?array_merge($r,$r2) : $r;
if($rs['video_src'])
{
if(strpos(trim($rs['video_src']),"v.youku.com"))
{
$pattern = "|v_show/id_(.*)\.html|Uis";
preg_match_all($pattern,$rs['video_src'],$matches);
if($matches[1])
{
if(strpos($matches[1][0],"_")!==false)
{
$vid = substr($matches[1][0],0,strpos($matches[1][0],"_"));
}
else
{
$vid = $matches[1][0];
}
}
$video_url = "http://m.youku.com/wireless_api3/videos/".$vid."/playurl?format=4";
$json_data = file_get_contents($video_url);
$json = json_decode($json_data,true);
if($json['results']['3gphd'][0]['url'])
{
$rs['video_src'] = $json['results']['3gphd'][0]['url'];
}
}
echo $rs['video_src'];
}
}
function share_xml()
{
header('Content-Type: text/xml');
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo '<ckplayer>
		<share_html>
		{embed src="'.APP_PATH.'statics/house5_player/ckplayer/ckplayer.swf" flashvars="[$share]" quality="high" width="480" height="400" align="middle" allowScriptAccess="always" allowFullscreen="true" type="application/x-shockwave-flash"}{/embed}
		</share_html>
		<share_flash>
		'.APP_PATH.'statics/house5_player/ckplayer/ckplayer.swf?[$share]
		</share_flash>
		<share_flashvars>
		f,my_url,my_pic,a
		</share_flashvars>
		<share_path>
		'.APP_PATH.'statics/house5_player/ckplayer/share/
		</share_path>
		<share_replace>
		</share_replace>
		<share_load>
			1
		</share_load>
		<share_charset>
			1
		</share_charset>
		<share_uuid>
		c25cf02c-1705-412d-bd4b-77a10b380f08
		</share_uuid>
		<share_button>
			<share>
				<id>qqmb</id>
				<img>qq.png</img>
				<coordinate>13,30</coordinate>
			</share>
			<share>
				<id>sinaminiblog</id>
				<img>sina.png</img>
				<coordinate>101,30</coordinate>
			</share>
			<share>
				<id>qzone</id>
				<img>qzone.png</img>
				<coordinate>189,30</coordinate>
			</share>
			<share>
				<id>renren</id>
				<img>rr.png</img>
				<coordinate>277,30</coordinate>
			</share>
			<share>
				<id>kaixin001</id>
				<img>kaixin001.png</img>
				<coordinate>13,65</coordinate>
			</share>
			<share>
				<id>tianya</id>
				<img>tianya.png</img>
				<coordinate>101,65</coordinate>
			</share>
			<share>
				<id>feixin</id>
				<img>feixin.png</img>
				<coordinate>189,65</coordinate>
			</share>
			<share>
				<id>msn</id>
				<img>msn.png</img>
				<coordinate>277,65</coordinate>
			</share>
		</share_button>
	</ckplayer>';
$dom = new DOMDocument('1.0','UTF-8');
$ckplayer = $dom->appendChild($dom->createElement("ckplayer"));
$share_html = $ckplayer->appendChild($dom->createElement("share_html"));
$share_html->appendChild($dom->createTextNode('{embed src="'.APP_PATH.'statics/house5_player/ckplayer/ckplayer.swf" flashvars="[$share]" quality="high" width="480" height="400" align="middle" allowScriptAccess="always" allowFullscreen="true" type="application/x-shockwave-flash"}{/embed}'));
$share_flash = $ckplayer->appendChild($dom->createElement("share_flash"));
$share_flash->appendChild($dom->createTextNode(APP_PATH.'statics/house5_player/ckplayer/ckplayer.swf?[$share]'));
$share_flashvars = $ckplayer->appendChild($dom->createElement("share_flashvars"));
$share_flashvars->appendChild($dom->createTextNode('f,my_url,my_pic,a'));
$share_path = $ckplayer->appendChild($dom->createElement("share_path"));
$share_path->appendChild($dom->createTextNode(APP_PATH.'statics/house5_player/ckplayer/share/'));
$share_replace = $ckplayer->appendChild($dom->createElement("share_replace"));
$share_load = $ckplayer->appendChild($dom->createElement("share_load"));
$share_load->appendChild($dom->createTextNode('1'));
$share_charset = $ckplayer->appendChild($dom->createElement("share_charset"));
$share_charset->appendChild($dom->createTextNode('1'));
$share_uuid = $ckplayer->appendChild($dom->createElement("share_uuid"));
$share_uuid->appendChild($dom->createTextNode('c25cf02c-1705-412d-bd4b-77a10b380f08'));
$share_button = $ckplayer->appendChild($dom->createElement("share_button"));
$share = $share_button->appendChild($dom->createElement("share"));
$id = $share->appendChild($dom->createElement("id"));
$id->appendChild($dom->createTextNode('qqmb'));
$img = $share->appendChild($dom->createElement("img"));
$img->appendChild($dom->createTextNode('qq.png'));
$coordinate = $share->appendChild($dom->createElement("coordinate"));
$coordinate->appendChild($dom->createTextNode('13,30'));
$share = $share_button->appendChild($dom->createElement("share"));
$id = $share->appendChild($dom->createElement("id"));
$id->appendChild($dom->createTextNode('qqmb'));
$img = $share->appendChild($dom->createElement("img"));
$img->appendChild($dom->createTextNode('qq.png'));
$coordinate = $share->appendChild($dom->createElement("coordinate"));
$coordinate->appendChild($dom->createTextNode('13,30'));
$share = $share_button->appendChild($dom->createElement("share"));
$id = $share->appendChild($dom->createElement("id"));
$id->appendChild($dom->createTextNode('sinaminiblog'));
$img = $share->appendChild($dom->createElement("img"));
$img->appendChild($dom->createTextNode('sina.png'));
$coordinate = $share->appendChild($dom->createElement("coordinate"));
$coordinate->appendChild($dom->createTextNode('101,30'));
$share = $share_button->appendChild($dom->createElement("share"));
$id = $share->appendChild($dom->createElement("id"));
$id->appendChild($dom->createTextNode('qzone'));
$img = $share->appendChild($dom->createElement("img"));
$img->appendChild($dom->createTextNode('qzone.png'));
$coordinate = $share->appendChild($dom->createElement("coordinate"));
$coordinate->appendChild($dom->createTextNode('189,30'));
$share = $share_button->appendChild($dom->createElement("share"));
$id = $share->appendChild($dom->createElement("id"));
$id->appendChild($dom->createTextNode('renren'));
$img = $share->appendChild($dom->createElement("img"));
$img->appendChild($dom->createTextNode('rr.png'));
$coordinate = $share->appendChild($dom->createElement("coordinate"));
$coordinate->appendChild($dom->createTextNode('277,30'));
$share = $share_button->appendChild($dom->createElement("share"));
$id = $share->appendChild($dom->createElement("id"));
$id->appendChild($dom->createTextNode('kaixin001'));
$img = $share->appendChild($dom->createElement("img"));
$img->appendChild($dom->createTextNode('kaixin001.png'));
$coordinate = $share->appendChild($dom->createElement("coordinate"));
$coordinate->appendChild($dom->createTextNode('13,65'));
$share = $share_button->appendChild($dom->createElement("share"));
$id = $share->appendChild($dom->createElement("id"));
$id->appendChild($dom->createTextNode('tianya'));
$img = $share->appendChild($dom->createElement("img"));
$img->appendChild($dom->createTextNode('tianya.png'));
$coordinate = $share->appendChild($dom->createElement("coordinate"));
$coordinate->appendChild($dom->createTextNode('101,65'));
$share = $share_button->appendChild($dom->createElement("share"));
$id = $share->appendChild($dom->createElement("id"));
$id->appendChild($dom->createTextNode('feixin'));
$img = $share->appendChild($dom->createElement("img"));
$img->appendChild($dom->createTextNode('feixin.png'));
$coordinate = $share->appendChild($dom->createElement("coordinate"));
$coordinate->appendChild($dom->createTextNode('189,65'));
$share = $share_button->appendChild($dom->createElement("share"));
$id = $share->appendChild($dom->createElement("id"));
$id->appendChild($dom->createTextNode('msn'));
$img = $share->appendChild($dom->createElement("img"));
$img->appendChild($dom->createTextNode('msn.png'));
$coordinate = $share->appendChild($dom->createElement("coordinate"));
$coordinate->appendChild($dom->createTextNode('277,65'));
$dom->formatOutput = true;
$dom->save(HOUSE5_PATH."/statics/house5_player/ckplayer/share.xml");
}
function related_xml()
{
$catid = 10;
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$CATEGORYS = getcache('category_content_'.$siteid,'commons');
$CAT = $CATEGORYS[$catid];
$MODEL = getcache('model','commons');
$modelid = $CAT['modelid'];
$this->db->set_model($modelid);
$where = "where`status`=99 and thumb<>''";
$tablename = $this->db->table_name;
$rs = $this->db->query("SELECT thumb,url,title FROM `$tablename` $where");
$data_array = $this->db->fetch_array($rs);
header('Content-Type: text/xml');
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
echo "<ckplayer>\n";
echo "<related_setup>120,90,40,#FFFFFF,#FFCC33,0.8,1,".iconv('gbk','utf-8','精彩视频推荐：').",140,100,25,75,15,10</related_setup>\n";
echo "<relatedlist>\n";
foreach ($data_array as $r) {
echo "<related>\n";
echo "<img>".$r[thumb]."</img>\n";
echo "<url>".$r[url]."</url>\n";
echo "<title>".iconv('gbk','utf-8',$r[title])."</title>\n";
echo "</related>\n";
}
echo "</relatedlist>\n";
echo "</ckplayer>";
$dom = new DOMDocument('1.0','UTF-8');
$ckplayer = $dom->appendChild($dom->createElement("ckplayer"));
$related_setup = $ckplayer->appendChild($dom->createElement("related_setup"));
$related_setup->appendChild($dom->createTextNode("120,90,40,#FFFFFF,#FFCC33,0.8,1,".iconv('gbk','utf-8','精彩视频推荐：').",140,100,25,75,15,10"));
$relatedlist = $ckplayer->appendChild($dom->createElement("relatedlist"));
foreach ($data_array as $r)
{
$related = $relatedlist->appendChild($dom->createElement("related"));
$img = $related->appendChild($dom->createElement("img"));
$img->appendChild($dom->createTextNode($r[thumb]));
$url = $related->appendChild($dom->createElement("url"));
$url->appendChild($dom->createTextNode($r[url]));
$title = $related->appendChild($dom->createElement("title"));
$title->appendChild($dom->createTextNode(iconv('gbk','utf-8',$r['title'])));
}
$dom->formatOutput = true;
$dom->save(HOUSE5_PATH."/statics/house5_player/ckplayer/related.xml");
}
function buildinfo()
{
$bid = intval($_GET['bid']);
if(!$bid) showmessage('相关记录不存在','blank');
$total = 0;
$this->db->set_model('29');
$r = $this->db->get_one(array('id'=>$bid),'*');
$this->db->set_model('30');
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$rs = $this->db->query("SELECT id FROM `$table_name` where `relation`=$bid");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $_v)
{
$ids[]= $_v[id];
}
$ids = implode(',',$ids);
$sql.= "`id` in ($ids)";
$this->db->table_name = $tablename;
$key_array = $this->db->select($sql,'*');
}
if(!empty($ids))
{
$res = $this->db->get_one("`id` in ($ids) and xszt=1",'COUNT(`id`) AS sum');
$total = $res['sum'];
}
$template = 'show_buildinfo';
include template('content',$template);
}
}
?>