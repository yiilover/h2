<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<div class="pad_10">
<div class="explain-col">
';echo L('linkage_tips');;echo '</div>
<div class="bk10"></div>
<form name="myform" action="?s=admin/role/listorder" method="post">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
		<tr>
		<th width="10%">ID</th>
		<th width="20%" align="left" >';echo L('linkage_name');echo '</th>
		<th width="30%" align="left" >';echo L('linkage_desc');echo '</th>
		<th width="20%" >';echo L('linkage_calling_code');echo '</th>
		<th width="20%" >';echo L('operations_manage');echo '</th>
		</tr>
        </thead>
        <tbody>
		';
if(is_array($infos)){
foreach($infos as $info){
;echo '		<tr>
		<td width="10%" align="center">';echo $info['linkageid'];echo '</td>
		<td width="20%" >';echo $info['name'];echo '</td>
		<td width="30%" >';echo $info['description'];echo '</td>
		<td width="20%"  class="text-c"><input type="text" value="{menu_linkage(';echo $info['linkageid'];echo ',\'L_';echo $info['linkageid'];echo '\')}" style="width:200px;"></td>
		<td width="20%" class="text-c"><a href="?s=admin/linkage/public_manage_submenu/keyid/';echo $info['linkageid'];echo '">';echo L('linkage_manage_submenu');echo '</a> | <a href="javascript:void(0);" onclick="edit(\'';echo $info['linkageid'];echo '\',\'';echo new_addslashes($info['name']);echo '\')">';echo L('edit');echo '</a> | <a href="javascript:confirmurl(\'?s=admin/linkage/delete/linkageid/';echo $info['linkageid'];echo '\', \'';echo L('linkage_is_del');echo '\')">';echo L('delete');echo '</a> | <a href="?s=admin/linkage/public_cache/linkageid/';echo $info['linkageid'];echo '">';echo L('update_backup');echo '</a></td>
		</tr>
		';
}
}
;echo '</tbody>
</table>
</div>
</div>
</form>
<script type="text/javascript">
<!--
function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:name,id:\'edit\',iframe:\'?s=admin/linkage/edit/linkageid/\'+id,width:\'500\',height:\'200\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
//-->
</script>
</body>
</html>';?>