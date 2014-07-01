<?php

defined('IN_HOUSE5') or exit('No permission resources.');
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
define('RELATION_HTML',true);
h5_base::load_app_class('admin','admin',0);
h5_base::load_sys_class('form','',0);
h5_base::load_app_func('util');
h5_base::load_sys_class('format','',0);
class assess extends admin {
private $db,$priv_db;
public $siteid,$categorys;
public function __construct() {
parent::__construct();
$this->db = h5_base::load_model('content_model');
$this->siteid = $this->get_siteid();
$this->categorys = getcache('category_content_'.$this->siteid,'commons');
if(isset($_GET['catid']) &&$_SESSION['roleid'] != 1 &&ROUTE_A !='pass'&&strpos(ROUTE_A,'public_')===false) {
$catid = intval($_GET['catid']);
$this->priv_db = h5_base::load_model('category_priv_model');
$action = $this->categorys[$catid]['type']==0 ?ROUTE_A : 'init';
$priv_datas = $this->priv_db->get_one(array('catid'=>$catid,'is_admin'=>1,'action'=>$action));
if(!$priv_datas) showmessage(L('permission_to_operate'),'blank');
}
}
public function init() {
$where = '';
$show_header = '';
if($_GET['dosubmit']){
if(isset($_GET['catid']) &&$_GET['catid'] &&$this->categorys[$_GET['catid']]['siteid']==$this->siteid) {
$catid = $_GET['catid'] = intval($_GET['catid']);
$category = $this->categorys[$catid];
$modelid = $category['modelid'];
$this->db->set_model($modelid);
if($this->categorys[$catid]['child']) {
$catids_str = $this->categorys[$catid]['arrchildid'];
$pos = strpos($catids_str,',')+1;
$catids_str = substr($catids_str,$pos);
$where .= "AND `catid` IN ($catids_str) ";
}
else
{
$where .= "AND `catid`='$catid' ";
}
if($where) $where = substr($where,3);
$year = trim($_GET['year']);
$month = trim($_GET['month']);
$week = trim($_GET['week']);
$themonth = trim($_GET['themonth']);
$thisyear = date('Y');
$thismonth = date('m');
$yesterday = trim($_GET['yesterday']);
$today = trim($_GET['today']);
$adminname = trim($_GET['adminname']);
$where.= "and `status`='99' and islink=0";
if(!empty($year))
{
if(!empty($month))
{
$where.= " and YEAR(FROM_UNIXTIME(inputtime,'%y-%m-%d')) = '$year' and MONTH(FROM_UNIXTIME(inputtime,'%y-%m-%d')) = '$month'";
}
else
{
$where.= " and YEAR(FROM_UNIXTIME(inputtime,'%y-%m-%d')) = '$year'";
}
}
else if(!empty($themonth))
{
$where.= " and YEAR(FROM_UNIXTIME(inputtime,'%y-%m-%d')) = '$thisyear' and MONTH(FROM_UNIXTIME(inputtime,'%y-%m-%d')) = '$thismonth'";
}
else if(!empty($week))
{
$where.= " and WEEKOFYEAR(FROM_UNIXTIME(inputtime,'%y-%m-%d')) = WEEKOFYEAR(now()) and YEAR(FROM_UNIXTIME(inputtime,'%y-%m-%d')) = '$thisyear'";
}
else if(!empty($yesterday))
{
$where.= " and DATEDIFF(now() , FROM_UNIXTIME(inputtime)) = 1";
}
else if(!empty($today))
{
$where.= " and FROM_UNIXTIME(inputtime,'%Y-%m-%d')=FROM_UNIXTIME(UNIX_TIMESTAMP(),'%Y-%m-%d')";
}
if(!empty($adminname))
{
$where.= " and username='$adminname'";
}
h5_base::load_sys_class('form');
$category = getcache('category_content_'.$this->siteid,'commons');
$modules = getcache('modules','commons');
$page = $_GET['page'] ?$_GET['page'] : '1';
$datas = $this->db->listinfo($where,'ID DESC',$page,$pagesize = 20);
$pages = $this->db->pages;
}
}else
{
$catid = 6;
$category = $this->categorys[$catid];
$modelid = $category['modelid'];
$this->db->set_model($modelid);
$where.= "`status`='99' and islink=0";
$where.= " and FROM_UNIXTIME(inputtime,'%Y-%m-%d')=FROM_UNIXTIME(UNIX_TIMESTAMP(),'%Y-%m-%d')";
h5_base::load_sys_class('form');
$category = getcache('category_content_'.$this->siteid,'commons');
$modules = getcache('modules','commons');
$page = $_GET['page'] ?$_GET['page'] : '1';
$datas = $this->db->listinfo($where,'ID DESC',$page,$pagesize = 20);
$pages = $this->db->pages;
}
include $this->admin_tpl('content_assess_list');
}
}
?>