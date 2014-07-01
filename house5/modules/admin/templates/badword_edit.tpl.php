<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<script type="text/javascript">
$(function(){
$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});

$("#badword").formValidator({onshow:"';echo L("input").L('badword_name');echo '",onfocus:"';echo L("input").L('badword_name');echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('badword_name');echo '"}).regexValidator({regexp:"notempty",datatype:"enum",param:\'i\',onerror:"';echo L('input_not_space');echo '"}).ajaxValidator({type : "get",url : "",data :"s=admin/badword/public_name&badid=';echo $badid;;echo '",datatype : "html",async:\'false\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('badword_name').L('exists');echo '",onwait : "';echo L('connecting');echo '"}).defaultPassed();

$("#replaceword").formValidator({empty:true,onshow:"';echo L('badword_noreplace');echo '",onfocus:"';echo L("input").L('badword_replacename');echo '",oncorrect:"';echo L('format_right');echo '",onempty:"';echo L('badword_notreplace');echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('badword_replacename');echo '"});

})
</script>

<div class="pad_10">
<table cellpadding="2" cellspacing="1" class="table_form" width="100%">
<form action="?s=admin/badword/edit/badid/';echo $badid;echo '" method="post" name="myform" id="myform">
 	<tr> 
      <th width="20%">';echo L('badword_name');echo '</th>
      <td><input type="text" name="badword" id="badword" value="';echo $badword;echo '"></td>
    </tr>
    
    <tr> 
      <th width="20%">';echo L('badword_replacename');echo '</th>
      <td><input type="text" name="replaceword" id="replaceword" value="';echo $replaceword ;echo '" ></td>
    </tr>
    
    <tr> 
    <th width="20%">';echo L('badword_level');echo '</th>
    <td>
	<select size="1" id="info[level]" name="info[level]">
	';
if($level=='1'){
$level1 = "selected";
}else{
$level2 = "selected";
}
;echo '	<option ';echo $level1;;echo ' value="1">';echo L('badword_common');echo '</option>
	<option ';echo $level2;;echo ' value="2">';echo L('badword_dangerous');echo '</option> 
	
	</select>
	';echo L('badword_level_info');echo '	</td>
    </tr> 
	<input type="submit" name="dosubmit" id="dosubmit" value=" ';echo L('submit');echo ' " class="dialog"> 
	</form>
</table>
</div>
</body>
</html>';?>