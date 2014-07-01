<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<div class="pad_10">
<form name="myform" action="?s=admin/linkage/public_listorder" method="post">
<input type="hidden" name="keyid" value="';echo $keyid;echo '">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
		<tr>
		<th width="10%">';echo L('listorder');echo '</th>
		<th width="10%">ID</th>
		<th width="10%" align="left" >';echo L('linkage_name');echo '</th>
		<th width="20%">';echo L('linkage_desc');echo '</th>
		<th width="15%">';echo L('operations_manage');echo '</th>
		</tr>
        </thead>
        <tbody>
		';echo $submenu;echo '		</tbody>
	</table>
	<div class="btn"><input type="submit" class="button" name="dosubmit" value="';echo L('listorder');echo '" />&nbsp;&nbsp;<a href="?s=admin/linkage/public_cache/linkageid/';echo $keyid;echo '">';echo L('update_backup');echo '</a></div>  </div>
</div>
</div>
</form>
<script type="text/javascript">
<!--
function add(id, name,linkageid) {
	window.top.art.dialog({id:\'add\'}).close();
	window.top.art.dialog({title:name,id:\'add\',iframe:\'?s=admin/linkage/public_sub_add/keyid/\'+id+\'/linkageid/\'+linkageid,width:\'500\',height:\'320\'}, function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});
}

function edit(id, name,parentid) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:name,id:\'edit\',iframe:\'?s=admin/linkage/edit/linkageid/\'+id+\'/parentid/\'+parentid,width:\'500\',height:\'200\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
//-->
</script>
</body>
</html>';?>