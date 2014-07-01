<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
	$(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
	$("#link_name").formValidator({onshow:"';echo L("input").L('link_name');echo '",onfocus:"';echo L("input").L('link_name');echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('link_name');echo '"});
 	$("#link_url").formValidator({onshow:"';echo L("input").L('url');echo '",onfocus:"';echo L("input").L('url');echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('url');echo '"}).regexValidator({regexp:"^http:\\/\\/[A-Za-z0-9]+\\.[A-Za-z0-9]+[\\/=\\?%\\-&]*([^<>])*$",onerror:"';echo L('link_onerror');echo '"})
	 
	})
//-->
</script>

<div class="pad_10">
<form action="?s=link/link/add" method="post" name="myform" id="myform">
<table cellpadding="2" cellspacing="1" class="table_form" width="100%">


	<tr>
		<th width="20%">';echo L('typeid');echo '£∫</th>
		<td><select name="link[typeid]" id="">
		<option value="0">ƒ¨»œ∑÷¿‡</option>
		';
$i=0;
foreach($types as $typeid=>$type){
$i++;
;echo '		<option value="';echo $type['typeid'];;echo '">';echo $type['name'];;echo '</option>
		';};echo '		</select></td>
	</tr>
	
	<tr>
		<th width="100">';echo L('link_type');echo '£∫</th>
		<td>
		<input name="link[linktype]" type="radio" value="1" checked="checked" style="border:0" onclick="$(\'#logolink\').show()" class="radio_style">
	';echo L('logo_link');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" name="link[linktype]" value="0" style="border:0" onclick="$(\'#logolink\').hide()" class="radio_style">
	';echo L('word_link');echo '		</td>
	</tr>
	
	<tr>
		<th width="100">';echo L('link_name');echo '£∫</th>
		<td><input type="text" name="link[name]" id="link_name"
			size="30" class="input-text"></td>
	</tr>
	
	<tr>
		<th width="100">';echo L('url');echo '£∫</th>
		<td><input type="text" name="link[url]" id="link_url"
			size="30" class="input-text"></td>
	</tr>
	
	<tr id="logolink">
		<th width="100">';echo L('logo');echo '£∫</th>
		<td>';echo form::images('link[logo]','logo','','link');echo '</td>
	</tr>
	
	<tr>
		<th width="100">';echo L('username');echo '£∫</th>
		<td><input type="text" name="link[username]" id="link_username"
			size="30" class="input-text"></td>
	</tr>

 
	<tr>
		<th>';echo L('web_description');echo '£∫</th>
		<td><textarea name="link[introduce]" id="introduce" cols="50"
			rows="6"></textarea></td>
	</tr>

 
	<tr>
		<th>';echo L('elite');echo '£∫</th>
		<td><input name="link[elite]" type="radio" value="1" >&nbsp;';echo L('yes');echo '&nbsp;&nbsp;<input
			name="link[elite]" type="radio" value="0" checked>&nbsp;';echo L('no');echo '</td>
	</tr>
	 
	<tr>
		<th>';echo L('passed');echo '£∫</th>
		<td><input name="link[passed]" type="radio" value="1" checked>&nbsp;';echo L('yes');echo '&nbsp;&nbsp;<input
			name="link[passed]" type="radio" value="0">&nbsp;';echo L('no');echo '</td>
	</tr>

<tr>
		<th></th>
		<td><input type="hidden" name="forward" value="?s=vote/vote/add"> <input
		type="submit" name="dosubmit" id="dosubmit" class="dialog"
		value=" ';echo L('submit');echo ' "></td>
	</tr>

</table>
</form>
</div>
</body>
</html> ';?>