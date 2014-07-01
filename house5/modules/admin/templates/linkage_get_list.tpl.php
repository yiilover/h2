<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<div class="pad_10">
<form name="myform" action="?s=admin/role/listorder" method="post">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
		<tr>
		<th width="10%">ID</th>
		<th width="20%" align="left" >';echo L('linkage_name');echo '</th>
		<th width="30%" align="left" >';echo L('linkage_desc');echo '</th>
		</tr>
        </thead>
        <tbody>
		';
if(is_array($infos)){
foreach($infos as $info){
;echo '		<tr onclick="return_id(';echo $info['linkageid'];echo ')" title="';echo L('click_select');echo '" class="cu">
		<td width="10%" align="center">';echo $info['linkageid'];echo '</td>
		<td width="20%" >';echo $info['name'];echo '</td>
		<td width="30%" >';echo $info['description'];echo '</td>
		</tr>
		';
}
}
;echo '</tbody>
</table>
</div>
</div>
</form>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function return_id(linkageid) {
	window.parent.$(\'#linkageid\').val(linkageid);window.parent.art.dialog({id:\'selectid\'}).close();
}
//-->
</SCRIPT>
</body>
</html>';?>