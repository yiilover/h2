<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript"> 
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#name").formValidator({onshow:"';echo L('input').L('name');echo '",onfocus:"';echo L('input').L('name');echo '"}).inputValidator({min:1,onerror:"';echo L('input').L('name');echo '"}).ajaxValidator({type : "get",url : "",data :"s=ssi/ssi/public_name",datatype : "html",async:\'false\',success : function(data){	if( data == "1" ){return true;}else{return false;}},buttons: $("#dosubmit"),onerror : "';echo L('name').L('exists');echo '",onwait : "';echo L('connecting');echo '"});
		$("#cache").formValidator({onshow:"';echo L("enter_the_cache_input_will_not_be_cached");echo '",onfocus:"';echo L("enter_the_cache_input_will_not_be_cached");echo '",empty:false}).regexValidator({regexp:"num1",datatype:\'enum\',param:\'i\',onerror:"';echo L("cache_time_can_only_be_positive");echo '"});
	})
//-->
</script>

<div class="pad-10">
  <form action="?s=ssi/ssi/edit/id/';echo $id;echo '" method="post" id="myform">
    <div>
<fieldset>
	<legend>';echo L('ssi_call_setting');echo '</legend>
	<table width="100%"  class="table_form">
      <tr>
            <th valign="top">';echo L('block').L('name');echo '£º</th>
            <td class="y-bg"><input type="text" name="name" size="25" id="name" value="';echo $data['name'];;echo '"><script type="text/javascript">$(function(){$("#name").formValidator({onshow:"';echo L('please_input_block_name');echo '",onfocus:"';echo L('please_input_block_name');echo '"}).inputValidator({min:1, onerror:\'';echo L('please_input_block_name');echo '\'});});</script></td>
      </tr>

      <tr>
            <th valign="top">';echo L('block').L('display_position');echo '£º</th>
            <td class="y-bg"><input type="text" name="tag" size="25" id="tag" value="';echo $data['tag'];;echo '"></td>
      </tr>

    <tr>
		<th valign="top">';echo L('custom_sql');echo '£º</th>
		<td class="y-bg"><textarea name="data" id="data" style="width:386px;height:178px;">';echo $data['data'];;echo '</textarea></td>
  </tr>


	<tr>
		<th width="80">';echo L('cache_times');echo '£º</th>
		<td class="y-bg"><input type="text" name="cache" id="cache" size="30" value="';echo $data['cache'];;echo '" /></td>
	</tr>

</table>
</fieldset>
      <div class="bk15"></div>
      <input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="" />
    </div>
  </form>
</div>
</body></html>';?>