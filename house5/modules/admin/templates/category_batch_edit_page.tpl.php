<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<style type="text/css">
.table-list td b{color:#666}
.tpl_style{background-color:#FBFAE3}

</style>
<form name="myform" action="?s=admin/category/batch_edit" method="post">
<div class="pad_10">
<div class="explain-col">
';echo L('category_batch_tips');;echo '</a>
</div>
<div class="bk10"></div>
<div id="table-lists" class="table-list" >
    <table height="auto" cellspacing="0" >
        <thead >
		';
foreach($batch_array as $catid=>$cat) {
$batch_array[$catid]['setting'] = string2array($cat['setting']);
echo "<th width='260' align='left' ><strong>{$cat[catname]} £¨catid: <font color='red'>{$catid}</font>£©</strong></th>";
}
;echo '        </thead>
    <tbody>
     <tr>
	 ';
foreach($batch_array as $catid=>$cat) {
;echo '		<td><b>';echo L('catname');echo '£º</b><br><input type=\'text\' name=\'info[';echo $catid;;echo '][catname]\' id=\'catname\' class=\'input-text\' value=\'';echo $cat['catname'];echo '\' style=\'width:250px\'></td>
	';
}
;echo '	 </tr>
	 <tr>
	 ';
foreach($batch_array as $catid=>$cat) {
;echo '		<td><b>';echo L('catdir');echo '£º</b><br><input type=\'text\' name=\'info[';echo $catid;;echo '][catdir]\' id=\'catname\' class=\'input-text\' value=\'';echo $cat['catdir'];echo '\' style=\'width:250px\'></td>
	';
}
;echo '	 </tr>
	 <tr>
	 ';
foreach($batch_array as $catid=>$cat) {
;echo '		<td><b>';echo L('catgory_img');echo '£º</b><br>';echo form::images('info['.$catid.'][image]','image'.$catid,$cat['image'],'content','',23);;echo '</td>
	';
}
;echo '	 </tr>
	 <tr>
	 ';
foreach($batch_array as $catid=>$cat) {
;echo '		<td><b>';echo L('description');echo '£º</b><br><textarea name="info[';echo $catid;;echo '][description]" maxlength="255" style="width:240px;height:40px;">';echo $cat['description'];;echo '</textarea></td>
	';
}
;echo '	 </tr>
	 <tr>
	 ';
foreach($batch_array as $catid=>$cat) {
;echo '		<td class="tpl_style"><b>';echo L('available_styles');echo '£º</b><br>
		';echo form::select($template_list,$cat['setting']['template_list'],'name="setting['.$catid.'][template_list]" id="template_list" onchange="load_file_list(this.value,'.$catid.')"',L('please_select'));echo ' 
		</td>
	';
}
;echo '	 </tr>
	 <tr>
	 ';
foreach($batch_array as $catid=>$cat) {
;echo '		<td class="tpl_style"><b>';echo L('page_templates');echo '£º</b><br>
		<div id="category_template';echo $catid;;echo '">
		';echo form::select_template($cat['setting']['template_list'],'content',$cat['setting']['page_template'],'name="setting['.$catid.'][page_template]" style="width:250px"','page');;echo '		</div>
		</td>
	';
}
;echo '	 </tr>
	
	
	<tr>
	 ';
foreach($batch_array as $catid=>$cat) {
;echo '		<td><b>';echo L('ismenu');echo '£º</b><br>
		<input boxid="ismenu" type=\'radio\' name=\'info[';echo $catid;;echo '][ismenu]\' value=\'1\' ';if($cat['ismenu']) echo 'checked';;echo ' onclick="change_radio(event,\'ismenu\',1)"> ';echo L('yes');;echo '&nbsp;&nbsp;&nbsp;&nbsp;
		<input boxid="ismenu" type=\'radio\' name=\'info[';echo $catid;;echo '][ismenu]\' value=\'0\' ';if(!$cat['ismenu']) echo 'checked';;echo ' onclick="change_radio(event,\'ismenu\',0)"> ';echo L('no');;echo '	  </td>
	';
}
;echo '	 </tr>
	 <tr>
	 ';
foreach($batch_array as $catid=>$cat) {
;echo '		<td><b>';echo L('html_category');echo '£º</b><br>
		<input boxid="ishtml" catid="';echo $catid;;echo '" type=\'radio\' name=\'setting[';echo $catid;;echo '][ishtml]\' value=\'1\' ';if($cat['setting']['ishtml']) echo 'checked';;echo ' onClick="change_radio(event,\'ishtml\',1,\'category\');urlrule(\'category\',1,';echo $catid;;echo ')"> ';echo L('yes');;echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input boxid="ishtml"  catid="';echo $catid;;echo '" type=\'radio\' name=\'setting[';echo $catid;;echo '][ishtml]\' value=\'0\' ';if(!$cat['setting']['ishtml']) echo 'checked';;echo '  onClick="change_radio(event,\'ishtml\',0,\'category\');urlrule(\'category\',0,';echo $catid;;echo ')"> ';echo L('no');;echo '	  </td>
	';
}
;echo '	 </tr>
	 
	 <tr>
	 ';
foreach($batch_array as $catid=>$cat) {
;echo '		<td><b>';echo L('category_urlrules');echo '£º</b><br>
		<div id="category_php_ruleid';echo $catid;;echo '" style="display:';if($cat['setting']['ishtml']) echo 'none';;echo '">
	';
echo form::urlrule('content','category',0,$cat['setting']['category_ruleid'],'name="category_php_ruleid['.$catid.']" style="width:250px;"');
;echo '	</div>
	<div id="category_html_ruleid';echo $catid;;echo '" style="display:';if(!$cat['setting']['ishtml']) echo 'none';;echo '">
	';
echo form::urlrule('content','category',1,$cat['setting']['category_ruleid'],'name="category_html_ruleid['.$catid.']" style="width:250px;"');
;echo '	</div>
	  </td>
	';
}
;echo '	 </tr>

	 <tr>
	 ';
foreach($batch_array as $catid=>$cat) {
;echo '		<td><b>';echo L('meta_title');echo '£º</b><br>
		<input name=\'setting[';echo $catid;;echo '][meta_title]\' type=\'text\' value=\'';echo $cat['setting']['meta_title'];;echo '\' style=\'width:250px\'>
		  </td>
	';
}
;echo '	 </tr>
	 <tr>
	 ';
foreach($batch_array as $catid=>$cat) {
;echo '		<td><b>';echo L('meta_keywords');echo '£º</b><br>
		<input name=\'setting[';echo $catid;;echo '][meta_keywords]\' type=\'text\' value=\'';echo $cat['setting']['meta_keywords'];;echo '\' style=\'width:250px\'>
		  </td>
	';
}
;echo '	 </tr>
	 <tr>
	 ';
foreach($batch_array as $catid=>$cat) {
;echo '		<td><b>';echo L('meta_description');echo '£º</b><br>
		<input name=\'setting[';echo $catid;;echo '][meta_description]\' type=\'text\' value=\'';echo $cat['setting']['meta_description'];;echo '\' style=\'width:250px\'>
		  </td>
	';
}
;echo '	 </tr>
	
	
    </tbody>
    </table>
    <div class="btn">
	<input type="hidden" name="h5_hash" value="';echo $_SESSION['h5_hash'];;echo '" />
	<input type="hidden" name="type" value="';echo $type;;echo '" />
	<input type="submit" class="button" name="dosubmit" value="';echo L('submit');echo '" /></div>
	<BR><BR>
</div>
</div>
</div>
</form>
 
<script language="JavaScript">
<!--
$(document).keydown(function(event) {
	   if(event.keyCode==37) {
		   window.scrollBy(-100,0);
	   } else if(event.keyCode==39) {
		  window.scrollBy(100,0);
	   }
	});

function change_radio(oEvent,boxid,value,type) {
	altKey = oEvent.altKey;
	if(altKey) {
		var obj = $("input[boxid="+boxid+"][value="+value+"]");
		obj.attr(\'checked\',true);
		if(type){
			obj.each(function(){	
				urlrule(type,value,$(this).attr(\'catid\'));			
			})
		}
	}	
}

window.top.$(\'#display_center_id\').css(\'display\',\'none\');
function urlrule(type,html,catid) {
	if(type==\'category\') {
		if(html) {
			$(\'#category_php_ruleid\'+catid).css(\'display\',\'none\');$(\'#category_html_ruleid\'+catid).css(\'display\',\'\');
		} else {
			$(\'#category_php_ruleid\'+catid).css(\'display\',\'\');$(\'#category_html_ruleid\'+catid).css(\'display\',\'none\');;
		}
	} else {
		if(html) {
			$(\'#show_php_ruleid\'+catid).css(\'display\',\'none\');$(\'#show_html_ruleid\'+catid).css(\'display\',\'\');
		} else {
			$(\'#show_php_ruleid\'+catid).css(\'display\',\'\');$(\'#show_html_ruleid\'+catid).css(\'display\',\'none\');;
		}
	}	
}
function load_file_list(id,catid) {
	if(id==\'\') return false;
	$.getJSON(\'?s=admin/category/public_tpl_file_list/batch_str/1/type/1/style/\'+id+\'/catid/\'+catid, function(data){
	if(data==null) return false;
	$(\'#category_template\'+catid).html(data.page_template);});
}
//-->
</script>
</body>
</html>
';?>