<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<div class="table-list pad-lr-10">
<form name="myform" action="?s=admin/role/listorder" method="post">
    <table width="100%" cellspacing="0">
        <thead>
		<tr>
		<th width="10%">';echo L('listorder');;echo '</th>
		<th width="10%">ID</th>
		<th width="15%"  align="left" >';echo L('role_name');;echo '</th>
		<th width="265"  align="left" >';echo L('role_desc');;echo '</th>
		<th width="5%"  align="left" >';echo L('role_status');;echo '</th>
		<th class="text-c">';echo L('role_operation');;echo '</th>
		</tr>
        </thead>
<tbody>
';
if(is_array($infos)){
foreach($infos as $info){
;echo '<tr>
<td width="10%" align="center"><input name=\'listorders[';echo $info['roleid'];echo ']\' type=\'text\' size=\'3\' value=\'';echo $info['listorder'];echo '\' class="input-text-c"></td>
<td width="10%" align="center">';echo $info['roleid'];echo '</td>
<td width="15%"  >';echo $info['rolename'];echo '</td>
<td width="265" >';echo $info['description'];echo '</td>
<td width="5%"><a href="?s=admin/role/change_status/roleid/';echo $info['roleid'];echo '/disabled/';echo ($info['disabled']==1 ?0 : 1);echo '">';echo $info['disabled']?L('icon_locked'):L('icon_unlock');echo '</a></td>
<td  class="text-c">
';if($info['roleid'] >1) {;echo '<a href="javascript:setting_role(';echo $info['roleid'];echo ', \'';echo new_addslashes($info['rolename']);echo '\')">';echo L('role_setting');;echo '</a> | <a href="javascript:void(0)" onclick="setting_cat_priv(';echo $info['roleid'];echo ', \'';echo new_addslashes($info['rolename']);echo '\')">';echo L('usersandmenus');echo '</a> |
';}else {;echo '<font color="#cccccc">';echo L('role_setting');;echo '</font> | <font color="#cccccc">';echo L('usersandmenus');echo '</font> |
';};echo '<a href="?s=admin/role/member_manage/roleid/';echo $info['roleid'];echo '/menuid/';echo $_GET['menuid'];echo '">';echo L('role_member_manage');;echo '</a> | 
';if($info['roleid'] >1) {;echo '<a href="?s=admin/role/edit/roleid/';echo $info['roleid'];echo '/menuid/';echo $_GET['menuid'];echo '">';echo L('edit');echo '</a> | 
<a href="javascript:confirmurl(\'?s=admin/role/delete/roleid/';echo $info['roleid'];echo '\', \'';echo L('posid_del_cofirm');echo '\')">';echo L('delete');echo '</a>
';}else {;echo '<font color="#cccccc">';echo L('edit');echo '</font> | <font color="#cccccc">';echo L('delete');echo '</font>
';};echo '</td>
</tr>
';
}
}
;echo '</tbody>
</table>
<div class="btn"><input type="submit" class="button" name="dosubmit" value="';echo L('listorder');echo '" /></div>
</form>
</div>
</body>
<script type="text/javascript">
<!--
function setting_role(id, name) {

	window.top.art.dialog({title:\'';echo L('sys_setting');echo '¡¶\'+name+\'¡·\',id:\'edit\',iframe:\'?s=admin/role/priv_setting/roleid/\'+id,width:\'700\',height:\'500\'});
}

function setting_cat_priv(id, name) {

	window.top.art.dialog({title:\'';echo L('usersandmenus');echo '¡¶\'+name+\'¡·\',id:\'edit\',iframe:\'?s=admin/role/setting_cat_priv/roleid/\'+id,width:\'700\',height:\'500\'});
}
//-->
</script>
</html>
';?>