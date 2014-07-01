<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_header = $show_validator = 1;
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
	$(document).ready(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		';if (is_array($html) &&$html['validator']){echo $html['validator'];unset($html['validator']);};echo '	})
//-->
</script>
<div class="pad-10">
<div class="col-tab">

<ul class="tabBut cu-li">
<li';if ($_GET['order']==1 ||!isset($_GET['order'])) {;echo ' class="on"';};echo '><a href="?s=content/push/init/classname/position_api/action/position_list/order/1/modelid/';echo $_GET['modelid'];echo '/catid/';echo $_GET['catid'];echo '/id/';echo $_GET['id'];echo '">';echo L('push_to_position');;echo '</a></li>
<li';if ($_GET['order']==2) {;echo ' class="on"';};echo '><a href="?s=content/push/init/module/special/action/_push_special/order/2/modelid/';echo $_GET['modelid'];echo '/catid/';echo $_GET['catid'];echo '/id/';echo $_GET['id'];echo '">';echo L('push_to_special');;echo '</a></li>
<li';if ($_GET['order']==3) {;echo ' class="on"';};echo '><a href="?s=content/push/init/module/content/classname/push_api/action/category_list/order/3/tpl/push_to_category/modelid/';echo $_GET['modelid'];echo '/catid/';echo $_GET['catid'];echo '/id/';echo $_GET['id'];echo '">';echo L('push_to_category');;echo '</a></li>
</ul>

<div class=\'content\' style="height:auto;">
<form action="?s=content/push/init/module/';echo $_GET['module'];echo '/action/';echo $_GET['action'];echo '" method="post" name="myform" id="myform"><input type="hidden" name="modelid" value="';echo $_GET['modelid'];echo '"><input type="hidden" name="catid" value="';echo $_GET['catid'];echo '">
<input type=\'hidden\' name="id" value=\'';echo $_GET['id'];echo '\'>
<input type="hidden" value="content/content/public_relationlist" name="s">
<input type="hidden" value="';echo $modelid;;echo '" name="modelid">
';
$sitelist = getcache('sitelist','commons');
$siteid = $this->siteid;
foreach($sitelist as $_k=>$_v) {
$checked = $_k==$siteid ?'checked': '';
echo "<label class='ib' style='width:128px;padding:5px;'><input type='radio' name='select_siteid' $checked onclick='change_siteid($_k)'> ".$_v['name']."</label>";
}
;echo '<input type="hidden" value="';echo $siteid;;echo '" name="siteid" id="siteid">
</div>
</div>
    <div style="width:500px; padding:2px; border:1px solid #d8d8d8; float:left; margin-top:10px; margin-right:10px">
    <table width="100%" cellspacing="0" class="table-list" >
            <thead>
                <tr>
                <th width="100">';echo L('catid');;echo '</th>
                <th >';echo L('catname');;echo '</th>
                <th width="150" >';echo L('select_model_name');;echo '</th>
                </tr>
            </thead>
        <tbody id="load_catgory">
        ';echo $categorys;;echo '        </tbody>
        </table>
    </div>

    <div style="overflow:hidden;_float:left;margin-top:10px;*margin-top:0;_margin-top:0">
    <fieldset>
        <legend>';echo L('category_checked');;echo '</legend>
    <ul class=\'list-dot-othors\' id=\'catname\'>
    <input type=\'hidden\' name=\'ids\' value="" id="relation"></ul>
    </fieldset>
    </div>
</div>
<style type="text/css">
.line_ff9966,.line_ff9966:hover td{background-color:#FF9966}
.line_fbffe4,.line_fbffe4:hover td {background-color:#fbffe4}
.list-dot-othors li{float:none; width:auto}
</style>

<div class="bk15"></div>

<input type="hidden" name="return" value="';echo $return;echo '" />
<input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="';echo L('submit');echo '" />
</form>

<SCRIPT LANGUAGE="JavaScript">
<!--
	function select_list(obj,title,id) {
		var relation_ids = $(\'#relation\').val();
		var sid = \'v\'+id;
		$(obj).attr(\'class\',\'line_fbffe4\');
		var str = "<li id=\'"+sid+"\'>¡¤<span>"+title+"</span><a href=\'javascript:;\' class=\'close\' onclick=\\"remove_id(\'"+sid+"\')\\"></a></li>";
		$(\'#catname\').append(str);
		if(relation_ids ==\'\' ) {
			$(\'#relation\').val(id);
		} else {
			relation_ids = relation_ids+\'|\'+id;
			$(\'#relation\').val(relation_ids);
		}
}

function change_siteid(siteid) {
		$("#load_catgory").load("?s=content/content/public_getsite_categorys/siteid/"+siteid);
		$("#siteid").val(siteid);
}
//ÒÆ³ýID
function remove_id(id) {
	$(\'#\'+id).remove();
}
change_siteid(';echo $siteid;;echo ');
//-->
</SCRIPT>';?>