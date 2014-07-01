<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '
<div class="pad-10">
<div class="common-form">
<fieldset>
<legend>';echo L('basic_config');echo '</legend>
<table width="100%" class="table_form">
<tr>
<td  width="120">';echo L('username');echo '</td> 
<td>';echo $username;echo '[';echo $userid;echo ']</td>
</tr>
<tr>
<td  width="120">';echo L('contact_email');echo '</td> 
<td>';echo $email;echo '</td>
</tr>
<tr>
<td  width="120">';echo L('contact_phone');echo '</td> 
<td>';echo $telephone;echo '</td>
</tr>
</table>
</fieldset>
<div class="bk15"></div>
<fieldset>
<legend>';echo L('order_info');echo '</legend>
<table width="100%" class="table_form">
<tr>
<td  width="120">';echo L('order_sn');echo '</td> 
<td>';echo $trade_sn;echo '</td>
</tr>
<tr>
<td  width="120">';echo L('order_name');echo '</td> 
<td>';echo $contactname;echo '</td>
</tr>

<tr>
<td  width="120">';echo L('order_price');echo '</td> 
<td>';echo $money;echo ' ';echo L('yuan');echo '</td>
</tr>
<tr>
<td  width="120">';echo L('order_discount');echo '</td> 
<td>';echo $discount;echo ' ';echo L('yuan');echo '</td>
</tr>

<tr>
<td  width="120">';echo L('order_addtime');echo '</td> 
<td>';echo date('Y:m:d H:i:s',$addtime);echo '</td>
</tr>

<tr>
<td  width="120">';echo L('order_ip');echo '</td> 
<td>';echo $ip;echo '</td>
</tr>
<tr>
<td  width="120">';echo L('payment_type');echo '</td> 
<td>';echo $payment;echo '</td>
</tr>

<tr>
<td  width="120">';echo L('order').L('usernote');echo '</td> 
<td>';echo $usernote;echo '</td>
</tr>
';if($adminnote) {;echo '<tr>
<td  width="120">';echo L('adminnote');echo '</td> 
<td>';echo $adminnote;echo '</td>
</tr>
';};echo '</table>
</fieldset>
</div>
</body>
</html>
<script type="text/javascript">

$(document).ready(function() {
	$("#paymethod input[type=\'radio\']").click( function () {
		if($(this).val()== 0){
			$("#rate").removeClass(\'hidden\');
			$("#fix").addClass(\'hidden\');
			$("#rate input").val(\'0\');
		} else {
			$("#fix").removeClass(\'hidden\');
			$("#rate").addClass(\'hidden\');
			$("#fix input").val(\'0\');
		}	
	});
});
function category_load(obj)
{
	var modelid = $(obj).attr(\'value\');
	$.get(\'?s=admin/position/public_category_load&modelid=\'+modelid,function(data){
			$(\'#load_catid\').html(data);
		  });
}
</script>


';?>