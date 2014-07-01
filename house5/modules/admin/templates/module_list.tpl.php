<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="220" align="center">';echo L('modulename');echo '</th>
			<th width=\'220\' align="center">';echo L('modulepath');echo '</th>
			<th width="14%" align="center">';echo L('versions');echo '</th>
			<th width=\'10%\' align="center">';echo L('installdate');echo '</th>
			<th width="10%" align="center">';echo L('updatetime');echo '</th>
			<th width="12%" align="center">';echo L('operations_manage');echo '</th>
            </tr>
        </thead>
    <tbody>
 ';
if (is_array($directory)){
foreach ($directory as $d){
if (array_key_exists($d,$modules)) {
;echo '   
	<tr>
	<td align="center" width="220">';echo $modules[$d]['name'];echo '</td>
	<td width="220" align="center">';echo $d;echo '</td>
	<td align="center">';echo $modules[$d]['version'];echo '</td>
	<td align="center">';echo $modules[$d]['installdate'];echo '</td>
	<td align="center">';echo $modules[$d]['updatedate'];echo '</td>
	<td align="center"> 
	';if ($modules[$d]['iscore']) {;echo '<span style="color: #999">';echo L('ban');echo '</span>';}else {;echo '<a href="javascript:void(0);" onclick="if(confirm(\'';echo L('confirm',array('message'=>$modules[$d]['name']));echo '\')){uninstall(\'';echo $d;echo '\');return false;}"><font color="red">';echo L('unload');echo '</font></a>';};echo '	</td>
	</tr>
';
}else {
$moduel = $isinstall = $modulename = '';
if (file_exists(H5_PATH.'modules'.DIRECTORY_SEPARATOR.$d.DIRECTORY_SEPARATOR.'install'.DIRECTORY_SEPARATOR.'config.inc.php')) {
require H5_PATH.'modules'.DIRECTORY_SEPARATOR.$d.DIRECTORY_SEPARATOR.'install'.DIRECTORY_SEPARATOR.'config.inc.php';
$isinstall = L('install');
}else {
$module = L('unknown');
$isinstall = L('no_install');
}
;echo '	<tr class="on">
	<td align="center" width="220">';echo $modulename;echo '</td>
	<td width="220" align="center">';echo $d;echo '</td>
	<td align="center">';echo L('unknown');echo '</td>
	<td align="center">';echo L('unknown');echo '</td>
	<td align="center">';echo L('uninstall_now');echo '</td>
	<td align="center">
	';if ($isinstall!=L('no_install')) {;echo ' <a href="javascript:install(\'';echo $d;echo '\');void(0);"><font color="#009933">';echo $isinstall;echo '</font>';}else {;echo '<font color="#009933">';echo $isinstall;echo '</font>';};echo '</a>
	</td>
	</tr>
';
}
}
}
;echo '</tbody>
    </table>
    </div>
 <div id="pages">';echo $pages;echo '</div>
</div>
<script type="text/javascript">
<!--

	function install(id) {
		window.top.art.dialog({id:\'install\'}).close();
		window.top.art.dialog({title:\'';echo L('module_istall');echo '\', id:\'install\', iframe:\'?s=admin/module/install/module/\'+id, width:\'500px\', height:\'260px\'}, function(){var d = window.top.art.dialog({id:\'install\'}).data.iframe;// 使用内置接口获取iframe对象
		var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'install\'}).close()});
	}

function uninstall(id) {
	window.top.art.dialog({id:\'install\'}).close();
	window.top.art.dialog({title:\'';echo L('module_unistall','','admin');echo '\', id:\'install\', iframe:\'?s=admin/module/uninstall/module/\'+id, width:\'500px\', height:\'260px\'}, function(){var d = window.top.art.dialog({id:\'install\'}).data.iframe;// 使用内置接口获取iframe对象
	var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'install\'}).close()});
}

//-->
</script>
</body>
</html>';?>