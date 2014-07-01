<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"';if(isset($addbg)) {;echo ' class="addbg"';};echo '>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>';echo L('website_manage');;echo '</title>
<link href="';echo CSS_PATH;echo 'reset.css" rel="stylesheet" type="text/css" />
<link href="';echo CSS_PATH.SYS_STYLE;;echo '-system.css" rel="stylesheet" type="text/css" />
<link href="';echo CSS_PATH;echo 'table_form.css" rel="stylesheet" type="text/css" />
';
if(!$this->get_siteid()) showmessage(L('admin_login'),'?s=admin/index/login');
if(isset($show_dialog)) {
;echo '<link href="';echo CSS_PATH;echo 'dialog.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'dialog.js"></script>
';};echo '	<link rel="stylesheet" type="text/css" href="';echo CSS_PATH;echo 'style/';echo SYS_STYLE;;echo '-styles1.css" title="styles1" media="screen" />
	<link rel="alternate stylesheet" type="text/css" href="';echo CSS_PATH;echo 'style/';echo SYS_STYLE;;echo '-styles2.css" title="styles2" media="screen" />
	<link rel="alternate stylesheet" type="text/css" href="';echo CSS_PATH;echo 'style/';echo SYS_STYLE;;echo '-styles3.css" title="styles3" media="screen" />
    <link rel="alternate stylesheet" type="text/css" href="';echo CSS_PATH;echo 'style/';echo SYS_STYLE;;echo '-styles4.css" title="styles4" media="screen" />
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'admin_common.js"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'styleswitch.js"></script>
';if(isset($show_validator)) {;echo '<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'formvalidator.js" charset="UTF-8"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'formvalidatorregex.js" charset="UTF-8"></script>
';};echo '<script type="text/javascript">
	window.focus();
	var h5_hash = \'';echo $_SESSION['h5_hash'];;echo '\';
	';if(!isset($show_h5_hash)) {;echo '	$(document).ready(function(){
		var html_a = document.getElementsByTagName(\'a\');
		var num = html_a.length;
		for(var i=0;i<num;i++) {
			var href = html_a[i].href;
			if(href && href.indexOf(\'javascript:\') == -1) {
				if(href.indexOf(\'?\') != -1) {
					html_a[i].href = href+\'&h5_hash=\'+h5_hash;
				} else {
					html_a[i].href = href+\'?h5_hash=\'+h5_hash;
				}
			}
		}

		var html_form = document.forms;
		var num = html_form.length;
		for(var i=0;i<num;i++) {
			var newNode = document.createElement("input");
			newNode.name = \'h5_hash\';
			newNode.type = \'hidden\';
			newNode.value = h5_hash;
			html_form[i].appendChild(newNode);
		}
	});
';};echo '</script>
</head>
<body>
';if(!isset($show_header)) {;echo '<div class="subnav">
    <div class="content-menu ib-a blue line-x">
    ';if(isset($big_menu)) {echo '<a class="add fb" href="'.$big_menu[0].'"><em>'.$big_menu[1].'</em></a>¡¡';}else {$big_menu = '';};echo '    ';echo admin::submenu($_GET['menuid'],$big_menu);;echo '    </div>
</div>
';};echo '<style type="text/css">
	html{_overflow-y:scroll}
</style>';?>