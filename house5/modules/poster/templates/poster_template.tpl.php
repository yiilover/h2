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
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="50" align="center">';echo L('template_name');echo '</th>
			<th width="24%" align="center">';echo L('operations_manage');echo '</th>
            </tr>
        </thead>
    <tbody>
 ';
if(is_array($templates)){
foreach($templates as $info){
;echo '   
	<tr>
	<td>';if ($poster_template[$info]['name']) {echo $poster_template[$info]['name'].' ('.$info.')';}else {echo $info;};echo '</td>
	<td align="center">
	<a href="javascript:';if ($poster_template[$info]['iscore']) {;echo 'check';}else {;echo 'edit';};echo '(\'';echo addslashes(htmlspecialchars($info));echo '\', \'';echo addslashes(htmlspecialchars($poster_template[$info]['name']));echo '\');void(0);">';if ($poster_template[$info]['iscore']) {echo L('check_template');}else {echo '<font color="#009933">'.L('setting_template').'</font>';};echo '</a> | <a href="?s=poster/space/public_tempate_del&id=';echo $info;echo '">';echo L('delete');echo '</a>
	</td>
	</tr>
';
}
}
;echo '</tbody>
    </table>  </div>
 <div id="pages">';echo $this->pages;echo '</div>
</div>
<script type="text/javascript">
<!--
	function edit(id, name) {
		window.top.art.dialog({id:\'testIframe\'}).close();
		window.top.art.dialog({title:name, id:\'testIframe\', iframe:\'?s=poster/space/public_tempate_setting&template=\'+id ,width:\'540px\',height:\'360px\'}, function(){var d = window.top.art.dialog({id:\'testIframe\'}).data.iframe;// 使用内置接口获取iframe对象
		var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'testIframe\'}).close()});
	};

	function check(id, name) {
		window.top.art.dialog({id:\'testIframe\'}).close();
		window.top.art.dialog({title:name, id:\'testIframe\', iframe:\'?s=poster/space/public_tempate_setting&template=\'+id ,width:\'540px\',height:\'360px\'})
	}

//-->
</script>
</body>
</html>';?>