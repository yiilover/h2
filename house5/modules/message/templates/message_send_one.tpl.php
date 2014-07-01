<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = 1;
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript"> 
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#subject").formValidator({onshow:"';echo L('input','','admin').L('subject');echo '",onfocus:"';echo L('subject').L('no_empty');echo '"}).inputValidator({min:1,max:999,onerror:"';echo L('subject').L('no_empty');echo '"});
	$("#con").formValidator({onshow:"';echo L('content').L('no_empty');echo '",onfocus:"';echo L('content').L('no_empty');echo '"}).inputValidator({min:1,max:999,onerror:"';echo L('content').L('no_empty');echo '"});
  	$("#tousername").formValidator({onshow:"';echo L('input','','admin').L('touserid');echo '",onfocus:"';echo L('touserid').L('no_empty');echo '"}).inputValidator({min:1,onerror:"';echo L('input','','admin').L('touserid');echo '"}).ajaxValidator({type : "get",url : "",data :"s=message/message/public_name",datatype : "html",async:\'true\',success : function(data){if( data == 1 ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('not_myself');echo '! ",onwait : "';echo L('connecting');echo '"});
})
//-->
</script> 
<div class="pad-lr-10"> 
<form action="?s=message/message/send_one" method="post" name="myform" id="myform">
<table cellpadding="2" cellspacing="1" class="table_form" width="100%">

	<tr>
		<th width="100">';echo L('subject');echo '£º</th>
		<td><input type="text" name="info[subject]" id="subject"
			size="30" class="input-text"></td>
	</tr>
	
	<tr>
		<th width="100">';echo L('touserid');echo '£º</th>
		<td><input type="text" name="info[send_to_id]" id="tousername"
			size="20" class="input-text" value=""></td>
	</tr>
	
	<tr>
		<th>';echo L('content');echo '£º</th>
		<td><textarea name="info[content]" id="con" cols="50"
			rows="6"></textarea></td>
	</tr>

	<tr>
		<th></th>
		<td><input
		type="submit" name="dosubmit" id="dosubmit" class="button"
		value=" ';echo L('submit');echo ' "></td>
	</tr>

</table>
</form>
</div>
</body>
</html>
';?>