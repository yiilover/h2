<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad_10">
<div class="table-list">
<form action="" method="get">
<input type="hidden" name="s" value="dbsource/data/del" />
    <table width="100%" cellspacing="0">
        <thead>
		<tr>
		<th width="80"><input type="checkbox" value="" id="check_box" onclick="selectall(\'id[]\');"></th>
		<th>';echo L('name');echo '</th>
		<th>';echo L('output_mode');echo '</th>
		<th>';echo L('stdcall');echo '</th>
		<th>';echo L('data_call');echo '</th>
		<th width="150">';echo L('operations_manage');echo '</th>
		</tr>
        </thead>
        <tbody>
';
if(is_array($list)):
foreach($list as $v):
;echo '<tr>
<td width="80" align="center"><input type="checkbox" value="';echo $v['id'];echo '" name="id[]"></td>
<td align="center">';echo $v['name'];echo '</td>
<td align="center">';switch($v['dis_type']){case 1:echo 'json';break;case 2:echo 'xml';break;case 3:echo 'js';break;};echo '</td>
<td align="center">';switch($v['type']){case 0:echo L('model_configuration');break;case 1:echo L('custom_sql');break;};echo '</td>
<td align="center"><input type="text" ondblclick="copy_text(this)" value="';if($v['dis_type']==3){echo  htmlspecialchars('<script type="text/javascript" src="'.APP_PATH.'index.php?s=dbsource/call/get/id/'.$v['id'].'"></script>');echo '';}else {echo APP_PATH;echo 'index.php?s=dbsource/call/get/id/';echo $v['id'];echo '';};echo '" size="30" /></td>
<td align="center"><a href="javascript:edit(';echo $v['id'];echo ', \'';echo htmlspecialchars(new_addslashes($v['name']));echo '\')">';echo L('edit');echo '</a> | <a href="?s=dbsource/data/del/id/';echo $v['id'];echo '" onclick="return confirm(\'';echo htmlspecialchars(new_addslashes(L('confirm',array('message'=>$v['name']))));echo '\')">';echo L('delete');echo '</a></td>
</tr>
';
endforeach;
endif;
;echo '</tbody>
</table>
<div class="btn">
<label for="check_box">';echo L('select_all');echo '/';echo L('cancel');echo '</label> <input type="submit" class="button" name="dosubmit" value="';echo L('delete');echo '" onclick="return confirm(\'';echo L('sure_deleted');echo '\')"/>
</div>
</from>
</div>
</div>
<div id="pages">';echo $pages;echo '</div>
<script type="text/javascript">
<!--
function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('editing_data_sources_call');echo '¡¶\'+name+\'¡·\',id:\'edit\',iframe:\'?s=dbsource/data/edit/id/\'+id,width:\'700\',height:\'500\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}

function copy_text(matter){

	matter.select();

	js1=matter.createTextRange();

	js1.execCommand("Copy");

	alert(\'';echo L('copy_code');;echo '\');

	}

//-->
</script>
</body>
</html>';?>