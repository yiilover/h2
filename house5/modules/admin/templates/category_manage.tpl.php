<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<form name="myform" action="?s=admin/category/listorder" method="post">
<div class="pad_10">
<div class="explain-col">
';echo L('category_cache_tips');;echo '£¬<a href="?s=admin/category/public_cache/menuid/43/module/admin">';echo L('update_cache');;echo '</a>
</div>
<div class="bk10"></div>
<div class="table-list">
    <table width="100%" cellspacing="0" >
        <thead>
            <tr>
            <th width="38">';echo L('listorder');;echo '</th>
            <th width="30">catid</th>
            <th >';echo L('catname');;echo '</th>
            <th align=\'left\' width=\'50\'>';echo L('category_type');;echo '</th>
            <th align=\'left\' width="50">';echo L('modelname');;echo '</th>
            <th align=\'center\' width="40">';echo L('items');;echo '</th>
            <th align=\'center\' width="30">';echo L('vistor');;echo '</th>
            <th align=\'center\' width="80">';echo L('domain_help');;echo '</th>
			<th >';echo L('operations_manage');;echo '</th>
            </tr>
        </thead>
    <tbody>
    ';echo $categorys;;echo '    </tbody>
    </table>

    <div class="btn">
	<input type="hidden" name="h5_hash" value="';echo $_SESSION['h5_hash'];;echo '" />
	<input type="submit" class="button" name="dosubmit" value="';echo L('listorder');echo '" /></div>  </div>
</div>
</div>
</form>
<script language="JavaScript">
<!--
	window.top.$(\'#display_center_id\').css(\'display\',\'none\');
//-->
</script>
</body>
</html>
';?>