<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad_10">
<div class="table-list">
<form name="smsform" action="" method="get" >
<input type="hidden" value="sms/sms/init" name="s">
<input type="hidden" value="';echo $_GET['menuid'];echo '" name="menuid">
<div class="explain-col search-form">
功能介绍：<br />
&nbsp;&nbsp;&nbsp;&nbsp;通过短信平台向已绑定手机的用户群发短信，即时通知公告、订单状态。<br />
&nbsp;&nbsp;&nbsp;&nbsp;用户注册、找回密码开启手机验证提高了网站的安全性。<br />
&nbsp;&nbsp;&nbsp;&nbsp;黄页商家会员可以通过短信平台管理订单信息。<br />
</div>
</form>
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="5%" align="center">';echo L('product_id');echo '</th>
            <th width="20%" align="left">';echo L('product_name');echo '</th>
            <th width="30%" align="left">';echo L('product_description');echo '</th>
            <th width="10%" align="left">';echo L('totalnum');echo '</th>
            <th width="10%" align="left">';echo L('give_away');echo '</th>
            <th width="10%" align="left">';echo L('product_price').L('yuan');echo '</th>
            <th width="10%" align="left">';echo L('buy');echo '</th>
            </tr>
        </thead>
    <tbody>

';if(is_array($smsprice_arr)) foreach($smsprice_arr as $k=>$v) {;echo '	<tr>
	<td width="10%" align="center">';echo $v['productid'];echo '</td>

	<td width="10%" align="left">';echo $v['name'];echo '</td>
	<td width="10%" align="left">';echo $v['description'];echo '</td>
	<td width="10%" align="left">';echo $v['totalnum'];echo '</td>
	<td width="10%" align="left">';echo $v['give_away'];echo '</td>
	<td width="10%" align="left">';echo $v['price'];echo '</td>
	<td width="10%" align="left"><a href="';echo $this->smsapi->get_buyurl($v['productid']);;echo '" target="_blank">';echo L('buy');echo '</a></td>
	</tr>
';};echo '    </tbody>
    </table>

<div class="btn text-l">
';if(!empty($this->smsapi->userid)) {;echo '<span class="font-fixh green">';echo L('account');echo '</span> ： <span class="font-fixh">';echo $this->smsapi->userid;echo '</span> ， <span class="font-fixh green">';echo L('smsnumber');echo '</span> ： </span><span class="font-fixh">';echo $smsinfo_arr['surplus'];echo '</span> <span class="font-fixh green">';echo L('item');echo '</span> ， <span class="font-fixh green">';echo L('iplimit');echo '</span> ： <span class="font-fixh">';if(empty($smsinfo_arr['allow_send_ip'])) {echo '未设置ip限制，建议到“<a href="http://sms.phpcms.cn/index.php?s=sms_service/center" target="_blank">短信通</a>”设置，多个服务器可绑定多个ip';}echo implode(' , ',$smsinfo_arr['allow_send_ip']);echo '</span> 

';}else {;echo '<span class="font-fixh green">未绑定平台账户，请点击<a href="index.php?s=sms/sms/sms_setting&menuid=1539"><span class="font-fixh">平台设置</span></a>绑定。</span>
';};echo '</div>
<div class="btn text-l">
<span class="font-fixh green">当前服务器IP为 ： <span class="font-fixh">';echo $_SERVER["SERVER_ADDR"];;echo '</span> ';if(!empty($smsinfo_arr['allow_send_ip']) &&!in_array($_SERVER["SERVER_ADDR"],$smsinfo_arr['allow_send_ip'])) echo '当前服务器所在IP不允许发送短信';;echo '</div>
 <div id="pages"></div>
</div>
</div>
</form>
</body>
</html>';?>