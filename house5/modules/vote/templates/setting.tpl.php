<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<form method="post" action="?s=vote/vote/setting">
<table width="100%" cellpadding="0" cellspacing="1" class="table_form">
 
	<tr>
		<th width="200">';echo L('vote_style');echo '£º</th>
		<td>
		';echo form::select($template_list,$default_style,'name="setting[default_style]" id="style" onchange="load_file_list(this.value)"',L('please_select'));echo '		 </td>
	</tr>
	
	<tr>
		<th>';echo L('template');echo '£º</th>
		<td id="show_template">
		';echo form::select_template($default_style,'vote',$vote_tp_template,'name="setting[vote_tp_template]"','vote_tp');;echo '		</td>
	</tr>
	
	<tr>
		<th>';echo L('default_guest');echo '£º</th>
		<td><input type=\'radio\' name=\'setting[allowguest]\' value=\'1\' ';if($allowguest == 1) {;echo 'checked';};echo '> ';echo L('yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=\'radio\' name=\'setting[allowguest]\' value=\'0\' ';if($allowguest == 0) {;echo 'checked';};echo '> ';echo L('no');echo '</td>
	</tr>
	<tr>
		<th>';echo L('default_enabled');echo '£º</th>
		<td><input type=\'radio\' name=\'setting[enabled]\' value=\'1\' ';if($enabled == 1) {;echo 'checked';};echo '> ';echo L('yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=\'radio\' name=\'setting[enabled]\' value=\'0\' ';if($enabled == 0) {;echo 'checked';};echo '> ';echo L('no');echo '</td>
	</tr>
	<tr>
		<th>';echo L('interval');echo '£º</th>
		<td>
		<input type="text" name="setting[interval]" value="';echo $interval;;echo '" size=\'5\' /> ';echo L('more_ip');echo '£¬<font color=red>0</font> ';echo L('one_ip');echo '		</td>
	</tr>
	<tr>
		<th>';echo L('credit');echo '£º</th>
		<td>
		<input type="text" name="setting[credit]" value="';echo $credit;echo '" size=\'5\' />
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="dosubmit" id="dosubmit" value=" ';echo L('confirm');echo '" class="button">&nbsp;<input type="reset" value=" ';echo L('reset');echo ' " class="button"></td>
	</tr>
</table>
</form>
</body>
</html>
<script language="javascript">
function load_file_list(id) {
	$.getJSON(\'?s=admin/category/public_tpl_file_list&style=\'+id+\'&module=vote&templates=vote_tp&name=setting&h5_hash=\'+h5_hash, function(data){$(\'#show_template\').html(data.vote_tp_template);});
}
</script>';?>