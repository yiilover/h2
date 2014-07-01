<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad_10">
<div class="bk15"></div>

<div class="explain-col">
';echo L('card_msg');echo '</div>
<div class="bk15"></div>
';
if (empty($pic_url)) {
echo '<input type="button" class="button" value="'.L('apply_for_a_password_card').'" onclick="location.href=\'?s=admin/admin_manage/creat_card&userid='.$userid.'&h5_hash='.$_SESSION['h5_hash'].'\'">';
}else {
echo '<input type="button" class="button" value="'.L('the_password_card_binding').'" onclick="location.href=\'?s=admin/admin_manage/remove_card&userid='.$userid.'&h5_hash='.$_SESSION['h5_hash'].'\'"><div class="bk15"></div><img src="'.$pic_url.'">';
}
;echo '</div>
</body>
</html>
';?>