<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10"> 
<form name="searchform" action="?s=admin/log/search_log/menuid/';echo $_GET['menuid'];;echo '" method="get" >
<input type="hidden" value="admin/log/search_log" name="s">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td><div class="explain-col">';echo L('module');echo ': ';echo form::select($module_arr,'','name="search[module]"',$default);echo ' ';echo L('username');echo '  <input type="text" value="house5" class="input-text" name="search[username]" size=\'10\'>  ';echo L('times');echo '  ';echo form::date('search[start_time]','','1');echo ' ';echo L('to');echo '   ';echo form::date('search[end_time]','','1');echo '    <input type="submit" value="';echo L('determine_search');echo '" class="button" name="dosubmit"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="button" name="del_log_4" value="';echo L('removed_data');echo '" onclick="location=\'?s=admin/log/delete/week/4/menuid/';echo $_GET['menuid'];;echo '/h5_hash/';echo $_SESSION['h5_hash'];;echo '\'"  />
		</div>
		</td>
		</tr>
    </tbody>
</table>
</form>
<form name="myform" id="myform" action="?s=admin/log/delete" method="post" onsubmit="checkuid();return false;">
<div class="table-list">
 <table width="100%" cellspacing="0">
        <thead>
            <tr>
             <th width="80">';echo L('username');echo '</th>
            <th >';echo L('module');echo '</th>
            <th >';echo L('file');echo '</th>
             <th width="120">';echo L('time');echo '</th>
             <th width="120">IP</th>
            </tr>
        </thead>
    <tbody>
 ';
if(is_array($infos)){
foreach($infos as $info){
;echo '    <tr> 
        <td align="center">';echo $info['username'];echo '</td>
        <td align="center">';echo $info['module'];echo '</td>
        <td align="left" title="';echo $info['querystring'];echo '">';echo str_cut($info['querystring'],40);;echo '</td>
         <td align="center">';echo $info['time'];
;echo '</td>
         <td align="center">';echo $info['ip'];echo '¡¡</td> 
    </tr>
';
}
}
;echo '</tbody>
 </table>
 <div class="btn"> 
</div> 
<div id="pages">';echo $pages;echo '</div>

</div>
</form>
</div>
</body>
</html>
<script type="text/javascript"> 
function checkuid() {
	var ids=\'\';
	$("input[name=\'logid[]\']:checked").each(function(i, n){
		ids += $(n).val() + \',\';
	});
	if(ids==\'\') {
		window.top.art.dialog({content:\'';echo L('select_operations');echo '\',lock:true,width:\'200\',height:\'50\',time:1.5},function(){});
		return false;
	} else {
		myform.submit();
	}
}
</script>
 ';?>