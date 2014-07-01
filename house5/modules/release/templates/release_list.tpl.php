<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="bk15"></div>
<link href="';echo CSS_PATH;echo 'progress_bar.css" rel="stylesheet" type="text/css" />
<div class="pad-lr-10">
<div id="msg">';echo L("peed_your_server");echo '</div>
';
$i = 0;
foreach ($this->point as $v) :
$r = $this->db->get_one(array('id'=>$v),'name');
echo '<b>'.$r['name'].'</b><span class="progress_status" id="status_'.$i.'"><img src="'.IMG_PATH.'msg_img/loading.gif"> '.L("are_release_ing").' </span>';
;echo '<div class="progress_bar"><div id="progress_bar_';echo $i;echo '" class="p_bar"></div></div>
<iframe id="iframe_';echo $i;echo '" src="" width="0" height="0"></iframe>
<script type="text/javascript">$(function(){setTimeout("iframe(';echo $i;echo ', \'?s=release/index/public_sync&id=';echo $i;echo '&ids=';echo $ids;echo '&statuses=';echo $statuses;echo '\')", 1000)})</script>
<br>
';$i++;endforeach;;echo '<h5>';echo L("remind");echo '</h5>
<ul>
<li>';echo L("remind_message");echo '</li>
</ul>
</div>

<script type="text/javascript">
<!--
window.top.$(\'#display_center_id\').css(\'display\',\'none\');
function progress(id, val) {
	var width = $(\'#progress_bar_\'+id).parent(\'div\').width();
	var block = width/100*val;
	$(\'#progress_bar_\'+id).width(block);
}
function iframe(id, url) {
	$(\'#iframe_\'+id).attr(\'src\', url);
}
//-->
</script>
</body>
</html>';?>