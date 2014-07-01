<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<div class="pad-10">
<div class="explain-col">
';echo L('html_notice');;echo '
</div>
<div class="bk10"></div>

<div class="table-list">
<table width="100%" cellspacing="0">

<form action="?s=content/create_html/category" method="post" name="myform">
  <input type="hidden" name="dosubmit" value="1"> 
  <input type="hidden" name="type" value="lastinput"> 
<thead>
<tr>
<th align="center" width="386">';echo L('select_category_area');;echo '</th>
<th align="center">';echo L('select_operate_content');;echo '</th>
</tr>
</thead>
<tbody  height="200" class="nHover td-line">
	<tr> 
      <td align="center" rowspan="6">
<select name=\'catids[]\' id=\'catids\'  multiple="multiple"  style="height:200px;" title="';echo L('push_ctrl_to_select');;echo '">
<option value=\'0\' selected>';echo L('no_limit_category');;echo '</option>
';echo $string;;echo '</select></td>
      <td><font color="red">';echo L('every_time');;echo ' <input type="text" name="pagesize" value="10" size="4"> ';echo L('information_items');;echo '</font></td>
    </tr>
	<tr> 
      <td>';echo L('update_all');;echo ' <input type="button" name="dosubmit1" value="';echo L('submit_start_update');;echo ' " class="button" onclick="myform.type.value=\'all\';myform.submit();"></td>
    </tr>
	<tr> 
      <td></td>
    </tr>
	</tbody>
	</form>
</table>

</div>
</div>
<script language="JavaScript">
<!--
	window.top.$(\'#display_center_id\').css(\'display\',\'none\');
	function change_model(modelid) {
		window.location.href=\'?s=content/create_html/category/modelid/\'+modelid+\'/h5_hash/\'+h5_hash;
	}
//-->
</script>';?>