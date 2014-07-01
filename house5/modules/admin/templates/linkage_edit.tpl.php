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
<form name="myform" action="?s=admin/linkage/edit" method="post" id="myform">
<table width="100%" class="table_form contentWrap">
';
if(isset($_GET['parentid'])) {;echo '<tr>
  <td>';echo L('linkage_parent_menu');echo '</td>
  <td>
';echo form::select_linkage($info['keyid'],0,'info[parentid]','parentid',L('cat_empty'),$_GET['parentid']);echo '  </td>
  </tr>
  ';};echo '<tr>
<td>';echo L('linkage_name');echo '</td>
<td>
<input type="text" name="info[name]" value="';echo $name;echo '" class="input-text" id="name" size="30"></input>
</td>
</tr>

<tr>
<td>';echo L('linkage_desc');echo '</td>
<td>
<textarea name="info[description]" rows="2" cols="20" id="description" class="inputtext" style="height:45px;width:300px;">';echo $description;echo '</textarea>
</td>
</tr>
';
if(isset($_GET['parentid'])) {;echo '<input type="hidden" name="info[siteid]" value="';echo $this->_get_belong_siteid($keyid);echo '" class="input-text" id="name" size="30"></input>
<input type="hidden" name="linkageid" value="';echo $linkageid;echo '">
 <input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="dialog" id="dosubmit">
';}else {;echo '<tr>
<td>';echo L('linkage_menu_style');echo '</td>
<td>
<input name="info[style]" value="0" type="radio" ';if($style==0) {;echo 'checked';};echo '>&nbsp;';echo L('linkage_option_style');echo '&nbsp;&nbsp;
<input name="info[style]" value="1" type="radio" ';if($style==1) {;echo 'checked';};echo '>&nbsp;';echo L('linkage_pop_style');echo '&nbsp;&nbsp;
<input name="info[style]" value="2" type="radio" ';if($style==2) {;echo 'checked';};echo '>&nbsp;';echo L('linkage_select_style');echo ',';echo L('linkage_select_show');echo '<input type="text" name="info[level]" value="';echo $setting['level'];echo '" class="input-text" id="level" size="5"></input>';echo L('linkage_select_level');echo '</td>
</tr>
<tr>
<td>';echo L('site_select');echo '</td>
<td>
';echo form::select($sitelist,$siteid,'name="info[siteid]"',L('all_site'));echo '<input type="hidden" name="linkageid" value="';echo $linkageid;echo '">
	<input type="hidden" name="info[keyid]" value="';echo $keyid;echo '">
    <input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="dialog" id="dosubmit">
</td>
</tr>
  ';};echo '</table>
    
</form>
</div>
</div>
</body>
</html>
';?>