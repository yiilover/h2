<?php

class content_tag {
private $db;
public function __construct() {
$this->db = h5_base::load_model('content_model');
$this->position = h5_base::load_model('position_data_model');
}
public function set_modelid($catid) {
$siteids = getcache('category_content','commons');
if(!$siteids[$catid]) return false;
$siteid = $siteids[$catid];
$this->category = getcache('category_content_'.$siteid,'commons');
if($this->category[$catid]['type']!=0) return false;
$this->modelid = $this->category[$catid]['modelid'];
$this->db->set_model($this->modelid);
$this->tablename = $this->db->table_name;
if(empty($this->category)) {
return false;
}else {
return true;
}
}
public function count($data) {
if($data['action'] == 'lists') {
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
if(isset($data['where'])) {
$sql = $data['where'];
}else {
$thumb = intval($data['thumb']) ?" AND thumb != ''": '';
if($this->category[$catid]['child']) {
$catids_str = $this->category[$catid]['arrchildid'];
$pos = strpos($catids_str,',')+1;
$catids_str = substr($catids_str,$pos);
$sql = "status=99 AND catid IN ($catids_str)".$thumb;
}else {
$sql = "status=99 AND catid='$catid'".$thumb;
}
}
return $this->db->count($sql);
}
}
public function lists($data) {
$catid = intval($data['catid']);
$posids = intval($data['posids']);
if(!$this->set_modelid($catid)) return false;
if(isset($data['where'])) {
$sql = $data['where'];
}else {
$thumb = intval($data['thumb']) ?" AND thumb != ''": '';
$islink = intval($data['islink']) ?" AND islink=0": '';
if($this->category[$catid]['child']) {
$catids_str = $this->category[$catid]['arrchildid'];
$pos = strpos($catids_str,',')+1;
$catids_str = substr($catids_str,$pos);
$sql = "status=99 AND catid IN ($catids_str)".$thumb.$islink;
}else {
$sql = "status=99 AND catid='$catid'".$thumb.$islink;
}
}
if(isset($data['posids'])) {
$sql .= " AND posids='0'";
}
$order = $data['order'];
$return = $this->db->select($sql,'*',$data['limit'],$order,'','id');
if (isset($data['moreinfo']) &&intval($data['moreinfo']) == 1) {
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
}
return $return;
}
public function relation($data) {
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
$order = $data['order'];
$sql = "`status`=99";
$limit = $data['id'] ?$data['limit']+1 : $data['limit'];
if($data['relation']) {
$relations = explode('|',trim($data['relation'],'|'));
$relations = array_diff($relations,array(null));
$relations = implode(',',$relations);
$sql = " `id` IN ($relations)";
$key_array = $this->db->select($sql,'*',$limit,$order,'','id');
}elseif($data['keywords']) {
$keywords = str_replace('%','',$data['keywords']);
if (strpos($keywords,',') !== false) {
$keywords_arr = explode(',',$keywords);
}
else
{
$keywords_arr = explode(' ',$keywords);
}
$key_array = array();
$number = 0;
$i =1;
foreach ($keywords_arr as $_k) {
$sql2 = $sql." AND `keywords` LIKE '%$_k%'".(isset($data['id']) &&intval($data['id']) ?" AND `id` != '".abs(intval($data['id']))."'": '');
$r = $this->db->select($sql2,'*',$limit,'','','id');
$number += count($r);
foreach ($r as $id=>$v) {
if($i<= $data['limit'] &&!in_array($id,$key_array)) $key_array[$id] = $v;
$i++;
}
if($data['limit']<$number) break;
}
}
if($data['id']) unset($key_array[$data['id']]);
return $key_array;
}
public function hits($data) {
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
$this->hits_db = h5_base::load_model('hits_model');
$sql = $desc = $ids = '';
$array = $ids_array = array();
$order = $data['order'];
$hitsid = 'c-'.$this->modelid.'-%';
$sql = "hitsid LIKE '$hitsid'";
if(isset($data['day'])) {
$updatetime = SYS_TIME-intval($data['day'])*86400;
$sql .= " AND updatetime>'$updatetime'";
}
if($this->category[$catid]['child']) {
$catids_str = $this->category[$catid]['arrchildid'];
$pos = strpos($catids_str,',')+1;
$catids_str = substr($catids_str,$pos);
$sql .= " AND catid IN ($catids_str)";
}else {
$sql .= " AND catid='$catid'";
}
$hits = array();
$result = $this->hits_db->select($sql,'*',$data['limit'],$order);
foreach ($result as $r) {
$pos = strpos($r['hitsid'],'-',2) +1;
$ids_array[] = $id = substr($r['hitsid'],$pos);
$hits[$id] = $r;
}
$ids = implode(',',$ids_array);
if($ids) {
$sql = "status=99 AND id IN ($ids)";
}else {
$sql = '';
}
$this->db->table_name = $this->tablename;
$result = $this->db->select($sql,'*',$data['limit'],'','','id');
$this->db->table_name = $this->tablename.'_data';
if($catid=='6'&&!empty($ids))
{
$result2 = $this->db->select("id IN ($ids)",'id,copyfrom',$data['limit'],'','','id');
}
foreach ($ids_array as $id) {
if($result[$id]['title']!='') {
$array[$id] = $result[$id];
if($catid=='6')
{
$array[$id]['copyfrom'] = $result2[$id]['copyfrom'];
}
$array[$id] = array_merge($array[$id],$hits[$id]);
}
}
return $array;
}
public function category($data) {
$data['catid'] = intval($data['catid']);
$array = array();
$siteid = $data['siteid'] &&intval($data['siteid']) ?intval($data['siteid']) : get_siteid();
$categorys = getcache('category_content_'.$siteid,'commons');
$site = siteinfo($siteid);
$i = 1;
foreach ($categorys as $catid=>$cat) {
if($i>$data['limit']) break;
if((!$cat['ismenu']) ||$siteid &&$cat['siteid']!=$siteid) continue;
if (strpos($cat['url'],'://') === false) {
$cat['url'] = substr($site['domain'],0,-1).$cat['url'];
}
if($cat['parentid']==$data['catid']) {
$array[$catid] = $cat;
$i++;
}
}
return $array;
}
public function position($data) {
$sql = '';
$array = array();
$posid = intval($data['posid']);
$moreposid = $data['moreposid'];
$order = $data['order'];
$thumb = (empty($data['thumb']) ||intval($data['thumb']) == 0) ?0 : 1;
$siteid = $GLOBALS['siteid'] ?$GLOBALS['siteid'] : 1;
$catid = (empty($data['catid']) ||$data['catid'] == 0) ?'': intval($data['catid']);
if($catid) {
$siteids = getcache('category_content','commons');
if(!$siteids[$catid]) return false;
$siteid = $siteids[$catid];
$this->category = getcache('category_content_'.$siteid,'commons');
}
if($catid &&$this->category[$catid]['child']) {
$catids_str = $this->category[$catid]['arrchildid'];
$pos = strpos($catids_str,',')+1;
$catids_str = substr($catids_str,$pos);
$sql = "`catid` IN ($catids_str) AND ";
}elseif($catid &&!$this->category[$catid]['child']) {
$sql = "`catid` = '$catid' AND ";
}
if($thumb) $sql .= "`thumb` = '1' AND ";
if(isset($data['where'])) $sql .= $data['where'].' AND ';
if(isset($data['expiration']) &&$data['expiration']==1) $sql .= '(`expiration` >= \''.SYS_TIME.'\' OR `expiration` = \'0\' ) AND ';
if($moreposid)
{
$sql .= "`posid` in ($moreposid) AND `siteid` = '".$siteid."'";
}
else
{
$sql .= "`posid` = '$posid' AND `siteid` = '".$siteid."'";
}
$pos_arr = $this->position->select($sql,'*',$data['limit'],$order);
if(!empty($pos_arr)) {
foreach ($pos_arr as $info) {
$key = $info['catid'].'-'.$info['id'];
$array[$key] = string2array($info['data']);
$array[$key]['url'] = go($info['catid'],$info['id']);
$array[$key]['id'] = $info['id'];
$array[$key]['catid'] = $info['catid'];
$array[$key]['listorder'] = $info['listorder'];
}
}
return $array;
}
public function h5_tag() {
$positionlist = getcache('position','commons');
$sites = h5_base::load_app_class('sites','admin');
$sitelist = $sites->h5_tag_list();
foreach ($positionlist as $_v) if($_v['siteid'] == get_siteid() ||$_v['siteid'] == 0) $poslist[$_v['posid']] = $_v['name'];
return array(
'action'=>array('lists'=>L('list','','content'),'position'=>L('position','','content'),'category'=>L('subcat','','content'),'relation'=>L('related_articles','','content'),'hits'=>L('top','','content')),
'lists'=>array(
'catid'=>array('name'=>L('catid','','content'),'htmltype'=>'input_select_category','data'=>array('type'=>0),'validator'=>array('min'=>1)),
'order'=>array('name'=>L('sort','','content'),'htmltype'=>'select','data'=>array('id DESC'=>L('id_desc','','content'),'updatetime DESC'=>L('updatetime_desc','','content'),'listorder ASC'=>L('listorder_asc','','content'))),
'thumb'=>array('name'=>L('thumb','','content'),'htmltype'=>'radio','data'=>array('0'=>L('all_list','','content'),'1'=>L('thumb_list','','content'))),
'moreinfo'=>array('name'=>L('moreinfo','','content'),'htmltype'=>'radio','data'=>array('1'=>L('yes'),'0'=>L('no')))
),
'position'=>array(
'posid'=>array('name'=>L('posid','','content'),'htmltype'=>'input_select','data'=>$poslist,'validator'=>array('min'=>1)),
'catid'=>array('name'=>L('catid','','content'),'htmltype'=>'input_select_category','data'=>array('type'=>0),'validator'=>array('min'=>0)),
'thumb'=>array('name'=>L('thumb','','content'),'htmltype'=>'radio','data'=>array('0'=>L('all_list','','content'),'1'=>L('thumb_list','','content'))),
'order'=>array('name'=>L('sort','','content'),'htmltype'=>'select','data'=>array('listorder DESC'=>L('listorder_desc','','content'),'listorder ASC'=>L('listorder_asc','','content'),'id DESC'=>L('id_desc','','content'))),
),
'category'=>array(
'siteid'=>array('name'=>L('siteid'),'htmltype'=>'input_select','data'=>$sitelist),
'catid'=>array('name'=>L('catid','','content'),'htmltype'=>'input_select_category','data'=>array('type'=>0))
),
'relation'=>array(
'catid'=>array('name'=>L('catid','','content'),'htmltype'=>'input_select_category','data'=>array('type'=>0),'validator'=>array('min'=>1)),
'order'=>array('name'=>L('sort','','content'),'htmltype'=>'select','data'=>array('id DESC'=>L('id_desc','','content'),'updatetime DESC'=>L('updatetime_desc','','content'),'listorder ASC'=>L('listorder_asc','','content'))),
'relation'=>array('name'=>L('relevant_articles_id','','content'),'htmltype'=>'input'),
'keywords'=>array('name'=>L('key_word','','content'),'htmltype'=>'input')
),
'hits'=>array(
'catid'=>array('name'=>L('catid','','content'),'htmltype'=>'input_select_category','data'=>array('type'=>0),'validator'=>array('min'=>1)),
'day'=>array('name'=>L('day_select','','content'),'htmltype'=>'input','data'=>array('type'=>0)),
),
);
}
public function relationlp($data) {
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
$order = $data['order'];
$sql = "`status`=99";
$limit = $data['id'] ?$data['limit']+1 : $data['limit'];
if($data['xglp']) {
$relations = explode('|',trim($data['xglp'],'|'));
$relations = array_diff($relations,array(null));
$relations = implode(',',$relations);
$sql = " `id` IN ($relations)";
$key_array = $this->db->select($sql,'id,title,thumb,url,price,priceunit,address,tel,region,xszt,type,bbs',$limit,$order,'','id');
}
return $key_array;
}
public function salesinfo($data) {
$catid = intval($data['catid']);
$morecatid = $data['morecatid'];
if(!$this->set_modelid($catid)) return false;
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$order = $data['order'];
$sql = "`status`=99";
$limit = $data['id'] ?$data['limit']+1 : $data['limit'];
if($data['xglp']) {
$xglp = intval($data['xglp']);
$where = "where `xglp` = '$xglp'";
$rs = $this->db->query("SELECT id FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
}
$ids = implode(',',$ids);
$sql = " `id` in ($ids) and catid in ($morecatid)";
$this->db->table_name = $tablename;
$key_array = $this->db->select($sql,'id,title,description,url,inputtime',$limit,$order,'','id');
}
unset($result);
}
return $key_array;
}
public function progressinfo($data) {
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$order = $data['order'];
$sql = "`status`=99";
$limit = $data['id'] ?$data['limit']+1 : $data['limit'];
if($data['xglp']) {
$xglp = intval($data['xglp']);
$where = "where `xglp` = '$xglp'";
$rs = $this->db->query("SELECT id FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
}
$ids = implode(',',$ids);
$sql = " `id` in ($ids) and catid =$catid";
$this->db->table_name = $tablename;
$key_array = $this->db->select($sql,'id,title,description,url,inputtime',$limit,$order,'','id');
}
unset($result);
}
return $key_array;
}
public function jiageinfo($data) {
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$order = $data['order'];
$sql = "`status`=99";
$limit = $data['id'] ?$data['limit']+1 : $data['limit'];
if($data['relation']) {
$relation = intval($data['relation']);
$where = "where `relation` = '$relation'";
$rs = $this->db->query("SELECT id FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
}
$ids = implode(',',$ids);
$sql.= " and `id` in ($ids)";
$this->db->table_name = $tablename;
$key_array = $this->db->select($sql,'id,price,addtime,trend',$limit,$order,'','id');
}
}
return $key_array;
}
public function houseinfo($data) {
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$order = $data['order'];
$sql = "`status`=99";
$limit = $data['id'] ?$data['limit']+1 : $data['limit'];
if($data['relation']) {
$relations = explode('|',trim($data['relation'],'|'));
$relations = array_diff($relations,array(null));
$relations = implode(',',$relations);
$sql = " `id` IN ($relations)";
$key_array = $this->db->select($sql,'id,title,thumb,url,opentime,opentimetips,price,priceunit,character,address,jiaotong,tel,dzinfo',$limit,$order,'','id');
}
return $key_array;
}
public function fangyuaninfo($data) {
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$order = $data['order'];
$sql = "`status`=99";
$limit = $data['id'] ?$data['limit']+1 : $data['limit'];
if($data['relation'] ||isset($data['where'])) {
$relation = intval($data['relation']);
$where = "`relation` = '$relation'";
if(isset($data['where'])) {
$where = $data['where'];
}
$rs = $this->db->query("SELECT id FROM `$table_name` where $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
}
$ids = implode(',',$ids);
$sql.= " and `id` in ($ids)";
$this->db->table_name = $tablename;
$key_array = $this->db->select($sql,'id,title,thumb,fix,total_area,price,huxingshi,huxingting,huxingwei,house_num',$limit,$order,'','id');
}
}
return $key_array;
}
public function newsinfo($data) {
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$order = $data['order'];
$sql = "`status`=99";
$limit = $data['xglp'] ?$data['limit']+1 : $data['limit'];
if($data['xglp']) {
$xglp = intval($data['xglp']);
$where = "where `xglp` = '$xglp'";
$rs = $this->db->query("SELECT id FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
}
$ids = implode(',',$ids);
$sql = " `id` in ($ids)";
$this->db->table_name = $tablename;
$key_array = $this->db->select($sql,'id,title,catid,inputtime,url',$limit,$order,'','id');
}
unset($result);
}
return $key_array;
}
public function huxingtype($data){
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$order = $data['order'];
$sql = "`status`=99";
$limit = $data['id'] ?$data['limit']+1 : $data['limit'];
$group = 'typeid';
if($data['relation']) {
$relation = intval($data['relation']);
$where = "where `relation` = '$relation'";
$rs = $this->db->query("SELECT id FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
}
$ids = implode(',',$ids);
$sql.= " and `id` in ($ids) and catid='$catid'";
$this->db->table_name = $tablename;
$key_array = $this->db->select($sql,'id,typeid,count(typeid) as counts',$limit,$order,$group,'id');
}
}
return $key_array;
}
public function huxinginfo($data){
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$order = $data['order'];
$sql = "`status`=99";
$typeid = intval($data['typeid']);
if($data['relation']) {
$relation = intval($data['relation']);
$where = "where `relation` = '$relation'";
if($data['id'])
{
$pid = $data['id'];
$where.=" and id='$pid'";
}
$rs = $this->db->query("SELECT id,pictureurls FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
$res[$r[id]][pictureurls] = $r[pictureurls];
}
$ids = implode(',',$ids);
$sql.= " and `id` in ($ids) and catid='$catid'";
if($typeid)
{
$sql.="  and typeid='$typeid'";
}
$this->db->table_name = $tablename;
$key_array = $this->db->select($sql,'id,typeid,title',$limit,$order,'','id');
}
if($key_array)
{
foreach($key_array as $m =>$value)
{
$key_array[$m]['pictureurls'] = $res[$m]['pictureurls'];
}
}
unset($res);
}
return $key_array;
}
public function getlinkage($data) {
$keyid = intval($data['keyid']);
$datas = getcache($keyid,'linkage');
$infos = $datas['data'];
$where_id = isset($data['parentid']) ?$data['parentid'] : intval($infos[$_GET['linkageid']]['parentid']);
$parent_menu_name = ($where_id==0) ?$datas['title'] :$infos[$where_id]['name'];
foreach($infos AS $k=>$v) {
if($v['parentid'] == $where_id) {
$s[]=$v['linkageid'].'$$'.$v['name'];
}
}
return $s;
}
public function house_developer($data) {
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
if(isset($data['where'])) {
$sql = $data['where'];
}
$order = $data['order'];
$table_name = $this->db->table_name;
$this->db->table_name = $this->db->table_name.'_data';
$result = $this->db->select($sql,'id',$data['limit'],$order,'','id');
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
}
$ids = implode(',',$ids);
$sql = " `id` in ($ids)";
$this->db->table_name = $table_name;
$return = $this->db->select($sql,'id,title,price,priceunit,region,xszt,type',$data['limit'],$order,'','id');
return $return;
}
}
public function house_position($data) {
$sql = '';
$array = array();
$posid = intval($data['posid']);
$order = $data['order'];
$thumb = (empty($data['thumb']) ||intval($data['thumb']) == 0) ?0 : 1;
$regionid = intval($data['regionid']);
$siteid = $GLOBALS['siteid'] ?$GLOBALS['siteid'] : 1;
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
$siteids = getcache('category_content','commons');
if(!$siteids[$catid]) return false;
$siteid = $siteids[$catid];
$this->category = getcache('category_content_'.$siteid,'commons');
if($this->category[$catid]['child']) {
$catids_str = $this->category[$catid]['arrchildid'];
$pos = strpos($catids_str,',')+1;
$catids_str = substr($catids_str,$pos);
$sql = "`catid` IN ($catids_str) AND ";
}else{
$sql = "`catid` = '$catid' AND ";
}
if($thumb) $sql .= "`thumb` = '1' AND ";
if(isset($data['where'])) $sql .= $data['where'].' AND ';
if(isset($data['expiration']) &&$data['expiration']==1) $sql .= '(`expiration` >= \''.SYS_TIME.'\' OR `expiration` = \'0\' ) AND ';
$sql .= "`posid` = '$posid' AND `siteid` = '".$siteid."'";
$pos_arr = $this->position->select($sql,'id',$data['limit'],$order);
if(!empty($pos_arr)) {
foreach($pos_arr as $info)
{
$ids_array[]= $info['id'];
}
$ids = implode(',',$ids_array);
if($ids) {
$sql = "status=99 AND id IN ($ids)";
}else {
$sql = '';
}
if($regionid)
{
$arrchildid = get_arrchildid('3360',$regionid);
$sql.=" and `region` in ($arrchildid)";
}
$this->db->table_name = $this->tablename;
$result = $this->db->select($sql,'id,title,hot,character,region,thumb,price,priceunit,url,opentime,opentimetips,address,dzinfo',$data['limit'],'','','id');
}
return $result;
}
public function kanfangtuan_position($data) {
$sql = '';
$array = array();
$posid = intval($data['posid']);
$order = $data['order'];
$thumb = (empty($data['thumb']) ||intval($data['thumb']) == 0) ?0 : 1;
$regionid = intval($data['regionid']);
$siteid = $GLOBALS['siteid'] ?$GLOBALS['siteid'] : 1;
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
$siteids = getcache('category_content','commons');
if(!$siteids[$catid]) return false;
$siteid = $siteids[$catid];
$this->category = getcache('category_content_'.$siteid,'commons');
if($this->category[$catid]['child']) {
$catids_str = $this->category[$catid]['arrchildid'];
$pos = strpos($catids_str,',')+1;
$catids_str = substr($catids_str,$pos);
$sql = "`catid` IN ($catids_str) AND ";
}else{
$sql = "`catid` = '$catid' AND ";
}
if($thumb) $sql .= "`thumb` = '1' AND ";
if(isset($data['where'])) $sql .= $data['where'].' AND ';
if(isset($data['expiration']) &&$data['expiration']==1) $sql .= '(`expiration` >= \''.SYS_TIME.'\' OR `expiration` = \'0\' ) AND ';
$sql .= "`posid` = '$posid' AND `siteid` = '".$siteid."'";
$pos_arr = $this->position->select($sql,'id,catid,data',$data['limit'],$order);
if(!empty($pos_arr)) {
foreach($pos_arr as $info)
{
$ids_array[]= $info['id'];
$key = $info['id'];
$res[$key] = string2array($info['data']);
$res[$key]['url'] = go($info['catid'],$info['id']);
}
$ids = implode(',',$ids_array);
if($ids) {
$sql = "id IN ($ids)";
}else {
$sql = '';
}
if($regionid)
{
$arrchildid = get_arrchildid('3360',$regionid);
$sql.=" and `region` in ($arrchildid)";
}
$this->db->table_name = $this->tablename.'_data';
$result = $this->db->select($sql,'id,xglp',$data['limit'],'','','id');
foreach ($result as $r) {
$id = $r['id'];
$array[$id] = $result[$id];
$array[$id] = array_merge($array[$id],$res[$id]);
}
}
return $array;
}
public function tuangouhouseinfo($data) 
{
$this->db = h5_base::load_model('sitemodel_model');
$siteid = $data['siteid'] &&intval($data['siteid']) ?intval($data['siteid']) : get_siteid();
$formid = intval($data['formid']);
$r = $this->db->get_one(array('modelid'=>$formid,'siteid'=>$siteid,'disabled'=>0),'tablename, setting');
$this->tablename = 'form_'.$r['tablename'];
$rs = $this->db->query("select count(relation) as counts,relation,subject,regionid from h5_form_tuangou group by relation order by count(relation) desc limit 10");
$result = $this->db->fetch_array($rs);
return $result;
}
public function tuangouinfo($data) 
{
$this->db = h5_base::load_model('sitemodel_model');
$siteid = $data['siteid'] &&intval($data['siteid']) ?intval($data['siteid']) : get_siteid();
$formid = intval($data['formid']);
$r = $this->db->get_one(array('modelid'=>$formid,'siteid'=>$siteid,'disabled'=>0),'tablename, setting');
$this->tablename = 'form_'.$r['tablename'];
$rs = $this->db->query("select tel,subject from h5_form_tuangou order by datetime desc limit 10");
$result = $this->db->fetch_array($rs);
return $result;
}
public function regioncount($data) {
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
$where = $data["where"];
if(!$where) return false;
$r = $this->db->get_one($where,"COUNT(*) AS num");
return $r['num'];
}
public function house_hits($data) {
$catid = intval($data['catid']);
$sql = ' status=99';
if(!$this->set_modelid($catid)) return false;
if(isset($data['type']))
{
$type = trim($data['type']);
if(strpos($type,'|')!==false)
{
$_v = explode('|',$type);
$sql.= " AND (";
foreach ($_v as $t =>$c) {
if(intval($c))
{
if($t>0)
{
$sql.=" or ";
}
$sql.= " `type` like '%$c%'";
}
}
$sql.= ")";
}
}
elseif(isset($data['character']))
{
$character = trim($data['character']);
$sql.= " AND `character` like '%$character%'";
}
$result = $this->db->select($sql,'id,title,region','','','','id');
foreach ($result as $r) {
$ids_array[] = $r['id'];
}
foreach ($ids_array as $id) {
$hitsid_array[] = "'".'c-'.$this->modelid.'-'.$id."'";
}
$hitsids = implode(',',$hitsid_array);
if($hitsids) {
$sql = "hitsid IN ($hitsids)";
}else {
$sql = '';
}
$this->hits_db = h5_base::load_model('hits_model');
$order = $data['order'];
if(isset($data['day'])) {
$updatetime = SYS_TIME-intval($data['day'])*86400;
$sql .= " AND updatetime>'$updatetime'";
}
$hits = array();
$res = $this->hits_db->select($sql,'*',$data['limit'],$order);
foreach ($res as $r) {
$pos = strpos($r['hitsid'],'-',2) +1;
$ids_array2[] = $id = substr($r['hitsid'],$pos);
$hits[$id] = $r;
}
foreach ($ids_array2 as $id) {
if($result[$id]['title']!='') {
$array[$id] = $result[$id];
$array[$id] = array_merge($array[$id],$hits[$id]);
}
}
return $array;
}
public function dianpinginfo($data) {
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$this->db->table_name = $table_name;
$order = $data['order'];
$sql = "`status`=99";
$limit = $data['id'] ?$data['limit']+1 : $data['limit'];
if($data['relation']) {
$relation = intval($data['relation']);
$where = "`relation` = '$relation'";
$result = $this->db->get_one($where,'id,advantage,disadvantage,zongjie',$order,'');
}
return $result;
}
public function pictypecount($data) {
$catid = intval($data['catid']);
$relation = intval($data['relation']);
$typeid = intval($data['typeid']);
if(!$this->set_modelid($catid)) return false;
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$sql = "`status`=99";
if($data['relation']) {
$relation = intval($data['relation']);
$where = "where `relation` = '$relation'";
$rs = $this->db->query("SELECT id FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
}
$ids = implode(',',$ids);
$sql.= " and `id` in ($ids) and catid='$catid'";
if(!empty($typeid))
{
$sql.= " and typeid='$typeid'";
}
$rs2 = $this->db->query("SELECT id FROM `$tablename` where $sql");
$result2 = $this->db->fetch_array($rs2);
if($result2)
{
foreach($result2 as $r2)
{
$ids2[]= $r2[id];
}
$ids2 = implode(',',$ids2);
}
if(!empty($ids2))
{
$sql2 = "where id in ($ids2)";
$rs = $this->db->query("SELECT id,pictureurls FROM `$table_name` $sql2");
$key_array = $this->db->fetch_array($rs);
if(empty($key_array))
{
return 0;
}
}
else
{
return 0 ;
}
}
}
$count = 0;
foreach ($key_array as $v) {
if (isset($v['pictureurls']) &&!empty($v['pictureurls'])) {
$count+= count(string2array($v['pictureurls']));
}else {
continue;
}
}
return $count;
}
public function salescount($data) {
$catid = intval($data['catid']);
$morecatid = $data['morecatid'];
if(!$this->set_modelid($catid)) return false;
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$order = $data['order'];
$sql = "`status`=99";
$limit = $data['id'] ?$data['limit']+1 : $data['limit'];
if($data['xglp']) {
$xglp = intval($data['xglp']);
$where = "where `xglp` = '$xglp'";
$rs = $this->db->query("SELECT id FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
}
$ids = implode(',',$ids);
$sql = " `id` in ($ids) and catid in ($morecatid)";
$this->db->table_name = $tablename;
$key_array = $this->db->select($sql,'id',$limit,$order,'','id');
}
else
{
return 0;
}
unset($result);
}
return count($key_array);
}
public function pricelist($data) {
$catid = intval($data['catid']);
$pricecatid = intval($data['pricecatid']);
$region = intval($data['region']);
if(!$this->set_modelid($catid)) return false;
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$order = $data['order'];
$sql = "`status`=99";
$arrchildid = get_arrchildid('3360',$region);
$sql.=" and `region` in ($arrchildid)";
$limit = $data['id'] ?$data['limit']+1 : $data['limit'];
$result = $this->db->select($sql,'id,title,price,priceunit',$limit,$order,'','id');
if($result)
{
foreach($result as $k=>$r)
{
$result[$k]['trend'] = 0;
$relation= $r[id];
$this->set_modelid($pricecatid);
$where = "`relation` = '$relation'";
$tablename = $this->db->table_name;
$this->db->table_name = $tablename.'_data';
$re = $this->db->get_one($where,'id','id desc','');
if($re)
{
$theid = $re['id'];
$where = "`id` = '$theid'";
$this->db->table_name = $tablename;
$res = $this->db->get_one($where,'price,trend','','');
$result[$k]['price'] = $res['price'];
$result[$k]['trend'] = $res['trend'];
}
}
return $result;
}
else
{
return 0;
}
}
public function huxinginfoprevious($data){
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$order = $data['order'];
$sql = "`status`=99";
$typeid = intval($data['typeid']);
if($data['relation']) {
$relation = intval($data['relation']);
$where = "where `relation` = '$relation'";
$pid = $data['id'];
$rs = $this->db->query("SELECT id,pictureurls FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
$res[$r[id]][pictureurls] = $r[pictureurls];
}
$ids = implode(',',$ids);
$sql.= " and `id` in ($ids) and id<'$pid' and catid='$catid'";
if($typeid)
{
$sql.="  and typeid='$typeid'";
}
$this->db->table_name = $tablename;
$key_array = $this->db->get_one($sql,'id,typeid,title',$limit,$order,'','id');
}
if($key_array)
{
$m = $key_array[id];
foreach(string2array($res[$m]['pictureurls']) as $k=>$r)
{
if($k==0)
{
$key_array['thumb'] = $r[url];
}
}
}
unset($res);
}
return $key_array;
}
public function huxinginfonext($data){
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$order = $data['order'];
$sql = "`status`=99";
$typeid = intval($data['typeid']);
if($data['relation']) {
$relation = intval($data['relation']);
$where = "where `relation` = '$relation'";
$pid = $data['id'];
$rs = $this->db->query("SELECT id,pictureurls FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
$res[$r[id]][pictureurls] = $r[pictureurls];
}
$ids = implode(',',$ids);
$sql.= " and `id` in ($ids) and id>'$pid' and catid='$catid'";
if($typeid)
{
$sql.="  and typeid='$typeid'";
}
$this->db->table_name = $tablename;
$key_array = $this->db->get_one($sql,'id,typeid,title',$limit,$order,'','id');
}
if($key_array)
{
$m = $key_array[id];
foreach(string2array($res[$m]['pictureurls']) as $k=>$r)
{
if($k==0)
{
$key_array['thumb'] = $r[url];
}
}
}
unset($res);
}
return $key_array;
}
public function esf_houseinfo($data) {
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$order = $data['order'];
$id = intval($data['id']);
$limit = $data['relation'] ?$data['limit']+1 : $data['limit'];
if($data['relation']) {
$relation = intval($data['relation']);
$where = "where `relation` = '$relation' and id<>'$id'";
$rs = $this->db->query("SELECT id FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
}
$ids = implode(',',$ids);
$sql = " `id` in ($ids) and status='99'";
$this->db->table_name = $tablename;
$key_array = $this->db->select($sql,'id,title,thumb,price,huxingshi,huxingting,huxingwei,total_area',$limit,$order,'','id');
}
unset($result);
}
return $key_array;
}
public function salecount($data) {
$catid = intval($data['catid']);
if(!$this->set_modelid($catid)) return false;
$tablename = $this->db->table_name;
$table_name = $tablename.'_data';
$sql = "`status`=99";
$limit = $data['id'] ?$data['limit']+1 : $data['limit'];
if($data['relation']) {
$xglp = intval($data['relation']);
$where = "where `relation` = '$xglp'";
$rs = $this->db->query("SELECT id FROM `$table_name` $where");
$result = $this->db->fetch_array($rs);
if($result)
{
foreach($result as $r)
{
$ids[]= $r[id];
}
$ids = implode(',',$ids);
$sql = " `id` in ($ids)";
$this->db->table_name = $tablename;
$key_array = $this->db->select($sql,'id',$limit,$order,'','id');
}
else
{
return 0;
}
unset($result);
}
return count($key_array);
}
}
?>