<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');
;echo '
<form action="?s=admin/role/setting_cat_priv/roleid/';echo $roleid;echo '/siteid/';echo $siteid;echo '/op/2" method="post">
<div class="table-list" id="load_priv">
<table width="100%" class="table-list">
			  <thead>
				<tr>
				  <th width="25">';echo L('select_all');echo '</th><th align="left">';echo L('title_varchar');echo '</th><th width="25">';echo L('view');echo '</th><th width="25">';echo L('add');echo '</th><th width="25">';echo L('edit');echo '</th><th width="25">';echo L('delete');echo '</th><th width="25">';echo L('sort');echo '</th><th width="25">';echo L('push');echo '</th><th width="25">';echo L('move');echo '</th>
			  </tr>
			    </thead>
				 <tbody>
				';echo $categorys;echo '			 </tbody>
			</table>
<div class="btn">
<input type="submit" value="';echo L('submit');echo '" class="button">
</div>
</div>
</form>
<script type="text/javascript">
<!--
function select_all(name, obj) {
	if (obj.checked) {
		$("input[type=\'checkbox\'][name=\'priv["+name+"][]\']").attr(\'checked\', \'checked\');
	} else {
		$("input[type=\'checkbox\'][name=\'priv["+name+"][]\']").attr(\'checked\', \'\');
	}
}
//-->
</script>
</body>
</html>
';?>