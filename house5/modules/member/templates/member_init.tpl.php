<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<div class="pad-10">
<div class="common-form">
<fieldset>
	<legend>';echo L('basic_configuration');echo '</legend>
	<table width="100%" class="table_form contentWrap">
		<tr>
			<td width="120">';echo L('member_statistics');echo '</td> 
			<td>
				';echo L('member_totalnum');echo '£º';echo $memberinfo['totalnum'];echo '				';echo L('member_todaynum');echo '£º';echo $memberinfo['today_member'];echo '			</td>
		</tr>
		<tr>
			<td width="120">';echo L('member_verify_totalnum');echo '</td> 
			<td>
				';echo $memberinfo['verifynum'];echo '			</td>
		</tr>
		<tr>
			<td width="120">';echo L('member_vip_totalnum');echo '</td> 
			<td>
				';echo $memberinfo['vipnum'];echo '			</td>
		</tr>
	</table>
</fieldset>
<div class="bk15"></div>
<form name="myform" action="" method="get">
<input type="hidden" name="s" value="member/member/search" />
<fieldset>
	<legend>';echo L('member_search');echo '</legend>
<div class="bk10"></div>
<form name="searchform" action="" method="get" >
<input type="hidden" value="member/member/search" name="s">
<input type="hidden" value="879" name="menuid">
<table width="100%" class="table_form contentWrap">
		<tr>
			<td width="120">';echo L('regtime');echo '</td> 
			<td>
				';echo form::date('start_time',$start_time);echo '-
				';echo form::date('end_time',$end_time);echo '			</td>
		</tr>
		<tr>
			<td width="120">';echo L('member_group');echo '</td> 
			<td>
				';echo form::select($grouplist,$_GET['groupid'],'name="groupid"',L('nolimit'));echo '			</td>
		</tr>
		<tr>
			<td width="120">';echo L('status');echo '</td> 
			<td>
				<select name="status">
					<option value=\'0\' ';if(isset($_GET['status']) &&$_GET['status']==0){;echo 'selected';};echo '>';echo L('nolimit');echo '</option>
					<option value=\'1\' ';if(isset($_GET['status']) &&$_GET['status']==1){;echo 'selected';};echo '>';echo L('lock');echo '</option>
					<option value=\'2\' ';if(isset($_GET['status']) &&$_GET['status']==2){;echo 'selected';};echo '>';echo L('normal');echo '</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="120">';echo L('type');echo '</td> 
			<td>
				<select name="type">
					<option value=\'1\' ';if(isset($_GET['type']) &&$_GET['type']==1){;echo 'selected';};echo '>';echo L('username');echo '</option>
					<option value=\'2\' ';if(isset($_GET['type']) &&$_GET['type']==2){;echo 'selected';};echo '>';echo L('uid');echo '</option>
					<option value=\'3\' ';if(isset($_GET['type']) &&$_GET['type']==3){;echo 'selected';};echo '>';echo L('email');echo '</option>
					<option value=\'4\' ';if(isset($_GET['type']) &&$_GET['type']==4){;echo 'selected';};echo '>';echo L('regip');echo '</option>
				</select>
				<input name="keyword" type="text" value="';if(isset($_GET['keyword'])) {echo $_GET['keyword'];};echo '" class="input-text" />
			</td>
		</tr>
		<tr>
			<td width="120">';echo L('amount');echo '</td> 
			<td>
				<input name="amount_from" type="text" value="" class="input-text" size="4"/>-
				<input name="amount_to" type="text" value="" class="input-text" size="4"/>
			</td>
		</tr>
		<tr>
			<td width="120">';echo L('point');echo '</td> 
			<td>
				<input name="point_from" type="text" value="" class="input-text" size="4"/>-
				<input name="point_to" type="text" value="" class="input-text" size="4"/>
			</td>
		</tr>

</table>
<div class="bk15"></div>
<input type="submit" name="search" class="button" value="';echo L('search');echo '" />
</form>

</fieldset>
</form>

</div>
</div>
</body>
</html>';?>