<?php

defined('IN_HOUSE5') or exit('Access Denied');
defined('INSTALL') or exit('Access Denied');
$parentid = $menu_db->insert(array('name'=>'link','parentid'=>29,'m'=>'link','c'=>'link','a'=>'init','data'=>'','listorder'=>0,'display'=>'1'),true);
$menu_db->insert(array('name'=>'add_link','parentid'=>$parentid,'m'=>'link','c'=>'link','a'=>'add','data'=>'','listorder'=>0,'display'=>'0'));
$menu_db->insert(array('name'=>'edit_link','parentid'=>$parentid,'m'=>'link','c'=>'link','a'=>'edit','data'=>'','listorder'=>0,'display'=>'0'));
$menu_db->insert(array('name'=>'delete_link','parentid'=>$parentid,'m'=>'link','c'=>'link','a'=>'delete','data'=>'','listorder'=>0,'display'=>'0'));
$menu_db->insert(array('name'=>'link_setting','parentid'=>$parentid,'m'=>'link','c'=>'link','a'=>'setting','data'=>'','listorder'=>0,'display'=>'1'));
$menu_db->insert(array('name'=>'add_type','parentid'=>$parentid,'m'=>'link','c'=>'link','a'=>'add_type','data'=>'','listorder'=>0,'display'=>'1'));
$menu_db->insert(array('name'=>'list_type','parentid'=>$parentid,'m'=>'link','c'=>'link','a'=>'list_type','data'=>'','listorder'=>0,'display'=>'1'));
$menu_db->insert(array('name'=>'check_register','parentid'=>$parentid,'m'=>'link','c'=>'link','a'=>'check_register','data'=>'','listorder'=>0,'display'=>'1'));
$link_db = h5_base::load_model('link_model');
$link_db->insert(array('siteid'=>1,'typeid'=>$typeid,'linktype'=>'1','name'=>'HOUSE5','url'=>'http://www.house5.net','logo'=>'http://www.house5.net/images/logo_88_31.gif','passed'=>1,'addtime'=>SYS_TIME));
$language = array('link'=>'��������','add_link'=>'������������','edit_link'=>'�༭��������','delete_link'=>'ɾ����������','link_setting'=>'ģ������','add_type'=>'�������','list_type'=>'�������','check_register'=>'�������');
?>