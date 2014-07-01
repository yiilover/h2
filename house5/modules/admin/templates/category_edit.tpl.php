<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<script type="text/javascript"> 
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#modelid").formValidator({onshow:"';echo L('select_model');;echo '",onfocus:"';echo L('select_model');;echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L('select_model');;echo '"}).defaultPassed();
		$("#catname").formValidator({onshow:"';echo L('input_catname');;echo '",onfocus:"';echo L('input_catname');;echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L('input_catname');;echo '"}).defaultPassed();
		$("#catdir").formValidator({onshow:"';echo L('input_dirname');;echo '",onfocus:"';echo L('input_dirname');;echo '"}).regexValidator({regexp:"^([a-zA-Z0-9、-]|[_]){0,30}$",onerror:"';echo L('enter_the_correct_catname');;echo '"}).inputValidator({min:1,onerror:"';echo L('input_dirname');;echo '"}).ajaxValidator({type : "get",url : "",data :"s=admin/category/public_check_catdir/old_dir/';echo $catdir;;echo '",datatype : "html",cached:false,getdata:{parentid:\'parentid\'},async:\'false\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('catname_have_exists');;echo '",onwait : "';echo L('connecting');;echo '"}).defaultPassed();
		$("#url").formValidator({onshow:" ",onfocus:"';echo L('domain_name_format');;echo '",tipcss:{width:\'300px\'},empty:true}).inputValidator({onerror:"';echo L('domain_name_format');;echo '"}).regexValidator({regexp:"http:\\/\\/(.+)\\/$",onerror:"';echo L('domain_end_string');;echo '"});
		$("#template_list").formValidator({onshow:"';echo L('template_setting');;echo '",onfocus:"';echo L('template_setting');;echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L('template_setting');;echo '"}).defaultPassed();
	})
//-->
</script>

<form name="myform" id="myform" action="?s=admin/category/edit" method="post">
<div class="pad-10">
<div class="col-tab">

<ul class="tabBut cu-li">
<li id="tab_setting_1" class="on" onclick="SwapTab(\'setting\',\'on\',\'\',6,1);">';echo L('catgory_basic');;echo '</li>
<li id="tab_setting_2" onclick="SwapTab(\'setting\',\'on\',\'\',6,2);">';echo L('catgory_createhtml');;echo '</li>
<li id="tab_setting_3" onclick="SwapTab(\'setting\',\'on\',\'\',6,3);">';echo L('catgory_template');;echo '</li>
<li id="tab_setting_4" onclick="SwapTab(\'setting\',\'on\',\'\',6,4);">';echo L('catgory_seo');;echo '</li>
<li id="tab_setting_5" onclick="SwapTab(\'setting\',\'on\',\'\',6,5);">';echo L('catgory_private');;echo '</li>
<li id="tab_setting_6" onclick="SwapTab(\'setting\',\'on\',\'\',6,6);">';echo L('catgory_readpoint');;echo '</li>
</ul>
<div id="div_setting_1" class="contentList pad-10">

<table width="100%" class="table_form ">
		<tr>
        <th width="200">';echo L('select_model');echo '：</th>
        <td>
		 ';
$category_items = getcache('category_items_'.$modelid,'commons');
$disabled = 'disabled';
$models = getcache('model','commons');
$model_datas = array();
foreach($models as $_k=>$_v) {
if($_v['siteid']!=$this->siteid) continue;
$model_datas[$_v['modelid']] = $_v['name'];
}
echo form::select($model_datas,$modelid,'name="info[modelid]" id="modelid" '.$disabled,L('select_model'));
;echo '		</td>
      </tr>
      <tr>
        <th width="200">';echo L('parent_category');echo '：</th>
        <td>
		';if(in_array($r['catid'],array('6','7','8','9','10','11','12','13','14','15','48','61','62','99','106','107','110','111','112','113')))
{
echo form::select_category('category_content_'.$this->siteid,$parentid,'name="info[parentid]" id="parentid" disabled',L('please_select_parent_category'),0,-1);
}
else
{
echo form::select_category('category_content_'.$this->siteid,$parentid,'name="info[parentid]" id="parentid"','',$modelid,-1);
};echo ' 
		</td>
      </tr>
      <tr>
        <th>';echo L('catname');echo '：</th>
        <td><input type="text" name="info[catname]" id="catname" class="input-text" value="';echo $catname;;echo '"></td>
      </tr>
	<tr>
        <th>';echo L('catdir');echo '：</th>
        <td><input type="text" name="info[catdir]" id="catdir" class="input-text" value="';echo $catdir;;echo '"></td>
      </tr>
	<tr>
        <th>';echo L('catgory_img');echo '：</th>
        <td>';echo form::images('info[image]','image',$image,'content');;echo '</td>
      </tr>
	<tr>
        <th>';echo L('description');echo '：</th>
        <td>
		<textarea name="info[description]" maxlength="255" style="width:300px;height:60px;">';echo $description;;echo '</textarea>
		</td>
      </tr>
	 <tr>
      <th>';echo L('workflow');;echo '：</th>
      <td>
	  ';
$workflows = getcache('workflow_'.$this->siteid,'commons');
if($workflows) {
$workflows_datas = array();
foreach($workflows as $_k=>$_v) {
$workflows_datas[$_v['workflowid']] = $_v['workname'];
}
echo form::select($workflows_datas,$setting['workflowid'],'name="setting[workflowid]"',L('catgory_not_need_check'));
}else {
echo '<input type="hidden" name="setting[workflowid]" value="">';
echo L('add_workflow_tips');
}
;echo '	  </td>
    </tr>
<tr>
     <th>';echo L('ismenu');;echo '：</th>
      <td>
	  <input type=\'radio\' name=\'info[ismenu]\' value=\'1\' ';if($ismenu) echo 'checked';;echo '> ';echo L('yes');;echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=\'radio\' name=\'info[ismenu]\' value=\'0\' ';if(!$ismenu) echo 'checked';;echo '> ';echo L('no');;echo '</td>
    </tr>

</table>

</div>
<div id="div_setting_2" class="contentList pad-10 hidden">
<table width="100%" class="table_form">
	<tr>
      <th width="200">';echo L('html_category');;echo '：</th>
      <td>
	  <input type=\'radio\' name=\'setting[ishtml]\' value=\'1\' ';if($setting['ishtml']) echo 'checked';;echo ' onClick="$(\'#category_php_ruleid\').css(\'display\',\'none\');$(\'#category_html_ruleid\').css(\'display\',\'\');$(\'#tr_domain\').css(\'display\',\'\');"> ';echo L('yes');;echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=\'radio\' name=\'setting[ishtml]\' value=\'0\' ';if(!$setting['ishtml']) echo 'checked';;echo '  onClick="$(\'#category_php_ruleid\').css(\'display\',\'\');$(\'#category_html_ruleid\').css(\'display\',\'none\');$(\'#tr_domain\').css(\'display\',\'none\');"> ';echo L('no');;echo '	  </td>
    </tr>
	<tr>
      <th>';echo L('html_show');;echo '：</th>
      <td>
	  <input type=\'radio\' name=\'setting[content_ishtml]\' value=\'1\' ';if($setting['content_ishtml']) echo 'checked';;echo ' onClick="$(\'#show_php_ruleid\').css(\'display\',\'none\');$(\'#show_html_ruleid\').css(\'display\',\'\')"> ';echo L('yes');;echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=\'radio\' name=\'setting[content_ishtml]\' value=\'0\' ';if(!$setting['content_ishtml']) echo 'checked';;echo '  onClick="$(\'#show_php_ruleid\').css(\'display\',\'\');$(\'#show_html_ruleid\').css(\'display\',\'none\')"> ';echo L('no');;echo '	  </td>
    </tr>
	<tr>
      <th>';echo L('category_urlrules');;echo '：</th>
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
	
	<tr>
      <th>';echo L('show_urlrules');;echo '：</th>
      <td><div id="show_php_ruleid" style="display:';if($setting['content_ishtml']) echo 'none';;echo '">
	  ';
echo form::urlrule('content','show',0,$setting['show_ruleid'],'name="show_php_ruleid"');
;echo '	</div>
	<div id="show_html_ruleid" style="display:';if(!$setting['content_ishtml']) echo 'none';;echo '">
	  ';
echo form::urlrule('content','show',1,$setting['show_ruleid'],'name="show_html_ruleid"');
;echo '	</div>
	</td>
    </tr>
<tr>
     <th>';echo L('create_to_rootdir');;echo '：</th>
      <td>
	  <input type=\'radio\' name=\'setting[create_to_html_root]\' value=\'1\' ';if($setting['create_to_html_root']) echo 'checked';;echo ' > ';echo L('yes');;echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=\'radio\' name=\'setting[create_to_html_root]\' value=\'0\' ';if(!$setting['create_to_html_root']) echo 'checked';;echo ' > ';echo L('no');;echo '	  （';echo L('create_to_rootdir_tips');;echo '）</td>
    </tr>
    <tr id="tr_domain" style="display:';if(!$setting['ishtml']) echo 'none';;echo '">
        <th>';echo L('domain');echo '：</th>
        <td><input type="text" name="info[url]" id="url" class="input-text" size="50" value="';if(preg_match('/^http:\/\/([a-z0-9\-\.]+)\/$/i',$url)) echo $url;;echo '"></td>
      </tr>
</table>
</div>
<div id="div_setting_3" class="contentList pad-10 hidden">
<table width="100%" class="table_form ">
<tr>
  <th width="200">';echo L('available_styles');;echo '：</th>
        <td>
		';echo form::select($template_list,$setting['template_list'],'name="setting[template_list]" id="template_list" onchange="load_file_list(this.value)"',L('please_select'));echo ' 
		</td>
</tr>
		<tr>
        <th width="200">';echo L('category_index_tpl');echo '：</th>
 <td  id="category_template">
		</td>      </tr>
	  <tr>
        <th width="200">';echo L('category_list_tpl');echo '：</th>
        <td  id="list_template">
		</td>
      </tr>
	  <tr>
        <th width="200">';echo L('content_tpl');echo '：</th>
        <td  id="show_template">
		</td>
      </tr>
	  
	  <!--模版应用到子栏目配置-->
	  <tr>
        <th width="200">';echo '模板应用到子栏目';;echo '</th>
        <td><input type=\'radio\' name=\'template_child\' value=\'1\'> ';echo L('yes');;echo '&nbsp;&nbsp;&nbsp;&nbsp;
          <input type=\'radio\' name=\'template_child\' value=\'0\' checked> ';echo L('no');;echo '</td></td>
      </tr>
	  <!--end 模版应用到子栏目配置-->
	  
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
        <th width="200">';echo L('role_private');echo '：</th>
        <td>
			<table width="100%" class="table-list">
			  <thead>
				<tr>
				  <th align="left">';echo L('role_name');;echo '</th><th>';echo L('view');;echo '</th><th>';echo L('add');;echo '</th><th>';echo L('edit');;echo '</th><th>';echo L('delete');;echo '</th><th>';echo L('listorder');;echo '</th><th>';echo L('push');;echo '</th><th>';echo L('move');;echo '</th>
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
				  <td align="center"><input type="checkbox" name="priv_roleid[]" ';echo $disabled;;echo ' ';echo $this->check_category_priv('add',$roleid);;echo ' value="add,';echo $roleid;;echo '" ></td>
				  <td align="center"><input type="checkbox" name="priv_roleid[]" ';echo $disabled;;echo ' ';echo $this->check_category_priv('edit',$roleid);;echo ' value="edit,';echo $roleid;;echo '" ></td>
				  <td align="center"><input type="checkbox" name="priv_roleid[]" ';echo $disabled;;echo ' ';echo $this->check_category_priv('delete',$roleid);;echo ' value="delete,';echo $roleid;;echo '" ></td>
				  <td align="center"><input type="checkbox" name="priv_roleid[]" ';echo $disabled;;echo ' ';echo $this->check_category_priv('listorder',$roleid);;echo ' value="listorder,';echo $roleid;;echo '" ></td>
				  <td align="center"><input type="checkbox" name="priv_roleid[]" ';echo $disabled;;echo ' ';echo $this->check_category_priv('push',$roleid);;echo ' value="push,';echo $roleid;;echo '" ></td>
				  <td align="center"><input type="checkbox" name="priv_roleid[]" ';echo $disabled;;echo ' ';echo $this->check_category_priv('move',$roleid);;echo ' value="move,';echo $roleid;;echo '" ></td>
			  </tr>
			  ';};echo '	
			 </tbody>
			</table>
		</td>

      </tr>
		<tr><td colspan=2><hr style="border:1px dotted #F2F2F2;"></td>
		</tr>

	  <tr>
        <th width="200">';echo L('group_private');echo '：</th>
        <td>
			<table width="100%" class="table-list">
			  <thead>
				<tr>
				  <th align="left">';echo L('group_name');;echo '</th><th>';echo L('allow_vistor');;echo '</th><th>';echo L('allow_contribute');;echo '</th>
			  </tr>
			    </thead>
				 <tbody>
			';
$group_cache = getcache('grouplist','member');
foreach($group_cache as $_key=>$_value) {
if($_value['groupid']==1) continue;
;echo '		  		<tr>
				  <td>';echo $_value['name'];;echo '</td>
				  <td align="center"><input type="checkbox" name="priv_groupid[]"  ';echo $this->check_category_priv('visit',$_value['groupid'],0);;echo ' value="visit,';echo $_value['groupid'];;echo '" ></td>
				  <td align="center"><input type="checkbox" name="priv_groupid[]"  ';echo $this->check_category_priv('add',$_value['groupid'],0);;echo ' value="add,';echo $_value['groupid'];;echo '" ></td>
			  </tr>
			';};echo '			 </tbody>
			</table>
		</td>
      </tr>
	  <tr>
	   <th width="200">';echo L('apply_to_child');;echo '</th>
        <td><input type=\'radio\' name=\'priv_child\' value=\'1\'> ';echo L('yes');;echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=\'radio\' name=\'priv_child\' value=\'0\' checked> ';echo L('no');;echo '</td></td>
	  </tr>
</table>
</div>
<div id="div_setting_6" class="contentList pad-10 hidden">
<table width="100%" class="table_form">
<tr>
     <th width="200">';echo L('contribute_add_point');;echo '</th>
      <td><input name=\'setting[presentpoint]\' type=\'text\' value=\'';echo $setting['presentpoint'];;echo '\' size=\'5\' maxlength=\'5\' style=\'text-align:center\'> ';echo L('contribute_add_point_tips');;echo '</td>
</tr>
   <tr>
      <th >';echo L('default_readpoint');;echo '</th>
      <td><input name=\'setting[defaultchargepoint]\' type=\'text\' value=\'';echo $setting['defaultchargepoint'];;echo '\' size=\'4\' maxlength=\'4\' style=\'text-align:center\'> <select name="setting[paytype]"><option value="0" ';if(!$setting['paytype']) echo 'selected';;echo '>';echo L('readpoint');;echo '</option><option value="1" ';if($setting['paytype']) echo 'selected';;echo '>';echo L('money');;echo '</option></select> ';echo L('readpoint_tips');;echo '</td>
    </tr>
    <tr>
      <th>';echo L('repeatchargedays');;echo '</th>
      <td>
	    <input name=\'setting[repeatchargedays]\' type=\'text\' value=\'1\' size=\'4\' maxlength=\'4\' style=\'text-align:center\'> ';echo L('repeat_tips');;echo '&nbsp;&nbsp;
        <font color="red">';echo L('repeat_tips2');;echo '</font></td>
    </tr>
</table>   
</div>
 <div class="bk15"></div>
	<input name="catid" type="hidden" value="';echo $catid;;echo '">
    <input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="button">

</form>
</div>

</div>
<!--table_form_off-->
</div>

<script language="JavaScript">
<!--
	window.top.$(\'#display_center_id\').css(\'display\',\'none\');
	$(function(){
		var url = $(\'#url\').val();
		if(!url.match(/^http:\\/\\//)) $(\'#url\').val(\'\');
	})
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
		$.getJSON(\'?s=admin/category/public_tpl_file_list/style/\'+id+\'/catid/';echo $catid;echo '\', function(data){$(\'#category_template\').html(data.category_template);$(\'#list_template\').html(data.list_template);$(\'#show_template\').html(data.show_template);});
	}
	';if(isset($setting['template_list']) &&!empty($setting['template_list'])) echo "load_file_list('".$setting['template_list']."')";echo '//-->
</script>';?>