<?php

defined('IN_HOUSE5') or exit('Access Denied');
defined('INSTALL') or exit('Access Denied');
$parentid = $menu_db->insert(array('name'=>'ssi','parentid'=>826,'m'=>'ssi','c'=>'ssi','a'=>'init','data'=>'','listorder'=>0,'display'=>'1'),true);
$menu_db->insert(array('name'=>'add_ssi','parentid'=>$parentid,'m'=>'ssi','c'=>'ssi','a'=>'add','data'=>'','listorder'=>0,'display'=>'0'));
$menu_db->insert(array('name'=>'edit_ssi','parentid'=>$parentid,'m'=>'ssi','c'=>'ssi','a'=>'edit','data'=>'','listorder'=>0,'display'=>'0'));
$menu_db->insert(array('name'=>'delete_ssi','parentid'=>$parentid,'m'=>'ssi','c'=>'ssi','a'=>'del','data'=>'','listorder'=>0,'display'=>'0'));
$menu_db->insert(array('name'=>'ssi_lists','parentid'=>$parentid,'m'=>'ssi','c'=>'ssi','a'=>'lists','data'=>'','listorder'=>0,'display'=>'0'));
$language = array('ssi'=>'ssi��Ƭ','add_ssi'=>'���ssi��Ƭ','edit_ssi'=>'�޸�ssi��ǩ','delete_ssi'=>'ɾ��ssi��ǩ','ssi_lists'=>'ssi��ǩ�б�');
?>