<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<div class="pad-lr-10">
<form name="myform2" action="?s=wap/wap_admin/type_manage&siteid=';echo $siteid;echo '" method="post">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td><div class="explain-col"> ';echo L('listorder');echo ' <input type="text" value="0" class="input-text" name="info[listorder]" size="5">  ';echo L('wap_type_name');echo '  <input type="text" value="" class="input-text" name="info[typename]">   ';echo L('wap_bound_type');echo '   ';echo form::select_category('category_content_'.$siteid,$parentid,'name="info[cat]"',L('wap_type_bound'),1,0,0,$siteid);;echo '<input type="submit" value="';echo L('wap_toptype_add');echo '" class="button" name="dosubmit">
		</div>
		</td>
		</tr>
    </tbody>
</table>
</form>
<div class="table-list">
<form name="myform" action="" method="post" >
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="5%"><input type="checkbox" onclick="selectall(\'ids[]\');" id="check_box" value=""></th>
            <th width="10%"  align="center">';echo L('listorder');echo '</th>
            <th width="10%" align=\'center\'>TYPEID</th>
            <th width="40%" align="left">';echo L('wap_type_name');echo '</th>
            <th width="20%">';echo L('wap_bound_type');echo '</th>
            </tr>
        </thead>
    <tbody>  
';echo $wap_type;echo '    </tbody>
    </table>

    <div class="btn">
    <input type="submit" class="button" name="dosubmit" value="';echo L('submit');echo '" 
     onclick="document.myform.action=\'?s=wap/wap_admin/type_edit&siteid=';echo $siteid;echo '\';"/>
    <input type="submit" class="button" name="dosubmit" value="';echo L('delete');;echo '" onclick="document.myform.action=\'?s=wap/wap_admin/type_delete&dosubmit=1\';return confirm_delete()"/>
    </div> 
</form>
 </div>
</div>
</div>
</body>
<a href="javascript:edit(';echo $v['siteid'];echo ', \'';echo $v['name'];echo '\')">
</html>
<script type="text/javascript">
	function add_tr(obj,parentid,siteid) {
		$(obj).parent().parent().after(\'<tr><td width="5%" align="center"></td><td width="10%" align="center"><input type="text" class="input-text" value="0" size="3" name="addorder[\'+parentid+\']"></td><td width="10%" align="center"></td><td width="" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;й└йд <input type="text" value="" class="input-text" name="addtype[\'+parentid+\'][]" size="10" ></td><td width="20%" align="center" id="td_\'+parentid+\'"></td></tr>\');
		$("#td_"+parentid).load(\'?s=wap/wap_admin/public_show_cat_ajx&parentid=\'+parentid+\'&siteid=\'+siteid);
	};
	function confirm_delete(){
		if(confirm(\'';echo L('confirm_delete');;echo '\')) $(\'#myform\').submit();
	}	
</script>';?>