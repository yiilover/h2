<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10">
<div class="table-list">
<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th>';echo L('title');echo '</th>
			<th width="14%" align="center">';echo L('startdate');echo '</th>
			<th width="14%" align="center">';echo L('enddate');echo '</th>
			<th width=\'20%\' align="center">';echo L('inputtime');echo '</th>
		</tr>
	</thead>
<tbody>
';
if(is_array($infos)){
foreach($infos as $info){
;echo '	<tr onclick="return_id(';echo $info['subjectid'];;echo ', \'';echo addslashes($info['subject']);echo '\')" style="cursor:hand" title="';echo L('check_select');echo '">
		<td>';if($target=='dialog') {;echo '<input type=\'radio\' id="voteid_';echo $info['subjectid'];echo '" name="subjectid">';}echo $info['subject'];echo '</td>
		<td >';echo $info['fromdate'];;echo '</td>
		<td >';echo $info['todate'];;echo '</td>
		<td >';echo date("Y-m-d h-i",$info['addtime']);;echo '</td>
	</tr>
	';
}
}
;echo '</tbody>
</table>
<input type="hidden" name="msg_id" id="msg_id">
<div id="pages">';echo $this->pages;echo '</div>
</div>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function return_id(voteid, title) {
	';if ($target=='dialog') {;echo '	$(\'#voteid_\'+voteid).attr(\'checked\', \'true\');
	$(\'#msg_id\').val(\'vote|\'+voteid+\'|\'+title);
	';};echo '	window.top.$(\'#voteid\').val(voteid);';if(!$target) {;echo 'window.top.art.dialog({id:\'selectid\'}).close(); ';};echo '}
//-->
</SCRIPT>
</body>
</html>
';?>