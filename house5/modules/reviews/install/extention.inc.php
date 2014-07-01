<?php

defined('IN_HOUSE5') or exit('Access Denied');
defined('INSTALL') or exit('Access Denied');
$parentid = $menu_db->insert(array('name'=>'reviews_setting','parentid'=>'29','m'=>'reviews','c'=>'reviews_admin','a'=>'setting','data'=>'','listorder'=>0,'display'=>'1'),true);
$menu_db->insert(array('name'=>'reviews_check','parentid'=>$parentid,'m'=>'reviews','c'=>'check','a'=>'checks','data'=>'','listorder'=>0,'display'=>'1'));
$menu_db->insert(array('name'=>'reviews_list','parentid'=>$parentid,'m'=>'reviews','c'=>'reviews_admin','a'=>'lists','data'=>'','listorder'=>0,'display'=>'1'));
$language = array('reviews_setting'=>'点评配置','reviews_check'=>'点评审核 ','reviews_list'=>'点评列表');
?>