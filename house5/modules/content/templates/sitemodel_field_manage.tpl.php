<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<div class="subnav">
  <h2 class="title-1 line-x f14 fb blue lh28">';echo L('model_manage');;echo '--';echo $r['name'];;echo '';echo L('field_manage');;echo '</h2>
<div class="content-menu ib-a blue line-x"><a class="add fb" href="?s=content/sitemodel_field/add/modelid/';echo $modelid;echo '/menuid/';echo $_GET['menuid'];echo '"><em>';echo L('add_field');;echo '</em></a>
¡¡<a class="on" href="?s=content/sitemodel_field/init/modelid/';echo $modelid;echo '/menuid/';echo $_GET['menuid'];echo '"><em>';echo L('manage_field');;echo '</em></a><span>|</span><a href="?s=content/sitemodel_field/public_priview/modelid/';echo $modelid;echo '/menuid/';echo $_GET['menuid'];echo '" target="_blank"><em>';echo L('priview_modelfield');;echo '</em></a>
</div></div>
<div class="pad-lr-10">
<form name="myform" action="?s=content/sitemodel_field/listorder" method="post">
<div class="table-list">
    <table width="100%" cellspacing="0" >
        <thead>
            <tr>
			 <th width="70">';echo L('listorder');echo '</th>
            <th width="90">';echo L('fieldname');echo '</th>
			<th width="100">';echo L('cnames');;echo '</th>
			<th width="100">';echo L('type');;echo '</th>
			<th width="50">';echo L('system');;echo '</th> 
            <th width="50">';echo L('must_input');;echo '</th>
            <th width="50">';echo L('search');;echo '</th>
            <th width="50">';echo L('listorder');;echo '</th>
            <th width="50">';echo L('contribute');;echo '</th>
			<th >';echo L('operations_manage');;echo '</th>
            </tr>
        </thead>
    <tbody class="td-line">
	';
foreach($datas as $r) {
$tablename = L($r['tablename']);
;echo '    <tr>
		<td align=\'center\' width=\'70\'><input name=\'listorders[';echo $r['fieldid'];echo ']\' type=\'text\' size=\'3\' value=\'';echo $r['listorder'];echo '\' class=\'input-text-c\'></td>
		<td width=\'90\'>';echo $r['field'];echo '</td>
		<td width="100">';echo $r['name'];echo '</td>
		<td width="100" align=\'center\'>';echo $r['formtype'];echo '</td>
		<td width="50" align=\'center\'>';echo $r['issystem'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td width="50" align=\'center\'>';echo $r['minlength'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td width="50" align=\'center\'>';echo $r['issearch'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td width="50" align=\'center\'>';echo $r['isorder'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td width="50" align=\'center\'>';echo $r['isadd'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td align=\'center\'> <a href="?s=content/sitemodel_field/edit/modelid/';echo $r['modelid'];echo '/fieldid/';echo $r['fieldid'];echo '/menuid/';echo $_GET['menuid'];echo '">';echo L('edit');;echo '</a> | 
		';if(!in_array($r['field'],$forbid_fields)) {;echo '		<a href="?s=content/sitemodel_field/disabled/disabled/';echo $r['disabled'];;echo '/modelid/';echo $r['modelid'];echo '/fieldid/';echo $r['fieldid'];echo '/fieldid/';echo $r['fieldid'];echo '/menuid/';echo $_GET['menuid'];echo '">';echo $r['disabled'] ?L('field_enabled') : L('field_disabled');;echo '</a>
		';}else {;echo '<font color="#BEBEBE"> ';echo L('field_disabled');;echo ' </font>';};echo '|';if(!in_array($r['field'],$forbid_delete)) {;echo ' 
		<a href="javascript:confirmurl(\'?s=content/sitemodel_field/delete/modelid/';echo $r['modelid'];echo '/fieldid/';echo $r['fieldid'];echo '/menuid/';echo $_GET['menuid'];echo '\',\'';echo L('confirm',array('message'=>$r['name']));echo '\')">';echo L('delete');echo '</a>';}else {;echo '<font color="#BEBEBE"> ';echo L('delete');;echo '</font>';};echo ' </td>
	</tr>
	';};echo '    </tbody>
    </table>
   <div class="btn"><input type="submit" class="button" name="dosubmit" value="';echo L('listorder');;echo '" /></div></div>
</form>
</div>
</body>
</html>
';?>