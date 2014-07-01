<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform"});
	$("#field").formValidator({onshow:"';echo L('input').L('fieldname');echo '",onfocus:"';echo L('fieldname').L('between_1_to_20');echo '"}).regexValidator({regexp:"^[a-zA-Z]{1}([a-zA-Z0-9]|[_]){0,19}$",onerror:"';echo L('filedname_incorrect');echo '"}).inputValidator({min:1,max:20,onerror:"';echo L('fieldname').L('between_1_to_20');echo '"}).ajaxValidator({
	    type : "get",
		url : "",
		data : "s=member/member_modelfield/public_checkfield&modelid=';echo $modelid;echo '",
		datatype : "html",
		cached:false,
		getdata:{issystem:\'issystem\'},
		async:\'false\',
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
	});
	$("#formtype").formValidator({onshow:"';echo L('filedtype_need');echo '",onfocus:"';echo L('filedtype_need');echo '",oncorrect:"';echo L('input_correct');echo '",defaultvalue:""}).inputValidator({min:1,onerror: "';echo L('filedtype_need');echo '!"});
	$("#name").formValidator({onshow:"';echo L('filed_nickname_need');echo '",onfocus:"';echo L('filed_nickname_need');echo '",oncorrect:"';echo L('input_correct');echo '"}).inputValidator({min:1,onerror:"';echo L('filed_nickname_need');echo '"});
})

//-->
</script>
<div class="pad_10">
<form name="myform" id="myform" action="?s=member/member_modelfield/add" method="post">
<div class="common-form">
<fieldset>
	<legend>';echo L('basic_configuration');echo '</legend>
	<table width="100%" class="table_form contentWrap">
		<tr> 
		  <th><strong>';echo L('filedtype');echo '</strong><br /></th>
		  <td>
			';echo form::select($fields,'','name="info[formtype]" id="formtype" onchange="javascript:field_setting(this.value);"',L('filedtype_need'));;echo '		  </td>
		</tr>
		<tr> 
		  <th width="25%"><font color="red">*</font> <strong>';echo L('filedname');echo '</strong><br />
		  ';echo L('username_rule');echo '		  </th>
		  <td><input type="text" name="info[field]" id="field" size="20" class="input-text"></td>
		</tr>
		<tr> 
		  <th><font color="red">*</font> <strong>';echo L('filed_nickname');echo '</strong><br />';echo L('exaple_title');echo '</th>
		  <td><input type="text" name="info[name]" id="name" size="30" class="input-text"></td>
		</tr>
		<tr> 
		  <th><strong>';echo L('field_cue');echo '</strong><br />';echo L('nickname_alert');echo '</th>
		  <td><textarea name="info[tips]" rows="2" cols="20" id="tips" style="height:40px; width:80%"></textarea></td>
		</tr>

		<tr> 
		  <th><strong>';echo L('correlation_param');echo '</strong><br />';echo L('correlation_attribute');echo '</th>
		  <td><div id="setting"></div></td>
		</tr>
		<tr> 
		  <th><strong>';echo L('extra_attribute');echo '</strong><br />';echo L('add_javascript');echo '</th>
		  <td><input type="text" name="info[formattribute]" value="" size="50" class="input-text"></td>
		</tr>
		<tr> 
		  <th><strong>';echo L('form_css');echo '</strong><br />';echo L('user_form_css');echo '</th>
		  <td><input type="text" name="info[css]" value="" size="10" class="input-text"></td>
		</tr>
		<tr> 
		  <th><strong>';echo L('string_len_range');echo '</strong><br />';echo L('post_alert');echo '</th>
		  <td>';echo L('min');echo '<input type="text" name="info[minlength]" id="field_minlength" value="0" size="5" class="input-text"> ';echo L('max');echo '<input type="text" name="info[maxlength]" id="field_maxlength" value="" size="5" class="input-text"></td>
		</tr>
		<tr> 
		  <th><strong>';echo L('date_regular');echo '</strong><br />';echo L('validity_alert');echo '</th>
		  <td><input type="text" name="info[pattern]" id="pattern" value="" size="40" class="input-text"> 
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
		  <td><input type="text" name="info[errortips]" value="" size="50" class="input-text"></td>
		</tr>
		<tr> 
		  <th><strong>';echo L('unique');echo '</strong></th>
		  <td><input type="radio" name="info[isunique]" value="1" id="field_allow_isunique1"> ';echo L('yes');echo ' <input type="radio" name="info[isunique]" value="0" id="field_allow_isunique0" checked> ';echo L('no');echo '</td>
		</tr>
		<tr> 
		  <th><strong>';echo L('can_empty');echo '</strong></th>
		  <td><input type="radio" name="info[isbase]" value="1"  checked> ';echo L('yes');echo ' <input type="radio" name="info[isbase]" value="0"> ';echo L('no');echo ' </td>
		</tr>
		<tr> 
		  <th><strong>';echo L('search_condition');echo '</strong></th>
		  <td><input type="radio" name="info[issearch]" value="1" id="field_allow_search1"> ';echo L('yes');echo ' <input type="radio" name="info[issearch]" value="0" id="field_allow_search0" checked> ';echo L('no');echo '</td>
		</tr>
		<tr> 
		  <th><strong>';echo L('isadd_condition');echo '</strong></th>
		  <td><input type="radio" name="info[isadd]" value="1" checked>';echo L('yes');echo '<input type="radio" name="info[isadd]" value="0" >';echo L('no');echo '</td>
		</tr>
		<tr> 
		  <th><strong>';echo L('isomnipotent_condition');echo '</strong></th>
		  <td><input type="radio" name="info[isomnipotent]" value="1">';echo L('yes');echo '<input type="radio" name="info[isomnipotent]" value="0" checked>';echo L('no');echo '</td>
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
    <input name="info[modelid]" type="hidden" value="';echo $modelid;echo '">
    <input name="dosubmit" id="dosubmit" type="submit" value="';echo L('submit');echo '" class="dialog">
	</form>
<div id="h5__contentHeight" style="display:none">90</div>
<script type="text/javascript">
<!--
	function field_setting(fieldtype) {
		$.getJSON("?s=member/member_modelfield/public_field_setting&fieldtype="+fieldtype, function(data){
			if(data.field_basic_table==\'1\') {
				$(\'#field_basic_table0\').attr("disabled",false);
				$(\'#field_basic_table1\').attr("disabled",false);
			} else {
				$(\'#field_basic_table0\').attr("checked",true);
				$(\'#field_basic_table0\').attr("disabled",true);
				$(\'#field_basic_table1\').attr("disabled",true);
			}
			if(data.field_allow_search==\'1\') {
				$(\'#field_allow_search0\').attr("disabled",false);
				$(\'#field_allow_search1\').attr("disabled",false);
			} else {
				$(\'#field_allow_search0\').attr("checked",true);
				$(\'#field_allow_search0\').attr("disabled",true);
				$(\'#field_allow_search1\').attr("disabled",true);
			}
			if(data.field_allow_fulltext==\'1\') {
				$(\'#field_allow_fulltext0\').attr("disabled",false);
				$(\'#field_allow_fulltext1\').attr("disabled",false);
			} else {
				$(\'#field_allow_fulltext0\').attr("checked",true);
				$(\'#field_allow_fulltext0\').attr("disabled",true);
				$(\'#field_allow_fulltext1\').attr("disabled",true);
			}
			if(data.field_allow_isunique==\'1\') {
				$(\'#field_allow_isunique0\').attr("disabled",false);
				$(\'#field_allow_isunique1\').attr("disabled",false);
			} else {
				$(\'#field_allow_isunique0\').attr("checked",true);
				$(\'#field_allow_isunique0\').attr("disabled",true);
				$(\'#field_allow_isunique1\').attr("disabled",true);
			}
			$(\'#field_minlength\').val(data.field_minlength);
			$(\'#field_maxlength\').val(data.field_maxlength);
			$(\'#setting\').html(data.setting);
	
		});
	}

//-->
</script>
</body>
</html>';?>