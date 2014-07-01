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
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'cookie.js"></script>
<script type="text/javascript">var catid=';echo $catid;;echo '</script>
<form name="myform" id="myform" action="?s=content/content/add" method="post" enctype="multipart/form-data">
<div class="addContent">
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
;echo '';if($_SESSION['roleid']==1 ||$priv_status) {;echo '<h6>';echo L('c_status');;echo '</h6>
<span class="ib" style="width:90px"><label><input type="radio" name="status" value="99" checked/> ';echo L('c_publish');;echo ' </label></span>
';if($workflowid) {;echo '<label><input type="radio" name="status" value="1" > ';echo L('c_check');;echo ' </label>';};echo '';};echo '          </div>
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
if($field=='catid'&&isset($_GET['catid']) &&in_array($_GET['catid'],array('6','7','10')))
{
$info['form'] = form::select_category('category_content_'.$this->get_siteid(),6,'name="info[catid]" id="catid"','',$modelid,-1,1);
$info['form'].= "<a href='javascript:;' onclick=\"omnipotent('selectid','?s=content/content/add_othors/siteid/".$this->siteid."','".L('publish_to_othor_category')."',1);return false;\" style='color:#B5BFBB'>[".L('publish_to_othor_category')."]</a><ul class='list-dot-othors' id='add_othors_text'></ul>";
}
if($field=='title'&&isset($_GET['catid']) &&in_array($_GET['catid'],array('8','11','13','99')) &&isset($_GET['houseid']) &&isset($_GET['housename']))
{
$info['form'] = '<input type="text" style="width:400px;" name="info[title]" id="title" value="'.$_GET['housename'].'" class="measure-input  input-text">';
}
if($info['isomnipotent']) continue;
if($info['formtype']=='omnipotent') {
foreach($forminfos['base'] as $_fs=>$_fm_value) {
if($_fm_value['isomnipotent']) {
$info['form'] = str_replace('{'.$_fm.'}',$_fm_value['form'],$info['form']);
}
if($_fs=='relation'&&isset($_GET['catid']) &&in_array($_GET['catid'],array('8','11','13','19','99')) &&isset($_GET['houseid']) &&isset($_GET['housename']))
{
$info['form'] = '<input type="hidden" name="info[relation]" id="relation" value="'.$_GET['houseid'].'" style="50">
<ul class="list-dot" id="relation_text"><li id="v13'.$_GET['houseid'].'">·<span>'.$_GET['housename'].'</span><a href="javascript:;" class="close" onclick="remove_relation(\'v13"'.$_GET['houseid'].'",'.$_GET['houseid'].')"></a></li></ul>
<div>
<input type="button" value="添加相关" onclick="omnipotent(\'selectid\',\'?s=content/content/public_relationlist/modelid/13\',\'添加相关楼盘\',1)" class="button" style="width:66px;"></div>';
}
}
if($_GET['catid']=='11'&&(!empty($key_array)))
{
foreach($key_array as $_fs=>$_fm_value) {
$_fm_value['type'] = getbox_val('13','type',$_fm_value['type']);
$info['form'].='<p>价格：'.$_fm_value['price'].'&nbsp;&nbsp;类型：'.$_fm_value['type'].'&nbsp;&nbsp;时间：'.$_fm_value['addtime'].'</p>';
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
    <div class="button"><input value="';echo L('save_close');;echo '" type="submit" name="dosubmit" class="cu" style="width:145px;" onclick="refersh_window()"></div>
    <div class="button"><input value="';echo L('save_continue');;echo '" type="submit" name="dosubmit_continue" class="cu" style="width:130px;" title="Alt+X" onclick="refersh_window()"></div>
    <div class="button"><input value="';echo L('c_close');;echo '" type="button" name="close" onclick="refersh_window();close_window();" class="cu" style="width:70px;"></div>
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
document.title=\'';echo L('add_content');;echo '\';
self.moveTo(-4, -4);
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