<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<div class="pad_10">
<div class="table-list">
    <table width="100%" cellspacing="0" >
        <thead>
            <tr>
            <th width="60">ID</th>
            <th>';echo L('respective_modules');;echo '</th>
            <th>';echo L('rulename');;echo '</th>
            <th>';echo L('urlrule_ishtml');;echo '</th>
            <th>';echo L('urlrule_example');;echo '</th>
            <th>';echo L('urlrule_url');;echo '</th>
			<th width="100">';echo L('operations_manage');;echo '</th>
            </tr>
        </thead>
    <tbody>
	';foreach($infos as $r) {;echo '    <tr>
		<td align=\'center\'>';echo $r['urlruleid'];;echo '</td>
		<td align="center">';echo $r['module'];;echo '</td>
		<td align="center">';echo $r['file'];;echo '</td>
		<td align="center">';echo $r['ishtml'] ?L('icon_unlock') : L('icon_locked');;echo '</td>
		<td>';echo $r['example'];;echo '</td>
		<td>';echo $r['urlrule'];;echo '</td>
		<td align=\'center\' ><a href="javascript:edit(\'';echo $r['urlruleid'];echo '\')">';echo L('edit');;echo '</a> | <a href="javascript:confirmurl(\'?s=admin/urlrule/delete/urlruleid/';echo $r['urlruleid'];;echo '/menuid/';echo $_GET['menuid'];;echo '\',\'';echo L('confirm',array('message'=>$r['urlruleid']));;echo '\')">';echo L('delete');;echo '</a> </td>
	</tr>
	';};echo '	</tbody>
    </table>
  
    <div id="pages">';echo $pages;;echo '</div>
</div>
</div>
<script type="text/javascript"> 
<!--
function edit(id) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit_urlrule');;echo '¡¶\'+id+\'¡·\',id:\'edit\',iframe:\'?s=admin/urlrule/edit/urlruleid/\'+id,width:\'750\',height:\'300\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
//-->
</script>
</body>
</html>
';?>