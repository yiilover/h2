<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<form method="post" action="?s=poster/space/edit&spaceid=';echo $_GET['spaceid'];echo '" name="myform" id="myform">
<table class="table_form" width="100%" cellspacing="0">
<tbody>
	<tr>
		<th width="80"><strong>';echo L('boardtype');echo '£º</strong></th>
		<td><input name="space[name]" class="input-text" id="name" type="text" value="';echo htmlspecialchars($info['name']);echo '" size="25"></td>
	</tr>
	<tr>
		<th><strong>';echo L('ads_type');echo '£º</strong></th>
		<td>';echo form::select($TYPES,$info['type'],'name="space[type]" id="type" onchange="AdsType(this.value)"');echo '&nbsp;&nbsp;<span id="ScrollSpan" style="padding-left:30px;display:none;"><label><input type="checkbox" id="ScrollBox" name="setting[scroll]"';if($setting['scroll']) {;echo ' checked';};echo ' value=\'1\'/> ';echo L('rolling');echo '</label></span>
      <span id="AlignSpan" style="padding-left:30px;display:none;"><label><input type="checkbox" ';if($setting['align']) {;echo ' checked';};echo ' id="AlignBox" name="setting[align]" value=\'1\'/> ';echo L('lightbox');echo '</label></span></td>
	</tr>
	<tr id="trPosition" style="display:none;">
    	<th align="right"  valign="top"><strong>';echo L('position');echo '£º</strong></th>
        <td valign="top" colspan="2">
        ';echo L('left_margin');echo '£º<input name=\'setting[paddleft]\' id=\'PaddingLeft\' type=\'text\' size=\'5\' value=\'';echo $setting['paddleft'];echo '\' class="input-text"> px&nbsp;&nbsp;
        ';echo L('top_margin');echo '£º<input name=\'setting[paddtop]\' id=\'PaddingTop\' type=\'text\' size=\'5\' value=\'';echo $setting['paddtop'];echo '\' class="input-text" /> px</div>
        </td>
    </tr>
	<tr id="SizeFormat">
		<th><strong>';echo L('size_format');echo '£º</strong></th>
		<td><label>';echo L('plate_width');echo '</label><input name="space[width]" id="s_width" class="input-text" type="text" value="';echo $info['width'];echo '" size="10"> px &nbsp;&nbsp;&nbsp;&nbsp; <label>';echo L('plate_height');echo '</label><input name="space[height]" id="h_height" type="text" class="input-text" value="';echo $info['height'];echo '" size="10"> px<div id="w_hTip"></div></td>
	</tr>
	<tr>
		<th><strong>';echo L('description');echo '£º</strong></th>
		<td><textarea name="space[description]" id="description" class="input-textarea" cols="45" rows="4">';echo $info['description'];echo '</textarea></td>
	</tr></tbody>
	</table>

<div class="bk15"></div>
<input type="hidden" name="old_type" value="';echo $info['type'];echo '">
<input type="submit" name="dosubmit" id="dosubmit" class=\'dialog\' value="2"/></form>
</body>
</html>
<script language="javascript" type="text/javascript">
function AdsType(adstype) {
	$(\'input[type=checkbox]\').attr(\'checked\', false);
	$(\'#ScrollSpan\').css(\'display\', \'none\');
	$(\'#AlignSpan\').css(\'display\', \'none\');
	$(\'#trPosition\').css(\'display\', \'none\');
	$(\'#SizeFormat\').css(\'display\', \'\');
	$(\'#PaddingLeft\').attr(\'disabled\', false);
	$(\'#PaddingTop\').attr(\'disabled\', false);
	';
if (is_array($poster_template) &&!empty($poster_template)) {
$n = 0;
foreach ($poster_template as $key =>$p) {
if ($n==0) {
echo 'if (adstype==\''.$key.'\') {';
}else {
echo '} else if (adstype==\''.$key.'\') {';
}
if ($p['align']) {
if ($p['align']=='align') {
echo '$(\'#AlignSpan\').css(\'display\', \'\');';
if ($setting['align']) {
echo '$(\'#AlignBox\').attr(\'checked\', \'true\');';
echo '$(\'#PaddingLeft\').attr(\'disabled\', true);';
echo '$(\'#PaddingTop\').attr(\'disabled\', true);';
}
}elseif ($p['align']=='scroll') {
echo '$(\'#ScrollSpan\').css(\'display\', \'\');';
if ($setting['scroll']) {
echo '$(\'#ScrollBox\').attr(\'checked\', \'true\');';
}
}
}
if ($p['padding']) {
echo '$(\'#trPosition\').css(\'display\', \'\');';
}
if (!isset($p['size']) ||!$p['size']) {
echo '$(\'#SizeFormat\').css(\'display\', \'none\');';
}
$n++;
}
}
echo '}';
;echo '}
$(\'#AlignBox\').click( function (){
	if($(\'#AlignBox\').attr(\'checked\')) {
		$(\'#PaddingLeft\').attr(\'disabled\', true);
		$(\'#PaddingTop\').attr(\'disabled\', true);
	} else {
		$(\'#PaddingLeft\').attr(\'disabled\', false);
		$(\'#PaddingTop\').attr(\'disabled\', false);
	}
});
AdsType($(\'#type\').val());
$(document).ready(function(){
	 $.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'220\',height:\'70\'}, function(){this.close();$(obj).focus();})}});
	$("#name").formValidator({onshow:"';echo L('please_input_space_name');echo '",onfocus:"';echo L('spacename_three_length');echo '",oncorrect:"';echo L('correct');echo '"}).inputValidator({min:6,onerror:"';echo L('spacename_illegality');echo '"}).ajaxValidator({type:"get",url:"",data:"s=poster/space/public_check_space&spaceid=';echo $_GET['spaceid'];echo '",datatype:"html",cached:false,async:\'true\',success : function(data) {
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
		onerror : "';echo L('space_exist');echo '",
		onwait : "';echo L('checking');echo '"
	}).defaultPassed();
	$(\'#type\').formValidator({onshow:"';echo L('choose_space_type');echo '",onfocus:"';echo L('choose_space_type');echo '",oncorrect:"';echo L('correct');echo '"}).inputValidator();
	$(\'#s_width\').formValidator({tipid:"w_hTip",onshow:"';echo L('input_width_height');echo '",onfocus:"';echo L('three_numeric');echo '",oncorrect:"';echo L('correct');echo '"}).inputValidator().defaultPassed();
})
</script>';?>