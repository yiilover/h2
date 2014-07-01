<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'})}});
		$("#name").formValidator({onshow:"';echo L('input').L('name');echo '",onfocus:"';echo L('input').L('name');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('name');echo '"}).ajaxValidator({type : "get",url : "",data :"s=dbsource&c=data&a=public_name&id=';echo $id;echo '",datatype : "html",async:\'false\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('name').L('exists');echo '",onwait : "';echo L('connecting');echo '"}).defaultPassed();


		$("#cache").formValidator({onshow:"';echo L("enter_the_cache_input_will_not_be_cached");echo '",onfocus:"';echo L("enter_the_cache_input_will_not_be_cached");echo '",empty:true}).regexValidator({regexp:"num1",datatype:\'enum\',param:\'i\',onerror:"';echo L("cache_time_can_only_be_positive");echo '"});
		$("#num").formValidator({onshow:"';echo L('input').L("num");echo '",onfocus:"';echo L('input').L("num");echo '",empty:true}).regexValidator({regexp:"num1",datatype:\'enum\',param:\'i\',onerror:"';echo L('that_shows_only_positive_numbers');echo '"});
	})
//-->
</script>
<div class="pad-10">
<form action="?s=dbsource/data/edit&id=';echo $id;echo '" method="post" id="myform">
<div>
<fieldset>
	<legend>';echo L('the_configuration_data_source');echo '</legend>
	<table width="100%"  class="table_form">
    <tr>
    <th width="80">';echo L('stdcall');echo '£º</th>
    <td class="y-bg">';echo form::radio(array('0'=>L('model_configuration'),'1'=>L('custom_sql')),$type ?$type : 0,'name="type" onclick="location.href=\''.get_url().'&type=\'+this.value"');echo '</td>
  </tr>
  ';if ($type==0) :;echo '    <tr>
    <th>';echo L('select_model');echo '£º</th>
    <td class="y-bg">';echo form::select($modules,$module,'name="module" id="module" onchange="location.href=\''.get_url().'&module=\'+this.value"');echo '<script type="text/javascript">$(function(){$("#module").formValidator({onshow:"';echo L('please_select_model');echo '",onfocus:"';echo L('please_select_model');echo '"}).inputValidator({min:1, onerror:\'';echo L('please_select_model');echo '\'});});</script></td>
  </tr>
  ';if ($module):;echo '    <tr>
    <th>';echo L('selectingoperation');echo '£º</th>
    <td class="y-bg">';echo form::radio($html['action'],$action,'name="action" onclick="location.href=\''.get_url().'&action=\'+this.value"');echo '</td>
  </tr>
  ';endif;;echo '  ';if(isset($html[$action]) &&is_array($html[$action]) &&$action)foreach($html[$action] as $k=>$v):;echo '      <tr>
    <th>';echo $v['name'];echo '£º</th>
    <td class="y-bg">';echo creat_form($k,$v,$form_data[$k]);echo '</td>
  </tr>
  ';endforeach;;echo '  ';else :;echo '    <tr>
    <th valign="top">';echo L('custom_sql');echo '£º</th>
    <td class="y-bg"><textarea name="data" id="data" style="width:386px;height:178px;">';if($edit_data['type']==1)echo $edit_data['data'];echo '</textarea><script type="text/javascript">$(function(){$("#data").formValidator({onshow:"';echo L('please_enter_a_sql');echo '",onfocus:"';echo L('please_enter_a_sql');echo '"}).inputValidator({min:1, onerror:\'';echo L('please_enter_a_sql');echo '\'});});</script></td>
  </tr>
  ';endif;;echo '</table>
</fieldset>
<div class="bk15"></div>
<fieldset>
	<legend>';echo L('vlan');echo '</legend>
	<table width="100%"  class="table_form">
	<tr>
    <th width="80">';echo L('name');echo '£º</th>
    <td class="y-bg"><input type="text" class="input-text" name="name" id="name" size="30" value="';echo htmlspecialchars($edit_data['name']);echo '" /></td>
  </tr>
  <tr>
    <th>';echo L('output_mode');echo '£º</th>
    <td class="y-bg">';echo form::radio(array('1'=>'json','2'=>'xml','3'=>'js'),$edit_data['dis_type'],'name="dis_type" onclick="showcode(this.value)"');echo '</td>
  </tr>
  <tbody id="template_code" ';if($edit_data['dis_type'] != 3) echo 'style="display:none"';echo '>
    <tr>
    <th valign="top">';echo L('template');echo '£º</th>
    <td class="y-bg"><textarea name="template" id="template" style="width:386px;height:178px;">';if(!empty($edit_data['template'])) {echo $edit_data['template'];}else {echo '{loop $data $k $v}
    <!-- '.L('valgrind').' -->
{/loop}';};echo '</textarea></td>
  </tr>
  </tbody>
  <tr>
    <th width="80">';echo L('buffer_time');echo '£º</th>
    <td class="y-bg"><input type="text" class="input-text" name="cache" id="cache" size="30" value="';echo $edit_data['cache'];echo '"  /></td>
  </tr>
  <tr>
    <th width="80">';echo L('num');echo '£º</th>
    <td class="y-bg"><input type="text" class="input-text" name="num" id="num" size="30" value="';echo $edit_data['num'];echo '"  /></td>
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