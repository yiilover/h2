<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#sitename").formValidator({onshow:"';echo L('input').L('mirrors_name');echo '",onfocus:"';echo L('mirrors_name').L('downserver_not_empty');echo '"}).inputValidator({min:1,max:999,onerror:"';echo L('downserver_name').L('downserver_not_empty');echo '"});
	$("#siteurl").formValidator({onshow:"';echo L('mirror_address');echo '",onfocus:"';echo L('mirror_address');echo '"}).inputValidator({onerror:"';echo L('downserver_error');echo '"}).regexValidator({regexp:"([a-zA-Z]+):\\/\\/(.+)[^\\/]$",onerror:"';echo L('downserver_error');echo '"});	
})
//-->
</script>
<div class="pad_10">
<div class="common-form">
<form name="myform" action="?s=admin/downservers/edit" method="post" id="myform">
<input type="hidden" name="id" value="';echo $id;echo '"></input>
<table width="100%" class="table_form">
<tr>
<td  width="80">';echo L('mirrors_name');echo '</td> 
<td><input type="text" name="info[sitename]" class="input-text" value="';echo $sitename;echo '" id="sitename"></input></td>
</tr>
<tr>
<td  width="80">';echo L('mirror_address');echo '</td> 
<td><input type="text" name="info[siteurl]" class="input-text" value="';echo $siteurl;echo '" id="siteurl" size="40"></input></td>
</tr> 
<tr>
<td>';echo L('site_select');echo '</td>
<td>';echo form::select($sitelist,$siteid,'name="info[siteid]"',$default);echo '</td>
</tr> 
</table>
    <input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="dialog" id="dosubmit">
</form>
</div>
</div>
</body>
</html>




';?>