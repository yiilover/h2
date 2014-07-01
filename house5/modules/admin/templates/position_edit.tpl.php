<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#name").formValidator({onshow:"';echo L('input').L('posid_name');echo '",onfocus:"';echo L('posid_name').L('not_empty');echo '"}).inputValidator({min:1,max:999,onerror:"';echo L('posid_name').L('not_empty');echo '"});
	$("#maxnum").formValidator({onshow:"';echo L('input').L('maxnum');echo '",onfocus:"';echo L('maxnum').L('not_empty');echo '"}).inputValidator({min:1,onerror:"';echo L('maxnum').L('not_empty');echo '"}).regexValidator({datatype:\'enum\',regexp:\'intege1\',onerror:\'';echo L('maxnum').L('not_empty');echo '\'}).defaultPassed();;		
})
//-->
</script>
<div class="pad_10">
<div class="common-form">
<form name="myform" action="?s=admin/position/edit" method="post" id="myform">
<input type="hidden" name="posid" value="';echo $posid;echo '"></input>
<table width="100%" class="table_form">
<tr>
<td  width="80">';echo L('posid_name');echo '</td> 
<td><input type="text" name="info[name]" class="input-text" value="';echo $name;echo '" id="name"></input></td>
</tr>
<tr>
<td>';echo L('posid_modelid');echo '</td> 
<td>';echo form::select($modelinfo,$modelid,'name="info[modelid]" onchange="category_load(this);"',L('choose_model'));;echo '</td>
</tr>
<tr>
<td>';echo L('posid_catid');echo '</td> 
<td id="load_catid">';echo form::select_category('',$catid,'name="info[catid]"',L('please_select_parent_category'));;echo '</td>
</tr>

<tr>
<td>';echo L('listorder');echo '</td> 
<td><input type="text" name="info[listorder]" class="input-text" size="5" value="';echo $listorder;echo '"></input></td>
</tr> 
<tr>
<td>';echo L('maxnum');echo '</td> 
<td><input type="text" name="info[maxnum]" id="maxnum" class="input-text" size="5" value="';echo $maxnum;echo '"></input>';echo L('posid_num');echo '</td>
</tr> 
<tr>
<td>';echo L('extention_name');echo '</td> 
<td><input type="text" name="info[extention]" id="extention" class="input-text" size="30" value="';echo $extention;echo '"></input></td>
</tr> 
</table>

    <div class="bk15"></div>
    <input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="dialog" id="dosubmit">
</form>
<div class="explain-col">
';echo L('position_tips');echo '<br/>
';echo L('extention_name_tips');echo '</div>
</div>
</div>
</body>
</html>
<script type="text/javascript">
function category_load(obj)
{
	var modelid = $(obj).attr(\'value\');
	$.get(\'?s=admin/position/public_category_load/modelid/\'+modelid,function(data){
			$(\'#load_catid\').html(data);
		  });
}
</script>


';?>