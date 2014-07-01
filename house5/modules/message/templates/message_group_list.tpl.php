<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10">

<form name="myform" action="?s=message/message/delete_group" method="post" onsubmit="checkuid();return false;">
<div class="table-list">
<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th width="35" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall(\'message_group_id[]\');"></th>
			<th>';echo L('subject');echo '</th>
			<th width="35%" align="center">';echo L('content');echo '</th>
			<th width="15%" align="center">';echo L('sendtime');echo '</th>
			<th width=\'10%\' align="center">';echo L('status');echo '</th>
			<th width="10%" align="center">';echo L('operations_manage');echo '</th>
		</tr>
	</thead>
<tbody>
';
if(is_array($infos)){
foreach($infos as $info){
;echo '	<tr>
		<td align="center" width="35"><input type="checkbox"
			name="message_group_id[]" value="';echo $info['id'];echo '"></td>
		<td>';echo $info['subject'];echo '</td>
		<td align="" widht="35%">';echo $info['content'];;echo '</td>
		<td align="center" width="15%">';echo date('Y-m-d H:i:s',$info['inputtime']);;echo '</td>
		<td align="center" width="10%">';if($info['status']==1){echo L('show_m');}else {echo '<font color=red>'.L('close').'</font>';};echo '</td>
		<td align="center" width="10%"> <a
			href=\'?s=message/message/delete_group&message_group_id=';echo $info['id'];echo '\'
			onClick="return confirm(\'';echo L('confirm',array('message'=>new_addslashes($info['subject'])));echo '\')">';echo L('delete');echo '</a>
		</td>
	</tr>
	';
}
}
;echo '</tbody>
</table>
<div class="btn"><a href="#"
	onClick="javascript:$(\'input[type=checkbox]\').attr(\'checked\', true)">';echo L('selected_all');echo '</a>/<a
	href="#"
	onClick="javascript:$(\'input[type=checkbox]\').attr(\'checked\', false)">';echo L('cancel');echo '</a>
<input name="submit" type="submit" class="button"
	value="';echo L('remove_all_selected');echo '"
	onClick="return confirm(\'';echo L('confirm',array('message'=>L('selected')));echo '\')">&nbsp;&nbsp;</div>
<div id="pages">';echo $pages;echo '</div>
</div>
</form>
</div>
<script type="text/javascript">

function see_all(id, name) {
	window.top.art.dialog({id:\'sell_all\'}).close();
	window.top.art.dialog({title:\'';echo L('details');
;echo ' \'+name+\' \',id:\'edit\',iframe:\'?s=message/message/see_all&messageid=\'+id,width:\'700\',height:\'450\'}, function(){var d = window.top.art.dialog({id:\'see_all\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'see_all\'}).close()});
}
function checkuid() {
	var ids=\'\';
	$("input[name=\'message_group_id[]\']:checked").each(function(i, n){
		ids += $(n).val() + \',\';
	});
	if(ids==\'\') {
		window.top.art.dialog({content:"';echo L('before_select_operation');echo '",lock:true,width:\'200\',height:\'50\',time:1.5},function(){});
		return false;
	} else {
		myform.submit();
	}
}

</script>
</body>
</html>
';?>