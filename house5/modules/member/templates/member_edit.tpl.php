<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'member_common.js"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'formvalidator.js" charset="UTF-8"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'formvalidatorregex.js" charset="UTF-8"></script>
<script type="text/javascript">
  $(document).ready(function() {
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#password").formValidator({empty:true,onshow:"';echo L('not_change_the_password_please_leave_a_blank');echo '",onfocus:"';echo L('password').L('between_6_to_20');echo '"}).inputValidator({min:6,max:20,onerror:"';echo L('password').L('between_6_to_20');echo '"});
	$("#pwdconfirm").formValidator({empty:true,onshow:"';echo L('not_change_the_password_please_leave_a_blank');echo '",onfocus:"';echo L('passwords_not_match');echo '",oncorrect:"';echo L('passwords_match');echo '"}).compareValidator({desid:"password",operateor:"=",onerror:"';echo L('passwords_not_match');echo '"});
	$("#point").formValidator({tipid:"pointtip",onshow:"';echo L('input').L('point').L('point_notice');echo '",onfocus:"';echo L('point').L('between_1_to_8_num');echo '"}).regexValidator({regexp:"^\\\\d{1,8}$",onerror:"';echo L('point').L('between_1_to_8_num');echo '"});
	$("#email").formValidator({onshow:"';echo L('input').L('email');echo '",onfocus:"';echo L('email').L('format_incorrect');echo '",oncorrect:"';echo L('email').L('format_right');echo '"}).regexValidator({regexp:"email",datatype:"enum",onerror:"';echo L('email').L('format_incorrect');echo '"}).ajaxValidator({
	    type : "get",
		url : "",
		data :"s=member/member/public_checkemail_ajax&userid=';echo $memberinfo['userid'];echo '",
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
		onerror : "';echo L('email_already_exist');echo '",
		onwait : "';echo L('connecting_please_wait');echo '"
	}).defaultPassed();
	$("#nickname").formValidator({onshow:"';echo L('input').L('nickname');echo '",onfocus:"';echo L('nickname').L('between_2_to_20');echo '"}).inputValidator({min:2,max:20,onerror:"';echo L('nickname').L('between_2_to_20');echo '"}).regexValidator({regexp:"ps_username",datatype:"enum",onerror:"';echo L('nickname').L('format_incorrect');echo '"}).ajaxValidator({
	    type : "get",
		url : "",
		data :"s=member/index/public_checknickname_ajax&userid=';echo $memberinfo['userid'];;echo '",
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
		onerror : "';echo L('username').L('already_exist');echo '",
		onwait : "';echo L('connecting_please_wait');echo '"
	}).defaultPassed();
  });
</script>
<div class="pad-10">
<div class="common-form">
<form name="myform" action="?s=member/member/edit" method="post" id="myform">
	<input type="hidden" name="info[userid]" id="userid" value="';echo $memberinfo['userid'];echo '"></input>
	<input type="hidden" name="info[username]" value="';echo $memberinfo['username'];echo '"></input>
<fieldset>
	<legend>';echo L('basic_configuration');echo '</legend>
	<table width="100%" class="table_form">
		<tr>
			<td width="80">';echo L('username');echo '</td> 
			<td>';echo $memberinfo['username'];echo '';if($memberinfo['islock']) {;echo '<img title="';echo L('lock');echo '" src="';echo IMG_PATH;echo 'icon/icon_padlock.gif">';};echo '';if($memberinfo['vip']) {;echo '<img title="';echo L('lock');echo '" src="';echo IMG_PATH;echo 'icon/vip.gif">';};echo '</td>
		</tr>
		<tr>
			<td>';echo L('avatar');echo '</td> 
			<td><img src="';echo $memberinfo['avatar'];echo '" onerror="this.src=\'';echo IMG_PATH;echo 'member/nophoto.gif\'" height=90 width=90><input type="checkbox" name="delavatar" id="delavatar" class="input-text" value="1" ><label for="delavatar">';echo L('delete').L('avatar');echo '</label></td>
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
			<td>';echo L('nickname');echo '</td> 
			<td><input type="text" name="info[nickname]" id="nickname" value="';echo $memberinfo['nickname'];echo '" class="input-text"></input></td>
		</tr>
		<tr>
			<td>';echo L('email');echo '</td>
			<td>
			<input type="text" name="info[email]" value="';echo $memberinfo['email'];echo '" class="input-text" id="email" size="30"></input>
			</td>
		</tr>
		<tr>
			<td>';echo L('member_group');echo '</td>
			<td>
			';echo form::select($grouplist,$memberinfo['groupid'],'name="info[groupid]"','');;echo ' <div class="onShow">';echo L('changegroup_notice');echo '</div>
			</td>
		</tr>
		';if($memberinfo['modelid']=='42'){;echo '		<tr>
			<td>经纪人类型</td>
			<td>
			';echo form::select($broker_typelist,$memberinfo['typeid'],'name="info[typeid]"','');;echo ' <div class="onShow">';echo L('changegroup_notice');echo '</div>
			</td>
		</tr>
		';};echo '		<tr>
			<td>';echo L('point');echo '</td>
			<td>
			<input type="text" name="info[point]" value="';echo $memberinfo['point'];echo '" class="input-text" id="point" size="10"></input>
			<input type="hidden" name="info[modelid]"  class="input-text" id="modelid" value="';echo $memberinfo['modelid'];echo '">
			</td>
		</tr>
		<tr>
			<td>';echo L('vip');echo '</td>
			<td>
			';echo L('isvip');echo ' <input type="checkbox" name="info[vip]" value=1 ';if($memberinfo['vip']){;echo 'checked';};echo '/>
			';echo L('overduedate');echo ' ';echo $form_overdudate;echo '			</td>
		</tr>
	</table>
</fieldset>
<div class="bk15"></div>
<fieldset>
	<legend>';echo L('more_configuration');echo '</legend>
	<table width="100%" class="table_form">
	';foreach($forminfos as $k=>$v) {;echo '		<tr>
			<td width="80">';echo $v['name'];echo '</td> 
			<td>';echo $v['form'];echo '</td>
		</tr>
	';};echo '	</table>
</fieldset>

    <div class="bk15"></div>
    <input name="dosubmit" id="dosubmit" type="submit" value="';echo L('submit');echo '" class="dialog">
</form>
</div>
</div>
</body>
<script language="JavaScript">
<!--
	function changemodel(modelid) {
		redirect(\'?s=member/member/edit&userid=';echo $memberinfo[userid];echo '&modelid=\'+modelid+\'&h5_hash=';echo $_SESSION['h5_hash'];echo '\');
	}
//-->
</script>
</html>';?>