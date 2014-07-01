<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<script type="text/javascript"> 
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#catname").formValidator({onshow:"';echo L('input_catname');;echo '",onfocus:"';echo L('input_catname');;echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L('input_catname');;echo '"})';if(ROUTE_A=='edit') echo '.defaultPassed()';;echo ';
		$("#url").formValidator({onshow:"';echo L('input_linkurl');;echo '",onfocus:"';echo L('input_linkurl');;echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L('input_linkurl');;echo '"})';if(ROUTE_A=='edit') echo '.defaultPassed()';;echo ';
	})
//-->
</script>

<form name="myform" id="myform" action="?s=admin/category/';echo ROUTE_A;;echo '" method="post">
<div class="pad-10">
<div class="col-tab">

<ul class="tabBut cu-li">
            <li id="tab_setting_1" class="on" onclick="SwapTab(\'setting\',\'on\',\'\',1,1);">';echo L('catgory_basic');;echo '</li>
</ul>
<div id="div_setting_1" class="contentList pad-10">

<table width="100%" class="table_form ">
	<tr>
        <th width="200">';echo L('parent_category');echo '£º</th>
        <td>
		';echo form::select_category('category_content_'.$this->siteid,$parentid,'name="info[parentid]"',L('please_select_parent_category'),0,-1);;echo '		</td>
      </tr>
      <tr>
        <th>';echo L('catname');echo '£º</th>
        <td><input type="text" name="info[catname]" id="catname" class="input-text" value="';echo $catname;;echo '"></td>
      </tr>

	<tr>
        <th>';echo L('catgory_img');echo '£º</th>
        <td>';echo form::images('info[image]','image',$image,'content');;echo '</td>
      </tr>
		<tr>
        <th>';echo L('link_url');echo '£º</th>
        <td><input type="text" name="info[url]" id="url" size="50" class="input-text" value="';echo $url;;echo '"></td>
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

//-->
</script>';?>