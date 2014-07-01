<?php

defined('IN_HOUSE5') or exit('No permission resources.');
h5_base::load_sys_class('model','',0);
class reviews_table_model extends model {
public $table_name;
public function __construct() {
$this->db_config = h5_base::load_config('database');
$this->db_setting = 'reviews';
$this->table_name = 'reviews_table';
parent::__construct();
}
public function edit_total($tableid,$num) {
return $this->update(array('total'=>$num),array('tableid'=>$tableid));
}
public function creat_table($id = '') {
if (empty($id)) {
$id = $this->insert(array('creat_at'=>SYS_TIME),true);
}
if ($this->query("CREATE TABLE `".$this->db_tablepre."reviews_data_".$id."` (`id` int(10) unsigned NOT NULL auto_increment,`commentid` char(30) NOT NULL default '',`siteid` smallint(5) NOT NULL default '0',`userid` int(10) unsigned default '0',`username` varchar(20) default NULL,`creat_at` int(10) default 0,`ip` varchar(15) default NULL,`status` tinyint(1) default '0',`content` text,`direction` tinyint(1) default '0',`support` mediumint(8) unsigned default '0',`reply` tinyint(1) NOT NULL default '0',PRIMARY KEY  (`id`),KEY `commentid` (`commentid`),KEY `direction` (`direction`), KEY `siteid` (`siteid`),KEY `support` (`support`)) ENGINE=MyISAM DEFAULT CHARSET=".$this->db_config[$this->db_setting]['charset'].";")) {
return $id;
}else {
return false;
}
}
}
?>