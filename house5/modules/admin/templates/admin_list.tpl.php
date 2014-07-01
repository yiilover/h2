<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<div class="pad_10">
<div class="table-list">
<form name="myform" action="?s=admin/role/listorder" method="post">
    <table width="100%" cellspacing="0">
        <thead>
		<tr>
		<th width="10%">';echo L('userid');echo '</th>
		<th width="10%" align="left" >';echo L('username');echo '</th>
		<th width="10%" align="left" >';echo L('userinrole');echo '</th>
		<th width="10%"  align="left" >';echo L('lastloginip');echo '</th>
		<th width="20%"  align="left" >';echo L('lastlogintime');echo '</th>
		<th width="15%"  align="left" >';echo L('email');echo '</th>
		<th width="10%">';echo L('realname');echo '</th>
		<th width="15%" >';echo L('operations_manage');echo '</th>
		</tr>
        </thead>
        <tbody>
';$admin_founders = explode(',',h5_base::load_config('system','admin_founders'));;echo '';
if(is_array($infos)){
foreach($infos as $info){
;echo '<tr';if($info['disabled']){;echo ' style="background-color: rgb(238, 238, 238);"';};echo '>
<td width="10%" align="center">';echo $info['userid'];echo '</td>
<td width="10%" >';echo $info['username'];echo '</td>
<td width="10%" >';echo $roles[$info['roleid']];echo '</td>
<td width="10%" >';echo $info['lastloginip'];echo '</td>
<td width="20%"  >';echo $info['lastlogintime'] ?date('Y-m-d H:i:s',$info['lastlogintime']) : '';echo '</td>
<td width="15%">';echo $info['email'];echo '</td>
<td width="10%"  align="center">';echo $info['realname'];echo '</td>
<td width="15%"  align="center">
<a href="javascript:edit(';echo $info['userid'];echo ', \'';echo new_addslashes($info['username']);echo '\')">';echo L('edit');echo '</a> | 
';if(!in_array($info['userid'],$admin_founders)) {;echo '<a href="javascript:confirmurl(\'?s=admin/admin_manage/delete/userid/';echo $info['userid'];echo '\', \'';echo L('admin_del_cofirm');echo '\')">';echo L('delete');echo '</a>
';}else {;echo '<font color="#cccccc">';echo L('delete');echo '</font>
';};echo '</a>
</td>
</tr>
';
}
}
;echo '</tbody>
</table>
 <div id="pages"> ';echo $pages;echo '</div>
</form>
</div>
</div>
</body>
</html>
<script type="text/javascript">
<!--
	function edit(id, name) {
		window.top.art.dialog({title:\'';echo L('edit');echo '--\'+name, id:\'edit\', iframe:\'?s=admin/admin_manage/edit/userid/\'+id ,width:\'500px\',height:\'400px\'}, 	function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;
		var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
	}

function card(id) {
	window.top.art.dialog({title:\'';echo L('the_password_card');echo '\', id:\'edit\', iframe:\'?s=admin/admin_manage/card/userid/\'+id ,width:\'500px\',height:\'400px\'}, 	\'\', function(){window.top.art.dialog({id:\'edit\'}).close()});
}
//-->
</script>';?>