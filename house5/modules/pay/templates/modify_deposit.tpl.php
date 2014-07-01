<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#unit").formValidator({onshow:"';echo L('input_price_to_change');echo '",onfocus:"';echo L('number').L('empty');echo '"}).inputValidator({min:1,max:999,onerror:"';echo L('number').L('empty');echo '"}).regexValidator({regexp:"^(([1-9]{1}\\\\d*)|([0]{1}))(\\\\.(\\\\d){1,2})?$",onerror:"';echo L('must_be_price');echo '"});
	$("#username").formValidator({onshow:"';echo L('input').L('username');echo '",onfocus:"';echo L('username').L('empty');echo '"}).inputValidator({min:1,max:999,onerror:"';echo L('username').L('empty');echo '"}).ajaxValidator({
	    type : "get",
		url : "",
		data :"s=pay/payment/public_checkname_ajax",
		datatype : "html",
		async:\'false\',
		success : function(data){	
            if(data!= \'FALSE\')
			{
            	$("#balance").html(data);
                return true;
			}
            else
			{
            	$("#balance").html(\'\');
                return false;
			}
		},
		buttons: $("#dosubmit"),
		onerror : "';echo L('user_not_exist');echo '",
		onwait : "';echo L('checking');echo '"
	});
	$("#usernote").formValidator({onshow:"';echo L('input').L('reason_of_modify');echo '",onfocus:"';echo L('usernote').L('empty');echo '"}).inputValidator({min:1,max:999,onerror:"';echo L('usernote').L('empty');echo '"});
})
//-->
</script>
<div class="pad-10">
<div class="common-form">
<form name="myform" action="?s=pay/payment/';echo $_GET['a'];echo '" method="post" id="myform">
<table width="100%" class="table_form">
<tr>
<td  width="120">';echo L('recharge_type');echo '</td> 
<td><input name="pay_type" value="1" type="radio" id="pay_type" checked> ';echo L('money');echo '  
<input name="pay_type" value="2" type="radio" id="pay_type"> ';echo L('point');echo '</td>
</tr>
<tr>
<td  width="120">';echo L('username');echo '</td> 
<td><input type="text" name="username" size="15" value="';echo $username;echo '" id="username"><span id="balance"><span></td>
</tr>
<tr>
<td  width="120">';echo L('recharge_quota');echo '</td> 
<td><input name="pay_unit" value="1" type="radio" checked> ';echo L('increase');echo '  <input name="pay_unit" value="0" type="radio"> ';echo L('reduce');echo ' <input type="text" name="unit" size="10" value="';echo $unit;echo '" id="unit"></td>
</tr>
<tr>
<td  width="120">';echo L('trading').L('usernote');echo '</td> 
<td><textarea name="usernote"  id="usernote" rows="5" cols="50"></textarea></td>
</tr>
<tr>
<td  width="120">';echo L('op_notice');echo '</td> 
<td><label><input type="checkbox" id="sendemail" name="sendemail" value="1" checked> ';echo L('op_sendemail');echo '</label></td>
</tr>
</table>
<div class="bk15"></div>
<input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="button" id="dosubmit">
</form>
</div>
</body>
</html>
<script type="text/javascript">

$(document).ready(function() {
	$("#paymethod input[type=\'radio\']").click( function () {
		if($(this).val()== 0){
			$("#rate").removeClass(\'hidden\');
			$("#fix").addClass(\'hidden\');
			$("#rate input").val(\'0\');
		} else {
			$("#fix").removeClass(\'hidden\');
			$("#rate").addClass(\'hidden\');
			$("#fix input").val(\'0\');
		}	
	});
});
function category_load(obj)
{
	var modelid = $(obj).attr(\'value\');
	$.get(\'?s=admin/position/public_category_load&modelid=\'+modelid,function(data){
			$(\'#load_catid\').html(data);
		  });
}
</script>


';?>