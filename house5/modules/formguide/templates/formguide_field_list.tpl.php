<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<div class="subnav">
  <h2 class="title-1 line-x f14 fb blue lh28">';echo L('formguide');;echo '--';if ($formid) echo $r['name'];else echo L('public');echo '';echo L('field_manage');;echo '</h2>
<div class="content-menu ib-a blue line-x"><a class="add fb" href="?s=formguide/formguide_field/add/formid/';echo $formid;echo '/menuid/';echo $_GET['menuid'];echo '"><em>';echo L('add_field');;echo '</em></a>
¡¡<a class="on" href="?s=formguide/formguide_field/init/formid/';echo $formid;echo '"><em>';echo L('manage_field');;echo '</em></a>';if ($formid) {;echo '<span>|</span><a href="?s=formguide/formguide/public_preview/formid/';echo $formid;echo '/menuid/';echo $_GET['menuid'];echo '"><em>';echo L('priview_modelfield');;echo '</em></a>';};echo '</div></div>
<div class="pad-lr-10">
<form name="myform" action="?s=formguide/formguide_field/listorder/formid/';echo $formid;echo '" method="post">
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
		<td align=\'center\' width=\'70\'><input name=\'listorders[';echo $r['fieldid'] ?$r['fieldid'] : $r['field'];echo ']\' type=\'text\' size=\'3\' value=\'';echo $r['listorder'];echo '\' class=\'input-text-c\'></td>
		<td width=\'90\'>';echo $r['field'];echo '</td>
		<td width="100">';echo $r['name'];echo '</td>
		<td width="100" align=\'center\'>';echo $r['formtype'];echo '</td>
		<td width="50" align=\'center\'>';echo $r['issystem'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td width="50" align=\'center\'>';echo $r['minlength'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td width="50" align=\'center\'>';echo $r['issearch'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td width="50" align=\'center\'>';echo $r['isorder'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td width="50" align=\'center\'>';echo $r['isadd'] ?L('icon_unlock') : L('icon_locked');echo '</td>
		<td align=\'center\'> <a href="?s=formguide/formguide_field/edit/formid/';echo $r['modelid'];echo '/fieldid/';echo $r['fieldid'];echo '/field/';echo $r['field'];echo '/menuid/';echo $_GET['menuid'];echo '">';echo L('edit');;echo '</a> | 
		';if ($formid) {if(!in_array($r['field'],$forbid_fields)) {;echo '		<a href="?s=formguide/formguide_field/disabled/disabled/';echo $r['disabled'];;echo '/modelid/';echo $r['modelid'];echo '/fieldid/';echo $r['fieldid'];echo '/fieldid/';echo $r['fieldid'];echo '/menuid/';echo $_GET['menuid'];echo '">';echo $r['disabled'] ?L('field_enabled') : L('field_disabled');;echo '</a>
		';}else {;echo '<font color="#BEBEBE"> ';echo L('field_disabled');;echo ' </font>';};echo '|';};echo ' 
		<a href="javascript:confirmurl(\'?s=formguide/formguide_field/delete/formid/';echo $r['modelid'];echo '/fieldid/';echo $r['fieldid'];echo '/field/';echo $r['field'];echo '/menuid/';echo $_GET['menuid'];echo '\',\'';echo L('confirm',array('message'=>$r['name']));echo '\')">';echo L('delete');echo '</a>  </td>
	</tr>
	';};echo '    </tbody>
    </table>
   <div class="btn"><input type="submit" class="button" name="dosubmit" value="';echo L('listorder');;echo '" /></div></div>
</form>
</div>
</body>
</html>';?>