<?php

defined('IN_HOUSE5') or exit('No permission resources.');
function tag_md5($file) {
$data = file_get_contents($file);
preg_match_all("/\{h5:(\w+)\s+([^}]+)\}/i",stripslashes($data),$matches);
$arr = array();
if(is_array($matches) &&!empty($matches)) foreach($matches[0] as $k=>$v) {
if (!$v) continue;
$md5 = md5($v);
$arr[0][$k] = $md5;
$arr[1][$md5] = $v;
}
return $arr;
}
function creat_h5_tag($op,$data) {
$str = '{h5:'.$op.' ';
if (is_array($data)) {
foreach ($data as $k=>$v) {
if ($v) $str .= $str ?" $k=\"$v\"": "$k=\"$v\"";
}
}else {
$str .= $data;
}
return $str.'}';
}
function replace_h5_tag($filepath,$old_tag,$new_tag,$style,$dir) {
if (file_exists($filepath)) {
creat_template_bak($filepath,$style,$dir);
$data = @file_get_contents($filepath);
$data = str_replace($old_tag,$new_tag,$data);
if (!is_writable($filepath)) return false;
@file_put_contents($filepath,$data);
return true;
}
}
function creat_template_bak($filepath,$style,$dir) {
$filename = basename($filepath);
$template_bak_db = h5_base::load_model('template_bak_model');
$template_bak_db->insert(array('creat_at'=>SYS_TIME,'fileid'=>$style."_".$dir."_".$filename,'userid'=>param::get_cookie('userid'),'username'=>param::get_cookie('admin_username'),'template'=>new_addslashes(file_get_contents($filepath))));
}
function creat_form($id,$data,$value = '',$op = '') {
h5_base::load_sys_class('form','',0);
if (empty($value)) $value = $data['defaultvalue'];
$str = $ajax = '';
if($data['ajax']['name']) {
if($data['ajax']['m']) {
$url = '$.get(\'?s=content/push/public_ajax_get\', {html: this.value, id:\''.$data['ajax']['id'].'\', action: \''.$data['ajax']['action'].'\', module: \''.$data['ajax']['m'].'\', h5_hash: \''.$_SESSION['h5_hash'].'\'}, function(data) {$(\'#'.$id.'_td\').html(data)});';
}else {
$url = '$.get(\'?s=template/file/public_ajax_get\', { html: this.value, id:\''.$data['ajax']['id'].'\', action: \''.$data['ajax']['action'].'\', op: \''.$op.'\', style: \'default\', h5_hash: \''.$_SESSION['h5_hash'].'\'}, function(data) {$(\'#'.$id.'_td\').html(data)});';
}
}
switch ($data['htmltype']) {
case 'input':
if($data['ajax']['name']) {
$ajax = 'onblur="'.$url.'"';
}
$str .= '<input type="text" name="'.$id.'" id="'.$id.'" value="'.$value.'" size="30" />';
break;
case 'select':
if($data['ajax']['name']) {
$ajax = 'onchange="'.$url.'"';
}
$str .= form::select($data['data'],$value,"name='$id' id='$id' $ajax");
break;
case 'checkbox':
if($data['ajax']['name']) {
$ajax = ' onclick="'.$url.'"';
}
if (is_array($value)) implode(',',$value);
$str .= form::checkbox($data['data'],$value,"name='".$id."[]'".$ajax,'','120');
break;
case 'radio':
if($data['ajax']['name']) {
$ajax = ' onclick="'.$url.'"';
}
$str .= form::radio($data['data'],$value,"name='$id'$ajax",'','120');
break;
case 'input_select':
if($data['ajax']['name']) {
$ajax = ';'.$url;
}
$str .= '<input type="text" name="'.$id.'" id="'.$id.'" value="'.$value.'" size="30" />'.form::select($data['data'],$value,"name='select_$id' id='select_$id' onchange=\"$('#$id').val(this.value);$ajax\"");
break;
case 'input_select_category':
if($data['ajax']['name']) {
$ajax = ';'.$url;
}
$str .= '<input type="text" name="'.$id.'" id="'.$id.'" value="'.$value.'" size="30" />'.form::select_category('',$value,"name='select_$id' id='select_$id' onchange=\"$('#$id').val(this.value);$ajax\"",'',(isset($data['data']['modelid']) ?$data['data']['modelid'] : 0),(isset($data['data']['type']) ?$data['data']['type'] : -1),(isset($data['data']['onlysub']) ?$data['data']['onlysub'] : 0));
break;
case 'select_yp_model':
if($data['ajax']['name']) {
$ajax = ';'.$url;
}
$yp_models = getcache('yp_model','commons');
$d = array(L('please_select'));
if (is_array($yp_models) &&!empty($yp_models)) {
foreach ($yp_models as $k =>$v) {
$d[$k] = $v['name'];
}
}
$str .= '<input type="text" name="'.$id.'" id="'.$id.'" value="'.$value.'" size="30" />'.form::select($d,$value,"name='select_$id' id='select_$id' onchange=\"$('#$id').val(this.value);$ajax\"");
break;
}
if (!empty($data['validator'])) {
$str .= '<script type="text/javascript">$(function(){$("#'.$id.'").formValidator({onshow:"'.L('input').$data['name'].'¡£",onfocus:"'.L('input').$data['name'].'¡£"'.($data['empty'] ?',empty:true': '').'})';
if ($data['htmltype'] != 'select'&&(isset($data['validator']['min']) ||isset($data['validator']['max']))) {
$str .= ".inputValidator({".(isset($data['validator']['min']) ?'min:'.$data['validator']['min'].',': '').(isset($data['validator']['max']) ?'max:'.$data['validator']['max'].',': '')." onerror:'".$data['name'].L('should','','template').(isset($data['validator']['min']) ?' '.L('is_greater_than','','template').$data['validator']['min'].L('lambda','','template') : '').(isset($data['validator']['max']) ?' '.L('less_than','','template').$data['validator']['max'].L('lambda','','template') : '')."¡£'})";
}
if ($data['htmltype'] != 'checkbox'&&$data['htmltype'] != 'radio'&&isset($data['validator']['reg'])) {
$str .= '.regexValidator({regexp:"'.$data['validator']['reg'].'"'.(isset($data['validator']['reg_param']) ?",param:'".$data['validator']['reg_param']."'": '').(isset($data['validator']['reg_msg']) ?',onerror:"'.$data['validator']['reg_msg'].'"': '').'})';
}
$str .=";});</script>";
}
return $str;
}
function creat_url($action) {
$url = '';
foreach ($_GET as $k=>$v) {
if ($k=='action') $v = $action;
$url .= $url ?"&$k=$v": "$k=$v";
}
return $url;
}
function visualization($html,$style = '',$dir = '',$file = '') {
$change = "<link href=\"".CSS_PATH."dialog.css\" rel=\"stylesheet\" type=\"text/css\" />
		<link rel=\"stylesheet\" type=\"text/css\" href=\"".CSS_PATH."admin_visualization.css\" />
		<script language=\"javascript\" type=\"text/javascript\" src=\"".JS_PATH."dialog.js\"></script>
		<script type='text/javascript' src='".JS_PATH."jquery.min.js'></script>
		<script type='text/javascript'>
		var h5_hash = '".$_SESSION['h5_hash']."';
		$(function(){
		$('a').attr('href', 'javascript:void(0)').attr('target', '');
		$('.admin_piao_edit').click(function(){
		var url = '?s=template/file/edit_h5_tag';
		if($(this).parent('.admin_piao').attr('h5_action') == 'block') url = '?s=block/block_admin/add';
		window.top.art.dialog({title:'".L('h5_tag','','template')."',id:'edit',iframe:url+'&style=$style&dir=$dir&file=$file&'+$(this).parent('.admin_piao').attr('data'),width:'700',height:'500'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});})
		$('.admin_block').click(function(){
			window.top.art.dialog({title:'".L('h5_tag','','template')."',id:'edit',iframe:'?s=block/block_admin/block_update&id='+$(this).attr('blockid'),width:'700',height:'500'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
		});
	})</script><div id=\"h5__contentHeight\" style=\"display:none\">80</div>";
$html = str_replace('</body>',$change.'</body>',$html,$num);
if (!$num) $html .= $change;
return $html;
}?>