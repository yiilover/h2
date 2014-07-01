<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<div class="pad-10">

<div class="content-menu ib-a blue line-x"><a href="?s=content/content/init/catid/46" class=on><em>';echo L('remove');;echo '</em></a> 
</div>
<div class="bk10"></div>
<form action="?s=content/content/remove" method="post" name="myform">
<div class="table-list">
<table width="100%" cellspacing="0">
<thead>
<tr>
<th align="center" width="50%">';echo L('from_where');;echo '</th>
<th align="center" width="50%">';echo L('move_to_categorys');;echo '</th>
</tr>
</thead>
<tbody  height="200" class="nHover td-line">
	<tr> 
      <td align="center" rowspan="6">
		<input type="radio" name="fromtype" value="0" checked id="fromtype_1" onclick="if(this.checked){$(\'#frombox_1\').show();$(\'#frombox_2\').hide();}">从指定ID：
		<input type="radio" name="fromtype" value="1"  id="fromtype_2" onclick="if(this.checked){$(\'#frombox_1\').hide();$(\'#frombox_2\').show();}">从指定栏目
		<div id="frombox_1" style="display:;">
		<textarea name="ids" style="height:280px;width:350px;">';echo $ids;;echo '</textarea>
		<br/>
		';echo L('move_tips');;echo '		</div>
		<div id="frombox_2" style="display:none;">
		<select name="fromid[]" id="fromid"  multiple  style="height:300px;width:350px;">
		<option value=\'0\' style="background:#F1F3F5;color:blue;">';echo L('from_category');;echo '</option>
		';echo $source_string;;echo '		</select>
		<br>
		<font color="red">Tips:</font>';echo L('ctrl_source_select');;echo '		</div>
	</td>
    </tr>
	<tr> 
      <td align="center" rowspan="6"><br>
      <select name="tocatid" id="tocatid"  size="2"  style="height:300px;width:350px;">
<option value=\'0\' style="background:#F1F3F5;color:blue;">';echo L('move_to_categorys');;echo '</option>
';echo $string;;echo '</select>
	</td>
    </tr>
	</tbody>

</table>

</div>
<div class="btn">
<input type="submit" class="button" value="';echo L('submit');;echo '" name="dosubmit"/>
</div>
</form>
</div>';?>