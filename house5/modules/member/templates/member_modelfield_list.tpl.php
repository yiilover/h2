<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<div class="pad-lr-10">
<div class="table-list">

<div class="bk10"></div>
<form name="myform" id="myform" action="?s=member/member_modelfield/sort" method="post" onsubmit="check();return false;">
    <table width="100%" cellspacing="0" >
        <thead>
            <tr>
			 <th width="70">';echo L('listorder');echo '</th>
            <th width="90">';echo L('fieldname');echo '</th>
			<th width="100">';echo L('cnames');;echo '</th>
			<th width="100">';echo L('type');;echo '</th>
            <th width="50">';echo L('must_input');;echo '</th>
            <th width="50">';echo L('search');;echo '</th>
            <th width="50">';echo L('listorder');;echo '</th>
			<th width="50">';echo L('disabled');;echo '</th>
			<th >';echo L('operations_manage');;echo '</th>
            </tr>
        </thead>
    <tbody class="td-line">
	';
foreach($datas as $r) {
;echo '    <tr>
		<td align=\'center\' width=\'70\'>
			<input name=\'listorders[';echo $r['fieldid'];echo ']\' type=\'text\' size=\'3\' value=\'';echo $r['listorder'];echo '\' class=\'input-text-c\'>
		</td>
		<td width=\'90\'>';echo $r['field'];echo '</td>
		<td width="100">';echo $r['name'];echo '</td>
		<td width="100" align=\'center\'>';echo $r['formtype'];echo '</td>
		<td width="50" align=\'center\'>
			';echo $r['isbase'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td width="50" align=\'center\'>
			';echo $r['issearch'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td width="50" align=\'center\'>
			';echo $r['isorder'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td width="50" align=\'center\'>
			';echo $r['disabled'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td align=\'center\'>
			<a href="javascript:edit(';echo $r['modelid'];echo ', ';echo $r['fieldid'];echo ', \'';echo $r['name'];echo '\')">';echo L('modify');echo '</a> | 
			';if(!$r['disabled']) {;echo '			<a href="?s=member/member_modelfield/disable&disabled=1&fieldid=';echo $r['fieldid'];echo '&menuid=';echo $_GET['menuid'];echo '">';echo L('disable');echo '</a>
			';}else {;echo '			<a href="?s=member/member_modelfield/disable&disabled=0&fieldid=';echo $r['fieldid'];echo '&menuid=';echo $_GET['menuid'];echo '">';echo L('enable');echo '</a>
			';};echo ' | 
			<a href="javascript:confirmurl(\'?s=member/member_modelfield/delete&fieldid=';echo $r['fieldid'];echo '&menuid=';echo $_GET['menuid'];echo '\',\'';echo L('sure_delete');echo '\')">';echo L('delete');echo '</a>
		</td>
	</tr>
	';};echo '    </tbody>
    </table>

<div class="btn"><input type="submit" class="button" name="dosubmit" value="';echo L('sort');echo '"/>
</div> 
<div id="pages">';if(isset($pages)){echo $pages;};echo '</div>
</div>
</div>
</form>
<div id="h5__contentHeight" style="display:none">160</div>
<script language="JavaScript">
<!--
function edit(modelid, fieldid, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit').L('field');echo '¡¶\'+name+\'¡·\',id:\'edit\',iframe:\'?s=member/member_modelfield/edit&modelid=\'+modelid+\'&fieldid=\'+fieldid,width:\'700\',height:\'500\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}

function move(id, name) {
	window.top.art.dialog({id:\'move\'}).close();
	window.top.art.dialog({title:\'';echo L('move');echo '¡¶\'+name+\'¡·\',id:\'move\',iframe:\'?s=member/member_model/move&modelid=\'+id,width:\'700\',height:\'500\'}, function(){var d = window.top.art.dialog({id:\'move\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'move\'}).close()});
}

function check() {
	if(myform.action == \'?s=member/member_model/delete\') {
		var ids=\'\';
		$("input[name=\'modelid[]\']:checked").each(function(i, n){
			ids += $(n).val() + \',\';
		});
		if(ids==\'\') {
			window.top.art.dialog({content:\'';echo L('plsease_select').L('member_model');echo '\',lock:true,width:\'200\',height:\'50\',time:1.5},function(){});
			return false;
		}
	}
	myform.submit();
}
//-->
</script>
</body>
</html>';?>