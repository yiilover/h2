<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_header = $show_validator = 1;
include $this->admin_tpl('header','admin');
;echo '<script type="text/javascript">
<!--
	$(document).ready(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:\'200\',height:\'50\'}, function(){this.close();$(obj).focus();})}});
		';if (is_array($html) &&$html['validator']){echo $html['validator'];unset($html['validator']);};echo '	})
//-->
</script>
<div class="pad-10">
<div class="col-tab">
<ul class="tabBut cu-li">
<li';if ($_GET['order']==1 ||!isset($_GET['order'])) {;echo ' class="on"';};echo '><a href="?s=content/push/init/classname/position_api/action/position_list/order/1/modelid/';echo $_GET['modelid'];echo '/catid/';echo $_GET['catid'];echo '/id/';echo $_GET['id'];echo '">';echo L('push_to_position');;echo '</a></li>
<li';if ($_GET['order']==2) {;echo ' class="on"';};echo '><a href="?s=content/push/init/module/special/action/_push_special/order/2/modelid/';echo $_GET['modelid'];echo '/catid/';echo $_GET['catid'];echo '/id/';echo $_GET['id'];echo '">';echo L('push_to_special');;echo '</a></li>
<li';if ($_GET['order']==3) {;echo ' class="on"';};echo '><a href="?s=content/push/init/module/content/classname/push_api/action/category_list/order/3/tpl/push_to_category/modelid/';echo $_GET['modelid'];echo '/catid/';echo $_GET['catid'];echo '/id/';echo $_GET['id'];echo '">';echo L('push_to_category');;echo '</a></li>
</ul>
<div class=\'content\' style="height:auto;">
<form action="?s=content/push/init/module/';echo $_GET['module'];echo '/action/';echo $_GET['action'];echo '" method="post" name="myform" id="myform"><input type="hidden" name="modelid" value="';echo $_GET['modelid'];echo '"><input type="hidden" name="catid" value="';echo $_GET['catid'];echo '">
<input type=\'hidden\' name="id" value=\'';echo $_GET['id'];echo '\'>
<table width="100%"  class="table_form">
  
  ';
if (isset($html) &&is_array($html)) {
foreach ($html as $k =>$v) {;echo '  	  <tr>
    <th width="80">';echo $v['name'];echo '£º</th>
    <td class="y-bg">';echo creat_form($k,$v);echo '</td>
  </tr>
  ';if ($v['ajax']['name']) {;echo '  	  <tr>
  	  	<th width="80">';echo $v['ajax']['name'];echo '£º</th>
  	  	<td class="y-bg" id="';echo $k;echo '_td"><input type="hidden" name="';echo $v['ajax']['id'];echo '" id="';echo $v['ajax']['id'];echo '"></td>
  	 </tr>
  ';};echo '
  ';}}else {echo $html;};echo '  </table>
<div class="bk15"></div>

<input type="hidden" name="return" value="';echo $return;echo '" />
<input type="submit" class="dialog" id="dosubmit" name="dosubmit" value="';echo L('submit');echo '" />
</form>
</div>
</div>
</div>
</body>
</html>';?>