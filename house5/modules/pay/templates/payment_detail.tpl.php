<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#name").formValidator({onshow:"';echo L('input').L('payment_mode').L('name');echo '",onfocus:"';echo L('payment_mode').L('name').L('empty');echo '"}).inputValidator({min:1,max:999,onerror:"';echo L('payment_mode').L('name').L('empty');echo '"});
})
//-->
</script>
<div class="pad-10">
<div class="common-form">
<form name="myform" action="?s=pay/payment/';echo $_GET['a'];echo '" method="post" id="myform">
<fieldset>
<legend>';echo L('说明');echo '</legend>
';if($pay_name =='支付宝'){;echo '<table width="100%" class="table_form" id="taobao">
<tr><td>
<img src="';echo IMG_PATH;;echo 'taobao_log.png">支付宝为国内领先的支付平台!<br>
HOUSE5联合支付宝推出优惠套餐：无预付/年费，单笔费率阶梯0.7%-1.2%，无流量限制。交易越多，费率越低！<br><br>
<a href="https://www.alipay.com/" style="color:red;" target="_blank">了解详情</a>  <a href="http://help.alipay.com/support/help_detail.htm?help_id=241435" style="color:red;" target="_blank">如何签约</a><br><br>
<a href=" http://fun.alipay.com/xtsz/phpcms.htm" target="_blank" title="点击申请"><img src="';echo IMG_PATH;;echo 'taobao_sq.jpg"></a><br>
已经签约的用户，可直接在下方填写相关账号信息即可。
</td></tr>
</table>
';};echo '
';if($pay_name =='盛付通'){;echo '<table width="100%" class="table_form" id="taobao">
<tr><td>
<img src="';echo IMG_PATH;;echo 'snda_log.jpg">盛付通是盛大网络创办的中国领先的在线支付平台，致力于为互联网用户和企业提供便捷、安全的支付服务。通过与各大银行、通信服务商等签约合作，提供具备相当实力和信誉保障的支付服务！<a href="http://zhuanye.shengpay.com/SP/Business/quicklygather.aspx" style="color:red;" target="_blank">前往了解详情！</a><br><br> 
<a href="http://zhuanye.shengpay.com/ProLogin.aspx" target="_blank" title="点击申请"><img src="';echo IMG_PATH;;echo 'taobao_sq.jpg"></a><br><br>
已经签约的用户，可直接在下方填写相关账号信息即可。
</td></tr>
</table>
';};echo '
</fieldset>
<div class="bk15"></div>
<fieldset>
<legend>';echo L('parameter_config');echo '</legend>
<table width="100%" class="table_form">
<tr>
<td  width="120">';echo L('payment_mode');echo '</td> 
<td>';echo $pay_name;echo '</td>
</tr>
<tr>
<td  width="120">';echo L('payment_mode').L('name');echo '</td> 
<td><input type="text" name="name" value="';echo $name ?$name : $pay_name;echo '" class="input-text" id="name"></input></td>
</tr>

';foreach ($config as $conf =>$name) {;echo ' <tr>
  <td>';echo $name['name'];echo '</td>
	<td>
	';if($name['type'] == 'text'){;echo '	<input type="text"  class="input-text" name="config_value[]" id="';echo $conf;echo '" value="';echo $name['value'];echo '" size="40"></input>
	';}elseif($name['type'] == 'select') {;echo '		<select name="config_value[]" value="0">
		 ';foreach ($name['range'] as $key =>$v) {;echo '		<option value="';echo $key;echo '" ';if($key == $name['value']){;echo ' selected="" ';};echo ' >';echo $v;echo '</option>
		 ';};echo '		</select>
	';};echo '	<input type="hidden" value="';echo $conf;echo '" name="config_name[]"/>
	</td>
 </tr>
';};echo '
<tr>
<td>';echo L('payment_mode').L('desc');echo '</td> 
<td>
<textarea name="description" rows="2" cols="10" id="description" class="inputtext" style="height:100px;width:300px;">';echo $pay_desc;echo '</textarea>
';echo form::editor('description','desc');;echo '</td>
</tr>
<tr>
<td  width="120">';echo L('listorder');echo '</td> 
<td><input type="text" name="pay_order" value="';echo $pay_order;echo '" class="input-text" id="pay_order" size="3"></input></td>
</tr>
<tr>
<td  width="120">';echo L('online');echo '?</td> 
<td>';echo $is_online ?L('yes'):L('no');echo '</td>
</tr>
<tr>
<td  width="120">';echo L('pay_factorage');echo '：</td> 
<td id="paymethod"><input name="pay_method" value="0" type="radio" ';echo ($pay_method == 1) ?'': 'checked';echo '> ';echo L('pay_method_rate');echo '&nbsp;&nbsp;&nbsp;<input name="pay_method" value="1" type="radio" ';echo ($pay_method == 0) ?'': 'checked';echo '> ';echo L('pay_method_fix');echo '&nbsp;&nbsp;&nbsp; </td>
</tr>
<tr><td></td>
<td>
<div id="rate" ';echo ($pay_method == 0) ?'': 'class="hidden"';echo '>
';echo L('pay_rate');echo '<input type="text" size="3" value="';echo $pay_fee;echo '" name="pay_rate">&nbsp;%&nbsp;&nbsp;&nbsp;&nbsp;';echo L('pay_method_rate_desc');echo '</div>
<div id="fix" ';echo ($pay_method == 1) ?'': 'class="hidden"';echo '>
';echo L('pay_fix');echo '<input type="text" name="pay_fix" size="3" value="';echo $pay_fee;echo '">&nbsp;&nbsp;&nbsp;&nbsp; ';echo L('pay_method_fix_desc');echo '</div>
</td>
</tr>
	</table>
</fieldset>

    <div class="bk15"></div>
	<input type="hidden"  name="pay_name" value="';echo $pay_name;echo '" />
	<input type="hidden"  name="pay_id" value=';echo $pay_id;echo ' />
	<input type="hidden"  name="pay_code" value=';echo $pay_code;echo ' />
	<input type="hidden"  name="is_cod" value=';echo $is_cod;echo ' />
	<input type="hidden"  name="is_online" value=';echo $is_online;echo ' />
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