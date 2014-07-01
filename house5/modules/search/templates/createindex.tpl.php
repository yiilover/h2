<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<div class="pad-10">
<div class="explain-col">
<form action="" method="get">
<input type="hidden" name="s" value="search/search_admin/createindex">
<input type="hidden" name="menuid" value="909">
';echo L('re_index_note');;echo ' <input type="text" name="pagesize" value="100" size="5"> ';echo L('tiao');;echo ' <input type="submit" name="dosubmit" class="button" value="';echo L('confirm_reindex');;echo '"></form>
</div>

<script language="JavaScript">
<!--
	window.top.$(\'#display_center_id\').css(\'display\',\'none\');
//-->
</script>';?>