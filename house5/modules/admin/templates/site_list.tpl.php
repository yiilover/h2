<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');
;echo '<div class="pad_10">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
		<tr>
		<th width="80">Siteid</th>
		<th>';echo L('site_name');echo '</th>
		<th>';echo L('site_dirname');echo '</th>
		<th>';echo L('site_domain');echo '</th>
		<th align="center">';echo L('godaddy');echo '</th>
		<th width="150">';echo L('operations_manage');echo '</th>
		</tr>
        </thead>
        <tbody>
';
if(is_array($list)):
foreach($list as $v):
;echo '<tr>
<td width="80" align="center">';echo $v['siteid'];echo '</td>
<td align="center">';echo $v['name'];echo '</td>
<td align="center">';echo $v['dirname'];echo '</td>
<td align="center">';echo $v['domain'];echo '</td>
<td align="center">';if ($v['siteid']!=1){;echo '';echo h5_base::load_config('system','html_root');echo '/';echo $v['dirname'];}else{echo '/';};echo '</td>
<td align="center"><a href="javascript:edit(';echo $v['siteid'];echo ', \'';echo  new_addslashes(htmlspecialchars($v['name']));echo '\')">';echo L('edit');echo '</a> | 
';if($v['siteid']!=1) {;echo '<a href="?s=admin/site/del/siteid/';echo $v['siteid'];echo '" onclick="return confirm(\'';echo new_addslashes(htmlspecialchars(L('confirm',array('message'=>$v['name']))));echo '\')">';echo L('delete');echo '</a>';}else {;echo '<font color="#cccccc">';echo L('delete');echo '</font>';};echo '</td>
</tr>
';
endforeach;
endif;
;echo '</tbody>
</table>
</div>
</div>
<div id="pages">';echo $pages;echo '</div>
<script type="text/javascript">
<!--
function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit_site');echo '¡¶\'+name+\'¡·\',id:\'edit\',iframe:\'?s=admin/site/edit/siteid/\'+id,width:\'700\',height:\'500\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
//-->
</script>
</body>
</html>';?>