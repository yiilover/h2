<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10">
<form name="myform" id="myform" action="?s=admin/badword/delete" method="post" onsubmit="checkuid();return false;">
<div class="table-list">
 <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="35" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall(\'badid[]\');"></th>
             <th >';echo L('badword_name');echo '</th>
            <th >';echo L('badword_replacename');echo '</th>
            <th width="80">';echo L('badword_level');echo '</th>
            <th width="120">';echo L('inputtime');echo '</th>
             <th width="120">';echo L('operations_manage');echo '</th>
            </tr>
        </thead>
    <tbody>
 ';
if(is_array($infos)){
foreach($infos as $info){
;echo '    <tr>
    <td align="center">
	<input type="checkbox" name="badid[]" value="';echo $info['badid'];echo '">
	</td>
         <td align="center"><span  class="';echo $info['style'];echo '">';echo $info['badword'];echo '</span> </td>
        <td align="center">';echo $info['replaceword'];echo '</td>
        <td align="center">';echo $level[$info['level']];echo '</td>
        <td align="center">';echo $info['lastusetime'] ?date('Y-m-d H:i',$info['lastusetime']):'';echo '</td>
         <td align="center"><a href="javascript:edit(';echo $info['badid'];echo ', \'';echo new_addslashes($info['badword']);echo '\')">';echo L('edit');echo '</a> | <a href="javascript:confirmurl(\'?s=admin/badword/delete/badid/';echo $info['badid'];echo '\', \'';echo L('badword_confirm_del');echo '\')">';echo L('delete');echo '</a> </td>
    </tr>
';
}
}
;echo '</tbody>
 </table>
 <div class="btn">
 <a href="#" onClick="javascript:$(\'input[type=checkbox]\').attr(\'checked\', true)">';echo L('selected_all');echo '</a>/<a href="#" onClick="javascript:$(\'input[type=checkbox]\').attr(\'checked\', false)">';echo L('cancel');echo '</a>
<input type="submit" name="submit" class="button" value="';echo L('remove_all_selected');echo '" onClick="return confirm(\'';echo L('badword_confom_del');echo '\')" /> 
</div> 
<div id="pages">';echo $pages;echo '</div>
</div>
</form>
</div>
</body>
</html>
<script type="text/javascript">
function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('badword_edit');echo ' \'+name+\' \',id:\'edit\',iframe:\'?s=admin/badword/edit/badid/\'+id,width:\'450\',height:\'180\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}

function checkuid() {
	var ids=\'\';
	$("input[name=\'badid[]\']:checked").each(function(i, n){
		ids += $(n).val() + \',\';
	});
	if(ids==\'\') {
		window.top.art.dialog({content:\'';echo L('badword_pleasechose');echo '\',lock:true,width:\'200\',height:\'50\',time:1.5},function(){});
		return false;
	} else {
		myform.submit();
	}
}
</script>

 ';?>