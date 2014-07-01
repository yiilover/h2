<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<div class="pad-lr-10">
<form name="searchform" action="" method="get" >
<input type="hidden" value="member/member/search" name="s">
<input type="hidden" value="879" name="menuid">
<input type="hidden" value="';echo $_GET['modelid'];echo '" name="modelid">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">
				
				';echo L('regtime');echo '£º
				';echo form::date('start_time',$start_time);echo '-
				';echo form::date('end_time',$end_time);echo '				';if($_SESSION['roleid'] == 1) {;echo '				';echo form::select($sitelist,$siteid,'name="siteid"',L('all_site'));};echo '							
				<select name="status">
					<option value=\'0\' ';if(isset($_GET['status']) &&$_GET['status']==0){;echo 'selected';};echo '>';echo L('status');echo '</option>
					<option value=\'1\' ';if(isset($_GET['status']) &&$_GET['status']==1){;echo 'selected';};echo '>';echo L('lock');echo '</option>
					<option value=\'2\' ';if(isset($_GET['status']) &&$_GET['status']==2){;echo 'selected';};echo '>';echo L('normal');echo '</option>
				</select>
				';echo form::select($grouplist,$groupid,'name="groupid"',L('member_group'));echo '				
				<select name="type">
					<option value=\'1\' ';if(isset($_GET['type']) &&$_GET['type']==1){;echo 'selected';};echo '>';echo L('username');echo '</option>
					<option value=\'2\' ';if(isset($_GET['type']) &&$_GET['type']==2){;echo 'selected';};echo '>';echo L('uid');echo '</option>
					<option value=\'3\' ';if(isset($_GET['type']) &&$_GET['type']==3){;echo 'selected';};echo '>';echo L('email');echo '</option>
					<option value=\'4\' ';if(isset($_GET['type']) &&$_GET['type']==4){;echo 'selected';};echo '>';echo L('regip');echo '</option>
					<option value=\'5\' ';if(isset($_GET['type']) &&$_GET['type']==5){;echo 'selected';};echo '>';echo L('nickname');echo '</option>
				</select>
				
				<input name="keyword" type="text" value="';if(isset($_GET['keyword'])) {echo $_GET['keyword'];};echo '" class="input-text" />
				<input type="submit" name="search" class="button" value="';echo L('search');echo '" />
	</div>
		</td>
		</tr>
    </tbody>
</table>
</form>

<form name="myform" action="?s=member/member/delete" method="post" onsubmit="checkuid();return false;">
<div class="table-list">
<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th  align="left" width="20"><input type="checkbox" value="" id="check_box" onclick="selectall(\'userid[]\');"></th>
			<th align="left"></th>
			<th align="left">';echo L('uid');echo '</th>
			<th align="left">';echo L('username');echo '</th>
			<th align="left">';echo L('nickname');echo '</th>
			<th align="left">';echo L('email');echo '</th>
			<th align="left">';echo L('member_group');echo '</th>
			<th align="left">';echo L('regip');echo '</th>
			<th align="left">';echo L('lastlogintime');echo '</th>
			<th align="left">';echo L('amount');echo '</th>
			<th align="left">';echo L('point');echo '</th>
			<th align="left">';echo L('operation');echo '</th>
		</tr>
	</thead>
<tbody>
';
if(is_array($memberlist)){
foreach($memberlist as $k=>$v) {
;echo '    <tr>
		<td align="left"><input type="checkbox" value="';echo $v['userid'];echo '" name="userid[]"></td>
		<td align="left">';if($v['islock']) {;echo '<img title="';echo L('lock');echo '" src="';echo IMG_PATH;echo 'icon/icon_padlock.gif">';};echo '</td>
		<td align="left">';echo $v['userid'];echo '</td>
		<td align="left"><img src="';echo $v['avatar'];echo '" height=18 width=18 onerror="this.src=\'';echo IMG_PATH;echo 'member/nophoto.gif\'">';if($v['vip']) {;echo '<img title="';echo L('vip');echo '" src="';echo IMG_PATH;echo 'icon/vip.gif">';};echo '';echo $v['username'];echo '<a href="javascript:member_infomation(';echo $v['userid'];echo ', \'';echo $v['modelid'];echo '\', \'\')">';echo $member_model[$v['modelid']]['name'];echo '<img src="';echo IMG_PATH;echo 'admin_img/detail.png"></a></td>
		<td align="left">';echo htmlspecialchars($v['nickname']);echo '</td>
		<td align="left">';echo $v['email'];echo '</td>
		<td align="left">';echo $grouplist[$v['groupid']];echo '</td>
		<td align="left">';echo $v['regip'];echo '</td>
		<td align="left">';echo format::date($v['lastdate'],1);;echo '</td>
		<td align="left">';echo $v['amount'];echo '</td>
		<td align="left">';echo $v['point'];echo '</td>
		<td align="left">
			<a href="javascript:edit(';echo $v['userid'];echo ', \'';echo $v['username'];echo '\')">[';echo L('edit');echo ']</a>
		</td>
    </tr>
';
}
}
;echo '</tbody>
</table>

<div class="btn">
<label for="check_box">';echo L('select_all');echo '/';echo L('cancel');echo '</label> <input type="submit" class="button" name="dosubmit" value="';echo L('delete');echo '" onclick="return confirm(\'';echo L('sure_delete');echo '\')"/>
<input type="submit" class="button" name="dosubmit" onclick="document.myform.action=\'?s=member/member/lock\'" value="';echo L('lock');echo '"/>
<input type="submit" class="button" name="dosubmit" onclick="document.myform.action=\'?s=member/member/unlock\'" value="';echo L('unlock');echo '"/>
</div>

<div id="pages">';echo $pages;echo '</div>
</div>
</form>
</div>
<script type="text/javascript">
<!--
function edit(id, name) {
	window.top.art.dialog({id:\'edit\'}).close();
	window.top.art.dialog({title:\'';echo L('edit').L('member');echo '¡¶\'+name+\'¡·\',id:\'edit\',iframe:\'?s=member/member/edit&userid=\'+id,width:\'700\',height:\'500\'}, function(){var d = window.top.art.dialog({id:\'edit\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'edit\'}).close()});
}
function move() {
	var ids=\'\';
	$("input[name=\'userid[]\']:checked").each(function(i, n){
		ids += $(n).val() + \',\';
	});
	if(ids==\'\') {
		window.top.art.dialog({content:\'';echo L('plsease_select').L('member');echo '\',lock:true,width:\'200\',height:\'50\',time:1.5},function(){});
		return false;
	}
	window.top.art.dialog({id:\'move\'}).close();
	window.top.art.dialog({title:\'';echo L('move').L('member');echo '\',id:\'move\',iframe:\'?s=member/member/move&ids=\'+ids,width:\'700\',height:\'500\'}, function(){var d = window.top.art.dialog({id:\'move\'}).data.iframe;d.$(\'#dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'move\'}).close()});
}

function checkuid() {
	var ids=\'\';
	$("input[name=\'userid[]\']:checked").each(function(i, n){
		ids += $(n).val() + \',\';
	});
	if(ids==\'\') {
		window.top.art.dialog({content:\'';echo L('plsease_select').L('member');echo '\',lock:true,width:\'200\',height:\'50\',time:1.5},function(){});
		return false;
	} else {
		myform.submit();
	}
}

function member_infomation(userid, modelid, name) {
	window.top.art.dialog({id:\'modelinfo\'}).close();
	window.top.art.dialog({title:\'';echo L('memberinfo');echo '\',id:\'modelinfo\',iframe:\'?s=member/member/memberinfo&userid=\'+userid+\'&modelid=\'+modelid,width:\'700\',height:\'500\'}, function(){var d = window.top.art.dialog({id:\'modelinfo\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'modelinfo\'}).close()});
}

//-->
</script>
</body>
</html>';?>