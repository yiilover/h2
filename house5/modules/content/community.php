<?php

defined('IN_HOUSE5') or exit('No permission resources.');
define('CACHE_MODEL_PATH',CACHE_PATH.'caches_model'.DIRECTORY_SEPARATOR.'caches_data'.DIRECTORY_SEPARATOR);
define('RELATION_HTML',true);
h5_base::load_app_class('admin','admin',0);
h5_base::load_sys_class('form','',0);
h5_base::load_app_func('util');
h5_base::load_sys_class('format','',0);
class community extends admin {
private $db,$avgdb,$priv_db;
public $siteid,$categorys;
public function __construct() {
parent::__construct();
$this->db = h5_base::load_model('content_model');
$this->avg_db = h5_base::load_model('community_avgprice_model');
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
$h5_hash = $_SESSION['h5_hash'];
$catid = $_GET['catid'] = intval($_GET['catid']);
$category = $this->categorys[$catid];
$modelid = $category['modelid'];
$admin_username = param::get_cookie('admin_username');
$setting = string2array($category['setting']);
$workflowid = $setting['workflowid'];
$workflows = getcache('workflow_'.$this->siteid,'commons');
$workflows = $workflows[$workflowid];
$workflows_setting = string2array($workflows['setting']);
$admin_privs = array();
foreach($workflows_setting as $_k=>$_v) {
if(empty($_v)) continue;
foreach($_v as $_value) {
if($_value==$admin_username) $admin_privs[$_k] = $_k;
}
}
$workflow_steps = $workflows['steps'];
$workflow_menu = '';
$steps = isset($_GET['steps']) ?intval($_GET['steps']) : 0;
if($_SESSION['roleid']!=1 &&$steps &&!in_array($steps,$admin_privs)) showmessage(L('permission_to_operate'));
$this->db->set_model($modelid);
if($this->db->table_name==$this->db->db_tablepre) showmessage(L('model_table_not_exists'));;
$status = $steps ?$steps : 99;
if(isset($_GET['reject'])) $status = 0;
if(strpos($category['arrchildid'],',')===false)
{
$where = 'catid='.$catid.' AND status='.$status;
}
else
{
$where = 'catid in ('.$category['arrchildid'].') AND status='.$status;
}
if(isset($_GET['house_status']) &&$_GET['house_status']) {
$house_status = intval($_GET['house_status']);
$where .= " AND `house_status` = '$house_status'";
}
if(isset($_GET['isreply'])) {
$isreply = intval($_GET['isreply']);
$where .= " AND `isreply` = '$isreply'";
}
if(isset($_GET['start_time']) &&$_GET['start_time']) {
$start_time = strtotime($_GET['start_time']);
$where .= " AND `inputtime` > '$start_time'";
}
if(isset($_GET['end_time']) &&$_GET['end_time']) {
$end_time = strtotime($_GET['end_time']);
$where .= " AND `inputtime` < '$end_time'";
}
if($start_time>$end_time) showmessage(L('starttime_than_endtime'));
if(isset($_GET['keyword']) &&!empty($_GET['keyword'])) {
$type_array = array('title','description','username');
$searchtype = intval($_GET['searchtype']);
if($searchtype <3) {
$searchtype = $type_array[$searchtype];
$keyword = strip_tags(trim($_GET['keyword']));
$where .= " AND `$searchtype` like '%$keyword%'";
}elseif($searchtype==3) {
$keyword = intval($_GET['keyword']);
$where .= " AND `id`='$keyword'";
}
}
if(isset($_GET['posids']) &&!empty($_GET['posids'])) {
$posids = $_GET['posids']==1 ?intval($_GET['posids']) : 0;
$where .= " AND `posids` = '$posids'";
}
$datas = $this->db->listinfo($where,'id desc',$_GET['page']);
$pages = $this->db->pages;
include $this->admin_tpl('content_community_list');
}
public function avgprice() {
$catid = $_GET['catid'] = intval($_GET['catid']);
$category = $this->categorys[$catid];
$modelid = $category['modelid'];
$this->db->set_model($modelid);
if($this->db->table_name==$this->db->db_tablepre) showmessage(L('model_table_not_exists'));
$xqtablename = $this->db->table_name;
if(strpos($category['arrchildid'],',')===false)
{
$where = 'catid='.$catid.' AND status=99';
}
else
{
$where = 'catid in ('.$category['arrchildid'].') AND status=99';
}
$datas = $this->db->listinfo($where,'id asc',$_GET['page'],100000);
$thismonth = date("Ym");
$lastmonth = date("Ym",mktime(0,0 ,0,date("m")-1,1,date("Y")));
$today = mktime(0,0 ,0,date("m"),date("d"),date("Y"));
$thismonth_start = mktime(0,0 ,0,date("m"),1,date("Y"));
$lastmonthstart = mktime(0,0 ,0,date("m")-1,1,date("Y"));
$lastmonthend = mktime(23,59,59,date("m") ,0,date("Y"));
foreach ($datas as $_k=>$_v) {
$percent_change = 0;
$avg_price = 0;
$ids = $ids_new = array();
$catid = '112';
$category = $this->categorys[$catid];
$modelid = $category['modelid'];
$this->db->set_model($modelid);
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$avginfo = $this->avg_db->select(array('cid'=>$_v['id'],'type'=>'1','markdate'=>$lastmonth),"*",1,'addtime desc');
if($avginfo)
{
if($avginfo['addtime']<$thismonth_start)
{
$where = "where `relation` = '$_v[id]'";
$rs = $this->db->query("SELECT id FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
}
$ids = implode(',',$ids);
$sql = " `id` in ($ids) and mprice>0 and updatetime> $lastmonthstart and updatetime< $lastmonthend";
$this->db->table_name = $tablename;
$sum_array = $this->db->get_one($sql,'count(id) as sum_c,sum(mprice) as sum_p',$limit,'');
if($sum_array['sum_c']<1){
continue;
}
if($sum_array){
$avg_price = intval($sum_array['sum_p']/$sum_array['sum_c']);
$this->avg_db->update(array('avgprice'=>$avg_price,'addtime'=>time()),array('id'=>$avginfo['id']));
}
}
}
}
else 
{
$where = "where `relation` = '$_v[id]'";
$rs = $this->db->query("SELECT id FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r['id'];
}
$ids = implode(',',$ids);
$sql = " `id` in ($ids) and mprice>0 and updatetime> $lastmonthstart and updatetime< $lastmonthend";
$this->db->table_name = $tablename;
$sum_array = $this->db->get_one($sql,'count(id) as sum_c,sum(mprice) as sum_p',$limit,'');
if($sum_array['sum_c']<1){
continue;
}
if($sum_array){
$avg_price = intval($sum_array['sum_p']/$sum_array['sum_c']);
$this->avg_db->insert(array('avgprice'=>$avg_price,'cid'=>$_v['id'],'type'=>1,'markdate'=>$lastmonth,'addtime'=>time()));
}
}
}
}
foreach ($datas as $_k=>$_v) {
$percent_change = 0;
$avg_price = 0;
$ids = $ids_new = array();
$catid = '112';
$category = $this->categorys[$catid];
$modelid = $category['modelid'];
$this->db->set_model($modelid);
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$avginfo2 = $this->avg_db->select(array('cid'=>$_v['id'],'type'=>'1','markdate'=>$thismonth),"*",1,'addtime desc');
if($avginfo2)
{
if($avginfo2['addtime']<$today)
{
$where = "where `relation` = '$_v[id]'";
$rs = $this->db->query("SELECT id FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids_new[]= $r[id];
}
$ids_new = implode(',',$ids_new);
$sql = " `id` in ($ids_new) and mprice>0 and updatetime> $thismonth_start";
$this->db->table_name = $tablename;
$sum_array = $this->db->get_one($sql,'count(id) as sum_c,sum(mprice) as sum_p',$limit,'');
if($sum_array['sum_c']<1){
continue;
}
if($sum_array){
$avg_price = intval($sum_array['sum_p']/$sum_array['sum_c']);
$last_avgprice_arr = $this->avg_db->get_one(array('cid'=>$_v['id'],'markdate'=>$lastmonth,'type'=>1),'avgprice');
$last_avgprice = $last_avgprice_arr['avgprice'];
if($last_avgprice)
{
$percent_change = round(($avg_price-$last_avgprice)/$last_avgprice*100,2);
}
$this->avg_db->update(array('avgprice'=>$avg_price,'percent_change'=>$percent_change,'addtime'=>time()),array('id'=>$avginfo2['id']));
$this->db->table_name = $xqtablename;
$this->db->update(array('price'=>$avg_price,'price_percent'=>$percent_change),array('id'=>$_v['id']));
}
}
}
}
else 
{
$where = "where `relation` = '$_v[id]'";
$rs = $this->db->query("SELECT id FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids_new[]= $r['id'];
}
$ids_new = implode(',',$ids_new);
$sql = " `id` in ($ids_new) and mprice>0 and updatetime> $thismonth_start";
$this->db->table_name = $tablename;
$sum_array = $this->db->get_one($sql,'count(id) as sum_c,sum(mprice) as sum_p',$limit,'');
if($sum_array['sum_c']<1){
continue;
}
if($sum_array){
$avg_price = intval($sum_array['sum_p']/$sum_array['sum_c']);
$last_avgprice_arr = $this->avg_db->get_one(array('cid'=>$_v['id'],'markdate'=>$lastmonth,'type'=>1),'avgprice');
$last_avgprice = $last_avgprice_arr['avgprice'];
if($last_avgprice)
{
$percent_change = round(($avg_price-$last_avgprice)/$last_avgprice*100,2);
}
$this->avg_db->insert(array('avgprice'=>$avg_price,'percent_change'=>$percent_change,'cid'=>$_v['id'],'type'=>1,'markdate'=>$thismonth,'addtime'=>time()));
$this->db->table_name = $xqtablename;
$this->db->update(array('price'=>$avg_price,'price_percent'=>$percent_change),array('id'=>$_v['id']));
}
}
}
}
foreach ($datas as $_k=>$_v) {
$percent_change = 0;
$avg_price = 0;
$ids = $ids_new = array();
$catid = '113';
$category = $this->categorys[$catid];
$modelid = $category['modelid'];
$this->db->set_model($modelid);
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$avginfo = $this->avg_db->select(array('cid'=>$_v['id'],'type'=>'2','markdate'=>$lastmonth),"*",1,'addtime desc');
if($avginfo)
{
if($avginfo['addtime']<$thismonth_start)
{
$where = "where `relation` = '$_v[id]'";
$rs = $this->db->query("SELECT id FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
}
$ids = implode(',',$ids);
$sql = " `id` in ($ids) and price>0 and updatetime> $lastmonthstart and updatetime< $lastmonthend";
$this->db->table_name = $tablename;
$sum_array = $this->db->get_one($sql,'count(id) as sum_c,sum(price) as sum_p',$limit,'');
if($sum_array['sum_c']<1){
continue;
}
if($sum_array){
$avg_price = intval($sum_array['sum_p']/$sum_array['sum_c']);
$this->avg_db->update(array('avgprice'=>$avg_price,'addtime'=>time()),array('id'=>$avginfo['id']));
}
}
}
}
else 
{
$where = "where `relation` = '$_v[id]'";
$rs = $this->db->query("SELECT id FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r['id'];
}
$ids = implode(',',$ids);
$sql = " `id` in ($ids) and price>0 and updatetime> $lastmonthstart and updatetime< $lastmonthend";
$this->db->table_name = $tablename;
$sum_array = $this->db->get_one($sql,'count(id) as sum_c,sum(price) as sum_p',$limit,'');
if($sum_array['sum_c']<1){
continue;
}
if($sum_array){
$avg_price = intval($sum_array['sum_p']/$sum_array['sum_c']);
$this->avg_db->insert(array('avgprice'=>$avg_price,'cid'=>$_v['id'],'type'=>2,'markdate'=>$lastmonth,'addtime'=>time()));
}
}
}
}
foreach ($datas as $_k=>$_v) {
$percent_change = 0;
$avg_price = 0;
$ids = $ids_new = array();
$catid = '113';
$category = $this->categorys[$catid];
$modelid = $category['modelid'];
$this->db->set_model($modelid);
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$avginfo2 = $this->avg_db->select(array('cid'=>$_v['id'],'type'=>'2','markdate'=>$thismonth),"*",1,'addtime desc');
if($avginfo2)
{
if($avginfo2['addtime']<$today)
{
$where = "where `relation` = '$_v[id]'";
$rs = $this->db->query("SELECT id FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids_new[]= $r[id];
}
$ids_new = implode(',',$ids_new);
$sql = " `id` in ($ids_new) and price>0 and updatetime> $thismonth_start";
$this->db->table_name = $tablename;
$sum_array = $this->db->get_one($sql,'count(id) as sum_c,sum(price) as sum_p',$limit,'');
if($sum_array['sum_c']<1){
continue;
}
if($sum_array){
$avg_price = intval($sum_array['sum_p']/$sum_array['sum_c']);
$last_avgprice_arr = $this->avg_db->get_one(array('cid'=>$_v['id'],'markdate'=>$lastmonth,'type'=>2),'avgprice');
$last_avgprice = $last_avgprice_arr['avgprice'];
if($last_avgprice)
{
$percent_change = round(($avg_price-$last_avgprice)/$last_avgprice*100,2);
}
$this->avg_db->update(array('avgprice'=>$avg_price,'percent_change'=>$percent_change,'addtime'=>time()),array('id'=>$avginfo2['id']));
$this->db->table_name = $xqtablename;
$this->db->update(array('price_rent'=>$avg_price,'price_rent_percent'=>$percent_change),array('id'=>$_v['id']));
}
}
}
}
else 
{
$where = "where `relation` = '$_v[id]'";
$rs = $this->db->query("SELECT id FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids_new[]= $r['id'];
}
$ids_new = implode(',',$ids_new);
$sql = " `id` in ($ids_new) and price>0 and updatetime> $thismonth_start";
$this->db->table_name = $tablename;
$sum_array = $this->db->get_one($sql,'count(id) as sum_c,sum(price) as sum_p',$limit,'');
if($sum_array['sum_c']<1){
continue;
}
if($sum_array){
$avg_price = intval($sum_array['sum_p']/$sum_array['sum_c']);
$last_avgprice_arr = $this->avg_db->get_one(array('cid'=>$_v['id'],'markdate'=>$lastmonth,'type'=>2),'avgprice');
$last_avgprice = $last_avgprice_arr['avgprice'];
if($last_avgprice)
{
$percent_change = round(($avg_price-$last_avgprice)/$last_avgprice*100,2);
}
$this->avg_db->insert(array('avgprice'=>$avg_price,'percent_change'=>$percent_change,'cid'=>$_v['id'],'type'=>2,'markdate'=>$thismonth,'addtime'=>time()));
$this->db->table_name = $xqtablename;
$this->db->update(array('price_rent'=>$avg_price,'price_rent_percent'=>$percent_change),array('id'=>$_v['id']));
}
}
}
}
echo '小区均价更新成功';
}
}
?>