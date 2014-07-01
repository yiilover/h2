<?php

defined('IN_ADMIN') or exit('No permission resources.');
$show_header = true;
$show_scroll = true;
include $this->admin_tpl('header');
;echo '<body scroll="no">
<div style="padding:6px 3px">
    <div class="col-2 col-left mr6" style="width:140px">
      <h6><img src="';echo IMG_PATH;echo 'icon/sitemap-application-blue.png" width="16" height="16" /> ';echo L('site_select');;echo '</h6>
       <div id="site_list">
          <ul class="content role-memu" >
          ';foreach($sites_list as $n=>$r) {;echo '          	';$green = $this->op->is_setting($r['siteid'],$roleid) ?'_green': '';;echo '            <li><a href="?s=admin/role/role_priv/siteid/';echo $r['siteid'];echo '/roleid/';echo $roleid;echo '" target="role"><span><img src="';echo IMG_PATH;echo 'icon/gear_disable';echo $green;echo '.png" width="16" height="16" />';echo L('sys_setting');;echo '</span><em>';echo $r['name'];echo '</em></a></li>
           ';};echo '      </ul>
      </div>
    </div>
    <div class="col-2 col-auto">
        <div class="content" style="padding:1px">
        <iframe name="role" id="role" src="?s=admin/role/role_priv/h5_hash/';echo $_SESSION['h5_hash'];echo '" frameborder="false" scrolling="auto" style="overflow-x:hidden;border:none" width="100%" height="483" allowtransparency="true"></iframe>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
$("#site_list li").click(
	function(){$(this).addClass("on").siblings().removeClass(\'on\')}
);
$(function(){
	var site_list=$("#site_list"),col_left=$(".col-left");
	if(site_list.height()>458){
		col_left.attr("style","width:160px");
		site_list.attr("style","overflow-y:auto;height:458px");
	}
})
</script>';?>