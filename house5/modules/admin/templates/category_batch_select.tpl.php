<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<div class="pad-10">
<div class="bk10"></div>

<div class="table-list">
<table width="100%" cellspacing="0">

<form action="?s=admin/category/batch_edit" method="post" name="myform">
<tbody  height="200" class="nHover td-line">
	<tr> 
      <td align="left" rowspan="6">
	';echo L('category_batch_edit');;echo ' <font color="red">';echo L('category_manage');;echo '</font>
	<input type="radio" name="type" value="0" ';if($type==0) echo 'checked';;echo '><BR><BR>
	';echo L('category_batch_edit');;echo ' ';echo L('category_type_page');;echo '<input type="radio" name="type" value="1"  ';if($type==1) echo 'checked';;echo '>
	</td>
    </tr>
	<tr> 
      <td align="center" rowspan="6">
<select name=\'catids[]\' id=\'catids\'  multiple="multiple"  style="height:300px;width:400px" title="';echo L('push_ctrl_to_select','','content');;echo '">
';echo $string;;echo '</select></td>
      <td>
	  <input type="hidden" value="';echo $type;;echo '">
	  <input type="submit" value="';echo L('submit');;echo '">
	  </td>
    </tr>

	</tbody>
	</form>
</table>

</div>
</div>
<script language="JavaScript">
<!--
	window.top.$(\'#display_center_id\').css(\'display\',\'none\');
//-->
</script>';?>