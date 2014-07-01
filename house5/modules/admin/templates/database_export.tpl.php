<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<div class="pad_10">
<div class="table-list">
<form method="post" name="myform" id="myform" action="?s=admin/database/export">
<input type="hidden" name="tabletype" value="house5tables" id="house5tables">
<table width="100%" cellspacing="0">
<thead>
  	<tr>
    	<th class="tablerowhighlight" colspan=4>';echo L('backup_setting');echo '</th>
  	</tr>
</thead>
  	<tr>
	    <td class="align_r">';echo L('sizelimit');echo '</td>
	    <td colspan=3><input type=text name="sizelimit" value="2048" size=5> K</td>
  	</tr>
   	<tr>
	    <td class="align_r">';echo L('sqlcompat');echo '</td>
	    <td colspan=3><input type="radio" name="sqlcompat" value="" checked> ';echo L('default');echo ' &nbsp; <input type="radio" name="sqlcompat" value="MYSQL40"> MySQL 3.23/4.0.x &nbsp; <input type="radio" name="sqlcompat" value="MYSQL41"> MySQL 4.1.x/5.x &nbsp;</td>
  	</tr>
   	<tr>
	    <td class="align_r">';echo L('sqlcharset');echo '</td>
	    <td colspan=3><input type="radio" name="sqlcharset" value="" checked> ';echo L('default');echo '&nbsp; <input type="radio" name="sqlcharset" value="latin1"> LATIN1 &nbsp; <input type="radio" name="sqlcharset" value=\'utf8\'> UTF-8</option></td>
  	</tr>
  	<tr>
	    <td class="align_r">';echo L('select_pdo');echo '</td>
	    <td colspan=3>';echo form::select($pdos,$pdo_name,'name="pdo_select" onchange="show_tbl(this)"',L('select_pdo'));echo '</td>
  	</tr>
  	<tr>
	    <td></td>
	    <td colspan=3><input type="submit" name="dosubmit" value=" ';echo L('backup_starting');echo ' " class="button"></td>
  	</tr>
</table>
    <table width="100%" cellspacing="0">
 ';
if(is_array($infos)){
;echo '   
	<thead><tr><th align="center" colspan="8"><strong>';echo $pdo_name;echo ' ';echo L('pdo_name');echo '</strong></th></tr></thead>
    <thead>
       <tr>
           <th width="10%"><input type="checkbox" value="" id="check_box" onclick="selectall(\'tables[]\');"> <a class="cu" href="javascript:void(0);" onclick="reselect()">';echo L('reselect');echo '</a></th>
           <th width="10%" >';echo L('database_tblname');echo '</th>
           <th width="10%">';echo L('database_type');echo '</th>
           <th width="10%">';echo L('database_char');echo '</th>
           <th width="15%">';echo L('database_records');echo '</th>
           <th width="15%">';echo L('database_size');echo '</th>
           <th width="15%">';echo L('database_block');echo '</th>
            <th width="15%">';echo L('database_op');echo '</th>
       </tr>
    </thead>
    <tbody>
	';foreach($infos['house5tables'] as $v){;echo '	<tr>
	<td  width="5%" align="center"><input type="checkbox" name="tables[]" value="';echo $v['name'];echo '"/></td>
	<td  width="10%" align="center">';echo $v['name'];echo '</td>
	<td  width="10%" align="center">';echo $v['engine'];echo '</td>
	<td  width="10%" align="center">';echo $v['collation'];echo '</td>
	<td  width="15%" align="center">';echo $v['rows'];echo '</td>
	<td  width="15%" align="center">';echo $v['size'];echo '</td>
	<td  width="15%" align="center">';echo $v['data_free'];echo '</td>
	<td  width="15%" align="center"><a href="?s=admin/database/public_repair/operation/optimize/pdo_name/';echo $pdo_name;echo '/tables/';echo $v['name'];echo '">';echo L('database_optimize');echo '</a> | <a href="?s=admin/database/public_repair/operation/repair/pdo_name/';echo $pdo_name;echo '/tables/';echo $v['name'];echo '">';echo L('database_repair');echo '</a> | <a href="javascript:void(0);" onclick="showcreat(\'';echo $v['name'];echo '\',\'';echo $pdo_name;echo '\')">';echo L('database_showcreat');echo '</a></td>
	</tr>
	';};echo '	</tbody>
';
}
;echo '</table>
 ';
if(is_array($infos)){
;echo '<div class="btn">
<label for="check_box">';echo L('select_all');echo '/';echo L('cancel');echo '</label>
<input type="button" class="button" onclick="reselect()" value="';echo L('reselect');echo '"/>
<input type="submit" class="button" name="dosubmit" onclick="document.myform.action=\'?s=admin/database/public_repair/operation/optimize/pdo_name/';echo $pdo_name;echo '\'" value="';echo L('batch_optimize');echo '"/>
<input type="submit" class="button" name="dosubmit" onclick="document.myform.action=\'?s=admin/database/public_repair/operation/repair/pdo_name/';echo $pdo_name;echo '\'" value="';echo L('batch_repair');echo '"/>
</div>
';
}
;echo '</form>
</div>
</div>
</form>
</body>
<script type="text/javascript">
<!--
function show_tbl(obj) {
	var pdoname = $(obj).val();
	location.href=\'?s=admin/database/export/pdoname/\'+pdoname+\'/h5_hash/';echo $_SESSION['h5_hash'];echo '\';
}
function showcreat(tblname, pdo_name) {
	window.top.art.dialog({title:tblname, id:\'show\', iframe:\'?s=admin/database/public_repair/operation/showcreat/pdo_name/\'+pdo_name+\'/tables/\' +tblname,width:\'500px\',height:\'350px\'});
}
function reselect() {
	var chk = $("input[name=tables[]]");
	var length = chk.length;
	for(i=0;i < length;i++){
		if(chk.eq(i).attr("checked")) chk.eq(i).attr("checked",false);
		else chk.eq(i).attr("checked",true);
	}
}
//-->
</script>
</html>
';?>