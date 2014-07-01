<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_validator = $show_dialog = 1;
include $this->admin_tpl('header','admin');;echo '<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform"});
	$("#field").formValidator({onshow:"';echo L('input').L('fieldname');echo '",onfocus:"';echo L('fieldname').L('between_1_to_20');echo '"}).regexValidator({regexp:"^[a-zA-Z]{1}([a-zA-Z0-9]|[_]){0,19}$",onerror:"';echo L('fieldname_was_wrong');;echo '"}).inputValidator({min:1,max:20,onerror:"';echo L('fieldname').L('between_1_to_20');echo '"}).ajaxValidator({
	    type : "get",
		url : "",
		data : "s=formguide/formguide_field/public_checkfield/modelid/';echo $formid;echo '",
		datatype : "html",
		cached:false,
		getdata:{issystem:\'issystem\'},
		async:\'false\',
		success : function(data){	
            if( data == "1" ){
                return true;
			} else {
                return false;
			}
		},
		buttons: $("#dosubmit"),
		onerror : "';echo L('fieldname').L('already_exist');echo '",
		onwait : "';echo L('connecting_please_wait');echo '"
	});
	$("#formtype").formValidator({onshow:"';echo L('select_fieldtype');;echo '",onfocus:"';echo L('select_fieldtype');;echo '",oncorrect:"';echo L('input_right');;echo '",defaultvalue:""}).inputValidator({min:1,onerror: "';echo L('select_fieldtype');;echo '"});
	$("#name").formValidator({onshow:"';echo L('input_nickname');;echo '",onfocus:"';echo L('nickname_empty');;echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L('input_nickname');;echo '"});
})

//-->
</script>
<div class="pad_10">
<div class="subnav">
  <h2 class="title-1 line-x f14 fb blue lh28">';echo L('formguide');;echo '--';echo $m_r['name'].L('field_manage');;echo '</h2>
<div class="content-menu ib-a blue line-x"><a class="add fb" href="?s=formguide/formguide_field/add/modelid/';echo $formid;echo '/menuid/';echo $_GET['menuid'];echo '"><em>';echo L('add_field');;echo '</em></a>
¡¡';if (isset($formid) &&!empty($formid)) {;echo '<a href="?s=formguide/formguide_field/init/modelid/';echo $formid;echo '/menuid/';echo $_GET['menuid'];echo '"><em>';echo L('manage_field');;echo '</em></a>';}else {;echo '<a href="?s=formguide/formguide_field/init/menuid/';echo $_GET['menuid'];echo '"><em>';echo L('public_field_manage');echo '</em></a>';};echo '</div>
  <div class="bk10"></div>
</div>
<form name="myform" id="myform" action="?s=formguide/formguide_field/add" method="post">
<div class="common-form">

<table width="100%" class="table_form contentWrap">
	<tr> 
      <th><strong>';echo L('field_type');;echo '</strong><br /></th>
      <td>
';echo form::select($all_field,'','name="info[formtype]" id="formtype" onchange="javascript:field_setting(this.value);"',L('select_fieldtype'));;echo '	  </td>
    </tr>
	<tr> 
      <th width="25%"><font color="red">*</font> <strong>';echo L('fieldname');;echo '</strong><br />
	  ';echo L('fieldname_tips');;echo '	  </th>
      <td><input type="text" name="info[field]" id="field" size="20" class="input-text"></td>
    </tr>
	<tr> 
      <th><font color="red">*</font> <strong>';echo L('field_nickname');;echo '</strong><br />';echo L('nickname_tips');;echo '</th>
      <td><input type="text" name="info[name]" id="name" size="30" class="input-text"></td>
    </tr>
	<tr> 
      <th><strong>';echo L('field_tip');;echo '</strong><br />';echo L('field_tips');;echo '</th>
      <td><textarea name="info[tips]" rows="2" cols="20" id="tips" style="height:40px; width:80%"></textarea></td>
    </tr>

	<tr> 
      <th><strong>';echo L('relation_parm');;echo '</strong><br />';echo L('relation_parm_tips');;echo '</th>
      <td><div id="setting"></div></td>
    </tr>

	<tr id="formattribute"> 
      <th><strong>';echo L('form_attr');;echo '</strong><br />';echo L('form_attr_tips');;echo '</th>
      <td><input type="text" name="info[formattribute]" value="" size="50" class="input-text"></td>
    </tr>
	<tr id="css"> 
      <th><strong>';echo L('form_css_name');;echo '</strong><br />';echo L('form_css_name_tips');;echo '</th>
      <td><input type="text" name="info[css]" value="" size="10" class="input-text"></td>
    </tr>

	<tr> 
      <th><strong>';echo L('string_size');;echo '</strong><br />';echo L('string_size_tips');;echo '</th>
      <td>';echo L('minlength');;echo '£º<input type="text" name="info[minlength]" id="field_minlength" value="0" size="5" class="input-text"> ';echo L('maxlength');;echo '£º<input type="text" name="info[maxlength]" id="field_maxlength" value="" size="5" class="input-text"></td>
    </tr>
	<tr> 
      <th><strong>';echo L('data_preg');;echo '</strong><br />';echo L('data_preg_tips');;echo '</th>
      <td><input type="text" name="info[pattern]" id="pattern" value="" size="40" class="input-text"> 
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
      <td><input type="text" name="info[errortips]" value="" size="50" class="input-text"></td>
    </tr>
		<tr> 
      <th><strong>';echo L('disabled_groups_field');;echo '</strong></th>
      <td>';echo form::checkbox($grouplist,'','name="unsetgroupids[]" id="unsetgroupids"',0,'100');;echo '</td>
    </tr>
</table>

</div>
    <div class="bk15"></div>
    <input name="info[modelid]" type="hidden" value="';echo $formid;echo '">
    <div class="btn"><input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="button"></div>
	</form>

<script type="text/javascript">
	<!--
	function field_setting(fieldtype) {
	$(\'#formattribute\').css(\'display\',\'none\');
	$(\'#css\').css(\'display\',\'none\');

		$.getJSON("?s=formguide/formguide_field/public_field_setting/fieldtype/"+fieldtype, function(data){
			if(data.field_allow_search==\'1\') {
				$(\'#field_allow_search0\').attr("disabled",false);
				$(\'#field_allow_search1\').attr("disabled",false);
			} else {
				$(\'#field_allow_search0\').attr("checked",true);
				$(\'#field_allow_search0\').attr("disabled",true);
				$(\'#field_allow_search1\').attr("disabled",true);
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