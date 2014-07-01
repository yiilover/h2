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
		<td><div class="explain-col">';echo L('module');echo ': ';echo form::select($module_arr,'','name="search[module]"',$default);echo ' 用户名:  <input type="text" value=';echo $_GET['search']['username'];;echo ' class="input-text" name="search[username]" size=\'10\'>  时 间:  ';echo form::date('search[start_time]',$_GET['search']['start_time'],'1');echo ' 至   ';echo form::date('search[end_time]',$_GET['search']['end_time'],'1');echo '    <input type="submit" value="确定搜索" class="button" name="dosubmit">
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
            <th width="35" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall(\'logid[]\');"></th>
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
    <td align="center">
	<input type="checkbox" name="logid[]" value="';echo $info['logid'];echo '">
	</td>
        <td align="center">';echo $info['username'];echo '</td>
        <td align="center">';echo $info['module'];echo '</td>
        <td align="left" title="';echo $info['querystring'];echo '">';echo str_cut($info['querystring'],40);;echo '</td>
         <td align="center">';echo $info['time'];
;echo '</td>
         <td align="center">';echo $info['ip'];echo '　</td> 
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

</form></div>
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