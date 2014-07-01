<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<div class="pad-lr-10">

<form name="myform" action="?s=collection/node/del" method="post" onsubmit="return confirm(\'';echo L('sure_delete');echo '\')">
<div class="table-list">
<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th  align="left" width="20"><input type="checkbox" value="" id="check_box" onclick="selectall(\'nodeid[]\');"></th>
			<th align="left">ID</th>
			<th align="left">';echo L('nodename');echo '</th>
			<th align="left">';echo L('lastdate');echo '</th>
			<th align="left">';echo L('content').L('operation');echo '</th>
			<th align="left">';echo L('operation');echo '</th>
		</tr>
	</thead>
<tbody>
';
foreach($nodelist as $k=>$v) {
;echo '    <tr>
		<td align="left"><input type="checkbox" value="';echo $v['nodeid'];echo '" name="nodeid[]"></td>
		<td align="left">';echo $v['nodeid'];echo '</td>
		<td align="left">';echo $v['name'];echo '</td>
		<td align="left">';echo format::date($v['lastdate'],1);echo '</td>
		<td align="left"><a href="?s=collection/node/col_url_list/nodeid/';echo $v['nodeid'];echo '">[';echo L('collection_web_site');echo ']</a> 
		<a href="?s=collection/node/col_content/nodeid/';echo $v['nodeid'];echo '">[';echo L('collection_content');echo ']</a>
		 <a href="?s=collection/node/publist/nodeid/';echo $v['nodeid'];echo '/status/2" style="color:red">[';echo L('public_content');echo ']</a>
		</td>
		<td align="left">
		<a href="javascript:void(0)" onclick="test_spider(';echo $v['nodeid'];echo ')">[';echo L('test');echo ']</a>
		
		<a href="?s=collection/node/edit/nodeid/';echo $v['nodeid'];echo '/menuid/957">[';echo L('edit');echo ']</a>
		 <a href="javascript:void(0)"  onclick="copy_spider(';echo $v['nodeid'];echo ')">[';echo L('copy');echo ']</a>
		 <a href="?s=collection/node/export/nodeid/';echo $v['nodeid'];echo '">[';echo L('export');echo ']</a>
		
		 </td>
    </tr>
';
}
;echo '</tbody>
</table>

<div class="btn">
<label for="check_box">';echo L('select_all');echo '/';echo L('cancel');echo '</label> <input type="submit" class="button" name="dosubmit" value="';echo L('delete');echo '"/>
 <input type="button" class="button" value="';echo L('import_collection_points');echo '" onclick="import_spider()" />
</div>

<div id="pages">';echo $pages;echo '</div>
</div>
</form>
</div>
<script type="text/javascript">
<!--
function test_spider(id) {
	window.top.art.dialog({id:\'test\'}).close();
	window.top.art.dialog({title:\'';echo L('data_acquisition_testdat');echo '\',id:\'test\',iframe:\'?s=collection/node/public_test/nodeid/\'+id,width:\'700\',height:\'500\'}, \'\', function(){window.top.art.dialog({id:\'test\'}).close()});
}

function copy_spider(id) {
	window.top.art.dialog({id:\'test\'}).close();
	window.top.art.dialog({title:\'';echo L('copy_node');echo '\',id:\'test\',iframe:\'?s=collection/node/copy/nodeid/\'+id,width:\'420\',height:\'120\'}, function(){var d = window.top.art.dialog({id:\'test\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'test\'}).close()});
}

function import_spider() {
	window.top.art.dialog({id:\'test\'}).close();
	window.top.art.dialog({title:\'';echo L('import_collection_points');echo '\',id:\'test\',iframe:\'?s=collection/node/node_import\',width:\'420\',height:\'200\'}, function(){var d = window.top.art.dialog({id:\'test\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'test\'}).close()});
}

window.top.$(\'#display_center_id\').css(\'display\',\'none\');
//-->
</script>
</body>
</html>';?>