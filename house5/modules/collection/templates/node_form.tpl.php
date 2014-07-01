<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<script type="text/javascript">
$(document).ready(function() {
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'})}});
	$("#name").formValidator({onshow:"';echo L('input').L('nodename');echo '",onfocus:"';echo L('input').L('nodename');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('nodename');echo '"}).ajaxValidator({type : "get",url : "",data :"s=collection/node/public_name';if(ROUTE_A=='edit')echo "/nodeid/$data[nodeid]";echo '",datatype : "html",async:\'false\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('nodename').L('exists');echo '",onwait : "';echo L('connecting');echo '"})';if(ROUTE_A=='edit')echo ".defaultPassed()";echo ';

});
</script>
<div class="pad-10">
<div class="col-tab">
<ul class="tabBut cu-li">
<li class="on" id="tab_1"><a href="javascript:show_div(\'1\')">';echo L('url_rewrites');echo '</a></li>
<li  id="tab_2"><a href="javascript:show_div(\'2\')">';echo L('content_rules');echo '</a></li>
<li  id="tab_3"><a href="javascript:show_div(\'3\')">';echo L('custom_rule');echo '</a></li>
<li  id="tab_4"><a href="javascript:show_div(\'4\')">';echo L('eigrp');echo '</a></li>
</ul>
<form name="myform" action="?s=collection/node/';echo ROUTE_A;echo '/nodeid/';if(isset($nodeid)) echo $nodeid;echo '" method="post" id="myform">
<div class="content pad-10" id="show_div_1" style="height:auto">
<div class="common-form">
<fieldset>
	<legend>';echo L('basic_configuration');echo '</legend>
	<table width="100%" class="table_form">
		<tr>
			<td width="120">';echo L('collection_items_of');echo '£º</td> 
			<td>
			<input type="text" name="data[name]" id="name"  class="input-text" value="';if(isset($data['name'])) echo $data['name'];echo '"></input>
			</td>
		</tr>
		<tr>
			<td width="120">';echo L('encode_varchar');echo '£º</td> 
			<td>
			';echo form::radio(array('gbk'=>'GBK','utf-8'=>'UTF-8','big5'=>'BIG5'),(isset($data['sourcecharset']) ?$data['sourcecharset'] : 'gbk'),'name="data[sourcecharset]"');echo '			</td>
		</tr>
	</table>
</fieldset>
<fieldset>
	<legend>';echo L('web_sites_to_collect');echo '</legend>
	<table width="100%" class="table_form">
		<tr>
			<td width="120">';echo L('url_type');echo '£º</td> 
			<td>
			';echo form::radio($this->url_list_type,(isset($data['sourcetype']) ?$data['sourcetype'] : '1'),'name="data[sourcetype]" onclick="show_url_type(this.value)"');echo '			</td>
		</tr>
		<tbody id="url_type_1" ';if (isset($data['sourcetype'])  &&$data['sourcetype'] != 1){echo ' style="display:none"';};echo '>
		<tr>
			<td width="120">';echo L('url_configuration');echo '£º</td> 
			<td>
			 <input type="text" name="urlpage1" id="urlpage_1" size="100" value="';if(isset($data['sourcetype']) &&$data['sourcetype'] == 1 &&isset($data['urlpage'])) echo $data['urlpage'];;echo '"> <input type="button" class="button" onclick="show_url()" value="';echo L('test');echo '"><br /> 
			';echo L('url_msg');echo '<br />
			 ';echo L('page_from');echo ': <input type="text" name="data[pagesize_start]" value="';if(isset($data['sourcetype']) &&$data['sourcetype'] == 1 &&isset($data['pagesize_start'])) {echo $data['pagesize_start'];}else {echo '1';};echo '" size="4"> ';echo L('to');echo ' <input type="text" name="data[pagesize_end]" value="';if(isset($data['sourcetype']) &&$data['sourcetype'] == 1 &&isset($data['pagesize_end'])) {echo $data['pagesize_end'];}else {echo '10';};echo '" size="4"> ';echo L('increment_by');echo '<input type="text" name="data[par_num]" size="4" value="';if(isset($data['sourcetype']) &&$data['sourcetype'] == 1 &&isset($data['par_num'])) {echo $data['par_num'];}else {echo '1';};echo '">
			</td>
		</tr>
		</tbody>
		<tbody id="url_type_2"  ';if (!isset($data['sourcetype']) ||$data['sourcetype'] != 2){echo ' style="display:none"';};echo '>
		<tr>
			<td width="120">';echo L('url_configuration');echo '£º</td> 
			<td>
			<textarea rows="10" cols="80" name="urlpage2" id="urlpage_2" >';if(isset($data['sourcetype']) &&$data['sourcetype'] == 2 &&isset($data['urlpage'])) {echo $data['urlpage'];};echo '</textarea> <br>';echo L('one_per_line');echo '			</td>
		</tr>
		</tbody>
		<tbody id="url_type_3"  ';if (!isset($data['sourcetype']) ||$data['sourcetype'] != 3){echo ' style="display:none"';};echo '>
		<tr>
			<td width="120">';echo L('url_configuration');echo '£º</td> 
			<td>
			 <input type="text" name="urlpage3" id="urlpage_3" size="100" value="';if(isset($data['sourcetype']) &&$data['sourcetype'] == 3 &&isset($data['urlpage'])) {echo $data['urlpage'];};echo '">
			</td>
		</tr>
		</tbody>
		<tbody id="url_type_4"  ';if (!isset($data['sourcetype']) ||$data['sourcetype'] != 4){echo ' style="display:none"';};echo '>
		<tr>
			<td width="120">';echo L('url_configuration');echo '£º</td> 
			<td>
			 <input type="text" name="urlpage4" id="urlpage_4" size="100" value="';if(isset($data['sourcetype']) &&$data['sourcetype'] == 4 &&isset($data['urlpage'])) {echo $data['urlpage'];};echo '">
			</td>
		</tr>
		</tbody>
		<tr>
			<td width="120">';echo L('url_configuration');echo '£º</td> 
			<td>
			';echo L('site_must_contain');echo '<input type="text" name="data[url_contain]"  value="';if(isset($data['url_contain'])) echo $data['url_contain'];echo '"> ';echo L('the_web_site_does_not_contain');echo '<input type="text" name="data[url_except]"  value="';if(isset($data['url_except'])) echo $data['url_except'];echo '">
			</td>
		</tr>
			<tr>
			<td width="120">';echo L('base_configuration');echo '£º</td> 
			<td>
			<input type="text" name="data[page_base]"  value="';if(isset($data['page_base'])) echo $data['page_base'];echo '" size="100" ><br>
			';echo L('base_msg');echo '			</td>
		</tr>
		<tr>
			<td width="120">';echo L('get_url');echo '£º</td> 
			<td>
			';echo L('from');echo ' <textarea rows="10" cols="40" name="data[url_start]">';if(isset($data['url_start'])) echo $data['url_start'];echo '</textarea> ';echo L('to');echo ' <textarea rows="10" name="data[url_end]" cols="40">';if(isset($data['url_end'])) echo $data['url_end'];echo '</textarea> ';echo L('finish');echo '			</td>
		</tr>
	</table>
</fieldset>

</div>
</div>
<div class="content pad-10" id="show_div_2" style="height:auto;display:none">
<div class="explain-col">
';echo L('rule_msg');echo '</div>
<div class="bk15"></div>
<input type="button" class="button" value="';echo L('expand_all');echo '" onclick="$(\'#show_div_2\').children(\'fieldset\').children(\'.table_form\').show()"> <input type="button" class="button" value="';echo L('all_the');echo '" onclick="$(\'#show_div_2\').children(\'fieldset\').children(\'.table_form\').hide()">
<fieldset>
	<legend><a href="javascript:void(0)" onclick="$(this).parent().parent().children(\'table\').toggle()">';echo L('title').L('rule');echo '</a></legend>
	<table width="100%" class="table_form">
		<tr>
			<td width="120">';echo L('matching_rule');echo '£º</td> 
			<td>
			<textarea rows="5" cols="40" name="data[title_rule]" id="title_rule">';if(isset($data['title_rule'])) {echo $data['title_rule'];}else{echo '<title>'.L('[content]').'</title>';};echo '</textarea> <br>';echo L('use');echo '"<a href="javascript:insertText(\'title_rule\', \'';echo L('[content]');echo '\')">';echo L('[content]');echo '</a>"';echo L('w_wildmenu');echo '			</td>
			<td width="120">';echo L('filtering');echo '£º</td> 
			<td>
			<textarea rows="5" cols="50" name="data[title_html_rule]" id="title_html_rule">';if(isset($data['title_html_rule'])) echo $data['title_html_rule'];echo '</textarea>
			<input type="button" value="';echo L('select');echo '" class="button"  onclick="html_role(\'data[title_html_rule]\')">
			</td>
		</tr>
	</table>
</fieldset>
<fieldset>
	<legend><a href="javascript:void(0)" onclick="$(this).parent().parent().children(\'table\').toggle()">';echo L('author').L('rule');echo '</a></legend>
	<table width="100%" class="table_form" style="display:none">
		<tr>
			<td width="120">';echo L('matching_rule');echo '£º</td> 
			<td>
			<textarea rows="5" cols="40" name="data[author_rule]" id="author_rule">';if(isset($data['author_rule'])) echo $data['author_rule'];echo '</textarea>  <br>';echo L('use');echo '"<a href="javascript:insertText(\'author_rule\', \'';echo L('[content]');echo '\')">';echo L('[content]');echo '</a>"';echo L('w_wildmenu');echo '			</td>
			<td width="120">';echo L('filtering');echo '£º</td> 
			<td>
			<textarea rows="5" cols="50" name="data[author_html_rule]" id="author_html_rule">';if(isset($data['author_html_rule'])) echo $data['author_html_rule'];echo '</textarea>
			<input type="button" value="';echo L('select');echo '" class="button"  onclick="html_role(\'data[author_html_rule]\')">
			</td>
		</tr>
	</table>
</fieldset>
<fieldset>
	<legend><a href="javascript:void(0)" onclick="$(this).parent().parent().children(\'table\').toggle()">';echo L('comeform').L('rule');echo '</a></legend>
	<table width="100%" class="table_form" style="display:none">
		<tr>
			<td width="120">';echo L('matching_rule');echo '£º</td> 
			<td>
			<textarea rows="5" cols="40" name="data[comeform_rule]" id="comeform_rule">';if(isset($data['comeform_rule'])) echo $data['comeform_rule'];echo '</textarea> <br>';echo L('use');echo '"<a href="javascript:insertText(\'comeform_rule\', \'';echo L('[content]');echo '\')">';echo L('[content]');echo '</a>"';echo L('w_wildmenu');echo '			</td>
			<td width="120">';echo L('filtering');echo '£º</td> 
			<td>
			<textarea rows="5" cols="50" name="data[comeform_html_rule]" id="comeform_html_rule">';if(isset($data['comeform_html_rule'])) echo $data['comeform_html_rule'];echo '</textarea>
			<input type="button" value="';echo L('select');echo '" class="button"  onclick="html_role(\'data[comeform_html_rule]\')">
			</td>
		</tr>
	</table>
</fieldset>
<fieldset>
	<legend><a href="javascript:void(0)" onclick="$(this).parent().parent().children(\'table\').toggle()">';echo L('time').L('rule');echo '</a></legend>
	<table width="100%" class="table_form"  style="display:none">
		<tr>
			<td width="120">';echo L('matching_rule');echo '£º</td> 
			<td>
			<textarea rows="5" cols="40" name="data[time_rule]" id="time_rule">';if(isset($data['time_rule'])) echo $data['time_rule'];echo '</textarea> <br>';echo L('use');echo '"<a href="javascript:insertText(\'time_rule\', \'';echo L('[content]');echo '\')">';echo L('[content]');echo '</a>"';echo L('w_wildmenu');echo '			</td>
			<td width="120">';echo L('filtering');echo '£º</td> 
			<td>
			<textarea rows="5" cols="50" name="data[time_html_rule]" id="time_html_rule">';if(isset($data['time_html_rule'])) echo $data['time_html_rule'];echo '</textarea>
			<input type="button" value="';echo L('select');echo '" class="button"  onclick="html_role(\'data[time_html_rule]\')">
			</td>
		</tr>
	</table>
</fieldset>
<fieldset>
	<legend><a href="javascript:void(0)" onclick="$(this).parent().parent().children(\'table\').toggle()">';echo L('content').L('rule');echo '</a></legend>
	<table width="100%" class="table_form" style="display:none">
		<tr>
			<td width="120">';echo L('matching_rule');echo '£º</td> 
			<td>
			<textarea rows="5" cols="40" name="data[content_rule]" id="content_rule">';if(isset($data['content_rule'])) echo $data['content_rule'];echo '</textarea> <br>';echo L('use');echo '"<a href="javascript:insertText(\'content_rule\', \'';echo L('[content]');echo '\')">';echo L('[content]');echo '</a>"';echo L('w_wildmenu');echo '			</td>
			<td width="120">';echo L('filtering');echo '£º</td> 
			<td>
			<textarea rows="5" cols="50" name="data[content_html_rule]" id="content_html_rule">';if(isset($data['content_html_rule'])) echo $data['content_html_rule'];echo '</textarea>
			<input type="button" value="';echo L('select');echo '" class="button"  onclick="html_role(\'data[content_html_rule]\')">
			</td>
		</tr>
	</table>
</fieldset>
<fieldset>
	<legend><a href="javascript:void(0)" onclick="$(this).parent().parent().children(\'table\').toggle()">';echo L('content_page').L('rule');echo '</a></legend>
	<table width="100%" class="table_form" style="display:none">
		<tr>
			<td width="120">';echo L('page_mode');echo '£º</td> 
			<td>
			';echo form::radio(array('1'=>L('all_are_models'),'2'=>L('down_the_pages_mode')),(isset($data['content_page_rule']) ?$data['content_page_rule'] : 1),'name="data[content_page_rule]" onclick="show_nextpage(this.value)"');echo '			</td>
			</tr>
		<tbody id="nextpage" ';if(!isset($data['content_page_rule']) ||$data['content_page_rule']!=2) echo 'style="display:none"';echo '>
			<tr>
			<td width="120">';echo L('nextpage_rule');echo '£º</td> 
			<td>
			<input type="text" name="data[content_nextpage]" size="100" value="';if(isset($data['content_nextpage'])) echo $data['content_nextpage'];echo '"><br>
			';echo L('nextpage_rule_msg');echo '			</td>
			</tr>
		</tbody>
		<tr>
			<td width="120">';echo L('matching_rule');echo '£º</td> 
			<td>
			';echo L('from');echo ' <textarea rows="5" cols="40" name="data[content_page_start]" id="content_page_start">';if(isset($data['content_page_start'])) echo $data['content_page_start'];echo '</textarea> ';echo L('to');echo ' <textarea rows="5" cols="40" name="data[content_page_end]" id="content_page_end">';if(isset($data['content_page_end'])) echo $data['content_page_end'];echo '</textarea>
			</td>
			</tr>
	</table>
</fieldset>
</div>

<div class="content pad-10" id="show_div_3" style="height:auto;display:none">
<input type="button" class="button" value="';echo L('add_item');echo '" onclick="add_caiji()">
<div class="bk10"></div>
<table width="100%" class="table_form" id="customize_config">
';if(isset($data['customize_config']) &&is_array($data['customize_config'])) foreach ($data['customize_config'] as $k=>$v):;echo '<tbody id="customize_config_';echo $k;echo '"><tr style="background-color:#FBFFE4"><td>';echo L('rulename');echo '£º</td><td><input type="text" name="customize_config[name][';echo $k;echo ']" value="';echo $v['name'];echo '" class="input-text" /></td><td>';echo L('rules_in_english');echo '£º</td><td><input type="text" name="customize_config[en_name][';echo $k;echo ']" value="';echo $v['en_name'];echo '" class="input-text" /></td></tr><tr><td width="120">';echo L('matching_rule');echo '£º</td><td><textarea rows="5" cols="40" name="customize_config[rule][';echo $k;echo ']" id="rule_';echo $k;echo '">';echo $v['rule'];echo '</textarea> <br>';echo L('use');echo '"<a href="javascript:insertText(\'rule_';echo $k;echo '\', \'';echo L('[content]');echo '\')">';echo L('[content]');echo '</a>"';echo L('w_wildmenu');echo '</td><td width="120">';echo L('filtering');echo '£º</td><td><textarea rows="5" cols="50" name="customize_config[html_rule][';echo $k;echo ']">';echo $v['html_rule'];echo '</textarea><input type="button" value="';echo L('select');echo '" class="button"  onclick="html_role(\'customize_config[html_rule][';echo $k;echo ']\')"></td></tr></tbody>
';endforeach;;echo '	</table>
</div>

<div class="content pad-10" id="show_div_4" style="height:auto;display:none">
<table width="100%" class="table_form" >
		<tr>
			<td width="120">';echo L('download_pic');echo '£º</td> 
			<td>
			';echo form::radio(array('1'=>L('download_pic'),'0'=>L('no_download')),(isset($data['down_attachment']) ?$data['down_attachment'] : '0'),'name="data[down_attachment]"');echo '			</td>
		</tr>
		<tr>
			<td width="120">';echo L('watermark');echo '£º</td> 
			<td>
			';echo form::radio(array('1'=>L('gfl_sdk'),'0'=>L('no_gfl_sdk')),(isset($data['watermark']) ?$data['watermark'] : '0'),'name="data[watermark]"');echo '			</td>
		</tr>
		<tr>
			<td width="120">';echo L('content_page_models');echo '£º</td> 
			<td>
			';echo form::radio(array('0'=>L('no_page'),'1'=>L('by_the_paging')),(isset($data['content_page']) ?$data['content_page'] : '1'),'name="data[content_page]"');echo '			</td>
		</tr>
		<tr>
			<td width="120">';echo L('sort_order');echo '£º</td> 
			<td>
			';echo form::radio(array('1'=>L('with_goals_from_the_same'),'2'=>L('and_objectives_of_the_standing_opposite')),(isset($data['coll_order']) ?$data['coll_order'] : '1'),'name="data[coll_order]"');echo '			</td>
		</tr>
	</table>
</div>
</div>


    <div class="bk15"></div>
    <input name="dosubmit" type="submit" id="dosubmit" value="';echo L('submit');echo '" class="button">
</div>

</form>
<script type="text/javascript">
<!--
function insertText(id, text)
{
	$(\'#\'+id).focus();
    var str = document.selection.createRange();
	str.text = text;
}

function show_url_type(obj) {
	var num = ';echo count($this->url_list_type);;echo ';
	for (var i=1; i<=num; i++){
		if (obj==i){ 
			$(\'#url_type_\'+i).show();
		} else {
			$(\'#url_type_\'+i).hide();
		}
	}
}

function show_div(id) {
	for (var i=1;i<=4;i++) {
		if (id==i) {
			$(\'#tab_\'+i).addClass(\'on\');
			$(\'#show_div_\'+i).show();
		} else {
			$(\'#tab_\'+i).removeClass(\'on\');
			$(\'#show_div_\'+i).hide();
		}
	}
}


function show_url() {
	var type = $("input[type=\'radio\'][name=\'data[sourcetype]\']:checked").val();
	window.top.art.dialog({id:\'test_url\',iframe:\'?s=collection/node/public_url/sourcetype/\'+type+\'&urlpage=\'+$(\'#urlpage_\'+type).val()+\'&pagesize_start=\'+$("input[name=\'data[pagesize_start]\']").val()+\'&pagesize_end=\'+$("input[name=\'data[pagesize_end]\']").val()+\'&par_num=\'+$("input[name=\'data[par_num]\']").val(), title:\'';echo L('testpageurl');echo '\', width:\'700\', height:\'450\'}, \'\', function(){window.top.art.dialog({id:\'test_url\'}).close()});
			
}

function anti_selectall(obj) {
	$("input[name=\'"+obj+"\']").each(function(i,n){
		if (this.checked) {
			this.checked = false;
		} else {
			this.checked = true;
		}});
}

function show_nextpage(value) {
	if (value == 2) {
		$(\'#nextpage\').show();
	} else {
		$(\'#nextpage\').hide();
	}
}

var i =';echo  isset($data['customize_config']) ?count($data['customize_config']) : 0;echo ';
function add_caiji() {
	var html = \'<tbody id="customize_config_\'+i+\'"><tr style="background-color:#FBFFE4"><td>';echo L('rulename');echo '£º</td><td><input type="text" name="customize_config[name][]" class="input-text" /></td><td>';echo L('rules_in_english');echo '£º</td><td><input type="text" name="customize_config[en_name][]" class="input-text" /></td></tr><tr><td width="120">';echo L('matching_rule');echo '£º</td><td><textarea rows="5" cols="40" name="customize_config[rule][]" id="rule_\'+i+\'"></textarea> <br>';echo L('use');echo '"<a href="javascript:insertText(\\\'rule_\'+i+\'\\\', \\\'';echo L('[content]');echo '\\\')">';echo L('[content]');echo '</a>"';echo L('w_wildmenu');echo '</td><td width="120">';echo L('filtering');echo '£º</td><td><textarea rows="5" cols="50" name="customize_config[html_rule][]" id="content_html_rule_\'+i+\'"></textarea><input type="button" value="';echo L('select');echo '" class="button"  onclick="html_role(\\\'content_html_rule_\'+i+\'\\\', 1)"></td></tr></tbody>\';
	$(\'#customize_config\').append(html);
	i++;
}

function html_role(id, type) {
	art.dialog({id:\'test_url\',content:\'';echo form::checkbox(self::$html_tag,'','name="html_rule"','','120');echo '<br><div class="bk15"></div><center><input type="button" value="';echo L('select_all');echo '" class="button"  onclick="selectall(\\\'html_rule\\\')"> <input type="button" class="button"  value="';echo L('invert');echo '" onclick="anti_selectall(\\\'html_rule\\\')"></center>\', width:\'500\', height:\'150\', lock: false}, function(){var old = $("textarea[name=\'"+id+"\']").val();var str = \'\';$("input[name=\'html_rule\']:checked").each(function(){str+=$(this).val()+"\\n";});$((type == 1 ? "#"+id :"textarea[name=\'"+id+"\']")).val((old ? old+"\\n" : \'\')+str);}, function(){art.dialog({id:\'test_url\'}).close()});
}
';if (ROUTE_A == 'edit') echo '$(\'#show_div_2\').children(\'fieldset\').children(\'.table_form\').show();';;echo '//-->
</script>
</body>
</html>';?>