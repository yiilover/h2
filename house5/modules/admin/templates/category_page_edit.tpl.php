<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<script type="text/javascript"> 
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#catname").formValidator({onshow:"';echo L('input_catname');;echo '",onfocus:"';echo L('input_catname');;echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L('input_catname');;echo '"}).defaultPassed();
		$("#catdir").formValidator({onshow:"';echo L('input_dirname');;echo '",onfocus:"';echo L('input_dirname');;echo '"}).regexValidator({regexp:"^([a-zA-Z0-9]|[_-]){0,30}$",onerror:"';echo L('enter_the_correct_catname');;echo '"}).inputValidator({min:1,onerror:"';echo L('input_dirname');;echo '"}).ajaxValidator({type : "get",url : "",data :"s=admin/category/public_check_catdir/old_dir/';echo $catdir;;echo '",datatype : "html",cached:false,getdata:{parentid:\'parentid\'},async:\'true\',cached:false,success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('catname_have_exists');;echo '",onwait : "';echo L('connecting');;echo '"}).defaultPassed();
	})
//-->
</script>

<form name="myform" id="myform" action="?s=admin/category/edit" method="post">
<div class="pad-10">
<div class="col-tab">

<ul class="tabBut cu-li">
            <li id="tab_setting_1" class="on" onclick="SwapTab(\'setting\',\'on\',\'\',5,1);">';echo L('catgory_basic');;echo '</li>
            <li id="tab_setting_2" onclick="SwapTab(\'setting\',\'on\',\'\',5,2);">';echo L('catgory_createhtml');;echo '</li>
            <li id="tab_setting_3" onclick="SwapTab(\'setting\',\'on\',\'\',5,3);">';echo L('catgory_template');;echo '</li>
            <li id="tab_setting_4" onclick="SwapTab(\'setting\',\'on\',\'\',5,4);">';echo L('catgory_seo');;echo '</li>
            <li id="tab_setting_5" onclick="SwapTab(\'setting\',\'on\',\'\',5,5);">';echo L('catgory_private');;echo '</li>
</ul>
<div id="div_setting_1" class="contentList pad-10">

<table width="100%" class="table_form ">
      <tr>
        <th width="200">';echo L('parent_category');echo '£º</th>
        <td>
		';echo form::select_category('category_content_'.$this->siteid,$parentid,'name="info[parentid]" id="parentid"',L('please_select_parent_category'),0,-1);;echo '		</td>
      </tr>
      <tr>
        <th>';echo L('catname');echo '£º</th>
        <td><input type="text" name="info[catname]" id="catname" class="input-text" value="';echo $catname;;echo '"></td>
      </tr>
	<tr>
        <th>';echo L('catdir');echo '£º</th>
        <td><input type="text" name="info[catdir]" id="catdir" class="input-text" value="';echo $catdir;;echo '"></td>
      </tr>
	<tr>
        <th>';echo L('catgory_img');echo '£º</th>
        <td>';echo form::images('info[image]','image',$image,'content');;echo '</td>
      </tr>
	<tr>
        <th>';echo L('description');echo '£º</th>
        <td>
		<textarea name="info[description]" maxlength="255" style="width:300px;height:60px;">';echo $description;;echo '</textarea>
		</td>
      </tr>
<tr>
     <th>';echo L('ismenu');;echo '£º</th>
      <td>
	  <input type=\'radio\' name=\'info[ismenu]\' value=\'1\' ';if($ismenu) echo 'checked';;echo '> ';echo L('yes');;echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=\'radio\' name=\'info[ismenu]\' value=\'0\' ';if(!$ismenu) echo 'checked';;echo '> ';echo L('no');;echo '</td>
    </tr>
</table>

</div>
<div id="div_setting_2" class="contentList pad-10 hidden">
<table width="100%" class="table_form ">
		<tr>
      <th width="200">';echo L('html_category');;echo '£º</th>
      <td>
	  <input type=\'radio\' name=\'setting[ishtml]\' value=\'1\' ';if($setting['ishtml']) echo 'checked';;echo ' onClick="$(\'#category_php_ruleid\').css(\'display\',\'none\');$(\'#category_html_ruleid\').css(\'display\',\'\')"> ';echo L('yes');;echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=\'radio\' name=\'setting[ishtml]\' value=\'0\' ';if(!$setting['ishtml']) echo 'checked';;echo '  onClick="$(\'#category_php_ruleid\').css(\'display\',\'\');$(\'#category_html_ruleid\').css(\'display\',\'none\')"> ';echo L('no');;echo '	  </td>
    </tr>
	
	<tr>
      <th>';echo L('urlrule_url');;echo '£º</th>
      <td><div id="category_php_ruleid" style="display:';if($setting['ishtml']) echo 'none';;echo '">
	';
echo form::urlrule('content','category',0,$setting['category_ruleid'],'name="category_php_ruleid"');
;echo '	</div>
	<div id="category_html_ruleid" style="display:';if(!$setting['ishtml']) echo 'none';;echo '">
	';
echo form::urlrule('content','category',1,$setting['category_ruleid'],'name="category_html_ruleid"');
;echo '	</div>
	</td>
    </tr>
</table>
</div>
<div id="div_setting_3" class="contentList pad-10 hidden">
<table width="100%" class="table_form ">
<tr>
  <th width="200">';echo L('available_styles');;echo '£º</th>
        <td>
		';echo form::select($template_list,$setting['template_list'],'name="setting[template_list]" id="template_list" onchange="load_file_list(this.value)"',L('please_select'));echo ' 
		</td>
</tr>
		<tr>
        <th width="200">';echo L('page_templates');echo '£º</th>
        <td  id="page_template">
		</td>
      </tr>
</table>
</div>
<div id="div_setting_4" class="contentList pad-10 hidden">
<table width="100%" class="table_form ">
	<tr>
      <th width="200">';echo L('meta_title');;echo '</th>
      <td><input name=\'setting[meta_title]\' type=\'text\' id=\'meta_title\' value=\'';echo $setting['meta_title'];;echo '\' size=\'60\' maxlength=\'60\'></td>
    </tr>
    <tr>
      <th >';echo L('meta_keywords');;echo '</th>
      <td><textarea name=\'setting[meta_keywords]\' id=\'meta_keywords\' style="width:90%;height:40px">';echo $setting['meta_keywords'];;echo '</textarea></td>
    </tr>
    <tr>
      <th ><strong>';echo L('meta_description');;echo '</th>
      <td><textarea name=\'setting[meta_description]\' id=\'meta_description\' style="width:90%;height:50px">';echo $setting['meta_description'];;echo '</textarea></td>
    </tr>
</table>
</div>
<div id="div_setting_5" class="contentList pad-10 hidden">
<table width="100%" >
		<tr>
        <th width="200">';echo L('role_private');echo '£º</th>
        <td>
			<table width="100%" class="table-list">
			  <thead>
				<tr>
				  <th align="left" width="200">';echo L('role_name');;echo '</th><th>';echo L('edit');;echo '</th>
			  </tr>
			    </thead>
				 <tbody>
				';
$roles = getcache('role','commons');
foreach($roles as $roleid=>$rolrname) {
$disabled = $roleid==1 ?'disabled': '';
;echo '		  		<tr>
				  <td>';echo $rolrname;echo '</td>
				  <td align="center"><input type="checkbox" name="priv_roleid[]" ';echo $disabled;;echo ' ';echo $this->check_category_priv('init',$roleid);;echo ' value="init,';echo $roleid;;echo '" ></td>
			  </tr>
			  ';};echo '	
			 </tbody>
			</table>
		</td>

      </tr>
		<tr><td colspan=2><hr style="border:1px dotted #F2F2F2;"></td>
		</tr>

	  <tr>
        <th width="200">';echo L('group_private');echo '£º</th>
        <td>
			<table width="100%" class="table-list">
			  <thead>
				<tr>
				  <th align="left" width="200">';echo L('group_name');;echo '</th><th>';echo L('allow_vistor');;echo '</th>
			  </tr>
			    </thead>
				 <tbody>
			';
$group_cache = getcache('grouplist','member');
foreach($group_cache as $_key=>$_value) {
if($_value['groupid']==1) continue;
;echo '		  		<tr>
				  <td>';echo $_value['name'];;echo '</td>
				  <td align="center"><input type="checkbox" name="priv_groupid[]" ';echo $this->check_category_priv('visit',$_value['groupid'],0);;echo '  value="visit,';echo $_value['groupid'];;echo '" ></td>
			  </tr>
			';};echo '			 </tbody>
			</table>
		</td>
      </tr>
</table>
</div>

 <div class="bk15"></div>
	<input name="catid" type="hidden" value="';echo $catid;;echo '">
	<input name="type" type="hidden" value="';echo $type;;echo '">
    <input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="button">

</form>
</div>

</div>
<!--table_form_off-->
</div>

<script language="JavaScript">
<!--
	window.top.$(\'#display_center_id\').css(\'display\',\'none\');
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
	function load_file_list(id) {
		if(id==\'\') return false;
		$.getJSON(\'?s=admin/category/public_tpl_file_list/style/\'+id+\'/catid/';echo $catid;echo '/type/1\', function(data){$(\'#page_template\').html(data.page_template);});
	}
	';if(isset($setting['template_list']) &&!empty($setting['template_list'])) echo "load_file_list('".$setting['template_list']."')";echo '//-->
</script>';?>