<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<form name="myform" action="?s=content/type_manage/listorder" method="post">
<div class="pad_10">
<div class="table-list">
    <table width="100%" cellspacing="0" >
        <thead>
	<tr>
	<th width="5%">';echo L('listorder');;echo '</td>
	<th width="5%">ID</th>
	<th width="20%">';echo L('type_name');;echo '</th>
	<th width="*">';echo L('description');;echo '</th>
	<th width="30%">';echo L('operations_manage');;echo '</th>
	</tr>
        </thead>
    <tbody>
    

';
foreach($datas as $r) {
;echo '<tr>
<td align="center"><input type="text" name="listorders[';echo $r['typeid'];echo ']" value="';echo $r['listorder'];echo '" size="3" class=\'input-text-c\'></td>
<td align="center">';echo $r['typeid'];echo '</td>
<td align="center">';echo $r['name'];echo '</td>
<td >';echo $r['description'];echo '</td>
<td align="center"><a href="javascript:edit(\'';echo $r['typeid'];echo '\',\'';echo trim(new_addslashes($r['name']));echo '\')">';echo L('edit');;echo '</a> | <a href="javascript:;" onclick="data_delete(this,\'';echo $r['typeid'];echo '\',\'';echo trim(new_addslashes($r['name']));;echo '\')">';echo L('delete');echo '</a> </td>
</tr>
';};echo '	</tbody>
    </table>

    <div class="btn"><input type="submit" class="button" name="dosubmit" value="';echo L('listorder');echo '" /></div>  </div>
	<div id="pages">';echo $pages;;echo '</div>
</div>

</div>
</form>

<script type="text/javascript"> 
<!--
window.top.$(\'#display_center_id\').css(\'display\',\'none\');
function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit_type');;echo '¡¶\'+name+\'¡·\',id:\'edit\',iframe:\'?s=content/type_manage/edit/typeid/\'+id,width:\'780\',height:\'500\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
function data_delete(obj,id,name){
	window.top.art.dialog({content:name, fixed:true, style:\'confirm\', id:\'data_delete\'}, 
	function(){
	$.get(\'?s=content/type_manage/delete/typeid/\'+id+\'/h5_hash/\'+h5_hash,function(data){
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