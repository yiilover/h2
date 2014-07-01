<?php

class import_test {
var $con;
public static function testdb($dbtype,$dbhost,$dbuser,$dbpw,$dbname) {
global $con;
$db_conf = array();
$db_conf['import_array'] = array();
$db_conf['import_array']['type']= $dbtype;
$db_conf['import_array']['hostname']= $dbhost;
$db_conf['import_array']['username']= $dbuser;
$db_conf['import_array']['password']= $dbpw;
$db_conf['import_array']['database']= $dbname;
h5_base::load_sys_class('db_factory');
$thisdb = db_factory::get_instance($db_conf)->get_database('import_array');
$link = $thisdb->connect();
if($link){
return 'OK';
}else {
return 'false';
}
}
}
?>