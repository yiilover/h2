<?php

defined('IN_HOUSE5') or exit('No permission resources.');
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
h5_base::load_app_func('util','content');
class tag {
private $db;
function __construct() {
$this->db = h5_base::load_model('content_model');
}
public function init() {
if(!isset($_GET['catid'])) showmessage(L('missing_part_parameters'));
$catid = intval($_GET['catid']);
$siteids = getcache('category_content','commons');
$siteid = $siteids[$catid];
$this->categorys = getcache('category_content_'.$siteid,'commons');
if(!isset($this->categorys[$catid])) showmessage(L('missing_part_parameters'));
if(isset($_GET['info']['catid']) &&$_GET['info']['catid']) {
$catid = intval($_GET['info']['catid']);
}else {
$_GET['info']['catid'] = 0;
}
if(isset($_GET['tag']) &&trim($_GET['tag']) != '') {
$tag = iconv('UTF-8','GBK',$_GET['tag']);
$tag = safe_replace(strip_tags($tag));
}else {
showmessage(L('illegal_operation'));
}
$modelid = $this->categorys[$catid]['modelid'];
$modelid = intval($modelid);
if(!$modelid) showmessage(L('illegal_parameters'));
$CATEGORYS = $this->categorys;
$siteid = $this->categorys[$catid]['siteid'];
$siteurl = siteurl($siteid);
$this->db->set_model($modelid);
$page = $_GET['page'];
$datas = $infos = array();
$tag1 = iconv('GBK','UTF-8',$tag);
$urlrules = 'keyword-'.$catid.'-'.urlencode($tag1).'-p{$page}.html';
define('URLRULE',$urlrules);
$infos = $this->db->listinfo("`keywords` LIKE '%$tag%'",'id DESC',$page,40,'',10,$urlrules);
$total = $this->db->number;
if($total>0) {
$pages = $this->db->pages;
foreach($infos as $_v) {
if(strpos($_v['url'],'://')===false) $_v['url'] = $siteurl.$_v['url'];
$datas[] = $_v;
}
}
$SEO = seo($siteid,$catid,$tag.'相关新闻');
include template('content','tag');
}
}
?>