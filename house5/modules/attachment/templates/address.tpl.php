<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','attachment');
;echo '<div class="pad-lr-10">
<div class="explain-col">
';echo L('attachment_address_replace_msg');echo '</div>
<form action="index.php?s=attachment/address/update/h5_hash/';echo $_SESSION['h5_hash'];;echo '" method="post" onsubmit="return confirm(\'';echo L('form_submit_confirm');;echo '\')">
<table width="100%"  class="table_form">
  <tr>
    <th width="100">';echo L('old_attachment_address');echo '£º</th>
    <td class="y-bg"><input type="text" class="input-text" name="old_attachment_path" id="old_attachment_path" size="40" value="';echo h5_base::load_config('system','upload_url');echo '" /> ';echo L('old_attachment_address_msg');echo '</td>
  </tr>
  <tr>
    <th>';echo L('new_attachment_address');echo '£º</th>
    <td class="y-bg"><input type="text" class="input-text" name="new_attachment_path" id="new_attachment_path" size="40" value="" /></td>
  </tr>
   <tr>
    <th></th>
    <td class="y-bg"><input type="submit" value="';echo L('submit');echo '" class="button"></td>
  </tr>
</table>
</form>
</div>
</body>
</html>
<script type="text/javascript">
<!--
//-->
</script>';?>