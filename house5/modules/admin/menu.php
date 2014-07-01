<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
class menu extends admin {
function __construct() {
parent::__construct();
$this->db = h5_base::load_model('menu_model');
}
function init () {
$tree = h5_base::load_sys_class('tree');
$tree->icon = array('&nbsp;&nbsp;&nbsp;�� ','&nbsp;&nbsp;&nbsp;���� ','&nbsp;&nbsp;&nbsp;���� ');
$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
$userid = $_SESSION['userid'];
$admin_username = param::get_cookie('admin_username');
$table_name = $this->db->table_name;
$result = $this->db->select('','*','','listorder ASC,id DESC');
$array = array();
foreach($result as $r) {
$r['cname'] = L($r['name']);
$r['str_manage'] = '<a href="?s=admin/menu/add&parentid='.$r['id'].'&menuid='.$_GET['menuid'].'">'.L('add_submenu').'</a> | <a href="?s=admin/menu/edit&id='.$r['id'].'&menuid='.$_GET['menuid'].'">'.L('modify').'</a> | <a href="javascript:confirmurl(\'?s=admin/menu/delete&id='.$r['id'].'&menuid='.$_GET['menuid'].'\',\''.L('confirm',array('message'=>$r['cname'])).'\')">'.L('delete').'</a> ';
$array[] = $r;
}
$str  = "<tr>
					<td align='center'><input name='listorders[\$id]' type='text' size='3' value='\$listorder' class='input-text-c'></td>
					<td align='center'>\$id</td>
					<td >\$spacer\$cname</td>
					<td align='center'>\$str_manage</td>
				</tr>";
$tree->init($array);
$categorys = $tree->get_tree(0,$str);
include $this->admin_tpl('menu');
}
function add() {
if(isset($_POST['dosubmit'])) {
$this->db->insert($_POST['info']);
$file = H5_PATH.'languages'.DIRECTORY_SEPARATOR.'zh-cn'.DIRECTORY_SEPARATOR.'system_menu.lang.php';
if(file_exists($file)) {
$content = file_get_contents($file);
$content = substr($content,0,-2);
$key = $_POST['info']['name'];
$data = $content."\$LANG['$key'] = '$_POST[language]';\r\n?>";
file_put_contents($file,$data);
}else {
$key = $_POST['info']['name'];
$data = "<?php\r\n\$LANG['$key'] = '$_POST[language]';\r\n?>";
file_put_contents($file,$data);
}
showmessage(L('add_success'));
}else {
$show_validator = '';
$tree = h5_base::load_sys_class('tree');
$result = $this->db->select();
$array = array();
foreach($result as $r) {
$r['cname'] = L($r['name']);
$r['selected'] = $r['id'] == $_GET['parentid'] ?'selected': '';
$array[] = $r;
}
$str  = "<option value='\$id' \$selected>\$spacer \$cname</option>";
$tree->init($array);
$select_categorys = $tree->get_tree(0,$str);
include $this->admin_tpl('menu');
}
}
function delete() {
$_GET['id'] = intval($_GET['id']);
$this->db->delete(array('id'=>$_GET['id']));
showmessage(L('operation_success'));
}
function edit() {
if(isset($_POST['dosubmit'])) {
$id = intval($_POST['id']);
$this->db->update($_POST['info'],array('id'=>$id));
$file = H5_PATH.'languages'.DIRECTORY_SEPARATOR.'zh-cn'.DIRECTORY_SEPARATOR.'system_menu.lang.php';
require $file;
$key = $_POST['info']['name'];
if(!isset($LANG[$key])) {
$content = file_get_contents($file);
$content = substr($content,0,-2);
$data = $content."\$LANG['$key'] = '$_POST[language]';\r\n?>";
file_put_contents($file,$data);
}elseif(isset($LANG[$key]) &&$LANG[$key]!=$_POST['language']) {
$content = file_get_contents($file);
$content = str_replace($LANG[$key],$_POST['language'],$content);
file_put_contents($file,$content);
}
showmessage(L('operation_success'));
}else {
$show_validator = $array = $r = '';
$tree = h5_base::load_sys_class('tree');
$id = intval($_GET['id']);
$r = $this->db->get_one(array('id'=>$id));
if($r) extract($r);
$result = $this->db->select();
foreach($result as $r) {
$r['cname'] = L($r['name']);
$r['selected'] = $r['id'] == $parentid ?'selected': '';
$array[] = $r;
}
$str  = "<option value='\$id' \$selected>\$spacer \$cname</option>";
$tree->init($array);
$select_categorys = $tree->get_tree(0,$str);
include $this->admin_tpl('menu');
}
}
function listorder() {
if(isset($_POST['dosubmit'])) {
foreach($_POST['listorders'] as $id =>$listorder) {
$this->db->update(array('listorder'=>$listorder),array('id'=>$id));
}
showmessage(L('operation_success'));
}else {
showmessage(L('operation_failure'));
}
}
}
?>