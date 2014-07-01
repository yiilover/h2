<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<form name="myform" action="?s=admin/position/listorder" method="post">
<div class="pad_10">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
             <th width="5%" align="left">';echo L('productid');echo '</th>
			 <th width="15%">';echo L('product_name');echo '</th>
			 <th width="30%">';echo L('product_description');echo '</th>
			 <th width="10%">';echo L('totalnum');echo '</th>
			 <th width="10%">';echo L('give_away');echo '</th>
             <th width="10%">';echo L('product_price').L('yuan');echo '</th>
             <th width="20%">';echo L('recharge_time');echo '</th>
            </tr>
        </thead>
    <tbody>
';
if(is_array($payinfo_arr)) foreach($payinfo_arr as $info){
;echo '   
	<tr>
	<td width="5%">';echo $info['sms_pid'];echo '</td>
	<td width="15%" align="center">';if(CHARSET=='gbk') {echo iconv('utf-8','gbk',$info['name']);}else{echo $info['name'];};echo '</td>
	<td width="10%" align="center">';if(CHARSET=='gbk') {echo iconv('utf-8','gbk',$info['description']);}else{echo $info['description'];};echo '</td>
	<td width="10%" align="center">';echo $info['totalnum'];echo '</td>
	<td width="15%" align="center">';echo $info['give_away'];echo '</td>
	<td width="10%" align="center">';echo $info['price'];echo '</td>	
	<td width="20%" align="center">';echo format::date($info['recharge_time'],1);echo '</td>
	</tr>
';
}
;echo '    </tbody>
    </table>
  
    <div class="btn"></div>  </div>

 <div id="pages"> ';echo $pages;echo '</div>
</div>
</div>
</form>
</body>
<a href="javascript:edit(';echo $v['siteid'];echo ', \'';echo $v['name'];echo '\')">
</html>';?>