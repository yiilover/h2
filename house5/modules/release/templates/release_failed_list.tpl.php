<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10">
<div class="table-list">
<form action="?s=release/index/del" method="post">
    <table width="100%" cellspacing="0">
        <thead>
		<tr>
		<th width="80"><input type="checkbox"  onclick="selectall(\'ids[]\');" id="check_box" /></th>
		<th width="80">ID</th>
		<th width="80">';echo L('type');echo '</th>
		<th width="80">';echo L("site");echo 'ID</th>
		<th>';echo L('path');echo '</th>
		<th>';echo L('time');echo '</th>
		';foreach ($this->point as $v) :$r = $this->db->get_one(array('id'=>$v),'name');;echo '		<th>';echo $r['name'];echo '</th>
		';endforeach;;echo '		</tr>
        </thead>
<tbody>
';
if(is_array($list)):
foreach($list as $v):
;echo '<tr>
<td width="80" align="center"><input type="checkbox" name="ids[]" value="';echo $v['id'];echo '" /></td>
<td width="80" align="center">';echo $v['id'];echo '</td>
<td align="center">';switch($v['type']){case 'edit':case 'add':echo L('upload');break;case 'del':echo L('delete');break;};echo '</td>
<td align="center">';echo $v['siteid'];echo '</td>
<td align="center">';echo $v['path'];;echo '</td>
<td align="center">';echo format::date($v['times'],1);;echo '</td>
';$i=1;foreach ($this->point as $d) :;echo '<td align="center">';switch($v['status'.$i]){case -1:echo '<div class="onError">'.L("failure").'</div>';break;case 0:echo '<div class="onShow">'.L('not_upload').'</div>';break;case 1:echo '<div class="onCorrect">'.L("success").'</div>';break;};echo '</td>
';$i++;endforeach;;echo '</tr>
';
endforeach;
endif;
;echo '</tbody>
</table>
<div class="btn"><label for="check_box">';echo L('select_all');echo '/';echo L('cancel');echo '</label> <input type="button" class="button" name="dosubmit" value="';echo L('sync_agin');echo '" onclick="sync_agin()" />¡¡<input type="button" class="button" name="dosubmit" value="';echo L('all').L('sync_agin');echo '" onclick="window.top.art.dialog({id:\'sync\',iframe:\'?s=release/index/init&statuses=-1&iniframe=1\', title:\'';echo L('sync_agin');echo '\', width:\'700\', height:\'500\', lock:true},\'\', function(){window.top.art.dialog({id:\'sync\'}).close();location.reload()});" /> <input type="submit" class="button" value="';echo L("delete");echo '" /></div> 
</form>
</div>
</div>
<div id="pages">';echo $queue->pages;echo '</div>
<script type="text/javascript">
<!--
function sync_agin() {
	var ids =  \'\';
	$("input[type=\'checkbox\'][name=\'ids[]\']:checked").each(function(i,n){ids += ids ? \',\'+$(n).val() : $(n).val();});
	if (ids)window.top.art.dialog({id:\'sync\',iframe:\'?s=release/index/init&statuses=-1&iniframe=1&ids=\'+ids, title:\'';echo L('sync_agin');echo '\', width:\'700\', height:\'500\', lock:true},\'\', function(){window.top.art.dialog({id:\'sync\'}).close();location.reload()});
}
//-->
</script>
</body>
</html>';?>