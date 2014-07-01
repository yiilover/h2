<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
$authkey = upload_key('1,jpg|jpeg|gif|bmp|png,1,200,200');
;echo '';if ($data['type'] == 2) :;echo '<style>
.arrowhead,.arrowhead-b{background: url(';echo IMG_PATH;echo 'icon/arrowhead.png) no-repeat; height:15px; width:16px;}
.arrowhead-b{background-position: left -28px;}
.thumb{float: left;width: 100px; height: 90px}
a.close{background: url(';echo IMG_PATH;echo 'cross.png) no-repeat left -46px; display:block; width:16px;height:16px;display:inline-block;display:-moz-inline-stack;zoom:1;*display:inline;}
.forms{display:none;}
</style>
<script type="text/javascript" src="';echo JS_PATH;echo 'swfupload/swf2ckeditor.js"></script>
';endif;;echo '
<div class="pad-10">
<form action="?s=block/block_admin/block_update/id/';echo $id;echo '" method="post" id="myform">
<fieldset>
	<legend>';echo L('block_data');echo '</legend>
<table width="100%"  class="table_form" id="table_form">
';if ($data['type'] == 1) :;echo '  <tr>
    <td class="y-bg"><textarea cols="80" id="data" name="data" rows="10">';echo htmlspecialchars($data['data']);echo '</textarea>
';echo form::editor('data','full','','','',1);echo '</td>
  </tr>
';else:;echo '';if(is_array($data['data'])) foreach($data['data'] as $key=>$val):;echo '  <tr>
    <td>
    <div class="contents" id="content_';echo $key;echo '"><a href="';echo $val['url'];echo '" target="blank"><b>';echo $val['title'];echo '</b></a><br /><div style="color:#ccc;">';if($val['thumb']):;echo '<img src="';echo $val['thumb'];echo '" class="thumb" />';endif;;echo '';echo $val['desc'];echo '</div></div>
    <div class="forms" id="form_';echo $key;echo '">
    ';echo L('title');echo '£º<input type="text" id="title_';echo $key;echo '" name="title[]" class="input-text" value="';echo $val['title'];echo '" > ';echo L('link');echo '£º<input type="text" id="url_';echo $key;echo '" name="url[]"  class="input-text" value="';echo $val['url'];echo '" > ';echo L('thumb');echo '£º<input type="hidden" name="thumb[]" id="thumb_';echo $key;echo '"  value="';echo $val['thumb'];echo '" > <a href="javascript:void(0)" onclick="flashupload(\'thumb_images\', \'';echo L('attachment_upload');echo '\',\'thumb_';echo $key;echo '\',submit_images,\'1,jpg|jpeg|gif|bmp|png,1\',\'block\', \'\', \'';echo upload_key('1,jpg|jpeg|gif|bmp|png,1');echo '\')">';echo L('pic_upload');echo '</a> <a href="javascript:void(0)" onclick="$(\'#thumb_';echo $key;echo '\').val(\'\')">';echo L('delete_image');echo '</a><br />';echo L('desc');echo '£º<textarea id="desc_';echo $key;echo '" name="desc[]" rows="10" cols="80">';echo str_replace(array(chr(13),chr(43)),array('<br />','&nbsp;'),$val['desc']);echo '</textarea><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="';echo L('submit');echo '" class="button" onclick="form_submit(';echo $key;echo ')" />
    </div>
    </td>
    <td width="80"><a href="javascript:void(0);" class="arrowhead" onclick="moveUp(this);" title="';echo L('up');echo '"></a><a href="javascript:void(0);" onclick="moveDown(this);" class="arrowhead-b"  title="';echo L('down');echo '"></a><a href="javascript:void(0)" onclick="edit_form(';echo $key;echo ')"><img src="';echo IMG_PATH;echo 'icon/m_2.png" alt="';echo L('edit');echo '" /></a><a href="javascript:void(0)" onclick="$(this).parent().parent().remove();" class="close" title="';echo L('delete');echo '"></a></td>
  </tr>
';endforeach;endif;;echo '</table>
<div class="bk15"></div>
<input type="button" value="';echo L('preview');echo '" class="button" onclick="block_view(';echo $id;echo ')" />
<input type="button" value="';echo L('history');echo '" class="button" onclick="show_history()" />
<input type="button" value="';echo L('search_content');echo '" class="button" onclick="search_content()">
';if ($data['type'] == 2) :;echo '';echo L('datatable');echo ': <input type="text" id="linenum" size="2" value="1" /><input type="button" value="';echo L('submit');echo '" class="button" onclick="add_line()" />   
</fieldset>
<div class="bk15"></div>
<fieldset>
	<legend>';echo L('pieces_template');echo '</legend>
	<table width="100%"  class="table_form">
	<tr>
	<Td><textarea name="template" id="template" style="width:100%;height:120px;">';if ($data['template']) :echo htmlspecialchars($data['template']);else:;echo '{$name}
<ul>
{loop $data $i $r}
<li style="clear:both">
<a href="{$r[url]}">{$r[title]}</a><br />
<div style="color:#ccc;">{if $r[thumb]}<img src="{$r[thumb]}" style="float:left">{/if}{$r[desc]}
</div>
{/loop}
</li>
</ul>';endif;;echo '</textarea></Td>
	<td width="120"><span style="height:25px"><input type="button"  class="button" value="{loop }" title="';echo L('insert');echo '" style="width:50px" onClick="javascript:insertText(\'{loop $data $n $r}\')" /></span>
	<span style="height:25px"><input type="button" class="button" value="{/loop}" title="';echo L('insert');echo '" style="width:50px" onClick="javascript:insertText(\'{/loop}\')" /></span><br />
	<span style="height:25px"><input type="button"  class="button" value="';echo L('name');echo '" title="';echo L('insert');echo '" style="width:50px" onClick="javascript:insertText(\'{$name}\')" /></span>
	<span style="height:25px"><input type="button"  class="button" value="';echo L('title');echo '" title="';echo L('insert');echo '" style="width:50px" onClick="javascript:insertText(\'{$r[title]}\')" /></span><br />
	<span style="height:25px"><input type="button"  class="button" value="URL" title="';echo L('insert');echo '" style="width:50px" onClick="javascript:insertText(\'{$r[url]}\')" /></span>
	<span style="height:25px"><input type="button"  class="button" value="';echo L('thumb');echo '" title="';echo L('insert');echo '" style="width:50px" onClick="javascript:insertText(\'{$r[thumb]}\')" /></span><br />
	<span style="height:25px"><input type="button"   class="button" value="';echo L('desc');echo '" title="';echo L('insert');echo '" style="width:50px" onClick="javascript:insertText(\'{$r[desc]}\')" /></span>
	</td>
	</tr>
	</table>
</fieldset>
 ';endif;;echo ' 
 <div class="bk15"></div>
 <a name="history_div"></a>
<fieldset id="history" style="display:none">
	<legend>';echo L('history');echo '</legend>
	 <div class="bk15"></div>
	<div class="table-list">
	    <table width="100%" cellspacing="0">
        <thead>
		<tr>
		<th width="120">';echo L('time');echo '</th>
		<th align="left">';echo L('admin');echo '</th>
		<th  align="left" width="150">';echo L('operations_manage');echo '</th>
		</tr>
        </thead>
        <tbody>
        ';if(is_array($history_list)) foreach ($history_list as $val):;echo '        <tr>
        <td>';echo format::date($val['creat_at'],1);echo '</td>
        <td>';echo $val['username'];echo '</td>
        <td><a href="?s=block/block_admin/history_restore/id/';echo $val['id'];echo '">';echo L('restore');echo '</a> <a href="?s=block/block_admin/history_del/id/';echo $val['id'];echo '" onclick="return confirm(\'';echo L('are_you_sure_you_want_to_delete');echo '\')">';echo L('delete');echo '</a></td>
        </tr>
        ';endforeach;;echo '</tbody>
</table>
</div>
	';if($pages):;echo '<div id="pages">';echo $pages;;echo '</div>';endif;;echo '</fieldset>




<input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="" />
<iframe name="view" id="view" src=\'\' width="0" height="0"></iframe>
</div>
</form>
<script language="JavaScript" type="text/javascript"><!--

var j=';echo isset($total) ?$total : 0;echo ';
function add_line() {
	for (var i=1; i<= $(\'#linenum\').val(); i++) {
		$(\'#table_form\').append(\'<tr><td><div class="contents" id="content_\'+j+\'"></div><div class="forms" style="display:block" id="form_\'+j+\'">';echo L('title');echo '£º<input type="text" id="title_\'+j+\'" name="title[]" class="input-text">  ';echo L('link');echo '£º<input type="text" id="url_\'+j+\'" name="url[]"  class="input-text"> ';echo L('thumb');echo '£º<input type="hidden" name="thumb[]" id="thumb_\'+j+\'"> <a href="javascript:void(0)" onclick="flashupload(\\\'thumb_images\\\', \\\'';echo L('attachment_upload');echo '\\\',\\\'thumb_\'+j+\'\\\',submit_images,\\\'1,jpg|jpeg|gif|bmp|png,1\\\',\\\'block\\\', \\\'\\\', \\\'';echo upload_key('1,jpg|jpeg|gif|bmp|png,1');echo '\\\')">';echo L('pic_upload');echo '</a> <a href="javascript:void(0)" onclick="$(\\\'#thumb_\'+j+\'\\\').val(\\\'\\\')">';echo L('delete_image');echo '</a><br />';echo L('desc');echo '£º<textarea id="desc_\'+j+\'" name="desc[]" rows="10" cols="80"></textarea><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="';echo L('submit');echo '" class="button" onclick="form_submit(\'+j+\')" /></div></td><td width="80"><a href="javascript:void(0);" class="arrowhead" onclick="moveUp(this);" title="';echo L('up');echo '"></a><a href="javascript:void(0);" onclick="moveDown(this);" class="arrowhead-b"  title="';echo L('down');echo '"></a><a  href="javascript:void(0)" onclick="edit_form(\'+j+\')"><img src="';echo IMG_PATH;echo 'icon/m_2.png" alt="';echo L('edit');echo '" /></a><a href="javascript:void(0)" onclick="$(this).parent().parent().remove();" class="close" title="';echo L('delete');echo '"></a></td></tr>\');
		j++;
	}
	
}

function insert_forms(obj) {
	eval("var d = "+obj+";");
$(\'#table_form\').append(\'<tr><td><div class="contents" id="content_\'+j+\'"></div><div class="forms" style="display:block" id="form_\'+j+\'">';echo L('title');echo '£º<input type="text" id="title_\'+j+\'" name="title[]" class="input-text" value="\'+d.title+\'" >  ';echo L('link');echo '£º<input type="text" id="url_\'+j+\'" name="url[]" value="\'+d.url+\'"  class="input-text"> ';echo L('thumb');echo '£º<input type="hidden" name="thumb[]"  value="\'+d.thumb+\'" id="thumb_\'+j+\'"> <a href="javascript:void(0)" onclick="flashupload(\\\'thumb_images\\\', \\\'';echo L('attachment_upload');echo '\\\',\\\'thumb_\'+j+\'\\\',submit_images,\\\'1,jpg|jpeg|gif|bmp|png,1,200,200\\\',\\\'block\\\',\\\'\\\',\\\'';echo upload_key('1,jpg|jpeg|gif|bmp|png,1,200,200');echo '\\\')">';echo L('pic_upload');echo '</a> <a href="javascript:void(0)" onclick="$(\\\'#thumb_\'+j+\'\\\').val(\\\'\\\')">';echo L('delete_image');echo '</a><br />';echo L('desc');echo '£º<textarea id="desc_\'+j+\'" name="desc[]" rows="10" cols="80">\'+d.desc+\'</textarea><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="';echo L('submit');echo '" class="button" onclick="form_submit(\'+j+\')" /></div></td><td width="80"><a href="javascript:void(0);" class="arrowhead" onclick="moveUp(this);" title="';echo L('up');echo '"></a><a href="javascript:void(0);" onclick="moveDown(this);" class="arrowhead-b"  title="';echo L('down');echo '"></a><a  href="javascript:void(0)" onclick="edit_form(\'+j+\')"><img src="';echo IMG_PATH;echo 'icon/m_2.png" alt="';echo L('edit');echo '" /></a><a href="javascript:void(0)" onclick="$(this).parent().parent().remove();" class="close" title="';echo L('delete');echo '"></a></td></tr>\');
form_submit(j);
j++;	
}

function block_view(id) {
	var old_action = $(\'#myform\').attr(\'action\');
	$(\'#myform\').attr(\'action\', \'?s=block/block_admin/public_view/id/\'+id);
	$(\'#myform\').attr(\'target\', \'view\');
	$(\'#myform\').submit();
	$(\'#myform\').attr(\'action\', old_action);
	$(\'#myform\').attr(\'target\', \'\');
}

function showblock(id, html){
	if (parent.right) {
		parent.right.$("#block_id_"+id).html(html);
	} else {
		parent.$("#block_id_"+id).html(html);
	}
}

function edit_form(id) {
	$(\'#content_\'+id).hide();
	$(\'#form_\'+id).show();
}

function search_content() {
	art.dialog({title:\'';echo L('search_content');echo '\',id:\'search_content\',iframe:"?s=block/block_admin/public_search_content",width:\'600\',height:\'400\'});
}

function form_submit(id) {
	var title = $(\'#title_\'+id).val();
	var url = $(\'#url_\'+id).val();
	var thumb = $(\'#thumb_\'+id).val();
	var desc = $(\'#desc_\'+id).val();
	if (title == \'\') {
		alert(\'';echo L('title').L('empty');echo '\');
		$(\'#title_\'+id).focus();
		return false;
	}
	if (url == \'\') {
		alert(\'';echo L('link').L('empty');echo '\');
		$(\'#url_\'+id).focus();
		return false;
	}
	var str = \'<a href="http://\'+url+\'" target="blank"><b>\'+title+\'</b></a><br />\';
	str += \'<div style="color:#ccc;">\'+(thumb ? \'<img src="\'+thumb+\'" class="thumb" />\': \'\')+desc+\'</div>\';
	$(\'#content_\'+id).html(str).show();
	$(\'#form_\'+id).hide();
}

function cleanWhitespace(element) {
 for (var i = 0; i < element.childNodes.length; i++) {
  var node = element.childNodes[i];
  if (node.nodeType == 3 && !/S/.test(node.nodeValue))
  node.parentNode.removeChild(node);
 }
}
var _table=document.getElementById("table_form");
cleanWhitespace(_table);
function moveUp(_a){
 var _row=_a.parentNode.parentNode;
 if(_row.previousSibling)swapNode(_row,_row.previousSibling);
}
function moveDown(_a){
 var _row=_a.parentNode.parentNode;
 if(_row.nextSibling)swapNode(_row,_row.nextSibling);
}
function swapNode(node1,node2){
 var _parent=node1.parentNode;
 var _t1=node1.nextSibling;
 var _t2=node2.nextSibling;
 if(_t1)_parent.insertBefore(node2,_t1);
 else _parent.appendChild(node2);
 if(_t2)_parent.insertBefore(node1,_t2);
 else _parent.appendChild(node1);
}


function insertText(text)
{
	$(\'#template\').focus();
    var str = document.selection.createRange();
	str.text = text;
}

function show_history() {
	$(\'#history\').show();
	location.href = \'#history_div\';
}

//
--></script>
</body>
</html>';?>