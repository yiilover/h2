<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
$show_validator = $show_scroll = $show_dialog = 1;
include $this->admin_tpl('header','admin');
;echo '<form method="post" action="?s=special/special/edit&specialid=';echo $_GET['specialid'];echo '" id="myform">
<div class="pad-10">
<div class="col-tab">
	<ul class="tabBut cu-li">
		<li id="tab_setting_1" class="on" onclick="SwapTab(\'setting\',\'on\',\'\',6,1);">';echo L('catgory_basic','','admin');;echo '</li>
		<li id="tab_setting_2" onclick="SwapTab(\'setting\',\'on\',\'\',6,2);">';echo L('extend_setting');echo '</li>
	</ul>
<div id="div_setting_1" class="contentList pad-10">
	<table class="table_form" width="100%" cellspacing="0">
		<tbody>
			<tr>
				<th width="200">';echo L('special_title');echo '：</th>
				<td><input name="special[title]" id="title" class="input-text" value="';echo htmlspecialchars($info['title']);;echo '" type="text" size="40"></td>
			</tr>
			<tr>
				<th>';echo L('special_banner');echo '：</th>
				<td>';echo form::images('special[banner]','banner',$info['banner'],'special','',40);echo '</td>
			</tr>
			<tr>
				<th>';echo L('sepcial_thumb');echo '：</th>
				<td>';echo form::images('special[thumb]','thumb',$info['thumb'],'special','',40,'','','',array(350,350));echo '</td>
			</tr>
			<tr>
			<th>';echo L('sepcial_typeids');echo '：</th>
			<td><select name="special[typeids]" id="typeids">
			<option value="0" ';if ($info['typeids']=="0") {;echo 'selected';};echo '>请选择分类</option>
			<option value="1" ';if ($info['typeids']=="1") {;echo 'selected';};echo '>活动专题</option>
			<option value="2" ';if ($info['typeids']=="2") {;echo 'selected';};echo '>楼盘专题</option>
			<option value="3" ';if ($info['typeids']=="3") {;echo 'selected';};echo '>热点专题</option></select></td>
		</tr>
			<tr>
				<th>';echo L('special_intro');echo '：</th>
				<td><textarea name="special[description]" id="description" cols="50" rows="6">';echo $info['description'];;echo '</textarea></td>
			</tr>
			<tr>
		    	<th align="right" valign="top">';echo L('ishtml');echo '：</th>
		        <td valign="top">';echo form::radio(array('1'=>L('yes'),'0'=>L('no')),$info['ishtml'],'name="special[ishtml]"');;echo '		        </td>
		    </tr>
		    <tr id="file_div" style="display:';if($info['ishtml']) {;echo ' ';}else {;echo 'none';};echo ';">
		    	<th align="right" valign="top">';echo L('special_filename');echo '：</th>
		        <td valign="top"><input type="text" name="special[filename]" id="filename" class="input-text"';if($info['ishtml']) {;echo ' readonly';};echo ' value="';echo $info['filename'];echo '" size="20">
		        </td>
		    </tr>
		    <tr>
		    	<th width="200">';echo L('special_type');echo '：<a href="javascript:addItem()" title="';echo L('add');echo '"><span style="color:red;" >+</span></a></th>
		        <td valign="top">
		        <div id="option_list">
		        ';if(is_array($types)) {$k = 1;foreach($types as $t) {;echo '		        	<div class="mb6"><span>';echo L('type_id');echo '：';echo $t['typeid'];echo '&nbsp;&nbsp;';echo L('type_name');echo '：<input type="hidden" name="type[';echo $k;echo '][typeid]" value="';echo $t['typeid'];echo '"><input type="text" name="type[';echo $k;echo '][name]" ';if ($k==1) {;echo 'id="type_name"';};echo ' value="';echo htmlspecialchars($t['name']);echo '" class="input-text" size="15">&nbsp;&nbsp;';echo L('type_path');echo '：<input type="text" name="type[';echo $k;echo '][typedir]" ';if ($k==1) {;echo 'id="type_path"';};echo ' value="';echo $t['typedir'];echo '" class="input-text" size="15">&nbsp;&nbsp;';echo L('listorder');echo '：<input type="text" name="type[';echo $k;echo '][listorder]" value="';echo $t['listorder'];echo '" size="6" class="input-text" ></span>&nbsp;';if ($k!=1) {;echo '<a href="javascript:;" onclick="descItem(this, ';echo $k;echo ');">';echo L('remove');echo '</a>';};echo '</div>
		        ';$k++;}};echo '		        </div>
		        </td>
    </tr>
		</tbody>
	</table>
</div>
<div id="div_setting_2" class="contentList pad-10 hidden">
	<table width="100%" class="table_form ">
		<tr>
			<th width="200">';echo L('pics_news');echo '：</th>
			<td><span id="relation">';if ($info['pics']) {;echo '<ul id="relation_relation" class="list-dot"><li><span>';echo $pics['2'];echo '</span><a onclick="remove_relation(\'relation\', \'pics\')" class="close" href="javascript:void(0);"></a></li></ul>';};echo '</span><input type="button" value="';echo L('choose_pic_news');echo '" class="button" onclick="import_info(\'?s=special/special/public_get_pics\',\'';echo L('choose_pic_news');echo '\', \'msg_id\', \'relation\', \'pics\');"><input type="hidden" name="special[pics]" value="';echo $info['pics'];echo '" id="pics"><span class="onShow">(';echo L('choose_pic_model');echo ')</span></td>
		</tr>
		<tr>
			<th>';echo L('add_vote');echo '：</th>
			<td><span id="vote_msg">';if ($info['voteid']) {;echo '<ul id="relation_vote_msg" class="list-dot"><li><span>';echo $vote_info['2'];echo '</span><a onclick="remove_relation(\'vote_msg\', \'voteid\')" class="close" href="javascript:void(0);"></a></li></ul>';};echo '</span><input type="button" class="button" value="';echo L('choose_exist_vote');echo '" onclick="import_info(\'?s=vote/vote/public_get_votelist&from_api=1&target=dialog\',\'';echo L('choose_vote');echo '\', \'msg_id\', \'vote_msg\', \'voteid\');"><input type="hidden" name="special[voteid]" value="';echo $info['voteid'];echo '" id="voteid">&nbsp;<input type="button" class="button" value="';echo L('add_new_vote');echo '" onclick="import_info(\'?s=vote/vote/add&from_api=1&target=dialog\',\'';echo L('add_new_vote');echo '\', \'subject_title\', \'vote_msg\', \'voteid\');"></td>
		</tr>
		<tr>
		    <th align="right"  valign="top">';echo L('template_style');echo '：</th>
		    <td valign="top">';echo form::select($template_list,$info['style'],'name="special[style]" id="style" onchange="load_file_list(this.value)"',L('please_select'));echo '';if ($info['style']) {;echo '<script type="text/javascript">$.getJSON(\'?s=admin/category/public_tpl_file_list&style=';echo $info['style'];echo '&module=special&templates=index|list|show&id=';echo $info['index_template'];echo '|';echo $info['list_template'];echo '|';echo $info['show_template'];echo '&name=special\', function(data){$(\'#index_template\').html(data.index_template);$(\'#list_template\').html(data.list_template);$(\'#show_template\').html(data.show_template);});</script>';};echo '</td>
		</tr>
		<tr>
			<th align="right"  valign="top">';echo L('special_template');echo '：</th>
			<td valign="top" id="index_template">';echo form::select_template('default','special',$info['index_template'],'name="special[index_template]"','index');;echo '</td>
		</tr>
		<tr>
			<th align="right"  valign="top">';echo L('special_content_template');echo '：</th>
			<td valign="top" id="show_template">';echo form::select_template('default','special',$info['show_template'],'name="special[show_template]"','show');;echo '</td>
		</tr>
		<tr>
			<th align="right"  valign="top">';echo L('index_page');echo '：</th>
			<td valign="top">';echo form::radio(array('0'=>L('no'),'1'=>L('yes')),$info['ispage'],'name="special[ispage]"');;echo '</td>
		</tr>
		<tr>
			<th align="right"  valign="top">';echo L('special_status');echo '：</th>
			<td valign="top">';echo form::radio(array('0'=>L('open'),'1'=>L('pause')),$info['disabled'],'name="special[disabled]"');;echo '</td>
		</tr>
	</table>
</div>
<div class="bk15"></div>
    <input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="button">
</div></div>
</form>
</body>
</html>
<script type="text/javascript">

function import_info(url, title, msgID, htmlID, valID) {
	window.top.art.dialog({id:\'selectid\',iframe:url, title:title, width:\'600\', height:\'400\', lock:true},
		function(){
			var d = window.top.art.dialog({id:\'selectid\'}).data.iframe;
			var form = d.document.getElementById(msgID);
			var text = form.value;
			var data = text.split(\'|\');
			if (data[2]) {
				$(\'#\'+htmlID).html(\'<ul id="relation_\'+htmlID+\'" class="list-dot"><li><span>\'+data[2]+\'</span><a onclick="remove_relation(\\\'\'+htmlID+\'\\\', \\\'\'+valID+\'\\\')" class="close" href="javascript:;"></a></li></ul>\');
			} else {
				var dosubmit = d.document.getElementById(\'dosubmit\');
				dosubmit.click();
				$(\'#\'+htmlID).html(\'<ul id="relation_\'+htmlID+\'" class="list-dot"><li><span>\'+text+\'</span><a onclick="remove_relation(\\\'\'+htmlID+\'\\\', \\\'\'+valID+\'\\\')" class="close" href="javascript:;"></a></li></ul>\');
			}
			$(\'#\'+valID).val(text);
			window.top.art.dialog({id:\'selectid\'}).close();
			return false;
		},
		function(){
			window.top.art.dialog({id:\'selectid\'}).close();
		});void(0);
}

function remove_relation(htmlID, valID) {
	$(\'#relation_\'+htmlID).html(\'\');
	$(\'#\'+valID).val(\'\');
}

function load_file_list(id) {
	$.getJSON(\'?s=admin/category/public_tpl_file_list&style=\'+id+\'&module=special&templates=index|list|show&name=special\', function(data){$(\'#index_template\').html(data.index_template);$(\'#list_template\').html(data.list_template);$(\'#show_template\').html(data.show_template);});
}

function addItem() {
	var n = $(\'#option_list\').find(\'input[type="text"]\').length/3+1;
	var newOption =  \'<div class="mb6"><span style="padding-left:76px">';echo L('type_name');echo '：<input type="text" name="type[\'+n+\'][name]" class="input-text" size="15">&nbsp;&nbsp;';echo L('type_path');echo '：<input type="text" name="type[\'+n+\'][typedir]" class="input-text" size="15">&nbsp;&nbsp;';echo L('listorder');echo '：<input type="text" name="type[\'+n+\'][listorder]" value="\'+n+\'" size="6" class="input-text" ></span>&nbsp;<a href="javascript:;" onclick="descItem(this);">';echo L('remove');echo '</a></div>\';
	$(\'#option_list\').append(newOption);
}

function descItem(a, id) {
	$(a).parent().append(\'<input type="hidden" name="type[\'+id+\'][del]" value="1">\');
	$(a).parent().fadeOut();
}

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

$(document).ready(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'220\',height:\'70\'}, function(){this.close();$(obj).focus();})}});
	$(\'#title\').formValidator({autotip:true,onshow:"';echo L('please_input_special_title');echo '",onfocus:"';echo L('min_3_title');echo '",oncorrect:"';echo L('true');echo '"}).inputValidator({min:1,onerror:"';echo L('please_input_special_title');echo '"}).ajaxValidator({type:"get",url:"",data:"s=special/special/public_check_special&id=';echo $_GET['specialid'];echo '",datatype:"html",cached:false,async:\'true\',success : function(data) {
        if( data == "1" )
		{
            return true;
		}
        else
		{
            return false;
		}
	},
	error: function(){alert("';echo L('server_no_data');echo '");},
	onerror : "';echo L('special_exist');echo '",
	onwait : "';echo L('checking');echo '"
}).defaultPassed();
	$(\'#banner\').formValidator({autotip:true,onshow:"';echo L('please_upload_banner');echo '",oncorrect:"';echo L('true');echo '"}).inputValidator({min:6,onerror:"';echo L('please_upload_banner');echo '"}).defaultPassed();
	$(\'#thumb\').formValidator({autotip:true,onshow:"';echo L('please_upload_thumb');echo '",oncorrect:"';echo L('true');echo '"}).inputValidator({min:6,onerror:"';echo L('please_upload_thumb');echo '"}).defaultPassed();
	$(\'#filename\').formValidator({autotip:true,onshow:"';echo L('special_file');echo '",onfocus:\'';echo L('use_letters');echo '\',oncorrect:"';echo L('true');echo '"}).functionValidator({
	    fun:function(val,elem){
        if($("input:radio[type=\'radio\'][checked]").val()==0){
		    return true;
	    }else if($("input:radio[type=\'radio\'][checked]").val()==1 && val==\'\'){
		    return "';echo L('please_input_name');echo '"
	    }  else {
			return true;
		}
	}
}).regexValidator({regexp:"^\\\\w*$", onerror:"';echo L('error');echo '"}).defaultPassed();
	$("#type_name").formValidator({tipid:"typeTip",onshow:"';echo L('input_type_name');echo '",onfocus:"';echo L('input_type_name');echo '",oncorrect:"';echo L('true');echo '"}).inputValidator({min:1,onerror:"';echo L('input_type_name');echo '"}).defaultPassed();
	$(\'#type_path\').formValidator({tipid:"typeTip",onshow:"';echo L('input_type_path');echo '",onfocus:"';echo L('input_type_path');echo '",oncorrect:"';echo L('true');echo '"}).inputValidator({min:2,onerror:"';echo L('input_type_path');echo '"}).regexValidator({regexp:"^\\\\w*$", onerror:"';echo L('error');echo '"}).defaultPassed();
});
$("input:radio[name=\'special[ishtml]\']").click(function (){
	if($("input:radio[name=\'special[ishtml]\'][checked]").val()==0) {
		$("#file_div").hide();
	} else if($("input:radio[type=\'radio\'][checked]").val()==1) {
		$("#file_div").show();
	}
});
</script>';?>