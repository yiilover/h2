<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = $show_header = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="subnav">
    <div class="content-menu ib-a blue line-x">
    ';if(isset($big_menu)) echo '<a class="add fb" href="'.$big_menu[0].'"><em>'.$big_menu[1].'</em></a>¡¡';;echo '    ';echo admin::submenu($_GET['menuid'],$big_menu);;echo '<span>|</span><a href="javascript:window.top.art.dialog({id:\'setting\',iframe:\'?s=formguide/formguide/setting\', title:\'';echo L('module_setting');echo '\', width:\'540\', height:\'350\'}, function(){var d = window.top.art.dialog({id:\'setting\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'setting\'}).close()});void(0);"><em>';echo L('module_setting');echo '</em></a>
    </div>
</div>
<div class="pad-lr-10">
<form name="myform" action="?s=formguide/formguide/listorder" method="post">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="35" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall(\'formid[]\');"></th>
			<th align="center">';echo L('name_items');echo '</th>
			<th width=\'100\' align="center">';echo L('tablename');echo '</th>
			<th width=\'150\' align="center">';echo L('introduction');echo '</th>
			<th width="140" align="center">';echo L('create_time');echo '</th>
			<th width="160" align="center">';echo L('call');echo '</th>
			<th width="220" align="center">';echo L('operations_manage');echo '</th>
            </tr>
        </thead>
    <tbody>
 ';
if(is_array($data)){
foreach($data as $form){
;echo '   
	<tr>
	<td align="center">
	<input type="checkbox" name="formid[]" value="';echo $form['modelid'];echo '">
	</td>
	<td>';echo $form['name'];echo ' [<a href="';echo APP_PATH;echo 'index.php?s=formguide/index/show/formid/';echo $form['modelid'];echo '/siteid/';echo $form['siteid'];echo '" target="_blank">';echo L('visit_front');echo '</a>] ';if ($form['items']) {;echo '(';echo $form['items'];echo ')';};echo '</td>
	<td align="center">';echo $form['tablename'];echo '</td>
	<td align="center">';echo $form['introduce'];echo '</td>
	<td align="center">';echo date('Y-m-d H:i:s',$form['addtime']);echo '</td>
	<td align="center"><input type="text" value="<script language=\'javascript\' src=\'{APP_PATH}index.php?s=formguide/index/show/formid/';echo $form['modelid'];echo '/action/js/siteid/';echo $form['siteid'];echo '\'></script>"></td>
	<td align="center"><a href="?s=formguide/formguide_info/init/formid/';echo $form['modelid'];echo '/menuid/';echo $_GET['menuid'];echo '">';echo L('info_list');echo '</a> | <a href="?s=formguide/formguide_field/add/formid/';echo $form['modelid'];echo '">';echo L('field_add');echo '</a> | <a href="?s=formguide/formguide_field/init/formid/';echo $form['modelid'];echo '">';echo L('field_manage');echo '</a> <br /><a href="?s=formguide/formguide/public_preview/formid/';echo $form['modelid'];echo '">';echo L('preview');echo '</a> | <a href="javascript:edit(\'';echo $form['modelid'];echo '\', \'';echo safe_replace($form['name']);echo '\');void(0);">';echo L('modify');echo '</a> | <a href="?s=formguide/formguide/disabled/formid/';echo $form['modelid'];echo '/val/';echo $form['disabled'] ?0 : 1;;echo '">';if ($form['disabled']==0) {echo L('field_disabled');}else {echo L('field_enabled');};echo '</a> | <a href="?s=formguide/formguide/delete/formid/';echo $form['modelid'];echo '" onClick="return confirm(\'';echo L('confirm',array('message'=>addslashes(htmlspecialchars($form['name']))));echo '\')">';echo L('del');echo '</a> | <a href="javascript:stat(\'';echo $form['modelid'];echo '\', \'';echo safe_replace($form['name']);echo '\');void(0);">';echo L('stat');echo '</a></td>
	</tr>
';
}
}
;echo '</tbody>
    </table>
  
    <div class="btn"><label for="check_box">';echo L('selected_all');echo '/';echo L('cancel');echo '</label>
		<input name="submit" type="submit" class="button" value="';echo L('remove_all_selected');echo '" onClick="document.myform.action=\'?s=formguide/formguide/delete\';return confirm(\'';echo L('affirm_delete');echo '\')">&nbsp;&nbsp;</div>  </div>
 <div id="pages">';echo $this->db->pages;;echo '</div>
</form>
</div>
</body>
</html>
<script type="text/javascript">
function edit(id, title) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit_formguide');echo '--\'+title, id:\'edit\', iframe:\'?s=formguide/formguide/edit/formid/\'+id ,width:\'700px\',height:\'500px\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;
	var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}

function stat(id, title) {
	window.top.art.dialog({id:\'stat\'}).close();
	window.top.art.dialog({title:\'';echo L('stat_formguide');echo '--\'+title, id:\'stat\', iframe:\'?s=formguide/formguide/stat/formid/\'+id ,width:\'700px\',height:\'500px\'}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
</script>';?>