<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10">
<form name="myform" action="?s=vote/vote/delete" method="post" onsubmit="checkuid();return false;">
<div class="table-list">
<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th width="35" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall(\'subjectid[]\');"></th>
			<th>';echo L('title');echo '</th>
			<th width="40" align="center">';echo L('vote_num');echo '</th>
			<th width="68" align="center">';echo L('startdate');echo '</th>
			<th width="68" align="center">';echo L('enddate');echo '</th>
			<th width=\'68\' align="center">';echo L('inputtime');echo '</th>
			<th width="180" align="center">';echo L('operations_manage');echo '</th>
		</tr>
	</thead>
<tbody>
';
if(is_array($infos)){
foreach($infos as $info){
;echo '	<tr>
		<td align="center"><input type="checkbox"
			name="subjectid[]" value="';echo $info['subjectid'];echo '"></td>
		<td><a href="?s=vote/index/show&show_type=1&subjectid=';echo $info['subjectid'];echo '&siteid=';echo $info['siteid'];;echo '" title="';echo L('check_vote');echo '" target="_blank">';echo $info['subject'];;echo '</a> <font color=red>';if($info['enabled']==0)echo L('lock');;echo '</font></td>
		<td align="center"><font color=blue>';echo $info['votenumber'];echo '</font> </td>
		<td align="center">';echo $info['fromdate'];;echo '</td>
		<td align="center">';echo $info['todate'];;echo '</td>
		<td align="center">';echo date("Y-m-d",$info['addtime']);;echo '</td>
		<td align="center"><a href=\'###\'
			onclick="statistics(';echo $info['subjectid'];echo ', \'';echo new_addslashes($info['subject']);echo '\')"> ';echo L('statistics');echo '</a>
		| <a href="###"
			onclick="edit(';echo $info['subjectid'];echo ', \'';echo new_addslashes($info['subject']);echo '\')"
			title="';echo L('edit');echo '">';echo L('edit');echo '</a> | <a href="javascript:call(';echo new_addslashes($info['subjectid']);echo ');void(0);">';echo L('call_js_code');echo '</a> | <a
			href=\'?s=vote/vote/delete&subjectid=';echo new_addslashes($info['subjectid']);echo '\'
			onClick="return confirm(\'';echo L('vote_confirm_del');echo '\')">';echo L('delete');echo '</a>
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
	onClick="return confirm(\'';echo L('vote_confirm_del');echo '\')">&nbsp;&nbsp;</div>
<div id="pages">';echo $pages;echo '</div>
</form>
</div>
<script type="text/javascript">
 
function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit');echo ' \'+name+\' \',id:\'edit\',iframe:\'?s=vote/vote/edit&subjectid=\'+id,width:\'700\',height:\'450\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
function statistics(id, name) {
	window.top.art.dialog({id:\'statistics\'}).close();
	window.top.art.dialog({title:\'';echo L('statistics');echo ' \'+name+\' \',id:\'edit\',iframe:\'?s=vote/vote/statistics&subjectid=\'+id,width:\'700\',height:\'350\'}, function(){var d = window.top.art.dialog({id:\'statistics\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'statistics\'}).close()});
}

function call(id) {
	window.top.art.dialog({id:\'call\'}).close();
	window.top.art.dialog({title:\'';echo L('vote');echo '';echo L('linkage_calling_code','','admin');;echo '\', id:\'call\', iframe:\'?s=vote/vote/public_call&subjectid=\'+id, width:\'600px\', height:\'470px\'}, function(){window.top.art.dialog({id:\'call\'}).close();}, function(){window.top.art.dialog({id:\'call\'}).close();})
}

function checkuid() {
	var ids=\'\';
	$("input[name=\'subjectid[]\']:checked").each(function(i, n){
		ids += $(n).val() + \',\';
	});
	if(ids==\'\') {
		window.top.art.dialog({content:\'';echo L('before_select_operation');echo '\',lock:true,width:\'200\',height:\'50\',time:1.5},function(){});
		return false;
	} else {
		myform.submit();
	}
}

</script>
</body>
</html>
';?>