<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_app_class('admin','admin',0);
h5_base::load_sys_class('format','',0);
class member_ucenter extends admin {
private $db;
function __construct() {
parent::__construct();
$this->db = h5_base::load_model('module_model');
}
function manage() {
$setconfig = h5_base::load_config('uc');
extract($setconfig);
include $this->admin_tpl('member_ucenter');
}
public function save() {
$setting = array();
$setting['ucuse'] = intval($_POST['setting']['ucuse']);
$setting['uc_api'] = trim($_POST['setting']['uc_api']);
$setting['uc_ip'] = trim($_POST['setting']['uc_ip']);
$setting['uc_dbhost'] = trim($_POST['setting']['uc_dbhost']);
$setting['uc_dbuser'] = trim($_POST['setting']['uc_dbuser']);
$setting['uc_dbpw'] = trim($_POST['setting']['uc_dbpw']);
$setting['uc_dbname'] = trim($_POST['setting']['uc_dbname']);
$setting['uc_dbtablepre'] = trim($_POST['setting']['uc_dbtablepre']);
if(strpos($setting['uc_dbtablepre'],$setting['uc_dbname'])===FALSE)
{
$setting['uc_dbtablepre'] = $setting['uc_dbname'].'.'.trim($_POST['setting']['uc_dbtablepre']);
}
$setting['uc_dbcharset'] = trim($_POST['setting']['uc_dbcharset']);
$setting['uc_appid'] = intval($_POST['setting']['uc_appid']);
$setting['uc_key'] = trim($_POST['setting']['uc_key']);
$configfile = CACHE_PATH.'configs'.DIRECTORY_SEPARATOR.'uc.php';
if(!is_writable($configfile)) showmessage('Please chmod '.$configfile.' to 0777 !');
$pattern = $replacement = array();
foreach($setting as $k=>$v) {
if(in_array($k,array('ucuse','uc_api','uc_ip','uc_dbhost','uc_dbuser','uc_dbpw','uc_dbname','uc_dbtablepre','uc_dbcharset','uc_appid','uc_key'))) {
$v = trim($v);
$configs[$k] = $v;
$pattern[$k] = "/'".$k."'\s*=>\s*([']?)[^']*([']?)(\s*),/is";
$replacement[$k] = "'".$k."' => \${1}".$v."\${2}\${3},";
}
}
$str = file_get_contents($configfile);
$str = preg_replace($pattern,$replacement,$str);
h5_base::load_config('uc','lock_ex') ?file_put_contents($configfile,$str,LOCK_EX) : file_put_contents($configfile,$str);
showmessage(L('setting_succ'),HTTP_REFERER);
}
}
?>