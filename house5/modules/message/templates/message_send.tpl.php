<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
	$(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
	$("#subject").formValidator({onshow:"';echo L('input','',admin).L('subject');echo '",onfocus:"';echo L('input','',admin).L('subject');echo '"}).inputValidator({min:1,onerror:"';echo L('input','',admin).L('subject');echo '"});
	$("#content").formValidator({onshow:"';echo L('input','',admin).L('content');echo '",onfocus:"';echo L('input','',admin).L('content');echo '"}).inputValidator({min:1,onerror:"';echo L('input','',admin).L('content');echo '"});
	 
	})
//-->
</script>

<div class="pad_10">
<form action="?s=message/message/message_send" method="post" name="myform" id="myform">
<table cellpadding="2" cellspacing="1" class="table_form" width="100%">

	<tr>
		<th width="80">';echo L('sendto');echo '£º</th>
		<td>
		<input name="info[type]" type="radio" value="1" checked="checked" style="border:0" onclick="$(\'#groupid\').show();$(\'#roleid\').hide()" class="radio_style">
	';echo L('group');echo '&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
	</tr>
	
	<tr>
		<th width="80">';echo L('group');echo '£º</th>
		<td>
		
		<select name="info[groupid]" id="groupid">
		';
$i=0;
foreach($member_group_infos as $groupid=>$member_group){
$i++;
;echo '		<option value="';echo $member_group['groupid'];;echo '">';echo $member_group['name'];;echo '</option>
		';};echo '		</select>
		
		<select name="info[roleid]" id="roleid" style="display:none"  >
		';
$j=0;
foreach($role_infos as $roleid=>$role){
$j++;
;echo '		<option value="';echo $role['roleid'];;echo '">';echo $role['rolename'];;echo '</option>
		';};echo '		
		
		</select>
		
		</td>
	</tr>
	
	<tr>
		<th width="80">';echo L('subject');echo '£º</th>
		<td><input type="text" name="info[subject]" id="subject"
			size="30" class="input-text"></td>
	</tr>  
 
	<tr>
		<th>';echo L('content');echo '£º</th>
		<td><textarea name="info[content]" id="content" cols="50"
			rows="6"></textarea></td>
	</tr> 
<input type="submit" name="dosubmit" id="dosubmit" class="dialog" value=" ';echo L('submit');echo ' ">

</table>
</form>
</div>
</body>
</html> ';?>