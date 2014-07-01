<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'formvalidator.js" charset="UTF-8"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'formvalidatorregex.js" charset="UTF-8"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'content_addtop.js"></script>
<script type="text/javascript">
  var charset = \'';echo CHARSET;echo '\';
  $(document).ready(function() {
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#mobile").formValidator({onshow:"';echo L('input').L('mobile');echo '",onfocus:"';echo L('one_msg').L('mobile');echo '"}).inputValidator({min:11,max:110000,onerror:"';echo L('one_msg').L('mobile');echo '"});
  });
</script>
<div class="pad-10">

<form name="smsform" action="index.php?s=sms/sms/exportmobile" method="post" >
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<td>
		<div class="explain-col">		
			';echo L('regtime');echo '：
			';echo form::date('start_time',$start_time);echo '-
			';echo form::date('end_time',$end_time);echo '
			';echo form::select($modellist,$modelid,'name="modelid"',L('member_model'));echo '			';echo form::select($grouplist,$groupid,'name="groupid"',L('member_group'));echo '			<input type="submit" name="search" class="button" value="';echo L('exportmobile');echo '" />
		</div>
		</td>
		</tr>
    </tbody>
</table>
</form>
<div class="common-form">
<form name="myform" action="?s=sms/sms/sms_sent" method="post" id="myform">
<table width="100%" class="table_form">

<tr>
<td width="120">';echo L('content');echo '</td> 
<td><textarea name="content" style="width:200px; height:100px" id="content" onkeyup="strlen_verify(this, \'content_len\', 120)"></textarea> 还可输入<B><span id="content_len">120</span></B> 个字符  </td>
</tr>
<tr>
<td width="120">';echo L('mobile');echo '</td> 
<td><textarea name="mobile" style="width:200px; height:100px" id="mobile"></textarea></td>
</tr>
<tr>
<tr>
<td width="120">';echo L('sendtime');echo '</td> 
<td>
';echo form::date('sendtime',date('Y-m-d H:i:s',SYS_TIME),1);echo '</td>
</tr>
</table>

<div class="btn text-l">
	<input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="button" id="dosubmit">
	注意：群发100条以上的短信，建议先测试发送内容，以防有非法内容被屏蔽。
</div>
<div class="bk15"></div>

</form>
</div>
</body>
</html>';?>