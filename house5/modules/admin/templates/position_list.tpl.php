<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<form name="myform" action="?s=admin/position/listorder" method="post">
<div class="pad_10">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="10%"  align="left">';echo L('listorder');;echo '</th>
             <th width="5%"  align="left">ID</th>
            <th width="15%">';echo L('posid_name');;echo '</th>
            <th width="15%">';echo L('posid_catid');;echo '</th>
            <th width="15%">';echo L('posid_modelid');;echo '</th>
            <th width="20%">';echo L('posid_operation');;echo '</th>
            </tr>
        </thead>
    <tbody>
 ';
if(is_array($infos)){
foreach($infos as $info){
;echo '   
	<tr>
	<td width="10%">
	<input name=\'listorders[';echo $info['posid'];echo ']\' type=\'text\' size=\'2\' value=\'';echo $info['listorder'];echo '\' class="input-text-c">
	</td>
	<td width="5%"  align="left">';echo $info['posid'];echo '</td>
	<td  width="15%" align="center">';echo $info['name'];echo '</td>
	<td width="15%" align="center">';echo $info['catid'] ?$category[$info['catid']]['catname'] : L('posid_all');echo '</td>
	<td width="15%" align="center">';echo $info['modelid'] ?$model[$info['modelid']]['name'] : L('posid_all');echo '</td>
	<td width="20%" align="center">
	<a href="?s=admin/position/public_item/posid/';echo $info['posid'];echo '/menuid/';echo $_GET['menuid'];echo '">';echo L('posid_item_manage');echo '</a> |
	<a href="javascript:edit(';echo $info['posid'];echo ', \'';echo new_addslashes($info['name']);echo '\')">';echo L('edit');echo '</a> | 
	';if($info['siteid']=='0'&&$_SESSION['roleid'] != 1) {;echo '	<font color="#ccc">';echo L('delete');echo '</font>
	';}else {;echo '	<a href="javascript:confirmurl(\'?s=admin/position/delete/posid/';echo $info['posid'];echo '\', \'';echo L('posid_del_cofirm');echo '\')">';echo L('delete');echo '</a>	
	';};echo '	</td>
	</tr>
';
}
}
;echo '    </tbody>
    </table>
  
    <div class="btn"><input type="submit" class="button" name="dosubmit" value="';echo L('listorder');echo '" /></div>  </div>

 <div id="pages"> ';echo $pages;echo '</div>
</div>
</div>
</form>
</body>
<a href="javascript:edit(';echo $v['siteid'];echo ', \'';echo $v['name'];echo '\')">
</html>
<script type="text/javascript">
<!--
	window.top.$(\'#display_center_id\').css(\'display\',\'none\');
	function edit(id, name) {
	window.top.art.dialog({title:\'';echo L('edit');echo '--\'+name, id:\'edit\', iframe:\'?s=admin/position/edit/posid/\'+id ,width:\'500px\',height:\'360px\'}, 	function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;
	var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
//-->
</script>';?>