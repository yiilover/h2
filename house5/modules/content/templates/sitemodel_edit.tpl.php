<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#name").formValidator({onshow:"';echo L("input").L('model_name');echo '",onfocus:"';echo L("input").L('model_name');echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('model_name');echo '"});
	})
//-->
</script>
<div class="pad-lr-10">
<form action="?s=content/sitemodel/edit" method="post" id="myform">
<fieldset>
	<legend>';echo L('basic_configuration');echo '</legend>
	<table width="100%"  class="table_form">
  <tr>
    <th width="120">';echo L('model_name');echo '£º</th>
    <td class="y-bg"><input type="text" class="input-text" name="info[name]" id="name" size="30" value="';echo $name;;echo '"/></td>
  </tr>
  <tr>
    <th>';echo L('model_tablename');echo '£º</th>
    <td class="y-bg"><input type="text" class="input-text" name="info[tablename]" id="tablename" size="30" value="';echo $tablename;;echo '" disabled/></td>
  </tr>
    <tr>
    <th>';echo L('description');echo '£º</th>
    <td class="y-bg"><input type="text" class="input-text" name="info[description]" id="description"  size="30" value="';echo $description;;echo '"/></td>
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
        ';print_r($template_list);;echo '		';echo form::select($style_list,$default_style,'name="info[default_style]" id="template_list" onchange="load_file_list(this.value)"',L('please_select'));echo ' 
</td>
</tr>
	<tr> 
      <th width="200">';echo L('category_index_tpl');;echo '</th>
      <td id="category_template">
      ';echo form::select_template($default_style,'content',$category_template,'name="setting[category_template]" id="template_category"','category');echo '</td>
    </tr>
	<tr> 
      <th >';echo L('category_list_tpl');;echo '</th>
      <td id="list_template">';echo form::select_template($default_style,'content',$list_template,'name="setting[list_template]" id="template_list"','list');echo '</td>
    </tr>
	<tr> 
      <th>';echo L('content_tpl');;echo '</th>
      <td id="show_template">';echo form::select_template($default_style,'content',$show_template,'name="setting[show_template]" id="template_show"','show');echo '</td>
    </tr>
</table>
</fieldset>
<div class="bk15"></div>
	<input type="hidden" name="modelid" value="';echo $modelid;;echo '" />
    <input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="';echo L('submit');;echo '" />
</form>
</div>
<script language="JavaScript">
<!--
function load_file_list(id) {
	$.getJSON(\'?s=admin/category/public_tpl_file_list/style/\'+id, function(data){$(\'#category_template\').html(data.category_template);$(\'#list_template\').html(data.list_template);$(\'#show_template\').html(data.show_template);});
}
	//-->
</script>
</body>
</html>';?>