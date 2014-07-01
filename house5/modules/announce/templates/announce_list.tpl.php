<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10">
<form name="myform" action="?s=announce/admin_announce/listorder" method="post">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="35" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall(\'aid[]\');"></th>
			<th align="center">';echo L('title');echo '</th>
			<th width="68" align="center">';echo L('startdate');echo '</th>
			<th width=\'68\' align="center">';echo L('enddate');echo '</th>
			<th width=\'68\' align="center">';echo L('inputer');echo '</th>
			<th width="50" align="center">';echo L('hits');echo '</th>
			<th width="120" align="center">';echo L('inputtime');echo '</th>
			<th width="69" align="center">';echo L('operations_manage');echo '</th>
            </tr>
        </thead>
    <tbody>
 ';
if(is_array($data)){
foreach($data as $announce){
;echo '   
	<tr>
	<td align="center">
	<input type="checkbox" name="aid[]" value="';echo $announce['aid'];echo '">
	</td>
	<td>';echo $announce['title'];echo '</td>
	<td align="center">';echo $announce['starttime'];echo '</td>
	<td align="center">';echo $announce['endtime'];echo '</td>
	<td align="center">';echo $announce['username'];echo '</td>
	<td align="center">';echo $announce['hits'];echo '</td>
	<td align="center">';echo date('Y-m-d H:i:s',$announce['addtime']);echo '</td>
	<td align="center">
	<a href="javascript:edit(\'';echo $announce['aid'];echo '\', \'';echo safe_replace($announce['title']);echo '\');void(0);">';echo L('edit');echo '</a>
	</td>
	</tr>
';
}
}
;echo '</tbody>
    </table>
  
    <div class="btn"><label for="check_box">';echo L('selected_all');echo '/';echo L('cancel');echo '</label>
        ';if($_GET['s']==1) {;echo '<input name=\'submit\' type=\'submit\' class="button" value=\'';echo L('cancel_all_selected');echo '\' onClick="document.myform.action=\'?s=announce/admin_announce/public_approval/passed/0\'">';}elseif($_GET['s']==2) {;echo '<input name=\'submit\' type=\'submit\' class="button" value=\'';echo L('pass_all_selected');echo '\' onClick="document.myform.action=\'?s=announce/admin_announce/public_approval/passed/1\'">';};echo '&nbsp;&nbsp;
		<input name="submit" type="submit" class="button" value="';echo L('remove_all_selected');echo '" onClick="document.myform.action=\'?s=announce/admin_announce/delete\';return confirm(\'';echo L('affirm_delete');echo '\')">&nbsp;&nbsp;</div>  </div>
 <div id="pages">';echo $this->db->pages;;echo '</div>
</form>
</div>
</body>
</html>
<script type="text/javascript">
function edit(id, title) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit_announce');echo '--\'+title, id:\'edit\', iframe:\'?s=announce/admin_announce/edit/aid/\'+id ,width:\'700px\',height:\'500px\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;
	var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
</script>';?>