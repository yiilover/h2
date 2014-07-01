<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<form name="myform" action="?s=search/search_type/listorder" method="post">
<div class="pad_10">
<div class="table-list">

<div class="explain-col">
';echo L('searh_notice');echo '</div>
<div class="bk10"></div>
    <table width="100%" cellspacing="0" >
        <thead>
			<tr>
			<th width="55">';echo L('sort');echo '</td>
			<th width="35">ID</th>
			<th width="120">';echo L('catname');echo '</th>
			<th width="80">';echo L('modulename');echo '</th>
			<th width="80">';echo L('modlename');echo '</th>
			<th width="*">';echo L('catdescription');echo '</th>
			<th width="80">';echo L('opreration');echo '</th>
			</tr>
        </thead>
    <tbody>
    

';
foreach($datas as $r) {
;echo '<tr>
<td align="center"><input type="text" name="listorders[';echo $r['typeid'];echo ']" value="';echo $r['listorder'];echo '" size="3" class=\'input-text-c\'></td>
<td align="center">';echo $r['typeid'];echo '</td>
<td align="center">';echo $r['name'];echo '</td>
<td align="center">';echo $r['modelid'] &&$r['typedir'] !='yp'?L('content_module') : $r['typedir'];;echo '</td>
<td align="center">';echo $this->model[$r['modelid']]['name'] ?$this->model[$r['modelid']]['name'] : $this->yp_model[$r['modelid']]['name'];echo '</td>
<td >';echo $r['description'];echo '</td>
<td align="center"><a href="javascript:edit(\'';echo $r['typeid'];echo '\',\'';echo $r['name'];echo '\')">';echo L('modify');echo '</a> | <a href="?s=search/search_type/delete&typeid=';echo $r['typeid'];echo '" onclick="return confirm(\'';echo L('sure_delete','','member');echo '\')">';echo L('delete');echo '</a> </td>
</tr>
';};echo '	</tbody>
    </table>

    <div class="btn"><input type="submit" class="button" name="dosubmit" value="';echo L('listorder');echo '" /></div>  </div>
</div>
<div id="pages">';echo $pages;;echo '</div>
</div>
</form>

<script type="text/javascript"> 
<!--
function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit_cat');echo '¡¶\'+name+\'¡·\',id:\'edit\',iframe:\'?s=search/search_type/edit&typeid=\'+id,width:\'580\',height:\'240\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
function data_delete(obj,id,name){
	window.top.art.dialog({content:name, fixed:true, style:\'confirm\', id:\'data_delete\'}, 
	function(){
	$.get(\'?s=search/search_type/delete&typeid=\'+id+\'&h5_hash=\'+h5_hash,function(data){
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
</html>';?>