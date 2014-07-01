<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');
;echo '<form name="myform" action="?s=admin/position/public_item" method="post">
<input type="hidden" value="';echo $posid;echo '" name="posid">
<div class="pad_10">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="10%"  align="left"><input type="checkbox" value="" id="check_box" onclick="selectall(\'items[]\');"></th>
            <th width="10%"  align="left">';echo L('listorder');;echo '</th>
            <th width="10%"  align="left">ID</th>
            <th width=""  align="left">';echo L('title');;echo '</th>
            <th width="15%">';echo L('catname');;echo '</th>
            <th width="15%">';echo L('inputtime');echo '</th>
            <th width="15%">';echo L('posid_operation');;echo '</th>
            </tr>
        </thead>
    <tbody>
 ';
if(is_array($infos)){
foreach($infos as $info){
;echo '   
	<tr>
	<td width="10%">
	<input type="checkbox" name="items[]" value="';echo $info['id'],'-',$info['modelid'];echo '" id="items" boxid="items">
	</td>	
	<td width="10%">
	<input name=\'listorders[';echo $info['catid'],'-',$info['id'];echo ']\' type=\'text\' size=\'3\' value=\'';echo $info['listorder'];echo '\' class="input-text-c">
	</td>	
	<td width="10%"  align="left">';echo $info['id'];echo '</td>
	<td width=""  align="left">';echo $info['title'];echo ' ';if($info['thumb']!='') {echo '<img src="'.IMG_PATH.'icon/small_img.gif">';};echo '</td>
	<td  width="15%" align="center">';echo $info['catname'];echo '</td>
	<td width="15%" align="center">';echo date('Y-m-d H:i:s',$info['inputtime']);echo '</td>
	<td width="15%" align="center"><a href="';echo $info['url'];echo '" target="_blank">';echo L('posid_item_view');echo '</a> | <a onclick="javascript:openwinx(\'?s=content/content/edit/catid/';echo $info['catid'];echo '/id/';echo $info['id'];echo '\',\'\')" href="javascript:;">';echo L('posid_item_edit');;echo '</a> | <a href="javascript:item_manage(';echo $info['id'];echo ',';echo $info['posid'];echo ', ';echo $info['modelid'];echo ',\'';echo $info['title'];echo '\')">';echo L('posid_item_manage');echo '</a>
	</td>
	</tr>
';
}
}
;echo '    </tbody>
    </table>
  
    <div class="btn"><label for="check_box">';echo L('select_all');echo '/';echo L('cancel');echo '</label> <input type="button" class="button" value="';echo L('listorder');echo '" onclick="myform.action=\'?s=admin/position/public_item_listorder\';myform.submit();"/> <input type="submit" class="button" name="dosubmit" value="';echo L('posid_item_remove');echo '" /> </div></div>

 <div id="pages"> ';echo $pages;echo '</div>
</div>
</div>
</form>
</body>
</html>
<script type="text/javascript">
	function item_manage(id,posid, modelid, name) {
	window.top.art.dialog({title:\'';echo L('edit');echo '--\'+name, id:\'edit\', iframe:\'?s=admin/position/public_item_manage/id/\'+id+\'/posid/\'+posid+\'/modelid/\'+modelid ,width:\'550px\',height:\'430px\'}, 	function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;
	var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
</script>';?>