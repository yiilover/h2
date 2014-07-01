<?php
 
defined('IN_HOUSE5') or exit('No permission resources.');
class member_tag {
private $db,$favorite_db;
public function __construct() {
$this->db = h5_base::load_model('member_model');
$this->favorite_db = h5_base::load_model('favorite_model');
}
public function favoritelist($data) {
$userid = intval($data['userid']);
$limit = $data['limit'];
$order = $data['order'];
$favoritelist = $this->favorite_db->select(array('userid'=>$userid),"*",$limit,$order);
return $favoritelist;
}
public function memberlist($data) {
$type = intval($data['type']);
$relation = intval($data['relation']);
if($type)
{
$where = "modelid='42'";
}
$limit = $data['limit'];
if(strpos($limit,",")!==false)
{
$limit_arr = explode(",",$limit);
$limit = $limit_arr[1];
}
$order = $data['order'];
$page = isset($data['pg']) ?intval($data['pg']) : 1;
$urlrules = ESF_PATH.'jingjiren-g{$page}';
define('URLRULE',$urlrules);
if($data['where'])
{
$this->db->set_model(42);
$where = '1=1 '.$data['where'];
$order = "userid desc";
$this->_member_modelinfo = $this->db->listinfo($where,$order,$page,$limit);
$pages = $this->db->pages;
foreach($this->_member_modelinfo as $key =>$memberinfo)
{
$this->db->set_model();
$this->memberinfo = $this->db->get_one(array('userid'=>$memberinfo['userid']));
$memberinfo['avatar'] = $this->memberinfo['avatar'] ?$this->memberinfo['avatar'] : APP_PATH.'statics/default/member/img/nophoto_90x90.gif';
$grouplist = getcache('grouplist','member');
$memberinfo['groupname'] = $grouplist[$this->memberinfo['groupid']]['name'];
$memberinfo['groupicon'] = $grouplist[$this->memberinfo['groupid']]['icon'];
$memberinfo['point'] = $this->memberinfo['point'];
$memberinfo['companyname'] = $memberinfo['companyname']?$memberinfo['companyname']:'独立经纪人';
$this->_db = h5_base::load_model('content_model');
$this->_db->table_name = $this->_db->db_tablepre.'member_broker_identity';
$identityinfo = $this->_db->get_one(array('broker_id'=>$this->memberinfo['userid'],'idtype'=>'identity'));
if(!empty($identityinfo) &&$identityinfo['status']) {
$memberinfo['idcard_status']=1;
}
$certificateinfo = $this->_db->get_one(array('broker_id'=>$this->memberinfo['userid'],'idtype'=>'certificate'));
if(!empty($certificateinfo) &&$certificateinfo['status']) {
$memberinfo['certificate_status']=1;
}
$memberlist[$key] = $memberinfo;
}
$this->db->set_model();
}
else
{
if($data['avatar'])
{
if($where)
{
$where.= " and avatar!=''";
}
else
{
$where = "avatar!=''";
}
}
$memberlist = $this->db->listinfo($where,$order,$page,$limit);
$pages = $this->db->pages;
foreach($memberlist as $key =>$memberinfo)
{
$memberinfo['avatar'] = $memberinfo['avatar'] ?$memberinfo['avatar'] : APP_PATH.'statics/default/member/img/nophoto_90x90.gif';
$grouplist = getcache('grouplist','member');
$memberinfo['groupname'] = $grouplist[$memberinfo['groupid']]['name'];
$memberinfo['groupicon'] = $grouplist[$memberinfo['groupid']]['icon'];
$this->db->set_model($memberinfo['modelid']);
$this->_member_modelinfo = $this->db->get_one(array('userid'=>$memberinfo['userid']));
$this->_member_modelinfo = $this->_member_modelinfo ?$this->_member_modelinfo : array();
$this->_member_modelinfo['companyname'] = $this->_member_modelinfo['companyname']?$this->_member_modelinfo['companyname']:'独立经纪人';
$this->db->set_model();
if(is_array($memberinfo)) {
$memberlist[$key] = array_merge($memberinfo,$this->_member_modelinfo);
}
}
}
$result['result'] = $memberlist;
$result['pages'] = $pages;
return $result;
}
public function count($data) {
$userid = intval($data['userid']);
return $this->favorite_db->count(array('userid'=>$userid));
}
public function h5_tag() {
return array(
'action'=>array('favoritelist'=>L('favorite_list','','member')),
'favoritelist'=>array(
'userid'=>array('name'=>L('uid'),'htmltype'=>'input'),
),
);
}
}
?>