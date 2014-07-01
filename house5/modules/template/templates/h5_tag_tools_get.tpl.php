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
    <th width="80">SQL£º</th>
    <td class="y-bg"><textarea name="sql" id="sql" style="width:386px;height:178px;">';echo $_GET['sql'];echo '</textarea></td>
  </tr>
   <tr>
    <th width="80">';echo L('dbsource');echo '£º</th>
    <td class="y-bg">';echo form::select($dbsource_list,$_GET['dbsource'],'name="dbsource" id="dbsource"');echo '</td>
  </tr>
     <tr>
    <th width="80">';echo L("check");echo '£º</th>
    <td class="y-bg"><input type="text" name="return" id="return" size="30" value="';echo $_GET['return'];echo '" /> </td>
  </tr>
   <tr>
    <th width="80">';echo L("buffer_time");echo '£º</th>
    <td class="y-bg"><input type="text" name="cache" id="cache" size="30" value="';echo $_GET['cache'];echo '" /> </td>
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
		$("#sql").formValidator({onshow:"';echo L("input").'SQL';echo '",onfocus:"';echo L("input").'SQL';echo '"}).inputValidator({min:1,onerror:"';echo L("input").'SQL';echo '"});
		$("#dbsource").formValidator({onshow:"';echo L("input").L("dbsource");echo '",onfocus:"';echo L("input").L("dbsource");echo '"});
		$("#cache").formValidator({onshow:"';echo L("enter_the_cache_input_will_not_be_cached");echo '",onfocus:"';echo L("enter_the_cache_input_will_not_be_cached");echo '",empty:true}).regexValidator({regexp:"num1",datatype:\'enum\',param:\'i\',onerror:"';echo L("cache_time_can_only_be_positive");echo '"});
		$("#num").formValidator({onshow:"';echo L('input').L("num");echo '",onfocus:"';echo L('input').L("num");echo '",empty:true}).regexValidator({regexp:"num1",datatype:\'enum\',param:\'i\',onerror:"';echo L('that_shows_only_positive_numbers');echo '"});
	})
//-->
</script>
</body>
</html>';?>