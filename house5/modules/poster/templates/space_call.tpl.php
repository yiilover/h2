<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
$show_header = $show_validator = $show_scroll = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-10">
<h2 class="title-1 f14 lh28">(';echo $r['name'];;echo ')';echo L('get_code_space');echo '</h2>
<div class="bk10"></div>
<div class="explain-col">
<strong>';echo L('explain');echo '£º</strong><br />
';echo L('notice');echo '</div>
<div class="bk10"></div>
';if($r['type']=='code') {;echo '<fieldset>
	<legend>';echo L('one_way');echo '</legend>
    ';echo L('js_code');echo '<font color=\'red\'>';echo L('this_way_stat_show');echo '</font><br />
<input name="jscode1" id="jscode1" value=\'';echo $r['path'];echo '\' style="width:416px"> <input type="button" onclick="$(\'#jscode1\').select();document.execCommand(\'Copy\');" value="';echo L('copy_code');echo '" class="button" style="width:114px">
</fieldset>
';}else {;echo '<fieldset>
	<legend>';echo L('one_way');echo '</legend>
    ';echo L('js_code');echo '<font color=\'red\'>';echo L('this_way_stat_show');echo '</font><br />
<input name="jscode1" id="jscode1" value=\'<script language="javascript" src="{APP_PATH}index.php?s=poster/index/show_poster&id=';echo $r['spaceid'];echo '"></script>\' style="width:410px"> <input type="button" onclick="$(\'#jscode1\').select();document.execCommand(\'Copy\');" value="';echo L('copy_code');echo '" class="button" style="width:114px">
</fieldset>
<div class="bk10"></div>
<fieldset>
	<legend>';echo L('second_code');echo '</legend>
    ';echo L('js_code_html');echo '<br />
<input name="jscode2" id="jscode2" value=\'<script language="javascript" src="{APP_PATH}caches/';echo $r['path'];echo '"></script>\' style="width:410px">
 <input type="button" onclick="$(\'#jscode2\').select();$(\'#jscode2\').val().execCommand(\'Copy\');" class="button"  style="width:114px" value="';echo L('copy_code');echo '">
</fieldset>
';};echo '</div>
</body>
</html>';?>