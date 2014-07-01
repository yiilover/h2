<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
$show_header = 1;
include $this->admin_tpl('header','admin');
;echo '<form method="post" action="?s=poster/space/public_tempate_setting" name="myform" id="myform">
<table class="table_form" width="100%" cellspacing="0">
<tbody>
	<tr>
		<th width="200"><strong>';echo L('template_file_name');echo '£º</strong></th>
		<td>';echo $template;echo '<input type="hidden" value="';echo $template;echo '" name="template"></td>
	</tr>
	<tr>
		<th><strong>';echo L('name_cn');echo '£º</strong></th>
		<td><input type="text" size="20" value="';echo $info['name'];echo '" name="info[name]"></td>
	</tr>
	<tr>
		<th><strong>';echo L('show_this_param');echo '£º</strong></th>
		<td><label><input type="radio" value="align"';if ($info['align']=='align'){;echo ' checked';};echo ' name="info[align]" onclick="$(\'#choose_select\').show();"> ';echo L('lightbox');echo '</label> <label><input type="radio" value="scroll"';if ($info['align']=='scroll'){;echo ' checked';};echo ' name="info[align]" onclick="$(\'#choose_select\').show();"> ';echo L('rolling');echo '</label></td>
	</tr>
	<tr id="choose_select" style="display:';if ($info['align']=='') {;echo 'none';};echo '">
		<th><strong>';echo L('this_param_selected');echo '£º</strong></th>
		<td><label><input type="radio" value="1" name="info[select]"';if(!isset($info) ||$info['select']==1) {;echo ' checked';};echo '> ';echo L('yes');echo '</label> <label><input type="radio" value="0" name="info[select]"';if(!isset($info) ||$info['select']==0) {;echo ' checked';};echo '> ';echo L('no');echo '</label></td>
	</tr>
	<tr>
		<th><strong>';echo L('is_set_space');echo '£º</strong></th>
		<td><input type="radio" value="1" name="info[padding]"';if(!isset($info) ||$info['padding']==1) {;echo ' checked';};echo '> ';echo L('yes');echo ' <input type="radio" value="0" name="info[padding]"';if(!isset($info) ||$info['padding']==0) {;echo ' checked';};echo '> ';echo L('no');echo '</td>
	</tr>
	<tr>
		<th><strong>';echo L('is_set_size');echo '£º</strong></th>
		<td><input type="radio" value="1" name="info[size]"';if(!isset($info) ||$info['size']==1) {;echo ' checked';};echo '> ';echo L('yes');echo ' <input type="radio" value="0" name="info[size]"';if(!isset($info) ||$info['size']==0) {;echo ' checked';};echo '> ';echo L('no');echo '</td>
	</tr>
	<tr>
		<th><strong>';echo L('space_poster');echo '£º</strong></th>
		<td><input type="radio" value="1" name="info[option]"';if(!isset($info) ||$info['option']==1) {;echo ' checked';};echo '> ';echo L('all_list');echo ' <input type="radio" value="0" name="info[option]"';if(!isset($info) ||$info['option']==0) {;echo ' checked';};echo '> ';echo L('only_one');echo '</td>
	</tr>
	<tr>
		<th><strong>';echo L('is_used_type');echo '£º</strong></th>
		<td><label><input type="checkbox" value="images" name="info[type][]"';if (is_array($info['type']) &&in_array('images',$info['type'])) {;echo ' checked';};echo '> ';echo L('photo');echo '</label> <label><input type="checkbox" value="flash" name="info[type][]"';if (is_array($info['type']) &&in_array('flash',$info['type'])) {;echo ' checked';};echo '> ';echo L('flash');echo '</label> <label><input type="checkbox" value="text" name="info[type][]"';if (is_array($info['type']) &&in_array('text',$info['type'])) {;echo ' checked';};echo '> ';echo L('title');echo '</label></td>
	</tr>
	<tr>
		<th><strong>';echo L('max_add_param');echo '£º</strong></th>
		<td><input type="text" size="10" value="';echo $info['num'];echo '" name="info[num]"></td>
	</tr>
	</tbody>
	</table>
<div class="bk15" >';if ($info['iscore']) {;echo '<input type="hidden" name="info[iscore]" value="1">';}else {;echo '<input type="submit" name="dosubmit" id="dosubmit" class="dialog" value=" ';echo L('ok');echo ' " >&nbsp;<input type="reset" value=" ';echo L('clear');echo ' " class=\'dialog\'>';};echo '	</div>
</form>
</body>
</html>';?>