<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'})}});
		$("#name").formValidator({onshow:"';echo L('input').L('name');echo '",onfocus:"';echo L('input').L('name');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('name');echo '"}).ajaxValidator({type : "get",url : "",data :"s=block/block_admin/public_name/id/';if(isset($id) &&!empty($id))echo $id;;echo '",datatype : "html",async:\'false\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('name').L('exists');echo '",onwait : "';echo L('connecting');echo '"})';if(ROUTE_A=='edit')echo '.defaultPassed()';;echo ';


	})
//-->
</script>
<div class="pad-10">
<form action="?s=block/block_admin/';echo ROUTE_A;echo '/pos/';echo $_GET['pos'];echo '/id/';if(isset($id) &&!empty($id))echo $id;;echo '" method="post" id="myform">
<div>
<fieldset>
	<legend>';echo L('block_configuration');echo '</legend>
	<table width="100%"  class="table_form">
    <tr>
    <th width="80">';echo L('name');echo '£º</th>
    <td class="y-bg"><input type="text" name="name" id="name" size="30" value="';echo isset($data['name']) ?$data['name'] : '';;echo '" /></td>
  	</tr>
    <tr>
    <th width="80">';echo L('display_position');echo '£º</th>
    <td class="y-bg"> ';echo isset($data['pos']) ?$data['pos'] : $_GET['pos'];;echo '</td>
  	</tr>
  	<tr>
    <th width="80">';echo L('type');echo '£º</th>
    <td class="y-bg">';echo form::radio(array('1'=>L('code'),'2'=>L('table_style')),(isset($data['type']) ?$data['type'] : 1),'name="type"'.(ROUTE_A=='edit'?' disabled = "disabled"': ''));echo '</td>
  	</tr>
</table>
</fieldset>
<div class="bk15"></div>
<fieldset>
	<legend>';echo L('permission_configuration');echo '</legend>
	<table width="100%"  class="table_form">
    <tr>
    <th width="80">';echo L('role');echo '£º</th>
    <td class="y-bg">';echo form::checkbox($administrator,(isset($priv_list) ?implode(',',$priv_list) : ''),'name="priv[]"');echo '</td>
  	</tr>
</table>
</fieldset>
    <input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="" />
</div>
</div>
</form>
</body>
</html>';?>