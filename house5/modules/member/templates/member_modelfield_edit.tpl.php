<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform"});
	$("#field").formValidator({onshow:"';echo L('input').L('fieldname');echo '",onfocus:"';echo L('fieldname').L('between_1_to_20');echo '"}).regexValidator({regexp:"^[a-zA-Z]{1}([a-zA-Z0-9]|[_]){0,19}$",onerror:"';echo L('filedname_incorrect');echo '"}).inputValidator({min:1,max:20,onerror:"';echo L('fieldname').L('between_1_to_20');echo '"}).ajaxValidator({
	    type : "get",
		url : "",
		data : "s=member/member_modelfield/public_checkfield&modelid=';echo $modelid;echo '&oldfield=';echo $field;;echo '",
		datatype : "html",
		cached:false,
		async:\'true\',
		success : function(data){
            if( data == "1" )
			{
                return true;
			}
            else
			{
                return false;
			}
		},
		buttons: $("#dosubmit"),
		onerror : "';echo L('fieldname').L('already_exist');echo '",
		onwait : "';echo L('connecting_please_wait');echo '"
	}).defaultPassed();
	$("#formtype").formValidator({onshow:"';echo L('filedtype_need');echo '",onfocus:"';echo L('filedtype_need');echo '",oncorrect:"';echo L('input_correct');echo '",defaultvalue:""}).inputValidator({min:1,onerror: "';echo L('filedtype_need');echo '"});
	$("#name").formValidator({onshow:"';echo L('filed_nickname_need');echo '",onfocus:"';echo L('filed_nickname_need');echo '",oncorrect:"';echo L('input_correct');echo '"}).inputValidator({min:1,onerror:"';echo L('filed_nickname_need');echo '"});
})

//-->
</script>
<div class="pad-10">
<div class="common-form">
<form name="myform" id="myform" action="?s=member/member_modelfield/edit" method="post">
<input name="info[modelid]" type="hidden" value="';echo $modelid;echo '">
<input name="fieldid" type="hidden" value="';echo $fieldid;echo '">
<input name="oldfield" type="hidden" value="';echo $field;echo '">
<fieldset>
	<legend>';echo L('basic_configuration');echo '</legend>
	<table width="100%" class="table_form contentWrap">
		<tr> 
		  <th><strong>';echo L('filedtype');echo '</strong><br /></th>
		  <td>
	<input type="hidden" name="info[formtype]" value="';echo $formtype;;echo '">
	';echo form::select($fields,$formtype,'name="info[formtype]" id="formtype" onchange="javascript:field_setting(this.value);" disabled',L('filedtype_need'));;echo '		  </td>
		</tr>
		<tr> 
		  <th><strong>';echo L('main_table_filed');echo '</strong></th>
		  <td>
		  <input type="hidden" name="issystem" id="issystem" value="';echo $issystem ?1 : 0;;echo '">
		  <input type="radio" name="info[issystem]" id="field_basic_table1" value="1" ';if($issystem) echo 'checked';;echo ' disabled> ';echo L('yes');echo ' <input type="radio" id="field_basic_table0" name="info[issystem]" value="0" ';if(!$issystem) echo 'checked';;echo ' disabled> ';echo L('no');echo '</td>
		</tr>
		<tr> 
		  <th width="25%"><font color="red">*</font> <strong>';echo L('filedname');echo '</strong><br />
		  ';echo L('username_rule');echo '		  </th>
		  <td><input type="text" name="info[field]" id="field" size="20" class="input-text" value="';echo $field;echo '"></td>
		</tr>
		<tr> 
		  <th><font color="red">*</font> <strong>';echo L('filed_nickname');echo '</strong><br />';echo L('exaple_title');echo '</th>
		  <td><input type="text" name="info[name]" id="name" size="30" class="input-text" value="';echo $name;echo '"></td>
		</tr>
		<tr> 
		  <th><strong>';echo L('field_cue');echo '</strong><br />';echo L('nickname_alert');echo '</th>
		  <td><textarea name="info[tips]" rows="2" cols="20" id="tips" style="height:40px; width:80%">';echo htmlspecialchars($tips);echo '</textarea></td>
		</tr>

		<tr> 
		  <th><strong>';echo L('correlation_param');echo '</strong><br />';echo L('correlation_attribute');echo '</th>
		  <td>';echo $form_data;;echo '</td>
		</tr>
		<tr> 
		  <th><strong>';echo L('extra_attribute');echo '</strong><br />';echo L('add_javascript');echo '</th>
		  <td><input type="text" name="info[formattribute]" size="50" class="input-text" value="';echo htmlspecialchars($formattribute);;echo '"></td>
		</tr>
		<tr> 
		  <th><strong>';echo L('form_css');echo '</strong><br />';echo L('user_form_css');echo '</th>
		  <td><input type="text" name="info[css]" size="10" class="input-text" value="';echo htmlspecialchars($css);;echo '"></td>
		</tr>
		<tr> 
		  <th><strong>';echo L('string_len_range');echo '</strong><br />';echo L('post_alert');echo '</th>
		  <td>';echo L('min');echo '<input type="text" name="info[minlength]" id="field_minlength" value="';echo $minlength;;echo '" size="5" class="input-text"> ';echo L('max');echo '<input type="text" name="info[maxlength]" id="field_maxlength" value="';echo $maxlength;;echo '" size="5" class="input-text"></td>
		</tr>
		<tr> 
		  <th><strong>';echo L('date_regular');echo '</strong><br />';echo L('validity_alert');echo '</th>
		  <td><input type="text" name="info[pattern]" id="pattern" value="';echo $pattern;;echo '" size="40" class="input-text"> 
	<select name="pattern_select" onchange="javascript:$(\'#pattern\').val(this.value)">
			<option value="">';echo L('common_regular');echo '</option>
			<option value="/^[0-9.-]+$/">';echo L('number');echo '</option>
			<option value="/^[0-9-]+$/">';echo L('int');echo '</option>
			<option value="/^[a-z]+$/i">';echo L('alphabet');echo '</option>
			<option value="/^[0-9a-z]+$/i">';echo L('alphabet');echo '+';echo L('number');echo '</option>
			<option value="/^[\\w\\-\\.]+@[\\w\\-\\.]+(\\.\\w+)+$/">E-mail</option>
			<option value="/^[0-9]{5,20}$/">QQ</option>
			<option value="/^http:\\/\\//">';echo L('http');echo '</option>
			<option value="/^(1)[0-9]{10}$/">';echo L('mp');echo '</option>
			<option value="/^[0-9-]{6,13}$/">';echo L('tel');echo '</option>
			<option value="/^[0-9]{6}$/">';echo L('postcode');echo '</option>
	</select>
		  </td>
		</tr>
		<tr> 
		  <th><strong>';echo L('error_alert');echo '</strong><br />';echo L('form_error_alert');echo '</th>
		  <td><input type="text" name="info[errortips]" value="';echo $errortips;;echo '" size="50" class="input-text"></td>
		</tr>
		<tr> 
		  <th><strong>';echo L('unique');echo '</strong></th>
		  <td><input type="radio" name="info[isunique]" value="1" id="field_allow_isunique1" ';if($isunique) echo 'checked';;echo '>';echo L('yes');echo '<input type="radio" name="info[isunique]" value="0" id="field_allow_isunique0" ';if(!$isunique) echo 'checked';;echo '>';echo L('no');echo '</td>
		</tr>
		<tr> 
		  <th><strong>';echo L('can_empty');echo '</strong></th>
		  <td><input type="radio" name="info[isbase]" value="1"  ';if($isbase) echo 'checked';;echo '>';echo L('yes');echo '<input type="radio" name="info[isbase]" value="0" ';if(!$isbase) echo 'checked';;echo '>';echo L('no');echo ' </td>
		</tr>
		<tr> 
		  <th><strong>';echo L('search_condition');echo '</strong></th>
		  <td><input type="radio" name="info[issearch]" value="1" id="field_allow_search1" ';if($issearch) echo 'checked';;echo '>';echo L('yes');echo '<input type="radio" name="info[issearch]" value="0" id="field_allow_search0" ';if(!$issearch) echo 'checked';;echo '>';echo L('no');echo '</td>
		</tr>
		<tr> 
		  <th><strong>';echo L('isadd_condition');echo '</strong></th>
		  <td><input type="radio" name="info[isadd]" value="1" ';if($isadd) echo 'checked';;echo '>';echo L('yes');echo '<input type="radio" name="info[isadd]" value="0" ';if(!$isadd) echo 'checked';;echo '>';echo L('no');echo '</td>
		</tr>
		<tr> 
		  <th><strong>';echo L('isomnipotent_condition');echo '</strong></th>
		  <td><input type="radio" name="info[isomnipotent]" value="1" ';if($isomnipotent) echo 'checked';;echo '>';echo L('yes');echo '<input type="radio" name="info[isomnipotent]" value="0" ';if(!$isomnipotent) echo 'checked';;echo '>';echo L('no');echo '</td>
		</tr>
		<tr> 
		  <th><strong>';echo L('deny_set_field_group');echo '</strong></th>
		  <td>';echo form::checkbox($grouplist,$unsetgroupids,'name="unsetgroupids[]" id="unsetgroupids"',0,'100');;echo '</td>
		</tr>
		<tr> 
		  <th><strong>';echo L('deny_set_field_role');echo '</strong></th>
		  <td>';echo form::checkbox($roles,$unsetroleids,'name="unsetroleids[]" id="unsetroleids"',0,'100');;echo ' </td>
		</tr>
	</table>
</fieldset>
    <div class="bk15"></div>
    <input name="dosubmit" type="submit" id="dosubmit" value="';echo L('submit');echo '" class="dialog">
</form>
</div>
</div>
</body>
</html>';?>