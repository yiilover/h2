<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript" src="';echo JS_PATH;echo 'jquery.sgallery.js"></script>
<div class="pad-lr-10">
<form name="searchform" action="" method="get" >
<input type="hidden" value="attachment/manage/init" name="s">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td><div class="explain-col">';echo L('name');echo '  <input type="text" value="';echo $filename;echo '" class="input-text" name="info[filename]">  ';echo L('uploadtime');echo '  ';echo form::date('info[start_uploadtime]',$start_uploadtime,'1','0','true','1');echo '';echo L('to');echo '   ';echo form::date('info[end_uploadtime]',$end_uploadtime);echo '  ';echo L('filetype');echo '  <input type="text" value="';echo $fileext;echo '" class="input-text" name="info[fileext]">  <input type="submit" value="';echo L('search');echo '" class="button" name="dosubmit"> <a href="?s=attachment/manage/dir/menuid/';echo $_GET['menuid'];echo '">';echo L('dir_schema');echo '</a>
		</div>
		</td>
		</tr>
    </tbody>
</table>
</form>
<div class="table-list">
<form name="myform" action="?s=admin/role/listorder" method="post" id="myform">
    <table width="100%" cellspacing="0">
        <thead>
		<tr>
		<th width="10%">';echo L('delete');echo '</th>
		<th width="5%">ID</th>
		<th width="8%" >';echo L('moudle');echo '        <div class="tab-use">
        	<div style="position:relative">
        	<div class="arrows cu" onmouseover="hoverUse(\'module-div\');" onmouseout="hoverUse();" onmouseover="this.style.display=\'block\'"></div>
                <ul id="module-div" class="tab-web-panel" onmouseover="this.style.display=\'block\'"  onmouseout="hoverUse(\'module-div\');" style="height:150px; width:100px; text-align:left; overflow-y:scroll;">
                    ';foreach ($modules as $module) {
if(in_array($module['module'],array('pay','digg','search','scan','attachment','block','dbsource','template','release','cnzz','comment','mood'))) continue;
echo '<li><a href='.url_par('dosubmit=1/module/'.$module['module']).'>'.$module['name'].'</a></li>';
};echo '                </ul>
            </div>
        </div>		
		</th>
		<th width="8%" >';echo L('catname');echo '</th>
		<th width="20%">';echo L('filename');echo '        <div class="tab-use">
        	<div style="position:relative">
        	<div class="arrows cu" onmouseover="hoverUse(\'use-div\');" onmouseout="hoverUse();" onmouseover="this.style.display=\'block\'"></div>
            <ul id="use-div" class="tab-web-panel" onmouseover="this.style.display=\'block\'"  onmouseout="hoverUse(\'use-div\');">
                <li><a href="';echo url_par('dosubmit/1/status/0');echo '">';echo L('not_used');echo '</a></li>
                <li><a href="';echo url_par('dosubmit/1/status/1');echo '">';echo L('used');echo '</a></li>
            </ul>
            </div>
        </div></th>
		<th width="10%" >';echo L('filesize');echo '</th>
		<th width="20%" >';echo L('uploadtime');echo '</th>
		<th width="15%" >';echo L('operations_manage');echo '</th>
		</tr>
        </thead>
        
    <tbody>
';
if(is_array($infos)){
foreach($infos as $info){
$thumb = glob(dirname($this->upload_path.$info['filepath']).'/thumb_*'.basename($info['filepath']));
;echo '<tr>
<td width="10%" align="center"><input type="checkbox" name="aid[]" value="';echo $info['aid'];echo '" id="att_';echo $info['aid'];echo '" /></td>
<td width="5%"  align="center">';echo $info['aid'];echo '</td>
<td width="8%" align="center">';echo $modules[$info['module']]['name'];echo '</td>
<td width="8%"  align="center">';echo $category[$info['catid']]['catname'];echo '</td>
<td width="20%"><img src="';echo file_icon($info['filename'],'gif');echo '" /> ';echo $info['filename'];echo ' ';echo $thumb ?'<img title="'.L('att_thumb_manage').'" src="statics/images/admin_img/havthumb.png" onclick="showthumb('.$info['aid'].', \''.new_addslashes($info['filename']).'\')"/>':'';echo ' ';echo $info['status'] ?'<img src="statics/images/admin_img/link.png"':'';echo '</td>
<td width="10%" align="center">';echo $this->attachment->size($info['filesize']);echo '</td>
<td width="12%"  align="center">';echo date('Y-m-d H:i:s',$info['uploadtime']);echo '</td>
<td  align="center">
';if($info['isremote']){;echo '<a href="javascript:preview(';echo $info['aid'];echo ', \'';echo $info['filename'];echo '\',\'';echo $info['filepath'];echo '\')">';}else{;echo '<a href="javascript:preview(';echo $info['aid'];echo ', \'';echo $info['filename'];echo '\',\'';echo $this->upload_url.$info['filepath'];echo '\')">';};echo '';echo L('preview');echo '</a> | <a href="javascript:;" onclick="att_delete(this,\'';echo $info['aid'];echo '\')">';echo L('delete');echo '</a></td>
</tr>
';
}
}
;echo '</tbody>
</table>
<div class="btn"><a href="#" onClick="javascript:$(\'input[type=checkbox]\').attr(\'checked\', true)">';echo L('selected_all');echo '</a>/<a href="#" onClick="javascript:$(\'input[type=checkbox]\').attr(\'checked\', false)">';echo L('cancel');echo '</a> <input type="submit" class="button" name="dosubmit" value="';echo L('delete');echo '" onClick="document.myform.action=\'?s=attachment/manage/public_delete_all\';return confirm(\'';echo L('del_confirm');echo '\')"/></div>
 <div id="pages"> ';echo $pages;echo '</div>

</form>

</div>
</div>
</body>
</html>
<script type="text/javascript">
<!--
window.top.$(\'#display_center_id\').css(\'display\',\'none\');
function preview(id, name,filepath) {
	if(IsImg(filepath)) {
		window.top.art.dialog({title:\'';echo L('preview');echo '\',fixed:true, content:\'<img src="\'+filepath+\'" onload="$(this).LoadImage(true, 500, 500,\\\'';echo IMG_PATH;echo 's_nopic.gif\\\');"/>\'});	
	} else {
		window.top.art.dialog({title:\'';echo L('preview');echo '\',fixed:true, content:\'<a href="\'+filepath+\'" target="_blank"/><img src="';echo IMG_PATH;echo 'admin_img/down.gif">';echo L('click_open');echo '</a>\'});
	}
}

function att_delete(obj,aid){
	 window.top.art.dialog({content:\'';echo L('del_confirm');echo '\', fixed:true, style:\'confirm\', id:\'att_delete\'}, 
	function(){
	$.get(\'?s=attachment/manage/delete/aid/\'+aid+\'/h5_hash/';echo $_SESSION['h5_hash'];echo '\',function(data){
				if(data == 1) $(obj).parent().parent().fadeOut("slow");
			})
		 	
		 }, 
	function(){});
};

function showthumb(id, name) {
	window.top.art.dialog({title:\'';echo L('att_thumb_manage');echo '--\'+name, id:\'edit\', iframe:\'?s=attachment/manage/pullic_showthumbs/aid/\'+id ,width:\'500px\',height:\'400px\'});
}
function hoverUse(target){
	if($("#"+target).css("display") == "none"){
		$("#"+target).show();
	}else{
		$("#"+target).hide();
	}
}

function IsImg(url){
	  var sTemp;
	  var b=false;
	  var opt="jpg|gif|png|bmp|jpeg";
	  var s=opt.toUpperCase().split("|");
	  for (var i=0;i<s.length ;i++ ){
	    sTemp=url.substr(url.length-s[i].length-1);
	    sTemp=sTemp.toUpperCase();
	    s[i]="."+s[i];
	    if (s[i]==sTemp){
	      b=true;
	      break;
	    }
	  }
	  return b;
}
//-->
</script>';?>