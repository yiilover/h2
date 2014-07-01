<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_validator = true;include $this->admin_tpl('header');;echo '<script type="text/javascript">
  $(document).ready(function() {
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#realname").formValidator({onshow:"';echo L('input').L('realname');echo '",onfocus:"';echo L('realname').L('between_2_to_20');echo '"}).inputValidator({min:2,max:20,onerror:"';echo L('realname').L('between_2_to_20');echo '"})
	$("#email").formValidator({onshow:"';echo L('input').L('email');echo '",onfocus:"';echo L('input').L('email');echo '",oncorrect:"';echo L('email').L('format_right');echo '"}).regexValidator({regexp:"email",datatype:"enum",onerror:"';echo L('email').L('format_incorrect');echo '"}).ajaxValidator({
	    type : "get",
		url : "",
		data :"s=admin/admin_manage/public_email_ajx",
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
		onerror : "';echo L('email_already_exists');echo '",
		onwait : "';echo L('connecting_please_wait');echo '"
	}).defaultPassed();
  })
</script>
<div class="pad_10">
<div class="common-form">
<form name="myform" action="?s=admin/admin_manage/public_edit_info" method="post" id="myform">
<input type="hidden" name="info[userid]" value="';echo $userid;echo '"></input>
<input type="hidden" name="info[username]" value="';echo $username;echo '"></input>
<table width="100%" class="table_form contentWrap">
<tr>
<td width="80">';echo L('username');echo '</td> 
<td>';echo $username;echo '</td>
</tr>

<tr>
<td width="80">';echo L('lastlogintime');echo '</td> 
<td>';echo $lastlogintime ?date('Y-m-d H:i:s',$lastlogintime) : '';echo '</td>
</tr>

<tr>
<td width="80">';echo L('lastloginip');echo '</td> 
<td>';echo $lastloginip;echo '</td>
</tr>

<tr>
<td>';echo L('realname');echo '</td>
<td>
<input type="text" name="info[realname]" id="realname" class="input-text" size="30" value="';echo $realname;echo '"></input>
</td>
</tr>
<tr>
<td>';echo L('email');echo '</td>
<td>
<input type="text" name="info[email]" id="email" class="input-text" size="40" value="';echo $email;echo '"></input>
</td>
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