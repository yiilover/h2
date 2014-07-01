<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<script type="text/javascript">
$(document).ready(function() {
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'})}});
	$("#name").formValidator({onshow:"';echo L('input').L('nodename');echo '",onfocus:"';echo L('input').L('nodename');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('nodename');echo '"}).ajaxValidator({type : "get",url : "",data :"s=collection/node/public_name",datatype : "html",async:\'false\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('nodename').L('exists');echo '",onwait : "';echo L('connecting');echo '"});

});
</script>
<div class="pad-10">
<form name="myform" action="?s=collection/node/node_import" method="post" id="myform"  enctype="multipart/form-data">
<div class="common-form">
	<table width="100%" class="table_form">
		<tr>
			<td width="120">';echo L('collect_call');echo '£º</td> 
			<td>
			<input type="text" name="name" id="name"  class="input-text" value="" />
			</td>
		</tr>
		<tr>
			<td width="120">';echo L('cfg');echo '£º</td> 
			<td>
			<input type="file" name="file"  class="input-text" value="" /> <br />';echo L('only_support_txt_file_upload');echo '			</td>
		</tr>
	</table>
    <input name="dosubmit" type="submit" id="dosubmit" value="';echo L('submit');echo '" class="dialog">
</div>
</div>
</form>

</body>
</html>';?>