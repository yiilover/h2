<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');
;echo '<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#sitename").formValidator({onshow:"';echo L('input').L('copyfrom_name');;echo '",onfocus:"';echo L('input').L('copyfrom_name');;echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('copyfrom_name');;echo '"}).defaultPassed();
		$("#siteurl").formValidator({onshow:"';echo L('input').L('copyfrom_url');;echo '",onfocus:"';echo L('input').L('copyfrom_url');;echo '",empty:false}).inputValidator({onerror:"';echo L('input').L('copyfrom_url');;echo '"}).regexValidator({regexp:"^http://",onerror:"';echo L('copyfrom_url_tips');;echo '"}).defaultPassed();
	})
//-->
</script>

<div class="pad_10">
<form action="?s=admin/copyfrom/edit" method="post" name="myform" id="myform" >
<table width="100%" cellpadding="2" cellspacing="1" class="table_form">
	<tr> 
      <th width="60">';echo L('copyfrom_name');;echo ' :</th>
      <td><input type="text" name="info[sitename]" id="sitename" size="25" value="';echo $sitename;;echo '"></td>
    </tr>
	<tr> 
      <th>';echo L('copyfrom_url');echo ' :</th>
      <td><input type="text" name="info[siteurl]" id="siteurl" size="25" value="';echo $siteurl;;echo '"></td>
    </tr> 
	<tr> 
      <th>';echo L('copyfrom_logo');echo ' :</th>
      <td>';echo form::images('info[thumb]','thumb',$thumb,'admin');echo '</td>
    </tr>
		<input type="hidden" name="id" value="';echo $id;echo '">
	  <input type="submit" name="dosubmit" id="dosubmit" class="dialog" value=" ';echo L('submit');echo ' ">

</table> 
 	</form>
</div>
</body>
</html>';?>