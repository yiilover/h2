<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<script type="text/javascript">
$(document).ready(function() {
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'})}});
	$("#name").formValidator({onshow:"';echo L('input').L('nodename');echo '",onfocus:"';echo L('input').L('nodename');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('nodename');echo '"}).ajaxValidator({type : "get",url : "",data :"s=collection/node/public_name",datatype : "html",async:\'false\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('nodename').L('exists');echo '",onwait : "';echo L('connecting');echo '"});

});
</script>
<div class="pad-10">
<form name="myform" action="?s=collection/node/copy/nodeid/';if(isset($nodeid)) echo $nodeid;echo '" method="post" id="myform">
<div class="common-form">
	<table width="100%" class="table_form">
		<tr>
			<td width="120">';echo L('had_collected_from_the_roll');echo '£º</td> 
			<td>
			';if(isset($data['name'])) echo $data['name'];echo '			</td>
		</tr>
		<tr>
			<td width="120">';echo L('the_new_gathering');echo '£º</td> 
			<td>
			<input type="text" name="name" id="name"  class="input-text" value="" />
			</td>
		</tr>
	</table>
    <input name="dosubmit" type="submit" id="dosubmit" value="';echo L('submit');echo '" class="dialog">
</div>
</div>
</form>

</body>
</html>';?>