<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<form method="post" action="?s=link/link/setting">
<table width="100%" cellpadding="0" cellspacing="1" class="table_form"> 
 
	<tr>
		<th width="20%">';echo L('application_or_not');echo '£º</th>
		<td><input type=\'radio\' name=\'setting[is_post]\' value=\'1\' ';if($is_post == 1) {;echo 'checked';};echo '> ';echo L('yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=\'radio\' name=\'setting[is_post]\' value=\'0\' ';if($is_post == 0) {;echo 'checked';};echo '> ';echo L('no');echo '</td>
	</tr>
	<tr>
		<th>';echo L('code_or_not');echo '£º</th>
		<td><input type=\'radio\' name=\'setting[enablecheckcode]\' value=\'1\' ';if($enablecheckcode == 1) {;echo 'checked';};echo '> ';echo L('yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=\'radio\' name=\'setting[enablecheckcode]\' value=\'0\' ';if($enablecheckcode == 0) {;echo 'checked';};echo '> ';echo L('no');echo '</td>
	</tr>
	 
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="dosubmit" id="dosubmit" value=" ';echo L('ok');echo ' " class="button">&nbsp;</td>
	</tr>
</table>
</form>
</body>
</html>
 ';?>