<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<div class="pad-lr-10">
<div class="table-list">

<div class="explain-col">
';echo L('move_member_model_index_alert');echo '</div>

<div class="bk10"></div>
<form name="myform" id="myform" action="?s=member/member_model/delete" method="post" onsubmit="check();return false;">
<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th align="left">ID</th>
			<th>';echo L('sort');echo '</th>
			<th align="left">';echo L('model_name');echo '</th>
			<th align="left">';echo L('model_description');echo '</th>
			<th align="left">';echo L('table_name');echo '</th>
			<th align="center">';echo L('status');echo '</th>
			<th>';echo L('operation');echo '</th>
		</tr>
	</thead>
<tbody>
';
foreach($member_model_list as $k=>$v) {
;echo '    <tr>
		<td align="left">';echo $v['modelid'];echo '</td>
		<td align="center"><input type="text" name="sort[';echo $v['modelid'];echo ']" class="input-text" size="1" value="';echo $v['sort'];echo '"></th>
		<td align="left">';echo $v['name'];echo '</td>
		<td align="left">';echo $v['description'];echo '</td>
		<td align="left">';echo $this->db->db_tablepre.$v['tablename'];echo '</td>
		<td align="center">';echo $v['disabled'] ?L('icon_locked') : L('icon_unlock');echo '</td>
		<td align="center">
		<a onclick="_M(892);" href="?s=member/member_modelfield/manage&modelid=';echo $v['modelid'];echo '&menuid=892">';echo L('field').L('manage');echo '</a> | <a href="javascript:edit(';echo $v['modelid'];echo ', \'';echo $v['name'];echo '\')">';echo L('edit');echo '</a> | <a href="?s=member/member_model/export&modelid=';echo $v['modelid'];echo '">';echo L('export');echo '</a> | <a href="javascript:move(';echo $v['modelid'];echo ', \'';echo $v['name'];echo '\')">';echo L('move');echo '</a>
		</td>
    </tr>
';
}
;echo '</tbody>
</table>

<div class="btn"><input type="submit" class="button" name="dosubmit" onclick="document.myform.action=\'?s=member/member_model/sort\'" value="';echo L('sort');echo '"/>
</div> 
<div id="pages">';echo $pages;echo '</div>
</div>
</div>
</form>
<div id="h5__contentHeight" style="display:none">160</div>

<script language="JavaScript">
<!--
function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit').L('member_model');echo '¡¶\'+name+\'¡·\',id:\'edit\',iframe:\'?s=member/member_model/edit&modelid=\'+id,width:\'700\',height:\'500\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}

function move(id, name) {
	window.top.art.dialog({id:\'move\'}).close();
	window.top.art.dialog({title:\'';echo L('move');echo '¡¶\'+name+\'¡·\',id:\'move\',iframe:\'?s=member/member_model/move&modelid=\'+id,width:\'700\',height:\'500\'}, function(){var d = window.top.art.dialog({id:\'move\'}).data.iframe;d.$(\'#dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'move\'}).close()});
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

//ÐÞ¸Ä²Ëµ¥µØÖ·À¸
function _M(menuid) {
	$.get("?s=admin/index/public_current_pos&menuid="+menuid, function(data){
		parent.$("#current_pos").html(data);
	});
}

//-->
</script>
</body>
</html>';?>