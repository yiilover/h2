<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10">

 <div class="comment_button"><a href="?s=comment/comment_admin/lists/show_center_id/1/commentid/';echo $commentid;echo '/hot/0"';if (empty($hot)) {;echo ' class="on"';};echo '>最新</a> <a href="?s=comment/comment_admin/lists/show_center_id/1/commentid/';echo $commentid;echo '/hot/1"';if ($hot==1) {;echo ' class="on"';};echo '>最热</a></div> 	
 <div class="btn"><label for="check_box">';echo L('select_all');echo '/';echo L('cancel');echo '</label></div>
 
 <form action="?" method="get">
 <input type="hidden" name="s" value="comment/check/ajax_checks">
    <input type="hidden" name="type" value="-1">
    <input type="hidden" name="form" value="1">
    <input type="hidden" name="commentid" value="';echo $commentid;echo '">
<div class="comment">
';if(is_array($list)) foreach($list as $v) :
;echo '<div  id="tbody_';echo $v['id'];echo '">
<h5 class="title fn" ><span class="rt"><input  class="button"  type="button" value="';echo L('delete');echo '" onclick="check(';echo $v['id'];echo ', -1, \'';echo $v['commentid'];echo '\')" />
</span><input type="checkbox" name="id[]" value="';echo $v['id'];echo '">';echo direction($v['direction']);echo ' ';echo $v['username'];echo ' (';echo $v['ip'];echo ') ';echo L('chez');echo ' ';echo format::date($v['creat_at'],1);echo ' ';echo L('release');echo ' ';echo L('support');echo '：';echo $v['support'];echo '</h5>
    <div class="content">
    	<pre>';echo $v['content'];echo '</pre>
    </div>
    <div class="bk20 hr mb8"></div>
</div>
';endforeach;;echo '</div>
 <div class="btn"><label for="check_box"><input type="checkbox"  onclick="selectall(\'id[]\');" id="check_box" style="width:0px;height: 0px;" />';echo L('select_all');echo '/';echo L('cancel');echo '</label> <input type="submit" onclick="return confirm(\'';echo L('are_you_sure_you_want_to_delete');echo '\')" class="button" value="';echo L('delete');echo '" /></div>
 </form>
<div id="pages">';echo $pages;;echo '</div>
</div>
<script type="text/javascript">
';if(!isset($_GET['show_center_id'])) {;echo ' window.top.$(\'#display_center_id\').css(\'display\',\'none\');';};echo 'function check(id, type, commentid) {
	if(type == -1 && !confirm(\'';echo L('are_you_sure_you_want_to_delete');echo '\')) {
		return false;
	}
	$.get(\'?s=comment/check/ajax_checks/id/\'+id+\'/type/\'+type+\'/commentid/\'+commentid+\'/\'+Math.random(), function(data){if(data!=1){if(data==0){alert(\'';echo L('illegal_parameters');echo '\')}else{alert(data)}}else{$(\'#tbody_\'+id).remove();}});
}
</script>
</body>
</html>';?>