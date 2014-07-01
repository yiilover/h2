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
		data :"s=member/member_model/public_checkmodelname_ajax&oldmodelname=';echo $modelinfo['name'];echo '",
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
	}).defaultPassed();
});
//-->
</script>
<div class="pad-10">
<div class="common-form">
<form name="myform" action="?s=member/member_model/edit" method="post" id="myform">
<input type="hidden" name="info[modelid]" value="';echo $_GET['modelid'];echo '">
<fieldset>
	<legend>';echo L('basic_configuration');echo '</legend>
	<table width="100%" class="table_form">
		<tr>
			<td width="80">';echo L('model_name');echo '</td> 
			<td><input type="text" name="info[modelname]"  class="input-text" id="modelname" size="30" value="';echo $modelinfo['name'];echo '"></input></td>
		</tr>
		<tr>
			<td>';echo L('table_name');echo '</td>
			<td>
			';echo $this->db->db_tablepre.$modelinfo['tablename'];echo '			</td>
		</tr>
		<tr>
			<td>';echo L('model_description');echo '</td>
			<td>
			<input type="text" name="info[description]" value="';echo $modelinfo['description'];echo '" class="input-text" id="description" size="80"></input>
			</td>
		</tr>
		<tr>
			<td>';echo L('deny_model');echo '</td>
			<td>
				<input type="checkbox" value="1" name="info[disabled]" ';if($modelinfo['disabled']) {;echo 'checked';};echo '>
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