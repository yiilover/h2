<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');
;echo '<script type="text/javascript">
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		
	})
</script>

<div class="pad_10">
<table cellpadding="2" cellspacing="1" class="table_form" width="100%">
<form action="?s=admin/search_keyword/edit/keywordid/';echo $keywordid;echo '" method="post" name="myform" id="myform">
	<tr> 
      <th width="25%">';echo L('search_word_name');;echo ' :</th>
      <td><input type="text" name="info[keyword]"  size="20" value="';echo $keyword;echo '"></td>
    </tr>
	<tr> 
      <th>';echo L('search_word_pinyin');;echo ' :</th>
      <td><input type="text" name="info[pinyin]" value="';echo $pinyin;echo '" ></td>
    </tr> 
	<tr> 
      <th>';echo L('search_word_nums');;echo ' :</th>
      <td><input type="text" name="info[searchnums]" value="';echo $searchnums;echo '" ></td>
    </tr> 
	<tr> 
      <th>';echo L('search_word_some');;echo ' :</th>
      <td><input type="text" name="info[data]" value="';echo $data;echo '"></td>
    </tr> 

	<input type="submit" name="dosubmit" id="dosubmit" value=" ';echo L('submit');echo ' " class="dialog"> 
	</form>
</table>
</div>
</body>
</html>';?>