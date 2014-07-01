<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');
;echo '<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#name").formValidator({onshow:"';echo L("input").L('site_name');echo '",onfocus:"';echo L("input").L('site_name');echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('site_name');echo '"}).ajaxValidator({type : "get",url : "",data :"s=admin/site/public_name/siteid/';echo $data['siteid'];echo '",datatype : "html",async:\'true\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('site_name').L('exists');echo '",onwait : "';echo L('connecting');echo '"}).defaultPassed();
		$("#dirname").formValidator({onshow:"';echo L("input").L('site_dirname');echo '",onfocus:"';echo L("input").L('site_dirname');echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('site_dirname');echo '"}).regexValidator({regexp:"username",datatype:"enum",param:\'i\',onerror:"';echo L('site_dirname_err_msg');echo '"}).ajaxValidator({type : "get",url : "",data :"s=admin/site/public_dirname/siteid/';echo $data['siteid'];echo '",datatype : "html",async:\'false\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('site_dirname').L('exists');echo '",onwait : "';echo L('connecting');echo '"}).defaultPassed();
		$("#domain").formValidator({onshow:"';echo L('site_domain_ex');echo '",onfocus:"';echo L('site_domain_ex');echo '",tipcss:{width:\'300px\'},empty:false}).inputValidator({onerror:"';echo L('site_domain_ex');echo '"}).regexValidator({regexp:"http:\\/\\/(.+)\\/$",onerror:"';echo L('site_domain_ex2');echo '"});
		$("#template").formValidator({onshow:"';echo L('style_name_point');echo '",onfocus:"';echo L('select_at_least_1');echo '"}).inputValidator({min:1,onerror:"';echo L('select_at_least_1');echo '"});
		$(\'#release_point\').formValidator({onshow:"';echo L('publishing_sites_to_other_servers');echo '",onfocus:"';echo L('choose_release_point');echo '"}).inputValidator({max:4,onerror:"';echo L('most_choose_four');echo '"});
		$(\'#default_style_input\').formValidator({tipid:"default_style_msg",onshow:"';echo L('please_select_a_style_and_select_the_template');echo '",onfocus:"';echo L('please_select_a_style_and_select_the_template');echo '"}).inputValidator({min:1,onerror:"';echo L('please_choose_the_default_style');echo '"});
		$("#copyright").formValidator({onshow:"';echo L('site_copyright');echo '",onfocus:"';echo L('site_copyright');echo '",tipcss:{width:\'300px\'},empty:false});
		$("#default_city").formValidator({onshow:"';echo L('default_city');echo '",onfocus:"';echo L('default_city');echo '",tipcss:{width:\'300px\'},empty:false});
		$("#city_map").formValidator({onshow:"';echo L('city_map_ex');echo '",onfocus:"';echo L('city_map_ex');echo '",tipcss:{width:\'300px\'},empty:false});
		$("#map_key").formValidator({onshow:"';echo L('map_key_ex');echo '",onfocus:"';echo L('map_key_ex');echo '",tipcss:{width:\'300px\'},empty:false});
	})
//-->
</script>
<style type="text/css">
.radio-label{ border-top:1px solid #e4e2e2; border-left:1px solid #e4e2e2}
.radio-label td{ border-right:1px solid #e4e2e2; border-bottom:1px solid #e4e2e2;background:#f6f9fd}
</style>
<div class="pad-10">
<form action="?s=admin/site/edit/siteid/';echo $siteid;echo '" method="post" id="myform">
<fieldset>
	<legend>';echo L('basic_configuration');echo '</legend>
	<table width="100%"  class="table_form">
  <tr>
    <th width="80">';echo L('site_name');echo '：</th>
    <td class="y-bg"><input type="text" class="input-text" name="name" id="name" size="30" value="';echo $data['name'];echo '" /></td>
  </tr>
  <tr>
    <th>';echo L('site_dirname');echo '：</th>
    <td class="y-bg">';if ($siteid == 1) {echo $data['dirname'];}else {;echo '<input type="text" class="input-text" name="dirname" id="dirname" size="30" value="';echo $data['dirname'];echo '" />';};echo '</td>
  </tr>
    <tr>
    <th>';echo L('site_domain');echo '：</th>
    <td class="y-bg"><input type="text" class="input-text" name="domain" id="domain"  size="30" value="';echo $data['domain'];echo '" /></td>
  </tr>
  <tr>
    <th>';echo L('default_city');echo '：</th>
    <td class="y-bg"><input type="text" class="input-text" name="default_city" id="default_city"  size="30" value="';echo $data['default_city'];echo '" /></td>
  </tr>
  <tr>
    <th>';echo L('city_map');echo '：</th>
    <td class="y-bg"><input type="text" class="input-text" name="city_map" id="city_map"  size="30" value="';echo $data['city_map'];echo '" /></td>
  </tr>
  <tr>
    <th>';echo L('map_key');echo '：</th>
    <td class="y-bg"><input type="text" class="input-text" name="map_key" id="map_key"  size="50" value="';echo $data['map_key'];echo '" /></td>
  </tr>
</table>
</fieldset>
<div class="bk10"></div>
<fieldset>
	<legend>';echo L('seo_configuration');echo '</legend>
	<table width="100%"  class="table_form">
  <tr>
    <th width="80">';echo L('site_title');echo '：</th>
    <td class="y-bg"><input type="text" class="input-text" name="site_title" id="site_title" size="30" value="';echo $data['site_title'];echo '" /></td>
  </tr>
  <tr>
    <th>';echo L('keyword_name');echo '：</th>
    <td class="y-bg"><input type="text" class="input-text" name="keywords" id="keywords" size="30" value="';echo $data['keywords'];echo '" /></td>
  </tr>
    <tr>
    <th>';echo L('description');echo '：</th>
    <td class="y-bg"><input type="text" class="input-text" name="description" id="description" size="30" value="';echo $data['description'];echo '" /></td>
  </tr>
</table>
</fieldset>
<div class="bk10"></div>
<fieldset>
	<legend>底部版权信息</legend>
	<table width="100%"  class="table_form">
  <tr>
    <th width="80" valign="top">';echo L('description');echo '：</th>
    <td class="y-bg"><textarea name="copyright" id="copyright" cols="50"
			rows="6">';echo $data['copyright'];echo '</textarea></td>
  </tr>
</table>
</fieldset>
<div class="bk10"></div>
<fieldset>
	<legend>';echo L('template_style_configuration');echo '</legend>
	<table width="100%"  class="table_form">
  <tr>
    <th width="80" valign="top">';echo L('style_name');echo '：</th>
    <td class="y-bg"> <select name="template[]" size="3" id="template" multiple title="';echo L('ctrl_more_selected');echo '" onchange="default_list()">
    
    	';
$default_template_list =  array();
if (isset($data['template'])) {
$dirname = explode(',',$data['template']);
}else {
$dirname = array();
}
if(is_array($template_list)):
foreach ($template_list as $key=>$val):
$default_template_list[$val['dirname']] = $val['name'];
;echo '		  <option value="';echo $val['dirname'];echo '" ';if(in_array($val['dirname'],$dirname)){echo 'selected';};echo '>';echo $val['name'];echo '</option>
		  ';endforeach;endif;;echo '		</select></td>
  </tr>
  <tr>
    <th width="80" valign="top">';echo L('default_style');echo '：<input type="hidden" name="default_style" id="default_style_input" value="';echo $data['default_style'];echo '"></th>
    <td class="y-bg"><span id="default_style">
	';
if(is_array($dirname) &&!empty($dirname)) foreach ($dirname as $v) {
echo '<label><input type="radio" name="default_style_radio" value="'.$v.'" onclick="$(\'#default_style_input\').val(this.value);" '.($data['default_style']==$v ?'checked': '').'>'.$default_template_list[$v].'</label>';
}
;echo '	</span><span id="default_style_msg"></span></td>
  </tr>
</table>
<script type="text/javascript">
function default_list() {
	var html = \'\';
	var old = $(\'#default_style_input\').val();
	var checked = \'\';
	$(\'#template option:selected\').each(function(i,n){
		if (old == $(n).val()) {
			checked = \'checked\';
		}
		 html += \'<label><input type="radio" name="default_style_radio" value="\'+$(n).val()+\'" onclick="$(\\\'#default_style_input\\\').val(this.value);" \'+checked+\'> \'+$(n).text()+\'</label>\';
	});
	if(!checked)  $(\'#default_style_input\').val(\'0\');
	$(\'#default_style\').html(html);
}
</script>
</fieldset>
<div class="bk10"></div>
<fieldset>
	<legend>';echo L('site_att_config');echo '</legend>
	<table width="100%"  class="table_form">
  <tr>
    <th width="130" valign="top">';echo L('site_att_upload_maxsize');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[upload_maxsize]" id="upload_maxsize" size="10" value="';echo $setting['upload_maxsize'] ?$setting['upload_maxsize'] : '2000';echo '"/> KB </td>
  </tr>
  <tr>
    <th width="130" valign="top">';echo L('site_att_allow_ext');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[upload_allowext]" id="upload_allowext" size="50" value="';echo $setting['upload_allowext'];echo '"/></td>
  </tr>  
    <tr>
    <th>';echo L('site_att_gb_check');echo '</th>
    <td class="y-bg">';echo $this->check_gd();echo '</td>
  <tr>
    <th>';echo L('site_att_watermark_enable');echo '</th>
    <td class="y-bg">
	  <input class="radio_style" name="setting[watermark_enable]" value="1" ';echo $setting['watermark_enable']==1 ?'checked="checked"': '';echo ' type="radio"> ';echo L('site_att_watermark_open');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input class="radio_style" name="setting[watermark_enable]" value="0" ';echo $setting['watermark_enable']==0 ?'checked="checked"': '';echo ' type="radio"> ';echo L('site_att_watermark_close');echo '     </td>
  </tr>    
  <tr>
    <th>';echo L('site_att_watermark_condition');echo '</th>
    <td class="y-bg">';echo L('site_att_watermark_minwidth');echo '<input type="text" class="input-text" name="setting[watermark_minwidth]" id="watermark_minwidth" size="10" value="';echo $setting['watermark_minwidth'] ?$setting['watermark_minwidth'] : '300';echo '" /> X ';echo L('site_att_watermark_minheight');echo '<input type="text" class="input-text" name="setting[watermark_minheight]" id="watermark_minheight" size="10" value="';echo $setting['watermark_minheight'] ?$setting['watermark_minheight'] : '300';echo '" /> PX
     </td>
  </tr>
  <tr>
    <th width="130" valign="top">';echo L('site_att_watermark_img');echo '</th>
    <td class="y-bg"><input type="text" name="setting[watermark_img]" id="watermark_img" size="30" value="';echo $setting['watermark_img'] ?$setting['watermark_img'] : 'mark.gif';echo '"/>';echo L('site_att_watermark_img_desc');echo '</td>
  </tr> 
   <tr>
    <th width="130" valign="top">';echo L('site_att_watermark_pct');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[watermark_pct]" id="watermark_pct" size="10" value="';echo $setting['watermark_pct'] ?$setting['watermark_pct'] : '100';echo '" />  ';echo L('site_att_watermark_pct_desc');echo '</td>
  </tr> 
   <tr>
    <th width="130" valign="top">';echo L('site_att_watermark_quality');echo '</th>
    <td class="y-bg"><input type="text" class="input-text" name="setting[watermark_quality]" id="watermark_quality" size="10" value="';echo $setting['watermark_quality'] ?$setting['watermark_quality'] : '80';echo '" /> ';echo L('site_att_watermark_quality_desc');echo '</td>
  </tr> 
   <tr>
    <th width="130" valign="top">';echo L('site_att_watermark_pos');echo '</th>
    <td>
    <table width="100%" class="radio-label">
  <tr>
  <td rowspan="3"><input class="radio_style" name="setting[watermark_pos]" value="10" type="radio" ';echo ($setting['watermark_pos']==10) ?'checked':'';echo '> ';echo L('site_att_watermark_pos_10');echo '</td>
    <td><input class="radio_style" name="setting[watermark_pos]" value="1" type="radio" ';echo ($setting['watermark_pos']==1) ?'checked':'';echo '> ';echo L('site_att_watermark_pos_1');echo '</td>
	  <td><input class="radio_style" name="setting[watermark_pos]" value="2" type="radio" ';echo ($setting['watermark_pos']==2) ?'checked':'';echo '> ';echo L('site_att_watermark_pos_2');echo '</td>
	  <td><input class="radio_style" name="setting[watermark_pos]" value="3" type="radio" ';echo ($setting['watermark_pos']==3) ?'checked':'';echo '> ';echo L('site_att_watermark_pos_3');echo '</td>
  </tr>
  <tr>
    <td><input class="radio_style" name="setting[watermark_pos]" value="4" type="radio" ';echo ($setting['watermark_pos']==4) ?'checked':'';echo '> ';echo L('site_att_watermark_pos_4');echo '</td>
	  <td><input class="radio_style" name="setting[watermark_pos]" value="5" type="radio" ';echo ($setting['watermark_pos']==5) ?'checked':'';echo '> ';echo L('site_att_watermark_pos_5');echo '</td>
	  <td><input class="radio_style" name="setting[watermark_pos]" value="6" type="radio" ';echo ($setting['watermark_pos']==6) ?'checked':'';echo '> ';echo L('site_att_watermark_pos_6');echo '</td>
    </tr>
  <tr>
    <td><input class="radio_style" name="setting[watermark_pos]" value="7" type="radio" ';echo ($setting['watermark_pos']==7) ?'checked':'';echo '> ';echo L('site_att_watermark_pos_7');echo '</td>
	  <td><input class="radio_style" name="setting[watermark_pos]" value="8" type="radio" ';echo ($setting['watermark_pos']==8) ?'checked':'';echo '> ';echo L('site_att_watermark_pos_8');echo '</td>
	  <td><input class="radio_style" name="setting[watermark_pos]" value="9" type="radio" ';echo ($setting['watermark_pos']==9) ?'checked':'';echo '> ';echo L('site_att_watermark_pos_9');echo '</td>
    </tr>
</table>
      </td></tr>
</table>
</fieldset>
<div class="bk15"></div>
    <input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="';echo L('submit');echo '" />
</div>
</form>
</div>
</body>
</html>';?>