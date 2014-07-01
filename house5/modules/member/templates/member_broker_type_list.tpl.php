<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '
<form name="myform" id="myform" action="?s=member/member_broker_type/delete" method="post" onsubmit="check();return false;">
<div class="pad-lr-10">
<div class="table-list">

<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th align="left" width="30px"><input type="checkbox" value="" id="check_box" onclick="selectall(\'typeid[]\');"></th>
			<th align="left">ID</th>
			<th>';echo L('sort');echo '</th>
			<th>经纪人类型</th>
			<th>';echo L('issystem');echo '</th>
			<th>';echo L('membernum');echo '</th>
			<th>';echo L('starnum');echo '</th>
			<th>';echo L('pointrange');echo '</th>
			<th>';echo L('allowattachment');echo '</th>
			<th>';echo L('allowpost');echo '</th>
			<th>';echo L('member_group_publish_verify');echo '</th>
			<th>';echo L('allowsearch');echo '</th>
			<th>';echo L('allowupgrade');echo '</th>
			<th>';echo L('allowsendmessage');echo '</th>
			<th>';echo L('operation');echo '</th>
		</tr>
	</thead>
<tbody>
';
foreach($member_group_list as $k=>$v) {
;echo '    <tr>
		<td align="left">';if(!$v['issystem']) {;echo '<input type="checkbox" value="';echo $v['typeid'];echo '" name="typeid[]">';};echo '</td>
		<td align="left">';echo $v['typeid'];echo '</td>
		<td align="center"><input type="text" name="sort[';echo $v['typeid'];echo ']" class="input-text" size="1" value="';echo $v['sort'];echo '"></th>
		<td align="center" title="';echo $v['description'];echo '">';echo $v['name'];echo '</td>
		<td align="center">';echo $v['issystem'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td align="center">';echo $v['membernum'];echo '</th>
		<td align="center">';echo $v['starnum'];echo '</td>
		<td align="center">';echo $v['point'];echo '</td>
		<td align="center">';echo $v['allowattachment'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td align="center">';echo $v['allowpost'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td align="center">';echo $v['allowpostverify'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td align="center">';echo $v['allowsearch'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td align="center">';echo $v['allowupgrade'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td align="center">';echo $v['allowsendmessage'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td align="center"><a href="javascript:edit(';echo $v['typeid'];echo ', \'';echo $v['name'];echo '\')">[';echo L('edit');echo ']</a></td>
    </tr>
';
}
;echo '</tbody>
 </table>

<div class="btn"><label for="check_box">';echo L('select_all');echo '/';echo L('cancel');echo '</label> <input type="submit" class="button" name="dosubmit" value="';echo L('delete');echo '" onclick="return confirm(\'';echo L('sure_delete');echo '\')"/>
<input type="submit" class="button" name="dosubmit" onclick="document.myform.action=\'?s=member/member_broker_type/sort\'" value="';echo L('sort');echo '"/>
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
	window.top.art.dialog({title:\'';echo L('edit').L('member_group');echo '《\'+name+\'》\',id:\'edit\',iframe:\'?s=member/member_broker_type/edit&typeid=\'+id,width:\'700\',height:\'500\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}

function check() {
	if(myform.action == \'?s=member/member_broker_type/delete\') {
		var ids=\'\';
		$("input[name=\'typeid[]\']:checked").each(function(i, n){
			ids += $(n).val() + \',\';
		});
		if(ids==\'\') {
			window.top.art.dialog({content:\'';echo L('plsease_select').L('member_group');echo '\',lock:true,width:\'200\',height:\'50\',time:1.5},function(){});
			return false;
		}
	}
	myform.submit();
}
//-->
</script>
</body>
</html>';?>