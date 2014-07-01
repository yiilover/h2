<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<form name="myform" action="?s=admin/plugin/listorder" method="post">
<div class="pad_10">
';if(h5_base::load_config('system','plugin_debug')) {;echo '<div class="explain-col">';echo L('plugin_debug_tips','','plugin');echo '</div>
<div class="bk10"></div>
';};echo '<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="10%">';echo L('plugin_listorder','','plugin');echo '</th>
            <th width="25%" align="left">';echo L('plugin_list_name','','plugin');echo '</th>
            <th width="10%">URL</th>
            <th width="10%">';echo L('plugin_list_version','','plugin');echo '</th>
            <th width="15%">';echo L('plugin_list_copy','','plugin');echo '</th>
            <th width="10%">';echo L('plugin_list_dir','','plugin');echo '</th>
            <th width="">';echo L('operations_manage');echo '</th>
            </tr>
        </thead>
    <tbody>
 ';
if(is_array($pluginfo)){
foreach($pluginfo as $info){
$iframe = '';
if($info['iframe']) $iframe = string2array($info['iframe']);
;echo '   
	<tr>
	<td width="10%" align="center">
	<input name=\'listorders[';echo $info['pluginid'];echo ']\' type=\'text\' size=\'2\' value=\'';echo $info['listorder'];echo '\' class="input-text-c">
	</td>
	<td width="25%">';if(!$info[appid] &&h5_base::load_config('system','plugin_debug')) {;echo '<img src="';echo IMG_PATH;echo 'admin_img/plugin_debug.png" title="Developing">';};echo '	<a href="?s=admin/plugin/config/pluginid/';echo $info['pluginid'];echo '/menuid/';echo $_GET['menuid'];echo '">
	';echo intval($info['disable']) ?'<font color="green">'.$info['name'].'</font>': '<font color="grey">'.$info['name'].'</font>';echo '</a>';if($iframe['url']) {;echo '<a href="plugin.php?id=';echo $info['identification'];echo '" target="_blank"><img src="';echo IMG_PATH;echo 'admin_img/link.png" title="iframe"></a>';};echo '	</td>
	<td  width="10%" align="center">';if($info['url']) {;echo '<a href="';echo $info['url'];echo '" target="_blank">';echo L('plugin_visit');echo '</a>';}elseif($iframe['url']) {;echo '<a href="plugin.php?id=';echo $info['identification'];echo '" target="_blank">';echo L('plugin_visit');echo '</a>';};echo '</td>
	<td  width="10%" align="center">';echo $info['version'];echo '</td>
	<td  width="15%" align="center">';echo $info['copyright'];echo '</td>
	<td width="10%" align="center">';echo $info['dir'];echo '</td>
	<td width="" align="center">
	<a href="?s=admin/plugin/config/pluginid/';echo $info['pluginid'];echo '/menuid/';echo $_GET['menuid'];echo '">';echo L('plugin_config');echo '</a>
	<a href="?s=admin/plugin/status/pluginid/';echo $info['pluginid'];echo '/disable/';echo intval($info['disable']) ?0 : 1;echo '">';echo intval($info['disable']) ?L('plugin_close') : L('plugin_open');echo '</a> <a href="?s=admin/plugin/delete/pluginid/';echo $info['pluginid'];echo '/menuid/';echo $_GET['menuid'];echo '">';echo L('plugin_uninstall');echo '</a>
	</td>
	</tr>
';
}
}
;echo '    </tbody>
    </table>
  
   <div class="btn"><input type="submit" class="button" name="dosubmit" value="';echo L('listorder');echo '" /></div>  </div> </div>

</div>
</div>
</form>
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