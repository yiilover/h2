<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<div class="subnav">
<div class="content-menu ib-a blue line-x">
';if($super_admin) {;echo '<a href=\'?s=content/content/public_checkall/menuid/822\' class="on"><em>';echo L('all_check_list');;echo '</em></a>
';}else {
echo L('check_status');
}
for ($j=0;$j<5;$j++) {
;echo '<span>|</span><a href=\'?s=content/content/public_checkall/menuid/822/status/';echo $j;;echo '\' class="';if($status==$j) echo 'on';;echo '"><em>';echo L('workflow_'.$j);;echo '</em></a>
';};echo '</div>
</div>
<div class="pad-10">

<form name="myform" id="myform" action="" method="post" >
<div class="table-list">
    <table width="100%">
        <thead>
            <tr>
            <th width="60">ID</th>
			<th>';echo L('title');;echo '</th>
            <th>';echo L('select_model_name');;echo '</th>
            <th width="90">';echo L('current_steps');;echo '</th>
            <th width="50">';echo L('steps');;echo '</th>
            <th width="90">';echo L('belong_category');;echo '</th>
            <th width="118">';echo L('contribute_time');;echo '</th>
            <th width="130">';echo L('username');;echo '</th>
			<th width="50">';echo L('operations_manage');;echo '</th>
            </tr>
        </thead>
<tbody>
    ';
$model_cache = getcache('model','commons');
foreach ($datas as $r) {
$arr_checkid = explode('-',$r['checkid']);
$workflowid = $this->categorys[$r['catid']]['workflowid'];
if($stepid = $workflows[$workflowid]['steps']) {
$stepname = L('steps_'.$stepid);
}else {
$stepname = '';
}
$modelname = $model_cache[$arr_checkid[2]]['name'];
$flowname = L('workflow_'.$r['status']);
;echo '        <tr>
		<td align=\'center\' >';echo $arr_checkid[1];;echo '</td>
		<td align=\'left\' ><a href="javascript:;" onclick=\'change_color(this);window.open("?s=content/content/public_preview/steps/';echo $r['status'];echo '/catid/';echo $r['catid'];;echo '/id/';echo $arr_checkid[1];;echo '/h5_hash/';echo $_SESSION['h5_hash'];;echo '","manage")\'>';echo $r['title'];;echo '</a></td>
		<td align=\'center\' >';echo $modelname;;echo '</td>
		<td align=\'center\' >';echo $flowname;;echo '</td>
		<td align=\'center\' >';echo $stepname;;echo '</td>
		<td align=\'center\' ><a href="?s=content/content/init/menuid/822/catid/';echo $r['catid'];;echo '">';echo $this->categorys[$r['catid']]['catname'];;echo '</a></td>
		<td align=\'center\' >';echo format::date($r['inputtime'],1);;echo '</td>
		<td align=\'center\'>
		';
if($r['sysadd']==0) {
echo "<a href='?s=member/member/memberinfo/username/".urlencode($r['username'])."' >".$r['username']."</a>";
echo '<img src="'.IMG_PATH.'icon/contribute.png" title="'.L('member_contribute').'">';
}else {
echo $r['username'];
}
;echo '</td>
		<td align=\'center\' ><a href="javascript:;" onclick=\'change_color(this);window.open("?s=content/content/public_preview/steps/';echo $r['status'];echo '/catid/';echo $r['catid'];;echo '/id/';echo $arr_checkid[1];;echo '/h5_hash';echo $_SESSION['h5_hash'];;echo '","manage")\'>';echo L('c_check');;echo '</a></td>
	</tr>
     ';};echo '</tbody>
     </table>
 <div id="pages">';echo $pages;echo '</div>
</div>
</form>
</div>
<script type="text/javascript"> 
<!--
window.top.$("#current_pos_attr").html(\'';echo L('checkall_content');;echo '\');
function change_color(obj) {
	$(obj).css(\'color\',\'red\');
}
//-->
</script>
</body>
</html>';?>