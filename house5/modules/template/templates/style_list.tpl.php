<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10">
<div class="table-list">
<form action="?s=template/style/updatename" method="post">
    <table width="100%" cellspacing="0">
        <thead>
		<tr>
		<th width="80">';echo L("style_identity");echo '</th>
		<th>';echo L("style_chinese_name");echo '</th>
		<th>';echo L("author");echo '</th>
		<th>';echo L("style_version");echo '</th>
		<th>';echo L("status");echo '</th>
		<th width="150">';echo L('operations_manage');echo '</th>
		</tr>
        </thead>
<tbody>
';
if(is_array($list)):
foreach($list as $v):
;echo '<tr>
<td width="80" align="center">';echo $v['dirname'];echo '</td>
<td align="center"><input type="text" name="name[';echo $v['dirname'];echo ']" value="';echo $v['name'];echo '" /></td>
<td align="center">';if($v['homepage']) {echo  '<a href="'.$v['homepage'].'" target="_blank">';};echo '';echo $v['author'];echo '';if($v['homepage']) {echo  '</a>';};echo '</td>
<td align="center">';echo $v['version'];echo '</td>
<td align="center">';if($v['disable']){echo L('icon_locked');}else{echo L("icon_unlock");};echo '</td>
<td align="center"  width="150"><a href="?s=template/style/disable&style=';echo $v['dirname'];echo '">';if($v['disable']){echo L("enable");}else{echo L('disable');};echo '</a> | <a href="?s=template/file/init&style=';echo $v['dirname'];echo '">';echo L("detail");echo '</a> | <a href="?s=template/style/export&style=';echo $v['dirname'];echo '">';echo L('export');echo '</a></td>
</tr>
';
endforeach;
endif;
;echo '</tbody>
</table>
<div class="btn"><input type="submit" class="button" name="dosubmit" value="';echo L('submit');echo '" /></div> 
</form>
</div>
</div>
<div id="pages">';echo $pages;echo '</div>
</body>
</html>';?>