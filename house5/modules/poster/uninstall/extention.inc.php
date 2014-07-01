<?php
 
defined('IN_HOUSE5') or exit('Access Denied');
defined('UNINSTALL') or exit('Access Denied');
$poster_stat = h5_base::load_model('poster_stat_model');
$diff1 = date('Y',SYS_TIME);
$diff2 = date('m',SYS_TIME);
$diff = ($diff1-2010)*12+$diff2;
for($y=$diff;$y>0;$y--) {
$value = date('Ym',mktime(0,0,0,$y,1,2010));
if($value<'201006'||!$this->db->table_exists($this->db_tablepre.'poster_'.$value)) break;
$poster_stat->query("DROP TABLE IF EXISTS `".$this->db_tablepre."poster_".$value."`");
}
?>