<?php

defined('IN_HOUSE5') or exit('No permission resources.');
class url{
private $urlrules,$categorys,$html_root;
public function __construct() {
$this->urlrules = getcache('urlrules','commons');
self::set_siteid();
$this->categorys = getcache('category_content_'.$this->siteid,'commons');
$this->html_root = h5_base::load_config('system','html_root');
}
public function show($id,$page = 0,$catid = 0,$time = 0,$prefix = '',$data = '',$action = 'edit',$upgrade = 0) {
$page = max($page,1);
$urls = $catdir = '';
$category = $this->categorys[$catid];
$setting = string2array($category['setting']);
$content_ishtml = $setting['content_ishtml'];
if($upgrade ||(isset($_POST['upgrade']) &&defined('IN_ADMIN') &&$_POST['upgrade'])) {
if($_POST['upgrade']) $upgrade = $_POST['upgrade'];
$upgrade = '/'.ltrim($upgrade,WEB_PATH);
if($page==1) {
$url_arr[0] = $url_arr[1] = $upgrade;
}else {
$lasttext = strrchr($upgrade,'.');
$len = -strlen($lasttext);
$path = substr($upgrade,0,$len);
$url_arr[0] = $url_arr[1] = $path.'_'.$page.$lasttext;
}
}else {
$show_ruleid = $setting['show_ruleid'];
$urlrules = $this->urlrules[$show_ruleid];
if(!$time) $time = SYS_TIME;
$urlrules_arr = explode('|',$urlrules);
if($page==1) {
$urlrule = $urlrules_arr[0];
}else {
$urlrule = isset($urlrules_arr[1]) ?$urlrules_arr[1] : $urlrules_arr[0];
}
$domain_dir = '';
if (strpos($category['url'],'://')!==false &&strpos($category['url'],'?')===false) {
if (preg_match('/^((http|https):\/\/)?([^\/]+)/i',$category['url'],$matches)) {
$match_url = $matches[0];
$url = $match_url.'/';
}
$db = h5_base::load_model('category_model');
$r = $db->get_one(array('url'=>$url),'`catid`');
if($r) $domain_dir = $this->get_categorydir($r['catid']).$this->categorys[$r['catid']]['catdir'].'/';
}
if($this->siteid=='1')
{
$house_path = HOUSE_PATH;
}
$categorydir = $this->get_categorydir($catid);
$relation = $this->get_relation($catid,$id);
if(strpos($urlrule,'{$xglp}')!==false)
{
$xglp = $this->get_xglp($catid,$id);
}
if(strpos($urlrule,'{$house_path}{$id}')!==false)
{
$house_domain = h5_base::load_config('system','house_domain');
$domain = $this->get_domain($catid,$id);
if(!empty($domain)&&!empty($house_domain))
{
$domainlink = 'http://'.$domain.'.'.$house_domain;
$urlrule = str_replace(array('{$house_path}{$id}'),array($domainlink),$urlrule);
}
}
$catdir = $category['catdir'];
$year = date('Y',$time);
$month = date('m',$time);
$day = date('d',$time);
$urls = str_replace(array('{$categorydir}','{$catdir}','{$year}','{$month}','{$day}','{$catid}','{$id}','{$page}','{$house_path}','{$esf_path}','{$tuan_path}','{$relation}','{$xglp}'),array($categorydir,$catdir,$year,$month,$day,$catid,$id,$page,$house_path,ESF_PATH,TUAN_PATH,$relation,$xglp),$urlrule);
$create_to_html_root = $category['create_to_html_root'];
if($create_to_html_root ||$category['sethtml']) {
$html_root = '';
}else {
$html_root = $this->html_root;
}
if($content_ishtml &&$url) {
if ($domain_dir &&$category['isdomain']) {
$url_arr[1] = $html_root.'/'.$domain_dir.$urls;
$url_arr[0] = $url.$urls;
}else {
$url_arr[1] = $html_root.'/'.$urls;
$url_arr[0] = WEB_PATH == '/'?$match_url.$html_root.'/'.$urls : $match_url.rtrim(WEB_PATH,'/').$html_root.'/'.$urls;
}
}elseif($content_ishtml) {
$url_arr[0] = WEB_PATH == '/'?$html_root.'/'.$urls : rtrim(WEB_PATH,'/').$html_root.'/'.$urls;
$url_arr[1] = $html_root.'/'.$urls;
}else {
if (strpos($urls,'http://')!==false) {
$url_arr[0] = $url_arr[1] = $urls;
}
else
{
$url_arr[0] = $url_arr[1] = APP_PATH.$urls;
}
}
}
if($content_ishtml &&$data) {
$data['id'] = $id;
$url_arr['content_ishtml'] = 1;
$url_arr['data'] = $data;
}
return $url_arr;
}
public function category_url($catid,$page = 1) {
$category = $this->categorys[$catid];
if($category['type']==2) return $category['url'];
$page = max(intval($page),1);
$setting = string2array($category['setting']);
$category_ruleid = $setting['category_ruleid'];
$urlrules = $this->urlrules[$category_ruleid];
$urlrules_arr = explode('|',$urlrules);
if ($page==1) {
$urlrule = $urlrules_arr[0];
}else {
$urlrule = $urlrules_arr[1];
}
if (!$setting['ishtml']) {
$url = str_replace(array('{$catid}','{$page}'),array($catid,$page),$urlrule);
if (strpos($url,'\\')!==false) {
$url = APP_PATH.str_replace('\\','/',$url);
}
}else {
if ($category['arrparentid']) {
$parentids = explode(',',$category['arrparentid']);
}
$parentids[] = $catid;
$domain_dir = '';
foreach ($parentids as $pid) {
$r = $this->categorys[$pid];
if (strpos(strtolower($r['url']),'://')!==false &&strpos($r['url'],'?')===false) {
$r['url'] = preg_replace('/([(http|https):\/\/]{0,})([^\/]*)([\/]{1,})/i','$1$2/',$r['url'],-1);
if (substr_count($r['url'],'/')==3 &&substr($r['url'],-1,1)=='/') {
$url = $r['url'];
$domain_dir = $this->get_categorydir($pid).$this->categorys[$pid]['catdir'].'/';
}
}
}
$category_dir = $this->get_categorydir($catid);
$urls = str_replace(array('{$categorydir}','{$catdir}','{$catid}','{$page}'),array($category_dir,$category['catdir'],$catid,$page),$urlrule);
if ($url &&$domain_dir) {
if (strpos($urls,$domain_dir)===0) {
$url = str_replace(array($domain_dir,'\\'),array($url,'/'),$urls);
}else {
$urls = $domain_dir.$urls;
$url = str_replace(array($domain_dir,'\\'),array($url,'/'),$urls);
}
}else {
$url = $urls;
}
}
if (in_array(basename($url),array('index.html','index.htm','index.shtml'))) {
$url = dirname($url).'/';
}
if (strpos($url,'://')===false) $url = str_replace('//','/',$url);
if(strpos($url,'/')===0) $url = substr($url,1);
return $url;
}
public function get_list_url($ruleid,$categorydir,$catdir,$catid,$page = 1) {
$urlrules = $this->urlrules[$ruleid];
$urlrules_arr = explode('|',$urlrules);
if ($page==1) {
$urlrule = $urlrules_arr[0];
}else {
$urlrule = $urlrules_arr[1];
}
$urls = str_replace(array('{$categorydir}','{$catdir}','{$year}','{$month}','{$day}','{$catid}','{$page}'),array($categorydir,$catdir,$year,$month,$day,$catid,$page),$urlrule);
return $urls;
}
private function get_categorydir($catid,$dir = '') {
$setting = array();
$setting = string2array($this->categorys[$catid]['setting']);
if ($setting['create_to_html_root']) return $dir;
if ($this->categorys[$catid]['parentid']) {
$dir = $this->categorys[$this->categorys[$catid]['parentid']]['catdir'].'/'.$dir;
return $this->get_categorydir($this->categorys[$catid]['parentid'],$dir);
}else {
return $dir;
}
}
private function set_siteid() {
if(defined('IN_ADMIN')) {
$this->siteid = get_siteid();
}else {
if (param::get_cookie('siteid')) {
$this->siteid = param::get_cookie('siteid');
}else {
$this->siteid = 1;
}
}
}
private function get_relation($catid,$id) {
$modelid = $this->categorys[$catid]['modelid'];
$this->db = h5_base::load_model('content_model');
$siteids = getcache('category_content','commons');
if(!$siteids[$catid]) return false;
$siteid = $siteids[$catid];
$this->category = getcache('category_content_'.$siteid,'commons');
if($this->category[$catid]['type']!=0) return false;
$this->modelid = $this->category[$catid]['modelid'];
$this->db->set_model($this->modelid);
$this->tablename = $this->db->table_name;
$table_name = $this->db->table_name;
$this->db->table_name = $this->db->table_name.'_data';
$r = $this->db->get_one(array('id'=>$id),'relation');
$this->db->table_name = $table_name;
return $r['relation'];
}
private function get_xglp($catid,$id) {
$modelid = $this->categorys[$catid]['modelid'];
$this->db = h5_base::load_model('content_model');
$siteids = getcache('category_content','commons');
if(!$siteids[$catid]) return false;
$siteid = $siteids[$catid];
$this->category = getcache('category_content_'.$siteid,'commons');
if($this->category[$catid]['type']!=0) return false;
$this->modelid = $this->category[$catid]['modelid'];
$this->db->set_model($this->modelid);
$r = $this->db->get_one(array('id'=>$id),'xglp');
return $r['xglp'];
}
private function get_domain($catid,$id) {
$modelid = $this->categorys[$catid]['modelid'];
$this->db = h5_base::load_model('content_model');
$siteids = getcache('category_content','commons');
if(!$siteids[$catid]) return false;
$siteid = $siteids[$catid];
$this->category = getcache('category_content_'.$siteid,'commons');
if($this->category[$catid]['type']!=0) return false;
$this->modelid = $this->category[$catid]['modelid'];
$this->db->set_model($this->modelid);
$this->tablename = $this->db->table_name;
$r = $this->db->get_one(array('id'=>$id),'domain');
return $r['domain'];
}
}?>