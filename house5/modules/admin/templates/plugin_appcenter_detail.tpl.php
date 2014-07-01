<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<link href="';echo CSS_PATH;echo 'appcenter.css" rel="stylesheet" type="text/css" />
<div class="pad_10">
<table width="90%" cellspacing="0" cellpadding="0" border="0" class="tb4col">
  <thead>
    <tr>
      <td colspan="4" align="left" bgcolor="#F2F9FF" class="thd">';if($recommed) {;echo '<div class="r"><img src="';echo IMG_PATH;echo 'zt.jpg" width="50" height="40"/> </div>';};echo '        <img src="';echo $thumb ?$thumb : IMG_PATH.'zz_bg.jpg';echo '" width="40" height="40" class="imgbh"/>
        <h5>';echo $appname;echo '</h5>
        <p>';echo $description;echo '</p></td>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td align="left" width="50%" class="clj"><h6>';echo L('plugin_pub','','plugin');echo '</h6>

		';if(empty($iframe)) {;echo '        <a href="';echo $downurl;echo '" title="';echo $appname;echo '">';echo L('plugin_click_download','','plugin');echo '</a>
		';};echo '		<a href="index.php?s=admin/plugin/install_online/id/';echo $id;echo '">';echo L('install_online','','plugin');echo '</a></td>

      <td align="left" width="50%"><strong>';echo L('plugin_reg_time','','plugin');echo '</strong>';echo date('Y-m-d H:i:s',$inputtime);echo '<br />
        <strong>';echo L('plugin_copyright','','plugin');echo '</strong>';echo $username;echo ' </td>
    </tr>
    <tr>
      <td colspan="2" align="left">';echo L('plugin_copyright_info','','plugin');echo '</td>
    </tr>
  </tbody>
</table>
</body>
<a href="javascript:edit(';echo $v['siteid'];echo ', \'';echo $v['name'];echo '\')">
</html>
<script type="text/javascript">
<!--
	function add(id, name) {
	window.top.art.dialog({title:\'';echo L('edit');echo '--\'+name, id:\'add\', iframe:\'?s=pay/payment/add/code/\'+id ,width:\'700\',height:\'500\'}, 	function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;
	var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});
}	
	function edit(id, name) {
		window.top.art.dialog({title:\'';echo L('edit');echo '--\'+name, id:\'edit\', iframe:\'?s=pay/payment/edit/id/\'+id ,width:\'700\',height:\'500\'}, 	function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;
		var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
//-->
</script>';?>