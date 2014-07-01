<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '
<div class="pad-10">
<form action="?s=template/file/add_file&style=';echo $this->style;echo '&dir=';echo $dir;echo '" method="post" id="myform">
<div>
	<table width="100%"  class="table_form">
    <tr>
    <th width="80">';echo L('name');echo '£º</th>
    <td class="y-bg"><input type="text" name="name" id="name" /></td>
  </tr>
</table>
<div class="bk15"></div>
    <input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="';echo L('submit');echo '" />
</div>

</form>
</div>
<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#name").formValidator({onshow:"';echo L("input").L('name').L('without_the_input_name_extension');echo '",onfocus:"';echo L("input").L('name').L('without_the_input_name_extension');echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('name');echo '"}).regexValidator({regexp:"username",datatype:\'enum\',param:\'i\',onerror:"';echo L('name_datatype_error');echo '"}).ajaxValidator({type : "get",url : "",data :"s=template/file/public_name&style=';echo $this->style;echo '&dir=';echo $dir;echo '",datatype : "html",async:\'false\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('exists');echo '",onwait : "';echo L('connecting');echo '"});
	})
//-->
</script>
</body>
</html>';?>