<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '
<div class="pad-lr-10">
<div class="table-list">

<table width="100%" cellspacing="0">
        <thead>
            <tr>
			<th align="left" width="200px">';echo L('filedname');echo '</th>
			<th align="left" >';echo L('value');echo '</th>
            </tr>
        </thead>
    <tbody>
';
foreach($member_fieldinfo as $k=>$v) {
;echo '    <tr>
		<td align="left" width="200px">';echo $k;echo '</td>
		<td align="left">';echo $v;echo '</td>
    </tr>
';
}
;echo ' </tbody>
</table>

<div class="btn">
<input type="button" class="dialog" name="dosubmit" id="dosubmit" value="';echo L('goback');echo '" onclick="window.top.art.dialog({id:\'modelinfo\'}).close();"/>
</div> 
</div>
</div>
</body>
</html>';?>