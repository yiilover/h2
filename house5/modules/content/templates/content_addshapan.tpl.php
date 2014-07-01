<?php

defined('IN_ADMIN') or exit('No permission resources.');
;echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	var h5_hash = \'';echo $_SESSION[h5_hash];;echo '\';
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
	$("#shapan").focus(function(){
	var img = $(\'#shapan\').val();
	$("#preview").attr("src",img);
});
	});
';};echo '</script>
</head>
<body>
';if(!isset($show_header)) {;echo '<div class="subnav">
    <div class="content-menu ib-a blue line-x">
    ';if(isset($big_menu)) {echo '<a class="add fb" href="'.$big_menu[0].'"><em>'.$big_menu[1].'</em></a>　';}else {$big_menu = '';};echo '    ';echo admin::submenu($_GET['menuid'],$big_menu);;echo '    </div>
</div>
';};echo '<style type="text/css">
	html{_overflow-y:scroll}
</style>
<style type="text/css">
html,body{ background:#e2e9ea}
</style>
<script type="text/javascript">
<!--
	var charset = \'';echo CHARSET;;echo '\';
	var uploadurl = \'';echo h5_base::load_config('system','upload_url');echo '\';
//-->
</script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'content_addtop.js"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'colorpicker.js"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'hotkeys.js"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'cookie.js"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'swfupload/swf2ckeditor.js"></script>
<script type="text/javascript">var catid=';echo $catid;;echo '</script>
<form name="myform" id="myform" action="?s=content/content/addshapan" method="post" enctype="multipart/form-data">
<div class="addContent" style="width:700px;">
<div class="crumbs">';echo L('edit_content_position');;echo '</div>
    <div class="col-auto">
    	<div class="col-1">
        	<div class="content pad-6">
<table width="100%" cellspacing="0" class="table_form">
	<tbody>	
';
if(is_array($forminfos['base'])) {
foreach($forminfos['base'] as $field=>$info) {
if($field!='shapan')
{
continue;
}
if($info['isomnipotent']) continue;
if($info['formtype']=='omnipotent') {
foreach($forminfos['base'] as $_fs=>$_fm_value) {
if($_fm_value['isomnipotent']) {
$info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
}
}
}
;echo '	<tr>
      <th width="80">';if($info['star']){;echo ' <font color="red">*</font>';};echo ' ';echo $info['name'];echo '	  </th>
      <td>';echo $info['form'];echo '  ';echo $info['tips'];echo '</td>
    </tr>
';
}}
;echo '
    </tbody></table>
                </div>
        	</div>
        </div>
        
    </div>
</div>
<div>
<img id="preview">
</div>
<div class="fixed-bottom">
	<div class="fixed-but text-c">
    <div class="button">
	<input value="';if($r['upgrade']) echo $r['url'];;echo '" type="hidden" name="upgrade">
	<input value="';echo $id;;echo '" type="hidden" name="id"><input value="';echo $r['title'];;echo '" type="hidden" name="housename"><input value="下一步" type="submit" name="dosubmit" class="cu" onclick="refersh_window()"></div>
      </div>
</div>
</form>

</body>
</html>
<script type="text/javascript"> 
<!--
//只能放到最下面
var openClose = $("#RopenClose"), rh = $(".addContent .col-auto").height(),colRight = $(".addContent .col-right"),valClose = getcookie(\'openClose\');
$(function(){
	if(valClose==1){
		colRight.hide();
		openClose.addClass("r-open");
		openClose.removeClass("r-close");
	}else{
		colRight.show();
	}
	openClose.height(rh);
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, 	function(){$(obj).focus();
	boxid = $(obj).attr(\'id\');
	if($(\'#\'+boxid).attr(\'boxid\')!=undefined) {
		check_content(boxid);
	}
	})}});
	';echo $formValidator;;echo '	
/*
 * 加载禁用外边链接
 */
	jQuery(document).bind(\'keydown\', \'Alt+x\', function (){close_window();});
})
document.title=\'';echo L('edit_content').addslashes($data['title']);;echo '\';
self.moveTo(0, 0);
function refersh_window() {
	setcookie(\'refersh_time\', 1);
}
openClose.click(
	  function (){
		if(colRight.css("display")=="none"){
			setcookie(\'openClose\',0,1);
			openClose.addClass("r-close");
			openClose.removeClass("r-open");
			colRight.show();
		}else{
			openClose.addClass("r-open");
			openClose.removeClass("r-close");
			colRight.hide();
			setcookie(\'openClose\',1,1);
		}
	}
)
//-->
</script>';?>