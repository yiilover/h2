<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<div class="pad-10">
<div class="col-tab">
<ul class="tabBut cu-li">
<li class="on" id="tab_1">';echo L('url_list');echo '</li>
</ul>
<div class="content pad-10" id="show_div_1" style="height:auto">
';foreach ($url as $key=>$val):;echo '';echo $val['title'];echo '<br>
<div style="float:right"><a href="javascript:void(0)" onclick="show_content(\'';echo urlencode($val['url']);echo '\')"><span>';echo L('view');echo '</span></a></div>';echo $val['url'];echo '<hr size="1" />
';endforeach;;echo '</div>
</div>
</div>
<script type="text/javascript"> 
<!--
function show_content(url) {
	art.dialog({id:\'test\',content:\'';echo L('loading');echo '\',width:\'100\',height:\'30\', lock:true});
	$.get("?s=collection/node/public_test_content/nodeid/';echo $nodeid;echo '&url="+url+\'&h5_hash=';echo $_SESSION['h5_hash'];echo '\', function(data){art.dialog({id:\'test\'}).close();
	art.dialog({title:\'';echo L('content_view');echo '\',id:\'test\',content:\'<textarea rows="26" cols="90">\'+data+\'</textarea>\',width:\'500\',height:\'400\', lock:false});});
	
}
window.top.$(\'#display_center_id\').css(\'display\',\'none\');
//-->
</script>

</body>
</html>';?>