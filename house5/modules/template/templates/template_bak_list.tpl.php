<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="bk15"></div>
<div class="pad_10">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
		<tr>
		<th>';echo L('time');echo '</th>
		<th>';echo L('who');echo '</th>
		<th width="150">';echo L('operations_manage');echo '</th>
		</tr>
        </thead>
        <tbody>
';
if(is_array($list)):
foreach($list as $v):
;echo '<tr>
<td align="center">';echo format::date($v['creat_at'],1);echo '</td>
<td align="center">';echo $v['username'];echo '</td>
<td align="center"><a href="?s=template/template_bak/restore&id=';echo $v['id'];echo '&style=';echo $this->style;echo '&dir=';echo $this->dir;echo '&filename=';echo $this->filename;echo '" onclick="return confirm(\'';echo L('are_you_sure_you_want_to_restore');echo '\')">';echo L('restore');echo '</a> | <a href="?s=template/template_bak/del&id=';echo $v['id'];echo '&style=';echo $this->style;echo '&dir=';echo $this->dir;echo '&filename=';echo $this->filename;echo '" onclick="return confirm(\'';echo L('confirm',array('message'=>format::date($v['creat_at'],1)));echo '\')">';echo L('delete');echo '</a></td>
</tr>
';
endforeach;
endif;
;echo '</tbody>
</table>
</from>
</div>
</div>
<div id="pages">';echo $pages;echo '</div>
</body>
</html>';?>