<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
	$(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
	$("#name").formValidator({onshow:"';echo L("input").L('dianping_type_name');echo '",onfocus:"';echo L("input").L('dianping_type_name');echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('dianping_type_name');echo '"}).defaultPassed(); 
 	})
//-->
</script>
<div class="pad-lr-10">
<form action="?s=dianping/dianping/add_type" method="post" name="myform" id="myform">
<table cellpadding="2" cellspacing="1" class="table_form" width="100%">

	<tr>
		<th width="60">';echo L('dianping_type_name');echo '£º</th>
		<td><input type="text" name="type[name]" id="name"
			size="30" class="input-text" value="';echo $name;;echo '"></td>
	</tr> 
	
	<tr>
		<th>';echo L('dianping_type_data');echo '£º</th>
		<td><textarea name="type[data]" id="data" cols="29"
			rows="6">';echo $data;;echo '</textarea> <br>';echo L('dianping_datainfo');echo '</td>
	</tr> 
	
	<tr>
    <th >';echo L('is_guest');echo '</th>
    <td ><input type="checkbox" name="setting[guest]" value="1"></td>
    </tr>
 	<tr>
	<th width="120">';echo L('is_check');echo '</th>
	<td class="y-bg"><input type="checkbox" name="setting[check]" value="1" ></td>
	</tr>
	<tr>
	<th width="120">';echo L('is_code');echo '</th>
	<td class="y-bg"><input type="checkbox" name="setting[code]" value="1" ></td>
	</tr>
	<tr>
	<th width="120">';echo L('is_checkuserid');echo '</th>
	<td class="y-bg"><input type="checkbox" name="setting[is_checkuserid]" value="1"> (<font color=red> is_checkuserid=1 </font>)</td>
	</tr>
	<tr>
	<th width="120">';echo L('add_points');echo '</th>
	<td class="y-bg"><input type="input" name="setting[add_point]" value="0" class="input-text"> ';echo L('points_info');echo '</td>
	</tr>
	<tr>
	<th width="120">';echo L('del_points');echo '</th>
	<td class="y-bg"><input type="input" name="setting[del_point]" value="0" class="input-text"> ';echo L('points_info');echo '</td>
	</tr>
	
	
	<input
		type="submit" name="dosubmit" id="dosubmit" class="dialog"
		value=" ';echo L('submit');echo ' ">
 
</table>
</form>
</div>
</body>
</html>
';?>