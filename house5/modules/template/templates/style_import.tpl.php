<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad-10">
<form action="?s=template/style/import" method="post" id="myform" enctype="multipart/form-data">
<div>
	<table width="100%"  class="table_form">
  <tr>
    <th width="80">';echo L('mode');echo '£º</th>
    <td class="y-bg"><input type="radio" name="type" value="1" checked /> ';echo L('upload_file');echo ' <input type="radio" name="type" value="2"/> ';echo L('enter_coad');echo '</td>
  </tr>
  <tbody id="upfile">
  <tr>
    <th width="80">';echo L('upload_file');echo '£º</th>
    <td class="y-bg"><input type="file" class="input-text" name="file"/> ';echo L('only_allowed_to_upload_txt_files');echo '</td>
  </tr>
  </tbody>
    <tbody id="code" style="display: none">
    <tr>
    <th width="80" valign="top">';echo L('enter_coad');echo '£º</th>
    <td class="y-bg"><textarea name="code" style="width:386px;height:178px;"></textarea></td>
  </tr>
    </tbody>
</table>
<div class="bk15"></div>
    <input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="';echo L('submit');echo '" />
</div>
</form>
</div>
<script type="text/javascript">
<!--
$(function(){$("input[type=\'radio\'][name=\'type\']").click(function(){
	if ($(this).val()==1) {
		$(\'#upfile\').show();
		$(\'#code\').hide();
	} else{
		$(\'#code\').show();
		$(\'#upfile\').hide();
	}
})})
//-->
</script>
</body>
</html>';?>