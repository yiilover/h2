<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad_10">
<div class="table-list">
<form name="searchform" action="" method="get" >
<input type="hidden" value="pay/spend/init" name="s">
<input type="hidden" value="';echo $_GET['menuid'];echo '" name="menuid">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">
		';echo  form::select(array('1'=>L('username'),'2'=>L('userid')),$user_type,'name="user_type"');echo '£º <input type="text" value="';echo $username;echo '" class="input-text" name="username"> 
		';echo L('from');echo '  ';echo form::date('starttime',format::date($starttime));echo ' ';echo L('to');echo '   ';echo form::date('endtime',format::date($endtime));echo ' 
		
		';echo  form::select(array(''=>L('op'),'1'=>L('username'),'2'=>L('userid')),$op_type,'name="op_type"');echo '£º
		<input type="text" value="';echo $op;echo '" class="input-text" name="op"> 
		';echo  form::select(array(''=>L('expenditure_patterns'),'1'=>L('money'),'2'=>L('point')),$type,'name="type"');echo '		<input type="submit" value="';echo L('search');echo '" class="button" name="dosubmit">
		</div>
		</td>
		</tr>
    </tbody>
</table>
</form>
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="10%">';echo L('username');echo '</th>
            <th width="20%">';echo L('content_of_consumption');echo '</th>
            <th width="15%">';echo L('empdisposetime');echo ' </th>
            <th width="9%">';echo L('op');echo '</th>
            <th width="8%">';echo L('expenditure_patterns');echo '</th>
            <th width="8%">';echo L('consumption_quantity');echo '</th>
            </tr>
        </thead>
    <tbody>
 ';
if(is_array($list)){
$amount = $point = 0;
foreach($list as $info){
;echo '   
	<tr>
	<td width="10%" align="center">';echo $info['username'];echo '</td>
	<td width="20%" align="center">';echo $info['msg'];echo '</td>
	<td  width="15%" align="center">';echo format::date($info['creat_at'],1);echo '</td>
	<td width="9%" align="center">';if (!empty($info['op_userid'])) {echo $info['op_username'];}else {echo L('self');};echo '</td>
	<td width="8%" align="center">';if ($info['type'] == 1) {echo L('money');}elseif($info['type'] == 2) {echo L('point');};echo '</td>
	<td width="8%" align="center">';echo $info['value'];echo '</td>
	</tr>
';
}
}
;echo '    </tbody>
    </table>

 <div id="pages"> ';echo $pages;echo '</div>
</div>
</div>
</form>
</body>
</html>
<script type="text/javascript">
<!--
	function discount(id, name) {
	window.top.art.dialog({title:\'';echo L('discount');echo '--\'+name, id:\'discount\', iframe:\'?s=pay/payment/public_discount&id=\'+id ,width:\'500px\',height:\'200px\'}, 	function(){var d = window.top.art.dialog({id:\'discount\'}).data.iframe;
	var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'discount\'}).close()});
}
function detail(id, name) {
	window.top.art.dialog({title:\'';echo L('discount');echo '--\'+name, id:\'discount\', iframe:\'?s=pay/payment/public_pay_detail&id=\'+id ,width:\'500px\',height:\'550px\'});
}
//-->
</script>';?>