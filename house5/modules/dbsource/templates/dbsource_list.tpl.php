<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad_10">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
		<tr>
		<th width="80">Siteid</th>
		<th>';echo L('dbsource_name');echo '</th>
		<th>';echo L('server_address');echo '</th>
		<th width="150">';echo L('operations_manage');echo '</th>
		</tr>
        </thead>
        <tbody>
';
if(is_array($list)):
foreach($list as $v):
;echo '<tr>
<td width="80" align="center">';echo $v['id'];echo '</td>
<td align="center">';echo $v['name'];echo '</td>
<td align="center">';echo $v['host'];echo '</td>
<td align="center"><a href="javascript:edit(';echo $v['id'];echo ', \'';echo htmlspecialchars(new_addslashes($v['name']));echo '\')">';echo L('edit');echo '</a> | <a href="?s=dbsource/dbsource_admin/del/id/';echo $v['id'];echo '" onclick="return confirm(\'';echo htmlspecialchars(new_addslashes(L('confirm',array('message'=>$v['name']))));echo '\')">';echo L('delete');echo '</a></td>
</tr>
';
endforeach;
endif;
;echo '</tbody>
</table>
</div>
</div>
<div id="pages">';echo $pages;echo '</div>
<script type="text/javascript">
<!--
function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit_dbsource');echo '¡¶\'+name+\'¡·\',id:\'edit\',iframe:\'?s=dbsource/dbsource_admin/edit/id/\'+id,width:\'700\',height:\'500\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
//-->
</script>
</body>
</html>';?>