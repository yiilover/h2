<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<script type="text/javascript">
  $(document).ready(function() {
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#name").formValidator({onshow:"';echo L('input').L('linkage_name');echo '",onfocus:"';echo L('linkage_name').L('not_empty');echo '"}).inputValidator({min:1,max:999,onerror:"';echo L('linkage_name').L('not_empty');echo '"});
  })
</script>
<div class="pad_10">
<div class="common-form">
<form name="myform" action="?s=admin/linkage/add" method="post" id="myform">
<table width="100%" class="table_form contentWrap">
<tr>
<td>';echo L('linkage_name');echo '</td>
<td>
<input type="text" name="info[name]" value="';echo $name;echo '" class="input-text" id="name" size="30"></input>
</td>
</tr>

<tr>
<td>';echo L('menu_description');echo '</td>
<td>
<textarea name="info[description]" rows="2" cols="20" id="description" class="inputtext" style="height:45px;width:300px;">';echo $description;echo '</textarea>
</td>
</tr>

<tr>
<td>';echo L('menu_style');echo '</td>
<td>
<input name="info[style]" value="0" checked="checked" type="radio">&nbsp;';echo L('drop_down_style');echo '&nbsp;&nbsp;<input name="info[style]" value="1" type="radio">&nbsp;';echo L('pop_style');echo '</td>
</tr>

<tr>
<td>';echo L('sites');echo '</td>
<td>
';echo form::select($sitelist,'','name="info[siteid]"',L('all_sites'));echo '</td>
</tr>
</table>

    <div class="bk15"></div>
    <input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="dialog" id="dosubmit">
</form>
</div>
</div>
</body>
</html>
';?>