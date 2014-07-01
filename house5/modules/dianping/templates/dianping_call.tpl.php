<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
$show_header = $show_validator = $show_scroll = 1;
include $this->admin_tpl('header','admin');
;echo '<div class="pad-10">
<h2 class="title-1 f14 lh28">(';echo $r['name'];;echo ') ';echo L('dianping_call_type');echo '</h2>
<div class="bk10"></div>
<div class="explain-col">
<strong>';echo L('call_info');echo '</strong><br />
';echo L('call_infos');echo '</div>
<div class="bk10"></div>
 
<fieldset>
	<legend>';echo L('iframe_call');echo '</legend>
    ';echo L('vote_phpcall');echo '<br />
<input name="jscode1" id="jscode1" value=\'<iframe  onload="Javascript:SetCwinHeight()" src="{APP_PATH}index.php?s=dianping/index/init&dianpingid={id_encode(ROUTE_M."_$catid",$id,$siteid)}&iframe=1&dianping_type=';echo $r['id'];echo '&module={ROUTE_M}&modelid={$modelid}&is_checkuserid=1&contentid={$id}" width="100%" height="1" id="dianping_iframeid" frameborder="0" scrolling="no"></iframe>\' style="width:410px"> <input type="button" onclick="$(\'#jscode1\').select();document.execCommand(\'Copy\');" value="';echo L('copy_code_use');echo '" class="button" style="width:114px">
</fieldset>
<div class="bk10"></div> 

</div>
</body>
</html>';?>