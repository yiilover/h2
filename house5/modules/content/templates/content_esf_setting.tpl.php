<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'formvalidator.js" charset="UTF-8"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'formvalidatorregex.js" charset="UTF-8"></script>
<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#defualtpoint").formValidator({tipid:"pointtip",onshow:"';echo L('input').L('defualtpoint');echo '",onfocus:"';echo L('defualtpoint').L('between_1_to_8_num');echo '"}).regexValidator({regexp:"^\\\\d{1,8}$",onerror:"';echo L('defualtpoint').L('between_1_to_8_num');echo '"});
	$("#defualtamount").formValidator({tipid:"starnumtip",onshow:"';echo L('input').L('defualtamount');echo '",onfocus:"';echo L('defualtamount').L('between_1_to_8_num');echo '"}).regexValidator({regexp:"^\\\\d{1,8}$",onerror:"';echo L('defualtamount').L('between_1_to_8_num');echo '"});
	$("#rmb_point_rate").formValidator({tipid:"rmb_point_rateid",onshow:"';echo L('input').L('rmb_point_rate');echo '",onfocus:"';echo L('rmb_point_rate').L('between_1_to_8_num');echo '"}).regexValidator({regexp:"^\\\\d{1,8}$",onerror:"';echo L('rmb_point_rate').L('between_1_to_8_num');echo '"});

});
//-->
</script>
<div class="pad-lr-10">
<div class="common-form">
<form name="myform" action="?s=content/esf_setting/manage" method="post" id="myform">
	<table width="100%" class="table_form">
		<tr>
			<td width="200">经纪人注册是否需要审核</td> 
			<td>
				';echo L('yes');echo '<input type="radio" name="info[broker_check]"  class="input-radio" ';if($member_setting['broker_check']) {;echo 'checked';};echo ' value=\'1\'>
				';echo L('no');echo '<input type="radio" name="info[broker_check]"  class="input-radio" ';if(!$member_setting['broker_check']) {;echo 'checked';};echo ' value=\'0\'>
			</td>
		</tr>
		<tr>
			<td width="200">二手房信息是否需要审核</td> 
			<td>
				';echo L('yes');echo '<input type="radio" name="info[esf_check]"  class="input-radio"';if($member_setting['esf_check']) {;echo 'checked';};echo ' value=\'1\'>
				';echo L('no');echo '<input type="radio" name="info[esf_check]"  class="input-radio"';if(!$member_setting['esf_check']) {;echo 'checked';};echo ' value=\'0\'> （此选项对经纪人无效）
			</td>
		</tr>		
		<tr>
			<td width="200">经纪人每日允许刷新次数</td> 
			<td>
				<input type="text" name="info[refresh_times]" id="refresh_times" class="input-text" size="4" value="';echo $member_setting['refresh_times'];;echo '"> （该值为每条记录的日刷新次数）
			</td>
		</tr>
		<tr>
			<td width="200">标签房源有效期</td> 
			<td>
				<input type="text" name="info[tags_valid]" id="tags_valid" class="input-text" size="4" value="';echo $member_setting['tags_valid'];;echo '">天 （0为不限制）
			</td>
		</tr>
		<tr>
			<td width="200">房源默认过期时间</td> 
			<td>
				<input type="text" name="info[overtime]" id="overtime" class="input-text" size="4" value="';echo $member_setting['overtime'];;echo '">天 （0为不限制）
			</td>
		</tr>
		<tr>
			<td width="200">发布出售积分奖励</td> 
			<td>
				<input type="text" name="info[add_esf_point]" id="add_esf_point" class="input-text" size="4" value="';echo $member_setting['add_esf_point'];;echo '"> （0为不操作）
			</td>
		</tr>
		<tr>
			<td width="200">发布出租积分奖励</td> 
			<td>
				<input type="text" name="info[add_rent_point]" id="add_rent_point" class="input-text" size="4" value="';echo $member_setting['add_rent_point'];;echo '"> （0为不操作）
			</td>
		</tr>
		<table style="display:none;">
		<tr>
			<td width="200">';echo L('allow_register');echo '</td> 
			<td>
				';echo L('yes');echo '<input type="radio" name="info[allowregister]"  class="input-radio" ';if($member_setting['allowregister']) {;echo 'checked';};echo ' value=\'1\'>
				';echo L('no');echo '<input type="radio" name="info[allowregister]"  class="input-radio" ';if(!$member_setting['allowregister']) {;echo 'checked';};echo ' value=\'0\'>
			</td>
		</tr>
		<tr>
			<td width="200">';echo L('register_model');echo '</td> 
			<td>
				';echo L('yes');echo '<input type="radio" name="info[choosemodel]"  class="input-radio"';if($member_setting['choosemodel']) {;echo 'checked';};echo ' value=\'1\'>
				';echo L('no');echo '<input type="radio" name="info[choosemodel]"  class="input-radio"';if(!$member_setting['choosemodel']) {;echo 'checked';};echo ' value=\'0\'>
			</td>
		</tr>
		<tr>
			<td width="200">';echo L('register_email_auth');echo '</td> 
			<td>
				';echo L('yes');echo '<input type="radio" name="info[enablemailcheck]"  class="input-radio"';if($member_setting['enablemailcheck']) {;echo 'checked';};echo ' value=\'1\' ';if($mail_disabled) {;echo 'disabled';};echo '>
				';echo L('no');echo '<input type="radio" name="info[enablemailcheck]"  class="input-radio"';if(!$member_setting['enablemailcheck']) {;echo 'checked';};echo ' value=\'0\'> <font color=red>';echo L('enablemailcheck_notice');echo '</red>
			</td>
		</tr>
		<tr>
			<td width="200">';echo L('register_verify');echo '</td> 
			<td>
				';echo L('yes');echo '<input type="radio" name="info[registerverify]"  class="input-radio"';if($member_setting['registerverify']) {;echo 'checked';};echo ' value=\'1\'>
				';echo L('no');echo '<input type="radio" name="info[registerverify]"  class="input-radio"';if(!$member_setting['registerverify']) {;echo 'checked';};echo ' value=\'0\'>
			</td>
		</tr>
		<tr>
			<td width="200">';echo L('show_app_point');echo '</td> 
			<td>
				';echo L('yes');echo '<input type="radio" name="info[showapppoint]"  class="input-radio"';if($member_setting['showapppoint']) {;echo 'checked';};echo ' value=\'1\'>
				';echo L('no');echo '<input type="radio" name="info[showapppoint]"  class="input-radio"';if(!$member_setting['showapppoint']) {;echo 'checked';};echo ' value=\'0\'>
			</td>
		</tr>
		
		<tr>
			<td width="200">';echo L('rmb_point_rate');echo '</td> 
			<td>
				<input type="text" name="info[rmb_point_rate]" id="rmb_point_rate" class="input-text" size="4" value="';echo $member_setting['rmb_point_rate'];;echo '">
			</td>
		</tr>
				
		<tr>
			<td width="200">';echo L('defualtpoint');echo '</td> 
			<td>
				<input type="text" name="info[defualtpoint]" id="defualtpoint" class="input-text" size="4" value="';echo $member_setting['defualtpoint'];;echo '">
			</td>
		</tr>
		<tr>
			<td width="200">';echo L('defualtamount');echo '</td> 
			<td>
				<input type="text" name="info[defualtamount]" id="defualtamount" class="input-text" size="4" value="';echo $member_setting['defualtamount'];;echo '">
			</td>
		</tr>
		<tr>
			<td width="200">当天首次登录奖励积分</td> 
			<td>
				<input type="text" name="info[firstloginpoint]" id="firstloginpoint" class="input-text" size="4" value="';echo $member_setting['firstloginpoint'];;echo '">
			</td>
		</tr>
		<tr>
			<td width="200">';echo L('show_register_protocol');echo '</td> 
			<td>
				';echo L('yes');echo '<input type="radio" name="info[showregprotocol]"  class="input-radio" ';if($member_setting['showregprotocol']) {;echo 'checked';};echo ' value=\'1\'>
				';echo L('no');echo '<input type="radio" name="info[showregprotocol]"  class="input-radio" ';if(!$member_setting['showregprotocol']) {;echo 'checked';};echo ' value=\'0\'>
			</td>
		</tr>
		<tr>
			<td width="200">';echo L('register_protocol');echo '</td> 
			<td>
				<textarea name="info[regprotocol]" id="regprotocol" style="width:80%;height:120px;">';echo $member_setting['regprotocol'];echo '</textarea>
			</td>
		</tr>
		<tr>
			<td width="200">';echo L('register_verify_message');echo '</td> 
			<td>
				<textarea name="info[registerverifymessage]" id="registerverifymessage" style="width:80%;height:120px;">';echo $member_setting['registerverifymessage'];echo '</textarea>
				<BR>';echo L('register_func_tips');;echo '
			</td>
		</tr>

		<tr>
			<td width="200">';echo L('forgetpasswordmessage');echo '</td> 
			<td>
				<textarea name="info[forgetpassword]" id="forgetpassword" style="width:80%;height:120px;">';echo $member_setting['forgetpassword'];echo '</textarea>
			</td>
		</tr>
		</table>
	</table>
    <div class="bk15"></div>
    <input name="dosubmit" type="submit" id="dosubmit" value="';echo L('submit');echo '" class="button">
</form>
</div>
</div>
</body>
</html>';?>