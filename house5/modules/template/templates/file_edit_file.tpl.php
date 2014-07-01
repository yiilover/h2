<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<style type="text/css">
	html{_overflow:hidden}
	.frmaa{float:left;width:80%; min-width: 870px; _width:870px;}
	.rraa{float: right; width:230px;}
	.pt{margin-top: 4px;}
	
</style>
<body style="overflow:hidden">
<div class="pad-10" style="padding-bottom:0px">
<div class="col-right">
<h3 class="f14">';echo L('common_variables');echo '</h3>
<input type="button" class="button pt" onClick="javascript:insertText(\'{CSS_PATH}\')" value="{CSS_PATH}" title="';echo L('click_into');echo '"/><br />
<input type="button" class="button pt" onClick="javascript:insertText(\'{JS_PATH}\')" value="{JS_PATH}" title="';echo L('click_into');echo '"/><br />
<input type="button" class="button pt" onClick="javascript:insertText(\'{IMG_PATH}\')" value="{IMG_PATH}" title="';echo L('click_into');echo '"/><br />
<input type="button" class="button pt" onClick="javascript:insertText(\'{APP_PATH}\')" value="{APP_PATH}" title="';echo L('click_into');echo '"/><br />
<input type="button" class="button pt" onClick="javascript:insertText(\'{get_siteid()}\')" value="{get_siteid()}" title="»ñÈ¡Õ¾µãID"/><br />
<input type="button" class="button pt" onClick="javascript:insertText(\'{loop $data $n $r}\')" value="{loop $data $n $r}" title="';echo L('click_into');echo '"/><br />
<input type="button" class="button pt" onClick="javascript:insertText(\'{$r[\\\'url\\\']}\')" value="{$r[\'url\']}" title="';echo L('click_into');echo '"/><br />
<input type="button" class="button pt" onClick="javascript:insertText(\'{$r[\\\'title\\\']}\')" value="{$r[\'title\']}" title="';echo L('click_into');echo '"/><br />
<input type="button" class="button pt" onClick="javascript:insertText(\'{$r[\\\'thumb\\\']}\')" value="{$r[\'thumb\']}" title="';echo L('click_into');echo '"/><br />
<input type="button" class="button pt" onClick="javascript:insertText(\'{strip_tags($r[description])}\')" value="{strip_tags($r[description])}" title="';echo L('click_into');echo '"/><br />
';if (is_array($file_t_v[$file_t])) {foreach($file_t_v[$file_t] as $k =>$v) {;echo ' <input type="button" class="button pt" onClick="javascript:insertText(\'';echo $k;echo '\')" value="';echo $k;echo '" title="';echo $v ?$v :L('click_into');echo '"/><br />
 ';}};echo '</div>
<div class="col-auto">
<form action="?s=template/file/edit_file&style=';echo $this->style;echo '&dir=';echo $dir;echo '&file=';echo $file;echo '" method="post" name="myform" id="myform">
<textarea name="code" id="code" style="height: 280px;width:96%; visibility:inherit">';echo $data;echo '</textarea>
<div class="bk10"></div>
<input type="text" id="text" value="" /><input type="button" class="button" onClick="fnSearch()" value="';echo L('find_code');echo '" /> ';if ($is_write==0){echo '<font color="red">'.L("file_does_not_writable").'</font>';};echo ' ';if (module_exists('tag')) {;echo '<input type="button" class="button" onClick="create_tag()" value="';echo L('create_tag');echo '" /> <input type="button" class="button" onClick="select_tag()" value="';echo L('select_tag');echo '" /> ';};echo '<BR><input type="submit" id="dosubmit" class="button pt" name="dosubmit" value="';echo L('submit');echo '" />
</form>
</div>
</div>
<script type="text/javascript">
var oRange; 
var intCount = 0;  
var intTotalCount = 100;

function fnSearch() { 
	var strBeReplaced; 
	var strReplace; 
	strBeReplaced = $(\'#text\').val(); 
	fnNext(); 
	$(\'#code\').focus(); 
	oRange = document.getElementById(\'code\').createTextRange(); 
	for (i=1; oRange.findText(strBeReplaced)!=false; i++) { 
		if(i==intCount){ 
			oRange.select(); 
			oRange.scrollIntoView(); 
			break; 
		} 
		oRange.collapse(false); 
	} 
} 

function create_tag() {
	window.top.art.dialog({id:\'add\',iframe:\'?s=tag/tag/add&ac=js\', title:"';echo L('create_tag');echo '", width:\'700\', height:\'500\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});
}

function insertText(text)
{
	$(\'#code\').focus();
    var str = document.selection.createRange();
	str.text = text;
}

function call(text) {
	$(\'#code\').focus();
    var str = document.selection.createRange();
	var text_lenght = parseInt($(\'#text_lenght\').val());
	str.moveStart("character", text_lenght);
	str.select();
	str.text = text;
}

function GetPoint() {
	if ($.browser.msie) {
		rng = event.srcElement.createTextRange();
		rng.moveToPoint(event.x,event.y);
		rng.moveStart("character",-event.srcElement.value.length);
		var text_lenght = rng.text.length;
	} else {
		//alert($(\'#code\').selectionStart);
	}
	$(\'#text_lenght\').val(text_lenght);
}

function select_tag() {
	window.top.art.dialog({id:\'list\',iframe:\'?s=tag/tag/lists\', title:"';echo L('tag_list');echo '", width:\'700\', height:\'500\', lock:true}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'list\'}).close()});
}

function fnNext(){ 
	if (intCount > 0 && intCount < intTotalCount){ 
		intCount = intCount + 1; 
	} else { 
		intCount = 1 ; 
	} 
} 
//--> 
</SCRIPT> 
</script>
</body>
</html>';?>