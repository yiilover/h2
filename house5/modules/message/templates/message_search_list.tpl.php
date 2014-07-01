<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10">
<form name="searchform" action="?s=message/message/search_message&menuid=';echo $_GET['menuid'];;echo '" method="post" >
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td><div class="explain-col">';echo L('query_type');echo ':';echo form::select($trade_status,$status,'name="search[status]"',L('all'));echo '      ';echo L('username');echo ':  <input type="text" value="';echo $username;;echo '" class="input-text" name="search[username]">  ';echo L('time');echo ':  ';echo form::date('search[start_time]',$start_time,'');echo ' ';echo L('to');echo '   ';echo form::date('search[end_time]',$end_time,'');echo '    <input type="submit" value="';echo L('search');echo '" class="button" name="dosubmit">
		</div>
		</td>
		</tr>
    </tbody>
</table>
</form>
<form name="myform" action="?s=message/message/delete" method="post" onsubmit="checkuid();return false;">
<div class="table-list">
<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th width="35" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall(\'messageid[]\');"></th>
			<th>';echo L('subject');echo '</th>
			<th width="35%" align="center">';echo L('content');echo '</th>
			<th width="10%" align="center">';echo L('fromuserid');echo '</th>
			<th width=\'10%\' align="center">';echo L('touserid');echo '</th>
			<th width="15%" align="center">';echo L('operations_manage');echo '</th>
		</tr>
	</thead>
<tbody>
';
if(is_array($infos)){
foreach($infos as $info){
;echo '	<tr>
		<td align="center" width="35"><input type="checkbox"
			name="messageid[]" value="';echo $info['messageid'];echo '"></td>
		<td>';echo $info['subject'];echo '</td>
		<td align="" widht="35%">';echo $info['content'];;echo '</td>
		<td align="center" width="10%">';echo $info['send_from_id'];echo '</td>
		<td align="center" width="10%">';echo $info['send_to_id'];;echo '</td>
		<td align="center" width="15%"><a
			href=\'?s=message/message/delete&messageid=';echo $info['messageid'];echo '\'
			onClick="return confirm(\'';echo L('confirm',array('message'=>$info['subject']));echo '\')">';echo L('delete');echo '</a>
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
	$("input[name=\'messageid[]\']:checked").each(function(i, n){
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