<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_sys_class('model','',0);
class badword_model extends model {
public $table_name = '';
public function __construct() {
$this->db_config = h5_base::load_config('database');
$this->db_setting = 'default';
$this->table_name = 'badword';
parent::__construct();
}
function replace_badword($str) {
$badword_cache = getcache('badword','commons');
foreach($badword_cache as $data){
if($data['replaceword'] == ''){
$replaceword_new ='*';
}else {
$replaceword_new = $data['replaceword'];
}
$replaceword[] = ($data['level']=='1') ?$replaceword_new : '';
$replace[] = $data['badword'];
}
$str = str_replace($replace,$replaceword,$str);
return $str;
}
}
?>