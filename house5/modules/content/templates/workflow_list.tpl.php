<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<form name="myform" action="?s=content/type_manage/listorder" method="post">
<div class="pad_10">
<div class="table-list">
    <table width="100%" cellspacing="0" >
        <thead>
	<tr>
	<th width="5%">ID</th>
	<th width="20%" align="left">';echo L('workflow_name');;echo '</th>
	<th width="20%">';echo L('steps');;echo '</th>
	<th width="10%">';echo L('workflow_diagram');;echo '</th>
	<th width="*">';echo L('description');;echo '</th>
	<th width="30%">';echo L('operations_manage');;echo '</th>
	</tr>
        </thead>
    <tbody>
    

';
$steps[1] = L('steps_1');
$steps[2] = L('steps_2');
$steps[3] = L('steps_3');
$steps[4] = L('steps_4');
foreach($datas as $r) {
;echo '<tr>
<td align="center">';echo $r['workflowid'];echo '</td>
<td >';echo $r['workname'];echo '</td>
<td align="center">';echo $steps[$r['steps']];echo '</td>
<td align="center"><a href="javascript:view(\'';echo $r['workflowid'];echo '\',\'';echo $r['workname'];echo '\')">';echo L('onclick_view');;echo '</a></td>
<td >';echo $r['description'];echo '</td>
<td align="center"><a href="javascript:edit(\'';echo $r['workflowid'];echo '\',\'';echo $r['workname'];echo '\')">';echo L('edit');;echo '</a> | <a href="javascript:;" onclick="data_delete(this,\'';echo $r['workflowid'];echo '\',\'';echo L('confirm',array('message'=>$r['workname']));;echo '\')">';echo L('delete');echo '</a> </td>
</tr>
';};echo '	</tbody>
    </table>

 </div>
</div>
<div id="pages">';echo $pages;;echo '</div>
</div>
</form>

<script type="text/javascript"> 
<!--
window.top.$(\'#display_center_id\').css(\'display\',\'none\');
function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit_workflow');;echo '¡¶\'+name+\'¡·\',id:\'edit\',iframe:\'?s=content/workflow/edit/workflowid/\'+id,width:\'680\',height:\'500\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
function view(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('workflow_diagram');;echo '¡¶\'+name+\'¡·\',id:\'edit\',iframe:\'?s=content/workflow/view/workflowid/\'+id,width:\'580\',height:\'300\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
function data_delete(obj,id,name){
	window.top.art.dialog({content:name, fixed:true, style:\'confirm\', id:\'data_delete\'}, 
	function(){
	$.get(\'?s=content/workflow/delete/workflowid/\'+id+\'/h5_hash/';echo $_SESSION['h5_hash'];;echo '\',function(data){
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