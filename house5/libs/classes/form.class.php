<?php

class form {
public static function editor($textareaid = 'content',$toolbar = 'basic',$module = '',$catid = '',$color = '',$allowupload = 0,$allowbrowser = 1,$alowuploadexts = '',$height = 200,$disabled_page = 0,$allowuploadnum = '10') {
$str = '';
$ADMIN_URL=ADMIN_PATH;
if($ADMIN_URL!="http:///"){;
$ueditor_path = ADMIN_JS_PATH.'ueditor/';
}else {
$ADMIN_URL=APP_PATH;
$ueditor_path = JS_PATH .'ueditor/';
}
$localDomain = APP_PATH;
$p = "/^https?\:\/\/[^\/]*?([^\/\.]+(?:\.com|\.cn|\.net|\.org|\.nom|\.co|\.firm|\.gen|\.idv|\.me)(?:\.[a-z]{1,2})?)/i";
preg_match($p,$localDomain,$m);
$localDomain=$m[1];
$str .= "<script type=\"text/javascript\">\r\nwindow.UEDITOR_HOME_URL='".$ueditor_path."'\r\n</script>\r\n";
if (!defined('EDITOR_INIT')) {
$str .= '<script type="text/javascript" src="'.$ueditor_path .'editor_config.js"></script>';
$str .= '<script type="text/javascript" src="'.$ueditor_path .'editor_all.js"></script>';
$str .= '<link rel="stylesheet" href="'.$ueditor_path .'themes/default/ueditor.css"/>';
$str .= '<script type="text/javascript" src="'.$ueditor_path .'editor_util.js"></script>';
define('EDITOR_INIT',1);
}
if ($toolbar == 'basic') {
$toolbar = defined('IN_ADMIN') ?"['Source',": '[';
$toolbar .= "'Bold', 'Italic', '|', 'InsertOrderedList', 'InsertUnorderedList', '|', 'Link', 'Unlink' ]";
}elseif ($toolbar == 'full') {
if (defined('IN_ADMIN')) {
$toolbar = "['Source',";
}else {
$toolbar = '[';
}
$toolbar .= "'fullscreen',  '|', 'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch','autotypeset', '|',
                'blockquote', '|', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist','selectall', 'cleardoc', '|', 'customstyle',
                'paragraph', '|','rowspacingtop', 'rowspacingbottom','lineheight', '|','fontfamily', 'fontsize', '|',
                'directionalityltr', 'directionalityrtl', '|', '', 'indent', '|',
                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|','touppercase','tolowercase','|',
                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright',
                'imagecenter', '|', 'insertimage', 'emotion','scrawl', 'insertvideo', 'attachment', 'map', 'gmap', 'insertframe','highlightcode','webapp','pagebreak','subtitle','template','background', '|',
                'horizontal', 'date', 'time', 'spechars', 'wordimage', '|',
                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', '|',
                'print', 'preview', 'searchreplace','help']";
}elseif ($toolbar == 'desc') {
$toolbar = "['Bold', 'Italic', '|', 'InsertOrderedList', 'InsertUnorderedList', '|', 'Link', 'Unlink', '|', 'InsertImage', '|','Source']";
}else {
$toolbar = "['fullscreen', 'source', '|', 'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch','autotypeset', '|',
                'blockquote', '|', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist','selectall', 'cleardoc', '|', 'customstyle',
                'paragraph', '|','rowspacingtop', 'rowspacingbottom','lineheight', '|','fontfamily', 'fontsize', '|',
                'directionalityltr', 'directionalityrtl', '|', '', 'indent', '|',
                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|','touppercase','tolowercase','|',
                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright',
                'imagecenter', '|', 'insertimage', 'emotion','scrawl', 'insertvideo', 'attachment', 'map', 'gmap', 'insertframe','highlightcode','webapp','pagebreak','subtitle','template','background', '|',
                'horizontal', 'date', 'time', 'spechars', 'wordimage', '|',
                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', '|',
                'print', 'preview', 'searchreplace','help']";
}
$opt = array();
$opt[] = "toolbars:[".$toolbar."]";
$opt[] = "minFrameHeight:".$height;
if ($allowupload) {
$authkey = upload_key("$allowuploadnum,$alowuploadexts,$allowbrowser");
$iframeUrlMap="'insertimage':'".$ADMIN_URL ."index.php?s=attachment/ueditor/imagespload/authkey/{$authkey}/module/{$module}/catid/{$catid}/args/{$allowuploadnum},{$alowuploadexts},{$allowbrowser}',";
$iframeUrlMap .="'wordimage':'".$ADMIN_URL ."index.php?s=attachment/ueditor/wordimage/authkey/{$authkey}/module/{$module}/catid/{$catid}/args/{$allowuploadnum},{$alowuploadexts},{$allowbrowser}',";
$iframeUrlMap .="'attachment':'".$ADMIN_URL ."index.php?s=attachment/ueditor/swfupload/authkey/{$authkey}/module/{$module}/catid/{$catid}/args/{$allowuploadnum},{$alowuploadexts},{$allowbrowser}',";
$iframeUrlMap .="'scrawl':'".$ADMIN_URL ."index.php?s=attachment/ueditor/scrawl/authkey/{$authkey}/module/{$module}/catid/{$catid}/args/{$allowuploadnum},{$alowuploadexts},{$allowbrowser}'";
$opt[] = "iframeUrlMap:{".$iframeUrlMap."}";
$opt[] = "catcherUrl:'".$ADMIN_URL ."index.php?s=attachment/ueditor/imagescatch/authkey/{$authkey}/module/{$module}/catid/{$catid}/args/{$allowuploadnum},{$alowuploadexts},{$allowbrowser}'";
$opt[] = "localDomain:['127.0.0.1','localhost','img.baidu.com','".$localDomain."']";
$opt[] = "scrawlUrl:'".$ADMIN_URL ."index.php?s=attachment/ueditor/scrawlUp'";
$opt[] = "imageManagerUrl:'".$ADMIN_URL ."index.php?s=attachment/ueditor/imageslist/authkey/{$authkey}/module/{$module}/catid/{$catid}/args/{$allowuploadnum},{$alowuploadexts},{$allowbrowser}'";
}
$str .= "<script type=\"text/javascript\">\r\n";
$str .= "var editor_".$textareaid ." = new baidu.editor.ui.Editor({".join(",",$opt) ."});\r\neditor_".$textareaid .".render('$textareaid');\r\n";
$str .= '</script>';
return $str;
}
public static function images($name,$id = '',$value = '',$moudle = '',$catid = '',$size = 50,$class = '',$ext = '',$alowexts = '',$thumb_setting = array(),$watermark_setting = 0) {
if (!$id)
$id = $name;
if (!$size)
$size = 50;
if (!empty($thumb_setting) &&count($thumb_setting))
$thumb_ext = $thumb_setting[0] .','.$thumb_setting[1];
else
$thumb_ext = ',';
if (!$alowexts)
$alowexts = 'jpg|jpeg|gif|bmp|png';
if (!defined('IMAGES_INIT')) {
$str = '<script type="text/javascript" src="'.JS_PATH .'swfupload/swf2ckeditor.js"></script>';
define('IMAGES_INIT',1);
}
$authkey = upload_key("1,$alowexts,1,$thumb_ext,$watermark_setting");
return $str ."<input type=\"text\" name=\"$name\" id=\"$id\" value=\"$value\" size=\"$size\" class=\"$class\" $ext/>  <input type=\"button\" class=\"button\" onclick=\"javascript:flashupload('{$id}_images', '".L('attachmentupload') ."','{$id}',submit_images,'1,{$alowexts},1,{$thumb_ext},{$watermark_setting}','{$moudle}','{$catid}','{$authkey}')\"/ value=\"".L('imagesupload') ."\">";
}
public static function upfiles($name,$id = '',$value = '',$moudle = '',$catid = '',$size = 50,$class = '',$ext = '',$alowexts = '',$file_setting = array()) {
if (!$id)
$id = $name;
if (!$size)
$size = 50;
if (!empty($file_setting) &&count($file_setting))
$file_ext = $file_setting[0] .','.$file_setting[1];
else
$file_ext = ',';
if (!$alowexts)
$alowexts = 'rar|zip';
if (!defined('IMAGES_INIT')) {
$str = '<script type="text/javascript" src="'.JS_PATH .'swfupload/swf2ckeditor.js"></script>';
define('IMAGES_INIT',1);
}
$authkey = upload_key("1,$alowexts,1,$file_ext");
return $str ."<input type=\"text\" name=\"$name\" id=\"$id\" value=\"$value\" size=\"$size\" class=\"$class\" $ext/>  <input type=\"button\" class=\"button\" onclick=\"javascript:flashupload('{$id}_files', '".L('attachmentupload') ."','{$id}',submit_attachment,'1,{$alowexts},1,{$file_ext}','{$moudle}','{$catid}','{$authkey}')\"/ value=\"".L('filesupload') ."\">";
}
public static function date($name,$value = '',$isdatetime = 0,$loadjs = 0,$showweek = 'true',$timesystem = 1) {
if ($value == '0000-00-00 00:00:00')
$value = '';
$id = preg_match("/\[(.*)\]/",$name,$m) ?$m[1] : $name;
if ($isdatetime) {
$size = 21;
$format = '%Y-%m-%d %H:%M:%S';
if ($timesystem) {
$showsTime = 'true';
}else {
$showsTime = '12';
}
}else {
$size = 10;
$format = '%Y-%m-%d';
$showsTime = 'false';
}
$str = '';
if ($loadjs ||!defined('CALENDAR_INIT')) {
define('CALENDAR_INIT',1);
$str .= '<link rel="stylesheet" type="text/css" href="'.JS_PATH .'calendar/jscal2.css"/>
			<link rel="stylesheet" type="text/css" href="'.JS_PATH .'calendar/border-radius.css"/>
			<link rel="stylesheet" type="text/css" href="'.JS_PATH .'calendar/win2k.css"/>
			<script type="text/javascript" src="'.JS_PATH .'calendar/calendar.js"></script>
			<script type="text/javascript" src="'.JS_PATH .'calendar/lang/en.js"></script>';
}
$str .= '<input type="text" name="'.$name .'" id="'.$id .'" value="'.$value .'" size="'.$size .'" class="date" readonly>&nbsp;';
$str .= '<script type="text/javascript">
			Calendar.setup({
			weekNumbers: '.$showweek .',
		    inputField : "'.$id .'",
		    trigger    : "'.$id .'",
		    dateFormat: "'.$format .'",
		    showTime: '.$showsTime .',
		    minuteStep: 1,
		    onSelect   : function() {this.hide();}
			});
        </script>';
return $str;
}
public static function select_category($file = '',$catid = 0,$str = '',$default_option = '',$modelid = 0,$type = -1,$onlysub = 0,$siteid = 0,$is_push = 0) {
$tree = h5_base::load_sys_class('tree');
if (!$siteid)
$siteid = param::get_cookie('siteid');
if (!$file) {
$file = 'category_content_'.$siteid;
}
$result = getcache($file,'commons');
$string = '<select '.$str .'>';
if ($default_option)
$string .= "<option value='0'>$default_option</option>";
if ($is_push == '1') {
$priv = h5_base::load_model('category_priv_model');
$user_groupid = param::get_cookie('_groupid') ?param::get_cookie('_groupid') : 8;
}
if (is_array($result)) {
foreach ($result as $r) {
if ($is_push == '1'and $r['child'] == '0') {
$sql = array('catid'=>$r['catid'],'roleid'=>$user_groupid,'action'=>'add');
$array = $priv->get_one($sql);
if (!$array) {
continue;
}
}
if ($siteid != $r['siteid'] ||($type >= 0 &&$r['type'] != $type))
continue;
$r['selected'] = '';
if (is_array($catid)) {
$r['selected'] = in_array($r['catid'],$catid) ?'selected': '';
}elseif (is_numeric($catid)) {
$r['selected'] = $catid == $r['catid'] ?'selected': '';
}
$r['html_disabled'] = "0";
if (!empty($onlysub) &&$r['child'] != 0) {
$r['html_disabled'] = "1";
}
$categorys[$r['catid']] = $r;
if(is_array($modelid))
{
if ($modelid &&!in_array($r['modelid'],$modelid)) 
unset($categorys[$r['catid']]);
}
else
{
if ($modelid &&$r['modelid'] != $modelid)
unset($categorys[$r['catid']]);
}
}
}
$str = "<option value='\$catid' \$selected>\$spacer \$catname</option>;";
$str2 = "<optgroup label='\$spacer \$catname'></optgroup>";
$tree->init($categorys);
$string .= $tree->get_tree_category(0,$str,$str2);
$string .= '</select>';
return $string;
}
public static function select_linkage($keyid = 0,$parentid = 0,$name = 'parentid',$id = '',$alt = '',$linkageid = 0,$property = '') {
$tree = h5_base::load_sys_class('tree');
$result = getcache($keyid,'linkage');
$id = $id ?$id : $name;
$string = "<select name='$name' id='$id' $property>\n<option value='0'>$alt</option>\n";
if ($result['data']) {
foreach ($result['data'] as $area) {
$categorys[$area['linkageid']] = array('id'=>$area['linkageid'],'parentid'=>$area['parentid'],'name'=>$area['name']);
}
}
$str = "<option value='\$id' \$selected>\$spacer \$name</option>";
$tree->init($categorys);
$string .= $tree->get_tree($parentid,$str,$linkageid);
$string .= '</select>';
return $string;
}
public static function select($array = array(),$id = 0,$str = '',$default_option = '') {
$string = '<select '.$str .'>';
$default_selected = (empty($id) &&$default_option) ?'selected': '';
if ($default_option)
$string .= "<option value='' $default_selected>$default_option</option>";
if (!is_array($array) ||count($array) == 0)
return false;
$ids = array();
if (isset($id))
$ids = explode(',',$id);
foreach ($array as $key =>$value) {
$selected = in_array($key,$ids) ?'selected': '';
$string .= '<option value="'.$key .'" '.$selected .'>'.$value .'</option>';
}
$string .= '</select>';
return $string;
}
public static function checkbox($array = array(),$id = '',$str = '',$defaultvalue = '',$width = 0,$field = '') {
$string = '';
$id = trim($id);
if ($id != '')
$id = strpos($id,',') ?explode(',',$id) : array($id);
if ($defaultvalue)
$string .= '<input type="hidden" '.$str .' value="-99">';
$i = 1;
foreach ($array as $key =>$value) {
$key = trim($key);
$checked = ($id &&in_array($key,$id)) ?'checked': '';
if ($width)
$string .= '<label class="ib" style="width:'.$width .'px">';
$string .= '<input type="checkbox" '.$str .' id="'.$field .'_'.$i .'" '.$checked .' value="'.htmlspecialchars($key) .'"> '.htmlspecialchars($value);
if ($width)
$string .= '</label>';
$i++;
}
return $string;
}
public static function radio($array = array(),$id = 0,$str = '',$width = 0,$field = '') {
$string = '';
foreach ($array as $key =>$value) {
$checked = trim($id) == trim($key) ?'checked': '';
if ($width)
$string .= '<label class="ib" style="width:'.$width .'px">';
$string .= '<input type="radio" '.$str .' id="'.$field .'_'.htmlspecialchars($key) .'" '.$checked .' value="'.$key .'"> '.$value;
if ($width)
$string .= '</label>';
}
return $string;
}
public static function select_template($style,$module,$id = '',$str = '',$pre = '') {
$tpl_root = h5_base::load_config('system','tpl_root');
$templatedir = H5_PATH .$tpl_root .DIRECTORY_SEPARATOR .$style .DIRECTORY_SEPARATOR .$module .DIRECTORY_SEPARATOR;
$confing_path = H5_PATH .$tpl_root .DIRECTORY_SEPARATOR .$style .DIRECTORY_SEPARATOR .'config.php';
$localdir = str_replace(array('/','\\'),'',$tpl_root) .'|'.$style .'|'.$module;
$templates = glob($templatedir .$pre .'*.html');
if (empty($templates)) {
$style = 'default';
$templatedir = H5_PATH .$tpl_root .DIRECTORY_SEPARATOR .$style .DIRECTORY_SEPARATOR .$module .DIRECTORY_SEPARATOR;
$confing_path = H5_PATH .$tpl_root .DIRECTORY_SEPARATOR .$style .DIRECTORY_SEPARATOR .'config.php';
$localdir = str_replace(array('/','\\'),'',$tpl_root) .'|'.$style .'|'.$module;
$templates = glob($templatedir .$pre .'*.html');
}
if (empty($templates))
return false;
$files = @array_map('basename',$templates);
$names = array();
if (file_exists($confing_path)) {
$names = include $confing_path;
}
$templates = array();
if (is_array($files)) {
foreach ($files as $file) {
$key = substr($file,0,-5);
$templates[$key] = isset($names['file_explan'][$localdir][$file]) &&!empty($names['file_explan'][$localdir][$file]) ?$names['file_explan'][$localdir][$file] .'('.$file .')': $file;
}
}
ksort($templates);
return self::select($templates,$id,$str,L('please_select'));
}
public static function checkcode($id = 'checkcode',$code_len = 4,$font_size = 20,$width = 130,$height = 50,$font = '',$font_color = '',$background = '') {
return "<img id='$id' alt='看不清楚？点击换一组验证码。' title='看不清楚？点击换一组验证码。' onclick='this.src=this.src+\"&\"+Math.random()' src='".SITE_PROTOCOL .SITE_URL .WEB_PATH ."api.php?op=checkcode&code_len=$code_len&font_size=$font_size&width=$width&height=$height&font_color=".urlencode($font_color) ."&background=".urlencode($background) ."'>";
}
public static function urlrule($module,$file,$ishtml,$id,$str = '',$default_option = '') {
if (!$module)
$module = 'content';
$urlrules = getcache('urlrules_detail','commons');
$array = array();
foreach ($urlrules as $roleid =>$rules) {
if ($rules['module'] == $module &&$rules['file'] == $file &&$rules['ishtml'] == $ishtml)
$array[$roleid] = $rules['example'];
}
return form::select($array,$id,$str,$default_option);
}
}
?>