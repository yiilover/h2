<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');
;echo '<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
	})
//-->
</script>
<div class="pad_10">
<table width="100%" cellpadding="2" cellspacing="1" class="table_form">
<form action="?s=admin/search_keyword/add" method="post" name="myform" id="myform">
	<tr> 
      <th width="25%">';echo L('search_word_name');;echo ' :</th>
      <td><input type="text" name="info[keyword]" id="word" size="20"></td>
    </tr>
	<tr> 
      <th>';echo L('search_word_pinyin');;echo ' :</th>
      <td><input type="text" name="info[pinyin]" value=""  id="pinyin"></td>
    </tr> 
	<tr> 
      <th>';echo L('search_word_nums');;echo ' :</th>
      <td><input type="text" name="info[searchnums]" value=""  id="searchnums"></td>
    </tr> 
	<tr> 
      <th>';echo L('search_word_some');;echo ' :</th>
      <td><input type="text" name="info[data]" value=""  id="data"></td>
    </tr> 
	  <input type="submit" name="dosubmit" id="dosubmit" class="dialog" value=" ';echo L('submit');echo ' ">
 	</form>
</table> 
</div>
</body>
</html>';?>