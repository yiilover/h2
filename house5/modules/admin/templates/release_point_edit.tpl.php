<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');
;echo '<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#name").formValidator({onshow:"';echo L('input').L('release_point_name');echo '",onfocus:"';echo L('input').L('release_point_name');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('release_point_name');echo '"}).ajaxValidator({type : "get",url : "",data :"s=admin/release_point/public_name/id/';echo $id;echo '",datatype : "html",async:\'false\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('release_point_name').L('exists');echo '",onwait : "';echo L('connecting');echo '"}).defaultPassed();
		$("#host").formValidator({onshow:"';echo L('input').L('server_address');echo '",onfocus:"';echo L('input').L('server_address');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('server_address');echo '"});
		$("#port").formValidator({onshow:"';echo L('input').L('server_port');echo '",onfocus:"';echo L('input').L('server_port');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('server_port');echo '"}).regexValidator({datatype:\'enum\',regexp:\'intege1\',onerror:\'';echo L('server_ports_must_be_integers');echo '\'});
		$("#username").formValidator({onshow:"';echo L('input').L('username');echo '",onfocus:"';echo L('input').L('username');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('username');echo '"});
		$("#password").formValidator({onshow:"';echo L('input').L('password');echo '",onfocus:"';echo L('input').L('password');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('password');echo '"});
		
	})
//-->
</script>
<div class="pad-10">
<form action="?s=admin/release_point/edit/id/';echo $id;echo '" method="post" id="myform">
<fieldset>
	<legend>';echo L('basic_configuration');echo '</legend>
	<table width="100%"  class="table_form">
  <tr>
    <th width="80">';echo L('release_point_name');echo '£º</th>
    <td class="y-bg"><input type="text" class="input-text" name="name" id="name" size="30" value="';echo $data['name'];echo '" /></td>
  </tr>
</table>
</fieldset>
<div class="bk15"></div>
<fieldset>
	<legend>';echo L('ftp_server');echo '</legend>
	<table width="100%"  class="table_form">
  <tr>
    <th width="80">';echo L('server_address');echo '£º</th>
    <td class="y-bg"><input type="text" class="input-text" name="host" id="host" size="30" value="';echo $data['host'];echo '" /></td>
  </tr>
   <tr>
    <th width="80">';echo L("server_port");echo '£º</th>
    <td class="y-bg"><input type="text" class="input-text" name="port" id="port" size="30" value="';echo $data['port'];echo '" /></td>
  </tr>
  <tr>
    <th>';echo L('username');echo '£º</th>
    <td class="y-bg"><input type="text" class="input-text" name="username" id="username" size="30" value="';echo $data['username'];echo '" /></td>
  </tr>
    <tr>
    <th>';echo L('password');echo '£º</th>
    <td class="y-bg"><input type="password" class="input-text" name="password" id="password" size="30"  value="';echo $data['password'];echo ' "/></td>
  </tr>
    <tr>
    <th>';echo L('path');echo '£º</th>
    <td class="y-bg"><input type="text" class="input-text" name="path" id="path" size="30" value="';echo $data['path'];echo '" /></td>
  </tr>
      <tr>
    <th>';echo L('passive_mode');echo '£º</th>
    <td class="y-bg"><label><input type="checkbox" class="inputcheckbox" name="pasv" id="pasv" value="1" size="30"';if ($data['pasv']){echo ' checked';};echo ' />';echo L('yes');echo '</label></td>
  </tr>
    <tr>
    <th>';echo L('ssl_connection');echo '£º</th>
    <td class="y-bg"><label><input type="checkbox" class="inputcheckbox" name="ssl" id="ssl" value="1" size="30"';if ($data['ssl']){echo ' checked';};echo ' ';if(!$this->ssl){echo 'disabled';};echo ' />';echo L('yes');echo '</label> ';if(!$this->ssl){echo '<span style="color:red">'.L('your_server_will_not_support_the_ssl_connection').'</a>';};echo '</td>
  </tr>
    </tr>
    <tr>
    <th>';echo L('test_connections');echo '£º</th>
    <td class="y-bg"><input type="button" class="button" onclick="ftp_test()" value="';echo L('test_connections');echo '" /></td>
  </tr>
</table>
</fieldset>
<div class="bk15"></div>
    <input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="';echo L('submit');echo '" />
</div>
</div>
<script type="text/javascript">
<!--
function ftp_test() {
	if(!$.formValidator.isOneValid(\'host\')) {
		$(\'#host\').focus();
		return false;
	}
	if(!$.formValidator.isOneValid(\'port\')) {
		$(\'#port\').focus();
		return false;
	}
	if(!$.formValidator.isOneValid(\'username\')) {
		$(\'#username\').focus();return false;
	}
	if(!$.formValidator.isOneValid(\'password\')) {
		$(\'#password\').focus();return false;
	}
	var host = $(\'#host\').val();
	var port = $(\'#port\').val();
	var username = $(\'#username\').val();
	var password = $(\'#password\').val();
	var pasv = $("input[type=\'checkbox\'][name=\'pasv\']:checked").val();
	var ssl = $("input[type=\'checkbox\'][name=\'ssl\']:checked").val();
	$.get("?",{m:\'admin\',c:\'release_point\',a:\'public_test_ftp\', host:host,port:port,username:username,password:password,pasv:pasv,ssl:ssl}, function(data){
		if (data==1){
			alert(\'';echo L('ftp_server_connections_success');echo '\');
		} else {
			alert(data);
		}
	})
}
//-->
</script>
</form>
</body>
</html>';?>