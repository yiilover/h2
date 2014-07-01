<?php
 $show_header = $show_validator = $show_scroll = 1;include $this->admin_tpl('header','attachment');;echo '<link href="';echo JS_PATH;echo 'swfupload/swfupload.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="';echo JS_PATH;echo 'swfupload/swfupload.js"></script>
<script language="JavaScript" type="text/javascript" src="';echo JS_PATH;echo 'swfupload/fileprogress.js"></script>
<script language="JavaScript" type="text/javascript" src="';echo JS_PATH;echo 'swfupload/handlers.js"></script>
<script type="text/javascript">
';echo initupload($_GET['module'],$_GET['catid'],$args,$this->userid,$this->groupid,$this->isadmin);echo '</script>
<div class="pad-10">
    <div class="col-tab">
        <ul class="tabBut cu-li">
            <li id="tab_swf_1" ';echo $tab_status;echo ' onclick="SwapTab(\'swf\',\'on\',\'\',5,1);">';echo L('upload_attachment');echo '</li>
            <li id="tab_swf_2" onclick="SwapTab(\'swf\',\'on\',\'\',5,2);">';echo L('net_file');echo '</li>
            ';if($allowupload &&$this->admin_username &&$_SESSION['userid']) {;echo '            <li id="tab_swf_3" onclick="SwapTab(\'swf\',\'on\',\'\',5,3);set_iframe(\'album_list\',\'index.php?s=attachment/attachments/album_load/args/';echo $args;echo '\');">';echo L('gallery');echo '</li>
            <li id="tab_swf_4" onclick="SwapTab(\'swf\',\'on\',\'\',5,4);set_iframe(\'album_dir\',\'index.php?s=attachment/attachments/album_dir/args/';echo $args;echo '\');">';echo L('directory_browse');echo '</li>
            ';};echo '            ';if($att_not_used!='') {;echo '            <li id="tab_swf_5" class="on icon" onclick="SwapTab(\'swf\',\'on\',\'\',5,5);">';echo L('att_not_used');echo '</li>
            ';};echo '        </ul>
         <div id="div_swf_1" class="content pad-10 ';echo $div_status;echo '">
        	<div>
				<div class="addnew" id="addnew">
					<span id="buttonPlaceHolder"></span>
				</div>
				<input type="button" id="btupload" value="';echo L('start_upload');echo '" onClick="swfu.startUpload();" />
                <div id="nameTip" class="onShow">';echo L('upload_up_to');echo '<font color="red"> ';echo $file_upload_limit;echo '</font> ';echo L('attachments');echo ',';echo L('largest');echo ' <font color="red">';echo $file_size_limit;echo '</font></div>
                <div class="bk3"></div>
				
                <div class="lh24">';echo L('supported');echo ' <font style="font-family: Arial, Helvetica, sans-serif">';echo str_replace(array('*.',';'),array('','¡¢'),$file_types);echo '</font> ';echo L('formats');echo '</div><input type="checkbox" id="watermark_enable" value="1" ';if(isset($watermark_enable) &&$watermark_enable == 1) echo 'checked';echo ' onclick="change_params()"> ';echo L('watermark_enable');echo '        	</div> 	
    		<div class="bk10"></div>
        	<fieldset class="blue pad-10" id="swfupload">
        	<legend>';echo L('lists');echo '</legend>
        	<ul class="attachment-list"  id="fsUploadProgress">    
        	</ul>
    		</fieldset>
    	</div>
        <div id="div_swf_2" class="contentList pad-10 hidden">
        <div class="bk10"></div>
        	';echo L('enter_address');echo '<div class="bk3"></div><input type="text" name="info[filename]" class="input-text" value=""  style="width:350px;"  onblur="addonlinefile(this)">
		<div class="bk10"></div>
        </div>    	
    	';if($allowupload &&$this->admin_username &&$_SESSION['userid']) {;echo '        <div id="div_swf_3" class="contentList pad-10 hidden">
            <ul class="attachment-list">
        	 <iframe name="album-list" src="#" frameborder="false" scrolling="no" style="overflow-x:hidden;border:none" width="100%" height="345" allowtransparency="true" id="album_list"></iframe>   
        	</ul>
        </div>
        <div id="div_swf_4" class="contentList pad-10 hidden">
            <ul class="attachment-list">
        	 <iframe name="album-dir" src="#" frameborder="false" scrolling="auto" style="overflow-x:hidden;border:none" width="100%" height="330" allowtransparency="true" id="album_dir"></iframe>   
        	</ul>
        </div>
        ';};echo '        ';if($att_not_used!='') {;echo '        <div id="div_swf_5" class="contentList pad-10">
        	<div class="explain-col">';echo L('att_not_used_desc');echo '</div>
            <ul class="attachment-list" id="album">
            ';if(is_array($att) &&!empty($att)){foreach ($att as $_v) {;echo '			<li>
				<div class="img-wrap">
					<a onclick="javascript:album_cancel(this,';echo $_v['aid'];echo ',\'';echo $_v['src'];echo '\')" href="javascript:;" class="off"  title="';echo $_v['filename'];echo '"><div class="icon"></div><img width="';echo $_v['width'];echo '"  path="';echo $_v['src'];echo '" src="';echo $_v['fileimg'];echo '" title="';echo $_v['filename'];echo '"></a>
				</div>
			</li>
			';}};echo '        	</ul>
        </div>   
        ';};echo '     
    <div id="att-status" class="hidden"></div>
     <div id="att-status-del" class="hidden"></div>
    <div id="att-name" class="hidden"></div>
<!-- swf -->
</div>
</body>
<script type="text/javascript">
if ($.browser.mozilla) {
	window.onload=function(){
	  if (location.href.indexOf("&rand=")<0) {
			location.href=location.href+"&rand="+Math.random();
		}
	}
}
function imgWrap(obj){
	$(obj).hasClass(\'on\') ? $(obj).removeClass("on") : $(obj).addClass("on");
}

function SwapTab(name,cls_show,cls_hide,cnt,cur) {
    for(i=1;i<=cnt;i++){
		if(i==cur){
			 $(\'#div_\'+name+\'_\'+i).show();
			 $(\'#tab_\'+name+\'_\'+i).addClass(cls_show);
			 $(\'#tab_\'+name+\'_\'+i).removeClass(cls_hide);
		}else{
			 $(\'#div_\'+name+\'_\'+i).hide();
			 $(\'#tab_\'+name+\'_\'+i).removeClass(cls_show);
			 $(\'#tab_\'+name+\'_\'+i).addClass(cls_hide);
		}
	}
}

function addonlinefile(obj) {
	var strs = $(obj).val() ? \'|\'+ $(obj).val() :\'\';
	$(\'#att-status\').html(strs);
}

function change_params(){
	if($(\'#watermark_enable\').attr(\'checked\')) {
		swfu.addPostParam(\'watermark_enable\', \'1\');
	} else {
		swfu.removePostParam(\'watermark_enable\');
	}
}
function set_iframe(id,src){
	$("#"+id).attr("src",src); 
}
function album_cancel(obj,id,source){
	var src = $(obj).children("img").attr("path");
	var filename = $(obj).attr(\'title\');
	if($(obj).hasClass(\'on\')){
		$(obj).removeClass("on");
		var imgstr = $("#att-status").html();
		var length = $("a[class=\'on\']").children("img").length;
		var strs = filenames = \'\';
		$.get(\'index.php?s=attachment/attachments/swfupload_json_del/aid/\'+id+\'&src=\'+source+\'&filename=\'+filename);
		for(var i=0;i<length;i++){
			strs += \'|\'+$("a[class=\'on\']").children("img").eq(i).attr(\'path\');
			filenames += \'|\'+$("a[class=\'on\']").children("img").eq(i).attr(\'title\');
		}
		$(\'#att-status\').html(strs);
		$(\'#att-status\').html(filenames);
	} else {
		var num = $(\'#att-status\').html().split(\'|\').length;
		var file_upload_limit = \'';echo $file_upload_limit;echo '\';
		if(num > file_upload_limit) {alert(\'';echo L('attachment_tip1');echo '\'+file_upload_limit+\'';echo L('attachment_tip2');echo '\'); return false;}
		$(obj).addClass("on");
		$.get(\'index.php?s=attachment/attachments/swfupload_json/aid/\'+id+\'&src=\'+source+\'&filename=\'+filename);
		$(\'#att-status\').append(\'|\'+src);
		$(\'#att-name\').append(\'|\'+filename);
	}
}
</script>
</html>
';?>