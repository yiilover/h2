<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = $show_header = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="subnav">
    <div class="content-menu ib-a blue line-x">
    ';if(isset($big_menu)) echo '<a class="add fb" href="'.$big_menu[0].'"><em>'.$big_menu[1].'</em></a>　';;echo '    ';echo admin::submenu($_GET['menuid'],$big_menu);;echo '<span>|</span><a href="javascript:window.top.art.dialog({id:\'setting\',iframe:\'?s=poster/space/setting\', title:\'';echo L('module_setting');echo '\', width:\'540\', height:\'320\'}, function(){var d = window.top.art.dialog({id:\'setting\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'setting\'}).close()});void(0);"><em>';echo L('module_setting');echo '</em></a>
    </div>
</div>
<div class="pad-lr-10">
<form name="myform" action="?s=poster/space/delete" method="post" id="myform">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="6%" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall(\'spaceid[]\');"></th>
			<th>';echo L('boardtype');echo '</th>
			<th width="12%" align="center">';echo L('ads_type');echo '</th>
			<th width=\'10%\' align="center">';echo L('size_format');echo '</th>
			<th width="10%" align="center">';echo L('ads_num');echo '</th>
			<th align="center" width="13%">';echo L('description');echo '</th>
			<th width="28%" align="center">';echo L('operations_manage');echo '</th>
            </tr>
        </thead>
    <tbody>
 ';
if(is_array($infos)){
foreach($infos as $info){
;echo '   
	<tr>
	<td align="center">
	<input type="checkbox" name="spaceid[]" value="';echo $info['spaceid'];echo '">
	</td>
	<td>';echo $info['name'];echo '</td>
	<td align="center">';echo $TYPES[$info['type']];echo '</td>
	<td align="center">';echo $info['width'];echo '*';echo $info['height'];echo '</td>
	<td align="center">';echo $info['items'];echo '</td>
	<td align="center">';echo $info['description'];echo '</td>
	<td align="center">
	<a href="?s=poster/space/public_preview&spaceid=';echo $info['spaceid'];echo '" target="_blank">';echo L('preview');echo '</a> | <a href="javascript:call(';echo $info['spaceid'];echo ');void(0);">';echo L('get_code');echo '</a> | <a href=\'?s=poster/poster/init&spaceid=';echo $info['spaceid'];echo '&menuid=';echo $_GET['menuid'];echo '\' >';echo L('ad_list');echo '</a> | 
	<a href="###" onclick="edit(';echo $info['spaceid'];echo ', \'';echo addslashes(htmlspecialchars($info['name']));echo '\')" title="';echo L('edit');echo '" >';echo L('edit');echo '</a> | 
	<a href=\'?s=poster/space/delete&spaceid=';echo $info['spaceid'];echo '\' onClick="return confirm(\'';echo L('confirm',array('message'=>addslashes(htmlspecialchars($info['name']))));echo '\')">';echo L('delete');echo '</a>
	| <a href="index.php?s=poster/poster/add&spaceid=';echo $info['spaceid'];echo '&menuid=';echo $_GET['menuid'];echo '&h5_hash=';echo $_SESSION['h5_hash'];echo '">添加广告</a>
	</td>
	</tr>
';
}
}
;echo '</tbody>
    </table>
    <div class="btn"><label for="check_box">';echo L('selected_all');echo '/';echo L('cancel');echo '</label>
		<input name="submit" type="submit" class="button" value="';echo L('remove_all_selected');echo '" onClick="return confirm(\'';echo L('confirm',array('message'=>L('selected')));echo '\')">&nbsp;&nbsp;</div>  </div>
 <div id="pages">';echo $pages;echo '</div>
</form>
</div>
<script type="text/javascript">
<!--

	function edit(id, name){
	window.top.art.dialog({title:\'';echo L('edit_space');echo '--\'+name, id:\'testIframe\'+id, iframe:\'?s=poster/space/edit&spaceid=\'+id ,width:\'540px\',height:\'320px\'}, 	function(){var d = window.top.art.dialog({id:\'testIframe\'+id}).data.iframe;// 使用内置接口获取iframe对象
	var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'testIframe\'+id}).close()});
	};

	function call(id) {
		window.top.art.dialog({id:\'call\'}).close();
		window.top.art.dialog({title:\'';echo L('get_code');echo '\', id:\'call\', iframe:\'?s=poster/space/public_call&sid=\'+id, width:\'600px\', height:\'470px\'}, function(){window.top.art.dialog({id:\'call\'}).close();}, function(){window.top.art.dialog({id:\'call\'}).close();})
	}

//-->
</script>
</body>
</html>';?>