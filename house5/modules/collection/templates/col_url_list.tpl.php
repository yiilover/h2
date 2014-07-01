<?php
 defined('IN_ADMIN') or exit('No permission resources.');;echo '';include $this->admin_tpl('header','admin');;echo '<div class="pad-10">
<div class="col-tab">
<ul class="tabBut cu-li">
<li class="on" id="tab_1">';echo L('url_list');echo '</li>
</ul>
<div class="content pad-10" id="show_div_1" style="height:auto">
<b>';echo L('url_list');echo '</b>£º';echo $url_list;;echo '<br><br>
';echo L('in_all');echo '£º ';echo $total;echo ' ';echo L('all_count_msg');echo '£º';echo $re;;echo '';echo L('import_num_msg');echo '';echo $total-$re;;echo '<br><br>
';if (is_array($url))foreach ($url as $v):;echo '';echo $v['title'].'<br>'.$v['url'];;echo '<hr size="1" />
';endforeach;;echo '
';if ($total_page >$page) {
echo  "<script type='text/javascript'>location.href='?s=collection/node/col_url_list/page/".($page+1)."/nodeid/$nodeid/h5_hash/".$_SESSION['h5_hash']."'</script>";
}else {;echo '	<script type="text/javascript">
	window.top.art.dialog({id:\'test\'}).close();
	window.top.art.dialog({id:\'test\',content:\'<h2>';echo L('collection_success');echo '</h2><span style="fotn-size:16px;">';echo L('following_operation');echo '</span><br /><ul style="fotn-size:14px;"><li><a href="?s=collection/node/col_content/nodeid/';echo $nodeid;echo '/h5_hash/';echo $_SESSION['h5_hash'];echo '" target="right"  onclick="window.top.art.dialog({id:\\\'test\\\'}).close()">';echo L('following_operation_1');echo '</a></li><li><a href="?s=collection/node/manage/menuid/957/h5_hash/';echo $_SESSION['h5_hash'];echo '" target="right" onclick="window.top.art.dialog({id:\\\'test\\\'}).close()">';echo L('following_operation_2');echo '</a></li></ul>\',width:\'400\',height:\'200\'});
	
	</script>
';};echo '</div>
</div>
</div>
</body>
</html>';?>