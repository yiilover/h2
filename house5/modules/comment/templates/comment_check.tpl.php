<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad_10">
<div class="subnav">
  <h1 class="title-2">';echo L('comment_check');echo ' (';echo L('for_audit_several');echo '£º<span id="wait" style="color:red">';echo $total;echo '</span>)</h1>
</div>
</div>
<div class="pad-lr-10">
<div class="comment">
';if(is_array($comment_check_data)) foreach($comment_check_data as $v) :
$this->comment_data_db->table_name($v['tableid']);
$data = $this->comment_data_db->get_one(array('id'=>$v['comment_data_id'],'siteid'=>$this->get_siteid()));
;echo '<div  id="tbody_';echo $data['id'];echo '">
<h5 class="title fn" ><span class="rt"><input type="button" value="';echo L('pass');echo '" class="button" onclick="check(';echo $data['id'];echo ', 1, \'';echo $data['commentid'];echo '\')" /> <input  class="button"  type="button" value="';echo L('delete');echo '" onclick="check(';echo $data['id'];echo ', -1, \'';echo $data['commentid'];echo '\')" />
</span>';echo $data['username'];echo ' (';echo $data['ip'];echo ') ';echo L('chez');echo ' ';echo format::date($data['creat_at'],1);echo ' ';echo L('release');echo ' </h5>
    <div class="content">
    	<pre>';echo $data['content'];echo '</pre>
    </div>
    <div class="bk20 hr mb8"></div>
</div>
';endforeach;;echo '</div>
</div>
<script type="text/javascript">
window.top.$(\'#display_center_id\').css(\'display\',\'none\');
function check(id, type, commentid) {
	if(type == -1 && !confirm(\'';echo L('are_you_sure_you_want_to_delete');echo '\')) {
		return false;
	}
	$.get(\'?s=comment/check/ajax_checks/id/\'+id+\'/type/\'+type+\'/commentid/\'+commentid+\'/\'+Math.random(), function(data){if(data!=1){if(data==0){alert(\'';echo L('illegal_parameters');echo '\')}else{alert(data)}}else{$(\'#tbody_\'+id).remove();

	$.getJSON(\'?s=comment/check/public_get_one/\'+Math.random(), function(data){
		if (data) {
			$(\'#wait\').html(data.total);
			val = data.data;
			if (val.content) {
			html = \'<div id="tbody_\'+val.id+\'"><h5 class="title fn" ><span class="rt"><input type="button" value="';echo L('pass');echo '" class="button" onclick="check(\'+val.id+\', 1, \\\'\'+val.commentid+\'\\\')" /> <input  class="button"  type="button" value="';echo L('delete');echo '" onclick="check(\'+val.id+\', -1, \\\'\'+val.commentid+\'\\\')" /></span>\'+val.username+\' (\'+val.ip+\') ';echo L('chez');echo ' \'+val.creat_at+\' ';echo L('release');echo ' </h5><div class="content"><pre>\'+val.content+\'</pre></div><div class="bk20 hr mb8"></div></div>\';
			$(\'.comment\').append(html);
			}
		}
		});

	}});
	
}
</script>
</body>
</html>';?>