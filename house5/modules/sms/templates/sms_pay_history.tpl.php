<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<form name="myform" action="?s=admin/position/listorder" method="post">
<div class="pad_10">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
             <th width="5%" align="left">';echo L('id');echo '</th>
			 <th width="10%">';echo L('mobile');echo '</th>
			 <th width="5%">';echo L('id_code');echo '</th>
			 <th width="20%">';echo L('msg');echo '</th>
			 <th width="10%">';echo L('send_userid');echo '</th>
			 <th width="15%">';echo L('return_id');echo '</th>
			 <th width="5%">';echo L('status');echo '</th>		 
			 <th width="10%">';echo L('ip');echo '</th>
             <th width="20%">';echo L('posttime');echo '</th>
            </tr>
        </thead>
    <tbody>
';
if(is_array($paylist_arr)) foreach($paylist_arr as $info){
;echo '	<tr>
	<td width="5%">';echo $info['id'];echo '</td>
	<td width="10%" align="center">';echo $info['mobile'];echo '</td>
	<td width="5%" align="center">';echo $info['id_code'];echo '</td>
	<td width="20%" align="center">';if(CHARSET=='gbk') {echo iconv('utf-8','gbk',$info['msg']);}else{echo $info['msg'];};echo '</td>
	<td width="10%" align="center">';echo $info['sms_uid'];echo '</td>	
	<td width="15%" align="center">';echo $info['return_id'];echo '</td>
	<td width="5%" align="center">';echo sms_status($info['status']);;echo '</td>
	<td width="10%" align="center">';echo $info['ip'];echo '</td>
	<td width="20%" align="center">';echo format::date($info['posttime'],1);echo '</td>
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