<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '
<div class="subnav">
    <div class="content-menu ib-a blue line-x">
    ';if(isset($big_menu)) echo '<a class="add fb" href="'.$big_menu[0].'"><em>'.$big_menu[1].'</em></a>　';;echo '    ';echo admin::submenu($_GET['menuid'],$big_menu);;echo '<span>|</span><a href="javascript:window.top.art.dialog({id:\'setting\',iframe:\'?s=poster/space/setting\', title:\'';echo L('module_setting');echo '\', width:\'540\', height:\'320\'}, function(){var d = window.top.art.dialog({id:\'setting\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'setting\'}).close()});void(0);"><em>';echo L('module_setting');echo '</em></a>
    </div>
</div>

<div class="pad-lr-10">
<form name="myform" action="?s=poster/poster/listorder" method="post">
<div class="table-list">
    <table width="100%" cellspacing="0" class="contentWrap">
        <thead>
            <tr>
            <th width="30" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall(\'id[]\');"></th>
			<th width="35">ID</th>
			<th width="70">';echo L('listorder');echo '</th>
			<th align="center">';echo L('poster_title');echo '</th>
			<th width="70" align="center">';echo L('poster_type');echo '</th>
			<th width=\'200\' align="center">';echo L('for_postion');echo '</th>
			<th width="50" align="center">';echo L('status');echo '</th>
			<th width=\'50\' align="center">';echo L('hits');echo '</th>
			<th width="130" align="center">';echo L('addtime');echo '</th>
			<th width="110" align="center">';echo L('operations_manage');echo '</th>
            </tr>
        </thead>
        <tbody>
 ';
if(is_array($infos)){
foreach($infos as $info){
$space = $this->s_db->get_one(array('spaceid'=>$info['spaceid']),'name');
;echo '   
	<tr>
	<td align="center">
	<input type="checkbox" name="id[]" value="';echo $info['id'];echo '">
	</td>
	<td align="center">';echo $info['id'];echo '</td>
	<th width="70"><input type="text" size="5" name="listorder[';echo $info['id'];echo ']" value="';echo $info['listorder'];echo '" id="listorder"></th>
	<td>';echo $info['name'];echo '</td>
	<td align="center">';echo $types[$info['type']];echo '</td>
	<td align="center">';echo $space['name'];echo '</td>
	<td align="center">';if($info['disabled']) {echo L('stop');}elseif((strtotime($info['enddate'])<SYS_TIME) &&(strtotime($info['enddate'])>0)) {echo L('past');}else {echo L('start');};echo '</td>
	<td align="center">';echo $info['clicks'];echo '</td>
	<td align="center">';echo format::date($info['addtime'],1);;echo '</td>
	<td align="center"><a href="index.php?s=poster/poster/edit&id=';echo $info['id'];;echo '&h5_hash=';echo $_SESSION['h5_hash'];;echo '&menuid=';echo $_GET['menuid'];echo '" >';echo L('edit');echo '</a>|<a href="?s=poster/poster/stat&id=';echo $info['id'];echo '&spaceid=';echo $_GET['spaceid'];;echo '">';echo L('stat');echo '</a></td>
	</tr>
';
}
}
;echo '</tbody>
    </table>
  
    <div class="btn"><label for="check_box">';echo L('selected_all');echo '/';echo L('cancel');echo '</label>
    	<input name=\'submit\' type=\'submit\' class="button" value=\'';echo L('listorder');echo '\'>&nbsp;
        <input name=\'submit\' type=\'submit\' class="button" value=\'';echo L('start');echo '\' onClick="document.myform.action=\'?s=poster/poster/public_approval&passed=0\'">&nbsp;
        <input name=\'submit\' type=\'submit\' class="button" value=\'';echo L('stop');echo '\' onClick="document.myform.action=\'?s=poster/poster/public_approval&passed=1\'">&nbsp;
		<input name="submit" type="submit" class="button" value="';echo L('delete');echo '" onClick="document.myform.action=\'?s=poster/poster/delete\';return confirm(\'';echo L('confirm',array('message'=>L('selected')));echo '\')">&nbsp;&nbsp;</div>  </div>
 <div id="pages">';echo $this->db->pages;;echo '</div>
</form>
</div>
</body>
</html>
<script type="text/javascript">
<!--
	function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit_ads');echo '--\'+name, id:\'edit\', iframe:\'?s=poster/poster/edit&id=\'+id ,width:\'600px\',height:\'430px\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;// 使用内置接口获取iframe对象
	var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
//-->
</script>';?>