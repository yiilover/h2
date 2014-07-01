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
';if(is_array($reviews_check_data)) foreach($reviews_check_data as $v) :
$this->reviews_data_db->table_name($v['tableid']);
$data = $this->reviews_data_db->get_one(array('id'=>$v['reviews_data_id'],'siteid'=>$this->get_siteid()));
;echo '<div  id="tbody_';echo $data['id'];echo '">
<h5 class="title fn" ><span class="rt"><input type="button" value="';echo L('pass');echo '" class="button" onclick="check(';echo $data['id'];echo ', 1, \'';echo $data['reviewsid'];echo '\')" /> <input  class="button"  type="button" value="';echo L('delete');echo '" onclick="check(';echo $data['id'];echo ', -1, \'';echo $data['reviewsid'];echo '\')" />
</span>';echo $data['username'];echo ' (';echo $data['ip'];echo ') ';echo L('chez');echo ' ';echo format::date($data['creat_at'],1);echo ' ';echo L('release');echo ' </h5>
';if (!empty($v['content'])) {;echo '    <div class="content">
    	<pre>';echo $data['content'];echo '</pre>
    </div>
';};echo '      
    ';
include HOUSE5_PATH.'star_config.php';
$star_type = $data['startype'];
$star_li = explode('|',$star_config[$star_type]['star_name']);
$star_img = explode('|',$star_config[$star_type]['star_images']);
$star_n = 0;
;echo '    <div id="star_show">
        ';$star_n=0;echo '        ';$n=1;if(is_array($star_li)) foreach($star_li AS $star_code) {;echo '        ';$star_n++;$star_code = explode('$$',$star_code);;echo '        <b>';echo $star_code['0'];;echo '£º</b>
        ';$starnus='star'.$star_n;echo '          ';for($star_nn=1;$star_nn <= $data[$starnum];$star_nn++){;echo '          <img alt="';echo $r[$starnum];;echo '·Ö" src="';echo $star_img['1'];;echo '" />
          ';};echo '          ';for($star_nn=1;$star_nn <= (5-$data[$starnum]);$star_nn++){;echo '          <img alt="';echo $r[$starnum];;echo '·Ö" src="';echo $star_img['0'];;echo '" />
          ';};echo '        ';$n++;}unset($n);;echo '    </div>
    <div class="bk20 hr mb8"></div>
</div>
';endforeach;;echo '</div>
</div>
<script type="text/javascript">
window.top.$(\'#display_center_id\').css(\'display\',\'none\');
function check(id, type, reviewsid) {
	if(type == -1 && !confirm(\'';echo L('are_you_sure_you_want_to_delete');echo '\')) {
		return false;
	}
	$.get(\'?s=reviews/check/ajax_checks&id=\'+id+\'&type=\'+type+\'&reviewsid=\'+reviewsid+\'&\'+Math.random(), function(data){if(data!=1){if(data==0){alert(\'';echo L('illegal_parameters');echo '\')}else{alert(data)}}else{$(\'#tbody_\'+id).remove();

	$.getJSON(\'?s=reviews/check/public_get_one&\'+Math.random(), function(data){
		if (data) {
			$(\'#wait\').html(data.total);
			val = data.data;
			if (val.content) {
			html = \'<div id="tbody_\'+val.id+\'"><h5 class="title fn" ><span class="rt"><input type="button" value="';echo L('pass');echo '" class="button" onclick="check(\'+val.id+\', 1, \\\'\'+val.reviewsid+\'\\\')" /> <input  class="button"  type="button" value="';echo L('delete');echo '" onclick="check(\'+val.id+\', -1, \\\'\'+val.reviewsid+\'\\\')" /></span>\'+val.username+\' (\'+val.ip+\') ';echo L('chez');echo ' \'+val.creat_at+\' ';echo L('release');echo ' </h5><div class="content"><pre>\'+val.content+\'</pre></div><div class="bk20 hr mb8"></div></div>\';
			$(\'.comment\').append(html);
			}
		}
		});

	}});
	
}
</script>
</body>
</html>';?>