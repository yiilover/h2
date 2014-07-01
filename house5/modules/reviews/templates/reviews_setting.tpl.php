<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '
<div class="pad-10">
<form action="?s=reviews/reviews_admin/setting" method="post" id="myform">
<fieldset>
	<legend>';echo L('reviews_module_configuration');echo '</legend>
	<table width="100%"  class="table_form">
    <tr>
    <th width="120">';echo L('comment_on_whether_to_allow_visitors');echo '£º</th>
    <td class="y-bg"><input type="checkbox" name="guest" value="1" ';if ($data['guest']){echo 'checked';};echo ' /></td>
  </tr>
    <tr>
    <th width="120">';echo L("check_comment");echo '£º</th>
    <td class="y-bg"><input type="checkbox" name="check" value="1" ';if ($data['check']){echo 'checked';};echo ' /></td>
  </tr>
    <tr>
    <th width="120">';echo L('whether_to_validate');echo '£º</th>
    <td class="y-bg"><input type="checkbox" name="code" value="1" ';if ($data['code']){echo 'checked';};echo ' /></td>
  </tr>
  <tr>
    <th width="120">';echo L('reviews_on_points_awards');echo '£º</th>
    <td class="y-bg"><input type="input" name="add_point" value="';echo  isset($data['add_point']) ?$data['add_point'] : '0';echo '" /> ';echo L('to_operate');echo '</td>
  </tr>
  <tr>
    <th width="120">';echo L('be_deleted_from_the_review_points');echo '£º</th>
    <td class="y-bg"><input type="input" name="del_point" value="';echo  isset($data['del_point']) ?$data['del_point'] : '0';echo '" /> ';echo L('to_operate');echo '</td>
  </tr>
</table>

<div class="bk15"></div>
<input type="submit" id="dosubmit" name="dosubmit" class="button" value="';echo L('submit');echo '" />
</fieldset>
</form>
</div>
</body>
</html>';?>