<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_validator = true;
include $this->admin_tpl('header');;echo '<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#username").formValidator({onshow:"';echo L('input').L('username');echo '",onfocus:"';echo L('username').L('between_2_to_20');echo '"}).inputValidator({min:2,max:20,onerror:"';echo L('username').L('between_2_to_20');echo '"}).ajaxValidator({
	    type : "get",
		url : "",
		data :"s=admin/admin_manage/public_checkname_ajx",
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
		onerror : "';echo L('user_already_exist');echo '",
		onwait : "';echo L('connecting_please_wait');echo '"
	});
	$("#password").formValidator({onshow:"';echo L('input').L('password');echo '",onfocus:"';echo L('password').L('between_6_to_20');echo '"}).inputValidator({min:6,max:20,onerror:"';echo L('password').L('between_6_to_20');echo '"});
	$("#pwdconfirm").formValidator({onshow:"';echo L('input').L('cofirmpwd');echo '",onfocus:"';echo L('input').L('passwords_not_match');echo '",oncorrect:"';echo L('passwords_match');echo '"}).compareValidator({desid:"password",operateor:"=",onerror:"';echo L('input').L('passwords_not_match');echo '"});
	$("#email").formValidator({onshow:"';echo L('input').L('email');echo '",onfocus:"';echo L('email').L('format_incorrect');echo '",oncorrect:"';echo L('email').L('format_right');echo '"}).regexValidator({regexp:"email",datatype:"enum",onerror:"';echo L('email').L('format_incorrect');echo '"});
})
//-->
</script>
<div class="pad_10">
<div class="common-form">
<form name="myform" action="?s=admin/admin_manage/add" method="post" id="myform">
<table width="100%" class="table_form contentWrap">
<tr>
<td width="80">';echo L('username');echo '</td> 
<td><input type="test" name="info[username]"  class="input-text" id="username"></input></td>
</tr>
<tr>
<td>';echo L('password');echo '</td> 
<td><input type="password" name="info[password]" class="input-text" id="password" value=""></input></td>
</tr>
<tr>
<td>';echo L('cofirmpwd');echo '</td> 
<td><input type="password" name="info[pwdconfirm]" class="input-text" id="pwdconfirm" value=""></input></td>
</tr>
<tr>
<td>';echo L('email');echo '</td>
<td>
<input type="text" name="info[email]" value="" class="input-text" id="email" size="30"></input>
</td>
</tr>
<tr>
<td>';echo L('nickname');echo '</td>
<td>
<input type="text" name="info[nickname]" value="" class="input-text" id="nickname"></input>
</td>
</tr>
<tr>
<td>';echo L('realname');echo '</td>
<td>
<input type="text" name="info[realname]" value="" class="input-text" id="realname"></input>
</td>
</tr>
<tr>
<td>';echo L('userinrole');echo '</td>
<td>
<select name="info[roleid]">
';
foreach($roles as $role)
{
;echo '<option value="';echo $role['roleid'];echo '" ';echo (($role['roleid']==$roleid) ?'selected': '');echo '>';echo $role['rolename'];echo '</option>
';
}
;echo '</select>
</td>
</tr>
</table>
    <div class="bk15"></div>
    <input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="button">
</form>
</div>
</div>
</body>
</html>

';?>