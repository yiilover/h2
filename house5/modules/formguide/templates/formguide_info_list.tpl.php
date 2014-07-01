<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10">
<form name="myform" action="?s=formguide/formguide_info/delete" method="post">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="35" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall(\'did[]\');"></th>
			<th align="center">';echo L('username');echo '</th>
			<th width=\'250\' align="center">';echo L('userip');echo '</th>
			<th width=\'250\' align="center">';echo L('times');echo '</th>
			<th width="250" align="center">';echo L('operation');echo '</th>
            </tr>
        </thead>
    <tbody>
 ';
if(is_array($datas)){
foreach($datas as $d){
;echo '   
	<tr>
	<td align="center">
	<input type="checkbox" name="did[]" value="';echo $d['dataid'];echo '">
	</td>
	<td>';echo $d['username'];echo ' </td>
	<td align="center">';echo $d['ip'];echo '</td>
	<td align="center">';echo date('Y-m-d',$d['datetime']);echo '</td>
	<td align="center"><a href="javascript:check(\'';echo $formid;echo '\', \'';echo $d['dataid'];echo '\', \'';echo safe_replace($d['username']);echo '\');void(0);">';echo L('check');echo '</a> | <a href="?s=formguide/formguide_info/public_delete/formid/';echo $formid;echo '/did/';echo $d['dataid'];echo '" onClick="return confirm(\'';echo L('confirm',array('message'=>L('delete')));echo '\')">';echo L('del');echo '</a></td>
	</tr>
';
}
}
;echo '</tbody>
    </table>
  
    <div class="btn"><label for="check_box">';echo L('selected_all');echo '/';echo L('cancel');echo '</label>
		<input name="submit" type="submit" class="button" value="';echo L('remove_all_selected');echo '" onClick="document.myform.action=\'?s=formguide/formguide_info/public_delete/formid/';echo $formid;echo '\';return confirm(\'';echo L('affirm_delete');echo '\')">&nbsp;&nbsp;</div>  </div>
 <div id="pages">';echo $pages;;echo '</div>
</form>
</div>
</body>
</html>
<script type="text/javascript">
function check(id, did, title) {
	window.top.art.dialog({id:\'check\'}).close();
	window.top.art.dialog({title:\'';echo L('check');echo '--\'+title+\'';echo L('submit_info');echo '\', id:\'edit\', iframe:\'?s=formguide/formguide_info/public_view/formid/\'+id+\'/did/\'+did ,width:\'700px\',height:\'500px\'}, function(){window.top.art.dialog({id:\'check\'}).close()});
}
</script>';?>