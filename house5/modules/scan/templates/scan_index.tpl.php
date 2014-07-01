<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '
<div class="pad-10">
<div class="common-form">
<form name="myform" action="?s=scan/index/public_update_config" method="post" id="myform" onsubmit="return check_form()">
	<table width="100%" class="table_form">
		<tr>
			<td width="80">';echo L('ravsingle');echo ':</td> 
			<td><ul id="file" style="list-style:none; height:200px;overflow:auto;width:300px;">
			';$dir = $file= '';foreach ($list as $v){
$filename = basename($v);
if (is_dir($v)) {
$dir .= '<li><input type="checkbox" name="dir[]" value="'.$v.'" '.(isset($scan['dir']) &&is_array($scan['dir']) &&!empty($scan['dir']) &&in_array($v,$scan['dir']) ?'checked':'').'><img src="'.IMG_PATH.'folder.gif"> '.$filename.'</li>';
}elseif (substr(strtolower($v),-3,3)=='php'){
$file .= '<li><input type="checkbox" name="dir[]" value="'.$v.'" '.(isset($scan['dir']) &&is_array($scan['dir']) &&!empty($scan['dir']) &&in_array($v,$scan['dir']) ?'checked':'').'><img src="'.IMG_PATH.'file.gif">'.$filename.'</li>';
}else {
continue;
}
}
echo $dir,$file;
;echo '</ul></td>
		</tr>
		<tr>
			<td>';echo L('file_type');echo ':</td> 
			<td><input type="text" name="info[file_type]" size="100"  class="input-text" value="';echo $scan['file_type'];echo '"></input></td>
		</tr>
		<tr>
			<td>';echo L('characteristic_function');echo ':</td> 
			<td><input type="text" name="info[func]" size="100" class="input-text" value="';echo $scan['func'];echo '"></input></td>
		</tr>
		<tr>
			<td>';echo L('characteristic_key');echo ':</td> 
			<td><input type="text" name="info[code]" size="100" class="input-text" value="';echo $scan['code'];echo '"></input></td>
		</tr>
		
		<tr>
			<td>';echo L('md5_the_mirror');echo ':</td>
			<td>
			';echo form::select($md5_file_list,$scan['md5_file'],'name="info[md5_file]"');echo '			</td>
		</tr>
	</table>
 
    <div class="bk15"></div>
    <input name="dosubmit" type="submit" id="dosubmit" value="';echo L('submit');echo '" class="button">
</form>
</div>
</div>

<script type="text/javascript">
function check_form() {
	var checked = 0;
	$("input[type=\'checkbox\'][name=\'dir[]\']").each(function(i,n){if ($(this).attr(\'checked\')==true) {checked = 1;}});
	if (checked) {
		return true;
	} else {
		alert(\'';echo L('please_select_the_content');echo '\');
		return false;
	}
}
</script>
</body>
</html>';?>