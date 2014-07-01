<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<script type="text/javascript">
<!--
	$(function(){
		SwapTab(\'setting\',\'on\',\'\',5,';echo $_GET['tab'] ?$_GET['tab'] : '1';echo ');
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});		
		$("#js_path").formValidator({onshow:"';echo L('setting_input').L('setting_js_path');echo '",onfocus:"';echo L('setting_js_path').L('setting_end_with_x');echo '"}).inputValidator({onerror:"';echo L('setting_js_path').L('setting_input_error');echo '"}).regexValidator({regexp:"(.+)\\/$",onerror:"';echo L('setting_js_path').L('setting_end_with_x');echo '"});
		$("#css_path").formValidator({onshow:"';echo L('setting_input').L('setting_css_path');echo '",onfocus:"';echo L('setting_css_path').L('setting_end_with_x');echo '"}).inputValidator({onerror:"';echo L('setting_css_path').L('setting_input_error');echo '"}).regexValidator({regexp:"(.+)\\/$",onerror:"';echo L('setting_css_path').L('setting_end_with_x');echo '"});
		
		$("#img_path").formValidator({onshow:"';echo L('setting_input').L('setting_img_path');echo '",onfocus:"';echo L('setting_img_path').L('setting_end_with_x');echo '"}).inputValidator({onerror:"';echo L('setting_img_path').L('setting_input_error');echo '"}).regexValidator({regexp:"(.+)\\/$",onerror:"';echo L('setting_img_path').L('setting_end_with_x');echo '"});
			
		$("#upload_url").formValidator({onshow:"';echo L('setting_input').L('setting_upload_url');echo '",onfocus:"';echo L('setting_upload_url').L('setting_end_with_x');echo '"}).inputValidator({onerror:"';echo L('setting_upload_url').L('setting_input_error');echo '"}).regexValidator({regexp:"(.+)\\/$",onerror:"';echo L('setting_upload_url').L('setting_end_with_x');echo '"});
		
		$("#errorlog_size").formValidator({onshow:"';echo L('setting_errorlog_hint');echo '",onfocus:"';echo L('setting_input').L('setting_error_log_size');echo '"}).inputValidator({onerror:"';echo L('setting_error_log_size').L('setting_input_error');echo '"}).regexValidator({regexp:"num",datatype:"enum",onerror:"';echo L('setting_errorlog_type');echo '"});	
			
		$("#phpsso_api_url").formValidator({onshow:"';echo L('setting_phpsso_type');echo '",onfocus:"';echo L('setting_phpsso_type');echo '",tipcss:{width:\'300px\'},empty:false}).inputValidator({onerror:"';echo L('setting_phpsso_type');echo '"}).regexValidator({regexp:"http:\\/\\/(.+)[^/]$",onerror:"';echo L('setting_phpsso_type');echo '"});
		
		$("#phpsso_appid").formValidator({onshow:"';echo L('input').L('setting_phpsso_appid');echo '",onfocus:"';echo L('input').L('setting_phpsso_appid');echo '"}).regexValidator({regexp:"^\\\\d{1,8}$",onerror:"';echo L('setting_phpsso_appid').L('must_be_number');echo '"});
		$("#phpsso_version").formValidator({onshow:"';echo L('input').L('setting_phpsso_version');echo '",onfocus:"';echo L('input').L('setting_phpsso_version');echo '"}).regexValidator({regexp:"^\\\\d{1,8}$",onerror:"';echo L('setting_phpsso_version').L('must_be_number');echo '"});
		$("#phpsso_auth_key").formValidator({onshow:"';echo L('input').L('setting_phpsso_auth_key');echo '",onfocus:"';echo L('input').L('setting_phpsso_auth_key');echo '"}).regexValidator({regexp:"^\\\\w{32}$",onerror:"';echo L('setting_phpsso_auth_key').L('must_be_32_w');echo '"});
	})
//-->
</script>
<form action="?s=member/member_ucenter/save" method="post" id="myform">
<div class="col-tab">
<ul class="tabBut cu-li">
            <li id="tab_setting_1" class="on" onclick="SwapTab(\'setting\',\'on\',\'\',6,1);">';echo L('setting_basic_cfg');echo '</li>
</ul>
<div id="div_setting_1" class="contentList pad-10">
<table width="100%"  class="table_form">
  <tr>
    <th width="120">';echo L('setting_ucuse');echo '</th>
    <td class="y-bg"><input name="setting[ucuse]" value="1"  type="radio"  ';echo ($ucuse=='1') ?' checked': '';echo '> ';echo L('setting_ucuse_yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="setting[ucuse]" value="0" type="radio"  ';echo ($ucuse=='0') ?' checked': '';echo '> ';echo L('setting_ucuse_no');echo '</td>
  </tr>
  <tr>
    <th width="120">';echo L('setting_uc_api');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[uc_api]" id="uc_api" size="30" value="';echo $uc_api;echo '"/>&nbsp;&nbsp;&nbsp;&nbsp;';echo L('setting_uc_api_desc');echo '</td>
  </tr>
  <tr>
    <th width="120">';echo L('setting_uc_ip');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[uc_ip]" id="uc_ip" size="30" value="';echo $uc_ip;echo '"/>&nbsp;&nbsp;&nbsp;&nbsp;';echo L('setting_uc_ip_desc');echo '</td>
  </tr>
  <tr>
    <th width="120">';echo L('setting_uc_dbhost');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[uc_dbhost]" id="uc_dbhost" size="30" value="';echo $uc_dbhost;echo '"/>&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <th width="120">';echo L('setting_uc_dbuser');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[uc_dbuser]" id="uc_dbuser" size="30" value="';echo $uc_dbuser;echo '"/>&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <th width="120">';echo L('setting_uc_dbpw');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[uc_dbpw]" id="uc_dbpw" size="30" value="';echo $uc_dbpw;echo '"/>&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <th width="120">';echo L('setting_uc_dbname');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[uc_dbname]" id="uc_dbname" size="30" value="';echo $uc_dbname;echo '"/>&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <th width="120">';echo L('setting_uc_dbtablepre');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[uc_dbtablepre]" id="uc_dbtablepre" size="30" value="';echo $uc_dbtablepre;echo '"/>&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <th width="120">';echo L('setting_uc_dbcharset');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[uc_dbcharset]" id="uc_dbcharset" size="30" value="';echo $uc_dbcharset;echo '"/>&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <th width="120">';echo L('setting_uc_appid');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[uc_appid]" id="uc_appid" size="30" value="';echo $uc_appid;echo '"/>&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <th width="120">';echo L('setting_uc_key');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[uc_key]" id="uc_key" size="50" value="';echo $uc_key;echo '"/>&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
</table>
</div>
<div class="bk15"></div>
<input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="button">
</div>
</div>
</form>
</body>
<script type="text/javascript">

function SwapTab(name,cls_show,cls_hide,cnt,cur){
    for(i=1;i<=cnt;i++){
		if(i==cur){
			 $(\'#div_\'+name+\'_\'+i).show();
			 $(\'#tab_\'+name+\'_\'+i).attr(\'class\',cls_show);
		}else{
			 $(\'#div_\'+name+\'_\'+i).hide();
			 $(\'#tab_\'+name+\'_\'+i).attr(\'class\',cls_hide);
		}
	}
}

</script>
</html>';?>