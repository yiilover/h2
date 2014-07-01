<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<div class="pad-lr-10">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="10%"  align="left">SITEID</th>
            <th width="">';echo L('wap_sitename');echo '</th>
            <th width="20%">';echo L('status');echo '</th>
            <th width="15%">';echo L('operations_manage');echo '</th>
            </tr>
        </thead>
    <tbody>
 ';
if(is_array($infos)){
foreach($infos as $info){
;echo '   
	<tr>
	<td width="10%">';echo $info['siteid'];echo '</td>
	<td  width="" align="center"><a href="';echo APP_PATH;echo 'index.php?s=wap&siteid=';echo $info['siteid'];echo '" target="_blank">';echo $info['sitename'];echo '</a></td>
	<td width="20%" align="center"><a href="?s=wap/wap_admin/public_status&siteid=';echo $info['siteid'];echo '&status=';echo $info['status']==0 ?1 : 0;echo '">';echo $info['status']==0 ?L('wap_close') : L('wap_open');echo '</a></td>
	<td width="15%" align="center">
	<a href="javascript:edit(';echo $info['siteid'];echo ', \'';echo new_addslashes($info['sitename']);echo '\')">';echo L('edit');echo '</a> | <a href="?s=wap/wap_admin/type_manage&siteid=';echo $info['siteid'];echo '&menuid=';echo $_GET['menuid'];echo '">';echo L('wap_type_manage');echo '</a>
	</td>
	</tr>
';
}
}
;echo '    </tbody>
    </table>
 </div>

 <div id="pages"> ';echo $pages;echo '</div>
</div>
</div>
</body>
<a href="javascript:edit(';echo $v['siteid'];echo ', \'';echo $v['name'];echo '\')">
</html>
<script type="text/javascript">
<!--
	function edit(siteid, name) {
	window.top.art.dialog({title:\'';echo L('edit');echo '--\'+name, id:\'edit\', iframe:\'?s=wap/wap_admin/edit&siteid=\'+siteid ,width:\'400px\',height:\'240px\'}, 	function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;
	var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
//-->
</script>';?>