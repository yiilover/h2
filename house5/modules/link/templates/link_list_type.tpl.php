<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10">
<form name="myform" action="?s=link/link/delete_type" method="post" onsubmit="checkuid();return false;">
<div class="table-list">
<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th width="35" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall(\'typeid[]\');"></th>
			<th width="80">';echo L('link_type_listorder');echo '</th> 
			<th>';echo L('type_name');echo '</th>
			<th width="12%" align="center">';echo L('type_id');echo '</th> 
			<th width="20%" align="center">';echo L('operations_manage');echo '</th>
		</tr>
	</thead>
<tbody>
<tr>
		<td align="center" width="35"><input type="checkbox"
			name="typeid[]" value="';echo $info['typeid'];echo '" disabled></td>
		<td align="center"><input name=\'listorders[';echo $info['typeid'];echo ']\' type=\'text\' size=\'3\' value=\'';echo $info['listorder'];echo '\' class="input_center"></td> 
		<td>默认分类</td>
		<td align="center" width="12%"> 0</td>
		 <td align="center" width="20%" style="color: #999"> 修改  |  删除</td>
	</tr>
';
if(is_array($infos)){
foreach($infos as $info){
;echo '	<tr>
		<td align="center" width="35"><input type="checkbox"
			name="typeid[]" value="';echo $info['typeid'];echo '"></td>
		<td align="center"><input name=\'listorders[';echo $info['typeid'];echo ']\' type=\'text\' size=\'3\' value=\'';echo $info['listorder'];echo '\' class="input_center"></td> 
		<td>';echo $info['name'];echo '</td>
		<td align="center" width="12%"> ';echo $info['typeid'];;echo '</td>
		 <td align="center" width="20%"><a href="###"
			onclick="edit(';echo $info['typeid'];echo ', \'';echo new_addslashes($info['name']);echo '\')"
			title="';echo L('edit');echo '">';echo L('edit');echo '</a> |  <a
			href=\'?s=link/link/delete_type/typeid/';echo $info['typeid'];echo '\'
			onClick="return confirm(\'';echo L('confirm',array('message'=>new_addslashes($info['name'])));echo '\')">';echo L('delete');echo '</a>
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
<div id="pages">';echo $this->pages;echo '</div>
</form>
</div>
</body>
</html>
<script type="text/javascript">
function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit');echo ' \'+name+\' \',id:\'edit\',iframe:\'?s=link/link/edit_type/typeid/\'+id,width:\'450\',height:\'280\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
function checkuid() {
	var ids=\'\';
	$("input[name=\'typeid[]\']:checked").each(function(i, n){
		ids += $(n).val() + \',\';
	});
	if(ids==\'\') {
		window.top.art.dialog({content:"';echo L('before_select_operations');echo '",lock:true,width:\'200\',height:\'50\',time:1.5},function(){});
		return false;
	} else {
		myform.submit();
	}
}
</script>
';?>