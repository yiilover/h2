<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript"> 
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#name").formValidator({onshow:"';echo L('input').L('name');echo '",onfocus:"';echo L('input').L('name');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('name');echo '"}).ajaxValidator({type : "get",url : "",data :"s=tag/tag/public_name&id=';echo $id;echo '",datatype : "html",async:\'false\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('name').L('exists');echo '",onwait : "';echo L('connecting');echo '"}).defaultPassed();
		$("#cache").formValidator({onshow:"';echo L("enter_the_cache_input_will_not_be_cached");echo '",onfocus:"';echo L("enter_the_cache_input_will_not_be_cached");echo '",empty:true}).regexValidator({regexp:"num1",datatype:\'enum\',param:\'i\',onerror:"';echo L("cache_time_can_only_be_positive");echo '"}).defaultPassed();
		$("#num").formValidator({onshow:"';echo L('input').L("num");echo '",onfocus:"';echo L('input').L("num");echo '",empty:true}).regexValidator({regexp:"num1",datatype:\'enum\',param:\'i\',onerror:"';echo L('that_shows_only_positive_numbers');echo '"}).defaultPassed();
		$("#return").formValidator({onshow:"';echo L('return_value');echo '",onfocus:"';echo L('return_value');echo '",empty:true});
		show_action(\'position\');
	})
	
	function show_action(obj) {
		$(\'.h5_action_list\').hide();
		$(\'#action_\'+obj).show();
	}
//-->
</script>

<div class="pad-10">
<form action="?s=tag/tag/edit&id=';echo $id;echo '" method="post" id="myform">
<div>
<fieldset>
	<legend>';echo L('tag_call_setting');echo '</legend>
	<table width="100%"  class="table_form">
    <tr>
		<th width="80">';echo L('stdcall');echo '£º</th>
		<td class="y-bg">';echo form::radio(array('0'=>L('model_configuration'),'1'=>L('custom_sql'),'2'=>L('block')),$type ?$type : 0,'name="type" onclick="location.href=\''.get_url().'&type=\'+this.value"');echo '</td>
	</tr>
  ';if ($type==0) :;echo '    <tr>
		<th>';echo L('select_model');echo '£º</th>
		<td class="y-bg">';echo form::select($modules,$module,'name="module" id="module" onchange="location.href=\''.get_url().'&module=\'+this.value"');echo '<script type="text/javascript">$(function(){$("#module").formValidator({onshow:"';echo L('please_select_model');echo '",onfocus:"';echo L('please_select_model');echo '"}).inputValidator({min:1, onerror:\'';echo L('please_select_model');echo '\'});});</script></td>
	</tr>
  ';if ($module):;echo '    <tr>
		<th>';echo L('selectingoperation');echo '£º</th>
		<td class="y-bg">';echo form::radio($html['action'],$action,'name="action" onclick="location.href=\''.get_url().'&action=\'+this.value"');echo '</td>
	  </tr>
	  ';endif;;echo '	  ';if(isset($html[$action]) &&is_array($html[$action]) &&$action)foreach($html[$action] as $k=>$v):;echo '		  <tr>
		<th>';echo $v['name'];echo '£º</th>
		<td class="y-bg">';echo creat_form($k,$v,$form_data[$k],$module);echo '</td>
	</tr>
	';if(isset($v['ajax']['name'])  &&!empty($v['ajax']['name'])) {;echo '  	  <tr>
  	  	<th width="80">';echo $v['ajax']['name'];echo '£º';if(isset($_GET[$v['ajax']['id']]) &&!empty($_GET[$v['ajax']['id']])) echo '<script type="text/javascript">$.get(\'?s=template/file/public_ajax_get\', { html: \''.$_GET[$k].'\', id:\''.$v['ajax']['id'].'\', value:\''.$_GET[$v['ajax']['id']].'\', action: \''.$v['ajax']['action'].'\', op: \''.$module.'\', style: \'default\'}, function(data) {$(\'#'.$k.'_td\').html(data)});</script>';echo '</th>
  	  	<td class="y-bg"><input type="text" size="20" value="';echo $_GET[$v['ajax']['id']];echo '" id="';echo $v['ajax']['id'];echo '" name="';echo $v['ajax']['id'];echo '" class="input-text"><span id="';echo $k;echo '_td"></span></td>
  	 </tr>
  ';};echo '  ';endforeach;;echo '  ';elseif ($type==1) :;echo '    <tr>
		<th valign="top">';echo L('custom_sql');echo '£º</th>
		<td class="y-bg"><textarea name="data" id="data" style="width:386px;height:178px;">';echo $form_data['sql'];echo '</textarea><script type="text/javascript">$(function(){$("#data").formValidator({onshow:"';echo L('please_enter_a_sql');echo '",onfocus:"';echo L('please_enter_a_sql');echo '"}).inputValidator({min:1, onerror:\'';echo L('please_enter_a_sql');echo '\'});});</script></td>
  </tr>
  <tr>
		<th valign="top">';echo L('over_dbsource');echo '£º</th>
		<td class="y-bg">';echo form::select($dbsource,$form_data['dbsource'],'name="dbsource" id="dbsource" ');echo '<script type="text/javascript">$(function(){$("#dbsource").formValidator({onshow:"';echo L('please_select_dbsource');echo '",onfocus:"';echo L('please_select_dbsource');echo '"}).inputValidator({min:1, onerror:\'';echo L('please_select_dbsource');echo '\'});});</script></td>
  </tr>
  ';else :;echo '  <tr>
		<th valign="top">';echo L('block').L('name');echo '£º</th>
		<td class="y-bg"><input type="text" name="block" size="25" value="';echo $edit_data['data'];echo '" id="block"><script type="text/javascript">$(function(){$("#block").formValidator({onshow:"';echo L('please_input_block_name');echo '",onfocus:"';echo L('please_input_block_name');echo '"}).inputValidator({min:1, onerror:\'';echo L('please_input_block_name');echo '\'});});</script></td>
  </tr>
  ';endif;;echo '</table>
</fieldset>
<div class="bk15"></div>
<fieldset>
	<legend>';echo L('vlan');echo '</legend>
	<table width="100%"  class="table_form">
	<tr>
		<th width="80">';echo L('name');echo '£º</th>
		<td class="y-bg"><input type="text" class="input-text" name="name" id="name" size="30" value="';echo $edit_data['name'];echo '" /></td>
	</tr>
	<tr>
		<th width="80">';echo L('ispage');echo '£º</th>
		<td class="y-bg"><input type="text" name="page" id=\'page\' value="';echo $edit_data['page'];echo '"/> ';echo L('common_variables');echo ':<a href="javascript:void(0);" onclick="javascript:$(\'#page\').val(\'$_GET[page]\');"><font color="red">$_GET[page]</font></a>¡¢<a href="javascript:void(0);" onclick="javascript:$(\'#page\').val(\'$page\');"><font color="red">$page</font></a>£¬';echo L('no_input_no_page');echo '</td>
	</tr>
    <tr>
		<th width="80">';echo L('num');echo '£º</th>
		<td class="y-bg"><input type="text" name="num" id="num" size="30" value="';echo $edit_data['num'];echo '" /></td>
	</tr>
	<tr>
		<th width="80">';echo L('data_return');echo '£º</th>
		<td class="y-bg"><input type="text" name="return" id="return" size="30" value="';echo $edit_data['return'];echo '" /> </td>
	</tr>
	<tr>
		<th width="80">';echo L('cache_times');echo '£º</th>
		<td class="y-bg"><input type="text" name="cache" id="cache" size="30" value="';echo $edit_data['cache'];echo '" /> </td>
	</tr>

</table>
</fieldset>
<div class="bk15"></div>
    <input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="" />
</div>
</div>
</form>
<script type="text/javascript">
<!--
	function showcode(obj) {
	if (obj==3){
		$(\'#template_code\').show();
	} else {
		$(\'#template_code\').hide();
	}
}
//-->
</script>
</body>
</html>';?>