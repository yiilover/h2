<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<form name="myform" action="?s=admin/position/listorder" method="post">
<div class="pad_10">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="35%"  align="left">';echo L('plugin_list_name','','plugin');echo '</th>
            <th width="10%">';echo L('plugin_list_version','','plugin');echo '</th>
            <th width="15%">';echo L('plugin_list_copy','','plugin');echo '</th>
            <th width="10%">';echo L('plugin_list_dir','','plugin');echo '</th>
            <th width="15%"></th>
            </tr>
        </thead>
    <tbody>
 ';
if(is_array($pluginfo)){
foreach($pluginfo as $info){
;echo '   
	<tr>
	<td width="35%">';echo $info['name'];echo '</td>
	<td  width="10%" align="center">';echo $info['version'];echo '</td>
	<td  width="15%" align="center">';echo $info['copyright'];echo '</td>
	<td width="10%" align="center">';echo $info['dir'];echo '/</td>
	<td width="15%" align="center"><a href="?s=admin/plugin/import/dir/';echo $info['dir'];echo '/menuid/';echo $_GET['menuid'];echo '">';echo L('plugin_install','','plugin');echo '</a></td>
	</tr>
';
}
}
;echo '    </tbody>
    </table>
  
    <div class="btn"></div>  </div>

 <div id="pages"> ';echo $pages;echo '</div>
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