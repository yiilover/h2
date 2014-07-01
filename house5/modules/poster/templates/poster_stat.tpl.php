<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="subnav">
  <h2 class="title-1 line-x f14 fb blue lh28">';echo L('ads_module');echo '</h2>  
<div class="content-menu ib-a blue line-x">
<a class="add fb" href="?s=poster/poster/init&spaceid=';echo $info['spaceid'];;echo '"><em>';echo L('ad_list');echo '</em></a>¡¡<a class="on" href="?s=poster/space"><em>';echo L('space_list');echo '</em></a></div>
</div>
<div class="pad-lr-10">
<div class="col-tab">
        <ul class="tabBut cu-li">
        	
            <li';if($_GET['click']) {;echo ' class="on"';};echo '><a href="?s=poster/poster/stat&id=';echo $_GET['id'];echo '&click=1">';echo L('hits_stat');echo '</a></li>
            <li';if($_GET['click']==0){;echo ' class="on"';};echo '><a href="?s=poster/poster/stat&id=';echo $_GET['id'];echo '&click=0">';echo L('show_stat');echo '</a></li><li style="background:none; border:none;">';if(is_numeric($_GET['click'])) {;echo '<strong><a href="?s=poster/poster/stat&id=';echo $_GET['id'];echo '&click=';echo $_GET['click'];echo '&group=area">';echo L('listorder_f_area');echo '</a></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><a href="?s=poster/poster/stat&id=';echo $_GET['id'];echo '&click=';echo $_GET['click'];echo '&group=ip">';echo L('listorder_f_ip');echo '</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>';};echo '<input name=\'range\' type=\'radio\' value=\'\' onclick="redirect(\'?s=poster/poster/stat&id=';echo $_GET['id'];echo '&click=';echo $_GET['click'];echo '&h5_hash=';echo $_GET['h5_hash'];echo '&group=';echo $_GET['group'];echo '\')" ';if(!$_GET['range']) {;echo 'checked';};echo '> ';echo L('all');echo '<input name=\'range\' type=\'radio\' value=\'1\' onclick="redirect(\'?s=poster/poster/stat&id=';echo $_GET['id'];echo '&click=';echo $_GET['click'];echo '&h5_hash=';echo $_GET['h5_hash'];echo '&group=';echo $_GET['group'];echo '&range=\'+this.value)" ';if($_GET['range']==1) {;echo 'checked';};echo '> ';echo L('today');echo '<input name=\'range\' type=\'radio\' value=\'2\' onclick="redirect(\'?s=poster/poster/stat&id=';echo $_GET['id'];echo '&click=';echo $_GET['click'];echo '&h5_hash=';echo $_GET['h5_hash'];echo '&group=';echo $_GET['group'];echo '&range=\'+this.value)" ';if($_GET['range']==2) {;echo 'checked';};echo '> ';echo L('yesterday');echo '<input name=\'range\' type=\'radio\' value=\'7\' onclick="redirect(\'?s=poster/poster/stat&id=';echo $_GET['id'];echo '&click=';echo $_GET['click'];echo '&h5_hash=';echo $_GET['h5_hash'];echo '&group=';echo $_GET['group'];echo '&range=\'+this.value)" ';if($_GET['range']==7) {;echo 'checked';};echo '> ';echo L('one_week');echo '<input name=\'range\' type=\'radio\' value=\'14\' onclick="redirect(\'?s=poster/poster/stat&id=';echo $_GET['id'];echo '&click=';echo $_GET['click'];echo '&h5_hash=';echo $_GET['h5_hash'];echo '&group=';echo $_GET['group'];echo '&range=\'+this.value)" ';if($_GET['range']==14) {;echo 'checked';};echo '> ';echo L('two_week');echo '<input name=\'range\' type=\'radio\' value=\'30\' onclick="redirect(\'?s=poster/poster/stat&id=';echo $_GET['id'];echo '&click=';echo $_GET['click'];echo '&h5_hash=';echo $_GET['h5_hash'];echo '&group=';echo $_GET['group'];echo '&range=\'+this.value)" ';if($_GET['range']==30) {;echo 'checked';};echo '> ';echo L('one_month');echo ' <font color="red">';echo L('history_select');echo '£º</font><select name="year" onchange="if(this.value!=\'\'){location=\'?s=poster/poster/stat&id=';echo $_GET['id'];echo '&click=';echo $_GET['click'];echo '&h5_hash=';echo $_GET['h5_hash'];echo '&group=';echo $_GET['group'];echo '&year=\'+this.value;}">
';echo $selectstr;;echo '</select></li>
        </ul>
            <div class="content pad-10">
                ';if(is_numeric($_GET['click']) &&$_GET['group']) {;echo '<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            ';if($_GET['group']=='ip') {;echo '            <th width="30%" align="center">';echo L('browse_ip');echo '</th>';};echo '			<th width="30%" align="center">';echo L('for_area');echo '</th>
			<th width="30%" align="center">';echo L('show_times');echo '</th>
            </tr>
        </thead>
    </table>
    <table width="100%" class="contentWrap">
 ';
if(is_array($data)){
foreach($data as $info){
;echo '   
	<tr>
	';if($_GET['group']=='ip') {;echo '	<td align="center" width="30%">';echo $info['ip'];echo '</td>';};echo '	<td align="center" width="30%">
	';echo $info['area'];echo '	</td>
	<td align="center" width="30%">';echo $info['num'];echo '</td>
	</tr>
';
}
}
;echo '    </table>  </div>
 <div id="pages">';echo $pages;echo '</div>
';}else {;echo '<table width="100%" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed;">
      <tr>
       <td style="padding-top:2px;padding-left:6px;padding-right:6px;padding-bottom:8px;">
        <table width="100%" border="1" class="contentWrap" bordercolor="#dddddd" cellpadding="0" cellspacing="0">
          ';if(is_array($data)) {foreach($data as $k =>$v) {;echo '          <tr>
           <td width="24" align="center">';echo intval($k+1);;echo '</td>
           <td style="padding:5px;"><div><span>
           <b>IP£º';echo $v['ip'];echo '</b> ( <b>';echo $v['area'];echo '</b> )</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';echo L('come_from');echo '£º <a href="';echo $v['referer'];echo '" target="_blank">
          ';echo $v['referer'];echo '</a></div>
         <div><span class="item">';echo L('visit_time');echo '£º<em>';echo format::date($v['clicktime'],1);;echo '</em></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';echo L('operate');echo '£º';if($v['type']) {echo L('click');}else {echo L('show');};echo '</div></td>
         </tr>
        ';}};echo '       </table>
      </td>
    </tr>
    <tr>
     <td><div id="pages">';echo $pages;;echo '</div></td>
    </tr>
</table>
';};echo '            </div>
</div>
</div>
</body>
</html>';?>