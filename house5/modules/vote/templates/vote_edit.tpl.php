<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
	$(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
	$("#subject_title").formValidator({onshow:"';echo L("input").L('vote_title');echo '",onfocus:"';echo L("input").L('vote_title');echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('vote_title');echo '"}).regexValidator({regexp:"notempty",datatype:"enum",param:\'i\',onerror:"';echo L('input_not_space');echo '"}).ajaxValidator({type : "get",url : "",data :"s=vote/vote/public_name&subjectid=';echo $subjectid;;echo '",datatype : "html",async:\'false\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('vote_title').L('exists');echo '",onwait : "';echo L('connecting');echo '"}).defaultPassed();
	$(\'#fromdate\').formValidator({onshow:"';echo L('select').L('fromdate');echo '",onfocus:"';echo L('select').L('fromdate');echo '",oncorrect:"';echo L('time_is_ok');
;echo '"}).inputValidator();
	$("#todate").formValidator({onshow:"';echo L('select').L('todate');echo '",onfocus:"';echo L('select').L('todate');echo '",oncorrect:"';echo L('time_is_ok');;echo '"}).inputValidator();
		
	});
//-->
</script>

<div class="pad_10">
<form action="?s=vote/vote/edit&subjectid=';echo $subjectid;echo '" method="post" name="myform" id="myform">
<table cellpadding="2" cellspacing="1" class="table_form" width="100%">
<tr> 
      <th width="100"> ';echo L('vote_title');echo '</th>
      <td>
      <input type="text" name="subject[subject]" id="subject_title" size="30" value="';echo $subject;;echo '">
      </td>
    </tr>
    
    <tr> 
    <th width="100"> ';echo L('select_type');echo ' </th>
    <td>
	<select name="subject[ischeckbox]" id="" onchange="AdsType(this.value)">
			<option value="0" ';if($ischeckbox == '0') {;echo ' selected';};echo '>';echo L('radio');;echo '</option>
			<option value="1" ';if($ischeckbox == '1') {;echo ' selected';};echo '>';echo L('checkbox');;echo '</option>
	</select>
	</td>
    </tr>

	<tr id="SizeFormat" ';if($ischeckbox == '0'){;echo 'style="display:none"';}else{;echo 'style="display:"';};echo '>
	<th> </th>
	<td><label>';echo L('minval');;echo '</label>&nbsp;&nbsp;<input name="subject[minval]" class="input-text" type="text" size="5" value="';echo $minval;;echo '"> ';echo L('item');echo ' &nbsp;&nbsp;&nbsp;&nbsp; <label>';echo L('maxval');;echo '</label>&nbsp;&nbsp;<input name="subject[maxval]" type="text" class="input-text" size="5" value="';echo $maxval;echo '"> ';echo L('item');echo '</td>
	</tr>
    
    <tr> 
    <th width="100"> ';echo L('vote_option');echo '£º</th>
    <td>
    <input type="button" id="addItem" value="';echo L('add_option');echo '" class="button" onclick="add_option()">
    
    <div id="option_list_1">
    ';
$i=0;
foreach($options as $optionid=>$option){
$i++;
;echo '           <div id="option';echo $option['optionid'];;echo '"><br>
           <input type="text" name="option[';echo $option['optionid'];echo ']" size="40" require="true" value="';echo $option['option'];;echo '"/>
           ';if($i>2){;echo '           <input type="button" value="';echo L('del');echo '"  onclick="del_old(';echo $option['optionid'];;echo ')" class="button"/>
           ';};echo ' 
           <font color="#FF0000"> *</font>
             
    </div>
    

	';};echo '
	</div>
	
 	<div id="new_option"></div>
 	
	</td>
    </tr>
 
    
    <tr>
		<th>';echo L('fromdate');echo '£º</th>
		<td>';echo form::date('subject[fromdate]',$fromdate);echo '</td>
	</tr>
	<tr>
		<th>';echo L('todate');echo ' £º</th>
		<td>';echo form::date('subject[todate]',$todate);echo '</td>
	</tr>
    <tr>  
      <th> ';echo L('vote_description');echo ' </th>
      <td><textarea name="subject[description]" id="description" cols="60" rows="6">';echo $description;;echo '</textarea></td>
    </tr>
    
    
    <tr> 
		<th>';echo L('allowview');echo '£º</th> 
		<td><input name="subject[allowview]" type="radio" value="1" ';echo $allowview?'checked':'';echo '>&nbsp;';echo L('allow');echo '&nbsp;&nbsp;<input name="subject[allowview]" type="radio" value="0" ';echo $allowview?'':'checked';echo '>&nbsp;';echo L('not_allow');echo '</td> 
	</tr>
	<tr> 
		<th>';echo L('allowguest');echo '£º</th> 
		<td><input name="subject[allowguest]" type="radio" value="1" ';echo $allowguest?'checked':'';echo '>&nbsp;';echo L('yes');echo '&nbsp;&nbsp;<input name="subject[allowguest]" type="radio" value="0" ';echo $allowguest?'':'checked';echo '>&nbsp;';echo L('no');echo '</td> 
	</tr>
	<tr> 
		<th>';echo L('credit');echo '£º</th> 
		<td><input type="text" name="subject[credit]" value="';echo $credit;;echo '" size=\'5\' /></td> 
	</tr>
	<tr> 
		<th>';echo L('interval');echo '£º</th> 
		<td><input type="text" name="subject[interval]" value="';echo $interval;;echo '" size=\'5\' /> ';echo L('more_ip');echo '£¬<font color=red>0</font> ';echo L('one_ip');echo '</td> 
	</tr>
	
	<tr>
		<th>';echo L('vote_style');echo '£º</th>
		<td>
		';echo form::select($template_list,$info['default_style'],'name="vote_subject[style]" id="style" onchange="load_file_list(this.value)"',L('please_select'));echo '		<script type="text/javascript">$.getJSON(\'?s=admin/category/public_tpl_file_list&style=';echo $info['default_style'];echo '&module=vote&templates=vote_tp&id=';echo $template;echo '&name=vote_subject&h5_hash=\'+h5_hash, function(data){$(\'#show_template\').html(data.vote_tp_template);});</script>
		</td>
	</tr>
	
	<tr>
		<th>';echo L('template');echo '£º</th>
		<td id="show_template">
		';echo form::select_template('default','vote',$template,'name="vote_subject[show_template]"','vote_tp');;echo '		</td>
	</tr>
	
	<tr> 
		<th>';echo L('enabled');echo '£º</th> 
		<td><input name="subject[enabled]" type="radio" value="1" ';echo $enabled?'checked':'';echo '>&nbsp;';echo L('yes');echo '&nbsp;&nbsp;<input name="subject[enabled]" type="radio" value="0" ';echo $enabled?'':'checked';echo '>&nbsp;';echo L('no');echo '</td> 
	</tr>
	<tr> 
		<th></th> 
		<td> 
		<input type="submit" name="dosubmit" id="dosubmit" class="dialog" value=" ';echo L('submit');echo ' "> 
		</td> 
	</tr>
	
</table> 
</form>
</div>
</body>
</html>
<script language="javascript" type="text/javascript">
function AdsType(adstype) {
	$(\'#SizeFormat\').css(\'display\', \'none\');
	if(adstype==\'0\') {
		
	} else if(adstype==\'1\') {
		$(\'#SizeFormat\').css(\'display\', \'\');
	}
}
$(\'#AlignBox\').click( function (){
	if($(\'#AlignBox\').attr(\'checked\')) {
		$(\'#PaddingLeft\').attr(\'disabled\', true);
		$(\'#PaddingTop\').attr(\'disabled\', true);
	} else {
		$(\'#PaddingLeft\').attr(\'disabled\', false);
		$(\'#PaddingTop\').attr(\'disabled\', false);
	}
}); 
</script>
               
<script language="javascript">
var i = 1;
function add_option() {
	//var i = 1;
	var htmloptions = \'\';
	htmloptions += \'<div id=\'+i+\'><span ><br><input type="text" name="newoption[]" size="40" msg="';echo L('must_input');echo '" value="" class="input-text"/><input type="button" value="';echo L('del');echo '"  onclick="del(\'+i+\')" class="button"/></span><font color="#FF0000"> *</font><br> </div>\';
	$(htmloptions).appendTo(\'#new_option\'); 
	var htmloptions = \'\';
	i = i+1;
}
function del(o){
 $("div [id=\\\'"+o+"\\\']").remove();	
}
function del_old2(o){
	 $("div [id=\\\'"+o+"\\\']").remove();	
}

function del_old(id) {
	$.get(\'?s=vote/vote/del_option&optionid=\'+id+\'&h5_hash=\'+h5_hash,null,function (msg) { 
	if (msg==1) { 
	$("div [id=\\\'option"+id+"\\\']").remove(); 
	} else {
	alert(msg); 
	} 
	}); 
} 

function load_file_list(id) {
	$.getJSON(\'?s=admin/category/public_tpl_file_list&style=\'+id+\'&module=vote&templates=vote_tp&name=subject&h5_hash=\'+h5_hash, function(data){$(\'#show_template\').html(data.vote_tp_template);});
}

</script>';?>