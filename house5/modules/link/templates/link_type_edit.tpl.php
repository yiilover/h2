<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
	$(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
	$("#type_name").formValidator({onshow:"';echo L("input").L('type_name');echo '",onfocus:"';echo L("input").L('type_name');echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('type_name');echo '"}).ajaxValidator({type : "get",url : "",data :"s=link/link/public_check_name/typeid/';echo $typeid;;echo '",datatype : "html",async:\'false\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('type_name').L('exists');echo '",onwait : "';echo L('connecting');echo '"}).defaultPassed(); 
	 
	})
//-->
</script>
<div class="pad-lr-10">
<form action="?s=link/link/edit_type/typeid/';echo $typeid;;echo '" method="post" name="myform" id="myform">
<table cellpadding="2" cellspacing="1" class="table_form" width="100%">

	<tr>
		<th width="60">';echo L('type_name');echo '��</th>
		<td><input type="text" name="type[name]" id="type_name"
			size="30" class="input-text" value="';echo $name;;echo '"></td>
	</tr>
	
	<tr>
		<th width="100">';echo L('link_type_listorder');echo '��</th>
		<td><input type="text" name="type[listorder]" id="listorder"
			size="5" class="input-text" value="';echo $listorder;;echo '"></td>
	</tr>
	
	<tr>
		<th>';echo L('type_description');echo '��</th>
		<td><textarea name="type[description]" id="description" cols="50"
			rows="6">';echo $description;;echo '</textarea></td>
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