<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#name").formValidator({onshow:"';echo L("input").L('type_name');echo '",onfocus:"';echo L("input").L('type_name');echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('type_name');echo '"}).regexValidator({regexp:"ps_username",datatype:"enum",onerror:"';echo L('type_name').L('format_incorrect','','member');echo '"});
	})
//-->
</script>
<div class="pad-lr-10">
<form action="?s=search/search_type/add" method="post" id="myform">
	<table width="100%"  class="table_form">
	<tr>
    <th width="120">';echo L('select_module_name');echo '£º</th>
    <td class="y-bg">';echo form::select($module_data,$_GET['module'],'name="module" onchange="change_module(this.value)"');echo '</td>
  </tr>
  ';if($_GET['module'] == 'content') {;echo '  <tr id="modelid_display">
    <th width="120">';echo L('select_model_name');echo '£º</th>
    <td class="y-bg">';echo form::select($model_data,'','name="info[modelid]"');echo '</td>
  </tr>
  ';};echo '  ';if($_GET['module'] == 'yp') {;echo '  <tr id="yp_modelid_display">
    <th width="120">';echo L('select_model_name');echo '£º</th>
    <td class="y-bg">';echo form::select($yp_model_data,'','name="info[yp_modelid]"');echo '</td>
  </tr>
  ';};echo '  <tr>
    <th width="120">';echo L('type_name');echo '£º</th>
    <td class="y-bg"><input type="text" class="input-text" name="info[name]" id="name" size="30" /></td>
  </tr>
    <tr>
    <th>';echo L('description');echo '£º</th>
    <td class="y-bg"><textarea name="info[description]" maxlength="255" style="width:300px;height:60px;"></textarea></td>
  </tr>
</table>

<div class="bk15"></div>
    <input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="';echo L('submit');echo '" />
</form>
</div>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function change_module(module) {
		redirect(\'?s=search/search_type/add&module=\'+module+\'&h5_hash=';echo $_SESSION['h5_hash'];echo '\');
}
//-->
</SCRIPT>
</body>
</html>';?>