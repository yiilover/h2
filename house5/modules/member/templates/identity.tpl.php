<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<div class="pad-lr-10">
<form name="myform" action="?s=member/member/identity" method="post" onsubmit="checkuid();return false;">
<div class="table-list">
<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th  align="left" width="20"><input type="checkbox" value="" id="check_box" onclick="selectall(\'id[]\');"></th>
			';if($type==1){;echo '			<th align="left">����֤����</th>
			<th align="left">����֤��ͼƬ</th>
			';}else{;echo '			<th align="left">���֤����</th>
			<th align="left">���֤ͼƬ</th>
			';};echo '			<th align="left">����������</th>
			<th align="left">״̬</th>
			<th align="left">����ʱ��</th>
		</tr>
	</thead>
<tbody>
';
if(is_array($identitylist)){
foreach($identitylist as $k=>$v) {
;echo '    <tr>
		<td align="left"><input type="checkbox" value="';echo $v['id'];echo '" name="id[]"></td>
		<td align="left">';echo $v['idcard'];echo '</td>
		<td align="left"><img src="';echo $v['idcard_pic'];echo '" height=100 width=100 onerror="this.src=\'';echo IMG_PATH;echo 'member/nophoto.gif\'"></td>
		<td align="left">';echo get_nickname($v['broker_id']);echo '</td>
		<td align="left">';echo $v['status']?'��ͨ��':'<font color=blue>δ���</font>';echo '</td>
		<td align="left">';echo format::date($v['add_time'],1);;echo '</td>
    </tr>
';
}
}
;echo '</tbody>
</table>

<div class="btn">
<label for="check_box">';echo L('select_all');echo '/';echo L('cancel');echo '</label> 
<input type="submit" class="button" name="passsubmit" onclick="document.myform.action=\'?s=member/member/identity\'" value="���ͨ��"/>
<input type="submit" class="button" name="deletesubmit" value="';echo L('delete');echo '" onclick="return confirm(\'';echo L('sure_delete');echo '\')"/>
</div>

<div id="pages">';echo $pages;echo '</div>
</div>
</form>
</div>
<script type="text/javascript">
<!--

function checkuid() {
	var ids=\'\';
	$("input[name=\'id[]\']:checked").each(function(i, n){
		ids += $(n).val() + \',\';
	});
	if(ids==\'\') {
		window.top.art.dialog({content:\'��ѡ��Ҫ��������\',lock:true,width:\'200\',height:\'50\',time:1.5},function(){});
		return false;
	} else {
		myform.submit();
	}
}

//-->
</script>
</body>
</html>';?>