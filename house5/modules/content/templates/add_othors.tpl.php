<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad-10">
<input type="hidden" value="content/content/public_relationlist" name="s">
<input type="hidden" value="';echo $modelid;;echo '" name="modelid">
<fieldset>
	<legend>';echo L('select_sitelist');;echo '</legend>
';
foreach($sitelist as $_k=>$_v) {
$checked = $_k==$siteid ?'checked': '';
echo "<label class='ib' style='width:128px'><input type='radio' name='select_siteid' $checked onclick='change_siteid($_k)'> ".$_v['name']."</label>";
}
;echo '</fieldset>
    <div style="width:500px; padding:2px; border:1px solid #d8d8d8; float:left; margin-top:10px; margin-right:10px; overflow:hidden">
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

    <div style="overflow:hidden;_float:left;margin-top:10px;*margin-top:0;_margin-top:0; width:144px">
    <fieldset>
        <legend>';echo L('category_checked');;echo '</legend>
    <ul class=\'list-dot-othors\' id=\'catname\'></ul>
    </fieldset>
    </div>
</div>
<style type="text/css">
.line_ff9966,.line_ff9966:hover td{background-color:#FF9966}
.line_fbffe4,.line_fbffe4:hover td {background-color:#fbffe4}
.list-dot-othors li{float:none; width:auto}
</style>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function select_list(obj,title,id) {
		var relation_ids = window.top.$(\'#relation\').val();
		var sid = \'v\'+id;
		$(obj).attr(\'class\',\'line_fbffe4\');
		var str = "<li id=\'"+sid+"\'>¡¤<input type=\'hidden\' name=\'othor_catid["+id+"]\'><span>"+title+"</span><a href=\'javascript:;\' class=\'close\' onclick=\\"remove_id(\'"+sid+"\')\\"></a></li>";

		window.top.$(\'#add_othors_text\').append(str);
		$(\'#catname\').append(str);
		if(relation_ids ==\'\' ) {
			window.top.$(\'#relation\').val(id);
		} else {
			relation_ids = relation_ids+\'|\'+id;
			window.top.$(\'#relation\').val(relation_ids);
		}
}

function change_siteid(siteid) {
		$("#load_catgory").load("?s=content/content/public_getsite_categorys/siteid/"+siteid);
}
//ÒÆ³ýID
function remove_id(id) {
	$(\'#\'+id).remove();
	window.top.$(\'#\'+id).remove();
}
change_siteid(';echo $this->siteid;;echo ');
//-->
</SCRIPT>
</body>
</html>';?>