<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
$show_header = $show_validator = $show_scroll = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-10">
<h2 class="title-1 f14 lh28">(';echo $r['name'];;echo ')';echo L('get_code');echo '</h2>
<div class="bk10"></div>
<div class="explain-col">
<strong>';echo L('explain');echo '£º</strong>
</div>
<div class="bk10"></div>

<fieldset>
	<legend>';echo L('one_way');echo '</legend>
<input name="jscode1" id="jscode1" value=\'{template "ssi","ssi_';echo $r['id'];echo '"}\' style="width:410px"> <input type="button" onclick="$(\'#jscode1\').select();document.execCommand(\'Copy\');" value="';echo L('copy_code');echo '" class="button" style="width:114px">
</fieldset>
</div>
</body>
</html>';?>