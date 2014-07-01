<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
$show_header = 1;
include $this->admin_tpl('header','admin');
;echo '<form method="post" action="?s=formguide/formguide/setting" id="myform" name="myform">
<table width="100%" cellpadding="0" cellspacing="1" class="table_form">
	<tr>
		<th width="130">';echo L('allows_more_ip');echo '£º</th>
		<td><input type=\'radio\' name=\'setting[allowmultisubmit]\' value=\'1\' ';if($allowmultisubmit == 1) {;echo 'checked';};echo '> ';echo L('yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=\'radio\' name=\'setting[allowmultisubmit]\' value=\'0\' ';if($allowmultisubmit == 0) {;echo 'checked';};echo '> ';echo L('no');echo '</td>
	</tr>
	<tr id="setting" style="';if ($allowmultisubmit == 0) {;echo 'dispaly:none';};echo '">
		<th width="130">';echo L('interval');echo '£º</th>
		<td><input type="text" value="';echo $interval;echo '" name="setting[interval]" size="10" class="input-text"> ';echo L('minute');echo '</td>
	</tr>
	<tr>
		<th>';echo L('allowunreg');echo '£º</th>
		<td><input type=\'radio\' name=\'setting[allowunreg]\' value=\'1\' ';if($allowunreg == 1) {;echo 'checked';};echo '> ';echo L('yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=\'radio\' name=\'setting[allowunreg]\' value=\'0\' ';if($allowunreg == 0) {;echo 'checked';};echo '> ';echo L('no');echo '</td>
	</tr>
	<tr>
		<th>';echo L('mailmessage');echo '£º</th>
		<td><textarea cols="50" rows="6" id="mailmessage" name="setting[mailmessage]">';echo $mailmessage;echo '</textarea></td>
	</tr>
	<tr style="display:none">
		<td>&nbsp;</td>
		<td><input type="submit" name="dosubmit" id="dosubmit" class="dialog" value=" ';echo L('ok');echo ' ">&nbsp;<input type="reset" class="dialog" value=" ';echo L('clear');echo ' "></td>
	</tr>
</table>
</form>
</body>
</html>
<script type="text/javascript">
$("input:radio[name=\'setting[allowmultisubmit]\']").click(function (){
	if($("input:radio[name=\'setting[allowmultisubmit]\'][checked]").val()==0) {
		$("#setting").hide();
	} else if($("input:radio[name=\'setting[allowmultisubmit]\'][checked]").val()==1) {
		$("#setting").show();
	}
});
</script>';?>