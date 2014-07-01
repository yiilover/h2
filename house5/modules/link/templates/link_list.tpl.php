<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td><div class="explain-col"> 
		';echo L('all_linktype');echo ': &nbsp;&nbsp; <a href="?s=link/link">';echo L('all');echo '</a> &nbsp;&nbsp;
		<a href="?s=link/link&typeid=0">默认分类</a>&nbsp;
		';
if(is_array($type_arr)){
foreach($type_arr as $typeid =>$type){
;echo '<a href="?s=link/link&typeid=';echo $typeid;;echo '">';echo $type;;echo '</a>&nbsp;
		';}};echo '		</div>
		</td>
		</tr>
    </tbody>
</table>
<form name="myform" id="myform" action="?s=link/link/listorder" method="post" >
<div class="table-list">
<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th width="35" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall(\'linkid[]\');"></th>
			<th width="35" align="center">';echo L('listorder');echo '</th>
			<th>';echo L('link_name');echo '</th>
			<th width="12%" align="center">';echo L('logo');echo '</th>
			<th width="10%" align="center">';echo L('typeid');echo '</th>
			<th width=\'10%\' align="center">';echo L('link_type');echo '</th>
			<th width="8%" align="center">';echo L('status');echo '</th>
			<th width="12%" align="center">';echo L('operations_manage');echo '</th>
		</tr>
	</thead>
<tbody>
';
if(is_array($infos)){
foreach($infos as $info){
;echo '	<tr>
		<td align="center" width="35"><input type="checkbox" name="linkid[]" value="';echo $info['linkid'];echo '"></td>
		<td align="center" width="35"><input name=\'listorders[';echo $info['linkid'];echo ']\' type=\'text\' size=\'3\' value=\'';echo $info['listorder'];echo '\' class="input-text-c"></td>
		<td><a href="';echo $info['url'];;echo '" title="';echo L('go_website');echo '" target="_blank">';echo $info['name'];echo '</a> </td>
		<td align="center" width="12%">';if($info['linktype']==1){;echo '<img src="';echo $info['logo'];;echo '" width=83 height=31>';};echo '</td>
		<td align="center" width="10%">';echo $type_arr[$info['typeid']];;echo '</td>
		<td align="center" width="10%">';if($info['linktype']==0){echo L('word_link');}else{echo L('logo_link');};echo '</td>
		<td width="8%" align="center">';if($info['passed']=='0'){;echo '<a
			href=\'?s=link/link/check/linkid/';echo $info['linkid'];echo '\'
			onClick="return confirm(\'';echo L('pass_or_not');echo '\')"><font color=red>';echo L('audit');echo '</font></a>';}else{echo L('passed');};echo '</td>
		<td align="center" width="12%"><a href="###"
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
</div>
<div class="btn"> 
<input name="dosubmit" type="submit" class="button"
	value="';echo L('listorder');echo '">&nbsp;&nbsp;<input type="submit" class="button" name="dosubmit" onClick="document.myform.action=\'?s=link/link/delete\'" value="';echo L('delete');echo '"/></div>
<div id="pages">';echo $pages;echo '</div>
</form>
</div>
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
//向下移动
function listorder_up(id) {
	$.get(\'?s=link/link/listorder_up/linkid/\'+id,null,function (msg) { 
	if (msg==1) { 
	//$("div [id=\\\'option"+id+"\\\']").remove(); 
		alert(\'';echo L('move_success');echo '\');
	} else {
	alert(msg); 
	} 
	}); 
} 
</script>
</body>
</html>
';?>