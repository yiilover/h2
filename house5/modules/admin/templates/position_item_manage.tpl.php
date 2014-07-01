<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#title").formValidator({onshow:"';echo L('input').L('posid_title');echo '",onfocus:"';echo L('posid_title').L('not_empty');echo '"}).inputValidator({min:1,max:999,onerror:"';echo L('posid_title').L('not_empty');echo '"});
	$("#url").formValidator({onshow:"';echo L('input').L('posid_url');echo '",onfocus:"';echo L('posid_url').L('not_empty');echo '"}).inputValidator({min:1,max:999,onerror:"';echo L('posid_url').L('not_empty');echo '"});	
})
//-->
</script>
<div class="pad_10">
<div class="common-form">
<form name="myform" action="?s=admin/position/public_item_manage" method="post" id="myform">
<input type="hidden" name="posid" value="';echo $posid;echo '"></input>
<input type="hidden" name="modelid" value="';echo $modelid;echo '"></input>
<input type="hidden" name="id" value="';echo $id;echo '"></input>
<table width="100%" class="table_form">
<tr>
<td  width="100">';echo L('posid_title');echo '</td> 
<td><input type="text" name="info[title]" class="input-text" value="';echo $title;echo '" id="title" size="40"></input></td>
</tr>
<tr>
<td>';echo L('posid_thumb');echo '</td> 
<td>';echo form::images('info[thumb]','thumb',$thumb,'content');echo ' </td>
</tr>
<tr>
<td>';echo L('posid_inputtime');echo '</td> 
<td>';echo form::date('info[inputtime]',date('Y-m-d h:i:s',$inputtime),1);echo '</td>
</tr>

<tr>
<td>';echo L('posid_desc');echo '</td> 
<td>
<textarea name="info[description]" rows="2" cols="20" id="description" class="inputtext" style="height:100px;width:300px;">';echo $description;echo '</textarea>
</td>
</tr>
<tr>
<td>';echo L('posid_syn');echo '</td> 
<td>
<input name="synedit"  value="0" type="radio" ';echo $synedit==0 ?'checked="checked"': '';echo '> ';echo L('enable');echo '<input name="synedit" value="1" type="radio" ';echo $synedit==1 ?'checked="checked"': '';echo '> ';echo L('close');echo '        
</td>
</tr>

</table>

    <div class="bk15"></div>
    <input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="dialog" id="dosubmit">
</form>
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