<?php
 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
;echo '<link href="';echo CSS_PATH;echo 'appcenter.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="';echo JS_PATH;echo 'jquery.switchable.min.js"></script>
<div class="pad_10">
<div class="wx980">
<div class="infoba" id="ibar">
 
</div>
<div class="row1">
  <div id="mboxs" class="mbox">
    <div>
		';if(is_array($focus_data)) foreach ($focus_data as $f) {;echo '        <a ';if($f[islink]) {;echo 'href="';echo $f['url'];echo '" target="_blank"';}else {;echo ' href="?s=admin/plugin/appcenter_detail/id/';echo $f['appid'];echo '"';};echo '><img src="';echo $f['thumb'];echo '"/></a>
		';};echo '
    </div>
  </div>
  <div id="tagers" class="sbox"></div>
</div>
  <div class="rr2">
    <div class="row2">
      <div class="l jj"></div>
      <ul class="r cola li20" id="ul0s">
      	  ';if(is_array($recommed_data['list'])) foreach ($recommed_data['list'] as $r) {;echo '        <li>
          <div><a href="?s=admin/plugin/appcenter_detail/id/';echo $r['id'];echo '" title="test" rel="';echo $r['id'];echo '"><img src="';echo $r['thumb'] ?$r['thumb'] : IMG_PATH.'zz_bg.jpg';echo '" width="55" height="55" /></a><a href="?s=admin/plugin/appcenter_detail/id/';echo $r['id'];echo '" title="test" class="mgt6">';echo $r['appname'];echo '</a></div>
        </li>
         ';};echo '        <li style="width:100%; height:0; font-size:0; overflow:hidden;"></li>
      </ul>
      <div style="clear:both;"></div>
    </div>
  </div>
  <div class="row3"> <a href="javascript:;"  class="ac">';echo L('plugin_app_all','','plugin');echo '<span class="sja"></span></a></div>
  <div class="rr3 cr">
    <div class="row4">
      <ul class="col col4 fy" id="ul1s">
	     ';if(is_array($data['list'])) foreach ($data['list'] as $r) {;echo '        <li>
          <div><a href="?s=admin/plugin/appcenter_detail/id/';echo $r['id'];echo '" title="';echo $r['appname'];echo '" rel="';echo $r['id'];echo '"><img src="';echo $r['thumb'] ?$r['thumb'] : IMG_PATH.'zz_bg.jpg';echo '" width="55" height="55" /></a>
            <h5>';echo str_cut($r['appname'],16,'');echo '</h5>
            <span>';echo $r['isfree'] ?L('plugin_free','','plugin') : L('plugin_not_free','','plugin');echo '</span><br />
           </div>
        </li>
		';};echo '      </ul>
    </div>
  </div>
  <div id="pages">';echo $pages;echo '</div>
</div>
<script type="text/javascript">
	$(document).ready(function(e) {
        $("#ul0s > li div").bind("mouseenter",function(e){
			var id = $(this).children(\'a\').attr(\'rel\');
			get_ajx_detail(id);
			var zj = $(this).offset();$("#ul0s").append($("#ibar"));$("#ibar").addClass("xs").css({"left":zj.left+92,"top":zj.top-150});$("#ibar").mouseleave(function(){$(this).removeClass("xs");});
			});
		$("#ul1s > li div").bind("mouseenter",function(e){
			var id = $(this).children(\'a\').attr(\'rel\');
			get_ajx_detail(id);
			var zj = $(this).offset();$("#ul1s").append($("#ibar"));$("#ibar").addClass("xs").css({"left":zj.left+92,"top":zj.top-150});$("#ibar").mouseleave(function(){$(this).removeClass("xs");});
			});
		$(\'#tagers\').switchable(\'#mboxs > div > a\', {effect: \'scroll\',speed: .2,vertical: true}).autoplay(6).carousel().mousewheel();

    });
	function get_ajx_detail(id) {
		$.getJSON(\'?s=admin/plugin/public_appcenter_ajx_detail/jsoncallback/?/id/\'+id+\'/h5_hash/\'+h5_hash,function(a){
			var isfree = a.isfree == 1 ? \'';echo L('plugin_free','','plugin');echo '\' : \'';echo L('plugin_not_free','','plugin');echo '\'
			$("#ibar").html(\'<div class="lsj"></div><div class="cr r1"> <img src="\'+a.thumb+\'" width="55" height="55" /></a><h5>\'+a.appname+\'</h5><span class="grayt">\'+isfree+\'</span></div><p class="nr">\'+a.description+\'</p><div class="r2"><div class="jx l"><span class="xx3"></span></div><span class="l">(3)</span><div class="zz">';echo L('plugin_author','','plugin');echo '£º\'+a.username+\'</div></div>\');
		});	
	}



</script>
</div>
</body>
</html>';?>