<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '';if(ROUTE_A=='init') {;echo '<form name="myform" action="?s=admin/menu/listorder" method="post">
<div class="pad-lr-10">
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="80">';echo L('listorder');;echo '</th>
            <th width="100">id</th>
            <th>';echo L('menu_name');;echo '</th>
			<th>';echo L('operations_manage');;echo '</th>
            </tr>
        </thead>
	<tbody>
    ';echo $categorys;;echo '	</tbody>
    </table>
  
    <div class="btn"><input type="submit" class="button" name="dosubmit" value="';echo L('listorder');echo '" /></div>  </div>
</div>
</div>
</form>
</body>
</html>


';}elseif(ROUTE_A=='add') {;echo '<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#language").formValidator({onshow:"';echo L("input").L('chinese_name');echo '",onfocus:"';echo L("input").L('chinese_name');echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('chinese_name');echo '"});
		$("#name").formValidator({onshow:"';echo L("input").L('menu_name');echo '",onfocus:"';echo L("input").L('menu_name');echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('menu_name');echo '"});
		$("#m").formValidator({onshow:"';echo L("input").L('module_name');echo '",onfocus:"';echo L("input").L('module_name');echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('module_name');echo '"});
		$("#c").formValidator({onshow:"';echo L("input").L('file_name');echo '",onfocus:"';echo L("input").L('file_name');echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('file_name');echo '"});
		$("#a").formValidator({tipid:\'a_tip\',onshow:"';echo L("input").L('action_name');echo '",onfocus:"';echo L("input").L('action_name');echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('action_name');echo '"});
	})
//-->
</script>
<div class="common-form">
<form name="myform" id="myform" action="?s=admin/menu/add" method="post">
<table width="100%" class="table_form contentWrap">
      <tr>
        <th width="200">';echo L('menu_parentid');echo '£º</th>
        <td><select name="info[parentid]" >
        <option value="0">';echo L('no_parent_menu');echo '</option>
';echo $select_categorys;;echo '</select></td>
      </tr>
      <tr>
        <th > ';echo L('chinese_name');echo '£º</th>
        <td><input type="text" name="language" id="language" class="input-text" ></td>
      </tr>
      <tr>
        <th>';echo L('menu_name');echo '£º</th>
        <td><input type="text" name="info[name]" id="name" class="input-text" ></td>
      </tr>
	<tr>
        <th>';echo L('module_name');echo '£º</th>
        <td><input type="text" name="info[m]" id="m" class="input-text" ></td>
      </tr>
	<tr>
        <th>';echo L('file_name');echo '£º</th>
        <td><input type="text" name="info[c]" id="c" class="input-text" ></td>
      </tr>
	<tr>
        <th>';echo L('action_name');echo '£º</th>
        <td><input type="text" name="info[a]" id="a" class="input-text" > <span id="a_tip"></span>';echo L('ajax_tip');echo '</td>
      </tr>
	<tr>
        <th>';echo L('att_data');echo '£º</th>
        <td><input type="text" name="info[data]" class="input-text" ></td>
      </tr>
	<tr>
        <th>';echo L('menu_display');echo '£º</th>
        <td><input type="radio" name="info[display]" value="1" checked> ';echo L('yes');echo '<input type="radio" name="info[display]" value="0"> ';echo L('no');echo '</td>
      </tr>
</table>
<!--table_form_off-->
</div>
    <div class="bk15"></div>
	<div class="btn"><input type="submit" id="dosubmit" class="button" name="dosubmit" value="';echo L('submit');echo '"/></div>
</div>

</form>

';}elseif(ROUTE_A=='edit') {;echo '<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#language").formValidator({onshow:"';echo L("input").L('chinese_name');echo '",onfocus:"';echo L("input").L('chinese_name');echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('chinese_name');echo '"});
		$("#name").formValidator({onshow:"';echo L("input").L('menu_name');echo '",onfocus:"';echo L("input").L('menu_name');echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('menu_name');echo '"});
		$("#m").formValidator({onshow:"';echo L("input").L('module_name');echo '",onfocus:"';echo L("input").L('module_name');echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('module_name');echo '"});
		$("#c").formValidator({onshow:"';echo L("input").L('file_name');echo '",onfocus:"';echo L("input").L('file_name');echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('file_name');echo '"});
		$("#a").formValidator({tipid:\'a_tip\',onshow:"';echo L("input").L('action_name');echo '",onfocus:"';echo L("input").L('action_name');echo '",oncorrect:"';echo L('input_right');;echo '"}).inputValidator({min:1,onerror:"';echo L("input").L('action_name');echo '"});
	})
//-->
</script>
<div class="common-form">
<form name="myform" id="myform" action="?s=admin/menu/edit" method="post">
<table width="100%" class="table_form contentWrap">
      <tr>
        <th width="200">';echo L('menu_parentid');echo '£º</th>
        <td><select name="info[parentid]" style="width:200px;">
 <option value="0">';echo L('no_parent_menu');echo '</option>
';echo $select_categorys;;echo '</select></td>
      </tr>
      <tr>
        <th> ';echo L('for_chinese_lan');echo '£º</th>
        <td><input type="text" name="language" id="language" class="input-text" value="';echo L($name,'','',1);echo '"></td>
      </tr>
      <tr>
        <th>';echo L('menu_name');echo '£º</th>
        <td><input type="text" name="info[name]" id="name" class="input-text" value="';echo $name;echo '"></td>
      </tr>
	<tr>
        <th>';echo L('module_name');echo '£º</th>
        <td><input type="text" name="info[m]" id="m" class="input-text" value="';echo $m;echo '"></td>
      </tr>
	<tr>
        <th>';echo L('file_name');echo '£º</th>
        <td><input type="text" name="info[c]" id="c" class="input-text" value="';echo $c;echo '"></td>
      </tr>
	<tr>
        <th>';echo L('action_name');echo '£º</th>
        <td><input type="text" name="info[a]" id="a" class="input-text" value="';echo $a;echo '">  <span id="a_tip"></span>';echo L('ajax_tip');echo '</td>
      </tr>
	<tr>
        <th>';echo L('att_data');echo '£º</th>
        <td><input type="text" name="info[data]" class="input-text" value="';echo $data;echo '"></td>
      </tr>
	<tr>
        <th>';echo L('menu_display');echo '£º</th>
        <td><input type="radio" name="info[display]" value="1" ';if($display) echo 'checked';;echo '> ';echo L('yes');echo '<input type="radio" name="info[display]" value="0" ';if(!$display) echo 'checked';;echo '> ';echo L('no');echo '</td>
      </tr>

</table>
<!--table_form_off-->
</div>
    <div class="bk15"></div>
	<input name="id" type="hidden" value="';echo $id;echo '">
    <div class="btn"><input type="submit" id="dosubmit" class="button" name="dosubmit" value="';echo L('submit');echo '"/></div>
</div>

</form>
';};echo '</body>
</html>';?>