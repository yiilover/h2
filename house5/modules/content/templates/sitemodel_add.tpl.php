<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#name").formValidator({onshow:"';echo L("input").L('model_name');echo '",onfocus:"';echo L("input").L('model_name');echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('model_name');echo '"});
		$("#tablename").formValidator({onshow:"';echo L("input").L('model_tablename');echo '",onfocus:"';echo L("input").L('model_tablename');echo '"}).regexValidator({regexp:"^([a-zA-Z0-9]|[_]){0,20}$",onerror:"';echo L("model_tablename_wrong");;echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('model_tablename');echo '"}).ajaxValidator({type : "get",url : "",data :"s=content/sitemodel/public_check_tablename",datatype : "html",async:\'false\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('model_tablename').L('exists');echo '",onwait : "';echo L('connecting');echo '"});		
	})
//-->
</script>
<div class="pad-lr-10">
<form action="?s=content/sitemodel/add" method="post" id="myform">
<fieldset>
	<legend>';echo L('basic_configuration');echo '</legend>
	<table width="100%"  class="table_form">
  <tr>
    <th width="120">';echo L('model_name');echo '£º</th>
    <td class="y-bg"><input type="text" class="input-text" name="info[name]" id="name" size="30" /></td>
  </tr>
  <tr>
    <th>';echo L('model_tablename');echo '£º</th>
    <td class="y-bg"><input type="text" class="input-text" name="info[tablename]" id="tablename" size="30" /></td>
  </tr>
    <tr>
    <th>';echo L('description');echo '£º</th>
    <td class="y-bg"><input type="text" class="input-text" name="info[description]" id="description"  size="30"/></td>
  </tr>
</table>
</fieldset>
<div class="bk15"></div>
<fieldset>
	<legend>';echo L('template_setting');echo '</legend>
	<table width="100%"  class="table_form">
	<tr>
  <th width="200">';echo L('available_styles');;echo '</th>
        <td>
		';echo form::select($style_list,'','name="info[default_style]" id="default_style" onchange="load_file_list(this.value)"',L('please_select'));echo ' 
		</td>
</tr>
		<tr>
        <th width="200">';echo L('category_index_tpl');echo '£º</th>
        <td  id="category_template">
		</td>
      </tr>
	  <tr>
        <th width="200">';echo L('category_list_tpl');echo '£º</th>
        <td  id="list_template">
		</td>
      </tr>
	  <tr>
        <th width="200">';echo L('content_tpl');echo '£º</th>
        <td  id="show_template">
		</td>
      </tr>
</table>
</fieldset>
<div class="bk15"></div>
    <input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="';echo L('submit');;echo '" />
</form>
</div>
<script language="JavaScript">
<!--
	function load_file_list(id) {
		$.getJSON(\'?s=admin/category/public_tpl_file_list/style/\'+id+\'/catid/\', function(data){$(\'#category_template\').html(data.category_template);$(\'#list_template\').html(data.list_template);$(\'#show_template\').html(data.show_template);});
	}
	//-->
</script>
</body>
</html>';?>