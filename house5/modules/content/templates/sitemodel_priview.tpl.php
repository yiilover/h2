<?php

defined('IN_ADMIN') or exit('No permission resources.');$addbg=1;
include $this->admin_tpl('header','admin');;echo '<script type="text/javascript">
<!--
	var charset = \'';echo CHARSET;;echo '\';
	var uploadurl = \'';echo h5_base::load_config('system','upload_url');echo '\';
//-->
</script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'content_addtop.js"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'colorpicker.js"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'hotkeys.js"></script>
<script type="text/javascript">var catid=';echo $catid;;echo '</script>
<div class="addContent">
<div class="crumbs">';echo L('priview_model_position');;echo '';echo $r['name'];;echo '</div>
<div class="col-right">
    	<div class="col-1">
        	<div class="content pad-6">
';
if(is_array($forminfos['senior'])) {
foreach($forminfos['senior'] as $field=>$info) {
if($info['isomnipotent']) continue;
if($info['formtype']=='omnipotent') {
foreach($forminfos['base'] as $_fm=>$_fm_value) {
if($_fm_value['isomnipotent']) {
$info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
}
}
foreach($forminfos['senior'] as $_fm=>$_fm_value) {
if($_fm_value['isomnipotent']) {
$info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
}
}
}
;echo '	<h6>';if($info['star']){;echo ' <font color="red">*</font>';};echo ' ';echo $info['name'];echo '</h6>
	 ';echo $info['form'];echo '';echo $info['tips'];echo ' 
';
}}
;echo '';if($_SESSION['roleid']==1) {;echo '<h6>';echo L('c_status');;echo '</h6>
<span class="ib" style="width:90px"><label><input type="radio" name="status" value="99" checked/> ';echo L('c_publish');;echo ' </label></span>
';if($workflowid) {;echo '<label><input type="radio" name="status" value="1" > ';echo L('c_check');;echo ' </label>';};echo '';};echo '          </div>
        </div>
    </div>
    <div class="col-auto">
    	<div class="col-1">
        	<div class="content pad-6">
<table width="100%" cellspacing="0" class="table_form">
	<tbody>	
';
if(is_array($forminfos['base'])) {
foreach($forminfos['base'] as $field=>$info) {
if($info['isomnipotent']) continue;
if($info['formtype']=='omnipotent') {
foreach($forminfos['base'] as $_fm=>$_fm_value) {
if($_fm_value['isomnipotent']) {
$info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
}
}
foreach($forminfos['senior'] as $_fm=>$_fm_value) {
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
    <div class="button"><input value="';echo L('save_close');;echo '" type="submit" name="dosubmit" class="cu" style="width:145px;"></div>
    <div class="button"><input value="';echo L('save_continue');;echo '" type="submit" name="dosubmit_continue" class="cu" style="width:130px;" title="Alt+X"></div>
    <div class="button"><input value="';echo L('c_close');;echo '" type="button" name="close" onclick="close_window()" class="cu" style="width:70px;"></div>
      </div>
</div>

</body>
</html>
<script type="text/javascript"> 
<!--
//只能放到最下面
$(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({id:\'check_content_id\',content:msg,lock:true,width:\'200\',height:\'50\'}, 	function(){$(obj).focus();
	boxid = $(obj).attr(\'id\');
	if($(\'#\'+boxid).attr(\'boxid\')!=undefined) {
		check_content(boxid);
	}
	})}});
	';echo $formValidator;;echo '	
/*
 * 加载禁用外边链接
 */

	$(\'#linkurl\').attr(\'disabled\',true);
	$(\'#islink\').attr(\'checked\',false);
	$(\'.edit_content\').hide();
	jQuery(document).bind(\'keydown\', \'Alt+x\', function (){close_window();});
})
document.title=\'';echo L('priview_modelfield');;echo '\';
//-->
</script>';?>