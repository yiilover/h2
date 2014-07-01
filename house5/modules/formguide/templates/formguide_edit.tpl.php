<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad-10">
<form method="post" action="?s=formguide/formguide/edit/formid/';echo $_GET['formid'];echo '" name="myform" id="myform">
<table class="table_form" width="100%" cellspacing="0">
<tbody>
	<tr>
		<th width="150"><strong>';echo L('name');echo '：</strong></th>
		<td><input name="info[name]" id="name" class="input-text" type="text" value="';echo htmlspecialchars($data['name']);echo '" size="30" ></td>
	</tr>
	<tr>
		<th><strong>';echo L('tablename');echo '：</strong></th>
		<td><input name="info[tablename]" id="tablename" class="input-text" type="text" value="';echo $data['tablename'];echo '" readonly size="25" ></td>
	</tr>
	<tr>
		<th><strong>';echo L('introduction');echo '：</strong></th>
		<td><textarea name="info[description]" id="description" rows="6" cols="50">';echo $data['description'];echo '</textarea></td>
	</tr>
	<tr>
		<th><strong>';echo L('time_limit');echo '：</strong></th>
		<td><input type="radio" name="setting[enabletime]" value="1" ';if ($data['setting']['enabletime']) {;echo 'checked';};echo '> ';echo L('enable');echo ' <input type="radio" name="setting[enabletime]" value="0" ';if ($data['setting']['enabletime']==0) {;echo 'checked';};echo '> ';echo L('unenable');echo '</td>
	</tr>
	<tr id="time_start" style="';if ($data['setting']['enabletime']==0) {;echo 'display:none;';};echo '">
  		<th><strong>';echo L('start_time');echo '：</strong></th>
        <td>';echo form::date('setting[starttime]',date('Y-m-d',$data['setting']['starttime']));echo '</td>
	</tr>
	<tr id="time_end" style="';if ($data['setting']['enabletime']==0) {;echo 'display:none;';};echo '">
		<th><strong>';echo L('end_time');echo '：</strong></th>
		<td>';echo form::date('setting[endtime]',date('Y-m-d',$data['setting']['endtime']));echo '</td>
	</tr>
	<tr>
		<th><strong>';echo L('allowed_send_mail');echo '：</strong></th>
		<td><input name="setting[sendmail]" type="radio" value="1" ';if ($data['setting']['sendmail']) {;echo 'checked';};echo '>&nbsp;';echo L('yes');echo '&nbsp;&nbsp;<input name="setting[sendmail]" type="radio" value="0" ';if ($data['setting']['sendmail']==0) {;echo 'checked';};echo '>&nbsp;';echo L('no');echo '</td>
	</tr>
	<tr id="mailaddress" style="';if ($data['setting']['sendmail']==0) {;echo 'display:none;';};echo '">
		<th><strong>';echo L('e-mail_address');echo '：</strong></th>
		<td><input type="text" name="setting[mails]" id="mails" class="input-text" value="';echo $data['setting']['mails'];echo '" size="50"> ';echo L('multiple_with_commas');echo '</td>
	</tr>
	<tr>
		<th><strong>';echo L('allows_more_ip');echo '：</strong></th>
		<td><input type=\'radio\' name=\'setting[allowmultisubmit]\' value=\'1\' ';if($data['setting']['allowmultisubmit'] == 1) {;echo 'checked';};echo '> ';echo L('yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=\'radio\' name=\'setting[allowmultisubmit]\' value=\'0\' ';if($data['setting']['allowmultisubmit'] == 0) {;echo 'checked';};echo '> ';echo L('no');echo '</td>
	</tr>
	<tr>
		<th><strong>';echo L('allowunreg');echo '：</strong></th>
		<td><input type=\'radio\' name=\'setting[allowunreg]\' value=\'1\' ';if($data['setting']['allowunreg'] == 1) {;echo 'checked';};echo '> ';echo L('yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=\'radio\' name=\'setting[allowunreg]\' value=\'0\' ';if($data['setting']['allowunreg'] == 0) {;echo 'checked';};echo '> ';echo L('no');echo '</td>
	</tr>
	<tr>
		<th><strong>';echo L('optional_style');echo '：</strong></th>
		<td>
		';echo form::select($template_list,$data['default_style'],'name="info[default_style]" id="style" onchange="load_file_list(this.value)"',L('please_select'));echo ' 
		</td>
	</tr>
	<tr>
		<th><strong>';echo L('template_selection');echo '：</strong></th>
		<td id="show_template"><script type="text/javascript">$.getJSON(\'?s=admin/category/public_tpl_file_list/style/';echo $data['default_style'];echo '/id/';echo $data['show_template'];echo '/module/formguide/templates/show/name/info/h5_hash/\'+h5_hash, function(data){$(\'#show_template\').html(data.show_template);});</script></td>
	</tr>
	<tr>
		<th><strong>js调用使用的模板：</strong></th>
		<td id="show_js_template"><script type="text/javascript">$.getJSON(\'?s=admin/category/public_tpl_file_list/style/';echo $data['default_style'];echo '/id/';echo $data['js_template'];echo '/module/formguide/templates/show_js/name/info/h5_hash/\'+h5_hash, function(data){$(\'#show_js_template\').html(data.show_js_template);});</script></td>
	</tr>
	</tbody>
</table>
<input type="submit" name="dosubmit" id="dosubmit" value=" ';echo L('ok');echo ' " class="dialog">&nbsp;<input type="reset" class="dialog" value=" ';echo L('clear');echo ' ">
</form>
</div>
</body>
</html>
<script type="text/javascript">
function load_file_list(id) {
	if (id==\'\') return false;
	$.getJSON(\'?s=admin/category/public_tpl_file_list/style/\'+id+\'/module/formguide/templates/show|show_js/name/info/h5_hash/\'+h5_hash, function(data){$(\'#show_template\').html(data.show_template);$(\'#show_js_template\').html(data.show_js_template);});
}

$(document).ready(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'220\',height:\'70\'}, function(){this.close();$(obj).focus();})}});
	$(\'#name\').formValidator({onshow:"';echo L('input_form_title');echo '",onfocus:"';echo L('title_min_3_chars');echo '",oncorrect:"';echo L('right');echo '"}).inputValidator({min:1,onerror:"';echo L('title_cannot_empty');echo '"}).defaultPassed();
	$(\'#tablename\').formValidator({onshow:"';echo L('please_input_tallename');echo '", onfocus:"';echo L('standard');echo '", oncorrect:"';echo L('right');echo '"}).regexValidator({regexp:"^[a-zA-Z]{1}([a-zA-Z0-9]|[_]){0,19}$",onerror:"';echo L('tablename_was_wrong');;echo '"}).inputValidator({min:1,onerror:"';echo L('tablename_no_empty');echo '"}).ajaxValidator({
	    type : "get",
		url : "",
		data : "s=formguide/formguide/public_checktable/formid/';echo $_GET['formid'];echo '",
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
		onerror : "';echo L('tablename_existed');echo '",
		onwait : "';echo L('connecting_please_wait');echo '"
	}).defaultPassed();
	$(\'#starttime\').formValidator({onshow:"';echo L('select_stardate');echo '",onfocus:"';echo L('select_stardate');echo '",oncorrect:"';echo L('right_all');echo '"}).defaultPassed();
	$(\'#endtime\').formValidator({onshow:"';echo L('select_downdate');echo '",onfocus:"';echo L('select_downdate');echo '",oncorrect:"';echo L('right_all');echo '"}).defaultPassed();
	$(\'#style\').formValidator({onshow:"';echo L('select_style');echo '",onfocus:"';echo L('select_style');echo '",oncorrect:"';echo L('right');echo '"}).inputValidator({min:1,onerror:"';echo L('select_style');echo '"}).defaultPassed();
});
$("input:radio[name=\'setting[enabletime]\']").click(function (){
	if($("input:radio[name=\'setting[enabletime]\'][checked]").val()==0) {
		$("#time_start").hide();
		$("#time_end").hide();
	} else if($("input:radio[name=\'setting[enabletime]\'][checked]").val()==1) {
		$("#time_start").show();
		$("#time_end").show();
	}
});
$("input:radio[name=\'setting[sendmail]\']").click(function (){
	if($("input:radio[name=\'setting[sendmail]\'][checked]").val()==0) {
		$("#mailaddress").hide();
	} else if($("input:radio[name=\'setting[sendmail]\'][checked]").val()==1) {
		$("#mailaddress").show();
	}
});
</script>';?>