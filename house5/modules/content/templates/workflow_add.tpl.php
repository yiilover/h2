<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#workname").formValidator({onshow:"';echo L("input").L('workflow_name');echo '",onfocus:"';echo L("input").L('workflow_name');echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('workflow_name');echo '"});
	})
//-->
</script>
<div class="pad-lr-10">
<form action="?s=content/workflow/add" method="post" id="myform">
	<table width="100%"  class="table_form">
  <tr>
    <th width="200">';echo L('workflow_name');echo '£º</th>
    <td class="y-bg"><input type="text" class="input-text" name="info[workname]" id="workname" size="30" /></td>
  </tr>
    <tr>
    <th>';echo L('description');echo '£º</th>
    <td class="y-bg"><textarea name="info[description]" maxlength="255" style="width:300px;height:60px;"></textarea></td>
  </tr>
	<tr>
    <th>';echo L('steps');echo '£º</th>
    <td class="y-bg">
	<select name="info[steps]" onchange="select_steps(this.value)">
	<option value=\'1\' selected>';echo L('steps_1');;echo '</option>
	<option value=\'2\'>';echo L('steps_2');;echo '</option>
	<option value=\'3\'>';echo L('steps_3');;echo '</option>
	<option value=\'4\'>';echo L('steps_4');;echo '</option>
	</select></td>
  </tr>
   <tr id="step1">
    <th>';echo L('steps_1');;echo ' ';echo L('admin_users');echo '£º</th>
    <td class="y-bg">
	';echo form::checkbox($admin_data,'','name="checkadmin1[]"','',120);;echo '	</td>
  </tr>
   <tr id="step2" style="display:none">
    <th>';echo L('steps_2');;echo ' ';echo L('admin_users');echo '£º</th>
    <td class="y-bg">
		';echo form::checkbox($admin_data,'','name="checkadmin2[]"','',120);;echo '	</td>
  </tr>
   <tr id="step3" style="display:none">
    <th>';echo L('steps_3');;echo ' ';echo L('admin_users');echo '£º</th>
    <td class="y-bg">
		';echo form::checkbox($admin_data,'','name="checkadmin3[]"','',120);;echo '	</td>
  </tr>
   <tr id="step4" style="display:none">
    <th>';echo L('steps_4');;echo '';echo L('admin_users');echo '£º</th>
    <td class="y-bg">
		';echo form::checkbox($admin_data,'','name="checkadmin4[]"','',120);;echo '	</td>
  </tr>
  <tr>
    <th><B>';echo L('nocheck_users');echo '</B>£º</th>
    <td class="y-bg">
		';echo form::checkbox($admin_data,'','name="nocheck_users[]"','',120);;echo '	</td>
  </tr>
  <tr>
    <th>';echo L('checkstatus_flag');echo '£º</th>
    <td class="y-bg">
		<input type="radio" name="info[flag]" value="1" > ÊÇ 
		<input type="radio" name="info[flag]" value="0" checked> ·ñ
	</td>
  </tr>
</table>

<div class="bk15"></div>
<div class="btn"><input type="submit" id="dosubmit" class="button" name="dosubmit" value="';echo L('submit');echo '"/></div>
</form>
</div>
</body>
</html>
<SCRIPT LANGUAGE="JavaScript">
<!--
function select_steps(stepsid) {
	for(i=4;i>1;i--) {
		if(stepsid>=i) {
			$(\'#step\'+i).css(\'display\',\'\');
		} else {
			$(\'#step\'+i).css(\'display\',\'none\');
		}
	}
}
//-->
</SCRIPT>';?>