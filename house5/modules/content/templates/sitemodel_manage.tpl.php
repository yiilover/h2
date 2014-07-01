<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<div class="pad-lr-10">
<div class="table-list">
    <table width="100%" cellspacing="0" >
        <thead>
            <tr>
			 <th width="100">modelid</th>
            <th width="100">';echo L('model_name');;echo '</th>
			<th width="100">';echo L('tablename');;echo '</th>
            <th >';echo L('description');;echo '</th>
            <th width="100">';echo L('status');;echo '</th>
            <th width="100">';echo L('items');;echo '</th>
			<th width="230">';echo L('operations_manage');;echo '</th>
            </tr>
        </thead>
    <tbody>
	';
foreach($datas as $r) {
$tablename = $r['name'];
;echo '    <tr>
		<td align=\'center\'>';echo $r['modelid'];echo '</td>
		<td align=\'center\'>';echo $tablename;echo '</td>
		<td align=\'center\'>';echo $r['tablename'];echo '</td>
		<td align=\'center\'>&nbsp;';echo $r['description'];echo '</td>
		<td align=\'center\'>';echo $r['disabled'] ?L('icon_locked') : L('icon_unlock');echo '</td>
		<td align=\'center\'>';echo $r['items'];echo '</td>
		<td align=\'center\'><a href="?s=content/sitemodel_field/init/modelid/';echo $r['modelid'];echo '/menuid/';echo $_GET['menuid'];echo '">';echo L('field_manage');;echo '</a> | <a href="javascript:edit(\'';echo $r['modelid'];echo '\',\'';echo addslashes($tablename);;echo '\')">';echo L('edit');;echo '</a> | <a href="?s=content/sitemodel/disabled/modelid/';echo $r['modelid'];echo '/menuid/';echo $_GET['menuid'];echo '">';echo $r['disabled'] ?L('field_enabled') : L('field_disabled');;echo '</a> | <a href="javascript:;" onclick="model_delete(this,\'';echo $r['modelid'];echo '\',\'';echo L('confirm_delete_model',array('message'=>addslashes($tablename)));;echo '\',';echo $r['items'];echo ')">';echo L('delete');echo '</a> | <a href="?s=content/sitemodel/export/modelid/';echo $r['modelid'];echo '/menuid/';echo $_GET['menuid'];echo '"">';echo L('export');;echo '</a></td>
	</tr>
	';};echo '    </tbody>
    </table>
   <div id="pages">';echo $pages;;echo '  </div>
</div>
<script type="text/javascript"> 
<!--
window.top.$(\'#display_center_id\').css(\'display\',\'none\');
function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit_model');;echo '¡¶\'+name+\'¡·\',id:\'edit\',iframe:\'?s=content/sitemodel/edit/modelid/\'+id,width:\'580\',height:\'420\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
function model_delete(obj,id,name,items){
	if(items) {
		alert(\'';echo L('model_does_not_allow_delete');;echo '\');
		return false;
	}
	window.top.art.dialog({content:name, fixed:true, style:\'confirm\', id:\'model_delete\'}, 
	function(){
	$.get(\'?s=content/sitemodel/delete/modelid/\'+id+\'/h5_hash/\'+h5_hash,function(data){
				if(data) {
					$(obj).parent().parent().fadeOut("slow");
				}
			}) 	
		 }, 
	function(){});
};

//-->
</script>
</body>
</html>
';?>