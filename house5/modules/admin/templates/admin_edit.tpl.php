<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_validator = true;include $this->admin_tpl('header');;echo '<script type="text/javascript">
  $(document).ready(function() {
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#password").formValidator({empty:true,onshow:"';echo L('not_change_the_password_please_leave_a_blank');echo '",onfocus:"';echo L('password').L('between_6_to_20');echo '"}).inputValidator({min:6,max:20,onerror:"';echo L('password').L('between_6_to_20');echo '"});
	$("#pwdconfirm").formValidator({empty:true,onshow:"';echo L('not_change_the_password_please_leave_a_blank');echo '",onfocus:"';echo L('input').L('passwords_not_match');echo '",oncorrect:"';echo L('passwords_match');echo '"}).compareValidator({desid:"password",operateor:"=",onerror:"';echo L('input').L('passwords_not_match');echo '"});
	$("#email").formValidator({onshow:"';echo L('input').L('email');echo '",onfocus:"';echo L('email').L('format_incorrect');echo '",oncorrect:"';echo L('email').L('format_right');echo '"}).regexValidator({regexp:"email",datatype:"enum",onerror:"';echo L('email').L('format_incorrect');echo '"});
  })
</script>
<div class="pad_10">
<div class="common-form">
<form name="myform" action="?s=admin/admin_manage/edit" method="post" id="myform">
<input type="hidden" name="info[userid]" value="';echo $userid;echo '"></input>
<input type="hidden" name="info[username]" value="';echo $username;echo '"></input>
<table width="100%" class="table_form contentWrap">
<tr>
<td width="80">';echo L('username');echo '</td> 
<td>';echo $username;echo '</td>
</tr>
<tr>
<td>';echo L('password');echo '</td> 
<td><input type="password" name="info[password]" id="password" class="input-text"></input></td>
</tr>
<tr>
<td>';echo L('cofirmpwd');echo '</td> 
<td><input type="password" name="info[pwdconfirm]" id="pwdconfirm" class="input-text"></input></td>
</tr>
<tr>
<td>';echo L('email');echo '</td>
<td>
<input type="text" name="info[email]" value="';echo $email;echo '" class="input-text" id="email" size="30"></input>
</td>
</tr>
<tr>
<td>';echo L('nickname');echo '</td>
<td>
<input type="text" name="info[nickname]" value="';echo $nickname;echo '" class="input-text" id="nickname"></input>
</td>
</tr>
<tr>
<td>';echo L('realname');echo '</td>
<td>
<input type="text" name="info[realname]" value="';echo $realname;echo '" class="input-text" id="realname"></input>
</td>
</tr>
';if ($_SESSION['roleid']==1) {;echo '<tr>
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
<tr>
<td>';echo L('enabled');echo '</td>
<td><input type="radio" name="info[disabled]" value="0" ';echo ($disabled=='0')?' checked':'';echo '> ';echo L('enable');echo '  <label><input type="radio" name="info[disabled]" value="1" ';echo ($disabled=='1')?' checked':'';echo '>';echo L('ban');echo '</td>
</tr>
';};echo '</table>

    <div class="bk15"></div>
    <input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="dialog" id="dosubmit">
</form>
</div>
</div>
</body>
</html>
';?>