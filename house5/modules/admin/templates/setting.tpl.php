<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<script type="text/javascript">
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
<form action="?s=admin/setting/save" method="post" id="myform">
<div class="pad-10">
<div class="col-tab">
<ul class="tabBut cu-li">
            <li id="tab_setting_1" class="on" onclick="SwapTab(\'setting\',\'on\',\'\',6,1);">';echo L('setting_basic_cfg');echo '</li>
            <li id="tab_setting_2" onclick="SwapTab(\'setting\',\'on\',\'\',6,2);">';echo L('setting_safe_cfg');echo '</li>
            <li id="tab_setting_3" onclick="SwapTab(\'setting\',\'on\',\'\',6,3);">';echo L('setting_mail_cfg');echo '</li>
			<li id="tab_setting_4" onclick="SwapTab(\'setting\',\'on\',\'\',6,4);">';echo L('setting_connect');echo '</li>
			<li id="tab_setting_5" onclick="SwapTab(\'setting\',\'on\',\'\',6,5);">';echo L('setting_dir');echo '</li>
			<li id="tab_setting_6" onclick="SwapTab(\'setting\',\'on\',\'\',6,6);">';echo L('setting_weixin');echo '</li>
</ul>
<div id="div_setting_1" class="contentList pad-10">
<table width="100%"  class="table_form">
  <tr>
    <th width="120">';echo L('setting_admin_email');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[admin_email]" id="admin_email" size="30" value="';echo $admin_email;echo '"/></td>
  </tr>
  <tr>
    <th width="120">';echo L('setting_category_ajax');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[category_ajax]" id="category_ajax" size="5" value="';echo $category_ajax;echo '"/>&nbsp;&nbsp;&nbsp;&nbsp;';echo L('setting_category_ajax_desc');echo '</td>
  </tr>
  <tr>
    <th width="120">';echo L('setting_gzip');echo '</th>
    <td class="y-bg">
    <input name="setconfig[gzip]" value="1"  type="radio"  ';echo ($gzip=='1') ?' checked': '';echo '> ';echo L('setting_yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="setconfig[gzip]" value="0" type="radio"  ';echo ($gzip=='0') ?' checked': '';echo '> ';echo L('setting_no');echo '</td>
  </tr> 
  <tr>
    <th width="120">';echo L('setting_attachment_stat');echo '</th>
    <td class="y-bg">
    <input name="setconfig[attachment_stat]" value="1"  type="radio"  ';echo ($attachment_stat=='1') ?' checked': '';echo '> ';echo L('setting_yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	<input  name="setconfig[attachment_stat]" value="0" type="radio"  ';echo ($attachment_stat=='0') ?' checked': '';echo '> ';echo L('setting_no');echo '&nbsp;&nbsp;&nbsp;&nbsp;';echo L('setting_attachment_stat_desc');echo '</td>
  </tr>
  <tr>
    <th width="120">';echo L('setting_relative_path');echo '</th>
    <td class="y-bg">
    <input name="setconfig[relative_path]" value="1"  type="radio"  ';echo ($relative_path=='1') ?' checked': '';echo '> ';echo L('setting_yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="setconfig[relative_path]" value="0" type="radio"  ';echo ($relative_path=='0') ?' checked': '';echo '> ';echo L('setting_no');echo '&nbsp;&nbsp;&nbsp;&nbsp;';echo L('setting_relative_path_desc');echo '</td>
  </tr> 	
  <tr>
    <th width="120">';echo L('setting_js_path');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setconfig[js_path]" id="js_path" size="50" value="';echo JS_PATH;echo '" /></td>
  </tr>
  <tr>
    <th width="120">';echo L('setting_css_path');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setconfig[css_path]" id="css_path" size="50" value="';echo CSS_PATH;echo '"/></td>
  </tr> 
  <tr>
    <th width="120">';echo L('setting_img_path');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setconfig[img_path]" id="img_path" size="50" value="';echo IMG_PATH;echo '" /></td>
  </tr>
  <tr>
    <th width="120">';echo L('setting_upload_url');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setconfig[upload_url]" id="upload_url" size="50" value="';echo $upload_url;echo '" /></td>
  </tr>
  <tr>
    <th width="120">';echo L('setting_ftp_enable');echo '</th>
    <td class="y-bg">
    <input name="setconfig[ftp_enable]" value="1"  type="radio"  ';echo ($ftp_enable=='1') ?' checked': '';echo '> ';echo L('setting_yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	<input name="setconfig[ftp_enable]" value="0" type="radio"  ';echo ($ftp_enable=='0') ?' checked': '';echo '> ';echo L('setting_no');echo '</td>
  </tr> 
    <tr>
    <th width="120">';echo L('setting_ftp_pasv');echo '</th>
    <td class="y-bg"><input name="setconfig[ftp_pasv]" value="1"  type="radio"  ';echo ($ftp_pasv=='1') ?' checked': '';echo '> ';echo L('setting_yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="setconfig[ftp_pasv]" value="0" type="radio"  ';echo ($ftp_pasv=='0') ?' checked': '';echo '> ';echo L('setting_no');echo '</td>
    </tr>
  <tr>
    <th width="120">';echo L('setting_ftp_host');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setconfig[ftp_host]" id="ftp_host" size="50" value="';echo $ftp_host;echo '" />&nbsp;&nbsp;&nbsp;&nbsp;可以是 FTP 服务器的 IP 地址或域名</td>
  </tr>       
  <tr>
    <th width="120">';echo L('setting_ftp_user');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setconfig[ftp_user]" id="ftp_user" size="50" value="';echo $ftp_user;echo '" />&nbsp;&nbsp;&nbsp;&nbsp;该帐号必需具有以下权限：读取文件、写入文件、删除文件、创建目录、子目录继承</td>
  </tr>       
  <tr>
    <th width="120">';echo L('setting_ftp_password');echo '</th>
    <td class="y-bg"><input type="password" class="input-text" name="setconfig[ftp_password]" id="ftp_password" size="50" value="';echo $ftp_password;echo '" /></td>
  </tr>              
  <tr>
    <th width="120">';echo L('setting_ftp_port');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setconfig[ftp_port]" id="ftp_port" size="4" value="';echo $ftp_port;echo '" />&nbsp;&nbsp;&nbsp;&nbsp;默认为 21</td>
  </tr>  
  <tr>
    <th width="120">';echo L('setting_ftp_path');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setconfig[ftp_path]" id="ftp_path" size="50" value="';if(!empty($ftp_path)){echo $ftp_path;}else{echo '/';};echo '" /></td>
  </tr>       
  <tr>
    <th width="120">';echo L('setting_ftp_upload_url');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setconfig[ftp_upload_url]" id="ftp_upload_url" size="50" value="';echo $ftp_upload_url;;echo '" /></td>
  </tr> 
</table>
</div>
<div id="div_setting_2" class="contentList pad-10 hidden">
	<table width="100%"  class="table_form">
  <tr>
    <th width="120">';echo L('setting_admin_log');echo '</th>
    <td class="y-bg">
	  <input name="setconfig[admin_log]" value="1" type="radio" ';echo ($admin_log=='1') ?' checked': '';echo '> ';echo L('setting_yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input name="setconfig[admin_log]" value="0" type="radio" ';echo ($admin_log=='0') ?' checked': '';echo '> ';echo L('setting_no');echo '     </td>
  </tr>
  <tr>
    <th width="120">';echo L('setting_error_log');echo '</th>
    <td class="y-bg">
	  <input name="setconfig[errorlog]" value="1" type="radio" ';echo ($errorlog=='1') ?' checked': '';echo '> ';echo L('setting_yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input name="setconfig[errorlog]" value="0" type="radio" ';echo ($errorlog=='0') ?' checked': '';echo '> ';echo L('setting_no');echo '     </td>
  </tr> 
  <tr>
    <th>';echo L('setting_error_log_size');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[errorlog_size]" id="errorlog_size" size="5" value="';echo $errorlog_size;echo '"/> MB</td>
  </tr>     

  <tr>
    <th>';echo L('setting_maxloginfailedtimes');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[maxloginfailedtimes]" id="maxloginfailedtimes" size="10" value="';echo $maxloginfailedtimes;echo '"/></td>
  </tr>

  <tr>
    <th>';echo L('setting_minrefreshtime');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[minrefreshtime]" id="minrefreshtime" size="10" value="';echo $minrefreshtime;echo '"/> ';echo L('miao');echo '</td>
  </tr>
</table>
</div>
<div id="div_setting_3" class="contentList pad-10 hidden">
<table width="100%"  class="table_form">
  <tr>
    <th width="120">';echo L('mail_type');echo '</th>
    <td class="y-bg">
     <input name="setting[mail_type]" checkbox="mail_type" value="1" onclick="showsmtp(this)" type="radio" ';echo $mail_type==1 ?' checked': '';echo '> ';echo L('mail_type_smtp');echo '    <input name="setting[mail_type]" checkbox="mail_type" value="0" onclick="showsmtp(this)" type="radio" ';echo $mail_type==0 ?' checked': '';echo ' ';if(substr(strtolower(PHP_OS),0,3) == 'win') echo 'disabled';;echo '/> ';echo L('mail_type_mail');echo ' 
	</td>
  </tr>
  <tbody id="smtpcfg" style="';if($mail_type == 0) echo 'display:none';echo '">
  <tr>
    <th>';echo L('mail_server');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[mail_server]" id="mail_server" size="30" value="';echo $mail_server;echo '"/></td>
  </tr>  
  <tr>
    <th>';echo L('mail_port');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[mail_port]" id="mail_port" size="30" value="';echo $mail_port;echo '"/></td>
  </tr> 
  <tr>
    <th>';echo L('mail_from');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[mail_from]" id="mail_from" size="30" value="';echo $mail_from;echo '"/></td>
  </tr>   
  <tr>
    <th>';echo L('mail_auth');echo '</th>
    <td class="y-bg">
    <input name="setting[mail_auth]" checkbox="mail_auth" value="1" type="radio" ';echo $mail_auth==1 ?' checked': '';echo '> ';echo L('mail_auth_open');echo '	<input name="setting[mail_auth]" checkbox="mail_auth" value="0" type="radio" ';echo $mail_auth==0 ?' checked': '';echo '> ';echo L('mail_auth_close');echo '</td>
  </tr> 

	  <tr>
	    <th>';echo L('mail_user');echo '</th>
	    <td class="y-bg"><input type="text" class="input-text" name="setting[mail_user]" id="mail_user" size="30" value="';echo $mail_user;echo '"/></td>
	  </tr> 
	  <tr>
	    <th>';echo L('mail_password');echo '</th>
	    <td class="y-bg"><input type="password" class="input-text" name="setting[mail_password]" id="mail_password" size="30" value="';echo $mail_password;echo '"/></td>
	  </tr>

 </tbody>
  <tr>
    <th>';echo L('mail_test');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="mail_to" id="mail_to" size="30" value=""/> <input type="button" class="button" onClick="javascript:test_mail();" value="';echo L('mail_test_send');echo '"></td>
  </tr>           
  </table>
</div>

<div id="div_setting_4" class="contentList pad-10 hidden">
<table width="100%"  class="table_form">

  <tr>
    <th>';echo L('setting_connect_sina');echo '</th>
    <td class="y-bg">
	App key <input type="text" class="input-text" name="setconfig[sina_akey]" id="sina_akey" size="20" value="';echo $sina_akey ;echo '"/>
	App secret key <input type="text" class="input-text" name="setconfig[sina_skey]" id="sina_skey" size="40" value="';echo $sina_skey ;echo '"/> <a href="http://open.t.sina.com.cn/wiki/index.php/';echo L('connect_micro');echo '" target="_blank">';echo L('click_register');echo '</a>
	</td>
  </tr>

  <tr>
    <th>';echo L('setting_connect_qq');echo '</th>
    <td class="y-bg">
	App key <input type="text" class="input-text" name="setconfig[qq_akey]" id="qq_akey" size="20" value="';echo $qq_akey ;echo '"/>
	App secret key <input type="text" class="input-text" name="setconfig[qq_skey]" id="qq_skey" size="40" value="';echo $qq_skey ;echo '"/> <a href="http://open.t.qq.com/" target="_blank">';echo L('click_register');echo '</a>
	</td>
  </tr> 
<tr>
    <th>';echo L('setting_connect_qqnew');echo '</th>
    <td class="y-bg">
	App I D  &nbsp;<input type="text" class="input-text" name="setconfig[qq_appid]" id="qq_appid" size="20" value="';echo $qq_appid;;echo '"/>
	App key <input type="text" class="input-text" name="setconfig[qq_appkey]" id="qq_appkey" size="40" value="';echo $qq_appkey;;echo '"/> 
	';echo L('setting_connect_qqcallback');echo ' <input type="text" class="input-text" name="setconfig[qq_callback]" id="qq_callback" size="40" value="';echo $qq_callback;;echo '"/>
	<a href="http://connect.qq.com" target="_blank">';echo L('click_register');echo '</a>
	</td>
  </tr> 
  </table>
</div>
<div id="div_setting_5" class="contentList pad-10 hidden">
<table width="100%"  class="table_form">
  <tr>
    <th>';echo L('admin_url');echo '</th>
    <td class="y-bg"><TABLE>
    <TR>
		<TD width="270">';echo SITE_PROTOCOL;;echo '<input type="text" class="input-text" name="setconfig[admin_url]" id="admin_url" size="30" value="';echo $admin_url;echo '"/> </TD>
		<TD>';echo L('admin_url_tips');echo '</TD>
    </TR>
    </TABLE> </td>
  </tr>
  <tr>
    <th>';echo L('house_path');echo '</th>
    <td class="y-bg"><TABLE>
    <TR>
		<TD width="270"><input type="text" class="input-text" name="setconfig[house_path]" id="house_path" size="30" value="';echo $house_path;echo '"/> </TD>
		<TD>';echo L('house_path_tips');echo '</TD>
    </TR>
    </TABLE> </td>
  </tr>
  <tr>
    <th>新房二级域名域名根</th>
    <td class="y-bg"><TABLE>
    <TR>
		<TD width="270"><input type="text" class="input-text" name="setconfig[house_domain]" id="house_domain" size="30" value="';echo $house_domain;echo '"/> </TD>
		<TD>例如：domain.com，用于启用新房二级域名(需做泛解析)</TD>
    </TR>
    </TABLE> </td>
  </tr>
  <tr>
    <th>';echo L('esf_path');echo '</th>
    <td class="y-bg"><TABLE>
    <TR>
		<TD width="270"><input type="text" class="input-text" name="setconfig[esf_path]" id="esf_path" size="30" value="';echo $esf_path;echo '"/> </TD>
		<TD>';echo L('esf_path_tips');echo '</TD>
    </TR>
    </TABLE> </td>
  </tr>
  <tr>
    <th>';echo L('tuan_path');echo '</th>
    <td class="y-bg"><TABLE>
    <TR>
		<TD width="270"><input type="text" class="input-text" name="setconfig[tuan_path]" id="tuan_path" size="30" value="';echo $tuan_path;echo '"/> </TD>
		<TD>';echo L('tuan_path_tips');echo '</TD>
    </TR>
    </TABLE> </td>
  </tr>
  <tr>
    <th>';echo L('bbs_path');echo '</th>
    <td class="y-bg"><TABLE>
    <TR>
		<TD width="270"><input type="text" class="input-text" name="setconfig[bbs_path]" id="bbs_path" size="30" value="';echo $bbs_path;echo '"/> </TD>
		<TD>';echo L('bbs_path_tips');echo '</TD>
    </TR>
    </TABLE> </td>
  </tr> 
  <tr>
    <th>';echo L('member_path');echo '</th>
    <td class="y-bg"><TABLE>
    <TR>
		<TD width="270"><input type="text" class="input-text" name="setconfig[member_path]" id="member_path" size="30" value="';echo $member_path;echo '"/> </TD>
		<TD>';echo L('member_path_tips');echo '</TD>
    </TR>
    </TABLE> </td>
  </tr> 
</table>
</div>
<div id="div_setting_6" class="contentList pad-10 hidden">
<table width="100%"  class="table_form">
  <tr>
    <th>';echo L('weixin_token');echo '</th>
    <td class="y-bg"><TABLE>
    <TR>
		<TD width="270"><input type="text" class="input-text" name="setconfig[weixin_token]" id="weixin_token" size="30" value="';echo $weixin_token;echo '"/> </TD>
		<TD>';echo L('weixin_token_tips');echo '</TD>
    </TR>
    </TABLE> </td>
  </tr>
  <tr>
    <th>';echo L('weixin_reply');echo '</th>
    <td class="y-bg"><TABLE>
    <TR>
		<TD width="270"><textarea name="setconfig[weixin_reply]" id="weixin_reply" rows="2" cols="20" id="name" class="inputtext" style="height:90px;width:270px;">';echo $weixin_reply;echo '</textarea></TD>
		<TD>';echo L('weixin_reply_tips');echo '</TD>
    </TR>
    </TABLE> </td>
  </tr>
  <tr>
    <th>';echo L('weixin_url');echo '</th>
    <td class="y-bg"><TABLE>
    <TR>
<TD width="270">';echo APP_PATH.'api.php?op=weixin';echo '</TD>
		<TD>';echo L('weixin_url_tips');echo '</TD>
    </TR>
    </TABLE> </td>
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

function showsmtp(obj,hiddenid){
	hiddenid = hiddenid ? hiddenid : \'smtpcfg\';
	var status = $(obj).val();
	if(status == 1) $("#"+hiddenid).show();
	else  $("#"+hiddenid).hide();
}
function test_mail() {
	var mail_type = $(\'input[checkbox=mail_type][checked]\').val();
	var mail_auth = $(\'input[checkbox=mail_auth][checked]\').val();
    $.post(\'?s=admin/setting/public_test_mail/mail_to/\'+$(\'#mail_to\').val(),{mail_type:mail_type,mail_server:$(\'#mail_server\').val(),mail_port:$(\'#mail_port\').val(),mail_user:$(\'#mail_user\').val(),mail_password:$(\'#mail_password\').val(),mail_auth:mail_auth,mail_from:$(\'#mail_from\').val()}, function(data){
	alert(data);
	});
}

</script>
</html>';?>