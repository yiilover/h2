<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = $show_header = 1;
include $this->admin_tpl('header','admin');
$authkey = upload_key('1,'.$this->M['ext'].',1');
;echo '<script language="javascript" type="text/javascript" src="';echo JS_PATH;;echo 'formvalidator.js" charset="UTF-8"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;;echo 'formvalidatorregex.js" charset="UTF-8"></script>

<div class="subnav">
    <div class="content-menu ib-a blue line-x">
    ';if(isset($big_menu)) echo '<a class="add fb" href="'.$big_menu[0].'"><em>'.$big_menu[1].'</em></a>��';;echo '    ';echo admin::submenu($_GET['menuid'],$big_menu);;echo '<span>|</span><a href="javascript:window.top.art.dialog({id:\'setting\',iframe:\'?s=poster/space/setting\', title:\'';echo L('module_setting');echo '\', width:\'540\', height:\'320\'}, function(){var d = window.top.art.dialog({id:\'setting\'}).data.iframe;var form = d.document.getElementById(\'dosubmit\');form.click();return false;}, function(){window.top.art.dialog({id:\'setting\'}).close()});void(0);"><em>';echo L('module_setting');echo '</em></a>
    </div>
</div>

<form method="post" action="?s=poster/poster/add" id="myform">
<table class="table_form" width="100%" cellspacing="0">
<tbody>
	<tr>
		<th width="100">';echo L('poster_title');echo '��</th>
		<td><input name="poster[name]" id="name" class="input-text" type="text" size="25"></td>
	</tr>
	<tr>
		<th>';echo L('for_postion');echo '��</th>
		<td>';if($spaceid) {echo '<b style="color:#F60;">',$sinfo['name'],'</b>&nbsp;[',$TYPES[$sinfo['type']],']<input type="hidden" name="poster[spaceid]" value="'.$spaceid.'">';}else {;echo '<select name="poster[spaceid]" id="spaceid" onchange="AdsType(this.value)">
		<option value=\'\'>';echo L('please_select');echo '</option>
		';foreach($spaces as $s) {;echo '			<option value="';echo $s['spaceid'];echo '">';echo $s['name'];echo '</option>
		';};echo '</select>';};echo '</td>
	</tr>
	<tr>
    	<th align="right"  valign="top">';echo L('poster_type');echo '��</th>
        <td valign="top" colspan="2">';echo form::select($setting['type'],'','name="poster[type]" id="type" onchange="AdsType(this.value)"',$default);;echo '        </td>
    </tr>
	<tr>
		<th>';echo L('line_time');echo '��</th>
		<td>';echo form::date('poster[startdate]',date('Y-m-d H:i:s',SYS_TIME),1);echo '</td>
	</tr>
	<tr>
		<th>';echo L('down_time');echo '��</th>
		<td>';echo form::date('poster[enddate]','',1);echo '</td>
	</tr>
	</tbody>
	</table>';if(array_key_exists('images',$setting['type'])) {;echo '<div class="pad-10" id="imagesdiv" style="display:">
	<fieldset>
	<legend>';echo L('photo_setting');echo '</legend>
	';if($setting['num']>1) {for($i=1;$i<=$setting['num'];$i++) {;echo '	<table width="100%"  class="table_form">
	<tbody>
  <tr>
    <th width="80">';echo L('linkurl');echo '��</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[images][';echo $i;;echo '][linkurl]" id="linkurl';echo $i;;echo '" size="30" value="http://" /></td>
    <td rowspan="2"><a href="javascript:flashupload(\'imgurl';echo $i;;echo '_images\', \'';echo L('upload_photo');echo '\',\'imgurl';echo $i;;echo '\',preview,\'1,';echo $this->M['ext'];echo ',1\',\'poster\', \'\', \'';echo $authkey;echo '\');void(0);"><img src="';echo IMG_PATH;;echo 'icon/upload-pic.png" id="imgurl';echo $i;;echo '_s" width="105" height="88"></a><input type="hidden" id="imgurl';echo $i;;echo '" name="setting[images][';echo $i;;echo '][imageurl]"></td>
  </tr>
  <tr>
    <th>';echo L('alt');echo '��</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[images][';echo $i;;echo '][alt]" id="alt';echo $i;;echo '" size="30" /></td>
  </tr>
</table>
';}}else {;echo '<table width="100%"  class="table_form">
	<tbody>
  <tr>
    <th width="80">';echo L('linkurl');echo '��</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[images][1][linkurl]" id="linkurl3" size="30" value="http://" /></td>
    <td rowspan="2"><a href="javascript:flashupload(\'imgurl_images\', \'';echo L('upload_photo');echo '\',\'imgurl\',preview,\'1,';echo $this->M['ext'];echo ',1\',\'poster\', \'\', \'';echo $authkey;echo '\');void(0);"><img src="';echo IMG_PATH;;echo 'icon/upload-pic.png" id="imgurl_s" width="105" height="88"></a><input type="hidden" id="imgurl" name="setting[images][1][imageurl]"></td>
  </tr>
  <tr>
    <th>';echo L('alt');echo '��</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[images][1][alt]" id="alt3" size="30" /></td>
  </tr>
  </tbody>
</table>
';};echo '</fieldset></div>';}if(array_key_exists('flash',$setting['type'])) {;echo '<div class="pad-10" id="flashdiv" style="display:none;">
	<fieldset>
	<legend>';echo L('flash_setting');echo '</legend>
	';if($setting['num']>1) {for($i=1;$i<=$setting['num'];$i++) {;echo '	<table width="100%"  class="table_form">
	<tbody>
  <tr>
    <th width="80">';echo L('flash_url');echo '��</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[flash][';echo $i;;echo '][flashurl]" id="flashurl';echo $i;;echo '" size="40" /></td>
    <td class="y-bg"><input type="button" class="button" onclick="javascript:flashupload(\'flashurl';echo $i;;echo '_images\', \'';echo L('flash_upload');echo '\',\'flashurl';echo $i;;echo '\',submit_attachment,\'1,';echo $this->M['ext'];echo ',1\',\'poster\', \'\', \'';echo $authkey;echo '\')" value="';echo L('flash_upload');echo '"></td>
  </tr>
  </tbody>
</table>
';}}else {;echo '<table width="100%"  class="table_form">
	<tbody>
  <tr>
    <th width="80">';echo L('flash_url');echo '��</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[flash][1][flashurl]" id="flashurl" size="40"  /></td>
    <td class="y-bg"><input type="button" class="button" onclick="javascript:flashupload(\'flashurl_images\', \'';echo L('flash_upload');echo '\',\'flashurl\',submit_attachment,\'1,';echo $this->M['ext'];echo ',1\',\'poster\', \'\', \'';echo $authkey;echo '\')" value="';echo L('flash_upload');echo '"></td>
  </tr>
  </tbody>
</table>
';};echo '</fieldset></div>';}if(array_key_exists('text',$setting['type'])) {;echo '<div class="pad-10" id="textdiv" style="display:">
	<fieldset>
	<legend>';if ($sinfo['type']=='code') {echo L('code_setting');}else {echo L('word_link');};echo '</legend>
	<table width="100%"  class="table_form">
	<tbody>
	';if($sinfo['type']=='code') {;echo '  <tr>
    <th width="80">';echo L('code_content');echo '��</th>
    <td class="y-bg"><textarea name="setting[text][code]" id="code" cols="55" rows="6">';echo $info['setting']['code'];echo '</textarea></td>
  </tr>
  ';}else {;echo '  <tr>
    <th width="80">';echo L('word_content');echo '��</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[text][1][title]" value="';echo $info['setting'][1]['title'];echo '" id="title" size="30" /></td>
  </tr>
  <tr>
    <th>';echo L('linkurl');echo '��</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[text][1][linkurl]" id="link" size="30" value="';echo $info['setting'][1]['linkurl'];echo '"  /></td>
  </tr>';};echo '  </tbody>
</table>
</fieldset></div>';};echo '<div class="bk15" style="margin-left:10px; line-height:30px;"><input type="submit" name="dosubmit" id="dosubmit" value=" ';echo L('ok');echo ' " class="button">&nbsp;<input type="reset" value=" ';echo L('goback');echo ' " class="button" onclick="history.go(-1)"></div>

	
</form>
</body>
</html>
<script type="text/javascript">
function AdsType(type) {
	$(\'#imagesdiv\').css(\'display\', \'none\');
	$(\'#flashdiv\').css(\'display\', \'none\');
	$(\'#\'+type+\'div\').css(\'display\', \'\');
}
$(document).ready(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'220\',height:\'70\'}, function(){this.close();$(obj).focus();})}});
	$(\'#name\').formValidator({onshow:"';echo L('please_input_name');echo '",onfocus:"';echo L('name_three_length');echo '",oncorrect:"';echo L('correct');echo '"}).inputValidator({min:6,onerror:"';echo L('adsname_no_empty');echo '"}).ajaxValidator({type:"get",url:"",data:"s=poster/poster/public_check_poster",datatype:"html",cached:false,async:\'true\',success : function(data) {
        if( data == "1" )
		{
            return true;
		}
        else
		{
            return false;
		}
	},
	error: function(){alert("';echo L('server_busy');echo '");},
	onerror : "';echo L('ads_exist');echo '",
	onwait : "';echo L('checking');echo '"
});
	$(\'#type\').formValidator({onshow:"';echo L('choose_ads_type');echo '",onfocus:"';echo L('type_selected');echo '",oncorrect:"';echo L('correct');echo '",defaultvalue:"images"}).inputValidator({min:1,onerror: "';echo L('choose_ads_type');echo '"});
	$(\'#startdate\').formValidator({onshow:"';echo L('online_time');echo '",onfocus:"';echo L('online_time');echo '",oncorrect:"';echo L('correct');echo '"}).functionValidator({fun:isDateTime});
	$(\'#enddate\').formValidator({onshow:"';echo L('one_month_no_select');echo '",onfocus:"';echo L('down_time');echo '",oncorrect:"';echo L('correct');echo '"}).inputValidator();
	';if(array_key_exists('text',$setting['type'])) {;echo '	';if($sinfo['type']=='text') {;echo '	$(\'#title\').formValidator({onshow:\'';echo L('link_content');echo '\',onfoucs:\'';echo L('link_content');echo '\',oncorrect:\'';echo L('correct');echo '\'}).inputValidator({min:1,onerror:\'';echo L('no_link_content');echo '\'});
	';}elseif($sinfo['type']=='code') {;echo '	$(\'#code\').formValidator({onshow:"';echo L('input_code');echo '",onfocus:"';echo L('input_code');echo '",oncorrect:"';echo L('correct');echo '"}).inputValidator({min:1,onerror:\'';echo L('input_code');echo '\'});
	';}};echo '});
 function preview(uploadid,returnid){
		var d = window.top.art.dialog({id:uploadid}).data.iframe;
		var in_content = d.$("#att-status").html().substring(1);
		$(\'#\'+returnid).val(in_content);
		$(\'#\'+returnid+\'_s\').attr(\'src\', in_content);
}
</script>
<script type="text/javascript" src="';echo JS_PATH;echo 'swfupload/swf2ckeditor.js"></script>';?>