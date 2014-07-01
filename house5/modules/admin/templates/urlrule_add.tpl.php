<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');
;echo '<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#file").formValidator({onshow:"';echo L('input').L('urlrule_file');echo '",onfocus:"';echo L('input').L('urlrule_file');echo '"}).regexValidator({regexp:"^([a-zA-Z0-9]|[_]){0,20}$",onerror:"';echo L('enter_the_correct_catname');;echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('urlrule_file');echo '"});
		$("#example").formValidator({onshow:"';echo L('input').L('urlrule_example');echo '",onfocus:"';echo L('input').L('urlrule_example');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('urlrule_example');echo '"});
		$("#urlrule").formValidator({onshow:"';echo L('input').L('urlrule_url');echo '",onfocus:"';echo L('input').L('urlrule_url');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('urlrule_url');echo '"});

	})
//-->
</script>
<style type="text/css">
.input-botton {
	border:none;
	border-bottom:1px dotted #E1A035;
	background:none;
}
</style>
<div class="pad_10">
<table width="100%" cellpadding="2" cellspacing="1" class="table_form">
<form action="?s=admin/urlrule/add" method="post" name="myform" id="myform">
	<tr> 
      <th width="20%">';echo L('urlrule_file');echo ' :</th>
      <td><input type="text" name="info[file]" id="file" size="20"></td>
    </tr>
	<tr> 
      <th width="20%">';echo L('urlrule_module');echo ' :</th>
      <td>';echo form::select($modules,'content',"name='info[module]' id='module'");;echo '</td>
    </tr>
	<tr> 
      <th width="20%">';echo L('urlrule_ishtml');echo ' :</th>
      <td>
	   <input type="radio" value="1" name="info[ishtml]" />';echo L('yes');;echo '        <input type="radio" value="0" name="info[ishtml]" checked="checked" />';echo L('no');;echo '	</td>
    </tr>
	<tr> 
      <th width="20%">';echo L('urlrule_example');echo ' :</th>
       <td><input type="text" name="info[example]" id="example" size="70"></td>
    </tr>
	<tr> 
      <th width="20%">';echo L('urlrule_url');echo ' :</th>
       <td><input type="text" name="info[urlrule]" id="urlrule" size="70">
</td>
    </tr>
	<tr> 
      <th width="20%">';echo L('urlrule_func');echo ' :</th>
       <td>';echo L('complete_part_path');;echo '£º <input type="text" name="f1" value="{$categorydir}" size="15" class="input-botton">£¬';echo L('category_path');;echo '£º<input type="text" name="f1" value="{$catdir}" size="10" class="input-botton">
	   <div class="bk6"></div>

';echo L('year');;echo '£º<input type="text" name="f1" value="{$year}" size="7" class="input-botton"> ';echo L('month');;echo '£º<input type="text" name="f1" value="{$month}" size="9" class="input-botton">£¬';echo L('day');;echo '£º<input type="text" name="f1" value="{$day}" size="7" class="input-botton"> ID£º<input type="text" name="f1" value="{$id}" size="4" class="input-botton">£¬ ';echo L('paging');;echo '£º<input type="text" name="f1" value="{$page}" size="7" class="input-botton">
	</td>
    </tr>
	  <input type="submit" name="dosubmit" id="dosubmit" class="dialog" value=" ';echo L('submit');echo ' ">
	</form>
</table> 

</div>
</body>
</html>';?>