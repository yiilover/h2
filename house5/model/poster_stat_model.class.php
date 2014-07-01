<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_sys_class('model','',0);
class poster_stat_model extends model {
function __construct() {
$this->db_config = h5_base::load_config('database');
$this->db_setting = 'default';
$this->table_name = 'poster_'.date('Ym');
parent::__construct();
if(!$this->db->table_exists($this->table_name)) {
$this->create_table();
}
}
private function create_table() {
$data_info = h5_base::load_config('database',$this->db_setting);
$charset = $data_info['charset'];
$sql = "CREATE TABLE IF NOT EXISTS `".$this->table_name."` (
  		`id` int(10) unsigned NOT NULL auto_increment,
  		`pid` smallint(5) unsigned NOT NULL default '0',
  		`siteid` smallint(5) unsigned NOT NULL default '0',
  		`spaceid` smallint(5) unsigned NOT NULL default '0',
  		`username` char(20) NOT NULL,
  		`area` char(40) NOT NULL,
  		`ip` char(15) NOT NULL,
  		`referer` char(120) NOT NULL,
  		`clicktime` int(10) unsigned NOT NULL default '0',
  		`type` tinyint(1) unsigned NOT NULL default '1',
  		PRIMARY KEY  (`id`),
  		KEY `pid` (`pid`,`type`,`ip`)
		) TYPE=MyISAM DEFAULT CHARSET=".$charset." ;";
if($this->db->version() >'4.1') {
$sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/","ENGINE=\\1 DEFAULT CHARSET=".$charset,$sql);
}
$this->db->query($sql);
}
private function change_table($tablename = '') {
if ($tablename) $this->table_name = $this->db_tablepre.'poster_'.$tablename;
}
public function get_list($year = '') {
$year = isset($year) ?$year : '';
if($year) {
$this->change_table($year);
}
$this->change_table($year);
$diff1 = date('Y',SYS_TIME);
$diff2 = date('m',SYS_TIME);
$diff = ($diff1-2010)*12+$diff2;
$selectstr = '';
for($y=$diff;$y>0;$y--) {
$value = date('Ym',mktime(0,0,0,$y,1,2010));
if($value<'201006'||!$this->db->table_exists($this->db_tablepre.'poster_'.$value)) break;
$selected = $year==$value ?'selected': '';
$selectstr .= "<option value='$value' $selected>".date("Y-m",mktime(0,0,0,$y,1,2010));
}
return $selectstr;
}
}
?>