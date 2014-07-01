<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');;echo '<form action="?s=admin/plugin/config" method="post" id="myform">
<div class="pad-10">
<div class="col-tab">
<ul class="tabBut cu-li">
	 		';foreach($plugin_menus as $_num =>$menu) {;echo '            <li ';if($menu['status']) {;echo 'class="on"';};echo ' ';if($menu['extend']) {;echo 'onclick="loadfile(\'';echo$menu['url'] ;echo '\')"';};echo ' >';echo $menu['name'];echo '</li>
            ';};echo '</ul>
<div id="tab-content">
<div class="contentList pad-10">
<h3>';echo $name;echo '</h3>
';echo $description;echo '<br/>
</div>
';if($form) {;echo '<div class="contentList pad-10 hidden">
	<table width="100%"  class="table_form">
';echo $form;echo '</table>
<div class="bk15"></div>
<input name="pluginid" type="hidden" value="';echo $pluginid;echo '">
<input name="dosubmit" type="submit" value="';echo L('submit');echo '" class="button">
</div>
';};echo '';if(is_array($mods)) {foreach ($mods as $m) {;echo '<div class="contentList pad-10 hidden" id="';echo $m;echo '">

</div>
';}};echo '</div>
</div>
</div>
</form>
</body>
<script type="text/javascript">
function SwapTab(name,title,content,Sub,cur){
	  $(name+\' \'+title).click(function(){
		  $(this).addClass(cur).siblings().removeClass(cur);
		  $(content+" > "+Sub).eq($(name+\' \'+title).index(this)).show().siblings().hide();
	  });
	}
function loadfile(data) {
	$("#"+data).load(\'?s=admin/plugin/config/pluginid/';echo $pluginid;echo '/module/\'+data
	+\'/h5_hash/';echo $_SESSION['h5_hash'];echo '\');
}
new SwapTab(".tabBut","li","#tab-content",".contentList","on");//≈≈––TAB	
</script>
</html>';?>