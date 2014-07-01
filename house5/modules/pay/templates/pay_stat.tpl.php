<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad_10">
<div class="table-list">
<form name="searchform" action="" method="get" >
<input type="hidden" value="pay/payment/pay_stat" name="s">
<input type="hidden" value="';echo $_GET['menuid'];echo '" name="menuid">

<div class="explain-col search-form">
';echo L('username');echo '  <input type="text" value="';echo $username;echo '" class="input-text" name="info[username]"> 
';echo L('addtime');echo '  ';echo form::date('info[start_addtime]',$start_addtime);echo '';echo L('to');echo '   ';echo form::date('info[end_addtime]',$end_addtime);echo ' 
';echo form::select($trade_status,$status,'name="info[status]"',L('all_status'));echo '  
<input type="submit" value="';echo L('search');echo '" class="button" name="dosubmit">
</div>

</form>
<fieldset>
	<legend>';echo L('finance').L('totalize');echo '</legend>
	<table width="100%" class="table_form">
  <tbody>
  <tr>
    <th width="80">';echo L('total').L('transactions');echo '</th>
    <td class="y-bg">';echo L('money');echo '&nbsp;&nbsp;<span class="font-fixh green">';echo $total_amount_num;echo '</span> ';echo L('bi');echo '£¨';echo L('trade_succ').L('trade');echo '&nbsp;&nbsp;<span class="font-fixh">';echo $total_amount_num_succ;echo '</span> ';echo L('bi');echo '£©<br/>';echo L('point');echo '&nbsp;&nbsp;<span class="font-fixh green">';echo $total_point_num;echo '</span> ';echo L('bi');echo '£¨';echo L('trade_succ').L('trade');echo '&nbsp;&nbsp;<span class="font-fixh">';echo $total_point_num_succ;echo '</span> ';echo L('bi');echo '£©</td>
  </tr>   
  <tr>
    <th width="80">';echo L('total').L('amount');echo '</th>
    <td class="y-bg"><span class="font-fixh green">';echo $total_amount;echo '</span> ';echo L('yuan');echo '£¨';echo L('trade_succ').L('trade');echo '&nbsp;&nbsp;<span class="font-fixh">';echo $total_amount_succ;echo '</span>';echo L('yuan');echo '£©<br/><span class="font-fixh green">';echo $total_point;echo '</span>';echo L('dian');echo '£¨';echo L('trade_succ').L('trade');echo '&nbsp;&nbsp;<span class="font-fixh">';echo $total_point_succ;echo '</span>';echo L('dian');echo '£©</td>
  </tr>
</table>
</fieldset>
<div class="bk10"></div>
<fieldset>
	<legend>';echo L('query_stat');echo '</legend>
	<table width="100%" class="table_form">
  <tbody>
  ';if($num) {;echo '  <tr>
    <th width="80">';echo L('total_transactions');echo '£º</th>
    <td class="y-bg">';echo L('money');echo '£º<span class="font-fixh green">';echo $amount_num;echo '</span> ';echo L('bi');echo '£¨';echo L('transactions_success');echo '£º<span class="font-fixh">';echo $amount_num_succ;echo '</span> ';echo L('bi');echo '£©<br/>';echo L('point');echo '£º<span class="font-fixh green">';echo $point_num;echo '</span> ';echo L('bi');echo '£¨';echo L('transactions_success');echo '£º<span class="font-fixh">';echo $point_num_succ;echo '</span> ';echo L('bi');echo '£©</td>
  </tr>   
  <tr>
    <th width="80">';echo L('total').L('amount');echo '£º</th>
    <td class="y-bg"><span class="font-fixh green">';echo $amount;echo '</span>';echo L('yuan');echo '£¨';echo L('transactions_success');echo '£º<span class="font-fixh">';echo $amount_succ;echo '</span>';echo L('yuan');echo '£©<br/><span class="font-fixh green">';echo $point;echo '</span>';echo L('dian');echo '£¨';echo L('transactions_success');echo '£º<span class="font-fixh">';echo $point_succ;echo '</span>';echo L('dian');echo '£©</td>
  </tr>
  ';};echo '</table>
</fieldset>
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