<?php
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"';if(isset($addbg)) {;echo ' class="addbg"';};echo '>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=';echo CHARSET;echo '" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title>';echo L('website_manage');;echo '</title>
<link href="';echo CSS_PATH;echo 'reset.css" rel="stylesheet" type="text/css" />
<link href="';echo CSS_PATH.SYS_STYLE;;echo '-system.css" rel="stylesheet" type="text/css" />
<link href="';echo CSS_PATH;echo 'table_form.css" rel="stylesheet" type="text/css" />
';
if(!$this->get_siteid()) exit('error');
if(isset($show_dialog)) {
;echo '<link href="';echo CSS_PATH;echo 'dialog.css" rel="stylesheet" type="text/css" />
</head>
<body>
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
';};echo '<style type="text/css">
	html{_overflow-y:scroll}
</style>';?>