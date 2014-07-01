<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<div class="pad_10">
<div class="common-form">
<form name="myform" action="?s=member/member_model/move" method="post" id="myform">
<input type="hidden" name="from_modelid" value="';echo $_GET['modelid'];echo '">
<fieldset>
	<legend>';echo L('move').L('model_member');echo '</legend>
	<div class="bk10"></div>
	<div class="explain-col">
		';echo L('move_member_model_alert');echo '	</div>
	<div class="bk10"></div>
	<table width="100%" class="table_form">
		<tr>
			<td width="120">';echo L('from_model_name');echo '</td> 
			<td>
				';echo $modellist[$_GET['modelid']];;echo '
			</td>
		</tr>
		<tr>
			<td width="120">';echo L('to_model_name');echo '</td> 
			<td>
				';echo form::select($modellist,0,'id="to_modelid" name="to_modelid"',L('please_select'));echo '			</td>
		</tr>
	</table>
</fieldset>

    <div class="bk15"></div>
    <input name="dosubmit" id="dosubmit" type="submit" value="';echo L('submit');echo '" class="dialog">
</form>
</div>
</div>
</body>
</html>';?>