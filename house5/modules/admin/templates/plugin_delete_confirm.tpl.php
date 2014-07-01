<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<link href="';echo CSS_PATH;echo 'open_admin.css" rel="stylesheet" type="text/css" />
<div class="pad_10">
<div class="table-list">
	<div class="fs14">';echo L('uninstall_plugin','','plugin');echo ' - ';echo $plugin_data['name'];echo '</div>
   <div class="btn ibtn ibtns">
		<div class="fs14 txtc">';echo L('uninstall_plugin','','plugin');echo '</div>
        <form name="myform" action="?s=admin/plugin/delete" method="post">
		<input type="submit" class="button" name="dosubmit" value="';echo L('plugin_uninstall_confirm','','plugin');echo '">   
		<input type="hidden" value="';echo $pluginid;echo '" name="pluginid">
		<input type="hidden" value="';echo $_SESSION['h5_hash'];echo '" name="h5_hash">
		</form>

		<input type="button" onclick="history.go(-1);" value="';echo L('plugin_uninstall_cancel','','plugin');echo '" class="button" name="cancel">   
   </div>    
</div>
</div>
</div>

</body>
<a href="javascript:edit(';echo $v['siteid'];echo ', \'';echo $v['name'];echo '\')">
</html>
';?>