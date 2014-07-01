<?php
 
defined('IN_HOUSE5') or exit('No permission resources.');
class announce_tag {
private $db;
public function __construct() {
$this->db = h5_base::load_model('announce_model');
}
public function lists($data) {
$where = '1';
$siteid = $data['siteid'] ?intval($data['siteid']) : get_siteid();
if ($siteid) $where .= " AND `siteid`='".$siteid."'";
$where .= ' AND `passed`=\'1\' AND (`endtime` >= \''.date('Y-m-d').'\' or `endtime`=\'0000-00-00\')';
return $this->db->select($where,'*',$data['limit'],'aid DESC');
}
public function count() {
}
public function h5_tag() {
$sites = h5_base::load_app_class('sites','admin');
$sitelist = $sites->h5_tag_list();
$result = getcache('special','commons');
if(is_array($result)) {
$specials = array(L('please_select','','announce'));
foreach($result as $r) {
if($r['siteid']!=get_siteid()) continue;
$specials[$r['id']] = $r['title'];
}
}
return array(
'action'=>array('lists'=>L('lists','','announce')),
'lists'=>array(
'siteid'=>array('name'=>L('sitename','','announce'),'htmltype'=>'input_select','defaultvalue'=>get_siteid(),'data'=>$sitelist),
),
);
}
}
?>