<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '
<div class="pad-10">
<form action="?s=template/file/edit_h5_tag&style=';echo $this->style;echo '&dir=';echo $dir;echo '&file=';echo urlencode($file);echo '&op=';echo $op;echo '&tag_md5=';echo $_GET['tag_md5'];echo '" method="post" id="myform">
	<table width="100%"  class="table_form">
	  <tr>
    <th width="80">';echo L("toolbox_type");echo '£º</th>
    <td class="y-bg">';echo $op;echo '</td>
  </tr>
    <tr>
    <th width="80">';echo L("data_address");echo '£º</th>
    <td class="y-bg"><input type="text" name="url" id="url" size="30" value="';echo $_GET['url'];echo '" /></td>
  </tr>
     <tr>
    <th width="80">';echo L("check");echo '£º</th>
    <td class="y-bg"><input type="text" name="return" id="return" size="30" value="';echo $_GET['return'];echo '" /> </td>
  </tr>
   <tr>
    <th width="80">';echo L("buffer_time");echo '£º</th>
    <td class="y-bg"><input type="text" name="cache" id="cache" size="30" value="';echo $_GET['cache'];echo '" /> ';echo L("unit_second");echo '</td>
  </tr>
</table>
<div class="bk15"></div>
<input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="';echo L('submit');echo '" />

</form>
</div>
<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		$("#url").formValidator({onshow:"';echo L("input").L("data_address");echo '",onfocus:"';echo L("input").L("data_address");echo '"}).inputValidator({min:1,onerror:"';echo L("input").L("data_address");echo '"}).regexValidator({regexp:"^http:\\/\\/(.*)",param:\'i\',onerror:"';echo L('data_address_reg_sg');echo '"});
		$("#cache").formValidator({onshow:"';echo L("input").L('buffer_time');echo '",onfocus:"';echo L("input").L('buffer_time');echo '"}).regexValidator({regexp:"num1",datatype:\'enum\',param:\'i\',onerror:"';echo L('cache_time_can_only_be_positive');echo '"});
	})
//-->
</script>
</body>
</html>';?>