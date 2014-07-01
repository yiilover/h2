<?php

defined('IN_HOUSE5') or exit('Access Denied');
defined('INSTALL') or exit('Access Denied');
$parentid = $menu_db->insert(array('name'=>'poster','parentid'=>29,'m'=>'poster','c'=>'space','a'=>'init','data'=>'','listorder'=>0,'display'=>'1'),true);
$menu_db->insert(array('name'=>'add_space','parentid'=>$parentid,'m'=>'poster','c'=>'space','a'=>'add','data'=>'','listorder'=>0,'display'=>'0'));
$menu_db->insert(array('name'=>'edit_space','parentid'=>$parentid,'m'=>'poster','c'=>'space','a'=>'edit','data'=>'','listorder'=>0,'display'=>'0'));
$menu_db->insert(array('name'=>'del_space','parentid'=>$parentid,'m'=>'poster','c'=>'space','a'=>'delete','data'=>'','listorder'=>0,'display'=>'0'));
$menu_db->insert(array('name'=>'poster_list','parentid'=>$parentid,'m'=>'poster','c'=>'poster','a'=>'init','data'=>'','listorder'=>0,'display'=>'0'));
$menu_db->insert(array('name'=>'add_poster','parentid'=>$parentid,'m'=>'poster','c'=>'poster','a'=>'add','data'=>'','listorder'=>0,'display'=>'0'));
$menu_db->insert(array('name'=>'edit_poster','parentid'=>$parentid,'m'=>'poster','c'=>'poster','a'=>'edit','data'=>'','listorder'=>0,'display'=>'0'));
$menu_db->insert(array('name'=>'del_poster','parentid'=>$parentid,'m'=>'poster','c'=>'poster','a'=>'delete','data'=>'','listorder'=>0,'display'=>'0'));
$menu_db->insert(array('name'=>'poster_stat','parentid'=>$parentid,'m'=>'poster','c'=>'poster','a'=>'stat','data'=>'','listorder'=>0,'display'=>'0'));
$menu_db->insert(array('name'=>'poster_setting','parentid'=>$parentid,'m'=>'poster','c'=>'space','a'=>'setting','data'=>'','listorder'=>0,'display'=>'0'));
$menu_db->insert(array('name'=>'create_poster_js','parentid'=>$parentid,'m'=>'poster','c'=>'space','a'=>'create_js','data'=>'','listorder'=>0,'display'=>'1'));
$menu_db->insert(array('name'=>'poster_template','parentid'=>$parentid,'m'=>'poster','c'=>'space','a'=>'poster_template','data'=>'','listorder'=>0,'display'=>'1'));
$pdb = h5_base::load_model('poster_model');
$sql = "INSERT INTO `house5_poster` (`siteid`, `id`, `name`, `spaceid`, `type`, `setting`, `startdate`, `enddate`, `addtime`, `hits`, `clicks`, `listorder`, `disabled`) VALUES
(1, 1, 'banner', 1, 'images', 'array (\n  1 => \n  array (\n    ''linkurl'' => ''http://www.house5.net'',\n    ''imageurl'' => ''./uploadfile/poster/2.png'',\n    ''alt'' => '''',\n  ),\n)', 1285813808, 1446249600, 1285813833, 0, 1, 0, 0);
INSERT INTO `house5_poster` (`siteid`, `id`, `name`, `spaceid`, `type`, `setting`, `startdate`, `enddate`, `addtime`, `hits`, `clicks`, `listorder`, `disabled`) VALUES
(1, 2, 'house5', 2, 'images', 'array (\n  1 => \n  array (\n    ''linkurl'' => ''http://www.house5.net'',\n    ''imageurl'' => ''./statics/images/v9/ad_login.jpg'',\n    ''alt'' => ''house5רҵ��վϵͳ'',\n  ),\n)', 1285816298, 1446249600, 1285816310, 0, 1, 0, 0);
INSERT INTO `house5_poster` (`siteid`, `id`, `name`, `spaceid`, `type`, `setting`, `startdate`, `enddate`, `addtime`, `hits`, `clicks`, `listorder`, `disabled`) VALUES
(1, 3, 'house5�����Ƽ�', 3, 'images', 'array (\n  1 => \n  array (\n    ''linkurl'' => ''http://www.house5.net'',\n    ''imageurl'' => ''./uploadfile/poster/3.png'',\n    ''alt'' => ''house5�ٷ�'',\n  ),\n)', 1286504815, 1446249600, 1286504865, 0, 1, 0, 0);
INSERT INTO `house5_poster` (`siteid`, `id`, `name`, `spaceid`, `type`, `setting`, `startdate`, `enddate`, `addtime`, `hits`, `clicks`, `listorder`, `disabled`) VALUES
(1, 4, 'house5���', 4, 'images', 'array (\n  1 => \n  array (\n    ''linkurl'' => ''http://www.house5.net'',\n    ''imageurl'' => ''./uploadfile/poster/4.gif'',\n    ''alt'' => ''house5�ٷ�'',\n  ),\n)', 1286505141, 1446249600, 1286505178, 0, 0, 0, 0);
INSERT INTO `house5_poster` (`siteid`, `id`, `name`, `spaceid`, `type`, `setting`, `startdate`, `enddate`, `addtime`, `hits`, `clicks`, `listorder`, `disabled`) VALUES
(1, 5, 'house5����', 5, 'images', 'array (\n  1 => \n  array (\n    ''linkurl'' => ''http://www.house5.net'',\n    ''imageurl'' => ''./uploadfile/poster/5.gif'',\n    ''alt'' => ''�ٷ�'',\n  ),\n)', 1286509363, 1446249600, 1286509401, 0, 0, 0, 0);
INSERT INTO `house5_poster` (`siteid`, `id`, `name`, `spaceid`, `type`, `setting`, `startdate`, `enddate`, `addtime`, `hits`, `clicks`, `listorder`, `disabled`) VALUES
(1, 6, 'house5�����Ƽ�1', 6, 'images', 'array (\n  1 => \n  array (\n    ''linkurl'' => ''http://www.house5.net'',\n    ''imageurl'' => ''./uploadfile/poster/5.gif'',\n    ''alt'' => ''�ٷ�'',\n  ),\n)', 1286510183, 1446249600, 1286510227, 0, 0, 0, 0);
INSERT INTO `house5_poster` (`siteid`, `id`, `name`, `spaceid`, `type`, `setting`, `startdate`, `enddate`, `addtime`, `hits`, `clicks`, `listorder`, `disabled`) VALUES
(1, 7, 'house5��������', 7, 'images', 'array (\n  1 => \n  array (\n    ''linkurl'' => ''http://www.house5.net'',\n    ''imageurl'' => ''./uploadfile/poster/5.gif'',\n    ''alt'' => ''�ٷ�'',\n  ),\n)', 1286510314, 1446249600, 1286510341, 0, 0, 0, 0);
INSERT INTO `house5_poster` (`siteid`, `id`, `name`, `spaceid`, `type`, `setting`, `startdate`, `enddate`, `addtime`, `hits`, `clicks`, `listorder`, `disabled`) VALUES
(1, 8, 'house5����ҳ', 8, 'images', 'array (\n  1 => \n  array (\n    ''linkurl'' => ''http://www.house5.net'',\n    ''imageurl'' => ''./uploadfile/poster/1.jpg'',\n    ''alt'' => ''�ٷ�վ'',\n  ),\n)', 1286522084, 1446249600, 1286522125, 0, 0, 0, 0);
INSERT INTO `house5_poster` (`siteid`, `id`, `name`, `spaceid`, `type`, `setting`, `startdate`, `enddate`, `addtime`, `hits`, `clicks`, `listorder`, `disabled`) VALUES
(1, 9, 'house5���', 9, 'images', 'array (\n  1 => \n  array (\n    ''linkurl'' => ''http://www.house5.net'',\n    ''imageurl'' => ''./uploadfile/poster/4.gif'',\n    ''alt'' => '''',\n  ),\n)', 1287041759, 1446249600, 1287041804, 0, 0, 0, 0);
INSERT INTO `house5_poster` (`siteid`, `id`, `name`, `spaceid`, `type`, `setting`, `startdate`, `enddate`, `addtime`, `hits`, `clicks`, `listorder`, `disabled`) VALUES (1, 10, 'house5', 10, 'images', 'array (\n  1 => \n  array (\n    ''linkurl'' => ''http://www.house5.net'',\n    ''imageurl'' => ''./uploadfile/poster/6.jpg'',\n    ''alt'' => ''house5�ٷ�'',\n  ),\n)', 1289270509, 1446249600, 1289270541, 1, 0, 0, 0);";
$sql = str_replace(array("house5_",'./uploadfile/poster/','./statics/images'),array($pdb->db_tablepre,h5_base::load_config('system','upload_url').'poster/',APP_PATH.'statics/images'),$sql);
$sqls = explode(";",trim($sql));
unset($sql);
$sqls = array_filter($sqls);
if (is_array($sqls)) {
foreach($sqls as $s) {
$pdb->query($s);
}
}
unset($pdb);
$language = array('poster'=>'���','add_space'=>'��Ӱ�λ','edit_space'=>'�༭��λ','del_space'=>'ɾ����λ','poster_list'=>'����б�','add_poster'=>'��ӹ��','edit_poster'=>'�༭���','del_poster'=>'ɾ�����','poster_stat'=>'���ͳ��','poster_setting'=>'ģ������','create_poster_js'=>'��������js','poster_template'=>'���ģ������');
?>