<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '
<div style="padding: 200px 0px 0px 100px;">';echo L('click_copy_code');echo '£º<textarea ondblclick="copy_text(this)" style="width: 400px;height:30px" />';echo htmlspecialchars($tag);echo '</textarea><div>

<script type="text/javascript">
<!--
function copy_text(matter){

	//alert(matter);
	//window.top.art.dialog({id:\'edit_file\'}).call(matter);
	//parent.add.call(matter);
	matter.select();

	js1=matter.createTextRange();

	js1.execCommand("Copy");

	alert(\'';echo L('copy_code');;echo '\');
}
//-->
</script>';?>