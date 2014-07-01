<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');
;echo '<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		
		$("#ip").formValidator({onshow:"';echo L('input').L('ipbanned');echo '",onfocus:"';echo L('input').L('ipbanned');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('ipbanned');echo '"}).regexValidator({regexp:"notempty",datatype:"enum",param:\'i\',onerror:"';echo L('three_types');echo '"}).ajaxValidator({type : "get",url : "",data :"s=admin/ipbanned/public_name",datatype : "html",async:\'false\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('ip_exit');echo '",onwait : "';echo L('connecting');echo '"});
		$("#expires").formValidator({onshow:"';echo L('input').L('deblocking_time');echo '",onfocus:"';echo L('input').L('deblocking_time');echo '",oncorrect:"';echo L('time_isok');echo '"}).inputValidator({min:1,onerror:"';echo L('time_ismust');echo '"});
		
	})
//-->
</script>

<div class="pad_10">
<form action="?s=admin/ipbanned/add" method="post" name="myform" id="myform" >
<table width="100%" cellpadding="2" cellspacing="1" class="table_form">
	<tr> 
      <th width="60">IP :</th>
      <td><input type="text" name="info[ip]" id="ip" size="25"></td>
    </tr>
	<tr> 
      <th>';echo L('deblocking_time');echo ' :</th>
      <td>';echo form::date('info[expires]','','');echo '</td>
    </tr>  
	  <input type="submit" name="dosubmit" id="dosubmit" class="dialog" value=" ';echo L('submit');echo ' ">

</table> 
 	</form>
</div>
</body>
</html>';?>