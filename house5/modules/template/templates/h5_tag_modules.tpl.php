<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#cache").formValidator({onshow:"';echo L("enter_the_cache_input_will_not_be_cached");echo '",onfocus:"';echo L("enter_the_cache_input_will_not_be_cached");echo '",empty:true}).regexValidator({regexp:"num1",datatype:\'enum\',param:\'i\',onerror:"';echo L("cache_time_can_only_be_positive");echo '"});
		$("#num").formValidator({onshow:"';echo L('input').L("num");echo '",onfocus:"';echo L('input').L("num");echo '",empty:true}).regexValidator({regexp:"num1",datatype:\'enum\',param:\'i\',onerror:"';echo L('that_shows_only_positive_numbers');echo '"});
		$("#return").formValidator({onshow:"';echo L("please_enter_the_data_returned_value_by_default");echo '£ºdata¡£",onfocus:"';echo L("please_enter_the_data_returned_value_by_default");echo '£ºdata¡£",empty:true});
		show_action(\'';echo $_GET['action'];echo '\');
	})
	
	function show_action(obj) {
		$(\'.h5_action_list\').hide();
		$(\'#action_\'+obj).show();
	}
//-->
</script>
<div class="pad-10">
<form action="?s=template/file/edit_h5_tag&style=';echo $this->style;echo '&dir=';echo $dir;echo '&file=';echo urlencode($file);echo '&op=';echo $op;echo '&tag_md5=';echo $_GET['tag_md5'];echo '" method="post" id="myform">
<fieldset>
	<legend>';echo L("module_configuration");echo '</legend>
<table width="100%"  class="table_form">
	  <tr>
    <th width="80">';echo L("module");echo '£º</th>
    <td class="y-bg">';echo $op;echo '</td>
  </tr>
    <tr>
    <th width="80">';echo L('operation');echo '£º</th>
    <td class="y-bg"> ';if(isset($html['action']) &&is_array($html['action'])) {
foreach($html['action'] as $key=>$value) {
$checked = $_GET['action']==$key ?'checked': '';
echo '<label><input type="radio" name="action" onclick="location.href=\'?'.creat_url($key).'\'" '.$checked.' value="'.$key.'"> '.$value."</label>";
}
};echo '</td>
  </tr>
  
  ';
if(isset($html[$_GET['action']]) &&is_array($html[$_GET['action']])):
foreach($html[$_GET['action']] as $k=>$v): ;echo '  	  <tr>
    <th width="80">';echo $v['name'];echo '£º</th>
    <td class="y-bg">';echo creat_form($k,$v,$_GET[$k],$op);echo '</td>
  </tr>
  ';if(isset($v['ajax']['name'])  &&!empty($v['ajax']['name'])) {;echo '  	  <tr>
  	  	<th width="80">';echo $v['ajax']['name'];echo '£º';if(isset($_GET[$v['ajax']['id']]) &&!empty($_GET[$v['ajax']['id']])) echo '<script type="text/javascript">$.get(\'?s=template/file/public_ajax_get\', { html: \''.$_GET[$k].'\', id:\''.$v['ajax']['id'].'\', value:\''.$_GET[$v['ajax']['id']].'\', action: \''.$v['ajax']['action'].'\', op: \''.$op.'\', style: \'default\'}, function(data) {$(\'#'.$k.'_td\').html(data)});</script>';echo '</th>
  	  	<td class="y-bg"><input type="text" size="20" value="';echo $_GET[$v['ajax']['id']];echo '" id="';echo $v['ajax']['id'];echo '" name="';echo $v['ajax']['id'];echo '" class="input-text"><span id="';echo $k;echo '_td"></span></td>
  	 </tr>
  ';};echo '  ';endforeach;endif;;echo '  
</table>
</fieldset>
<div class="bk15"></div>
<fieldset>
	<legend>';echo L('vlan');echo '</legend>
		<table width="100%"  class="table_form">
	  <tr>
    <th width="80">';echo L("public_allowpageing");echo '£º</th>
    <td class="y-bg"><input type="radio" name="page" value="$page"';if (isset($_GET['page'])) {echo ' checked';};echo ' /> ';echo L("yes");echo '  <input type="radio" name="page" value=""';if (!isset($_GET['page'])) {echo ' checked';};echo ' /> ';echo L("no");echo '</td>
  </tr>
    <tr>
    <th width="80">';echo L("num");echo '£º</th>
    <td class="y-bg"><input type="text" name="num" id="num" size="30" value="';echo $_GET['num'];echo '" /></td>
  </tr>
   <tr>
    <th width="80">';echo L("check");echo '£º</th>
    <td class="y-bg"><input type="text" name="return" id="return" size="30" value="';echo $_GET['return'];echo '" /> </td>
  </tr>
   <tr>
    <th width="80">';echo L("buffer_time");echo '£º</th>
    <td class="y-bg"><input type="text" name="cache" id="cache" size="30" value="';echo $_GET['cache'];echo '" /> </td>
  </tr>
</table>
</fieldset>

<input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="';echo L('submit');echo '" />
</div>
</form>
</body>
</html>';?>