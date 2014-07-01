<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
class ssi extends admin {
private $db,$siteid,$sitelist,$dbsource;
public function __construct() {
$this->db = h5_base::load_model('ssi_model');
$this->dbsource = h5_base::load_model('dbsource_model');
$this->siteid = $this->get_siteid();
$this->sitelist = getcache('sitelist','commons');
parent::__construct();
}
public function init() {
$big_menu = array('javascript:window.top.art.dialog({id:\'add\',iframe:\'?s=ssi/ssi/add\', title:\''.L('add_ssi').'\', width:\'700\', height:\'500\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});void(0);',L('add_ssi'));
$infos = $this->db->select('1','id,name,tag,cache',100);
$array = array();
foreach ($infos as $r) {
$r['lastupdate']=time();
$array[$r['id']] = $r;
}
setcache('ssi_var',$array,'ssi');
include $this->admin_tpl('ssi_list');
}
public function add() {
h5_base::load_app_func('global','dbsource');
if (isset($_POST['dosubmit'])) {
$name = isset($_POST['name']) &&trim($_POST['name']) ?trim($_POST['name']) : showmessage(L('name').L('empty'));
$cache = isset($_POST['cache']) &&intval($_POST['cache']) ?intval($_POST['cache']) : 60;
$tag= trim($_POST['tag']);
$data = isset($_POST['data']) &&trim($_POST['data']) ?trim($_POST['data']) : showmessage(L('custom_sql').L('empty'));
if ($this->db->get_one(array('name'=>$name)))  {
showmessage(L('name').L('exists'));
}
$siteid = $this->get_siteid();
$insert_id=$this->db->insert(array('siteid'=>$siteid,'tag'=>$tag,'name'=>$name,'data'=>$data,'cache'=>$cache),1);
if($insert_id){
}
showmessage(L('operation_success'),HTTP_REFERER,'','add');
}else {
$show_header = $show_validator = true;
include $this->admin_tpl('tag_add');
}
}
public function edit() {
$id = isset($_GET['id']) &&intval($_GET['id']) ?intval($_GET['id']) :  showmessage(L('illegal_operation'));
if (!$data = $this->db->get_one(array('id'=>$id))) {
showmessage(L('nofound'));
}
if (isset($_POST['dosubmit'])) {
$name = isset($_POST['name']) &&trim($_POST['name']) ?trim($_POST['name']) : showmessage(L('name').L('empty'),HTTP_REFERER);
$cache = isset($_POST['cache']) &&intval($_POST['cache']) ?intval($_POST['cache']) : 60;
$tag= trim($_POST['tag']);
$data = isset($_POST['data']) &&trim($_POST['data']) ?trim($_POST['data']) : showmessage(L('custom_sql').L('empty'),HTTP_REFERER);
if ($this->db->update(array('name'=>$name,'tag'=>$tag,'data'=>$data,'cache'=>$cache,'siteid'=>$this->siteid),array('id'=>$id))) {
showmessage(L('operation_success'),'','','edit');
}else {
showmessage(L('operation_failure'),HTTP_REFERER);
}
}
else{
$show_header = $show_validator = true;
include $this->admin_tpl('tag_edit');
}
}
public function del() {
$id = isset($_GET['id']) &&intval($_GET['id']) ?intval($_GET['id']) :  showmessage(L('illegal_operation'));
if (!$data = $this->db->get_one(array('id'=>$id))) {
showmessage(L('nofound'));
}
if ($this->db->delete(array('id'=>$id))) {
@unlink(H5_PATH.'templates'.DIRECTORY_SEPARATOR.$this->sitelist[$this->siteid]['default_style'].DIRECTORY_SEPARATOR.'ssi'.DIRECTORY_SEPARATOR.'ssi_'.$id.'.html');
showmessage(L('operation_success'),HTTP_REFERER);
}else {
showmessage(L('operation_failure'),HTTP_REFERER);
}
}
public function ssi_update() {
$id = isset($_GET['id']) &&intval($_GET['id']) ?intval($_GET['id']) :  showmessage(L('illegal_operation'),HTTP_REFERER);
if (!$data = $this->db->get_one(array('id'=>$id))) {
showmessage(L('nofound'));
}
$ssi = h5_base::load_app_class('ssi_tag');
$r=$ssi->createhtml(H5_PATH.'templates'.DIRECTORY_SEPARATOR.$this->sitelist[$this->siteid]['default_style'].DIRECTORY_SEPARATOR.'ssi'.DIRECTORY_SEPARATOR.'ssi_'.$data['id'].'.html',$data['data']);
if($r){
echo "更新成功";
}else{
echo "更新失败";
};
}
public function public_name() {
$name = isset($_GET['name']) &&trim($_GET['name']) ?(h5_base::load_config('system','charset') == 'gbk'?iconv('utf-8','gbk',trim($_GET['name'])) : trim($_GET['name'])) : exit('0');
$id = isset($_GET['id']) &&intval($_GET['id']) ?intval($_GET['id']) : '';
$name = safe_replace($name);
$data = array();
if ($id) {
$data = $this->db->get_one(array('id'=>$id),'name');
if (!empty($data) &&$data['name'] == $name) {
exit('1');
}
}
if ($this->db->get_one(array('name'=>$name),'id')) {
exit('0');
}else {
exit('1');
}
}
public function public_call(){
$_GET['id'] = intval($_GET['id']);
if (!$_GET['id']) showmessage(L('illegal_action'),HTTP_REFERER,'','call');
$r = $this->db->get_one(array('id'=>$_GET['id']));
include $this->admin_tpl('ssi_call');
}
public function public_ssi() {
$this->html = h5_base::load_app_class('html');
$posid=intval($_GET['posid']);
if($posid){
$size = $this->html->ssi($posid);
}else{
$var=getcache('ssi_var','ssi');
if(!empty($var)){
foreach($var as $k=>$row){
if(((int)$row['lastupdate']+(int)$row['cache'])>time())	
print_r($size);
$size = $this->html->ssi($row[id],$row['tag']);
$var[$k]['lastupdate']=time();
}
setcache('ssi_var',$var,'ssi');
}
}
}
}?>