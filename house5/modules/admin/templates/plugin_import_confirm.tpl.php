<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<link href="';echo CSS_PATH;echo 'open_admin.css" rel="stylesheet" type="text/css" />
<div class="pad_10">
<div class="table-list">
';if($license &&$_GET['license']) {;echo '<div class="nr"><p>';echo $plugin_data['license'];echo '</p></div>
   <div class="btn ibtn txtc">
	<input type="button" onclick="location.href=\'';echo $submit_url;echo '\'" value="';echo L('plugin_agree','','plugin');echo '" class="button" name="install">   
	<input type="button" onclick="history.go(-1);" value="';echo L('plugin_disagree','','plugin');echo '" class="button" name="cancel">   
   </div>
';}else {;echo '	<div class="fs14">';echo L('install_plugin','','plugin');echo '</div>
   <div class="btn ibtn ibtns">
   <div class="fs14 txtc">';echo L('install_plugin','','plugin');echo '</div>
	<input type="button" onclick="location.href=\'';echo $submit_url;echo '\'" value="';echo L('plugin_install_app','','plugin');echo '" class="button" name="install"> <input type="button" onclick="history.go(-1);" value="';echo L('plugin_uninstall_cancel','','plugin');echo '" class="button" name="cancel">  
   </div>
';};echo '   
</div>
</div>
</div>

</body>
<a href="javascript:edit(';echo $v['siteid'];echo ', \'';echo $v['name'];echo '\')">
</html>
';?>