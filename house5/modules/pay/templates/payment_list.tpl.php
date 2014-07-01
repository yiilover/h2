<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<form name="myform" action="?s=admin/position/listorder" method="post">
<div class="pad_10">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="10%"  align="left">';echo L('payment_mode').L('name');echo '</th>
            <th width="5%">';echo L('plus_version');echo '</th>
            <th width="15%">';echo L('plus_author');echo '</th>
            <th width="45%">';echo L('desc');echo '</th>
             <th width="10%">';echo L('listorder');echo '</th>
            <th width="15%">';echo L('operations_manage');echo '</th>
            </tr>
        </thead>
    <tbody>
 ';
if(is_array($infos['data'])){
foreach($infos['data'] as $info){
;echo '   
	<tr>
	<td width="10%">';echo $info['pay_name'];echo '</td>
	<td  width="5%" align="center">';echo $info['version'];echo '</td>
	<td  width="15%" align="center">';echo $info['author'];echo '</td>
	<td width="45%" align="center">';echo $info['pay_desc'];echo '</td>
	<td width="10%" align="center">';echo $info['pay_order'];echo '</td>
	<td width="15%" align="center">
	';if ($info['enabled']) {;echo '	<a href="javascript:edit(\'';echo $info['pay_id'];echo '\', \'';echo $info['pay_name'];echo '\')">';echo L('configure');echo '</a> | 
	<a href="javascript:confirmurl(\'?s=pay/payment/delete&id=';echo $info['pay_id'];echo '\', \'';echo L('confirm',array('message'=>$info['pay_name']));echo '\')">';echo L('plus_uninstall');echo '</a>
	';}else {;echo '	<a href="javascript:add(\'';echo $info['pay_code'];echo '\', \'';echo $info['pay_name'];echo '\')">';echo L('plus_install');echo '</a>
	';};echo '	</td>
	</tr>
';
}
}
;echo '    </tbody>
    </table>
  
    <div class="btn"></div>  </div>

 <div id="pages"> ';echo $pages;echo '</div>
</div>
</div>
</form>
</body>
<a href="javascript:edit(';echo $v['siteid'];echo ', \'';echo $v['name'];echo '\')">
</html>
<script type="text/javascript">
<!--
	function add(id, name) {
	window.top.art.dialog({title:\'';echo L('edit');echo '--\'+name, id:\'add\', iframe:\'?s=pay/payment/add&code=\'+id ,width:\'700\',height:\'500\'}, 	function(){var d = window.top.art.dialog({id:\'add\'}).data.iframe;
	var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'add\'}).close()});
}	
	function edit(id, name) {
		window.top.art.dialog({title:\'';echo L('edit');echo '--\'+name, id:\'edit\', iframe:\'?s=pay/payment/edit&id=\'+id ,width:\'700\',height:\'500\'}, 	function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;
		var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
//-->
</script>';?>