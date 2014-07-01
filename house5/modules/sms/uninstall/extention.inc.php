<?php

defined('IN_HOUSE5') or exit('Access Denied');
defined('UNINSTALL') or exit('Access Denied');
$type_db = h5_base::load_model('type_model');
$typeid = $type_db->delete(array('module'=>'sms'));
if(!$typeid) return FALSE;
;echo ' ';?>