<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '
<form name="myform" action="?s=member/member_verify/delete" method="post"  onsubmit="checkuid();return false;">
<div class="pad-lr-10">
<div class="table-list">

<table width="100%" cellspacing="0">
        <thead>
            <tr>
			<th  align="left" width="20"><input type="checkbox" value="" id="check_box" onclick="selectall(\'userid[]\');"></th>
			<th align="left">';echo L('username');echo '</th>
			<th align="left">';echo L('email');echo '</th>
			<th align="left">';echo L('regtime');echo '</th>
			<th align="left">';echo L('model_name');echo '</th>
			<th align="left">';echo L('verify_message');echo '</th>
			<th align="left">';echo L('verify_status');echo '</th>
            </tr>
        </thead>
    <tbody>
';
foreach($memberlist as $k=>$v) {
;echo '    <tr>
		<td align="left"><input type="checkbox" value="';echo $v['userid'];echo '" name="userid[]"></td>
		<td align="left">';echo $v['username'];echo '</td>
		<td align="left">';echo $v['email'];echo '</td>
		<td align="left" title="';echo $v['regip'];echo '">';echo format::date($v['regdate'],1);;echo '</td>
		<td align="left"><a href="javascript:member_verify(';echo $v['userid'];echo ', \'';echo $v['modelid'];echo '\', \'\')">';echo $member_model[$v['modelid']]['name'];echo '<img src="';echo IMG_PATH;echo 'admin_img/detail.png"></a></td>
		<td align="left">';echo $v['message'];echo '</td>
		<td align="left">';$verify_status = array('5'=>L('nerver_pass'),'4'=>L('reject'),'3'=>L('delete'),'2'=>L('ignore'),'0'=>L('need_verify'),'1'=>L('pass'));echo $verify_status[$v['status']];echo '</td>
    </tr>
';
}
;echo ' </tbody>
</table>
<div class="btn">
<label for="check_box">';echo L('select_all');echo '/';echo L('cancel');echo '</label>
<input type="submit" class="button" name="dosubmit" value="';echo L('verify_pass');echo '" onclick="document.myform.action=\'?s=member/member_verify/pass\'"/>

<input type="submit" class="button" name="dosubmit" value="';echo L('reject');echo '" onclick="document.myform.action=\'?s=member/member_verify/reject\'"/>

<input type="submit" class="button" name="dosubmit" value="';echo L('delete');echo '" onclick="return confirm(\'';echo L('sure_delete');echo '\');"/>

<input type="submit" class="button" name="dosubmit" value="';echo L('ignore');echo '" onclick="document.myform.action=\'?s=member/member_verify/ignore\'"/>

';echo L('verify_message');echo '£º<input type="text" name="message"><input type="checkbox" value=1 name="sendemail" checked/>';echo L('sendemail');echo '</div> 
<div id="pages">';echo $pages;echo '</div>
</div>
</div>
</form>
<script type="text/javascript">
<!--

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

function member_verify(userid, modelid, name) {
	window.top.art.dialog({id:\'modelinfo\'}).close();
	window.top.art.dialog({title:\'';echo L('member_verify');echo '\',id:\'modelinfo\',iframe:\'?s=member/member_verify/modelinfo&userid=\'+userid+\'&modelid=\'+modelid,width:\'700\',height:\'500\'}, function(){var d = window.top.art.dialog({id:\'modelinfo\'}).data.iframe;d.document.getElementById(\'dosubmit\').click();return false;}, function(){window.top.art.dialog({id:\'modelinfo\'}).close()});
}
//-->
</script>
</body>
</html>';?>