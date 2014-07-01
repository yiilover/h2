<?php

include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
	$(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}}); 

	$("#link_name").formValidator({onshow:"';echo L("input").L('link_name');echo '",onfocus:"';echo L("input").L('link_name');echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('link_name');echo '"}).ajaxValidator({type : "get",url : "",data :"s=link/link/public_name/linkid/';echo $linkid;;echo '",datatype : "html",async:\'false\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('link_name').L('exists');echo '",onwait : "';echo L('connecting');echo '"}).defaultPassed(); 

	$("#link_url").formValidator({onshow:"';echo L("input").L('url');echo '",onfocus:"';echo L("input").L('url');echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('url');echo '"}).regexValidator({regexp:"^http:\\/\\/[A-Za-z0-9]+\\.[A-Za-z0-9]+[\\/=\\?%\\-&]*([^<>])*$",onerror:"';echo L('link_onerror');echo '"})
	
	})
//-->
</script>

<div class="pad_10">
<form action="?s=link/link/edit/linkid/';echo $linkid;;echo '" method="post" name="myform" id="myform">
<table cellpadding="2" cellspacing="1" class="table_form" width="100%">


	<tr>
		<th width="20%">';echo L('typeid');echo '£∫</th>
		<td><select name="link[typeid]" id="">
		<option value="0" ';if($typeid=='0'){echo "selected";};echo '>ƒ¨»œ∑÷¿‡</option>
		';
$i=0;
foreach($types as $type_key=>$type){
$i++;
;echo '		<option value="';echo $type['typeid'];;echo '" ';if($type['typeid']==$typeid){echo "selected";};echo '>';echo $type['name'];;echo '</option>
		';};echo '			 
		</select></td>
	</tr>
	
	<tr>
		<th width="100">';echo L('link_type');echo '£∫</th>
		<td>
		';if($linktype == 1){
;echo '		<input name="link[linktype]" type="radio" value="1" checked="checked" style="border:0" onclick="$(\'#logolink\').show()" class="radio_style">
	';echo L('logo_link');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" name="link[linktype]" value="0" style="border:0" onclick="$(\'#logolink\').hide()" class="radio_style">
	';echo L('word_link');echo '		';}else{;echo '		<input name="link[linktype]" type="radio" value="1" style="border:0" onclick="$(\'#logolink\').show()" class="radio_style">
	';echo L('logo_link');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="radio" name="link[linktype]" value="0" checked="checked" style="border:0" onclick="$(\'#logolink\').hide()" class="radio_style">
	';echo L('word_link');echo '		';};echo '		
		</td>
	</tr>
	
	<tr>
		<th width="100">';echo L('link_name');echo '£∫</th>
		<td><input type="text" name="link[name]" id="link_name"
			size="30" class="input-text" value="';echo $name;;echo '"></td>
	</tr>
	
	<tr>
		<th width="100">';echo L('url');echo '£∫</th>
		<td><input type="text" name="link[url]" id="link_url"
			size="30" class="input-text" value="';echo $url;;echo '"></td>
	</tr>
	';if($linktype==1){;echo '	<tr id="logolink">
		<th width="100">';echo L('logo');echo '£∫</th>
		<td>';echo form::images('link[logo]','logo',$info['logo'],'link');echo '</td>
	</tr>
	';}else{;echo '	<tr id="logolink" style="display: none;">
		<th width="100">';echo L('logo');echo '£∫</th>
		<td>';echo form::images('link[logo]','logo',$info['logo'],'link');echo '</td>
	</tr>
	';};echo '	
	<tr>
		<th width="100">';echo L('username');echo '£∫</th>
		<td><input type="text" name="link[username]" id="link_username"
			size="30" class="input-text" value="';echo $username;;echo '"></td>
	</tr>

 
	<tr>
		<th>';echo L('web_description');echo '£∫</th>
		<td><textarea name="link[introduce]" id="introduce" cols="50"
			rows="6">';echo $introduce;;echo '</textarea></td>
	</tr>

 
	<tr>
		<th>';echo L('elite');echo '£∫</th>
		<td><input name="link[elite]" type="radio" value="1" ';if($elite==1){echo "checked";};echo '>&nbsp;';echo L('yes');echo '&nbsp;&nbsp;<input
			name="link[elite]" type="radio" value="0" ';if($elite==0){echo "checked";};echo '>&nbsp;';echo L('no');echo '</td>
	</tr>
	 
	<tr>
		<th>';echo L('passed');echo '£∫</th>
		<td><input name="link[passed]" type="radio" value="1" ';if($passed==1){echo "checked";};echo '>&nbsp;';echo L('yes');echo '&nbsp;&nbsp;<input
			name="link[passed]" type="radio" value="0" ';if($passed==0){echo "checked";};echo '>&nbsp;';echo L('no');echo '</td>
	</tr>

<tr>
		<th></th>
		<td><input type="hidden" name="forward" value="?s=link/link/edit"> <input
		type="submit" name="dosubmit" id="dosubmit" class="dialog"
		value=" ';echo L('submit');echo ' "></td>
	</tr>

</table>
</form>
</div>
</body>
</html>

';?>