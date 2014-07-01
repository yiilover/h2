<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10">
<form name="myform" id="myform" action="?s=link/link/check_register" method="post" onsubmit="checkuid();return false;">
<div class="table-list">
<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th width="35" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall(\'linkid[]\');"></th>
 			<th>';echo L('link_name');echo '</th>
 			<th width="20%" align="center">';echo L('url');echo '</th> 
			<th width="12%" align="center">';echo L('logo');echo '</th> 
			<th width="20%" align="center">';echo L('operations_manage');echo '</th>
		</tr>
	</thead>
<tbody>
';
if(is_array($infos)){
foreach($infos as $info){
;echo '	<tr>
		<td align="center" width="35"><input type="checkbox"
			name="linkid[]" value="';echo $info['linkid'];echo '"></td>
 		<td><a href="';echo $info['url'];;echo '" title="';echo L('go_website');echo '" target="_blank">';echo $info['name'];echo '</a></td>
		<th width="20%" align="center"><a href="';echo $info['url'];echo '" target="_blank">';echo $info['url'];echo '</a></th>
		<td align="center" width="12%">';if($info['linktype']==1){;echo '<img src="';echo $info['logo'];;echo '" width=83 height=31>';};echo '</td>
		 <td align="center" width="20%"><a href="###"
			onclick="edit(';echo $info['linkid'];echo ', \'';echo new_addslashes($info['name']);echo '\')"
			title="';echo L('edit');echo '">';echo L('edit');echo '</a> |  <a
			href=\'?s=link/link/delete/linkid/';echo $info['linkid'];echo '\'
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
<input name="dosubmit" type="submit" class="button"
	value="';echo L('pass_check');echo '"
	onClick="return confirm(\'';echo L('pass_or_not');echo '\')">&nbsp;&nbsp;<input type="submit" class="button" name="dosubmit" onclick="document.myform.action=\'?s=link/link/delete\'" value="';echo L('delete');echo '"/> </div>
<div id="pages">';echo $this->pages;echo '</div>
</form>
</div>
</body>
</html>
<script type="text/javascript">
function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit');echo ' \'+name+\' \',id:\'edit\',iframe:\'?s=link/link/edit/linkid/\'+id,width:\'700\',height:\'450\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
function checkuid() {
	var ids=\'\';
	$("input[name=\'linkid[]\']:checked").each(function(i, n){
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