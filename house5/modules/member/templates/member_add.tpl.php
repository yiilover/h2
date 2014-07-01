<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'formvalidator.js" charset="UTF-8"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'formvalidatorregex.js" charset="UTF-8"></script>
<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});

	$("#username").formValidator({onshow:"';echo L('input').L('username');echo '",onfocus:"';echo L('username').L('between_2_to_20');echo '"}).inputValidator({min:2,max:20,onerror:"';echo L('username').L('between_2_to_20');echo '"}).regexValidator({regexp:"ps_username",datatype:"enum",onerror:"';echo L('username').L('format_incorrect');echo '"}).ajaxValidator({
	    type : "get",
		url : "",
		data :"s=member/member/public_checkname_ajax",
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
		onerror : "';echo L('deny_register').L('or').L('user_already_exist');echo '",
		onwait : "';echo L('connecting_please_wait');echo '"
	});
	$("#password").formValidator({onshow:"';echo L('input').L('password');echo '",onfocus:"';echo L('password').L('between_6_to_20');echo '"}).inputValidator({min:6,max:20,onerror:"';echo L('password').L('between_6_to_20');echo '"});
	$("#pwdconfirm").formValidator({onshow:"';echo L('input').L('cofirmpwd');echo '",onfocus:"';echo L('input').L('passwords_not_match');echo '",oncorrect:"';echo L('passwords_match');echo '"}).compareValidator({desid:"password",operateor:"=",onerror:"';echo L('input').L('passwords_not_match');echo '"});
	$("#point").formValidator({tipid:"pointtip",onshow:"';echo L('input').L('point').L('point_notice');echo '",onfocus:"';echo L('point').L('between_1_to_8_num');echo '"}).regexValidator({regexp:"^\\\\d{1,8}$",onerror:"';echo L('point').L('between_1_to_8_num');echo '"});
	$("#email").formValidator({onshow:"';echo L('input').L('email');echo '",onfocus:"';echo L('email').L('format_incorrect');echo '",oncorrect:"';echo L('email').L('format_right');echo '"}).inputValidator({min:2,max:32,onerror:"';echo L('email').L('between_2_to_32');echo '"}).regexValidator({regexp:"email",datatype:"enum",onerror:"';echo L('email').L('format_incorrect');echo '"}).ajaxValidator({
	    type : "get",
		url : "",
		data :"s=member/member/public_checkemail_ajax",
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
		onerror : "';echo L('deny_register').L('or').L('email_already_exist');echo '",
		onwait : "';echo L('connecting_please_wait');echo '"
	});
	$("#nickname").formValidator({onshow:"';echo L('input').L('nickname');echo '",onfocus:"';echo L('nickname').L('between_2_to_20');echo '"}).inputValidator({min:2,max:20,onerror:"';echo L('nickname').L('between_2_to_20');echo '"}).regexValidator({regexp:"ps_username",datatype:"enum",onerror:"';echo L('nickname').L('format_incorrect');echo '"}).ajaxValidator({
	    type : "get",
		url : "",
		data :"s=member/index/public_checknickname_ajax",
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
		onerror : "';echo L('already_exist').L('already_exist');echo '",
		onwait : "';echo L('connecting_please_wait');echo '"
	}).defaultPassed();
});
//-->
</script>
<div class="pad-10">
<div class="common-form">
<form name="myform" action="?s=member/member/add" method="post" id="myform">
<fieldset>
	<legend>';echo L('basic_configuration');echo '</legend>
	<table width="100%" class="table_form">
		<tr>
			<td width="80">';echo L('username');echo '</td> 
			<td><input type="text" name="info[username]"  class="input-text" id="username"></input></td>
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
			<td>';echo L('nickname');echo '</td> 
			<td><input type="text" name="info[nickname]" id="nickname" value="" class="input-text"></input></td>
		</tr>
		<tr>
			<td>';echo L('email');echo '</td>
			<td>
			<input type="text" name="info[email]" value="" class="input-text" id="email" size="30"></input>
			</td>
		</tr>
		<tr>
			<td>';echo L('member_group');echo '</td>
			<td>
			';echo form::select($grouplist,'2','name="info[groupid]"','');;echo '			</td>
		</tr>
		<tr>
			<td>';echo L('point');echo '</td>
			<td>
			<input type="text" name="info[point]" value="" class="input-text" id="point" size="10"></input>
			<input type="hidden" name="info[modelid]"  class="input-text" id="modelid" value="';echo $_GET['modelid'];echo '">
			<input type="hidden" name="info[typeid]"  class="input-text" id="typeid" value="';echo $typeid;echo '">
			</td>
		</tr>
		<tr>
			<td>';echo L('vip');echo '</td>
			<td>
			';echo L('isvip');echo ' <input type="checkbox" name="info[vip]" value=1 />
			';echo L('overduedate');echo ' ';echo form::date('info[overduedate]','',1);echo '			</td>
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