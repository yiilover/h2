<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#discount").formValidator({onshow:"';echo L('disount_notice');echo '",onfocus:"';echo L('empty');echo '"}).inputValidator({min:1,max:999,onerror:"';echo L('empty');echo '"});
})
//-->
</script>
<div class="pad-10">
<div class="common-form">
<form name="myform" action="?s=pay/payment/';echo $_GET['a'];echo '" method="post" id="myform">
<table width="100%" class="table_form">
<tr>
<td  width="80">';echo L('order_sn');echo '</td> 
<td>';echo $trade_sn;echo '</td>
</tr>
<tr>
<td>';echo L('order_discount');echo '</td> 
<td><input type="text" name="discount" value="';echo $discount ?$discount : 0 ;echo '" class="input-text" id="discount" size="6"> ';echo L('yuan');echo '</td>
</tr>
</table>
<input type="hidden"  name="id" value="';echo $id;echo '" />
<input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="dialog" id="dosubmit">
</form>
</div></div>
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