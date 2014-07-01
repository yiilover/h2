<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10"> 

<form name="form" action="?s=dianping/dianping/dianping_data&menuid=';echo $_GET['menuid'];;echo '" method="get" >
<input type="hidden" value="dianping/dianping/dianping_data" name="s">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td><div class="explain-col">';echo L('module');echo ': ';echo form::select($module_arr,'','name="search[module]"',$default);echo ' ';echo L('username');echo '  <input type="text" value="" class="input-text" name="search[username]" size=\'10\'>  ';echo L('times');echo '  ';echo form::date('search[start_time]','','1');echo ' ';echo L('to');echo '   ';echo form::date('search[end_time]','','1');echo '    <input type="submit" value="';echo L('determine_search');echo '" class="button" name="dosubmit"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
		</td>
		</tr>
    </tbody>
</table>
</form>

<form name="myform" id="myform" action="?s=dianping/dianping/delete_dianping_type" method="post" >
<div class="table-list">
<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th width="35" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall(\'dianpingid[]\');"></th>
			<th width="8%" align="center">';echo L('dianping_type_id');echo '</th>
 			<th width="30%">';echo L('dianping_type_name');echo '</th>
			<th width="50%" align="center">';echo L('dianping_type_data');echo '</th>
 			<th width="12%" align="center">';echo L('operations_manage');echo '</th>
		</tr>
	</thead>
<tbody>
';
if(is_array($infos)){
foreach($infos as $info){
;echo '	<tr>
		<td align="center" width="35"><input type="checkbox" name="dianpingid[]" value="';echo $info['id'];echo '"></td>
		<td width="8%" align="center">';echo $info['id'];;echo '</td>
 		<td width="30%">';echo $info['name'];echo '</td>
		<td align="center" width="50%">';echo $info['data'];;echo ' </td>
	  	<td align="center" width="12%">
		<a href="###" onclick="edit_type(';echo $info['id'];;echo ', \'';echo $info['name'];;echo '\')"
 title="';echo L('edit');echo '">';echo L('edit');echo '</a> |  <a href="javascript:call(';echo $info['id'];echo ');void(0);">';echo L('call_code');echo '</a>
		</td>
	</tr>
	';
}
}
;echo '</tbody>
</table>
</div>
<div class="btn"><a href="#"
	onClick="javascript:$(\'input[type=checkbox]\').attr(\'checked\', true)">';echo L('selected_all');echo '</a>/<a
	href="#"
	onClick="javascript:$(\'input[type=checkbox]\').attr(\'checked\', false)">';echo L('cancel');echo '</a>
<input name="submit" type="submit" class="button" value="';echo L('delete_select');;echo '" onClick="return confirm(';echo L('delete_confirm');;echo ')">&nbsp;&nbsp;
<input type="button" class="button" value="';echo L('update_dianpingtype');echo '" onClick="javascript:location.href=\'?s=dianping/dianping/do_js&h5_hash=';echo $_SESSION['h5_hash'];echo '\'">
</div>
<div id="pages">';echo $pages;echo '</div>
</form>
</div>
</body>
</html>
<script type="text/javascript">
function call(id) {
	window.top.art.dialog({id:\'call\'}).close();
	window.top.art.dialog({title:\'';echo L('call_code');echo '\', id:\'call\', iframe:\'?s=dianping/dianping/public_call&typeid=\'+id, width:\'600px\', height:\'300px\'}, function(){window.top.art.dialog({id:\'call\'}).close();}, function(){window.top.art.dialog({id:\'call\'}).close();})
}

function edit_type(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'ÐÞ¸Ä \'+name+\' \',id:\'edit\',iframe:\'?s=dianping/dianping/edit_type&dianpingid=\'+id,width:\'550\',height:\'350\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
} 
</script>

';?>