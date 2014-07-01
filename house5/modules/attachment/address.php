<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
class address extends admin {
public function __construct() {
parent::__construct();
}
public function init() {
include $this->admin_tpl('address');
}
public function update() {
set_time_limit(120);
$old_attachment_path = isset($_POST['old_attachment_path']) &&trim($_POST['old_attachment_path']) ?trim($_POST['old_attachment_path']) : showmessage(L('old_attachment_address_empty'));
$new_attachment_path = isset($_POST['new_attachment_path']) &&trim($_POST['new_attachment_path']) ?trim($_POST['new_attachment_path']) : showmessage(L('new_attachment_address_empty'));
$db = h5_base::load_model('site_model');
$r = $db->query("show tables");
$r = $db->fetch_array($db_list);
foreach ($r as $k=>$v) {
$v = array_pop($v);
if (strpos($v,$db->db_tablepre)===false) continue;
$table_name = str_replace($db->db_tablepre,'',$v);
if (!$modle_table_db = h5_base::load_model($table_name.'_model')) {
$modle_table_db = $db;
}
$s = $modle_table_db->get_fields($table_name);
if ($s) {
$sql = '';
foreach ($s as $key=>$val) {
if (preg_match('/(char|text|mediumtext)+/i',$val)) {
$sql .= !empty($sql) ?", `$key`=replace(`$key`, '$old_attachment_path', '$new_attachment_path')": "`$key`=replace(`$key`, '$old_attachment_path', '$new_attachment_path')";
}
}
if (!empty($sql)) $modle_table_db->query("UPDATE ".$db->db_tablepre.$table_name." SET $sql");
}
}
showmessage(L('operation_success'));
}
}
?>