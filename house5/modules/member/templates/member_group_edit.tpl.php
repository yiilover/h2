<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'formvalidator.js" charset="UTF-8"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'formvalidatorregex.js" charset="UTF-8"></script>
<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#name").formValidator({onshow:"';echo L('input').L('groupname');echo '",onfocus:"';echo L('groupname').L('between_2_to_8');echo '"}).inputValidator({min:2,max:15,onerror:"';echo L('groupname').L('between_2_to_8');echo '"}).regexValidator({regexp:"ps_username",datatype:"enum",onerror:"';echo L('groupname').L('format_incorrect');echo '"}).ajaxValidator({
	    type : "get",
		url : "",
		data :"s=member/member_group/public_checkname_ajax&oldgroupname=';echo $groupinfo['name'];echo '",
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
		onerror : "';echo L('groupname_already_exist');echo '",
		onwait : "';echo L('connecting_please_wait');echo '"
	}).defaultPassed();
	$("#group_point").formValidator({tipid:"pointtip",onshow:"';echo L('input').L('point');echo '",onfocus:"';echo L('point').L('between_1_to_8_num');echo '"}).regexValidator({regexp:"^\\\\d{1,8}$",onerror:"';echo L('point').L('between_1_to_8_num');echo '"});
	$("#group_starnum").formValidator({tipid:"starnumtip",onshow:"';echo L('input').L('starnum');echo '",onfocus:"';echo L('starnum').L('between_1_to_8_num');echo '"}).regexValidator({regexp:"^\\\\d{1,8}$",onerror:"';echo L('starnum').L('between_1_to_8_num');echo '"});
	$("#maxmessagenum").formValidator({tipid:"maxmessagenumtip",onshow:"';echo L('input').L('maxmessagenum');echo '",onfocus:"';echo L('maxmessagenum').L('between_1_to_8_num');echo '"}).regexValidator({regexp:"^\\\\d{1,8}$",onerror:"';echo L('maxmessagenum').L('between_1_to_8_num');echo '"});
	$("#allowpostnum").formValidator({tipid:"allowpostnumip",onshow:"';echo L('input').L('allowpostnum');echo '",onfocus:"';echo L('allowpostnum').L('between_1_to_8_num');echo '"}).regexValidator({regexp:"^\\\\d{1,8}$",onerror:"';echo L('allowpostnum').L('between_1_to_8_num');echo '"});

});
//-->
</script>
<div class="pad-10">
<div class="common-form">
<form name="myform" action="?s=member/member_group/edit" method="post" id="myform">
<input type="hidden" name="info[groupid]"value="';echo $groupinfo['groupid'];echo '">
<fieldset>
	<legend>';echo L('basic_configuration');echo '</legend>
	<table width="100%" class="table_form">
		<tr>
			<td width="120">';echo L('member_group_name');echo '</td> 
			<td>';if(in_array($groupid,array(1,7,8))) {echo $groupinfo['name'];}else {;echo '<input type="text" name="info[name]"  class="input-text" id="name" value="';echo $groupinfo['name'];echo '">';};echo '</td>
		</tr>
		<tr>
			<td>';echo L('member_model');echo '</td>
			<td>
			';echo $modellist[$groupinfo['modelid']];echo '			</td>
		</tr>
		<tr>
			<td>';echo L('member_group_creditrange');echo '</td> 
			<td>
			<input type="text" name="info[point]" class="input-text" id="group_point" value="';echo $groupinfo['point'];echo '" size="6"></td>
		</tr>
		<tr>
			<td>';echo L('member_group_starnum');echo '</td> 
			<td><input type="text" name="info[starnum]" class="input-text" id="group_starnum" value="';echo $groupinfo['starnum'];echo '"  size="6"></td>
		</tr>
	</table>
</fieldset>
<div class="bk15"></div>
<fieldset>
	<legend>';echo L('more_configuration');echo '</legend>
	<table width="100%" class="table_form">
		';if($groupinfo['modelid']>'0'){;echo ' 
		<tr>
			<td>';echo L('member_group_permission');echo '</td>
			<td>
				<span class="ik lf" style="width:120px;">
					<input type="checkbox" name="info[allowpost]" ';if($groupinfo['allowpost']){;echo 'checked';};echo ' />
					';echo L('member_group_publish');echo '				</span>
				<span class="ik lf" style="width:120px;">
					<input type="checkbox" name="info[allowpostverify]" ';if($groupinfo['allowpostverify']){;echo 'checked';};echo '>
					';echo L('member_group_publish_verify');echo '				</span>
				<span class="ik lf" style="width:120px;">
					<input type="checkbox" name="info[allowupgrade]" ';if($groupinfo['allowupgrade']){;echo 'checked';};echo ' />
					';echo L('member_group_upgrade');echo ' 
				</span>
				<span class="ik lf" style="width:120px;">
					<input type="checkbox" name="info[allowsendmessage]" ';if($groupinfo['allowsendmessage']){;echo 'checked';};echo '>
					';echo L('member_group_sendmessage');echo ' 
				</span>
				<span class="ik lf" style="width:120px;">
					<input type="checkbox" name="info[allowattachment]" ';if($groupinfo['allowattachment']){;echo 'checked';};echo '>
					';echo L('allowattachment');echo ' 
				</span>
				<span class="ik lf" style="width:120px;">
					<input type="checkbox" name="info[allowsearch]" ';if($groupinfo['allowsearch']){;echo 'checked';};echo '>
					';echo L('allowsearch');echo ' 
				</span>
			</td>
		</tr>
		';};echo '		<tr>
			<td width="80">';echo L('member_group_maxmessagenum');echo '</td> 
			<td><input type="text" name="info[allowmessage]" class="input-text" id="maxmessagenum" value="';echo $groupinfo['allowmessage'];echo '" size="8"></td>
		</tr>
		<tr>
			<td width="80">';echo L('member_group_username_color');echo '</td> 
			<td><input type="text" name="info[usernamecolor]" class="input-text" id="usernamecolor" size="8" value="';echo $groupinfo['usernamecolor'];echo '" ></td>
		</tr>
		';if($groupinfo['modelid']<>'42'){;echo '		<tr>
			<td width="80">';echo L('member_group_total_nums');echo '</td> 
			<td><input type="text" name="info[total_nums]" class="input-text" id="total_nums" size="8" value="';echo $groupinfo['total_nums'];echo '"> </td>
		</tr>
		';};echo '		<tr>
			<td width="80">';echo L('member_group_icon');echo '</td> 
			<td><input type="text" name="info[icon]" class="input-text" id="icon" value="';echo $groupinfo['icon'];echo '" size="40"></td>
		</tr>
		<tr>
			<td width="80">';echo L('member_group_description');echo '</td> 
			<td><input type="text" name="info[description]" class="input-text" value="';echo $groupinfo['description'];echo '" size="60"></td>
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