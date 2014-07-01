<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
$show_header = $show_validator = $show_scroll = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-10">
<h2 class="title-1 f14 lh28">(';echo $r['subject'];;echo ')';echo L('vote_call');echo '</h2>
<div class="bk10"></div>
<div class="explain-col">
<strong>';echo L('vote_call_info');echo '£º</strong><br />
';echo L('vote_call_infos');echo '</div>
<div class="bk10"></div>
 
<fieldset>
	<legend>';echo L('vote_call_1');echo '</legend>
    ';echo L('vote_phpcall');echo '<br />
<input name="jscode1" id="jscode1" value=\'<script language="javascript" src="';echo APP_PATH;;echo 'index.php?s=vote/index/show&action=js&subjectid=';echo $r['subjectid'];echo '&type=3"></script>\' style="width:410px"> <input type="button" onclick="$(\'#jscode1\').select();document.execCommand(\'Copy\');" value="';echo L('copy_code');echo '" class="button" style="width:114px">
</fieldset>
<div class="bk10"></div>
<fieldset>
	<legend>';echo L('vote_call_2');echo '</legend>
    ';echo L('vote_phpcall');echo '<br />
<input name="jscode2" id="jscode2" value=\'<script language="javascript" src="';echo APP_PATH;;echo 'index.php?s=vote/index/show&action=js&subjectid=';echo $r['subjectid'];echo '&type=2"></script>\' style="width:410px">
 <input type="button" onclick="$(\'#jscode2\').select();document.execCommand(\'Copy\');" value="';echo L('copy_code');echo '" class="button" style="width:114px">
</fieldset> 
<div class="bk10"></div>
<fieldset>
	<legend>';echo L('vote_jscall');echo '</legend>
    ';echo L('vote_jscall_info');echo '<br />
<input name="jscode2" id="jscode3" value=\'<script language="javascript" src="';echo APP_PATH;;echo 'caches/vote_js/vote_';echo $r['subjectid'];echo '.js"></script>\' style="width:410px">
 <input type="button" onclick="$(\'#jscode3\').select();document.execCommand(\'Copy\');" value="';echo L('copy_code');echo '" class="button" style="width:114px">
</fieldset> 
  

</div>
</body>
</html>';?>