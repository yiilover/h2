<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');;echo '<form method="post" action="?s=search/search_admin/setting">
<div class="pad_10">

<div class="col-tab">
<ul class="tabBut cu-li">
            <li id="tab_setting_1" class="on" onclick="SwapTab(\'setting\',\'on\',\'\',2,1);">';echo L('basic_setting');echo '</li>
            <li id="tab_setting_2" onclick="SwapTab(\'setting\',\'on\',\'\',2,2);">';echo L('sphinx_setting');echo '</li>
</ul>
<div id="div_setting_1" class="contentList pad-10">
<table width="100%"  class="table_form">
  <tr>
    <th width="200">';echo L('enable_search');echo '</th>
    <td class="y-bg">
    <input type=\'radio\' name=\'setting[fulltextenble]\' value=\'1\' ';if($fulltextenble == 1) {;echo 'checked';};echo '> ';echo L('yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=\'radio\' name=\'setting[fulltextenble]\' value=\'0\' ';if($fulltextenble == 0) {;echo 'checked';};echo '> ';echo L('no');echo '</td>
  </tr> 
  <tr>
    <th width="200">';echo L('relationenble');echo '</th>
    <td class="y-bg">
    <input type=\'radio\' name=\'setting[relationenble]\' value=\'1\' ';if($relationenble == 1) {;echo 'checked';};echo '> ';echo L('yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=\'radio\' name=\'setting[relationenble]\' value=\'0\' ';if($relationenble == 0) {;echo 'checked';};echo '> ';echo L('no');echo '  ';echo L('relationenble_note');echo '</td>
  </tr> 
  <tr>
    <th width="200">';echo L('suggestenable');echo '</th>
    <td class="y-bg">
    <input type=\'radio\' name=\'setting[suggestenable]\' value=\'1\' ';if($suggestenable == 1) {;echo 'checked';};echo '> ';echo L('yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type=\'radio\' name=\'setting[suggestenable]\' value=\'0\' ';if($suggestenable == 0) {;echo 'checked';};echo '> ';echo L('no');echo '  ';echo L('suggestenable_note');echo '</td>
	 
  </tr> 
</table>
</div>

<div id="div_setting_2" class="contentList pad-10 hidden">
	<table width="100%"  class="table_form">
  <tr>
    <th width="200">';echo L('sphinxenable');echo '</th>
    <td class="y-bg">
	<input type=\'radio\' name=\'setting[sphinxenable]\' value=\'1\' ';if($sphinxenable == 1) {;echo 'checked';};echo '> ';echo L('yes');echo '&nbsp;&nbsp;&nbsp;&nbsp;
	<input type=\'radio\' name=\'setting[sphinxenable]\' value=\'0\' ';if($sphinxenable == 0) {;echo 'checked';};echo '> ';echo L('no');echo '	  </td>
  </tr>
  <tr>
    <th>';echo L('host');echo '</th>
    <td class="y-bg">
	  <input name="setting[sphinxhost]" id="sphinxhost" value="';echo $sphinxhost;echo '" type="text" class="input-text"></td>
  </tr> 
  <tr>
    <th>';echo L('port');echo '</th>
    <td class="y-bg"><input name="setting[sphinxport]" id="sphinxport" value="';echo $sphinxport;echo '" type="text" class="input-text"></td>
  </tr>
  <tr>
    <th></th>
    <td class="y-bg"><input name="button" type="button" value="';echo L('test');echo '" class="button" onclick="test_sphinx()"> <span id=\'testing\'></span></td>
  </tr>
</table>
</div>
<div class="bk15"></div>
<input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="button">
</div>
 
</form>
</body>
<script type="text/javascript"> 
 
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
 
function showsmtp(obj,hiddenid){
	hiddenid = hiddenid ? hiddenid : \'smtpcfg\';
	var status = $(obj).val();
	if(status == 1) $("#"+hiddenid).show();
	else  $("#"+hiddenid).hide();
}
function test_sphinx() {
	$(\'#testing\').html(\'';echo L('testing');echo '\');
    $.post(\'?s=search/search_admin/public_test_sphinx\',{sphinxhost:$(\'#sphinxhost\').val(),sphinxport:$(\'#sphinxport\').val()}, function(data){
		message = \'\';
		if(data == 1) {
			message = \'';echo L('testsuccess');echo '\';
		} else if(data == -1) {
			message = \'';echo L('hostempty');echo '\';
		} else if(data == -2) {
			message = \'';echo L('portempty');echo '\';
		} else {
			message = data;
		}
		$(\'#testing\').html(message);
		//window.top.art.dialog({content:message,lock:true,width:\'200\',height:\'50\'},function(){});
	});
}
 
</script>

</html>';?>