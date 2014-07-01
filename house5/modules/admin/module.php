<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
class module extends admin {
private $db;
public function __construct() {
$this->db = h5_base::load_model('module_model');
parent::__construct();
}
public function init() {
$dirs = $module = $dirs_arr = $directory = array();
$dirs = glob(H5_PATH.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.'*');
foreach ($dirs as $d) {
if (is_dir($d)) {
$d = basename($d);
$dirs_arr[] = $d;
}
}
define('INSTALL',true);
$modules = $this->db->select('','*','','','','module');
$total = count($dirs_arr);
$dirs_arr = array_chunk($dirs_arr,20,true);
$page = max(intval($_GET['page']),1);
$pages = pages($total,$page,20);
$directory = $dirs_arr[intval($page-1)];
include $this->admin_tpl('module_list');
}
public function install() {
$this->module = $_POST['module'] ?$_POST['module'] : $_GET['module'];
$module_api = h5_base::load_app_class('module_api');
if (!$module_api->check($this->module)) showmessage($module_api->error_msg,'blank');
if ($_POST['dosubmit']) {
if ($module_api->install()) showmessage(L('success_module_install').L('update_cache'),'?s=admin/module/cache/h5_hash/'.$_SESSION['h5_hash']);
else showmesage($module_api->error_msg,HTTP_REFERER);
}else {
include H5_PATH.'modules'.DIRECTORY_SEPARATOR.$this->module.DIRECTORY_SEPARATOR.'install'.DIRECTORY_SEPARATOR.'config.inc.php';
include $this->admin_tpl('module_config');
}
}
public function uninstall() {
if(!isset($_GET['module']) ||empty($_GET['module'])) showmessage(L('illegal_parameters'));
$module_api = h5_base::load_app_class('module_api');
if(!$module_api->uninstall($_GET['module'])) showmessage($module_api->error_msg,'blank');
else showmessage(L('uninstall_success'),'?s=admin/module/cache/h5_hash/'.$_SESSION['h5_hash']);
}
public function cache() {
echo '<script type="text/javascript">parent.right.location.href = \'?s=admin/cache_all/init/h5_hash/'.$_SESSION['h5_hash'].'\';window.top.art.dialog({id:\'install\'}).close();</script>';
}
}
?>