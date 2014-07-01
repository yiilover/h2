<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<style type="text/css">
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
<script type="text/javascript">var catid=';echo $catid;;echo '</script>
<form name="myform" id="myform" action="?s=content/content/edit" method="post" enctype="multipart/form-data">
<div class="addContent">
<div class="crumbs">';echo L('edit_content_position');;echo '</div>
<div class="col-right">
    	<div class="col-1">
        	<div class="content pad-6">
';
if(is_array($forminfos['senior'])) {
foreach($forminfos['senior'] as $field=>$info) {
if($info['isomnipotent']) continue;
if($info['formtype']=='omnipotent') {
foreach($forminfos['base'] as $_fs=>$_fm_value) {
if($_fm_value['isomnipotent']) {
$info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
}
}
foreach($forminfos['senior'] as $_fs=>$_fm_value) {
if($_fm_value['isomnipotent']) {
$info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
}
}
}
;echo '	<h6>';if($info['star']){;echo ' <font color="red">*</font>';};echo ' ';echo $info['name'];echo '</h6>
	 ';echo $info['form'];echo '';echo $info['tips'];echo ' 
';
}}
;echo '          </div>
        </div>
    </div>
    <a title="展开与关闭" class="r-close" hidefocus="hidefocus" style="outline-style: none; outline-width: medium;" id="RopenClose" href="javascript:;"><span class="hidden">展开</span></a>
    <div class="col-auto">
    	<div class="col-1">
        	<div class="content pad-6">
<table width="100%" cellspacing="0" class="table_form">
	<tbody>	
';
if(is_array($forminfos['base'])) {
foreach($forminfos['base'] as $field=>$info) {
if($field == 'initialviews'&&in_array($modelid,array('1','4','5','13')))
{
$info['name'] = '浏览次数';
$info['form'] = '<input type="text" name="info[initialviews]" id="initialviews" value="'.$r_hits['views'].'" class="input-text">';
}
if($info['isomnipotent']) continue;
if($info['formtype']=='omnipotent') {
foreach($forminfos['base'] as $_fs=>$_fm_value) {
if($_fm_value['isomnipotent']) {
$info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
}
}
foreach($forminfos['senior'] as $_fs=>$_fm_value) {
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
<div class="fixed-bottom">
	<div class="fixed-but text-c">
    <div class="button">
	<input value="';if($r['upgrade']) echo $r['url'];;echo '" type="hidden" name="upgrade">
	<input value="';echo $id;;echo '" type="hidden" name="id"><input value="';echo L('save_close');;echo '" type="submit" name="dosubmit" class="cu" onclick="refersh_window()"></div>
    <div class="button"><input value="';echo L('save_continue');;echo '" type="submit" name="dosubmit_continue" class="cu" onclick="refersh_window()"></div>
    <div class="button"><input value="';echo L('c_close');;echo '" type="button" name="close" onclick="refersh_window();close_window();" class="cu" title="Alt+X"></div>
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