<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = $show_validator = $show_header = 1;
include $this->admin_tpl('header','admin');
;echo '<style type="text/css"> 
html,body{background:#e2e9ea}
</style>
<script type="text/javascript">
<!--
	var charset = \'';echo CHARSET;echo '\';
	var uploadurl = \'';echo h5_base::load_config('system','upload_url');echo '\';
//-->
</script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'content_addtop.js"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'colorpicker.js"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'cookie.js"></script>
<script language="javascript" type="text/javascript" src="';echo JS_PATH;echo 'swfupload/swf2ckeditor.js"></script>
<form name="myform" id="myform" action="?s=special/content/edit&specialid=';echo $_GET['specialid'];echo '&id=';echo $_GET['id'];echo '" method="post" enctype="multipart/form-data">
<div class="addContent">
<div class="crumbs">';echo L('edit_pos_info');echo '</div>
<div class="col-right">
    	<div class="col-1">
        	<div class="content pad-6">
	<h6> ';echo L('content_thumb');echo '</h6>
	 <div class="upload-pic img-wrap"><div class="bk10"></div><input type="hidden" name="info[thumb]" value="';echo $info['thumb'];echo '" id="thumb">
						<a href="javascript:;" onclick="javascript:flashupload(\'thumb_images\', \'';echo L('file_upload');echo '\',\'thumb\',thumb_images,\'1,jpg|jpeg|gif|bmp|png,300,300\',\'content\',\'39\',\'';echo upload_key('1,jpg|jpeg|gif|bmp|png,300,300');echo '\')"><img src="';if($info['thumb']) {echo $info['thumb'];}else {;echo 'statics/images/icon/upload-pic.png';};echo '" id="thumb_preview" width="135" height="113" style="cursor:hand" /></a><input type="button" style="width: 66px;" class="button" onclick="crop_cut($(\'#thumb\').val());return false;" value="';echo L('crop_thumb');echo '"><script type="text/javascript">function crop_cut(id){
	if (id==\'\') { alert(\'';echo L('please_upload_thumb');echo '\');return false;}
	window.top.art.dialog({title:\'';echo L('crop_thumb');echo '\', id:\'crop\', iframe:\'index.php?s=content/content/public_crop&module=house5&picurl=\'+encodeURIComponent(id)+\'&input=thumb&preview=thumb_preview\', width:\'680px\', height:\'480px\'}, 	function(){var d = window.top.art.dialog({id:\'crop\'}).data.iframe;
	d.uploadfile();return false;}, function(){window.top.art.dialog({id:\'crop\'}).close()});
};</script></div> 
	<h6> ';echo L('author');echo '</h6>
	 <input type="text" name="data[author]" value="';echo $data['author'];echo '" size="30"> 
	<h6> ';echo L('islink');echo '</h6>
	 <input type="text" name="linkurl" id="linkurl" value="';if($info['islink']) {echo $info['url'];};echo '" size="30" maxlength="255"';if($info['islink']) {;echo ' disabled';};echo '> <input name="info[islink]" type="checkbox" id="islink" value="1"';if($info['islink']) {;echo ' checked';};echo ' onclick="ruselinkurl();" > <font color="red">';echo L('islink');echo '</font> 
	<h6> ';echo L('inputtime');echo '</h6> ';echo form::date('info[inputtime]',format::date($info['inputtime'],1) ,1);;echo '	<h6> ';echo L('template_style');echo '</h6> ';echo form::select($template_list,$data['style'],'name="data[style]" id="style" onchange="load_file_list(this.value)"',L('please_select'));echo '	<h6> ';echo L('show_template');echo '</h6> <span id="show_template">';if ($data['style']) echo '<script type="text/javascript">$.getJSON(\'?s=admin/category/public_tpl_file_list&style='.$data['style'].'&id='.$data['show_template'].'&module=special&templates=show&name=data\', function(data){$(\'#show_template\').html(data.show_template);});</script>';echo '</span> 
          </div>
        </div>
    </div>
    <div class="col-auto">
    	<div class="col-1">
        	<div class="content pad-6">
<table width="100%" cellspacing="0" class="table_form">
	<tbody>
	<tr>
      <th width="80"> <font color="red">*</font> ';echo L('for_type');echo '	  </th>
      <td>';echo form::select($types,$info['typeid'],'name="info[typeid]" id="typeid"',L('please_choose_type'));echo '  </td>
    </tr>
	<tr>
      <th width="80"> <font color="red">*</font> ';echo L('content_title');echo '	  </th>
      <td><input type="text" style="width:350px;" name="info[title]" id="title" value="';echo htmlspecialchars($info['title']);echo '" class="measure-input " onBlur="$.post(\'api.php?op=get_keywords&number=3&sid=\'+Math.random()*5, {data:$(\'#title\').val()}, function(data){if(data && $(\'#keywords\').val()==\'\') $(\'#keywords\').val(data); })" />
		<input type="hidden" name="style_color" id="style_color" value="">
		<input type="hidden" name="style_font_weight" id="style_font_weight" value="">
		<input type="button" class="button" id="check_title_alt" value="';echo L('check_exist');echo '" onclick="$.get(\'?s=special/content/public_check_title&sid=\'+Math.random()*5, {data:$(\'#title\').val()}, function(data){if(data==\'1\') {$(\'#check_title_alt\').val(\'';echo L('title_exist');echo '\');$(\'#check_title_alt\').css(\'background-color\',\'#FFCC66\');} else if(data==\'0\') {$(\'#check_title_alt\').val(\'';echo L('title_no_exist');echo '\');$(\'#check_title_alt\').css(\'background-color\',\'#F8FFE1\')}})"/> <img src="statics/images/icon/colour.png" width="15" height="16" onclick="colorpicker(\'title_colorpanel\',\'set_title_color\');" style="cursor:hand"/> 
		<img src="statics/images/icon/bold.png" width="10" height="10" onclick="input_font_bold()" style="cursor:hand"/> <span id="title_colorpanel" style="position:absolute; z-index:200" class="colorpanel"></span>  </td>
    </tr>
    <tr>
      <th width="80"> ';echo L('keywords');echo '	  </th>
      <td><input type=\'text\' name=\'info[keywords]\' id=\'keywords\' value=\'';echo $info['keywords'];echo '\' style=\'50\'  >  ';echo L('more_keywords_with_blanks');echo '</td>
    </tr>
	<tr>
      <th width="60"> ';echo L('description');echo '	  </th>
      <td><textarea name="info[description]" id="description" style=\'width:98%;height:46px;\' onkeyup="strlen_verify(this, \'description_len\', 255)">';echo $info['description'];echo '</textarea> 还可输入<B><span id="description_len">';echo 255-strlen($info['description']);echo '</span></B> 个字符  </td>
    </tr>
	<tr>
      <th width="60"> <font color="red">*</font> ';echo L('content');echo '	  </th>
      <td><div id=\'content_tip\'></div><textarea name="data[content]" id="content" boxid="content">';echo $data['content'];echo '</textarea>';echo form::editor('content','full','content','','',1);echo '<div class="content_attr"><label><input name="add_introduce" type="checkbox"  value="1" checked>';echo L('iscutcontent');echo '</label><input type="text" name="introcude_length" value="200" size="3">';echo L('characters_to_contents');echo '<label><input type=\'checkbox\' name=\'auto_thumb\' value="1" checked>';echo L('iscutcotent_pic');echo '</label><input type="text" name="auto_thumb_no" value="1" size="2" class="">';echo L('picture2thumb');echo '</div></td>
	<tr>
      <th width="60"> ';echo L('paginationtype');echo '	  </th>
      <td><select name="data[paginationtype]" id="paginationtype" onchange="if(this.value==1)$(\'#paginationtype1\').css(\'display\',\'\');else $(\'#paginationtype1\').css(\'display\',\'none\');">
                <option value="0"';if($data['paginationtype']==0) {;echo ' selected';};echo '>';echo L('no_page');echo '</option>
                <option value="1"';if($data['paginationtype']==1) {;echo ' selected';};echo '>';echo L('collate_copies');echo '</option>
                <option value="2"';if($data['paginationtype']==2) {;echo ' selected';};echo '>';echo L('manual_page');echo '</option>
            </select>
			<span id="paginationtype1" style="display:';if($data['paginationtype']==1) {;echo 'block';}else {;echo 'none';};echo '"><input name="data[maxcharperpage]" type="text" id="maxcharperpage" value="';echo $data['maxcharperpage'];echo '" size="8" maxlength="8">';echo L('number_of_characters');echo '</span>  </td>
    </tr>
 
    </tbody></table>
                </div>
        	</div>
        </div>
        
    </div>
</div>
<div class="fixed-bottom">
	<div class="fixed-but text-c">
    <div class="button"><input value="';echo L('save');echo '" type="submit" class="cu" name="dosubmit" onclick="refersh_window();"></div>
    <div class="button"><input value="';echo L('close');echo '" type="button" name="close" class="cu" onclick="refersh_window();close_window()"></div>
      </div>
</div>
</form>
<script type="text/javascript">
function load_file_list(id) {
	$.getJSON(\'?s=admin/category/public_tpl_file_list&style=\'+id+\'&module=special&templates=show&name=data\', function(data){$(\'#show_template\').html(data.show_template);});
}
</script>
</body>
</html>
<script type="text/javascript"> 
<!--
//只能放到最下面
$(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, 	function(){$(obj).focus();
	boxid = $(obj).attr(\'id\');
	if($(\'#\'+boxid).attr(\'boxid\')!=undefined) {
		check_content(boxid);
	}
	})}});
	$("#typeid").formValidator({autotip:true,onshow:"';echo L('please_choose_type');echo '",onfocus:"';echo L('please_choose_type');echo '"}).inputValidator({min:1,onerror:"';echo L('please_choose_type');echo '"}).defaultPassed();
	$("#title").formValidator({autotip:true,onshow:"';echo L('please_input_title');echo '",onfocus:"';echo L('please_input_title');echo '"}).inputValidator({min:1,onerror:"';echo L('please_input_title');echo '"}).defaultPassed();
	$("#content").formValidator({autotip:true,onshow:"",onfocus:"';echo L('content_empty');echo '"}).functionValidator({
	    fun:function(val,elem){
	    //获取编辑器中的内容
		//var oEditor = CKEDITOR.instances.content;
		//var data = oEditor.getData();
        if(typeof(CKEDITOR)!=\'undefined\'){
			var oEditor = CKEDITOR.instances.content;
			var data = oEditor.getData();			
		}else{
			var data = editor_content.getContent();			
		}		
        if($(\'#islink\').attr(\'checked\')){
		    return true;
	    }else if(($(\'#islink\').attr(\'checked\')==false) && (data==\'\')){
		    return "';echo L('content_empty');echo '"
	    } else { return true; }
	}
	}).defaultPassed();	
/*
 * 加载禁用外边链接
 */
';if($info['islink']==0) {;echo '	$(\'#linkurl\').attr(\'disabled\',true);
	$(\'#islink\').attr(\'checked\',false);
	';};echo '	$(\'.edit_content\').hide();
});
document.title=\'编辑：';echo $info['title'];echo '\';
self.moveTo(0, 0);
function refersh_window() {
	setcookie(\'refersh_time\', 1);
}
//-->
</script>';?>