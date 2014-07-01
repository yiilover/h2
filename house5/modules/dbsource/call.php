<?php
 
defined('IN_HOUSE5') or exit('No permission resources.');
class call  {
private $db;
public function __construct() {
$this->db = h5_base::load_model('datacall_model');
}
public function get() {
$id = isset($_GET['id']) &&intval($_GET['id']) ?intval($_GET['id']) : exit();
if ($data = $this->db->get_one(array('id'=>$id))) {
if (!$str = tpl_cache('dbsource_'.$id,$data['cache'])) {
if ($data['type'] == 1) {
$get_db = h5_base::load_model("get_model");
$sql = $data['data'].(!empty($data['num']) ?" LIMIT $data[num]": '');
$r= $get_db->query($sql);
while(($s = $get_db->fetch_next()) != false) {
$str[] = $s;
}
}else {
$filepath = H5_PATH.'modules'.DIRECTORY_SEPARATOR.$data['module'].DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.$data['module'].'_tag.class.php';
if (file_exists($filepath)) {
$h5_tag = h5_base::load_app_class($data['module'].'_tag',$data['module']);
if (!method_exists($h5_tag,$data['action'])) {
exit();
}
$sql = string2array($data['data']);
$sql['action'] = $data['action'];
$sql['limit'] = $data['num'];
unset($data['num']);
$str  = $h5_tag->$data['action']($sql);
}else {
exit();
}
}
if ($data['cache']) setcache('dbsource_'.$id,$str,'tpl_data');
}
echo $this->_format($data['id'],$str,$data['dis_type']);
}
}
private function _format($id,$data,$type) {
switch($type) {
case '1':
if (CHARSET == 'gbk') {
$data = array_iconv($data,'gbk','utf-8');
}
return json_encode($data);
break;
case '2':
$xml = h5_base::load_sys_class('xml');
return $xml->xml_serialize($data);
break;
case '3':
h5_base::load_app_func('global');
ob_start();
include template_url($id);
$html = ob_get_contents();
ob_clean();
return format_js($html);
break;
}
}
}
?>