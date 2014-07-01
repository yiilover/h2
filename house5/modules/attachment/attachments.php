<?php
 
defined('IN_HOUSE5') or exit('No permission resources.');
$session_storage = 'session_'.h5_base::load_config('system','session_storage');
h5_base::load_sys_class($session_storage);
if(param::get_cookie('sys_lang')) {
define('SYS_STYLE',param::get_cookie('sys_lang'));
}else {
define('SYS_STYLE','zh-cn');
}
class attachments {
private $att_db,$cfg;
function __construct() {
h5_base::load_app_func('global');
$this->upload_url = h5_base::load_config('system','upload_url');
$this->upload_path = h5_base::load_config('system','upload_path');
$this->imgext = array('jpg','gif','png','bmp','jpeg');
$this->userid = param::get_cookie('userid') ?param::get_cookie('userid') : param::get_cookie('_userid');
$this->isadmin = $_SESSION['roleid'] ?1 : 0;
$this->groupid = param::get_cookie('_groupid') ?param::get_cookie('_groupid') : 8;
$this->admin_username = $_SESSION['roleid'] ?param::get_cookie('admin_username') : '';
$this->cfg = getcache('common','commons');
}
public function upload() {
$grouplist = getcache('grouplist','member');
if($this->isadmin==0 &&!$grouplist[$this->groupid]['allowattachment']) return false;
h5_base::load_sys_class('attachment','',0);
$module = trim($_GET['module']);
$catid = intval($_GET['catid']);
$siteid = $this->get_siteid();
$site_setting = get_site_setting($siteid);
$site_allowext = $site_setting['upload_allowext'];
$attachment = new attachment($module,$catid,$siteid);
$attachment->set_userid($this->userid);
$a = $attachment->upload('upload',$site_allowext);
if($a){
$filepath = $attachment->uploadedfiles[0]['filepath'];
$fn = $attachment->uploadedfiles[0]['fn'];
$this->upload_json($a[0],$filepath,$attachment->uploadedfiles[0]['filename']);
if($attachment->uploadedfiles[0]['isremote']){
$attachment->mkhtml($fn,$filepath,'');
}else{
$attachment->mkhtml($fn,$this->upload_url.$filepath,'');
}
}
}
public function swfupload(){
$grouplist = getcache('grouplist','member');
if(isset($_POST['dosubmit'])){
if( $_POST['swf_auth_key'] != md5(h5_base::load_config('system','auth_key').$_POST['SWFUPLOADSESSID']) ||($_POST['isadmin']==0 &&!$grouplist[$_POST['groupid']]['allowattachment'])) exit();
h5_base::load_sys_class('attachment','',0);
$attachment = new attachment($_POST['module'],$_POST['catid'],$_POST['siteid']);
$attachment->set_userid($_POST['userid']);
$aids = $attachment->upload('Filedata',$_POST['filetype_post'],'','',array($_POST['thumb_width'],$_POST['thumb_height']),$_POST['watermark_enable']);
if($aids[0]) {
$filename= (strtolower(CHARSET) != 'utf-8') ?iconv('gbk','utf-8',$attachment->uploadedfiles[0]['filename']) : $attachment->uploadedfiles[0]['filename'];
if($attachment->uploadedfiles[0]['isimage']) {
if($attachment->uploadedfiles[0]['isremote']){
echo $aids[0].','.$attachment->uploadedfiles[0]['filepath'].','.$attachment->uploadedfiles[0]['isimage'].','.$filename;
}else{
echo $aids[0].','.$this->upload_url.$attachment->uploadedfiles[0]['filepath'].','.$attachment->uploadedfiles[0]['isimage'].','.$filename;
}
}else {
$fileext = $attachment->uploadedfiles[0]['fileext'];
if($fileext == 'zip'||$fileext == 'rar') $fileext = 'rar';
elseif($fileext == 'doc'||$fileext == 'docx') $fileext = 'doc';
elseif($fileext == 'xls'||$fileext == 'xlsx') $fileext = 'xls';
elseif($fileext == 'ppt'||$fileext == 'pptx') $fileext = 'ppt';
elseif ($fileext == 'flv'||$fileext == 'swf'||$fileext == 'rm'||$fileext == 'rmvb') $fileext = 'flv';
else $fileext = 'do';
if($attachment->uploadedfiles[0]['isremote']){
echo $aids[0].','.$attachment->uploadedfiles[0]['filepath'].','.$fileext.','.$filename;
}else{
echo $aids[0].','.$this->upload_url.$attachment->uploadedfiles[0]['filepath'].','.$fileext.','.$filename;
}
}
exit;
}else {
echo '0,'.$attachment->error();
exit;
}
}else {
if($this->isadmin==0 &&!$grouplist[$this->groupid]['allowattachment']) showmessage(L('att_no_permission'));
$args = $_GET['args'];
$authkey = $_GET['authkey'];
if(upload_key($args) != $authkey) showmessage(L('attachment_parameter_error'));
extract(getswfinit($_GET['args']));
$siteid = $this->get_siteid();
$site_setting = get_site_setting($siteid);
$file_size_limit = sizecount($site_setting['upload_maxsize']*1024);
$att_not_used = param::get_cookie('att_json');
if(empty($att_not_used) ||!isset($att_not_used)) $tab_status = ' class="on"';
if(!empty($att_not_used)) $div_status = ' hidden';
$att = $this->att_not_used();
include $this->admin_tpl('swfupload');
}
}
public function crop_upload() {
if (isset($GLOBALS["HTTP_RAW_POST_DATA"])) {
$pic = $GLOBALS["HTTP_RAW_POST_DATA"];
if (isset($_GET['width']) &&!empty($_GET['width'])) {
$width = intval($_GET['width']);
}
if (isset($_GET['height']) &&!empty($_GET['height'])) {
$height = intval($_GET['height']);
}
if (isset($_GET['file']) &&!empty($_GET['file'])) {
if(is_image($_GET['file'])== false ) exit();
$file_path = $this->upload_path.date('Y/md/');
h5_base::load_sys_func('dir');
dir_create($file_path);
if (strpos($_GET['file'],h5_base::load_config('system','upload_url'))!==false) {
$file = $_GET['file'];
$basename = basename($file);
if (strpos($basename,'thumb_')!==false) {
$file_arr = explode('_',$basename);
$basename = array_pop($file_arr);
}
$new_file = 'thumb_'.$width.'_'.$height.'_'.$basename;
}else {
h5_base::load_sys_class('attachment','',0);
$module = trim($_GET['module']);
$catid = intval($_GET['catid']);
$siteid = $this->get_siteid();
$attachment = new attachment($module,$catid,$siteid);
$uploadedfile['filename'] = basename($_GET['file']);
$uploadedfile['fileext'] = fileext($_GET['file']);
if (in_array($uploadedfile['fileext'],array('jpg','gif','jpeg','png','bmp'))) {
$uploadedfile['isimage'] = 1;
}
$new_file = date('Ymdhis').rand(100,999).'.'.$uploadedfile['fileext'];
if($this->cfg['ftp_enable']){
$uploadedfile['filepath'] = $this->cfg['ftp_upload_url'].date('Y/md/').$new_file;
}else{
$uploadedfile['filepath'] = date('Y/md/').$new_file;
}
$uploadedfile['isremote'] = $this->cfg['ftp_enable'];
$aid = $attachment->add($uploadedfile);
}
$filepath = date('Y/md/');
file_put_contents($this->upload_path.$filepath.$new_file,$pic);
if($this->cfg['ftp_enable']){
$ftp = h5_base::load_sys_class('ftps');
if($ftp->connect($this->cfg['ftp_host'],$this->cfg['ftp_user'],$this->cfg['ftp_password'],$this->cfg['ftp_port'],$this->cfg['ftp_pasv'])){
if(!$ftp->get_error()){
$ftp->chdir($this->cfg['ftp_path']);
if($ftp->put($this->cfg['ftp_path'].'/'.$filepath.$new_file,$this->upload_path.$filepath.$new_file)){
@unlink($this->upload_path.$filepath.$new_file);
}
}
}
}
}else {
return false;
}
if($this->cfg['ftp_enable']){
echo $this->cfg['ftp_upload_url'].$filepath.$new_file;
$ftp->close();
}else{
echo h5_base::load_config('system','upload_url').$filepath.$new_file;
}
exit;
}
}
public function swfdelete() {
$attachment = h5_base::load_sys_class('attachment');
$att_del_arr = explode('|',$_GET['data']);
foreach($att_del_arr as $n=>$att){
if($att) $attachment->delete(array('aid'=>$att,'userid'=>$this->userid,'uploadip'=>ip()));
}
}
public function album_load() {
if(!$this->admin_username) return false;
$where = $uploadtime= '';
$this->att_db= h5_base::load_model('attachment_model');
if($_GET['args']) extract(getswfinit($_GET['args']));
if($_GET['dosubmit']){
extract($_GET['info']);
$where = '';
$filename = safe_replace($filename);
if($filename) $where = "AND `filename` LIKE '%$filename%' ";
if($uploadtime) {
$start_uploadtime = strtotime($uploadtime.' 00:00:00');
$stop_uploadtime = strtotime($uploadtime.' 23:59:59');
$where .= "AND `uploadtime` >= '$start_uploadtime' AND  `uploadtime` <= '$stop_uploadtime'";
}
if($where) $where = substr($where,3);
}
h5_base::load_sys_class('form');
$page = $_GET['page'] ?$_GET['page'] : '1';
$infos = $this->att_db->listinfo($where,'aid DESC',$page,8,'',5);
foreach($infos as $n=>$v){
$ext = fileext($v['filepath']);
if(in_array($ext,$this->imgext)) {
$infos[$n]['src']=$this->upload_url.$v['filepath'];
$infos[$n]['width']='80';
}else {
$infos[$n]['src']=file_icon($v['filepath']);
$infos[$n]['width']='64';
}
}
$pages = $this->att_db->pages;
include $this->admin_tpl('album_list');
}
public function album_dir() {
if(!$this->admin_username) return false;
if($_GET['args']) extract(getswfinit($_GET['args']));
$dir = isset($_GET['dir']) &&trim($_GET['dir']) ?str_replace(array('..\\','../','./','.\\','..'),'',trim($_GET['dir'])) : '';
$filepath = $this->upload_path.$dir;
$list = glob($filepath.'/'.'*');
if(!empty($list)) rsort($list);
$local = str_replace(array(H5_PATH,HOUSE5_PATH ,DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR),array('','',DIRECTORY_SEPARATOR),$filepath);
$url = ($dir == '.'||$dir=='') ?$this->upload_url : $this->upload_url.str_replace('.','',$dir).'/';
$show_header = true;
include $this->admin_tpl('album_dir');
}
private function upload_json($aid,$src,$filename) {
$arr['aid'] = intval($aid);
$arr['src'] = trim($src);
$arr['filename'] = urlencode($filename);
$json_str = json_encode($arr);
$att_arr_exist = param::get_cookie('att_json');
$att_arr_exist_tmp = explode('||',$att_arr_exist);
if(is_array($att_arr_exist_tmp) &&in_array($json_str,$att_arr_exist_tmp)) {
return true;
}else {
$json_str = $att_arr_exist ?$att_arr_exist.'||'.$json_str : $json_str;
param::set_cookie('att_json',$json_str);
return true;
}
}
public function swfupload_json() {
$arr['aid'] = intval($_GET['aid']);
$arr['src'] = trim($_GET['src']);
$arr['filename'] = urlencode($_GET['filename']);
$json_str = json_encode($arr);
$att_arr_exist = param::get_cookie('att_json');
$att_arr_exist_tmp = explode('||',$att_arr_exist);
if(is_array($att_arr_exist_tmp) &&in_array($json_str,$att_arr_exist_tmp)) {
return true;
}else {
$json_str = $att_arr_exist ?$att_arr_exist.'||'.$json_str : $json_str;
param::set_cookie('att_json',$json_str);
return true;
}
}
public function swfupload_json_del() {
$arr['aid'] = intval($_GET['aid']);
$arr['src'] = trim($_GET['src']);
$arr['filename'] = urlencode($_GET['filename']);
$json_str = json_encode($arr);
$att_arr_exist = param::get_cookie('att_json');
$att_arr_exist = str_replace(array($json_str,'||||'),array('','||'),$att_arr_exist);
$att_arr_exist = preg_replace('/^\|\|||\|\|$/i','',$att_arr_exist);
param::set_cookie('att_json',$att_arr_exist);
}
private function att_not_used() {
$this->att_db= h5_base::load_model('attachment_model');
if($att_json = param::get_cookie('att_json')) {
if($att_json) $att_cookie_arr = explode('||',$att_json);
foreach ($att_cookie_arr as $_att_c) $att[] = json_decode($_att_c,true);
if(is_array($att) &&!empty($att)) {
foreach ($att as $n=>$v) {
$ext = fileext($v['src']);
if(in_array($ext,$this->imgext)) {
$att[$n]['fileimg']=$v['src'];
$att[$n]['width']='80';
$att[$n]['filename']=urldecode($v['filename']);
}else {
$att[$n]['fileimg']=file_icon($v['src']);
$att[$n]['width']='64';
$att[$n]['filename']=urldecode($v['filename']);
}
$this->cookie_att .=	'|'.$v['src'];
}
}
}
return $att;
}
final public static function admin_tpl($file,$m = '') {
$m = empty($m) ?ROUTE_M : $m;
if(empty($m)) return false;
return H5_PATH.'modules'.DIRECTORY_SEPARATOR.$m.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$file.'.tpl.php';
}
final public static function get_siteid() {
return get_siteid();
}
}
?>