<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
$show_header = 1;
include $this->admin_tpl('header','admin');
;echo '<form method="post" action="?s=poster/space/setting" id="myform" name="myform">
<table width="100%" cellpadding="0" cellspacing="1" class="table_form">
	<tr>
		<th width="130">';echo L('ads_show_time');echo '</th>
		<td><input type=\'radio\' name=\'setting[enablehits]\' value=\'1\' ';if($enablehits == 1) {;echo 'checked';};echo '> ';echo L('yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=\'radio\' name=\'setting[enablehits]\' value=\'0\' ';if($enablehits == 0) {;echo 'checked';};echo '> ';echo L('no');echo '</td>
	</tr>
	<tr>
		<th>';echo L('upload_file_ext');echo '£º</th>
		<td><input name=\'setting[ext]\' type=\'text\' id=\'ext\' value=\'';echo $ext;echo '\' size=\'40\' maxlength=\'70\'></td>
	</tr>
	<tr>
		<th>';echo L('file_size');echo '£º</th>
		<td><input name=\'setting[maxsize]\' type=\'text\' id=\'maxsize\' value=\'';echo $maxsize;echo '\' size=\'12\'> M</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="dosubmit" id="dosubmit" class="dialog" value=" ';echo L('ok');echo ' ">&nbsp;<input type="reset" class="dialog" value=" ';echo L('clear');echo ' "></td>
	</tr>
</table>
</form>
</body>
</html>
';?>