<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '
<div class="pad-lr-10">
<div class="table-list">
<div class="common-form">
	<input type="hidden" name="info[userid]" value="';echo $memberinfo['userid'];echo '"></input>
	<input type="hidden" name="info[username]" value="';echo $memberinfo['username'];echo '"></input>
<fieldset>
	<legend>';echo L('basic_configuration');echo '</legend>
	<table width="100%" class="table_form">
		<tr>
			<td width="120">';echo L('username');echo '</td> 
			<td>';echo $memberinfo['username'];echo '';if($memberinfo['islock']) {;echo '<img title="';echo L('lock');echo '" src="';echo IMG_PATH;echo 'icon/icon_padlock.gif">';};echo '';if($memberinfo['vip']) {;echo '<img title="';echo L('vip');echo '" src="';echo IMG_PATH;echo 'icon/vip.gif">';};echo '</td>
		</tr>
		<tr>
			<td>';echo L('avatar');echo '</td> 
			<td><img src="';echo $memberinfo['avatar'];echo '" onerror="this.src=\'';echo IMG_PATH;echo 'member/nophoto.gif\'" height=90 width=90></td>
		</tr>
		<tr>
			<td>';echo L('nickname');echo '</td> 
			<td>';echo $memberinfo['nickname'];echo '</td>
		</tr>
		<tr>
			<td>';echo L('email');echo '</td>
			<td>
			';echo $memberinfo['email'];echo '			</td>
		</tr>
		<tr>
			<td>';echo L('member_group');echo '</td>
			<td>
			';echo $grouplist[$memberinfo['groupid']]['name'];;echo '			</td>
		</tr>
		<tr>
			<td>';echo L('member_model');echo '</td>
			<td>
			';echo $modellist[$modelid]['name'];;echo '			</td>
		</tr>
		<tr>
			<td>';echo L('in_site_name');echo '</td>
			<td>
			';echo $sitelist[$memberinfo['siteid']]['name'];;echo '			</td>
		</tr>
		
		';if($memberinfo['vip']) {;echo '		<tr>
			<td>';echo L('vip').L('overduedate');echo '</td>
			<td>
			 ';echo date('Y-m-d H:i:s',$memberinfo['overduedate']);;echo '			</td>
		</tr>
		';};echo '		
	</table>
</fieldset>
<div class="bk15"></div>
<fieldset>
	<legend>';echo L('more_configuration');echo '</legend>
	<table width="100%" class="table_form">
	';foreach($member_fieldinfo as $k=>$v) {;echo '		<tr>
			<td width="120">';echo $k;echo '</td> 
			<td>';echo $v;echo '</td>
		</tr>
	';};echo '	</table>
</fieldset>
</div>
<div class="bk15"></div>
<input type="button" class="dialog" name="dosubmit" id="dosubmit" onclick="window.top.art.dialog({id:\'modelinfo\'}).close();"/>
</div>
</div>
</body>
</html>';?>