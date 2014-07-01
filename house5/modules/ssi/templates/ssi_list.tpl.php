<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '
<div class="pad_10">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
		<tr>
        <th width="5%">';echo L('id');echo '</th>
		<th width="15%">';echo L('name');echo '</th>
		<th width="15%">';echo L('display_position');echo '</th>
		<th width="65%">';echo L('operations_manage');echo '</th>
		</tr>
        </thead>
        <tbody>
';
if(is_array($infos)):
foreach($infos as $v):
;echo '<tr>
<td align="center">';echo $v['id'];echo '</td>
<td align="center">';echo $v['name'];echo '</td>
<td align="center">';echo $v['tag'];echo '</td>
<td align="center"><a href="javascript:call(';echo $v['id'];echo ');void(0);">';echo L('explain');;echo '</a> | <a href="javascript:ssi_update(';echo $v['id'];echo ', \'';echo $v['name'];echo '\')">';echo L('updates');echo '</a> | <a href="javascript:edit(';echo $v['id'];echo ', \'';echo $v['name'];echo '\')">';echo L('edit');echo '</a> | <a href="?s=ssi/ssi/del/id/';echo $v['id'];echo '" onclick="return confirm(\'';echo L('confirm',array('message'=>$v['name']));echo '\')">';echo L('delete');echo '</a></td>
</tr>
';
endforeach;
endif;
;echo '</tbody>
</table>
</div>
</div>
<div id="pages">';echo $pages;echo '</div>
<div id="closeParentTime" style="display:none"></div>
<script type="text/javascript">
<!--

function ssi_update(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	//window.top.art.dialog.tips(\'提交成功！\',2);
	//window.top.art.dialog({});
	window.top.art.dialog({id:\'edit\',iframe:\'?s=ssi/ssi/ssi_update/id/\'+id}
	,function(){window.top.art.dialog({time: 2,content:\'《\'+name+\'》已经更新成功\',id:\'edit\'});});}

function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit');echo '《\'+name+\'》\',id:\'edit\',iframe:\'?s=ssi/ssi/edit/id/\'+id,width:\'700\',height:\'500\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}

	function call(id) {
		window.top.art.dialog({id:\'call\'}).close();
		window.top.art.dialog({title:\'';echo L('get_code');echo '\', id:\'call\', iframe:\'?s=ssi/ssi/public_call/id/\'+id, width:\'600px\', height:\'470px\'}, function(){window.top.art.dialog({id:\'call\'}).close();}, function(){window.top.art.dialog({id:\'call\'}).close();})
	}
//-->
</script>
</body>
</html>';?>