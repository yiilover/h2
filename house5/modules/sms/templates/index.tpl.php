<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad_10">
<div class="table-list">
<form name="smsform" action="" method="get" >
<input type="hidden" value="sms/sms/init" name="s">
<input type="hidden" value="';echo $_GET['menuid'];echo '" name="menuid">
<div class="explain-col search-form">
���ܽ��ܣ�<br />
&nbsp;&nbsp;&nbsp;&nbsp;ͨ������ƽ̨���Ѱ��ֻ����û�Ⱥ�����ţ���ʱ֪ͨ���桢����״̬��<br />
&nbsp;&nbsp;&nbsp;&nbsp;�û�ע�ᡢ�һ����뿪���ֻ���֤�������վ�İ�ȫ�ԡ�<br />
&nbsp;&nbsp;&nbsp;&nbsp;��ҳ�̼һ�Ա����ͨ������ƽ̨��������Ϣ��<br />
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
';if(!empty($this->smsapi->userid)) {;echo '<span class="font-fixh green">';echo L('account');echo '</span> �� <span class="font-fixh">';echo $this->smsapi->userid;echo '</span> �� <span class="font-fixh green">';echo L('smsnumber');echo '</span> �� </span><span class="font-fixh">';echo $smsinfo_arr['surplus'];echo '</span> <span class="font-fixh green">';echo L('item');echo '</span> �� <span class="font-fixh green">';echo L('iplimit');echo '</span> �� <span class="font-fixh">';if(empty($smsinfo_arr['allow_send_ip'])) {echo 'δ����ip���ƣ����鵽��<a href="http://sms.phpcms.cn/index.php?s=sms_service/center" target="_blank">����ͨ</a>�����ã�����������ɰ󶨶��ip';}echo implode(' , ',$smsinfo_arr['allow_send_ip']);echo '</span> 

';}else {;echo '<span class="font-fixh green">δ��ƽ̨�˻�������<a href="index.php?s=sms/sms/sms_setting&menuid=1539"><span class="font-fixh">ƽ̨����</span></a>�󶨡�</span>
';};echo '</div>
<div class="btn text-l">
<span class="font-fixh green">��ǰ������IPΪ �� <span class="font-fixh">';echo $_SERVER["SERVER_ADDR"];;echo '</span> ';if(!empty($smsinfo_arr['allow_send_ip']) &&!in_array($_SERVER["SERVER_ADDR"],$smsinfo_arr['allow_send_ip'])) echo '��ǰ����������IP�������Ͷ���';;echo '</div>
 <div id="pages"></div>
</div>
</div>
</form>
</body>
</html>';?>