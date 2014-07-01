<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<div class="pad_10">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">
		';echo L('select_pdo_op');echo ' ';echo form::select($pdos,$pdoname,'name="pdo_select" onchange="show_tbl(this)"',L('select_pdo'));echo '		<input type="submit" value="';echo L('pdo_look');echo '" class="button" name="dosubmit">
		</div>
		</td>
		</tr>
    </tbody>
</table>
<div class="table-list">
<form method="post" id="myform" name="myform" >
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="10%"  align="left"><input type="checkbox" value="" id="check_box" onclick="selectall(\'filenames[]\');"></th>
            <th width="15%">';echo L('backup_file_name');echo '</th>
            <th width="15%">';echo L('backup_file_size');echo '</th>
            <th width="15%">';echo L('backup_file_time');echo '</th>
            <th width="15%">';echo L('backup_file_number');echo '</th>
            <th width="15%">';echo L('database_op');echo '</th>
            </tr>
        </thead>
    <tbody>
 ';
if(is_array($infos)){
foreach($infos as $info){
;echo '   
	<tr>
	<td width="10%">
<input type="checkbox" name="filenames[]" value="';echo $info['filename'];echo '" id="sql_house5" boxid="sql_house5">
	</td>
	<td  width="15%" align="center">';echo $info['filename'];echo '</td>
	<td width="15%" align="center">';echo $info['filesize'];echo ' M</td>
	<td width="15%" align="center">';echo $info['maketime'];echo '</td>
	<td width="15%" align="center">';echo $info['number'];echo '</td>
	<td width="15%" align="center">
	<a href="javascript:confirmurl(\'?s=admin/database/import/pdoname/';echo $pdoname;echo '/pre/';echo $info['pre'];echo '/dosubmit/1\', \'';echo L('confirm_recovery');echo '\')">';echo L('backup_import');echo '</a>
	</td>
	</tr>
';
}
}
;echo '    </tbody>
    </table>
<div class="btn">
<label for="check_box">';echo L('select_all');echo '/';echo L('cancel');echo '</label> 
<input type="submit" class="button" name="dosubmit" value="';echo L('backup_del');echo '" onclick="document.myform.action=\'?s=admin/database/delete/pdoname/';echo $pdoname;echo '\';return confirm(\'';echo L('bakup_del_confirm');echo '\')"/>
</div>
</form>
</div>
</div>

</body>
</html>
<script type="text/javascript">
<!--
function show_tbl(obj) {
	var pdoname = $(obj).val();
	location.href=\'?s=admin/database/import/pdoname/\'+pdoname+\'/menuid/\'+';echo $_GET['menuid'];echo '+\'/h5_hash/';echo $_SESSION['h5_hash'];echo '\';
}
//-->
</script>';?>