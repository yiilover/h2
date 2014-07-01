<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '
<div class="pad_10">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
		<tr>
		<th>';echo L('name');echo '</th>
		<th width="80">';echo L('type');echo '</th>
		<th>';echo L('display_position');echo '</th>
		<th width="150">';echo L('operations_manage');echo '</th>
		</tr>
        </thead>
        <tbody>
';
if(is_array($list)):
foreach($list as $v):
;echo '<tr>
<td align="center">';echo $v['name'];echo '</td>
<td align="center">';if($v['type']==1) {echo L('code');}else {echo L('table_style');};echo '</td>
<td align="center">';echo $v['pos'];echo '</td>
<td align="center"><a href="javascript:block_update(';echo $v['id'];echo ', \'';echo $v['name'];echo '\')">';echo L('updates');echo '</a> | <a href="javascript:edit(';echo $v['id'];echo ', \'';echo $v['name'];echo '\')">';echo L('edit');echo '</a> | <a href="?s=block/block_admin/del/id/';echo $v['id'];echo '" onclick="return confirm(\'';echo L('confirm',array('message'=>$v['name']));echo '\')">';echo L('delete');echo '</a></td>
</tr>
';
endforeach;
endif;
;echo '</tbody>
</table>
</div>
</div>
<div id="pages">';echo $pages;echo '</div>
<div id="closeParentTime" style="display:none"></div>
<script type="text/javascript">
<!--
if(window.top.$("#current_pos").data(\'clicknum\')==1 || window.top.$("#current_pos").data(\'clicknum\')==null) {
	parent.document.getElementById(\'display_center_id\').style.display=\'\';
	parent.document.getElementById(\'center_frame\').src = \'?s=content/content/public_categorys/type/add/from/block/h5_hash/';echo $_SESSION['pc_hash'];;echo '\';
	window.top.$("#current_pos").data(\'clicknum\',0);
}

function block_update(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit');echo '¡¶\'+name+\'¡·\',id:\'edit\',iframe:\'?s=block/block_admin/block_update/id/\'+id,width:\'700\',height:\'500\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}

function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit');echo '¡¶\'+name+\'¡·\',id:\'edit\',iframe:\'?s=block/block_admin/edit/id/\'+id,width:\'700\',height:\'500\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
//-->
</script>
</body>
</html>';?>