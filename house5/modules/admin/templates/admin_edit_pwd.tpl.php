<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_validator = true;include $this->admin_tpl('header');;echo '<script type="text/javascript">
  $(document).ready(function() {
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#old_password").formValidator({empty:true,onshow:"';echo L('not_change_the_password_please_leave_a_blank');echo '",onfocus:"';echo L('password').L('between_6_to_20');echo '",oncorrect:"';echo L('old_password_right');echo '"}).inputValidator({min:5,max:20,onerror:"';echo L('password').L('between_6_to_20');echo '"}).ajaxValidator({
	    type : "get",
		url : "",
		data :"s=admin/admin_manage/public_password_ajx",
		datatype : "html",
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
		onerror : "';echo L('old_password_wrong');echo '",
		onwait : "';echo L('connecting_please_wait');echo '"
	});
	$("#new_password").formValidator({empty:true,onshow:"';echo L('not_change_the_password_please_leave_a_blank');echo '",onfocus:"';echo L('password').L('between_6_to_20');echo '"}).inputValidator({min:6,max:20,onerror:"';echo L('password').L('between_6_to_20');echo '"});
	$("#new_pwdconfirm").formValidator({empty:true,onshow:"';echo L('not_change_the_password_please_leave_a_blank');echo '",onfocus:"';echo L('input').L('passwords_not_match');echo '",oncorrect:"';echo L('passwords_match');echo '"}).compareValidator({desid:"new_password",operateor:"=",onerror:"';echo L('input').L('passwords_not_match');echo '"});
  })
</script>
<div class="pad_10">
<div class="common-form">
<form name="myform" action="?s=admin/admin_manage/public_edit_pwd" method="post" id="myform">
<input type="hidden" name="info[userid]" value="';echo $userid;echo '"></input>
<input type="hidden" name="info[username]" value="';echo $username;echo '"></input>
<table width="100%" class="table_form contentWrap">
<tr>
<td width="80">';echo L('username');echo '</td> 
<td>';echo $username;echo ' (';echo L('realname');echo ' ';echo $realname;echo ')</td>
</tr>

<tr>
<td>';echo L('email');echo '</td>
<td>
';echo $email;echo '</td>
</tr>

<tr>
<td>';echo L('old_password');echo '</td> 
<td><input type="password" name="old_password" id="old_password" class="input-text"></input></td>
</tr>

<tr>
<td>';echo L('new_password');echo '</td> 
<td><input type="password" name="new_password" id="new_password" class="input-text"></input></td>
</tr>
<tr>
<td>';echo L('new_pwdconfirm');echo '</td> 
<td><input type="password" name="new_pwdconfirm" id="new_pwdconfirm" class="input-text"></input></td>
</tr>


</table>

    <div class="bk15"></div>
    <input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="button" id="dosubmit">
</form>
</div>
</div>
</body>
</html>
';?>