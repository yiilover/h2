<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_validator = true;
include $this->admin_tpl('header');
;echo '
<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#rolename").formValidator({onshow:"';echo L('input').L('role_name');echo '",onfocus:"';echo L('role_name').L('not_empty');echo '"}).inputValidator({min:1,max:999,onerror:"';echo L('role_name').L('not_empty');echo '"});
})
//-->
</script>
<div class="pad_10">
<div class="common-form">
<form name="myform" action="?s=admin/role/add" method="post" id="myform">
<table width="100%" class="table_form contentWrap">
<tr>
<td>';echo L('role_name');echo '</td> 
<td><input type="text" name="info[rolename]" value="" class="input-text" id="rolename"></input></td>
</tr>
<tr>
<td>';echo L('role_description');echo '</td>
<td><textarea name="info[description]" rows="2" cols="20" id="description" class="inputtext" style="height:100px;width:500px;"></textarea></td>
</tr>
<tr>
<td>';echo L('enabled');echo '</td>
<td><input type="radio" name="info[disabled]" value="0" checked> ';echo L('enable');echo '  <label><input type="radio" name="info[disabled]" value="1">';echo L('ban');echo '</td>
</tr>
<tr>
<td>';echo L('listorder');echo '</td>
<td><input type="text" name="info[listorder]" size="3" class="input-text"></td>
</tr>
</table>

    <div class="bk15"></div>
    <input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="button">
</form>
</div>
</div>
</body>
</html>


';?>