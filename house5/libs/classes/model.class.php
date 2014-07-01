<?php
 
defined('IN_HOUSE5') or exit('Access Denied');
h5_base::load_sys_class('db_factory','',0);
class model {
protected $db_config = '';
protected $db = '';
protected $db_setting = 'default';
protected $table_name = '';
public  $db_tablepre = '';
public function __construct() {
if (!isset($this->db_config[$this->db_setting])) {
$this->db_setting = 'default';
}
$this->table_name = $this->db_config[$this->db_setting]['tablepre'].$this->table_name;
$this->db_tablepre = $this->db_config[$this->db_setting]['tablepre'];
$this->db = db_factory::get_instance($this->db_config)->get_database($this->db_setting);
}
final public function select($where = '',$data = '*',$limit = '',$order = '',$group = '',$key='') {
if (is_array($where)) $where = $this->sqls($where);
return $this->db->select($data,$this->table_name,$where,$limit,$order,$group,$key);
}
final public function listinfo($where = '',$order = '',$page = 1,$pagesize = 20,$key='',$setpages = 10,$urlrule = '',$array = array()) {
$where = to_sqls($where);
$this->number = $this->count($where);
$page = max(intval($page),1);
$offset = $pagesize*($page-1);
$this->pages = pages($this->number,$page,$pagesize,$urlrule,$array,$setpages);
$array = array();
if ($this->number >0) {
return $this->select($where,'*',"$offset, $pagesize",$order,'',$key);
}else {
return array();
}
}
final public function get_one($where = '',$data = '*',$order = '',$group = '') {
if (is_array($where)) $where = $this->sqls($where);
return $this->db->get_one($data,$this->table_name,$where,$order,$group);
}
final public function query($sql) {
$sql = str_replace('house5_',$this->db_tablepre,$sql);
return $this->db->query($sql);
}
final public function insert($data,$return_insert_id = false,$replace = false) {
return $this->db->insert($data,$this->table_name,$return_insert_id,$replace);
}
final public function insert_id() {
return $this->db->insert_id();
}
final public function update($data,$where = '') {
if (is_array($where)) $where = $this->sqls($where);
return $this->db->update($data,$this->table_name,$where);
}
final public function delete($where) {
if (is_array($where)) $where = $this->sqls($where);
return $this->db->delete($this->table_name,$where);
}
final public function count($where = '') {
$r = $this->get_one($where,"COUNT(*) AS num");
return $r['num'];
}
final public function sqls($where,$font = ' AND ') {
if (is_array($where)) {
$sql = '';
foreach ($where as $key=>$val) {
$sql .= $sql ?" $font `$key` = '$val' ": " `$key` = '$val'";
}
return $sql;
}else {
return $where;
}
}
final public function affected_rows() {
return $this->db->affected_rows();
}
final public function get_primary() {
return $this->db->get_primary($this->table_name);
}
final public function get_fields($table_name = '') {
if (empty($table_name)) {
$table_name = $this->table_name;
}else {
$table_name = $this->db_tablepre.$table_name;
}
return $this->db->get_fields($table_name);
}
final public function table_exists($table){
return $this->db->table_exists($this->db_tablepre.$table);
}
public function field_exists($field) {
$fields = $this->db->get_fields($this->table_name);
return array_key_exists($field,$fields);
}
final public function list_tables() {
return $this->db->list_tables();
}
final public function fetch_array() {
$data = array();
while($r = $this->db->fetch_next()) {
$data[] = $r;
}
return $data;
}
final public function version() {
return $this->db->version();
}
}?>