<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script language="JavaScript" src="';echo JS_PATH;echo 'jquery.imgpreview.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var obj=$("#imgPreview a[rel]");
		if(obj.length>0) {
			$(\'#imgPreview a[rel]\').imgPreview({
				srcAttr: \'rel\',
			    imgCSS: { width: 200 }
			});
		}
	});	
</script>
<div class="bk15"></div>
<div class="pad-lr-10">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td><div class="explain-col">
		<a href="?s=attachment/manage">';echo L('database_schema');echo '</a>
		</div>
		</td>
		</tr>
    </tbody>
</table>
<div class="table-list">
<table width="100%" cellspacing="0" id="imgPreview">
<tr>
<td align="left">';echo L("local_dir");echo '£º';echo $local;echo '</td><td></td>
</tr>
';if ($dir !=''&&$dir != '.'):;echo '<tr>
<td align="left"><a href="';echo '?s=attachment/manage/dir&dir='.stripslashes(dirname($dir));echo '"><img src="';echo IMG_PATH;echo 'folder-closed.gif" />';echo L("parent_directory");echo '</a></td><td></td>
</tr>
';endif;;echo '';
if(is_array($list)) {
foreach($list as $v) {
$filename = basename($v)
;echo '<tr>
';if (is_dir($v)) {
echo '<td align="left"><img src="'.IMG_PATH.'folder-closed.gif" /> <a href="?s=attachment/manage/dir&dir='.(isset($_GET['dir']) &&!empty($_GET['dir']) ?stripslashes($_GET['dir']).'/': '').$filename.'"><b>'.$filename.'</b></a></td><td width="10%"></td>';
}else {
echo '<td align="left" ><img src="'.file_icon($filename,'gif').'" /><a rel="'.$local.'/'.$filename.'">'.$filename.'</a></td><td width="10%"><a href="javascript:;" onclick="preview(\''.$local.'/'.$filename.'\')">'.L('preview').'</a> | <a href="javascript:;" onclick="att_delete(this,\''.urlencode($filename).'\',\''.urlencode($local).'\')">'.L('delete').'</a> </td>';
};echo '</tr>
';
}
}
;echo '</table>
</div>
</div>
</body>
<script type="text/javascript">
function preview(filepath) {
	if(IsImg(filepath)) {
		window.top.art.dialog({title:\'';echo L('preview');echo '\',fixed:true, content:\'<img src="\'+filepath+\'" />\',time:8});	
	} else {
		window.top.art.dialog({title:\'';echo L('preview');echo '\',fixed:true, content:\'<a href="\'+filepath+\'" target="_blank"/><img src="';echo IMG_PATH;echo 'admin_img/down.gif">';echo L('click_open');echo '</a>\'});
	}	
}
function att_delete(obj,filename,localdir){
	 window.top.art.dialog({content:\'';echo L('del_confirm');echo '\', fixed:true, style:\'confirm\', id:\'att_delete\'}, 
	function(){
	$.get(\'?s=attachment/manage/pulic_dirmode_del/filename/\'+filename+\'/dir/\'+localdir,function(data){
				if(data) $(obj).parent().parent().fadeOut("slow");
			})
		 	
		 }, 
	function(){});
};
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
</script>
</html>';?>