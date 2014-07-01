<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');
;echo '<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#word").formValidator({onshow:"';echo L('input').L('keylink');;echo '",onfocus:"';echo L('input').L('keylink');;echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('keylink');;echo '"}).regexValidator({regexp:"notempty",datatype:"enum",param:\'i\',onerror:"';echo L('en_tips_type');;echo '"}).ajaxValidator({type : "get",url : "",data :"s=admin/keylink/public_name",datatype : "html",async:\'false\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('keylink').L('exists');;echo '",onwait : "';echo L('connecting');;echo '"}); 
		$("#url").formValidator({onshow:"';echo L('input_siteurl');;echo '",onfocus:"';echo L('input_siteurl');;echo '"}).inputValidator({min:1,onerror:"';echo L('input_siteurl');;echo '"}).regexValidator({regexp:"^http:",onerror:"';echo L('copyfrom_url_tips');;echo '"});
	})
//-->
</script>
<div class="pad_10">
<table width="100%" cellpadding="2" cellspacing="1" class="table_form">
<form action="?s=admin/keylink/add" method="post" name="myform" id="myform">
	<tr> 
      <th width="25%">';echo L('keylink_name');;echo ' :</th>
      <td><input type="text" name="info[word]" id="word" size="20"></td>
    </tr>
	<tr> 
      <th>';echo L('keylink_url');;echo ' :</th>
      <td><input type="text" name="info[url]" value="http://www." size="30" id="url"></td>
    </tr> 
	  <input type="submit" name="dosubmit" id="dosubmit" class="dialog" value=" ';echo L('submit');echo ' ">
 	</form>
</table> 
</div>
</body>
</html>';?>