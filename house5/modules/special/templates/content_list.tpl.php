<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
$show_header = 1;
include $this->admin_tpl('header','admin');
;echo '
<div class="subnav"> 
<div class="content-menu ib-a blue line-x">
¡¡';if(isset($big_menu)) {foreach($big_menu as $big) {echo '<a class="add fb" href="'.$big[0].'"><em>'.$big[1].'</em></a>¡¡';}};echo '&nbsp;<a class="on" href="?s=special/special"><em>';echo L('special_list');echo '</em></a></div>
</div>
<div class="pad-10">
<div class="table-list">
<form name="myform" action="?s=special/content/listorder&specialid=';echo $_GET['specialid'];echo '" method="post">
    <table width="100%">
        <thead>
            <tr>
			<th width="40"><input type="checkbox" value="" id="check_box" onclick="selectall(\'id[]\');"></th>
            <th width="43">';echo L('listorder');echo '</th>
            <th width="60">ID</th>
			<th>';echo L('content_title');echo '</th>
			<th width="120">';echo L('for_type');echo '</th>
            <th width="90">';echo L('inputman');echo '</th>
            <th width="120">';echo L('update_time');echo '</th>
			<th width="200">';echo L('operations_manage');echo '</th>
            </tr>
        </thead>
<tbody>
    ';foreach ($datas as $r) {
if ($r['curl']) {
$content_arr = explode('|',$r['curl']);
$r['url'] = go($content_arr['1'],$content_arr['0']);
}
;echo '        <tr>
		<td align="center" width="40"><input class="inputcheckbox " name="id[]" value="';echo $r['id'];;echo '" type="checkbox"></td>
        <td align=\'center\' width=\'43\'><input name=\'listorders[';echo $r['id'];;echo ']\' type=\'text\' size=\'3\' value=\'';echo $r['listorder'];;echo '\' class=\'input-text-c\'></td>
		<td align=\'center\' width="60">';echo $r['id'];;echo '</td>
		<td><a href="';echo $r['url'];;echo '" target="_blank">';echo $r['title'];;echo '</a></td>
		<td align=\'center\' width="120">';echo $types[$r['typeid']]['name'];;echo '</td>
		<td align=\'center\' width="90">';echo $r['username'];;echo '</td>
		<td align=\'center\' width="120">';echo format::date($r['updatetime'],1);;echo '</td>
		<td align=\'center\' width="200"><a href="javascript:;" onclick="javascript:openwinx(\'?s=special/content/edit&specialid=';echo $r['specialid'];echo '&id=';echo $r['id'];echo '\',\'\')">';echo L('content_edit');echo '</a> </td>
	</tr>
     ';};echo '</tbody>
     </table>
    <div class="btn"><label for="check_box">';echo L('selected_all');echo '/';echo L('cancel');echo '</label> <input type="submit" class="button" value="';echo L('listorder');echo '" /> <input type="submit" class="button" value="';echo L('delete');echo '" onclick="if(confirm(\'';echo L('confirm',array('message'=>L('selected')));echo '\')){document.myform.action=\'?s=special/content/delete&specialid=';echo $_GET['specialid'];echo '\'}else{return false;}"/></div>
    <div id="pages">';echo $pages;;echo '</div>
</form>
</div>
</div>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'cookie.js"></script>
<script type="text/javascript">
setcookie(\'refersh_time\', 0);
function refersh_window() {
	var refersh_time = getcookie(\'refersh_time\');
	if(refersh_time==1) {
		window.location.reload();
	}
}

setInterval("refersh_window()", 5000);
</script>
</body>
</html>';?>