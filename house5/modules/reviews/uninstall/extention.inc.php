<?php

defined('IN_HOUSE5') or exit('Access Denied');
defined('UNINSTALL') or exit('Access Denied');
$reviews_table_db = h5_base::load_model('reviews_table_model');
$tablelist = $reviews_table_db->select('','tableid');
foreach($tablelist as $k=>$v) {
$reviews_table_db->query("DROP TABLE IF EXISTS `".$reviews_table_db->db_tablepre."reviews_data_".$v['tableid']."`;");
}
;echo ' ';?>