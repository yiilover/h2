<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10">
<form name="myform" id="myform" action="?s=admin/copyfrom/listorder" method="post">
<div class="table-list">
 <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="55" align="center">';echo L('listorder');;echo '</th>
            <th>';echo L('copyfrom_name');;echo '</th>
            <th >';echo L('copyfrom_url');echo '</th> 
            <th >';echo L('copyfrom_logo');echo '</th> 
             <th width="120">';echo L('operations_manage');echo '</th>
            </tr>
        </thead>
    <tbody>
';
foreach($datas as $r) {
;echo '<tr>
<td align="center"><input type="text" name="listorders[';echo $r['id'];echo ']" value="';echo $r['listorder'];echo '" size="3" class=\'input-text-c\'></td>
<td align="center">';echo $r['sitename'];echo '</td>
<td align="center">';echo $r['siteurl'];echo '</td>
<td align="center">';if($r['thumb']) {;echo '<img src="';echo $r['thumb'];echo '">';};echo '</td>
<td align="center"><a href="javascript:edit(\'';echo $r['id'];echo '\',\'';echo new_addslashes($r['sitename']);echo '\')">';echo L('edit');;echo '</a> | <a href="javascript:;" onclick="data_delete(this,\'';echo $r['id'];echo '\',\'';echo L('confirm',array('message'=>new_addslashes($r['sitename'])));;echo '\')">';echo L('delete');echo '</a> </td>
</tr>
';};echo '</tbody>
 </table>
 <div class="btn"><input type="submit" class="button" name="dosubmit" value="';echo L('listorder');echo '" /></div>  </div>
<div id="pages">';echo $pages;echo '</div>

</div>

</form></div>
</body>
</html>
<script type="text/javascript"> 
<!--
function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit');;echo '¡¶\'+name+\'¡·\',id:\'edit\',iframe:\'?s=admin/copyfrom/edit/id/\'+id,width:\'580\',height:\'240\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
function data_delete(obj,id,name){
	window.top.art.dialog({content:name, fixed:true, style:\'confirm\', id:\'data_delete\'}, 
	function(){
	$.get(\'?s=admin/copyfrom/delete/id/\'+id+\'/h5_hash/\'+h5_hash,function(data){
				if(data) {
					$(obj).parent().parent().fadeOut("slow");
				}
			}) 	
		 }, 
	function(){});
};
//-->
</script>';?>