<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad_10">
<div class="table-list">
<form name="searchform" action="" method="get" >
<input type="hidden" value="pay/payment/pay_list" name="s">
<input type="hidden" value="';echo $_GET['menuid'];echo '" name="menuid">
<div class="explain-col search-form">
';echo L('order_sn');echo '  <input type="text" value="';echo $trade_sn;echo '" class="input-text" name="info[trade_sn]"> 
';echo L('username');echo '  <input type="text" value="';echo $username;echo '" class="input-text" name="info[username]"> 
';echo L('addtime');echo '  ';echo form::date('info[start_addtime]',$start_addtime);echo '';echo L('to');echo '   ';echo form::date('info[end_addtime]',$end_addtime);echo ' 
';echo form::select($trade_status,$status,'name="info[status]"',L('all_status'));echo '  
<input type="submit" value="';echo L('search');echo '" class="button" name="dosubmit">
</div>
</form>
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="10%">';echo L('username');echo '</th>
            <th width="20%">';echo L('order_sn');echo '</th>
            <th width="15%">';echo L('order_time');echo '</th>
            <th width="9%">';echo L('business_mode');echo '</th>
            <th width="8%">';echo L('payment_mode');echo '</th>
            <th width="8%">';echo L('deposit_amount');echo '</th>
            <th width="10%">';echo L('pay_status');echo '</th>
            <th width="20%">';echo L('operations_manage');echo '</th>
            </tr>
        </thead>
    <tbody>
 ';
if(is_array($infos)){
$sum_amount = $sum_amount_succ = $sum_point_succ = $sum_point = '0';
foreach($infos as $info){
if($info['type'] == 1) {
$num_amount++;
$sum_amount += $info['money'];
if($info['status'] =='succ') $sum_amount_succ += $info['money'];
}elseif ($info['type'] == 2) {
$num_point++;
$sum_point += $info['money'];
if($info['status'] =='succ') $sum_point_succ += $info['money'];
}
;echo '   
	<tr>
	<td width="10%" align="center">';echo $info['username'];echo '</td>
	<td width="20%" align="center">';echo $info['trade_sn'];echo ' <a href="javascript:void(0);" onclick="detail(\'';echo $info['id'];echo '\', \'';echo $info['trade_sn'];echo '\')"><img src="';echo IMG_PATH;echo 'admin_img/detail.png"></a></td>
	<td  width="15%" align="center">';echo date('Y-m-d H:i:s',$info['addtime']);echo '</td>
	<td width="9%" align="center">';echo L($info['pay_type']);echo '</td>
	<td width="8%" align="center">';echo $info['payment'];echo '</td>
	<td width="8%" align="center">';echo $info['money'];echo ' ';echo ($info['type']==1) ?L('yuan') : L('dian');echo '</td>
	<td width="10%" align="center">';echo L($info['status']);echo ' </a>
	<td width="20%" align="center">
	';if($info['status'] =='succ'||$info['status'] =='error'||$info['status'] =='failed'||$info['status'] =='timeout'||$info['status'] =='cancel') {;echo '	<font color="#cccccc">';echo L('change_price');echo '  | ';echo L('closed');echo '  |</font> <a href="javascript:confirmurl(\'?s=pay/payment/pay_del&id=';echo $info['id'];echo '&menuid=';echo $_GET['menuid'];echo '\', \'';echo L('trade_record_del');echo '\')">';echo L('delete');echo '</a>
	';}elseif($info['status'] =='waitting') {;echo '	<a href="javascript:confirmurl(\'?s=pay/payment/public_check&id=';echo $info['id'];echo '\', \'';echo L('check_confirm',array('sn'=>$info['trade_sn']));echo '\')">';echo L('check');echo '</a> | <a href="?s=pay/payment/pay_cancel&id=';echo $info['id'];echo '">';echo L('closed');echo '</a>  | <a href="javascript:confirmurl(\'?s=pay/payment/pay_del&id=';echo $info['id'];echo '&menuid=';echo $_GET['menuid'];echo '\', \'';echo L('trade_record_del');echo '\')">';echo L('delete');echo '</a>
	';}else {;echo '	<a href="javascript:void(0);" onclick="discount(\'';echo $info['id'];echo '\', \'';echo $info['trade_sn'];echo '\')">';echo L('change_price');echo '</a> | <a href="?s=pay/payment/pay_cancel&id=';echo $info['id'];echo '">';echo L('closed');echo '</a>  | <a href="javascript:confirmurl(\'?s=pay/payment/pay_del&id=';echo $info['id'];echo '&menuid=';echo $_GET['menuid'];echo '\', \'';echo L('trade_record_del');echo '\')">';echo L('delete');echo '</a>
	

	';};echo '	</td>
	</tr>
';
}
}
;echo '    </tbody>
    </table>
<div class="btn text-r">
';echo L('thispage').L('totalize');echo '  <span class="font-fixh green">';echo $number;echo '</span> ';echo L('bi').L('trade');echo '(';echo L('money');echo '£º<span class="font-fixh">';echo $num_amount;echo '</span>';echo L('bi');echo '£¬';echo L('point');echo '£º<span class="font-fixh">';echo $num_point;echo '</span>';echo L('bi');echo ')£¬';echo L('total').L('amount');echo '£º<span class="font-fixh green">';echo $sum_amount;echo '</span>';echo L('yuan');echo ' ,';echo L('trade_succ').L('trade');echo '£º<span class="font-fixh green">';echo $sum_amount_succ;echo '</span>';echo L('yuan');echo ' £¬×ÜµãÊý£º<span class="font-fixh green">';echo $sum_point;echo '</span>';echo L('dian');echo ' ,';echo L('trade_succ').L('trade');echo '£º<span class="font-fixh green">';echo $sum_point_succ;echo '</span>';echo L('dian');echo ' 
</div>
 <div id="pages"> ';echo $pages;echo '</div>
</div>
</div>
</form>
</body>
</html>
<script type="text/javascript">
<!--
	function discount(id, name) {
	window.top.art.dialog({title:\'';echo L('discount');echo '--\'+name, id:\'discount\', iframe:\'?s=pay/payment/discount&id=\'+id ,width:\'500px\',height:\'200px\'}, 	function(){var d = window.top.art.dialog({id:\'discount\'}).data.iframe;
	var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'discount\'}).close()});
}
function detail(id, name) {
	window.top.art.dialog({title:\'';echo L('discount');echo '--\'+name, id:\'discount\', iframe:\'?s=pay/payment/public_pay_detail&id=\'+id ,width:\'500px\',height:\'550px\'});
}
//-->
</script>';?>