<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10">
<form name="searchform" action="?s=admin/ipbanned/search_ip/menuid/';echo $_GET['menuid'];;echo '" method="get" >
<input type="hidden" value="admin/ipbanned/search_ip" name="s">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td><div class="explain-col">IP:  <input type="text" value="" class="input-text" name="search[ip]">    <input type="submit" value="';echo L('search');echo '" class="button" name="dosubmit">
		</div>
		</td>
		</tr>
    </tbody>
</table>
</form>
<form name="myform" id="myform" action="?s=admin/ipbanned/delete" method="post" onsubmit="checkuid();return false;">
<div class="table-list">
 <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="35" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall(\'ipbannedid[]\');"></th>
             <th width="30%">IP</th>
            <th >';echo L('deblocking_time');echo '</th> 
             <th width="120">';echo L('operations_manage');echo '</th>
            </tr>
        </thead>
    <tbody>
 ';
if(is_array($infos)){
foreach($infos as $info){
;echo '    <tr>
    <td align="center">
	<input type="checkbox" name="ipbannedid[]" value="';echo $info['ipbannedid'];echo '">
	</td> 
        <td width="30%" align="left"><span  class="';echo $info['style'];echo '">';echo $info['ip'];echo '</span> </td>
        <td align="center">';echo date('Y-m-d H:i',$info['expires']);;echo '</td>
         <td align="center"><a href="javascript:confirmurl(\'?s=admin/ipbanned/delete/ipbannedid/';echo $info['ipbannedid'];echo '\', "';echo L('confirm_del_ip');echo '")">';echo L('delete');echo '</a> </td>
    </tr>
';
}
}
;echo '</tbody>
 </table>
 <div class="btn">
 <a href="#" onClick="javascript:$(\'input[type=checkbox]\').attr(\'checked\', true)">';echo L('selected_all');echo '</a>/<a href="#" onClick="javascript:$(\'input[type=checkbox]\').attr(\'checked\', false)">';echo L('cancel');echo '</a>

<input type="submit" name="submit" class="button" value="';echo L('remove_all_selected');echo '"  onClick="return confirm(\'';echo L('confirm',array('message'=>L('selected')));echo '\')" /> 

</div> 
<div id="pages">';echo $pages;echo '</div>

</div>

</form></div>
</body>
</html>
<script type="text/javascript">
function checkuid() {
	var ids=\'\';
	$("input[name=\'ipbannedid[]\']:checked").each(function(i, n){
		ids += $(n).val() + \',\';
	});
	if(ids==\'\') {
		window.top.art.dialog({content:"';echo L('before_select_operation');echo '",lock:true,width:\'200\',height:\'50\',time:1.5},function(){});
		return false;
	} else {
		myform.submit();
	}
}
</script>
 ';?>