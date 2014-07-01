<?php

defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<div class="pad-lr-10">
';include HOUSE5_PATH.'star_config.php';;echo ' <div class="comment_button"><a href="?s=reviews/reviews_admin/lists&hot=0"';if ($hot==0) {;echo ' class="on"';};echo '>最新</a> <a href="?s=reviews/reviews_admin/lists&hot=1"';if ($hot==1) {;echo ' class="on"';};echo '>最热</a>';$i=1;while($i<=count($star_config)){;echo ' <a href="?s=reviews/reviews_admin/lists&startype=';echo $i;;echo '&hot=3"';if ($startype==$i) {;echo ' class="on"';};echo '>';echo $star_config[$i]['star_conname'];;echo '</a>
';$i++;};echo '</div> 	
 
 
 <form action="?" method="get">
 <input type="hidden" name="s" value="reviews/check/ajax_checks">
    <input type="hidden" name="type" value="-1">
    <input type="hidden" name="reviewsid" value="">
<div class="comment">
';if(is_array($list)) foreach($list as $v) :
;echo '<div  id="tbody_';echo $v['id'];echo '">
<h5 class="title fn" ><span class="rt">';if( $v['status'] == 0) {;echo '<input type="button" value="';echo L('pass');echo '" class="button" onclick="check(';echo $v['id'];echo ', 1, \'';echo $v['reviewsid'];echo '\')" /> ';};echo '<input  class="button"  type="button" value="';echo L('delete');echo '" onclick="check(';echo $v['id'];echo ', -1, \'';echo $v['reviewsid'];echo '\')" />
</span>';echo $v['username'];echo ' (';echo $v['ip'];echo ') ';echo L('chez');echo ' ';echo format::date($v['creat_at'],1);echo ' ';echo L('release');echo ' ';echo L('support');echo '：';echo $v['support'];echo '</h5>
';if (!empty($v['content'])) {;echo '    <div class="content">
    	<pre>优点：';echo $v['advantage'];echo '</pre>
		<pre>缺点：';echo $v['disadvantage'];echo '</pre>
		<pre>总结：';echo $v['content'];echo '</pre>
    </div>
';};echo '        ';
$star_type = $v['startype'];
$star_li = explode('|',$star_config[$star_type]['star_name']);
$star_img = explode('|',$star_config[$star_type]['star_images']);
$star_n = 0;
;echo '    <div id="star_show">
        ';$star_n=0;echo '        ';$n=1;if(is_array($star_li)) foreach($star_li AS $star_code) {;echo '        ';$star_n++;$star_code = explode('$$',$star_code);;echo '        <b>';echo $star_code['0'];;echo '：</b>
        ';$starnus='star'.$star_n;echo '          ';for($star_nn=1;$star_nn <= $v[$starnum];$star_nn++){;echo '          <img alt="';echo $r[$starnum];;echo '分" src="';echo $star_img['1'];;echo '" />
          ';};echo '          ';for($star_nn=1;$star_nn <= (5-$v[$starnum]);$star_nn++){;echo '          <img alt="';echo $r[$starnum];;echo '分" src="';echo $star_img['0'];;echo '" />
          ';};echo '        ';$n++;}unset($n);;echo '    </div>
    <div class="bk20 hr mb8"></div>
</div>
';endforeach;;echo '</div>
 </form>
<div id="pages">';echo $pages;;echo '</div>
</div>
<script type="text/javascript">
';if(!isset($_GET['show_center_id'])) {;echo ' window.top.$(\'#display_center_id\').css(\'display\',\'none\');';};echo 'function check(id, type, reviewsid) {
	if(type == -1 && !confirm(\'';echo L('are_you_sure_you_want_to_delete');echo '\')) {
		return false;
	}
	$.get(\'?s=reviews/check/ajax_checks&id=\'+id+\'&type=\'+type+\'&reviewsid=\'+reviewsid+\'&\'+Math.random(), function(data){if(data!=1){if(data==0){alert(\'';echo L('illegal_parameters');echo '\')}else{alert(data)}}else{$(\'#tbody_\'+id).remove();}});
}
</script>
</body>
</html>';?>