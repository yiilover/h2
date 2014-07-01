<?php
 
$show_header = $show_validator = $show_scroll = 1;
include $this->admin_tpl('header','attachment');
;echo '<link href="';echo JS_PATH;echo 'swfupload/swfupload.css" rel="stylesheet" type="text/css" />
<form name="myform" action="" method="get" >
<input type="hidden" value="attachment/attachments/album_load" name="s">
<input type="hidden" value="';echo $file_upload_limit;echo '" name="info[file_upload_limit]">
<div class="lh26" style="padding:10px 0 0">
<label>';echo L('name');echo '</label>
<input type="text" value="" class="input-text" name="info[filename]"> 
<label>';echo L('date');echo '</label>
';echo form::date('info[uploadtime]');echo '<input type="submit" value="';echo L('search');echo '" class="button" name="dosubmit">
</div>
</form>
<div class="bk20 hr"></div>
<ul class="attachment-list"  id="fsUploadProgress">
';foreach($infos as $r) {;echo '<li>
	<div class="img-wrap">
		<a href="javascript:;" onclick="javascript:album_cancel(this,\'';echo $r['aid'];echo '\',\'';echo $this->upload_url.$r['filepath'];echo '\')"><div class="icon"></div><img src="';echo $r['src'];echo '" width="';echo $r['width'];echo '" path="';echo $this->upload_url.$r['filepath'];echo '" title="';echo $r['filename'];echo '"/></a>
	</div>
</li>
';};echo '</ul>
 <div id="pages" class="text-c"> ';echo $pages;echo '</div>
<script type="text/javascript">
$(document).ready(function(){
	set_status_empty();
});	
function set_status_empty(){
	parent.window.$(\'#att-status\').html(\'\');
	parent.window.$(\'#att-name\').html(\'\');
}
function album_cancel(obj,id,source){
	var src = $(obj).children("img").attr("path");
	var filename = $(obj).children("img").attr("title");
	if($(obj).hasClass(\'on\')){
		$(obj).removeClass("on");
		var imgstr = parent.window.$("#att-status").html();
		var length = $("a[class=\'on\']").children("img").length;
		var strs = filenames = \'\';
		$.get(\'index.php?s=attachment/attachments/swfupload_json_del/aid/\'+id+\'/src/\'+source+\'/filename/\'+filename);
		for(var i=0;i<length;i++){
			strs += \'|\'+$("a[class=\'on\']").children("img").eq(i).attr(\'path\');
			filenames += \'|\'+$("a[class=\'on\']").children("img").eq(i).attr(\'title\');
		}
		parent.window.$(\'#att-status\').html(strs);
		parent.window.$(\'#att-name\').html(filenames);
	} else {
		var num = parent.window.$(\'#att-status\').html().split(\'|\').length;
		var file_upload_limit = \'';echo $file_upload_limit;echo '\';
		if(num > file_upload_limit) {alert(\'不能选择超过\'+file_upload_limit+\'个附件\'); return false;}
		$(obj).addClass("on");
		$.get(\'index.php?s=attachment/attachments/swfupload_json/aid/\'+id+\'&src=\'+source+\'&filename=\'+filename);
		parent.window.$(\'#att-status\').append(\'|\'+src);
		parent.window.$(\'#att-name\').append(\'|\'+filename);
	}
}
</script>';?>