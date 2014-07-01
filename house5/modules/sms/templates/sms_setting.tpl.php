<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad-10">
<div class="explain-col search-form">
登录house5官方网站申请sms短信服务，获取产品id和密钥，获取地址：<a href="http://sms.house5.net/" target="_blank">http://sms.house5.net/</a>
</div>
<div class="common-form">
<form name="myform" action="?s=sms/sms/sms_setting" method="post" id="myform">
<table width="100%" class="table_form">
<tr>
<td  width="120">';echo L('sms_enable');echo '</td> 
<td><input name="setting[sms_enable]" value="1" type="radio" id="sms_enable" ';if($this->sms_setting[sms_enable] == 1) {;echo 'checked';};echo '> ';echo L('open');echo '  
<input name="setting[sms_enable]" value="0" type="radio" id="sms_enable" ';if($this->sms_setting[sms_enable] == 0) {;echo 'checked';};echo '> ';echo L('close');echo '</td>
</tr>
<tr>
<td  width="120">sms_uid  <font color="#C0C0C0">(';echo L('userid');echo ')</font></td> 
<td><input type="text" name="setting[userid]" size="20" value="';echo $this->sms_setting[userid];echo '" id="userid"></td>
</tr>
<tr>
<td  width="120">sms_pid <font color="#C0C0C0">(';echo L('productid');echo ')</font></td> 
<td><input type="text" name="setting[productid]" size="20" value="';echo $this->sms_setting[productid];echo '" id="productid"></td>
</tr>
<tr>
<td  width="120">sms_passwd <font color="#C0C0C0">(';echo L('sms_key');echo ')</font></td> 
<td><label><input type="input" id="sms_key" name="setting[sms_key]" value="';echo $this->sms_setting[sms_key];echo '" size="50"></label></td>
</tr>


</table>
<div class="bk15"></div>
<input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="button" id="dosubmit">
</form>
</div>
</body>
</html>';?>