<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#name").formValidator({onshow:"';echo L('input_dbsource_name');echo '",onfocus:"';echo L('input_dbsource_name');echo '"}).inputValidator({min:1,onerror:"';echo L('input_dbsource_name');echo '"}).regexValidator({regexp:"username",datatype:"enum",param:\'i\',onerror:"';echo L('data_source_of_the_letters_and_figures');echo '"}).ajaxValidator({type : "get",url : "",data :"s=dbsource/dbsource_admin/public_name",datatype : "html",async:\'false\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('dbsource_name').L('exists');echo '",onwait : "';echo L('connecting');echo '"});
		$("#host").formValidator({onshow:"';echo L('input').L('server_address');echo '",onfocus:"';echo L('input').L('server_address');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('server_address');echo '"});
		$("#port").formValidator({onshow:"';echo L('input').L('server_port');echo '",onfocus:"';echo L('input').L('server_port');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('server_port');echo '"}).regexValidator({regexp:"intege1",datatype:"enum",param:\'i\',onerror:"';echo L('server_ports_must_be_positive_integers');echo '"});
		$("#dbtablepre").formValidator({onshow:"';echo L('input').L('dbtablepre');echo '",onfocus:"';echo L('tip_pre');echo '"});
		$("#username").formValidator({onshow:"';echo L('input').L('username');echo '",onfocus:"';echo L('input').L('username');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('username');echo '"});
		$("#password").formValidator({onshow:"';echo L('input').L('password');echo '",onfocus:"';echo L('input').L('password');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('password');echo '"});
		$("#dbname").formValidator({onshow:"';echo L('input').L('database');echo '",onfocus:"';echo L('input').L('database');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('database');echo '"});
	})
//-->
</script>
<div class="pad-10">
<form action="?s=dbsource/dbsource_admin/add" method="post" id="myform">
<div>
<fieldset>
	<legend>';echo L('configure_the_external_data_source');echo '</legend>
	<table width="100%"  class="table_form">
  <tr>
    <th width="80">';echo L('dbsource_name');echo '��</th>
    <td class="y-bg"><input type="text" class="input-text" name="name" id="name" size="30" /></td>
  </tr>
  <tr>
    <th>';echo L('server_address');echo '��</th>
    <td class="y-bg"><input type="text" class="input-text" name="host" id="host" size="30" /></td>
  </tr>
    <tr>
    <th>';echo L('server_port');echo '��</th>
    <td class="y-bg"><input type="text" class="input-text" name="port" id="port" value="3306" size="30" /></td>
  </tr>
    <tr>
    <th>';echo L('username');echo '��</th>
    <td class="y-bg"><input type="text" class="input-text" name="username" id="username"  size="30"/></td>
  </tr>
      <tr>
    <th>';echo L('password');echo '��</th>
    <td class="y-bg"><input type="password" class="input-text" name="password" id="password"  size="30"/></td>
  </tr>
        <tr>
    <th>';echo L('database');echo '��</th>
    <td class="y-bg"><input type="text" class="input-text" name="dbname" id="dbname"  size="30"/></td>
  </tr>
  <tr>
    <th>';echo L('dbtablepre');;echo '��</th>
    <td class="y-bg"><input type="text" class="input-text" name="dbtablepre" id="dbtablepre"  size="30"/> </td> 
  </tr>
      <tr>
    <th>';echo L('charset');echo '��</th>
    <td class="y-bg">';echo form::select(array('gbk'=>'GBK','utf8'=>'UTF-8','gb2312'=>'GB2312','latin1'=>'Latin1'),'','name="charset" id="charset"');echo '</td>
  </tr>
      <tr>
    <th></th>
    <td class="y-bg"><input type="button" class="button" value="';echo L('test_connections');echo '" onclick="test_connect()" /></td>
  </tr>
</table>
</fieldset>
<div class="bk15"></div>
    <input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="" />
</div>
</div>
</form>
<script type="text/javascript">
<!--
	function test_connect() {
		$.get(\'?s=dbsource/dbsource_admin/public_test_mysql_connect\', {host:$(\'#host\').val(),username:$(\'#username\').val(), password:$(\'#password\').val(), port:$(\'#port\').val()}, function(data){if(data==1){alert(\'';echo L('connect_success');echo '\')}else{alert(\'';echo L('connect_failed');echo '\')}});
}
//-->
</script>
</body>
</html>';?>