<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'formvalidator.js" charset="UTF-8"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'formvalidatorregex.js" charset="UTF-8"></script>
<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});

	$("#modelname").formValidator({onshow:"';echo L('input').L('model_name');echo '",onfocus:"';echo L('model_name').L('between_2_to_20');echo '"}).inputValidator({min:2,max:20,onerror:"';echo L('model_name').L('between_2_to_20');echo '"}).regexValidator({regexp:"ps_username",datatype:"enum",onerror:"';echo L('model_name').L('format_incorrect');echo '"}).ajaxValidator({
	    type : "get",
		url : "",
		data :"s=member/member_model/public_checkmodelname_ajax",
		datatype : "html",
		async:\'false\',
		success : function(data){
            if( data == "1" ) {
                return true;
			} else {
                return false;
			}
		},
		buttons: $("#dosubmit"),
		onerror : "';echo L('modelname_already_exist');echo '",
		onwait : "';echo L('connecting_please_wait');echo '"
	});
	$("#tablename").formValidator({onshow:"';echo L('input').L('table_name');echo '",onfocus:"';echo L('table_name').L('format_incorrect');echo '",oncorrect:"';echo L('table_name').L('format_right');echo '"}).inputValidator({min:2,max:8,onerror:"';echo L('table_name').L('between_2_to_8');echo '"}).regexValidator({regexp:"letter_l",datatype:"enum",onerror:"';echo L('table_name').L('format_incorrect');echo '"}).ajaxValidator({
	    type : "get",
		url : "",
		data :"s=member/member_model/public_checktablename_ajax",
		datatype : "html",
		async:\'false\',
		success : function(data){	
            if( data == "1" ) {
                return true;
			} else {
                return false;
			}
		},
		buttons: $("#dosubmit"),
		onerror : "';echo L('tablename_already_exist');echo '",
		onwait : "';echo L('connecting_please_wait');echo '"
	});
});
//-->
</script>
<div class="pad-10">
<div class="common-form">
<form name="myform" action="?s=member/member_model/add" method="post" id="myform">
<fieldset>
	<legend>';echo L('basic_configuration');echo '</legend>
	<table width="100%" class="table_form">
		<tr>
			<td width="80">';echo L('model_name');echo '</td> 
			<td><input type="text" name="info[modelname]"  class="input-text" id="modelname" size="30"></input></td>
		</tr>
		<tr>
			<td>';echo L('table_name');echo '</td>
			<td>
			';echo $this->db->db_tablepre;echo 'member_<input type="text" name="info[tablename]" value="" class="input-text" id="tablename" size="16"></input>
			</td>
		</tr>
		<tr>
			<td>';echo L('model_description');echo '</td>
			<td>
			<input type="text" name="info[description]" value="" class="input-text" id="description" size="80"></input>
			</td>
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