<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform"});
	$("#field").formValidator({onshow:"';echo L('input').L('fieldname');echo '",onfocus:"';echo L('fieldname').L('between_1_to_20');echo '"}).regexValidator({regexp:"^[a-zA-Z]{1}([a-zA-Z0-9]|[_]){0,19}$",onerror:"';echo L('fieldname_was_wrong');;echo '"}).inputValidator({min:1,max:20,onerror:"';echo L('fieldname').L('between_1_to_20');echo '"}).ajaxValidator({
	    type : "get",
		url : "",
		data : "s=content/sitemodel_field/public_checkfield/modelid/';echo $modelid;echo '/oldfield/';echo $field;;echo '",
		datatype : "html",
		cached:false,
		getdata:{issystem:\'issystem\'},
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
	$("#formtype").formValidator({onshow:"';echo L('select_fieldtype');;echo '",onfocus:"';echo L('select_fieldtype');;echo '",oncorrect:"';echo L('input_right');;echo '",defaultvalue:""}).inputValidator({min:1,onerror: "';echo L('select_fieldtype');;echo '"});
	$("#name").formValidator({onshow:"';echo L('input_nickname');;echo '",onfocus:"';echo L('nickname_empty');;echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L('input_nickname');;echo '"});
})

//-->
</script>
<div class="pad_10">
<div class="subnav">
  <h2 class="title-1 line-x f14 fb blue lh28">';echo L('model_manage');;echo '--';echo $m_r['name'].L('field_manage');;echo '</h2>
<div class="content-menu ib-a blue line-x">
<a href="javascript:;" class="on"><em>';echo L('edit_field');;echo '</em></a><span>|</span><a href="?s=content/sitemodel_field/init/modelid/';echo $modelid;echo '/menuid/';echo $_GET['menuid'];echo '"><em>';echo L('manage_field');;echo '</em></a><span>|</span></div>
  <div class="bk10"></div>
</div>
<form name="myform" id="myform" action="?s=content/sitemodel_field/edit" method="post">
<div class="common-form">
<table width="100%" class="table_form">
	<tr> 
      <th><strong>';echo L('field_type');;echo '</strong><br /></th>
      <td>
<input type="hidden" name="info[formtype]" value="';echo $formtype;;echo '">
';echo form::select($fields,$formtype,'name="info[formtype]" id="formtype" onchange="javascript:field_setting(this.value);" disabled',L('select_fieldtype'));;echo '	  </td>
    </tr>
	<tr> 
      <th><strong>';echo L('issystem_field');;echo '</strong></th>
      <td>
      <input type="hidden" name="issystem" id="issystem" value="';echo $issystem ?1 : 0;;echo '">
      <input type="radio" name="info[issystem]" id="field_basic_table1" value="1" ';if($issystem) echo 'checked';;echo ' disabled> ';echo L('yes');;echo ' <input type="radio" id="field_basic_table0" name="info[issystem]" value="0" ';if(!$issystem) echo 'checked';;echo ' disabled> ';echo L('no');;echo '</td>
    </tr>
	<tr> 
      <th width="25%"><font color="red">*</font> <strong>';echo L('fieldname');;echo '</strong><br />
	  ';echo L('fieldname_tips');;echo '	  </th>
      <td><input type="text" name="info[field]" id="field" size="20" class="input-text" value="';echo $field;echo '" ';if(in_array($field,$forbid_delete)) echo 'readonly';;echo '></td>
    </tr>
	<tr> 
      <th><font color="red">*</font> <strong>';echo L('field_nickname');;echo '</strong><br />';echo L('nickname_tips');;echo '</th>
      <td><input type="text" name="info[name]" id="name" size="30" class="input-text" value="';echo $name;echo '"></td>
    </tr>
	<tr> 
      <th><strong>';echo L('field_tip');;echo '</strong><br />';echo L('field_tips');;echo '</th>
      <td><textarea name="info[tips]" rows="2" cols="20" id="tips" style="height:40px; width:80%">';echo htmlspecialchars($tips);;echo '</textarea></td>
    </tr>

	<tr> 
      <th><strong>';echo L('relation_parm');;echo '</strong><br />';echo L('relation_parm_tips');;echo '</th>
      <td>';echo $form_data;;echo '</td>
    </tr>
	';if(in_array($formtype,$att_css_js)) {;echo '	<tr> 
      <th><strong>';echo L('form_attr');;echo '</strong><br />';echo L('form_attr_tips');;echo '</th>
      <td><input type="text" name="info[formattribute]" size="50" class="input-text" value="';echo htmlspecialchars($formattribute);;echo '"></td>
    </tr>
	<tr> 
      <th><strong>';echo L('form_css_name');;echo '</strong><br />';echo L('form_css_name_tips');;echo '</th>
      <td><input type="text" name="info[css]" size="10" class="input-text" value="';echo htmlspecialchars($css);;echo '"></td>
    </tr>
	';};echo '	<tr> 
      <th><strong>';echo L('string_size');;echo '</strong><br />';echo L('string_size_tips');;echo '</th>
      <td>';echo L('minlength');;echo '��<input type="text" name="info[minlength]" id="field_minlength" value="';echo $minlength;;echo '" size="5" class="input-text">';echo L('maxlength');;echo '��<input type="text" name="info[maxlength]" id="field_maxlength" value="';echo $maxlength;;echo '" size="5" class="input-text"></td>
    </tr>
	<tr> 
      <th><strong>';echo L('data_preg');;echo '</strong><br />';echo L('data_preg_tips');;echo '</th>
      <td><input type="text" name="info[pattern]" id="pattern" value="';echo $pattern;;echo '" size="40" class="input-text"> 
<select name="pattern_select" onchange="javascript:$(\'#pattern\').val(this.value)">
<option value="">';echo L('often_preg');;echo '</option>
<option value="/^[0-9.-]+$/">';echo L('figure');;echo '</option>
<option value="/^[0-9-]+$/">';echo L('integer');;echo '</option>
<option value="/^[a-z]+$/i">';echo L('letter');;echo '</option>
<option value="/^[0-9a-z]+$/i">';echo L('integer_letter');;echo '</option>
<option value="/^[\\w\\-\\.]+@[\\w\\-\\.]+(\\.\\w+)+$/">E-mail</option>
<option value="/^[0-9]{5,20}$/">QQ</option>
<option value="/^http:\\/\\//">';echo L('hyperlink');;echo '</option>
<option value="/^(1)[0-9]{10}$/">';echo L('mobile_number');;echo '</option>
<option value="/^[0-9-]{6,13}$/">';echo L('tel_number');;echo '</option>
<option value="/^[0-9]{6}$/">';echo L('zip');;echo '</option>
</select>
	  </td>
    </tr>
	<tr> 
      <th><strong>';echo L('data_passed_msg');;echo '</strong></th>
      <td><input type="text" name="info[errortips]" value="';echo htmlspecialchars($errortips);;echo '" size="50" class="input-text"></td>
    </tr>
	<tr> 
      <th><strong>';echo L('unique');;echo '</strong></th>
      <td><input type="radio" name="info[isunique]" value="1" id="field_allow_isunique1" ';if($isunique) echo 'checked';;echo ' ';if(!$field_allow_isunique) echo 'disabled';;echo '> ';echo L('yes');;echo ' <input type="radio" name="info[isunique]" value="0" id="field_allow_isunique0" ';if(!$isunique) echo 'checked';;echo ' ';if(!$field_allow_isunique) echo 'disabled';;echo '> ';echo L('no');;echo '</td>
    </tr>
	<tr> 
      <th><strong>';echo L('basic_field');;echo '</strong><br />';echo L('basic_field_tips');;echo '</th>
      <td><input type="radio" name="info[isbase]" value="1"  ';if($isbase) echo 'checked';;echo '> ';echo L('yes');;echo ' <input type="radio" name="info[isbase]" value="0" ';if(!$isbase) echo 'checked';;echo '> ';echo L('no');;echo ' </td>
    </tr>
	<tr> 
      <th><strong>';echo L('as_search_field');;echo '</strong></th>
      <td><input type="radio" name="info[issearch]" value="1" id="field_allow_search1" ';if($issearch) echo 'checked';;echo ' ';if(!$field_allow_search) echo 'disabled';;echo '> ';echo L('yes');;echo ' <input type="radio" name="info[issearch]" value="0" id="field_allow_search0" ';if(!$issearch) echo 'checked';;echo ' ';if(!$field_allow_search) echo 'disabled';;echo '> ';echo L('no');;echo '</td>
    </tr>
	<tr> 
      <th><strong>';echo L('allow_contributor');;echo '</strong></th>
      <td><input type="radio" name="info[isadd]" value="1"  ';if($isadd) echo 'checked';;echo '/> ';echo L('yes');;echo ' <input type="radio" name="info[isadd]" value="0" ';if(!$isadd) echo 'checked';;echo '/> ';echo L('no');;echo '</td>
    </tr>
	<tr> 
      <th><strong>';echo L('as_fulltext_field');;echo '</strong></th>
      <td><input type="radio" name="info[isfulltext]" value="1" id="field_allow_fulltext1" ';if($isfulltext) echo 'checked';;echo ' ';if(!$field_allow_fulltext) echo 'disabled';;echo '/> ';echo L('yes');;echo ' <input type="radio" name="info[isfulltext]" value="0" id="field_allow_fulltext0" ';if(!$isfulltext) echo 'checked';;echo ' ';if(!$field_allow_fulltext) echo 'disabled';;echo '/> ';echo L('no');;echo '</td>
    </tr>
	<tr> 
      <th><strong>';echo L('as_omnipotent_field');;echo '</strong><br>';echo L('as_omnipotent_field_tips');;echo '</th>
      <td><input type="radio" name="info[isomnipotent]" value="1" ';if($isomnipotent) echo 'checked';;echo ' ';
if(in_array($field,$forbid_fields)) echo 'disabled';;echo '/> ';echo L('yes');;echo ' <input type="radio" name="info[isomnipotent]" value="0" ';if(!$isomnipotent) echo 'checked';;echo ' /> ';echo L('no');;echo '</td>
    </tr>
	<tr> 
      <th><strong>';echo L('as_postion_info');;echo '</strong></th>
      <td><input type="radio" name="info[isposition]" value="1" ';if($isposition) echo 'checked';;echo ' /> ';echo L('yes');;echo ' <input type="radio" name="info[isposition]" value="0" ';if(!$isposition) echo 'checked';;echo '/> ';echo L('no');;echo '</td>
    </tr>
	
	<tr> 
      <th><strong>';echo L('disabled_groups_field');;echo '</strong></th>
      <td>';echo form::checkbox($grouplist,$unsetgroupids,'name="unsetgroupids[]" id="unsetgroupids"',0,'100');;echo '</td>
    </tr>
	<tr> 
      <th><strong>';echo L('disabled_role_field');;echo '</strong></th>
      <td>';echo form::checkbox($roles,$unsetroleids,'name="unsetroleids[]" id="unsetroleids"',0,'100');;echo ' </td>
    </tr>
</table>

    <div class="bk15"></div>
    <input name="info[modelid]" type="hidden" value="';echo $modelid;echo '">
    <input name="fieldid" type="hidden" value="';echo $fieldid;echo '">
    <input name="oldfield" type="hidden" value="';echo $field;echo '">
    <div class="btn"><input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="button"></div>
	</form>

</div>
</body>
</html>';?>