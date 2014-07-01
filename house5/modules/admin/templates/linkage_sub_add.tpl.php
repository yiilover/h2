<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<script type="text/javascript">
  $(document).ready(function() {
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#name").formValidator({onshow:"';echo L('input').L('linkage_name').L('linkage_name_desc');echo '",onfocus:"';echo L('linkage_name').L('not_empty');echo '"}).inputValidator({min:1,max:999,onerror:"';echo L('linkage_name').L('not_empty');echo '"});
  })
</script>
<div class="pad_10">
<div class="common-form">
<form name="myform" action="?s=admin/linkage/public_sub_add" method="post" id="myform">
<table width="100%" class="table_form contentWrap">
<tr>
<td>';echo L('level_menu');echo '</td>
<td>
';echo $list;echo '</td>
</tr>

<tr>
<td>';echo L('linkage_name');echo '</td>
<td>
<textarea name="info[name]" rows="2" cols="20" id="name" class="inputtext" style="height:90px;width:150px;">';echo $name;echo '</textarea>
</td>
</tr>

<tr>
<td>';echo L('menu_description');echo '</td>
<td>
<textarea name="info[description]" rows="2" cols="20" id="description" class="inputtext" style="height:45px;width:300px;">';echo $description;echo '</textarea>
</td>
</tr>
</table>

    <div class="bk15"></div>
    <input type="hidden" name="keyid" value="';echo $keyid;echo '">
    <input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="dialog" id="dosubmit">
</form>
</div>
</div>
</body>
</html>
';?>