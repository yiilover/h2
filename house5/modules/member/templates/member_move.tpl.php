<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'formvalidator.js" charset="UTF-8"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'formvalidatorregex.js" charset="UTF-8"></script>
<script type="text/javascript">
  $(document).ready(function() {
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$(\'#groupid\').formValidator({onshow:"';echo L('please_select').L('member_group');;echo '",onfocus:"';echo L('please_select').L('member_group');;echo '",defaultvalue:"0"}).inputValidator({min:1,onerror:"';echo L('please_select').L('member_group');;echo '"});
  });
</script>
<div class="pad_10">
<div class="common-form">
<form name="myform" action="?s=member/member/move" method="post" id="myform">
<fieldset>
	<legend>';echo L('basic_configuration');echo '</legend>
	<table width="100%" class="table_form">
		<tr>
			<td width="80">';echo L('username');echo '</td> 
			<td>
				';foreach($userarr as $v) {;echo '					<input type="checkbox" name="userid[]" value="';echo $v['userid'];echo '" checked />
					';echo $v['username'];echo ' 
				';};echo '			</td>
		</tr>
		<tr>
			<td>';echo L('member_group');echo '</td> 
			<td>
				';echo form::select($grouplist,$_GET['groupid'],'id="groupid" name="groupid"',L('please_select'));echo '			</td>
		</tr>
	</table>
</fieldset>

    <div class="bk15"></div>
    <input name="dosubmit" id="dosubmit" type="submit" value="';echo L('submit');echo '" class="dialog">
</form>
</div>
</div>
</body>
</html>';?>